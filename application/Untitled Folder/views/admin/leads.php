<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Leads extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('leads_model');
		$this->load->model('opportunities_model');
	}	
	/*	Validation Rules */
	 protected $validation_rules = array
        (
        'leadsAdd' => array(
           array(
                'field' => 'leads_name',
                'label' => ' leads name',
                'rules' => 'trim|required'
            ),	
          	
           array(
                'field' => 'lead_source_id',
                'label' => ' leads source',
                'rules' => 'trim|required'
            ),		
           array(
                'field' => 'lead_status_id',
                'label' => ' leads status',
                'rules' => 'trim|required'
            ),		
           array(
                'field' => 'organization',
                'label' => ' Organization',
                'rules' => 'trim|required'
            ),		
           array(
                'field' => 'contact_name',
                'label' => ' Contact name',
                'rules' => 'trim|required'
            ),		
           array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required'
            ),		
           array(
                'field' => 'designation',
                'label' => 'Designation',
                'rules' => 'trim|required'
            ),			
           array(
                'field' => 'mobile',
                'label' => 'Mobile',
                'rules' => 'trim|required'
            )
          
        ),

        'leadsProcessAdd' => array(
           array(
                'field' => 'meeting_minutes',
                'label' => 'Minutes Of Call',
                'rules' => 'trim|required'
            ),          	
           array(
                'field' => 'next_meeting_call',
                'label' => 'Next Meeting Or Call',
                'rules' => 'trim|required'
            ),		
           array(
                'field' => 'to_do_list',
                'label' => 'To Do List',
                'rules' => 'trim|required'
            ),
           array(
                'field' => 'lead_status_id',
                'label' => 'Leads Status',
                'rules' => 'trim|required'
            ),
           array(
                'field' => 'to_do_list',
                'label' => 'To Do List',
                'rules' => 'trim|required'
            ),
          
        )       
    );
	
	
	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{			
			$this->data['leads_result'] = $this->leads_model->getAllleads();
			$this->data['lead_status'] = $this->leads_model->getALLleadsStatusList();
			$this->data['advance_data_tbl'] = '1';				
			$this->show_view_admin('leads/leads', $this->data);
		}
		else
		{	
			redirect(base_url().'dashboard/error/1');
		}
    }


    /* Add and Update */
	public function addleads($leads_id='')
	{
		if($leads_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{
					
					$this->form_validation->set_rules($this->validation_rules['leadsAdd']);
					if($this->form_validation->run())
					{						
						$post['leads_name'] = $this->input->post('leads_name');						
						$post['lead_source_id'] = $this->input->post('lead_source_id');
						$post['lead_status_id'] = $this->input->post('lead_status_id');
						$post['organization'] = $this->input->post('organization');
						$post['contact_name'] = $this->input->post('contact_name');
						$post['email'] = $this->input->post('email');
						$post['designation'] = $this->input->post('designation');
						$post['mobile'] = $this->input->post('mobile');
						$post['city'] = $this->input->post('city');
						$post['country'] = $this->input->post('country_id');
						$post['state'] = $this->input->post('state_id');
						$post['address'] = $this->input->post('address');
						$post['skype'] = $this->input->post('skype');
						$post['facebook'] = $this->input->post('facebook');
						$post['twitter'] = $this->input->post('twitter');
						$post['permission'] = $this->input->post('permission');
						$post['notes'] = $this->input->post('notes');
						$leads_res =  $this->leads_model->updateleads($post,$leads_id);	
						if($leads_res)
						{					
							$msg = 'leads added successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'leads');
						}
					}
					else
					{				
						$this->data['edit_leads'] = $this->leads_model->editleads($leads_id);
						$this->data['role_list'] = $this->leads_model->getRoleList();
						$this->data['lead_status'] = $this->leads_model->getALLleadsStatusList();
						$this->data['country_list'] = $this->leads_model->getCountryList();
						$this->data['leads_source'] = $this->leads_model->getALLleadsSourceList();
						$this->data['client_list'] = $this->leads_model->getClientList();
						$this->data['state_list'] = $this->leads_model->getStateList();		
						$this->data['all_users_list'] = $this->leads_model->getAllUsersList();
						$this->show_view_admin('leads/leads_update', $this->data);
					}		
				}
				else
				{
					$this->data['edit_leads'] = $this->leads_model->editleads($leads_id);				
					$this->data['role_list'] = $this->leads_model->getRoleList();
					$this->data['lead_status'] = $this->leads_model->getALLleadsStatusList();
					$this->data['country_list'] = $this->leads_model->getCountryList();
					$this->data['leads_source'] = $this->leads_model->getALLleadsSourceList();
					$this->data['client_list'] = $this->leads_model->getClientList();
					$this->data['state_list'] = $this->leads_model->getStateList();	
					$this->data['all_users_list'] = $this->leads_model->getAllUsersList();
					$this->show_view_admin('leads/leads_update', $this->data);
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
					$this->form_validation->set_rules($this->validation_rules['leadsAdd']);
					if($this->form_validation->run())
					{
											
						$post['lead_name'] = $this->input->post('leads_name');
						
						$post['lead_source_id'] = $this->input->post('lead_source_id');
						$post['lead_status_id'] = $this->input->post('lead_status_id');
						$post['organization'] = $this->input->post('organization');
						$post['contact_name'] = $this->input->post('contact_name');
						$post['email'] = $this->input->post('email');
						$post['designation'] = $this->input->post('designation');
						$post['mobile'] = $this->input->post('mobile');
						$post['city'] = $this->input->post('city');
						$post['country'] = $this->input->post('country_id');
						$post['state'] = $this->input->post('state_id');
						$post['address'] = $this->input->post('address');
						$post['skype'] = $this->input->post('skype');
						$post['facebook'] = $this->input->post('facebook');
						$post['twitter'] = $this->input->post('twitter');
						$post['permission'] = $this->input->post('permission');
						$post['notes'] = $this->input->post('notes');
						$leads_id =  $this->leads_model->addLeads($post);

						if($leads_id)
						{	
							if($post['permission'] == '0')
							{
								$permission_arr = $this->input->post('assigned_to');
								if(sizeof($permission_arr) > 0)
								{	
									for ($i=0; $i < count($permission_arr) ; $i++) 
									{										
										$post_permission['leads_id'] = $leads_id;
										$post_permission['user_id'] = $permission_arr[$i];
										$post_permission['permission_view'] = $this->input->post('view_'.$permission_arr[$i]);
										$post_permission['permission_edit'] = $this->input->post('edit_'.$permission_arr[$i]);
										$post_permission['permission_delete'] = $this->input->post('delete_'.$permission_arr[$i]);
										$post_permission['others_permission_status'] = 1;
										$post_permission['others_permission_created_date'] = date('Y-m-d');
										$post_permission['others_permission_update_date'] = date('Y-m-d');
										$this->leads_model->addLeadsPermission($post_permission);
									}								
								}
								
							}	
							if(isset($_POST['other_contact_name']) && !empty($_POST['other_contact_name']))
							{
								$other_contact_name = $this->input->post('other_contact_name');
								$other_email = $this->input->post('other_email');
								$other_designation = $this->input->post('other_designation');
								$other_mobile = $this->input->post('other_mobile');
								for ($i=0; $i < count($other_contact_name); $i++) 
								{ 
									$oc_post['leads_id'] = $leads_id;
									$oc_post['contact_person_name'] = $other_contact_name[$i];
									$oc_post['contact_person_email'] = $other_contact_name[$i];
									$oc_post['contact_person_designation'] = $other_contact_name[$i];
									$oc_post['contact_person_mobile'] = $other_contact_name[$i];
									$this->leads_model->addLeadsCotactDetails($oc_post);
								}
							}			
							$msg = 'Leads added successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'leads');
						}
					}
					else
					{				
						
					$this->data['role_list'] = $this->leads_model->getRoleList();
					$this->data['lead_status'] = $this->leads_model->getALLleadsStatusList();
					$this->data['country_list'] = $this->leads_model->getCountryList();
					$this->data['leads_source'] = $this->leads_model->getALLleadsSourceList();
					$this->data['client_list'] = $this->leads_model->getClientList();
					$this->data['all_users_list'] = $this->leads_model->getAllUsersList();				
					$this->show_view_admin('leads/leads_add', $this->data);
					}		
				}
				else
				{
					
					$this->data['role_list'] = $this->leads_model->getRoleList();
					$this->data['lead_status'] = $this->leads_model->getALLleadsStatusList();
					$this->data['country_list'] = $this->leads_model->getCountryList();
					$this->data['leads_source'] = $this->leads_model->getALLleadsSourceList();
					$this->data['client_list'] = $this->leads_model->getClientList();
					$this->data['all_users_list'] = $this->leads_model->getAllUsersList();
					$this->show_view_admin('leads/leads_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'dashboard/error/1');
			}
		}		
	}
	
	/* Delete */
	public function deleteleads()
	{
		if($this->checkDeletePermission())
		{
			$leads_id = $this->uri->segment(3);	
			$this->leads_model->deleteleads($leads_id);
			
				$msg = 'leads remove successfully...!';					
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'leads');			
		}
		else
		{
			redirect( base_url().'dashboard/error/1');
		}		
	}

	//###### Opportunity Process Section Start ###########

	public function addLeadsProcess()
	{
		$this->session->unset_userdata('leads_process');
		if(isset($_POST['submit']) && $_POST['submit'] != '')
		{
			$post['leads_id'] = $this->input->post('leads_id');
			$post['leads_process_date'] = $this->input->post('leads_process_date');
			$post['leads_process_type'] = $this->input->post('leads_process_type');
			$this->session->set_userdata('leads_process',$post);	
			redirect(base_url().'leads/leadsProcessDetails');			
		}
		else
		{
			redirect(base_url().'leads');
		}

	}

	public function leadsProcessDetails()
	{		

		if(isset($_POST['Submit']) && $_POST['Submit'] == 'Add' )
		{
			$leads_process_data = $this->session->userdata('leads_process');

			// If Leads Move In Opportunity
			if(isset($_POST['move_to_opportunity']) && $_POST['move_to_opportunity'] == 'move')
			{
				
				//##### Update Leads Opportunity Status ##########
				$o_post['stages'] = $this->input->post('stages');
				$o_post['opportunities_state_reason_id'] = $this->input->post('opportunities_state_reason_id');
				$o_post['close_date'] = $this->input->post('close_date');
				$o_post['expected_revenue'] = $this->input->post('expected_revenue');
				$o_post['new_link'] = $this->input->post('new_link');
				$o_post['lead_status_id'] = $this->input->post('lead_status_id');
				$o_post['opportunity_status'] = '1';
				$update_res = $this->leads_model->UpdateLeadsOpportunityStatus($leads_process_data['leads_id'],$o_post);
				if($update_res)
				{
					$op_post['opportunities_id'] = $leads_process_data['leads_id'];
					$op_post['opportunities_process_date'] = $leads_process_data['leads_process_date'];
					$op_post['opportunities_process_type'] = $leads_process_data['leads_process_type'];
					$op_post['opportunities_process_status'] = '1';
					$op_post['opportunities_process_created_date'] = date('Y-m-d');
					$process_id = $this->opportunities_model->addOpportunitiesProcess($op_post);
					if($process_id)
					{
						$post['opportunities_process_id'] = $process_id;
						$post['meeting_minutes'] = $this->input->post('meeting_minutes');
						$post['response_levels'] = $this->input->post('response_levels');
						$post['next_meeting_call'] = $this->input->post('next_meeting_call');
						$post['to_do_list'] = $this->input->post('to_do_list');
						$post['next_meeting_date'] = $this->input->post('next_meeting_date');
						$post['next_meeting_time'] = $this->input->post('next_meeting_time');
						$post['sample_request'] = $this->input->post('sample_request');
						$post['quote_request'] = $this->input->post('quote_request');
					}
					$process_details_id = $this->opportunities_model->addOpportunitiesProcessDetails($post);
					if($process_details_id)
					{
						
						for ($i=0; $i < count($product_details_array); $i++) 
						{ 
							$p_post['product_details'] = $product_details_array[$i];
							// echo "<pre>";
							// print_r($p_post['product_details']); die();
							$p_post['opportunities_process_detail_id'] = $process_details_id;
							$opportunities_product_id = $this->opportunities_model->addOpportunitiesProducts($p_post);
							if($opportunities_product_id)
							{
								/**** ADD MULTIPLE HOME TEMPLATE IMAGES *******/
								if($_FILES["product_img_file_".$i]['name'])
								{							
									$prod_files_array = $_FILES["product_img_file_".$i]["name"];
									for($k = 0; $k < count($prod_files_array); $k++)
									{	
										$_FILES['new_file']['name'] = $_FILES['product_img_file_'.$i]['name'][$k];
										$_FILES['new_file']['type'] = $_FILES['product_img_file_'.$i]['type'][$k];
						                $_FILES['new_file']['tmp_name'] = $_FILES['product_img_file_'.$i]['tmp_name'][$k];
						                $_FILES['new_file']['error'] = $_FILES['product_img_file_'.$i]['error'][$k];
						                $_FILES['new_file']['size'] = $_FILES['product_img_file_'.$i]['size'][$k];
						              	$name = 'product_attech'.$i;
						              	$imagePath = 'webroot/upload/products/';
						               	$temp = explode(".",$_FILES['new_file']['name']);				
										$extension = end($temp);
										$filenew =  date('d-M-Y').'_'.str_replace($_FILES['new_file']['name'],$name,$_FILES['new_file']['name']).'_'.time().''.rand(). "." .$extension;  		
										$config['file_name'] = $filenew;
										$config['upload_path'] = $imagePath;
									    //$config['allowed_types'] = 'GIF | gif | JPE | jpe | JPEG | jpeg | JPG | jpg | PNG | png | odt | pdf | sql | doc ';
										$this->upload->initialize($config);
										$this->upload->set_allowed_types('*');
										$this->upload->set_filename($config['upload_path'],$filenew);						
										if(!$this->upload->do_upload('new_file'))
										{
											$data = array('msg' => $this->upload->display_errors());
										}
										else 
										{ 
											$data = $this->upload->data();	
											$imageName = $data['file_name'];
										}
										if($imageName)
						              	{
						                   	$post_img['product_img_file'] = $imagePath.''.$imageName;
											$post_img['opportunities_product_id'] =  $opportunities_product_id;	
											$this->opportunities_model->addOpportunitiesProductFileImg($post_img);
						              	}

									} // END FOR LOOP							

								} // CHECK GALLERY IMAGE IS EXIST

							}//product detail if

						}
						$this->session->unset_userdata('leads_process');
						redirect(base_url().'leads');
					}
				}
				
			}
			else
			{
				$this->form_validation->set_rules($this->validation_rules['leadsProcessAdd']);
				if($this->form_validation->run())
				{	
					$o_post['lead_status_id'] = $this->input->post('lead_status_id');				
					$update_res = $this->leads_model->UpdateLeadsOpportunityStatus($leads_process_data['leads_id'],$o_post);
					if($update_res)
					{
						$op_post['leads_id'] = $leads_process_data['leads_id'];
						$op_post['leads_process_date'] = $leads_process_data['leads_process_date'];
						$op_post['leads_process_type'] = $leads_process_data['leads_process_type'];
						$op_post['leads_process_status'] = '1';
						$op_post['leads_process_created_date'] = date('Y-m-d');
						$process_id = $this->leads_model->addLeadsProcess($op_post);
						if($process_id)
						{
							$post['leads_process_id'] = $process_id;
							$post['meeting_minutes'] = $this->input->post('meeting_minutes');
							$post['response_levels'] = $this->input->post('response_levels');
							$post['next_meeting_call'] = $this->input->post('next_meeting_call');
							$post['to_do_list'] = $this->input->post('to_do_list');
							$post['next_meeting_date'] = $this->input->post('next_meeting_date');
							$post['next_meeting_time'] = $this->input->post('next_meeting_time');
							$post['sample_request'] = $this->input->post('sample_request');
							$post['quote_request'] = $this->input->post('quote_request');
						}	

						$process_details_id = $this->leads_model->addLeadsProcessDetails($post);
						if($process_details_id)
						{
							
							$product_details_array = $this->input->post('product_details');
							for ($i=0; $i < count($product_details_array); $i++) 
							{ 
								$p_post['product_details'] = $product_details_array[$i];
								$p_post['leads_process_detail_id'] = $process_details_id;
								// echo "<pre>"; print_r($p_post); die();
								$leads_product_id = $this->leads_model->addLeadsProducts($p_post);
								if($leads_product_id)
								{
									/**** ADD MULTIPLE HOME TEMPLATE IMAGES *******/
									if($_FILES["product_img_file_".$i]['name'])
									{							
										$prod_files_array = $_FILES["product_img_file_".$i]["name"];
										for($k = 0; $k < count($prod_files_array); $k++)
										{	
											$_FILES['new_file']['name'] = $_FILES['product_img_file_'.$i]['name'][$k];
											$_FILES['new_file']['type'] = $_FILES['product_img_file_'.$i]['type'][$k];
							                $_FILES['new_file']['tmp_name'] = $_FILES['product_img_file_'.$i]['tmp_name'][$k];
							                $_FILES['new_file']['error'] = $_FILES['product_img_file_'.$i]['error'][$k];
							                $_FILES['new_file']['size'] = $_FILES['product_img_file_'.$i]['size'][$k];
							              	$name = 'product_attech'.$i;
							              	$imagePath = 'webroot/upload/products/';
							               	$temp = explode(".",$_FILES['new_file']['name']);				
											$extension = end($temp);
											$filenew =  date('d-M-Y').'_'.str_replace($_FILES['new_file']['name'],$name,$_FILES['new_file']['name']).'_'.time().''.rand(). "." .$extension;  		
											$config['file_name'] = $filenew;
											$config['upload_path'] = $imagePath;
										    //$config['allowed_types'] = 'GIF | gif | JPE | jpe | JPEG | jpeg | JPG | jpg | PNG | png | odt | pdf | sql | doc ';
											$this->upload->initialize($config);
											$this->upload->set_allowed_types('*');
											$this->upload->set_filename($config['upload_path'],$filenew);						
											if(!$this->upload->do_upload('new_file'))
											{
												$data = array('msg' => $this->upload->display_errors());
											}
											else 
											{ 
												$data = $this->upload->data();	
												$imageName = $data['file_name'];
											}
											if($imageName)
							              	{
							                   	$post_img['product_img_file'] = $imagePath.''.$imageName;
												$post_img['leads_product_id'] =  $leads_product_id;	
												$this->leads_model->addLeadsProductFileImg($post_img);
							              	}

										} // END FOR LOOP							

									} // CHECK GALLERY IMAGE IS EXIST

								}//product detail if

							}
							$this->session->unset_userdata('leads_process');
							redirect(base_url().'leads');
						}
					}
				}
				else
				{
					$this->data['lead_status'] = $this->leads_model->getALLleadsStatusList();
					$this->data['process_list'] = $this->leads_model->getAllleadsProcessList();
					$this->data['opp_reson_states'] = $this->opportunities_model->getALLOpportunitiesStateList();
					$this->data['advance_data_tbl'] = '1';
					$this->show_view_admin('leads/leads_process_details',$this->data);
				}
			}
		}
		else
		{
			$this->data['lead_status'] = $this->leads_model->getALLleadsStatusList();
			$this->data['process_list'] = $this->leads_model->getAllleadsProcessList();
			$this->data['opp_reson_states'] = $this->opportunities_model->getALLOpportunitiesStateList();
			$this->data['advance_data_tbl'] = '1';
			$this->show_view_admin('leads/leads_process_details',$this->data);
		}
	}

	public function processDetails($leads_id = '')
	{
		if($leads_id)
		{
			$this->data['process_details'] = $this->leads_model->getProcessById($leads_id);			
			$this->show_view_admin('leads/view_process',$this->data);	
		}
	}

	public function viewProcessDetails($process_id = '')
	{
		if($process_id)
		{
			$this->data['process_details'] = $this->leads_model->getProcessDtailsById($process_id);
			$this->show_view_admin('leads/view_process_details',$this->data);	
		}
		else
		{
			redirect(base_url().'leads');
		}
	}

	/* Get State List */
	public function getStateList()
	{
		$country_id = $this->input->post('country_id');
		$state_list = $this->leads_model->getStateListByCountryId($country_id);

		$html = '';
		if(count($state_list) > 0)
		{
			foreach ($state_list as $s_list) 
			{
				$html .= '<option value="'.$s_list->state_id.'">'.$s_list->state_name.'</option>';
			}
			
			echo $html; 
		}
		else
		{
			echo $html;
		}
	}

	function changeLeadStatus($lead_status = '',$leads_id='')
	{
		if($lead_status != '' && $leads_id != '')
		{
			$change_status = $this->leads_model->changeLeadStatus($lead_status,$leads_id);
			if($change_status)
			{
				redirect(base_url().'leads');
			}

		}
	}

}
/* End of file */?>