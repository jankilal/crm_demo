 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Leads extends MY_Controller 
{
	function __construct()
	{
		parent:: __construct();
		$this->load->model('leads_model');
		$this->load->model('opportunities_model');
	}

	protected $validation_rules = array(
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
                'label' => 'Contact name',
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
			$this->data['lead_status']  = $this->leads_model->getALLleadsStatusList();
			$this->show_view_admin('leads/leads', $this->data);
		}
		else
		{	
			redirect(base_url().'dashboard/error/1');
		}
  	}

    public function loadLeadsData()
    {
    	$leads_result = $this->leads_model->getAllleads();  
    	$data = array();
    	foreach ($leads_result as $res) 
    	{	
    		$row = array();
			$row[] = $res->lead_name;
			$row[] = $res->organization;
			$row[] = $res->email;
			$row[] = $res->phone_number;
			$row[] = '<span class="label label-warning">'.$res->lead_type.'</span> '.$res->lead_status;
			if($res->current_status == 1)
			{
				$row[] = '<span style="font-size:12px;" class="label label-info">Lead</span>';
			}
			else if($res->current_status == 2)
			{
				$row[] = '<span style="font-size:12px;" class="label label-primary">Opportunities</span>';
			}
			if($res->lead_assign_status == 0)
			$row[]= '<span style="font-size:12px;" class="label label-danger">Unassign</span>';
			else
			$row[]= '<span style="font-size:12px;" class="label label-success">Assign</span>';

			$row[] = '<button data-id="'.$res->lead_id.'" class="btn  btn-sm loadMeeting" title="Add meeting"><i class="fa fa-plus fa-2x"></i></button><?td>';
			//button add and view
			if($res->current_status == 1)
			{
				$row[] = '<td><button onclick="save_leads_id(this)" data-id="'.$res->lead_id.'" class="btn  btn-sm" title="Add"><i class="fa fa-plus fa-2x"></i></button></td>';
			}
			else if($res->current_status == 2)
			{
				$row[] = '<td><a href="'.base_url().'leads/processDetail/'.$res->lead_id.'" title="View"><i class="fa fa-eye fa-2x "></i></a>
					</td>';
			}
			$row[]= '<td><a href="'.base_url().'leads/addLead/'.$res->lead_id.'" title="Edit"><i class="fa fa-edit fa-2x "></i></a><a href="'.base_url().'leads/viewlead/'.$res->lead_id.'" title="View"><i class="fa fa-eye fa-2x "></i></a></td>';
			$data[] = $row;
		}	
		 $output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => sizeof($data),
			"recordsFiltered" => $this->leads_model->count_filtered(),
			"data" => $data,
		);
       	//output to json format
       	echo json_encode($output);

		//pagination configuration
    }

    public function loadMeetingData()
    {
    	if(isset($_POST['lead_id']))
    	{
    		$meeting_result = $this->leads_model->getMeetingByLead($_POST['lead_id']);
			if (!empty($meeting_result)) 
	    	{	
				$i =1;
				foreach ($meeting_result as $res) 
				{
					?>
					<tr>
						<td><?= $i; ?></td>
						<td><?= $res->lm_date; ?></td>
						<td><?= $res->lm_time; ?></td>
					</tr>
					<?php
					$i++;
				}
			}
    	}
    }

    public function loadProcessData()
    {
    	if(isset($_POST['lead_id']))
    	{
    		$meetings_result = $this->comman_model->getData('tbl_lead_meeting', array('lead_id' => $_POST['lead_id']));
    	    if (!empty($meetings_result)) 
	    	{	
				$i =1;
				foreach ($meetings_result as $res) 
				{
					?>
					<option value="<?= $res->lm_id?>"><?= $res->lm_date.'       '.$res->lm_time;?></option>
					<?php
					$i++;
				}
			}
	    }
	}

	public function addNewMeeting()
    {
    	if(isset($_POST['submit']) && $_POST['submit'] == 'Submit')
    	{
    		$post['lm_id']        = round(microtime(true) * 1000);
    		$post['lead_id']      = $this->input->post('lead_id');
    		$post['lm_date']      = $this->input->post('metting_date');
    		$post['lm_time']      = $this->input->post('metting_time');
			$id = $this->comman_model->addData('tbl_lead_meeting', $post);
			$meeting_result = $this->leads_model->getMeetingByLead($_POST['lead_id']);
			if (!empty($meeting_result)) 
	    	{	
				$i =1;
				foreach ($meeting_result as $res) 
				{
					?>
					<tr>
						<td><?= $i; ?></td>
						<td><?= $res->lm_date; ?></td>
						<td><?= $res->lm_time; ?></td>
					</tr>
					<?php
					$i++;
				}
			}    		
		}
    }

	//###### Opportunity Process Section Start ###########
    public function addleadsProcess()
    {
    	$this->session->unset_userdata('leads_process');
   		
        if(isset($_POST['submit']) && $_POST['submit'] != '')
    	{
    		if(isset($_POST['meeting_check']) && $_POST['meeting_check'] == 'check')
    		{
	    		$post['leads_Metting']     	  = $this->input->post('leads_Metting');
    		}
    		else
    		{
    			$post['leads_Metting'] = 0;
    		}

			$post['leads_process_id'] 	  = round(microtime(true) * 1000);
    		$post['lead_id']              = $this->input->post('lead_id');;
    		$post['leads_process_date']   = $this->input->post('leads_process_date');
    		$post['leads_process_type']   = $this->input->post('leads_process_type');
    		$post['status']				  = '1';
    	   	
    		$this->session->set_userdata('leads_process' , $post);
    		redirect(base_url().'leads/leadsProcessDetails');
    	}
    	else
    	{
    		$this->session->set_userdata('leads_process' , $post);
    	}
    }

    public function loadSendQuotation()
    {
    	$this->load->view('leads/send_quotation_view');
    }

  	public function leadsProcessDetails()
	{
		$leads_process_data = $this->session->userdata('leads_process');
		if (!empty($leads_process_data)) 
		{
			$lead_id = $leads_process_data['lead_id'];
			$lead_details = $this->comman_model->getData('tbl_leads', array('lead_id'=>$lead_id), 'single');
			
			//################# Add Process Details #################
			if(isset($_POST['Submit']) && $_POST['Submit'] == 'Add' )
			{
				//######### Send & Add Quote Details In DataBase #########
				if(isset($_POST['send_quote']) && $_POST['send_quote'] == 'Send')
				{
					$quote_arr = array();
					$quote_product_arr = array();
					$q_post['quote_id']		    =  round(microtime(true) * 1000);
					$q_post['lead_id']		    =  $lead_id;
					$q_post['quote_to']		  	= $this->input->post('quote_to');
					$q_post['address1'] 	    = $this->input->post('qt_address1');
					$q_post['address2'] 	  	= $this->input->post('qt_address2');
					$q_post['location'] 	   	= $this->input->post('qt_location');
					$q_post['city'] 	 	  	= $this->input->post('qt_city');
					$q_post['subject'] 	 	  	= $this->input->post('qt_subject');
					$q_post['additional_req'] 	= $this->input->post('additional_req');
					$q_post['terms_conditions'] = $this->input->post('termsConditions');
					$q_post['submition_date'] 	= date('Y-m-d H:i:s');
					
					$last_result = $this->comman_model->getData('tbl_quotation' , NULL, 'single', 'DESC' ,1);
					if (!empty($last_result)) 
					{
						$q_post['quote_name'] 		= $lead_details->organization.'-'.'V'.$last_result->id;
						$q_post['quote_version'] 	='V'.$last_result->id;
					}
					else
					{
						$q_post['quote_name'] = $lead_details->organization.'-'.'V1';
						$q_post['quote_version'] = 'V1';
					}
					$quote_arr = $q_post;

					$c_post 	     = commanPostArray('create');
					$add_post  		 = array_merge($q_post,$c_post);
					$quote_id= $this->comman_model->addData('tbl_quotation', $add_post);
					
					$qt_total = 0;
					//############# Add Quote Product ###############
					if(isset($_POST['selected_products']) && !empty($_POST['selected_products']))
					{
						$qp_product_id   =  $this->input->post('selected_products');
						$qp_product_name = $this->input->post('qp_product_name');
						$qp_product_des = $this->input->post('qp_product_des');
						$qp_product_qty  = $this->input->post('qp_product_qty');
						$qp_product_price= $this->input->post('qp_product_price');
						for($i=0; $i<count($_POST['selected_products']); $i++)
						{
							$qp_post['quote_poroduct_id'] = $this->generate_id();
							$qp_post['quote_id']	      = $q_post['quote_id'];
							$qp_post['product_id']	      = $qp_product_id[$i];
							$qp_post['product_name']   	  = $qp_product_name[$i];
							$qp_post['product_desc']   	  = $qp_product_des[$i];
							$qp_post['product_price']  	  = $qp_product_price[$i];
							$qp_post['product_qty']  	  = $qp_product_qty[$i];
							$quote_product_arr[] = $qp_post;
							$c_post 	= commanPostArray('create');
							$add_post  	= array_merge($qp_post,$c_post);
							$qt_total = $qt_total+($qp_post['product_price']*$qp_product_qty[$i]);
							$this->comman_model->addData('tbl_quotation_products', $add_post);
						}
					}
					$this->comman_model->updateData('tbl_quotation' , array('id' => $quote_id) , array('quote_subtotal' => $qt_total));
					$data['company_details']   = $this->comman_model->getData('tbl_company' , NULL , 'single');
					$data['quote_data'] = array_merge($quote_arr,array('quote_products' => $quote_product_arr));

					$quote_mail = $this->load->view('leads/quote_email_template' , $data , true);
					$email_to = $quote_arr['quote_to'];
					$subject = 'Quotation Form';
					$this->send_mail($email_to,$subject,$quote_mail);
				}
				//######### Send & Add Quote Details Section End #########
				if(isset($_POST['move_to_opportunity']) && $_POST['move_to_opportunity'] == 'move')
				{
					$o_post['stages']                        = $this->input->post('stages');
					$o_post['opportunities_state_reason_id'] = $this->input->post('opportunities_state_reason_id');
					$o_post['close_date']                    = $this->input->post('close_date');
					$o_post['expected_revenue']              = $this->input->post('expected_revenue');
					$o_post['new_link']                      = $this->input->post('new_link');
					$o_post['lead_status_id']                = $this->input->post('lead_status_id');
					$o_post['opportunity_status']            = '1';
					$o_post['current_status']                = '2';
					$items_list = array();
					$check_items = json_decode($_POST['product_id_array']);
					if(sizeof($check_items) > 0 && !empty($check_items))
					{
						$process_products = json_decode($_POST['product_id_array']);
						$items_list = $this->comman_model->getDataV2('tbl_items' , 'where_in' , array('item_id' => $process_products));
					}

					$update_res = $this->leads_model->UpdateLeadsOpportunityStatus($leads_process_data['lead_id'],$o_post);
					if($update_res)
					{
						//##################### Add Opportunities Details #####################
						$opor_post['opportunities_id']  		      =	$leads_process_data['lead_id'];
						$opor_post['opportunity_name']   			  =	$lead_details->lead_name;
						$opor_post['stages'] 					      =	$this->input->post('stages');
						$opor_post['probability']  			     	  =	$this->input->post('response_levels');
						$opor_post['close_date']  			  	      =	date('Y-m-d');
					    $opor_post['opportunities_state_reason_id']   = $this->input->post('opportunities_state_reason_id');
						$opor_post['expected_revenue']  		      =	$this->input->post('expected_revenue');
						$opor_post['new_link']  				      =	$this->input->post('new_link');
						$opor_post['next_action']  			          =	$this->input->post('next_meeting_call');
						$opor_post['next_action_date']  		      =	$this->input->post('next_meeting_date');
						$opor_post['create_date'] 		   		      = date('Y-m-d');
						$opor_post['update_date'] 		   		      = date('Y-m-d');
						$this->comman_model->addData('tbl_opportunities', $opor_post);

						//################ Add Opportunities Process ###################
						$op_post['opportunities_process_id']    = $leads_process_data['leads_process_id'];
						$op_post['opportunities_id']           	= $leads_process_data['lead_id'];
						$op_post['opportunities_process_date'] 	= $leads_process_data['leads_process_date'];
						$op_post['opportunities_process_type'] 	= $leads_process_data['leads_process_type'];
						$op_post['opportunities_process_status']= '1';
						$op_post['opportunities_process_created_date']= date('Y-m-d');
						$process_id = $this->comman_model->addData('tbl_opportunities_process' , $op_post);
						if($process_id)
						{
							//################ Add Opportunities Process Details ###################
						   	$post['opportunities_process_details_id']   = round(microtime(true) * 1000);
							$post['opportunities_process_id']   = $op_post['opportunities_process_id'];
							$post['meeting_minutes'] 		    = $this->input->post('meeting_minutes');
							$post['response_levels'] 		    = $this->input->post('response_levels');
							$post['next_meeting_call'] 		    = $this->input->post('next_meeting_call');
							$post['to_do_list'] 		        = $this->input->post('to_do_list');
							$post['next_meeting_date'] 		    = $this->input->post('next_meeting_date');
							$post['next_meeting_time'] 	        = $this->input->post('next_meeting_time');
							$post['sample_request'] 		    = $this->input->post('sample_request');
							$post['quote_request'] 		        = $this->input->post('quote_request');

							$process_details_id = $this->opportunities_model->addOpportunitiesProcessDetails($post);
							if($process_details_id)
							{
								//############ Add Opportunities Product ###########
								if(!empty($items_list))
								{
									foreach ($items_list as $value) 
									{
										$p_post['lead_product_id'] 			= $this->generate_id();
										$p_post['product_type']		   		= 'opportunitie_process';
										$p_post['lead_id']					= $leads_process_data['lead_id'];
										$p_post['opportunity_process_id']   = $process_details_id;
										$p_post['product_id'] 		   		= $value->item_id;
										$p_post['product_name'] 	   		= $value->item_name;
										$p_post['product_price'] 	   		= $value->unit_cost;
										$p_post['product_desc'] 	   		= $value->item_desc;
										$p_post['lead_product_status'] 		= 1;
										$p_post['create_date'] 		   		= date('Y-m-d');
										$p_post['update_date'] 		   		= date('Y-m-d');
										$leads_product_id = $this->comman_model->addData('tbl_lead_product' , $p_post);
									}
								}

								$this->session->unset_userdata('leads_process');
								$msg = 'Lead process added successfully.';
								$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
								redirect('leads');
							}
							else
							{
								$msg = 'Oops! Something went wrong.';
								$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
								redirect($_SERVER['HTTP_REFERER']);
							}
						}
						else
						{
							$msg = 'Oops! Something went wrong.';
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect($_SERVER['HTTP_REFERER']);
						}
					}
					else
					{
						$msg = 'Oops! Something went wrong.';
						$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect($_SERVER['HTTP_REFERER']);
					}
				}
				else
				{
					$items_list = array();
					$check_items = json_decode($_POST['product_id_array']);
					if(sizeof($check_items) > 0 && !empty($check_items))
					{
						$process_products = json_decode($_POST['product_id_array']);
						$items_list = $this->comman_model->getDataV2('tbl_items' , 'where_in' , array('item_id' => $process_products));
					}

					$update_res = $this->comman_model->updateData('tbl_leads' , array('lead_id' => $leads_process_data['lead_id']) , array('lead_status_id' => $_POST['lead_status_id']));
					if($update_res)
					{
						//################ Add Process Details In DataBase ##################
						$op_post['leads_process_id']   	= $leads_process_data['leads_process_id'];
						$op_post['lead_id'] 		   	= $leads_process_data['lead_id'];
						$op_post['leads_process_date'] 	= $leads_process_data['leads_process_date'];
						$op_post['leads_process_type'] 	= $leads_process_data['leads_process_type'];
						$op_post['leads_process_status']= '1';
						$op_post['create_date'] 	    = date('Y-m-d');
						$op_post['meeting']   			= $leads_process_data['leads_Metting'];
						$process_id= $this->comman_model->AddData('tbl_leads_process' , $op_post);
						if($process_id)
						{
							//######### Add Process Details Section Start ###########
							$post['leads_process_details_id']=round(microtime(true) * 1000);
							$post['leads_process_id']   = $op_post['leads_process_id'];
							$post['meeting_minutes']    = $this->input->post('meeting_minutes');
							$post['response_levels']    = $this->input->post('response_levels');
							$post['next_meeting_call']  = $this->input->post('next_meeting_call');
							$post['to_do_list']         = $this->input->post('to_do_list');
							$post['next_meeting_date']  = $this->input->post('next_meeting_date');
							$post['next_meeting_time']  = $this->input->post('next_meeting_time');
							$post['sample_request']     = $this->input->post('sample_request');
							$post['quote_request']      = $this->input->post('quote_request');
							$process_details_id = $this->comman_model->AddData('tbl_leads_process_details' , $post);
							if($process_details_id)
							{
								if(!empty($items_list))
								{
									foreach ($items_list as $value) 
									{
										$checkProduct = $this->comman_model->getData('tbl_lead_product' , array('lead_id' => $leads_process_data['lead_id'] , 'product_id' => $value->item_id));
										if(empty($checkProduct))
										{	
											$p_post['lead_product_id'] = round(microtime(true) * 1000);
											$p_post['product_type']		   = 'lead_process';
											$p_post['lead_id'] 	   		   = $leads_process_data['lead_id'];
											$p_post['lead_process_id'] 	   = $op_post['leads_process_id'] ;
											$p_post['product_id'] 		   = $value->item_id;
											$p_post['product_name'] 	   = $value->item_name;
											$p_post['product_price'] 	   = $value->unit_cost;
											$p_post['product_desc'] 	   = $value->item_desc;
											$p_post['lead_product_status'] = 1;
											$p_post['create_date'] 		   = date('Y-m-d');
											$p_post['update_date'] 		   = date('Y-m-d');
											$leads_product_id = $this->comman_model->addData('tbl_lead_product' , $p_post);
										}
									}
								}
								$this->session->unset_userdata('leads_process');
								$msg = 'Lead process added successfully.';
								$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
								redirect('leads');
							}
							else
							{
								$msg = 'Oops! Something went wrong.';
								$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
								redirect($_SERVER['HTTP_REFERER']);
							}
						}
						else
						{
							$msg = 'Oops! Something went wrong.';
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect($_SERVER['HTTP_REFERER']);
						}
					}
					else
					{
						redirect($_SERVER['HTTP_REFERER']);
					}
				}
				redirect($_SERVER['HTTP_REFERER']);
			}
			else
			{
			   $this->data['lead_status']     = $this->leads_model->getALLleadsStatusList();
			   $this->data['lead_source']     = $this->leads_model->getALLleadsSourceList();
			   $this->data['process_list']    = $this->leads_model->getAllleadsProcessList($lead_id);
			   
			   $this->data['opp_reson_states']= $this->opportunities_model->getALLOpportunitiesStateList();
			   $this->data['advance_data_tbl']= '1';
			   $this->data['lead_id']		  = $lead_id;

			   $this->data['leads_products']   = $this->comman_model->getData('tbl_lead_product' , array('lead_id' => $lead_id));
			   $this->data['company_details']   = $this->comman_model->getData('tbl_company' , NULL , 'single');
			   $this->data['send_quote_detail']= $this->comman_model->getData('tbl_leads' , array('lead_id'=>$lead_id) , 'single');   

			   $this->data['quotation_detail'] = $this->comman_model->getData('tbl_quotation', array('lead_id'=>$lead_id));
			   $this->show_view_admin('leads/leads_process_details',$this->data);
			}
		}
	}

	public function viewProcessDetails($lead_id='')
	{
		if ($lead_id) 
		{	
			$this->data['process_details'] = $this->leads_model->getProcessDtailsById($lead_id);
			$this->data['products_details'] = $this->leads_model->getProductDetailById($lead_id);
			$this->show_view_admin('leads/view_process_details',$this->data);
		}
		else
		{
			 redirect('leads');
		}
	}

	public function viewProductDetails($product_id='')
	{
		if ($product_id) 
		{
			$this->show_view_admin('leads/view_process_details',$this->data);
		}
	}

	public function getLastQuoteNo($lead_id)
	{
		$last_result = $this->comman_model->getData('tbl_quotation' , NULL, 'single', 'DESC' ,1);
		$lead_details = $this->comman_model->getData('tbl_leads', array('lead_id'=>$lead_id), 'single');
		if (!empty($last_result)) 
		{
			$q_post['quote_name'] 		= $lead_details->organization.'-'.'V'.$last_result->id;
			$q_post['quote_version'] 	='V'.$last_result->id;
		}
		else
		{
			$q_post['quote_name'] = $lead_details->organization.'-'.'V1';
			$q_post['quote_version'] = 'V1';
		}
		echo json_encode($q_post);
	}

	public function massConvert()
	{
  		if($this->checkViewPermission())
		{			
			$this->data['leads_result'] = $this->leads_model->getAllleads();
			$this->data['lead_status'] = $this->leads_model->getALLleadsStatusList();
			$this->show_view_admin('leads/mass_convert', $this->data);
		}
		else
		 redirect(base_url().'dashboard/error/1');
	}

	public function massAssign()
   	{
    	if($this->checkViewPermission())
		{			
			if(isset($_POST['search_leads']) && $_POST['search_leads'] == 'Search Leads')
			{
				$postData = $this->input->post();
				$data['user_list'] = $this->comman_model->getData('tbl_user' , array('user_role_id' => 3 , 'user_type' => 'Employee'));
				$data['leads_result'] = $this->leads_model->searchLeadsForAssign($postData);
				$this->load->view('leads/founded_assign_leads_view' , $data);
			}
			else if(isset($_POST['assign_leads']) && $_POST['assign_leads'] == 'Assign Leads')
			{
				if(isset($_POST['assign_to']) && $_POST['assign_to'] && isset($_POST['selected_leads']) && !empty($_POST['selected_leads']))
				{
					$postData = $this->input->post();

					foreach ($postData['selected_leads'] as $id) 
					{
						$post['assign_id'] = $this->generate_id();
						$post['lead_id'] = $id;
						$post['user_id'] = $postData['assign_to'];
						$post['assign_date_time'] = date('Y-m-d H:i:s');
						$post['assign_by'] = login_user;
						$add_res = $this->comman_model->addData('tbl_assign_user' , $post);
						if($add_res)
						{
							$this->comman_model->updateData('tbl_leads' , array('lead_id' => $id) , array('lead_assign_status' => '1'));
							$msg = 'Leads successfully assigned.';
							$this->session->set_flashdata('message', '<div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div>');
						}
					}
					redirect('leads');
				}
				else
				{
					$msg = 'Something went wrong.';
					$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
					redirect('leads/massAssign');
				}
			}
			else
			{
				$this->data['leads_result'] = $this->leads_model->getAllleads();
				$this->data['lead_status'] = $this->leads_model->getALLleadsStatusList();
				$this->show_view_admin('leads/assign_leads_view', $this->data);
			}
		}
		else
		redirect(base_url().'dashboard/error/1');
	}

    /* Add and Update */
	public function addLead($leads_id = '')
	{
		if($this->checkAddPermission())
		{
			if (isset($_POST['action_add_lead']) && $_POST['action_add_lead'] == 'Add Lead') 
			{
				$post['lead_name'] 			= $this->input->post('lead_name');
				$post['lead_source_id'] 	= $this->input->post('lead_source_id');
				$post['lead_status_id'] 	= $this->input->post('lead_status_id');
				$post['organization'] 		= $this->input->post('organization');
				$post['salutation'] 		= $this->input->post('salutation');
				$post['name'] 				= $this->input->post('name');
				$post['email'] 				= $this->input->post('email');
				$post['sec_email'] 			= $this->input->post('sec_email');
				$post['designation'] 	    = $this->input->post('designation');
				$post['notes'] 	    		= $this->input->post('notes');
				$post['phone_number'] 		= $this->input->post('phone_number');
				$post['website'] 		    = $this->input->post('website');
				$post['mobile_number'] 		= $this->input->post('mobile_number');
				$post['industry'] 		    = $this->input->post('industry');
				$post['skype'] 			    = $this->input->post('skype');
				$post['facebook']           = $this->input->post('facebook');
				$post['twitter'] 		    = $this->input->post('twitter');
				$post['secondary_email'] 	= $this->input->post('secondary_email');
				$post['annual_revenue'] 	= $this->input->post('annual_revenue');
				$post['email_opt_out'] 		= $this->input->post('email_opt_out');
				$post['country'] 			= $this->input->post('country_id');
				$post['state'] 			    = $this->input->post('state_id');
				$post['city'] 			  	= $this->input->post('city');
				$post['zip_code'] 		    = $this->input->post('zip_code');
				$post['address'] 			= $this->input->post('address');
				$post['lead_status'] 		= 1;
				if($leads_id == '')
				{
					$post['lead_id'] 		= round(microtime(true) * 1000);
					$c_post 			    = commanPostArray('create');
					$add_post  				= array_merge($post,$c_post);
					$lead_res 				= $this->comman_model->addData('tbl_leads' , $add_post);
				
					if($lead_res)
					{
						$lead_products = json_decode($this->input->post('selected_products'));
						if(sizeof($lead_products) > 0)
						{
							$products_list = $this->comman_model->getDataV2('tbl_items' , 'where_in' , array('item_id' => $lead_products));
							if(!empty($products_list))
							{
								foreach ($products_list as $lp_res) 
								{
									$lp_post['lead_product_id'] = round(microtime(true) * 1000);
									$lp_post['lead_id'] 		   = $post['lead_id'];
									$lp_post['product_id'] 		   = $lp_res->item_id;
									$lp_post['product_type'] 	   = 'leads';
									$lp_post['product_name'] 	   = $lp_res->item_name;
									$lp_post['product_price']      = $lp_res->unit_cost;
									$lp_post['product_desc'] 	   = $lp_res->item_desc;
									$add_lp  				       = array_merge($lp_post,$c_post);
									$lead_res = $this->comman_model->addData('tbl_lead_product' , $add_lp);		
								} 
							}
						}
					}
				}
				else
				{
					$c_post 		   = commanPostArray('update');
					$update_post  	   = array_merge($post,$c_post);
					$lead_res          = $this->comman_model->updateData('tbl_leads' , array('lead_id' => $leads_id) , $update_post);

					$lead_products     = json_decode($this->input->post('selected_products'));
					if(sizeof($lead_products) > 0)
					{
						$products_list  = $this->comman_model->getDataV2('tbl_items' , 'where_in' , array('item_id' => $lead_products));
						if(!empty($products_list))
						{
							foreach ($products_list as $lp_res) 
							{
								$checkProduct = $this->comman_model->getData('tbl_lead_product' , array('lead_id' => $leads_id , 'product_id' => $lp_res->item_id));
								if(empty($checkProduct))
								{
									$lp_post['lead_product_id'] = round(microtime(true) * 1000);
									$lp_post['lead_id'] 		  = $leads_id;
									$lp_post['product_id'] 		  = $lp_res->item_id;
									$lp_post['product_name'] 	  = $lp_res->item_name;
									$lp_post['product_price'] 	  = $lp_res->unit_cost;
									$lp_post['product_desc'] 	   = $lp_res->item_desc;
									$add_lp  					  = array_merge($lp_post,$c_post);
									$lead_res = $this->comman_model->addData('tbl_lead_product' , $add_lp);
								}
							}
						}
					}
					$msg = 'Leads Update successfully!!';					
				}
				if($lead_res)
				{
					$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
					echo true;
				}
				else{
					echo false;
				}
			}
			else
			{
				$this->data['lead_status']    = $this->leads_model->getALLleadsStatusList();
				$this->data['country_list']   = $this->leads_model->getCountryList();
				$this->data['leads_source']   = $this->leads_model->getALLleadsSourceList();
				$this->data['state_list'] = $this->leads_model->getStateList();	
				if(!$leads_id)
				{
					$this->show_view_admin('leads/leads_add',$this->data);
				}
				else
				{
					$this->data['edit_leads']    = $this->comman_model->getData('tbl_leads' , array('lead_id' => $leads_id));
					$this->data['lead_products'] = $this->comman_model->getData('tbl_lead_product' , array('lead_id' => $leads_id));
					$this->show_view_admin('leads/leads_update', $this->data);
				}
			}
		}
	}

	public function viewlead($leads_id = '')
	{
		if($this->checkViewPermission())
		{	
			$this->data['lead_status']    = $this->leads_model->getALLleadsStatusList();
			$this->data['country_list']   = $this->leads_model->getCountryList();
			$this->data['leads_source']   = $this->leads_model->getALLleadsSourceList();
			$this->data['state_list'] = $this->leads_model->getStateList();	
			$this->data['edit_leads']   = $this->comman_model->getData('tbl_leads' , array('lead_id' =>$leads_id));
 			$this->data['process_list'] = $this->leads_model->getAllleadsProcessList($leads_id);
			$this->show_view_admin('leads/leads_view', $this->data);
		}
		else
		{	
			redirect('dashboard/error/1');
		}
	}

	/*view opportunity status*/ 
	public function processDetail($lead_id ='')
	{
		if ($this->checkViewPermission()) 
		{
			$this->data['process_list'] = $this->leads_model->getAllleadsProcessList($lead_id);
			$this->show_view_admin('leads/process_detail', $this->data);
		}
		else
		{
			redirect(base_url().'dashboard/error/1');
		}
	}
	/* Delete */
	public function deleteleads()
	{
		if($this->checkDeletePermission())
		{
			$lead_id = $this->uri->segment(3);	
			$this->leads_model->deleteleads($lead_id);
			
				$msg = 'leads remove successfully...!';					
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'leads');			
		}
		else
		{
			redirect( base_url().'dashboard/error/1');
		}		
	}

	public function loadProductData()
	{
		if(isset($_POST['action_load_product']))
		{
			$data['items_list'] = $this->comman_model->getData('tbl_items');
			$this->load->view('leads/product_modal' , $data );

		}
	}

	public function loadSendDocument()
	{
		if (isset($_POST['action_send_document']) && $_POST['action_send_document'] == 'Send Document')
		{
			$data['document_list']  = $this->leads_model->getLeadItemDocuments($_POST['lead_id']);
			$lead_details= $this->comman_model->getData('tbl_leads', array('lead_id'=> $_POST['lead_id']) , 'single');
			$data['email']= $lead_details->email;
			$data['lead_id']= $_POST['lead_id'];
			$this->load->view('leads/send_document' , $data);
		}
	}
	
	public function sendConfirmDocument()
	{
		if (isset($_POST['action_send_documents']) && $_POST['action_send_documents'] == 'Send Documnets')
		{
			$process_products =  json_decode($_POST['ids_array']);

			$document_list = $this->comman_model->getDataV2('tbl_item_attachment' , 'where_in' , array('item_doc_id' => $process_products));
			
			foreach ($document_list as $res) 
			{
				$post['send_document_id']          = $this->generate_id();
		     	$post['doc_details']               = serialize($res);
				$post['lead_id']                   = $_POST['lead_id'];
				$post['email_id']                  = $_POST['email_id'];
				$post['send_type']  			   = $_POST['send_type'];
				$document_id = $this->comman_model->addData('tbl_send_documents' , $post);
	    	}
		}
	}

	public function getLeadProductsById()
	{
		if(isset($_POST['action_get_product_by_ids']) && $_POST['action_get_product_by_ids'] == "Get Product By Ids" && isset($_POST['ids_array']))
		{
			$items_ids_array = json_decode($_POST['ids_array']);
			if(isset($_POST['actionType']) && $_POST['actionType'] == 'update')
			{
				$data['actionType'] = 'update';
			}
			$data['items_list'] = $this->comman_model->getDataV2('tbl_items' , 'where_in' , array('item_id' => $items_ids_array));
			$this->load->view('leads/added_product_list' , $data );
		}
	}

	public function removeLeadProductsById()
	{
		if(isset($_POST['lead_product_id']))
		{
			$id = $_POST['lead_product_id'];
			echo $this->comman_model->deleteData('tbl_lead_product' , array('lead_product_id' => $id ));
		}
	}

	public function addNewLeadProduct()
	{
		if(isset($_POST['action_add_product']) && $_POST['action_add_product'] == 'Add Product')
		{
			$post['item_id'] 		   = $this->generate_id();
			$post['item_name']         = $this->input->post('item_name');
	     	$post['unit_cost']         = $this->input->post('unit_price');
			$post['item_desc']         = $this->input->post('description');
			$post['quantity']          = $this->input->post('quantity');
			$post['item_tax_rate']     = $this->input->post('item_tax_rate');
			$item_id =  $this->comman_model->addData('tbl_items', $post);
			// echo "<pre>"; print_r($item_id); die();
			if($item_id)
			{
				$added_items_ids = json_decode($_POST['ids_array']);
				if (!empty($added_items_ids)) 
				{
					array_push($added_items_ids, $post['item_id']);
					$data['items_list'] = $this->comman_model->getDataV2('tbl_items' , 'where_in' , array('item_id'=> $added_items_ids));
					$data['new_item_id'] = $post['item_id'];
					$this->load->view('leads/added_product_list' , $data);
				}
				else
				{
					$data['items_list'] = $this->comman_model->getData('tbl_items' , array('item_id' => $post['item_id']));
					$data['new_item_id'] = $post['item_id'];
					$this->load->view('leads/added_product_list' , $data);
				}
			}
		}

		if(isset($_POST['add_new_products']) && $_POST['add_new_products'] == 'Add New products')
		{
			$lead_products     = json_decode($this->input->post('ids_array'));
			if(sizeof($lead_products) > 0)
			{
				$products_list  = $this->comman_model->getDataV2('tbl_items' , 'where_in' , array('item_id' => $lead_products));
				$leads_id = $_POST['lead_id'];
				if(!empty($products_list))
				{
					$c_post 	     = commanPostArray('create');
					foreach ($products_list as $lp_res) 
					{
						$checkProduct = $this->comman_model->getData('tbl_lead_product' , array('lead_id' => $leads_id , 'product_id' => $lp_res->item_id));
						if(empty($checkProduct))
						{
							$lp_post['lead_product_id'] = round(microtime(true) * 1000);
							$lp_post['lead_id'] 		  = $leads_id;
							$lp_post['product_id'] 		  = $lp_res->item_id;
							$lp_post['product_name'] 	  = $lp_res->item_name;
							$lp_post['product_price'] 	  = $lp_res->unit_cost;
							$lp_post['product_desc'] 	   = $lp_res->item_desc;
							$add_lp  					  = array_merge($lp_post,$c_post);
							$lead_res = $this->comman_model->addData('tbl_lead_product' , $add_lp);
						}
					}
					$data['addedProduct']  = $this->comman_model->getData('tbl_lead_product',array('lead_id'=> $leads_id));
					$this->load->view('leads/refresh_lead_products' , $data);
				}
			}
		}
	}

	public function refreshQuoteProducts()
	{
		if(isset($_POST['lead_id']))
		{
			$leads_products = $this->comman_model->getData('tbl_lead_product' , array('lead_id' => $_POST['lead_id']));
		 	$total_amt = 0; 
          	foreach ($leads_products as $pro) 
          	{
             	$total_amt = $total_amt+$pro->product_price*1;
	            ?>
             	<tr>
	                <td>
	                   <input type="checkbox" class="checkboxes onCheckQTItem" name="selected_products[]" data-mjson="<?php echo htmlspecialchars(json_encode($pro), ENT_QUOTES, 'UTF-8'); ?>" value="<?= $pro->lead_product_id; ?>"/>
	                </td>
	                <td>
	                   <input type="text" disabled="true" class="form-control" name="qp_product_name[]" data-key="product_name" placeholder="Enter product name" value="<?php echo $pro->product_name;?>">
	                </td>
	                <td>
	                   <input type="text" disabled="true" class="form-control" name="qp_product_des[]" data-key="product_desc" placeholder="Enter product desc" value="<?php echo $pro->product_desc?>">
	                </td>
	                <td>
	                   <input type="text" disabled="true" class="form-control checkNumFilter" name="qp_product_qty[]" data-key="product_qty" placeholder="Enter Qty" value="1">
	                </td>
	                <td>
	                   <input type="text" disabled="true" class="form-control checkNumFilter" name="qp_product_price[]" data-key="product_price" placeholder="0.00" value="<?php echo $pro->product_price?>">
	                </td>
             	</tr>
				<?php 
			} 
			?>
			<tr>
				<td colspan="4" class="text-right" style="vertical-align: middle;"><b>Total</b></td>
				<td><b>&#8377; <?= $total_amt; ?></b></td>
			</tr>
			<?php
		}
	}

	/* Get State List */
	public function getStateList()
	{
		$country_id     = $this->input->post('country_id');
		$tbl_state_list = $this->leads_model->getStateListByCountryId($country_id);
		$html = '';
		if(count($tbl_state_list) > 0)
		{
			foreach ($tbl_state_list as $s_list) 
			{
				$html .= '<option value="'.$s_list->tbl_state_id.'">'.$s_list->tbl_state_name.'</option>';
			}
			echo $html; 
		}
		else
		{
			echo $html;
		}
	}

	public function changeLeadStatus($lead_status = '',$lead_id ='')
	{
		if($lead_status != '' && $lead_id != '')
		{
			$change_status = $this->leads_model->changeLeadStatus($lead_status,$lead_id);
			if($change_status)
			{
				redirect(base_url().'leads');
			}
		}
	}

    public function htmlmail()
    {
    	$data['email_data']= $this->leads_model->getEmailById($_POST['lead_id']);
        $config = Array(        
            'protocol' 		=> 'sendmail',
            'smtp_host' 	=> 'your domain SMTP host',
            'smtp_port' 	=> 25,
            'smtp_user' 	=> 'SMTP Username',
            'smtp_pass' 	=> 'SMTP Password',
            'smtp_timeout'	=> '4',
            'mailtype' 	 	=> 'html', 
            'charset'   	=> 'iso-8859-1'
        );
			$this->email->set_newline("\r\n");
			$this->email->from('your mail id', 'Anil Labs');
			$data = array(
			    'userName'=> ''
			        );
			$this->email->to();  // replace it with receiver mail id
			$this->email->subject($subject); // replace it with relevant subject 
         	$body = $this->load->view('emails/send_document.php',$data,TRUE);
			$this->email->message($body);   
			$this->email->send();
    }
}
/* End of file */?>