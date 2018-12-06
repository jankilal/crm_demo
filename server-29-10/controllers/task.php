<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Task extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('task_model');
	}	
	/*	Validation Rules */
	 protected $validation_rules = array
        (
        'taskAdd' => array(
           array(
                'field' => 'task_name',
                'label' => ' task name',
                'rules' => 'trim|required'
            ),	
        ),
		'taskEdit' => array(
        	
            array(
                'field' => 'task_name',
                'label' => ' task name',
                'rules' => 'trim|required'
            ),
        )
    );
	
	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{			
			$this->data['task_result'] = $this->task_model->getAlltask();
			$this->data['advance_data_tbl'] = '1';			
			$this->show_view_admin('task/task', $this->data);
		}
		else
		{	
			redirect(base_url().'dashboard/error/1');
		}
    }

    /* Add and Update */
	public function addTask()
	{
		if(@$_GET['task_id'] != '')
		{
			$task_id = $_GET['task_id'];
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{
					
					$this->form_validation->set_rules($this->validation_rules['taskEdit']);
					if($this->form_validation->run())
					{
						$post['task_name'] = $this->input->post('task_name');
						$post['related_to'] = $this->input->post('related_to');
						if($_POST['related_to'] != '0')
						{
							if(isset($_POST['opportunities_id']))
							{
								$post['opportunities_id'] = $this->input->post('opportunities_id');
							}
							if(isset($_POST['items_id']))
							{
								$post['items_id'] = $this->input->post('items_id');
							}
							if(isset($_POST['task_id']))
							{
								$post['task_id'] = $this->input->post('task_id');
							}
							if(isset($_POST['goal_tracking_id']))
							{
								$post['goal_tracking_id'] = $this->input->post('goal_tracking_id');
							}
							if(isset($_POST['leads_id']))
							{
								$post['leads_id'] = $this->input->post('leads_id');
							}
						}
						$post['task_start_date'] = $this->input->post('task_start_date');
						$post['due_date'] = $this->input->post('due_date');
						$post['task_progress'] = $this->input->post('task_progress');
						$post['task_hour'] = $this->input->post('task_hour');
						$post['permission'] = $this->input->post('permission');
						$post['task_status'] = $this->input->post('task_status');
						$post['task_description'] = $this->input->post('task_description');
						$post['task_created_date'] = date('Y-m-d H:i:s');						
						$task_id =  $this->task_model->updateTask($post,$task_id);	
						if($task_id)
						{					
							$msg = 'Task Update successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							if(@$_GET['action_type'] == 'Leads')
							{
								redirect('leads/viewLeadsDetails/'.$_GET['action_id'].'/6');
							}
							elseif(@$_GET['action_type'] == 'Opportunities')
							{
								redirect('opportunities/opportunityDetails/'.$_GET['action_id'].'/6');	
							}
							else
							{
								redirect('task');
							}							
						}						
					}
					else
					{				
						$this->data['edit_task'] = $this->task_model->edittask($task_id);					
						$this->data['role_list'] = $this->task_model->getRoleList();	
						$this->show_view_admin('task/task_update', $this->data);
					}		
				}
				else
				{
					$this->data['edit_task'] = $this->task_model->edittask($task_id);		
					$this->data['role_list'] = $this->task_model->getRoleList();				
					$this->show_view_admin('task/task_update', $this->data);
				}
			}
			else
			{
				redirect( base_url().'dashboard/error/1');
			}

		}
		else
		{		
			if($this->checkAddPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Add") 
				{
					$this->form_validation->set_rules($this->validation_rules['taskAdd']);
					if($this->form_validation->run())
					{
						$post['task_name'] = $this->input->post('task_name');
						$post['opportunities_id'] = $this->input->post('opportunities_id');
						if($_POST['opportunities_id'] != '0')
						{
							if(isset($_POST['opportunities_id']))
							{
								$post['opportunities_id'] = $this->input->post('opportunities_id');
							}
							if(isset($_POST['items_id']))
							{
								$post['items_id'] = $this->input->post('items_id');
							}
							if(isset($_POST['task_id']))
							{
								$post['task_id'] = $this->input->post('task_id');
							}
							if(isset($_POST['goal_tracking_id']))
							{
								$post['goal_tracking_id'] = $this->input->post('goal_tracking_id');
							}
							if(isset($_POST['leads_id']))
							{
								$post['leads_id'] = $this->input->post('leads_id');
							}
						}
						$post['task_start_date'] = $this->input->post('task_start_date');
						$post['due_date'] = $this->input->post('due_date');
						$post['task_progress'] = $this->input->post('task_progress');
						$post['task_hour'] = $this->input->post('task_hour');
						$post['permission'] = $this->input->post('permission');
						$post['task_status'] = $this->input->post('task_status');
						$post['task_description'] = $this->input->post('task_description');
						$post['permission'] = $this->input->post('permission');
						$post['task_created_date'] = date('Y-m-d H:i:s');						
						$task_id =  $this->task_model->addTask($post);	
						if($task_id)
						{
							if($_POST['permission'] == '0')
                            {
                                $permission_arr = $this->input->post('assigned_to');
                                if(sizeof($permission_arr) > 0)
                                {   
                                    for ($i=0; $i < count($permission_arr) ; $i++) 
                                    {                                       
                                        $post_permission['task_id'] = $task_id;
                                        $post_permission['user_id'] = $permission_arr[$i];
                                        $post_permission['permission_view'] = $this->input->post('view_'.$permission_arr[$i]);
                                        $post_permission['permission_edit'] = $this->input->post('edit_'.$permission_arr[$i]);
                                        $post_permission['permission_delete'] = $this->input->post('delete_'.$permission_arr[$i]);
                                        $post_permission['others_permission_status'] = 1;
                                        $post_permission['others_permission_created_date'] = date('Y-m-d');
                                        $post_permission['others_permission_update_date'] = date('Y-m-d');
                                        $this->task_model->addticketsPermission($post_permission);
                                    }                               
                                }
                                
                            }   

							$msg = 'Task added successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');

							//Redirecting Action By Type 
							if(@$_GET['action_type'] == 'Leads')
							{
								redirect('leads/viewLeadsDetails/'.$_GET['action_id'].'/6');
							}
							elseif(@$_GET['action_type'] == 'Opportunities')
							{
								redirect('opportunities/opportunityDetails/'.$_GET['action_id'].'/6');	
							}
							else
							{
								redirect('task');
							}
						}
					}
					else
					{				
						
						$this->data['role_list'] = $this->task_model->getRoleList();
						$this->data['user_list'] = $this->task_model->getALLUser();
						$this->show_view_admin('task/task_add', $this->data);
					}		
				}
				else
				{
					
					$this->data['role_list'] = $this->task_model->getRoleList();
					$this->data['action_type'] = @$_GET['action_type'];
					$this->data['user_list'] = $this->task_model->getALLUser();
					$this->show_view_admin('task/task_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'dashboard/error/1');
			}
		}		
	}
	
	/* Delete */
	public function deletetask()
	{
		if($this->checkDeletePermission())
		{
			$task_id = @$_GET['task_id'];	
			$this->task_model->deletetask($task_id);
			
				$msg = 'task remove successfully...!';					
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				if(@$_GET['action_type'] == 'Leads')
				{
					redirect('leads/viewLeadsDetails/'.$_GET['action_id'].'/6');
				}
				elseif(@$_GET['action_type'] == 'Opportunities')
				{
					redirect('opportunities/opportunityDetails/'.$_GET['action_id'].'/6');	
				}
				else
				{
					redirect('task');
				}	
		}
		else
		{
			redirect( base_url().'dashboard/error/1');
		}		
	}


    public function taskDetails($id = '' , $active = NULL , $edit = NULL)
    {
    	if($id)
    	{
	    	if($this->checkViewPermission())
			{				
		        if (!empty($edit)) 
		        {
		            $tasks_timer_id = $id;
		            $id = $this->db->where(array('tasks_timer_id' => $id))->get('tbl_tasks_timer')->row()->task_id;
		        } 
		        else 
		        {
		            $id = $id;
		        }
		        $this->data['title'] = lang('task_details');
		        $this->data['page_header'] = lang('task_management');

		        $this->data['task_details'] = $this->task_model->check_by(array('task_id' => $id), 'tbl_task');
		        $this->task_model->_table_name = 'tbl_user';
		        $this->task_model->_order_by = 'user_id';
		        $this->data['assign_user'] = $this->task_model->get_by(array('user_role_id !=' => '2'), FALSE);

		        $this->task_model->_table_name = "tbl_task_attachment"; //table name
		        $this->task_model->_order_by = "task_id";
		        $this->data['files_info'] = $this->task_model->get_by(array('task_id' => $id), FALSE);

		        foreach ($this->data['files_info'] as $key => $v_files) 
		        {
		            $this->task_model->_table_name = "tbl_task_uploaded_files"; //table name
		            $this->task_model->_order_by = "task_attachment_id";
		            $this->data['project_files_info'][$key] = $this->task_model->get_by(array('task_attachment_id' => $v_files->task_attachment_id), FALSE);
		        }

		        if ($active == 2) 
		        {
		            $this->data['active'] = 2;
		            $this->data['time_active'] = 1;
		        } 
		        elseif ($active == 3) 
		        {
		            $this->data['active'] = 3;
		            $this->data['time_active'] = 1;
		        } 
		        elseif ($active == 4) 
		        {
		            $this->data['active'] = 4;
		            $this->data['time_active'] = 1;
		        }  
		        elseif ($active == 6) 
		        {
		            $this->data['active'] = 6;
		            $this->data['time_active'] = 1;
		        } 
		        elseif ($active == 8) 
		        {
		            $this->data['active'] = 8;
		            $this->data['time_active'] = 1;
		        } 
		        elseif ($active == 7) 
		        {
		            $this->data['active'] = 7;
		            if (!empty($edit)) 
		            {
		                $this->data['time_active'] = 2;
		                $this->data['tasks_timer_info'] = $this->task_model->check_by(array('tasks_timer_id' => $tasks_timer_id), 'tbl_tasks_timer');
		            } 
		            else 
		            {
		                $this->data['time_active'] = 1;
		            }
		        } 
		        else 
		        {
		            $this->data['active'] = 1;
		            $this->data['time_active'] = 1;
		        }
		       $this->show_view_admin('task/task_details', $this->data);
			}
			else
			{	
				redirect(base_url().'dashboard/error/1');
			}
		}
		else
		{
			redirect(base_url().'task');
		}
    }

    public function save_tasks_notes($id)
    {

        $data = $this->task_model->array_from_post(array('tasks_notes'));
		//save data into table.		
        $this->task_model->_table_name = "tbl_task"; // table name
        $this->task_model->_primary_key = "task_id"; // $id
        $id = $this->task_model->updateTask($data, $id);
		// save into activities
        $activities = array(
            'user' => $this->data['user_id'],
            'module' => 'tasks',
            'module_field_id' => $id,
            'activity' => 'activity_update_task',
            'icon' => 'fa-ticket',
            'value1' => $data['tasks_notes'],
        );
		// Update into tbl_project
        $this->task_model->_table_name = "tbl_activities"; //table name
        $this->task_model->_primary_key = "activities_id";
        $this->task_model->save($activities);
        $type = "success";
        $message = lang('update_task');
        set_message($type, $message);
        redirect('task/taskDetails/'.$id.'/'.'6');
    }
    

    public function save_comments()
    {
    	$data['task_id'] = $this->input->post('task_id', TRUE);
        $data['comment'] = $this->input->post('comment', TRUE);
        $data['user_id'] = $this->data['user_id'];       
        //save data into table.
        $this->task_model->_table_name = "tbl_task_comment"; // table name
        $this->task_model->_primary_key = "task_comment_id"; // $id
        $this->task_model->save($data);

        // save into activities
        $activities = array(
            'user' => $this->data['user_id'],
            'module' => 'task',
            'module_field_id' => $data['opportunities_id'],
            'activity' => 'activity_new_task_comment',
            'icon' => 'fa-ticket',
            'value1' => $data['comment'],
        );
        // Update into tbl_project
        $this->task_model->_table_name = "tbl_activities"; //table name
        $this->task_model->_primary_key = "activities_id";
        $this->task_model->save($activities);


        $type = "success";
        $message = lang('task_comment_save');
        set_message($type, $message);
        redirect('task/taskDetails/' . $data['task_id'] . '/' . '4');
    }

    public function delete_comments($opportunities_id, $task_comment_id)
    {
        //save data into table.
        $this->task_model->_table_name = "tbl_task_comment"; // table name
        $this->task_model->_primary_key = "task_comment_id"; // $id
        $this->task_model->delete($task_comment_id);

        $type = "success";
        $message = lang('task_comment_deleted');
        set_message($type, $message);
        redirect('admin/opportunities/task_details/' . $opportunities_id . '/' . '4');
    }

    public function save_attachment($task_attachment_id = NULL)
    {    	
        $data = $this->task_model->array_from_post(array('title', 'description', 'task_id'));
        $data['user_id'] = $this->data['user_id'];

        // save and update into tbl_files
        $this->task_model->_table_name = "tbl_task_attachment"; //table name
        $this->task_model->_primary_key = "task_attachment_id";
        if (!empty($task_attachment_id)) 
        {
            $id = $task_attachment_id;
            $this->task_model->save($data, $id);
            $msg = lang('task_file_updated');
        } 
        else 
        {
            $id = $this->task_model->save($data);
            $msg = lang('task_file_added');
        }

        if (!empty($_FILES['task_files']['name']['0'])) 
        {
            $old_path_info = $this->input->post('uploaded_path');
            if (!empty($old_path_info)) 
            {
                foreach ($old_path_info as $old_path) 
                {
                    unlink($old_path);
                }
            }
           					
			$task_files = $_FILES["task_files"]["name"];
			for($k = 0; $k < count($task_files); $k++)
			{	
				$_FILES['new_file']['name'] = $_FILES['task_files']['name'][$k];
				$_FILES['new_file']['type'] = $_FILES['task_files']['type'][$k];
		        $_FILES['new_file']['tmp_name'] = $_FILES['task_files']['tmp_name'][$k];
		        $_FILES['new_file']['error'] = $_FILES['task_files']['error'][$k];
		        $_FILES['new_file']['size'] = $_FILES['task_files']['size'][$k];
		      	$name = 'task_attachment';
		      	$imagePath = 'webroot/upload/task_files/';
		       	$temp = explode(".",$_FILES['new_file']['name']);				
				$extension = end($temp);
				$filenew =  date('d-M-Y').'_'.str_replace($_FILES['new_file']['name'],$name,$_FILES['new_file']['name']).'_'.time().''.rand(). "." .$extension;  		
				$config['file_name'] = $filenew;
				$config['upload_path'] = $imagePath;
				$config['max_size'] = '2024000';			    
				$this->upload->initialize($config);
				$this->upload->set_allowed_types('*');
				$this->upload->set_filename($config['upload_path'],$filenew);
				if(!$this->upload->do_upload('new_file'))
				{
					$error = $this->upload->display_errors();
					$type = "error";
					$message = $error;
					set_message($type, $message);
				}
				else 
				{ 
					$f_array = $this->upload->data();
				}
				if(!empty($f_array))
		      	{
		      		$fdata['files'] = $f_array['file_path'];
	                $fdata['file_name'] = $f_array['file_name'];
	                $fdata['uploaded_path'] = $f_array['full_path'];
	                $fdata['size'] = $f_array['file_size'];
	                $fdata['ext'] = $f_array['file_ext'];
	                $fdata['is_image'] = $f_array['is_image'];
	                $fdata['image_width'] = $f_array['image_width'];
	                $fdata['image_height'] = $f_array['image_height'];
	                $fdata['task_attachment_id'] = $id;
	                $this->task_model->_table_name = "tbl_task_uploaded_files"; // table name
	                $this->task_model->_primary_key = "uploaded_files_id"; // $id
	                $this->task_model->save($fdata);
		      	}

			} // END FOR LOOP	
           
        }
        // save into activities
        $activities = array(
            'user' => $this->data['user_id'],
            'module' => 'task',
            'module_field_id' => $id,
            'activity' => 'activity_new_task_attachment',
            'icon' => 'fa-ticket',
            'value1' => $data['title'],
        );
        // Update into tbl_project
        $this->task_model->_table_name = "tbl_activities"; //table name
        $this->task_model->_primary_key = "activities_id";
        $this->task_model->save($activities);
        // messages for user
        $type = "success";
        $message = $msg;
        set_message($type, $message);
        redirect('task/taskDetails/' . $data['task_id'] . '/' . '5');
    }

    public function delete_files($opportunities_id, $task_attachment_id)
    {
        $file_info = $this->task_model->check_by(array('task_attachment_id' => $task_attachment_id), 'tbl_task_attachment');
        // save into activities
        $activities = array(
            'user' => $this->data['user_id'],
            'module' => 'task',
            'module_field_id' => $opportunities_id,
            'activity' => 'activity_task_attachfile_deleted',
            'icon' => 'fa-ticket',
            'value1' => $file_info->title,
        );
        // Update into tbl_project
        $this->task_model->_table_name = "tbl_activities"; //table name
        $this->task_model->_primary_key = "activities_id";
        $this->task_model->save($activities);

        //save data into table.
        $this->task_model->_table_name = "tbl_task_attachment"; // table name        
        $this->task_model->delete_multiple(array('task_attachment_id' => $task_attachment_id));

        $type = "success";
        $message = lang('task_attachfile_deleted');
        set_message($type, $message);
        redirect('admin/opportunities/task_details/' . $opportunities_id . '/' . '5');
    }
    public function update_tasks_timer($id = NULL, $action = NULL)
    {

        if (!empty($action)) 
        {
            $t_data['task_id'] = $this->db->where(array('tasks_timer_id' => $id))->get('tbl_tasks_timer')->row()->task_id;
            $activity = 'activity_delete_tasks_timesheet';
            $msg = lang('delete_timesheet');
        } 
        else 
        {
            $activity = ('activity_update_task_timesheet');
            $msg = lang('timer_update');
        }
        if ($action != 'delete_task_timmer') 
        {
            $t_data = $this->task_model->array_from_post(array('task_id', 'start_date', 'start_time', 'end_date', 'end_time'));
            $data['start_time'] = strtotime($t_data['start_date'] . ' ' . $t_data['start_time']);
            $data['end_time'] = strtotime($t_data['end_date'] . ' ' . $t_data['end_time']);
            $data['reason'] = $this->input->post('reason', TRUE);
            $data['edited_by'] = $this->data['user_id'];
            $data['task_id'] = $t_data['task_id'];
            $data['user_id'] = $this->data['user_id'];          

            $this->task_model->_table_name = "tbl_tasks_timer"; //table name
            $this->task_model->_primary_key = "tasks_timer_id";
            if (!empty($id)) 
            {
                $id = $this->task_model->save($data, $id);
            } 
            else 
            {
                $id = $this->task_model->save($data);
            }
        } 
        else 
        {
            $this->task_model->_table_name = "tbl_tasks_timer"; //table name
            $this->task_model->_primary_key = "tasks_timer_id";
            $this->task_model->delete($id);
        }
        $task_info = $this->task_model->check_by(array('task_id' =>$t_data['task_id']), 'tbl_task','task_id');
        // save into activities
        $activities = array(
            'user' => $this->data['user_id'],
            'module' => 'tasks',
            'module_field_id' => $id,
            'activity' => $activity,
            'icon' => 'fa-users',
            'value1' => $task_info->task_name,
        );
        $this->task_model->_table_name = "tbl_activities"; //table name
        $this->task_model->_primary_key = "activities_id";
        $this->task_model->save($activities);
        $type = "success";
        $message = $msg;
        set_message($type, $message);
        redirect('task/taskDetails/' . $t_data['task_id'] . '/7');
    }


	public function tasks_timer($status, $task_id, $details = NULL)
    {
        $task_start = $this->task_model->check_by(array('task_id' => $task_id), 'tbl_task','task_id');
        if ($status == 'off') 
        {
			// check this user start time or this user is admin
			// if true then off time
			// else do not off time
            $check_user = $this->timer_started_by($task_id);
            if ($check_user == TRUE) 
            {
                $task_logged_time = $this->task_model->task_spent_time_by_id($task_id);
               	$time_logged = (time() - $task_start->start_time) + $task_logged_time; //time already logged


                $data = array(
                    'timer_status' => $status,
                    'logged_time' => $time_logged,
                    'start_time' => ''
                );
				// Update into tbl_task
                $this->task_model->_table_name = "tbl_task"; //table name
                $this->task_model->_primary_key = "task_id";
                $this->task_model->save($data, $task_id);
				// save into tbl_task_timer
                $t_data = array(
                    'task_id' => $task_id,
                    'user_id' => $this->data['user_id'],
                    'start_time' => $task_start->start_time,
                    'end_time' => time()
                );
                

				// insert into tbl_task_timer
                $this->task_model->_table_name = "tbl_tasks_timer"; //table name
                $this->task_model->_primary_key = "tasks_timer_id";
                $this->task_model->save($t_data);

				// save into activities
                $activities = array(
                    'user' => $this->data['user_id'],
                    'module' => 'tasks',
                    'module_field_id' => $task_id,
                    'activity' => ('activity_tasks_timer_off'),
                    'icon' => 'fa-copy',
                    'value1' => $task_start->task_name,
                );
				// Update into tbl_project
                $this->task_model->_table_name = "tbl_activities"; //table name
                $this->task_model->_primary_key = "activities_id";
                $this->task_model->save($activities);
            }
        } 
        else
        {
            $data = array(
                'timer_status' => $status,
                'timer_started_by' => $this->data['user_id'],
                'start_time' => time()
            );

			// save into activities
            $activities = array(
                'user' => $this->data['user_id'],
                'module' => 'tasks',
                'module_field_id' => $task_id,
                'activity' => 'activity_tasks_timer_on',
                'icon' => 'fa-copy',
                'value1' => $task_start->task_name,
            );
			// Update into tbl_project
            $this->task_model->_table_name = "tbl_activities"; //table name
            $this->task_model->_primary_key = "activities_id";
            $this->task_model->save($activities);

			// Update into tbl_task
            $this->task_model->_table_name = "tbl_task"; //table name
            $this->task_model->_primary_key = "task_id";
            $this->task_model->save($data, $task_id);
        }
		// messages for user
        $type = "success";
        $message = lang('task_timer_' . $status);
        set_message($type, $message);
        redirect($_SERVER['HTTP_REFERER']);

    }

 	public function timer_started_by($task_id)
    {
        $user_id = $this->data['user_id'];
        $user_info = $this->task_model->check_by(array('user_id' => $user_id), 'tbl_user');
        $timer_started_info = $this->task_model->check_by(array('task_id' => $task_id), 'tbl_task');
        if ($timer_started_info->timer_started_by == $user_id || $user_info->user_role_id == '1') 
        {
            return TRUE;
        } 
        else 
        {
            return FALSE;
        }
    }
	/* Get State List */
	public function getReletedModuleOpportunities()
	{
		$task_releted = $this->task_model->getReletedModuleOpportunities();
		//print_r($task_releted); die;
		$html = '';
		if(!empty($task_releted))
		{
			$html = '<div style="margin-bottom: 20px;" class="row"><div class="form-group"><div class="col-md-6 col-sm-6"><label>Select Opportunities</label><select name="opportunities_id" id="related_to" class="form-control">';
			foreach ($task_releted as $t_list) 
			{
				$html .= '<option value="'.$t_list->opportunities_id.'">'.$t_list->opportunity_name.' ('.$t_list->stages.')'.'</option>';
			}
			$html .= '</select></div></div></div>'; 
			echo $html; 
		}
		else
		{
			echo $html;
		}
	}

	public function getReletedModuleLeads()
	{
		$task_releted = $this->task_model->getReletedModuleLeads();
		$html = '';
		if(!empty($task_releted))
		{
			$html = '<div style="margin-bottom: 20px;" class="row"><div class="form-group"><div class="col-md-6 col-sm-6"><label>Select Leads</label><select name="leads_id" id="related_to" class="form-control">';
			foreach ($task_releted as $t_list) 
			{
				$html .= '<option value="'.$t_list->leads_id.'">'.$t_list->lead_name.'</option>';
			}
			$html .= '</select></div></div></div>'; 
			echo $html; 
		}
		else
		{
			echo $html;
		}
	}

	public function getReletedModuleBug()
	{
		$task_releted = $this->task_model->getReletedModuleBugs();
		$html = '';
		$html = '';
		if(!empty($task_releted))
		{
			$html = '<div style="margin-bottom: 20px;" class="row"><div class="form-group"><div class="col-md-6 col-sm-6"><label>Select Bugs</label><select name="bug_id" id="related_to" class="form-control">';
			foreach ($task_releted as $t_list) 
			{
				$html .= '<option value="'.$t_list->bug_id.'">'.$t_list->bug_title.'</option>';
			}
			$html .= '</select></div></div></div>'; 
			echo $html; 
		}
		else
		{
			echo $html;
		}
	}

	public function getReletedModuleGoal()
	{
		$task_releted = $this->task_model->getReletedModuleGoal();
		$html = '';
		if(!empty($task_releted))
		{
			$html = '<div style="margin-bottom: 20px;" class="row"><div class="form-group"><div class="col-md-6 col-sm-6"><label>Select Goal Tracking</label><select name="goal_tracking_id" id="related_to" class="form-control">';
			foreach ($task_releted as $t_list) 
			{
				$html .= '<option value="'.$t_list->goal_tracking_id.'">'.$t_list->subject.'</option>';
			}
			$html .= '</select></div></div></div>'; 
			echo $html; 
		}
		else
		{
			echo $html;
		}
	}

	public function getReletedModuleProject()
	{
		$task_releted = $this->task_model->getReletedModuleProject();

		$html = '';
		if(!empty($task_releted))
		{
			$html = '<div style="margin-bottom: 20px;" class="row"><div class="form-group"><div class="col-md-6 col-sm-6"><label>Select Project</label><select name="project_id" id="related_to" class="form-control">';
			foreach ($task_releted as $t_list) 
			{
				$html .= '<option value="'.$t_list->project_id.'">'.$t_list->project_name.'</option>';
			}
			$html .= '</select></div></div></div>'; 
			echo $html; 
		}
		else
		{
			echo $html;
		}
	}

	public function completedTasks($id = NULL)
    {
	 	$session = $this->session->all_userdata();
        $can_edit = $this->comman_model->can_action('tbl_task', 'edit', array('task_id' => $id),'task_id'); 
        if (!empty($can_edit)) 
        {
            $tasks_info = $this->comman_model->check_by(array('task_id' => $id), 'tbl_task');
            if ($tasks_info->task_progress == 100) 
            {
                $data['task_progress'] = 0;
                $data['task_status'] = 'not_started';
            } 
            else 
            {
                $data['task_progress'] = $this->input->post('task_progress');
                $data['task_status'] = $this->input->post('task_status');
            }

			//save data into table.
            $this->comman_model->_table_name = "tbl_task"; // table name
            $this->comman_model->_primary_key = "task_id"; // $id
            $id = $this->comman_model->save($data, $id);
			// save into activities
            $activities = array(
                'user' => $session[0]->user_id,
                'module' => 'tasks',
                'module_field_id' => $id,
                'activity' => 'activity_update_task',
                'icon' => 'fa-ticket',
                'value1' => $data['task_progress'],
            );
			// Update into tbl_project
            $this->comman_model->_table_name = "tbl_activities"; //table name
            $this->comman_model->_primary_key = "activities_id";
            $this->comman_model->save($activities);
            $type = "success";
            $message = 'Update task';
            echo json_encode(array("status" => $type, "message" => $message));
        }      
    }

}
/* End of file */?>