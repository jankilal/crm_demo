<?php

class Dashboard_model extends Comman_model 
{     

    public function getAllIncomeExpanse()
    {
        $this->db->select('*');
        $this->db->from('tbl_transactions');
        $this->db->order_by('transactions_id');
        $query = $this->db->get();
        return $query->result() ;
    }
        public function getAllcountinglead($user_id)
    {
            $this->db->select('b.*');
            $this->db->from('tbl_assign_user a');
            $this->db->join('tbl_leads b', 'a.lead_id = b.lead_id' ,'inner');
            $this->db->where('a.user_id',$user_id);
            $this->db->where('current_status',1);
            $query = $this->db->get();
            return $query->num_rows() ;
    }
            public function getAllcountingopp($user_id)
    {
            $this->db->select('b.*');    
            $this->db->from('tbl_assign_user a');
            $this->db->join('tbl_leads b', 'a.lead_id = b.lead_id' ,'inner');
            $this->db->where('a.user_id',$user_id);
            $this->db->where('current_status',2);
            $query = $this->db->get();
            return $query->num_rows() ;
    }
               public function getAllcountingclient($user_id)
    {
             $this->db->select('b.*');    
            $this->db->from('tbl_assign_user a');
            $this->db->join('tbl_leads b', 'a.lead_id = b.lead_id' ,'inner');
            $this->db->where('a.user_id',$user_id);
            $this->db->where('current_status',3);
            $query = $this->db->get();
             return $query->num_rows() ;
    }
               public function getAllcountingsamplerequest($user_id)
    {
            $this->db->select('b.*');    
            $this->db->from('tbl_assign_user a');
            $this->db->join('tbl_sample_request b', 'a.lead_id = b.lead_id' ,'inner');
            $this->db->where('a.user_id',$user_id);
            $query = $this->db->get();
            return $query->num_rows() ;
    }
        public function getAllcountingquotation($user_id)
    {
            $this->db->select('b.*');    
            $this->db->from('tbl_assign_user a');
            $this->db->join('tbl_quotation b', 'a.lead_id = b.lead_id' ,'inner');
            $this->db->where('a.user_id',$user_id);
            $query = $this->db->get();
            return $query->num_rows() ;
    }


    public function getTodayIncomeExpanse($date)
    {
        $this->db->select('*');
        $this->db->from('tbl_transactions');
        $this->db->where('date',$date);
        $this->db->order_by('transactions_id');
        $query = $this->db->get();
        return $query->result() ;
    }

    public function getTodayPayment($date)
    {
        return $this->db->select_sum('amount')->where('payment_date', $date)->get('tbl_payments')->row()->amount;

    }

    public function getAllItems()
    {
        $this->db->select('*');
        $this->db->from('tbl_items');        
        $this->db->order_by('items_id');
        $query = $this->db->get();
        return $query->result() ;        
    }

    public function get_transactions_list_by_date($type, $start_date, $end_date)
    {
        $this->db->select('tbl_transactions.*', FALSE);
        $this->db->from('tbl_transactions');
        $this->db->where('type', $type);
        $this->db->where('date >=', $start_date);
        $this->db->where('date <=', $end_date);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_goal_report_by_month($start_date, $end_date)
    {
        $this->db->select('tbl_goal_tracking.*', FALSE);
        $this->db->from('tbl_goal_tracking');
        $this->db->where('end_date >=', $start_date);
        $this->db->where('end_date <=', $end_date);
        $query_result = $this->db->get();
        $result = $query_result->result();
        $all_type = $this->db->get('tbl_goal_type')->result();
        foreach ($all_type as $v_type) {
            if (!empty($result)) {
                foreach ($result as $item) {
                    if ($v_type->goal_type_id == $item->goal_type_id) {
                        $goal_achieve[$v_type->goal_type_id]['target'][] = $item->achievement;
                        $goal_achieve[$v_type->goal_type_id]['achievement'][] = $this->get_progress($item);
                    } else {
                        $goal_achieve[$v_type->goal_type_id]['target'][] = 0;
                        $goal_achieve[$v_type->goal_type_id]['achievement'][] = array('achievement' => 0);
                    }
                }
            }
        }

        if (!empty($goal_achieve)) {
            $goal_achieve = $goal_achieve;
        } else {
            $goal_achieve = array();
        }
        return $goal_achieve;
    }

    public function get_transactions_list_by_month($start_date, $end_date)
    {
        $this->db->select('tbl_transactions.*', FALSE);
        $this->db->from('tbl_transactions');
        $this->db->where('date >=', $start_date);
        $this->db->where('date <=', $end_date);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function calculate_amount($year, $month)
    {
        $amount = $this->db->select_sum('amount')
            ->where(array('month_paid' => $month, 'year_paid' => $year))
            ->get('tbl_payments')
            ->row()->amount;
        return ($amount > 0) ? $amount : 0;
    }

    public function check_user_name($user_name, $user_id)
    {
        $this->db->select('tbl_users.*', false);
        $this->db->from('tbl_users');
        if ($user_id) {
            $this->db->where('user_id !=', $user_id);
        }
        $this->db->where('username', $user_name);
        $query_result = $this->db->get();
        $result = $query_result->row();

        return $result;
    }

    public function get_payment_status($invoice_id) 
    {
        $tax = $this->get_invoice_tax_amount($invoice_id);
        $discount = $this->get_invoice_discount($invoice_id);
        $invoice_cost = $this->get_invoice_cost($invoice_id);
        $payment_made = round($this->get_invoice_paid_amount($invoice_id), 2);
        $due = round(((($invoice_cost - $discount) + $tax) - $payment_made));
        if ($payment_made < 1) {
            return lang('not_paid');
        } elseif ($due <= 0) {
            return lang('fully_paid');
        } else {
            return lang('partially_paid');
        }
    }

    public function invoice_perc($invoice) 
    {
        $invoice_payment = $this->invoice_payment($invoice);
        $invoice_payable = $this->invoice_payable($invoice);
        if ($invoice_payable < 1 OR $invoice_payment < 1) {
            $perc_paid = 0;
        } else {
            $perc_paid = ($invoice_payment / $invoice_payable) * 100;
        }
        return round($perc_paid);
    }

    public function invoice_payment($invoice) {
        $this->ci->db->where('invoice', $invoice);
        $this->ci->db->select_sum('amount');
        $query = $this->ci->db->get('payments');
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->amount;
        }
    }

    function ordered_items_by_id($id, $type = 'invoices') {
        $table = ($type == 'invoices' ? '' : 'estimate_') . 'tbl_items';
        $result = $this->db->where($type . '_id', $id)->order_by('item_order', 'asc')->get($table)->result();
        return $result;
    }

    function calculate_to($invoice_value, $invoice_id) {
        switch ($invoice_value) {
            case 'invoice_cost':
                return $this->get_invoice_cost($invoice_id);
                break;
            case 'tax':
                return $this->get_invoice_tax_amount($invoice_id);
                break;
            case 'discount':
                return $this->get_invoice_discount($invoice_id);
                break;
            case 'paid_amount':
                return $this->get_invoice_paid_amount($invoice_id);
                break;
            case 'invoice_due':
                return $this->get_invoice_due_amount($invoice_id);
                break;
        }
    }

    function get_invoice_cost($invoice_id) {
        $this->db->select_sum('total_cost');
        $this->db->where('invoices_id', $invoice_id);
        $this->db->from('tbl_items');
        $query_result = $this->db->get();
        $cost = $query_result->row();
        if (!empty($cost->total_cost)) {
            $result = $cost->total_cost;
        } else {
            $result = '0';
        }
        return $result;
    }


    public function get_invoice_tax_amount($invoice_id) {
        $invoice_cost = $this->get_invoice_cost($invoice_id);
        $invoice_info = $this->check_by(array('invoices_id' => $invoice_id), 'tbl_invoices');
        $tax = $invoice_info->tax;
        return ($tax / 100) * $invoice_cost;
    }

    public function get_invoice_discount($invoice_id) {
        $invoice_cost = $this->get_invoice_cost($invoice_id);
        $invoice_info = $this->check_by(array('invoices_id' => $invoice_id), 'tbl_invoices');
        $discount = $invoice_info->discount;
        return ($discount / 100) * $invoice_cost;
    }

    public function get_invoice_paid_amount($invoice_id) {

        $this->db->select_sum('amount');
        $this->db->where('invoices_id', $invoice_id);
        $this->db->from('tbl_payments');
        $query_result = $this->db->get();
        $amount = $query_result->row();
        if (!empty($amount->amount)) {
            $result = $amount->amount;
        } else {
            $result = '0';
        }
        return $result;
    }

    public function get_invoice_due_amount($invoice_id) {

        $tax = $this->get_invoice_tax_amount($invoice_id);
        $discount = $this->get_invoice_discount($invoice_id);
        $invoice_cost = $this->get_invoice_cost($invoice_id);
        $payment_made = $this->get_invoice_paid_amount($invoice_id);
        $due_amount = (($invoice_cost - $discount) + $tax) - $payment_made;
        if ($due_amount <= 0) {
            $due_amount = 0;
        }
        return $due_amount;
    }

    function all_invoice_amount() {
        $invoices = $this->db->get('tbl_invoices')->result();
        $cost[] = array();
        foreach ($invoices as $invoice) {
            $tax = round($this->get_invoice_tax_amount($invoice->invoices_id));
            $discount = round($this->get_invoice_discount($invoice->invoices_id));
            $invoice_cost = round($this->get_invoice_cost($invoice->invoices_id));

            $cost[] = ($invoice_cost + $tax) - $discount;
        }
        if (is_array($cost)) {
            return round(array_sum($cost), 2);
        } else {
            return 0;
        }
    }

    function all_outstanding() {
        $invoices = $this->db->get('tbl_invoices')->result();
        $due[] = array();
        foreach ($invoices as $invoice) {
            $due[] = $this->get_invoice_due_amount($invoice->invoices_id);
        }
        if (is_array($due)) {
            return round(array_sum($due), 2);
        } else {
            return 0;
        }
    }

    function client_outstanding($client_id) 
    {
        $due[] = array();
        $invoices_info = $this->db->where('client_id', $client_id)->get('tbl_invoices')->result();

        foreach ($invoices_info as $v_invoice) {
            $due[] = $this->get_invoice_due_amount($v_invoice->invoices_id);
        }
        if (is_array($due)) {
            return round(array_sum($due), 2);
        } else {
            return 0;
        }
    }

    public function get_progress($goal_info, $currency = null)
    {

        $goal_type_info = $this->db->where('goal_type_id', $goal_info->goal_type_id)->get('tbl_goal_type')->row();
        $start_date = $goal_info->start_date;
        $end_date = $goal_info->end_date;
        $achievement = round($goal_info->achievement);
        if ($goal_type_info->tbl_name == 'tbl_transactions') {
            if ($goal_type_info->type_name == 'achive_total_income_by_bank' || $goal_type_info->type_name == 'achive_total_expense_by_bank') {
                if ($goal_info->account_id != '0') {
                    $where = array('account_id' => $goal_info->account_id, 'date >=' => $start_date, 'date <=' => $end_date, 'type' => $goal_type_info->query);
                } else {
                    $where = array('date >=' => $start_date, 'date <=' => $end_date, 'type' => $goal_type_info->query);
                }
            } else {

                $where = array('date >=' => $start_date, 'date <=' => $end_date, 'type' => $goal_type_info->query);
            }
            $curency = $this->check_by(array('code' => config_item('default_currency')), 'tbl_currencies');
            $transactions_result = $this->db->select_sum('amount')->where($where)->get($goal_type_info->tbl_name)->row()->amount;
            $tr_amount = round($transactions_result);
            if ($achievement <= $tr_amount) {
                $result['progress'] = 100;
            } else {
                $progress = ($tr_amount / $achievement) * 100;
                $result['progress'] = round($progress);

            }
            if (!empty($currency)) {
                $result['achievement'] = $tr_amount;
            } else {
                $result['achievement'] = display_money($tr_amount, $curency->symbol);
            }
        }
        if ($goal_type_info->tbl_name == 'tbl_invoices' || $goal_type_info->tbl_name == 'tbl_estimates') {
            $where = array('date_saved >=' => $start_date . " 00:00:00", 'date_saved <=' => $end_date . " 23:59:59");
            $invoice_result = count($this->db->where($where)->get($goal_type_info->tbl_name)->result());
            if ($achievement <= $invoice_result) {
                $result['progress'] = 100;
            } else {
                $progress = ($invoice_result / $achievement) * 100;
                $result['progress'] = round($progress);
            }
            $result['achievement'] = $invoice_result;
        }
        if ($goal_type_info->tbl_name == 'tbl_task') {
            $where = array('task_created_date >=' => $start_date . " 00:00:00", 'task_created_date <=' => $end_date . " 23:59:59", 'task_status' => 'completed');

            $task_result = count($this->db->where($where)->get($goal_type_info->tbl_name)->result());
            if ($achievement <= $task_result) {
                $result['progress'] = 100;
            } else {
                $progress = ($task_result / $achievement) * 100;
                $result['progress'] = round($progress);
            }
            $result['achievement'] = $task_result;
        }
        if ($goal_type_info->tbl_name == 'tbl_bug') {
            $where = array('update_time >=' => $start_date . " 00:00:00", 'update_time <=' => $end_date . " 23:59:59", 'bug_status' => 'resolved');

            $bugs_result = count($this->db->where($where)->get($goal_type_info->tbl_name)->result());
            if ($achievement <= $bugs_result) {
                $result['progress'] = 100;
            } else {
                $progress = ($bugs_result / $achievement) * 100;
                $result['progress'] = round($progress);
            }
            $result['achievement'] = $bugs_result;
        }
        if ($goal_type_info->tbl_name == 'tbl_client') {
            if ($goal_type_info->type_name = 'convert_leads_to_client') {
                $where = array('date_added >=' => $start_date . " 00:00:00", 'date_added <=' => $end_date . " 23:59:59", 'leads_id !=' => '0');
            } else {
                $where = array('date_added >=' => $start_date . " 00:00:00", 'date_added <=' => $end_date . " 23:59:59", 'leads_id' => '0');
            }
            $client_result = count($this->db->where($where)->get($goal_type_info->tbl_name)->result());

            if ($achievement <= $client_result) {
                $result['progress'] = 100;
            } else {
                $progress = ($client_result / $achievement) * 100;
                $result['progress'] = round($progress);
            }
            $result['achievement'] = $client_result;
        }
        if ($goal_type_info->tbl_name == 'tbl_payments') {
            $where = array('payment_date >=' => $start_date, 'payment_date <=' => $end_date);

            $payments_result = $this->db->select('currency')->select_sum('amount')->where($where)->get($goal_type_info->tbl_name)->row();

            if ($achievement <= $payments_result->amount) {
                $result['progress'] = 100;
            } else {
                $progress = ($payments_result->amount / $achievement) * 100;
                $result['progress'] = round($progress);
            }
            if (!empty($currency)) {
                $result['achievement'] = $payments_result->amount;
            } else {
                $result['achievement'] = display_money($payments_result->amount, $payments_result->currency);
            }
        }
        if ($goal_type_info->tbl_name == 'tbl_project') {
            $where = array('created_time >=' => $start_date . " 00:00:00", 'created_time <=' => $end_date . " 23:59:59", 'project_status' => 'completed');

            $task_result = count($this->db->where($where)->get($goal_type_info->tbl_name)->result());
            if ($achievement <= $task_result) {
                $result['progress'] = 100;
            } else {
                $progress = ($task_result / $achievement) * 100;
                $result['progress'] = round($progress);
            }
            $result['achievement'] = $task_result;
        }
        if (!empty($result)) {
            return $result;
        } else {
            $result['progress'] = 0;
            $result['achievement'] = 0;
            return $result;
        }
    }


}
