<?php
class Comman_model extends CI_Model
{
    public $_table_name = '';
    public $_primary_key = 'id';
    public $_primary_filter = 'intval';
    public $_order_by = '';
    public $rules = array();
    public $_timestamps = FALSE;

    function __construct()
    {
        parent::__construct();
    } 

    public function getData($tbl_name , $where_array = NULL , $fetch_type = 'multi', $order_by = NULL , $limit = NULL , $offset = NULL , $check_query = NULL , $order_by_clm = 'id' )
    {
        $this->db->select('*');
        $this->db->from($tbl_name);
        if($where_array != NULL)
        {
            $this->db->where($where_array);
        }
        if($order_by != NULL)
        {
            $this->db->order_by($order_by_clm , $order_by);
        }   
        if($limit != NULL && $offset != NULL)
        {
            $this->db->limit($limit,$offset);
        }
        if($limit != NULL)
        {
            $this->db->limit($limit);
        }
        $query = $this->db->get();
        
        if($check_query != NULL)
        {
            echo $this->db->last_query();die;
        }
        if($fetch_type == 'single')
        {
            return $query->row();
        }
        else if( $fetch_type == 'multi')
        {
            return $query->result();
        }
        else if( $fetch_type == 'result_array')
        {
            return $query->result_array();
        }
        else if( $fetch_type == 'count')
        {
            return $query->num_rows();
        }
    }

    public function getDataV2($tbl_name , $where_type = 'where' , $where_array = NULL , $fetch_type = 'result')
    {
        $this->db->select('*');
        $this->db->from($tbl_name);
        if($where_array != NULL)
        {
            foreach ($where_array as $key => $value)
            {
                $this->db->{$where_type}($key , $value);
            }
        }
        $query = $this->db->get();
        return $query->{$fetch_type}();
    }

    public function all_files()
    {
        $language = array(
            "main_lang.php" => "./application/",
            "tasks_lang.php" => "./application/",
            "projects_lang.php" => "./application/",
            "leads_lang.php" => "./application/",
            "opportunities_lang.php" => "./application/",
            "sales_lang.php" => "./application/",
            "transactions_lang.php" => "./application/",
            "bugs_lang.php" => "./application/",
            "bugs_lang.php" => "./application/",
            "tickets_lang.php" => "./application/",
            "client_lang.php" => "./application/",
            "settings_lang.php" => "./application/",
        );
        return $language;
    }

    public function set_action($where, $value, $tbl_name)
    {
        $this->db->set($value);
        $this->db->where($where);
        $this->db->update($tbl_name);
    }

    public function array_from_post($fields)
    {
        $data = array();
        foreach ($fields as $field)
        {
            $data[$field] = $this->input->post($field);        
        }        
        return $data;
    }

    function get_sum($table, $field, $where)
    {

        $this->db->where($where);
        $this->db->select_sum($field);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->$field;
        } else {
            return 0;
        }
    }

    
    public function get_lang()
    {
        if ($this->session->userdata('lang')) {
            return $this->session->userdata('lang');
        } else {
            $query = $this->db->select('language')->where('user_id', $this->data['user_id'])->get('tbl_account_details');
            if ($query->num_rows() > 0) {
                $row = $query->row();
                return $row->language;
            }
        }
    }
     public function get_by($where, $single = FALSE)
    {
        $this->db->where($where);
        return $this->get(NULL, $single);
    }

    public function get($id = NULL, $single = FALSE)
    {

        if ($id != NULL) {
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->where($this->_primary_key, $id);
            $method = 'row';
        } elseif ($single == TRUE) {
            $method = 'row';
        } else {
            $method = 'result';
        }

        if (!count($this->db->ar_orderby)) {
            $this->db->order_by($this->_order_by);
        }
        return $this->db->get($this->_table_name)->$method();
    }


    public function get_year($key)
    {
        $result = array(
            '1' => 'January',
            '2' => 'February',
            '3' => 'March',
            '4' => 'April',
            '5' => 'May',
            '6' => 'June',
            '7' => 'July',
            '8' => 'August',
            '9' => 'September',
            '10' => 'October',
            '11' => 'November',
            '12' => 'December',
        );
        foreach ($result as $name => $value) {
            if ($key == $name) {
                return $value;
            }
        }
    }  

    function get_time_different($from, $to)
    {
        date_default_timezone_set("Asia/Kolkata");
        $diff = abs($from - $to);
        $years = $diff / 31557600;
        $months = $diff / 2635200;
        $weeks = $diff / 604800;
        $days = $diff / 86400;
        $hours = $diff / 3600;
        $minutes = $diff / 60;
        if ($years > 1) {
            $duration = round($years) .'Years';
        } elseif ($months > 1) {
            $duration = round($months) .'Months';
        } elseif ($weeks > 1) {
            $duration = round($weeks) .'weeks';
        } elseif ($days > 1) {
            $duration = round($days) .'days';
        } elseif ($hours > 1) {
            $duration = round($hours) .'hours';
        } else {
            $duration = round($minutes) .'minutes';
        }

        return $duration;
    }

    public function save($data, $id = NULL)
    {
        // Set timestamps
        if ($this->_timestamps == TRUE) {
            $now = date('Y-m-d H:i:s');
            $id || $data['created'] = $now;
            $data['modified'] = $now;
        }

        // Insert
        if ($id === NULL) 
        {
            !isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
            $this->db->set($data);
            $this->db->insert($this->_table_name);
            $id = $this->db->insert_id();
        } // Update
        else 
        {
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->set($data);
            $this->db->where($this->_primary_key, $id);
            $this->db->update($this->_table_name);
        }

        return $id;
    }

    public function getAllUserOtherPermissions($type,$id)
    {
        $this->db->select('a.*');
        $this->db->from('tbl_others_permission a');
        // $this->db->join('tbl_user b', 'b.user_id = a.user_id', 'inner');
        $this->db->where("a.$type" , $id);
        $query = $this->db->get();        
        return $query->result() ;
    }

    public function getUserOtherPermissions($user_id = '',$column_name = '',$id = '')
    {
        $this->db->select('*');
        $this->db->from('tbl_others_permission');
        $this->db->where('user_id' , $user_id);
        $this->db->where($column_name , $id);
        $query = $this->db->get();        
        return $query->result() ;
    }

    
    public function check_by($where, $tbl_name)
    {
        $this->db->select('*');
        $this->db->from($tbl_name);
        $this->db->where($where);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    public function allowad_user_id($menu_id)
    {
        $permission_user = $this->all_permission_user($menu_id);
        // get all admin user
        $admin_user = $this->db->where('role_id', 1)->get('tbl_users')->result();
        if (!empty($admin_user)) {
            foreach ($admin_user as $a_user) {
                $user_id[] = $a_user->user_id;
            }
        }
        // if not exist data show empty array.
        if (!empty($permission_user)) {
            foreach ($permission_user as $p_user) {
                $user_id[] = $p_user->user_id;
            }
        }
        if (!empty($user_id)) {
            return $user_id;
        }
    }

    public function allowad_user($menu_id)
    {
        $permission_user = $this->all_permission_user($menu_id);
        // get all admin user
        $admin_user = $this->db->where('role_id', 1)->get('tbl_users')->result();
        // if not exist data show empty array.
        if (!empty($permission_user)) {
            $permission_user = $permission_user;
        } else {
            $permission_user = array();
        }
        if (!empty($admin_user)) {
            $admin_user = $admin_user;
        } else {
            $admin_user = array();
        }
        $result = array_merge($admin_user, $permission_user);
        return $result;
    }

    public function all_permission_user($menu_id,$user_role_id)
    {
        $this->db->select('a.tab_id');
        $this->db->select('b.*');
        $this->db->from('tbl_sidebar_tabs a');
        $this->db->join('tbl_user_permission b', 'b.tab_id = a.tab_id', 'inner');
        $this->db->where('a.controller_name', $menu_id);
        $this->db->where('b.role_id', $user_role_id);       
        $query_result = $this->db->get();       
        $result = $query_result->result();
        return $result;
    }

    public function get_permission($table, $flag = null)
    {

        $session = $this->session->all_userdata();
        $role = $session[0]->user_role_id;
        $user_id = $session[0]->user_id;
        if ($role != 1) 
        {
            $result_info = $this->db->get($table)->result();
            if (!empty($result_info)) 
            {
                foreach ($result_info as $result) {
                    if ($result->permission == '1') 
                    {
                        $permission[] = $result;
                    } 
                    else 
                    {
                        $get_permission = $this->getUserOtherPermissions($session[0]->user_id,'task_id',$result->task_id);  
                        if (!empty($get_permission)) 
                        {
                            foreach ($get_permission as $v_permission) 
                            {
                                if ($session[0]->user_id == $v_permission->user_id) 
                                {
                                    $permission[] = $result;
                                }
                            }
                        }
                    }
                }
            }
        }
        else 
        {
            $permission = $this->db->get($table)->result();
        }
        if (empty($permission)) 
        {
            $permission = array();
        }
        return $permission;
    }

    public function my_permission($table)
    {
        $session = $this->session->all_userdata();
        $result_info = $this->db->get($table)->result(); 
        if (!empty($result_info)) 
        {
            foreach ($result_info as $result) 
            {
                if ($result->permission == '1') 
                {
                    $permission[] = $result;
                } 
                else 
                {
                    $get_permission = $this->getUserOtherPermissions($session[0]->user_id,'task_id',$result->task_id);  
                     if (!empty($get_permission)) 
                     {
                        foreach ($get_permission as $v_permission) 
                        {
                            if ($session[0]->user_id == $v_permission->user_id) 
                            {
                                $permission[] = $result;
                            }
                        }
                    }
                }
            }
        }
        if (empty($permission)) {
            $permission = array();
        }
        return $permission;
    }



    public function can_action($table, $action, $id, $type = '')
    {

        $session = $this->session->all_userdata();
        $role = $session[0]->user_role_id;
        $user_id = $session[0]->user_id;
        $result_info = $this->db->where($id)->get($table)->row();
        if ($role != 1) 
        {
            if (!empty($result_info)) 
            {
                if ($result_info->permission != '1') 
                {
                     $get_permission = $this->getUserOtherPermissions($user_id,$type,$result_info->task_id);
                } 
                else 
                {
                    return true;
                }      
                 
                if (!empty($get_permission)) 
                {
                    foreach ($get_permission as $v_permission) 
                    {
                        if($action == 'edit')
                        {
                            if($v_permission->permission_edit == '1')
                            {
                                return true;
                            }
                            else
                            {
                                return false;
                            }
                        }
                        else if($action == 'view')
                        {
                             if($v_permission->permission_view == '1')
                            {
                                return true;
                            }
                            else
                            {
                                return false;
                            }

                        }
                        else if($action == 'delete')
                        {
                             if($v_permission->permission_delete == '1')
                            {
                                return true;
                            }
                            else
                            {
                                return false;
                            }

                        }
                    }
                }
            } 
            else 
            {
                return false;
            }
        } 
        else 
        {
            return true;
        }
    }

    public function delete($id)
    {
        $filter = $this->_primary_filter;
        $id = $filter($id);
        if (!$id) 
        {
            return FALSE;
        }
        $this->db->where($this->_primary_key, $id);
        $this->db->limit(1);
        $this->db->delete($this->_table_name);
    }

    public function generate_invoice_number()
    {
        $query = $this->db->select_max('invoices_id')->get('tbl_invoices');
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $next_number = ++$row->invoices_id;
            $next_number = $this->reference_no_exists($next_number);
            $next_number = sprintf('%04d', $next_number);
            return $next_number;
        } else {
            return sprintf('%04d', config_item('invoice_start_no'));
        }
    }

    public function reference_no_exists($next_number)
    {
        $next_number = sprintf('%04d', $next_number);

        $records = $this->db->where('reference_no', config_item('invoice_prefix') . $next_number)->get('tbl_invoices')->num_rows();
        if ($records > 0) {
            return $this->reference_no_exists($next_number + 1);
        } 
        else 
        {
            return $next_number;
        }
    }

    function send_email($params)
    {
        // If postmark API is being used
        if (config_item('use_postmark') == 'TRUE') 
        {
            $config = array('api_key' => config_item('postmark_api_key'));
            $this->load->library('postmark', $config);
            $this->postmark->from(config_item('postmark_from_address'), config_item('company_name'));
            $this->postmark->to($params['recipient']);
            $this->postmark->subject($params['subject']);
            $this->postmark->message_plain($params['message']);
            $this->postmark->message_html($params['message']);
            // Check resourceed file
            if (isset($params['resourcement_url'])) {
                $this->postmark->resource($params['resourceed_file']);
            }
            $this->postmark->send();
        } 
        else 
        {
            // If using SMTP
            if (config_item('protocol') == 'smtp') {
                $this->load->library('encrypt');
                $raw_smtp_pass = config_item('smtp_pass');
                $config = array(
                    'smtp_host' => config_item('smtp_host'),
                    'smtp_port' => config_item('smtp_port'),
                    'smtp_user' => config_item('smtp_user'),
                    'smtp_pass' => $raw_smtp_pass,
                    'crlf' => "\r\n",
                    'protocol' => config_item('protocol'),
                );
            }
            // Send email
            $config['useragent'] = 'Billing Accounting and CRM Software';
            $config['mailtype'] = "html";
            $config['newline'] = "\r\n";
            $config['charset'] = 'utf-8';
            $config['wordwrap'] = TRUE;

            $this->load->library('email', $config);
            $this->email->from(config_item('company_email'), config_item('company_name'));
            $this->email->to($params['recipient']);

            $this->email->subject($params['subject']);
            $this->email->message($params['message']);
            if ($params['resourceed_file'] != '') {
                $this->email->resource($params['resourceed_file']);
            }
            $send = $this->email->send();
            if ($send) {
                return $send;
            } else {
                $error = show_error($this->email->print_debugger());
                return $error;
            }
        }
    }

    function task_spent_time_by_id($id)
    {       

       $total_time = "SELECT start_time,end_time,end_time - start_time as time_spent FROM tbl_tasks_timer WHERE task_id = '".$id."' ";
        $result = $this->db->query($total_time)->result();        
        $time_spent = array();
        foreach ($result as $time) 
        {
            $time_spent[] = $time->time_spent;
        }
        if (is_array($time_spent)) 
        {

            return array_sum($time_spent);
        } 
        else 
        {
            return 0;
        }
    }

    function get_time_spent_result($seconds)
    {
        $init = $seconds;
        if($init == 0)
        {
            $hours = '00';
            $minutes = '00';
            $seconds = '00';  
        }
        else
        {
            $hours = gmdate("H", $init);
            $minutes = gmdate("i", $init);
            $seconds = gmdate("s", $init);      
        }
        return "<div class='countdown'><div class='countdown-time'><ul class='clearfix' id='js-countDown'><li class='item'><i class='hour'>" . $hours . "</i><span>" . lang('hours') . "</span></li><li class='blank'>:</li><li class='item'><i class='minute'>" . $minutes . "</i><span>" . lang('minutes') . "</span></li><li class='blank'>:</li><li class='item'><i class='second'>" . $seconds . "</i><span>" . lang('seconds') . "</span></li></ul></div></div>";

    }

    public function AddData($table_name , $post)
    {
        $this->db->insert($table_name, $post);
        $this->result = $this->db->insert_id() ; 
        return $this->result;
    }

    public function deleteData($table_name = '' , $where_array = '')
    {
        if($table_name != '' && $where_array != '')
        {
            $this->db->delete($table_name, $where_array);
            // echo $this->db->last_query();die;        
            return true;    
        }
        else
        {
            return false;
        }
    }

    public function updateData($table_name , $where_array = NULL, $post)
    {
        if($where_array != NULL)
        {
            $this->db->where($where_array);
        }
        $this->db->update($table_name, $post);
        return true;
    }

}
?>
