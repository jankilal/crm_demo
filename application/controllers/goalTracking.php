<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class GoalTracking extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('goalTracking_model');
		
	}	
	 /*	Validation Rules */
	 protected $validation_rules = array
        (
        
		'goalTrakinghAdd' => array(
        	
            array(
                'field' => 'subject',
                'label' => 'Subject',
                'rules' => 'trim|required'
            ),			
             array(
                'field' => 'achievement',
                'label' => 'achievement',
                'rules' => 'trim|required' 
            ),
              array(
                'field' => 'start_date',
                'label' => 'Start Date ',
                'rules' => 'trim|required' 
            ),
               array(
                'field' => 'end_date',
                'label' => 'End Date',
                'rules' => 'trim|required' 
            )
         )
        );


	public function index()
	{
		if($this->checkViewPermission())
		{			
			$this->data['goalTracking_result'] = $this->goalTracking_model->getAllGoalTracking();
			$this->data['advance_data_tbl'] = '1';				
			$this->show_view_admin('goalTracking/goal_tracking', $this->data);
		}
		else
		{	
			redirect(base_url().'dashboard/error/1');
		}
    }

    /* Add and Update */
	public function addGoalTracking($goal_tracking_id = '')
	{ 
		if($goal_tracking_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit")
				{	
					$this->form_validation->set_rules($this->validation_rules['goalTrakinghAdd']);
					if($this->form_validation->run())
					{
						$post['subject'] = $this->input->post('subject');
						$post['goal_type_id'] = $this->input->post('goal_type_id');
						$post['achievement'] = $this->input->post('achievement');
						$post['start_date'] = $this->input->post('start_date');
						$post['end_date'] = $this->input->post('end_date');
						$post['description'] = $this->input->post('description');
						 
						$GoalTracking_res =  $this->goalTracking_model->updateGoalTracking($post,$goal_tracking_id);	
						if($GoalTracking_res)
						{					
							$msg = 'GoalTracking added successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'goalTracking');
						}
					}	
			 	}

					else
					{				
						$this->data['edit_goal'] = $this->goalTracking_model->editGoalTracking($goal_tracking_id);
						$this->show_view_admin('goalTracking/goal_tracking_update', $this->data);
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
					  $this->form_validation->set_rules($this->validation_rules['goalTrakinghAdd']);
					   if($this->form_validation->run())
					{					
			         	
			         	$post['subject'] = $this->input->post('subject');
						$post['goal_type_id'] = $this->input->post('goal_type_id');
						$post['achievement'] = $this->input->post('achievement');
						$post['start_date'] = $this->input->post('start_date');
						$post['end_date'] = $this->input->post('end_date');
						$post['permission'] = $this->input->post('permission');
						$post['description'] = $this->input->post('description');
						

						$goal_tracking_id =  $this->goalTracking_model->addGoalTracking($post);

						if($goal_tracking_id)
						{
						  if($_POST['permission'] == '0')
                            {
                                $permission_arr = $this->input->post('assigned_to');
                                if(sizeof($permission_arr) > 0)
                                {   
                                    for ($i=0; $i < count($permission_arr) ; $i++) 
                                    {                                       
                                        $post_permission['goal_tracking_id'] = $goal_tracking_id;
                                        $post_permission['user_id'] = $permission_arr[$i];
                                        $post_permission['permission_view'] = $this->input->post('view_'.$permission_arr[$i]);
                                        $post_permission['permission_edit'] = $this->input->post('edit_'.$permission_arr[$i]);
                                        $post_permission['permission_delete'] = $this->input->post('delete_'.$permission_arr[$i]);
                                        $post_permission['others_permission_status'] = 1;
                                        $post_permission['others_permission_created_date'] = date('Y-m-d');
                                        $post_permission['others_permission_update_date'] = date('Y-m-d');
                                        $this->goalTracking_model->addTicketsPermission($post_permission);
                                    }                               
                                }
                                
                            }   	
							
							$msg = 'Leads added successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'goalTracking');			
						}
					}

				else
				{	
					$this->data['GoalTracking_category'] = $this->goalTracking_model->getALLgoalTrackingcategory();
					$this->data['user_list'] = $this->goalTracking_model->getALLUser();
					$this->show_view_admin('goalTracking/goal_tracking_add', $this->data);
				}
			}
			else
				{	
					$this->data['GoalTracking_category'] = $this->goalTracking_model->getALLgoalTrackingcategory();
					$this->data['user_list'] = $this->goalTracking_model->getALLUser();
					$this->show_view_admin('goalTracking/goal_tracking_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'dashboard/error/1');
			}
		}		
	}
	
	/* Delete */
	public function deleteGoalTracking()
	{
		if($this->checkDeletePermission())
		{
			$goal_tracking_id = $this->uri->segment(3);	
			$this->goalTracking_model->deleteGoalTracking($goal_tracking_id);
			
				$msg = 'GoalTracking remove successfully...!';					
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'goalTracking');			
		}
		else
		{
			redirect( base_url().'dashboard/error/1');
		}		
	}

	
}
/* End of file */?>