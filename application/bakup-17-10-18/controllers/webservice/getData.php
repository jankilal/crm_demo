<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class GetData extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('webservice/lead_model');
		$this->load->model('webservice/comman_model');
	}

/*---------------Lead Start----------------*/ 
	public function leadAddUpdateData()
    {
    	$rawData = file_get_contents("php://input");
		$st_data = json_decode($rawData);
		// print_r($st_data);die();
		$u_id_arr = array();
		if(!empty($st_data->data))
		{
			foreach ($st_data->data as $val)
			{
				if(!empty($val))
				{
					$post['lead_id'] 		= $val->lead_id;
					$post['lead_name'] 		= $val->lead_name;
					$post['organization'] 	= $val->organization;
					$post['lead_status_id'] = $val->lead_status_id;
					$post['lead_source_id'] = $val->lead_source_id;
					$post['industry'] 		= $val->industry;
					$post['salutation'] 	= $val->salutation;
					$post['name'] 			= $val->name;
					$post['address'] 		= $val->address;
					$post['country'] 		= $val->country;
					$post['state'] 			= $val->state;
					$post['zip_code'] 		= $val->zip_code;
					$post['city'] 			= $val->city;
					$post['title'] 			= $val->title;
					$post['email'] 			= $val->email;
					$post['sec_email'] 		= $val->sec_email;
					$post['designation'] 	= $val->designation;
					$post['email_opt_out'] 	= $val->email_opt_out;
					$post['mobile_number'] 	= $val->mobile_number;
					$post['phone_number'] 	= $val->phone_number;
					$post['facebook'] 		= $val->facebook;
					$post['notes'] 			= $val->notes;
					$post['skype'] 			= $val->skype;
					$post['twitter'] 		= $val->twitter;
					$post['annual_revenue'] = $val->annual_revenue;
					$post['secondary_email']= $val->secondary_email;
					$post['stages'] 		= $val->stages;
					$post['website'] 		= $val->website;
					$post['current_status'] = $val->current_status;
					$post['lead_assign_status'] = $val->lead_assign_status;
					$post['lead_status'] 	= $val->lead_status;
					$post['create_by'] 		= $val->create_by;
					$post['update_by'] 		= $val->update_by;
					$post['create_date'] 	= $val->create_date;
					$post['update_date'] 	= $val->update_date;
					$post['sync_date_time'] = $val->sync_date_time;
					$post['opportunity_status'] = $val->opportunity_status;
					$post['opportunities_state_reason_id'] = $val->opportunities_state_reason_id;
					$post['close_date'] 	= $val->close_date;
					$post['expected_revenue']= $val->expected_revenue;
					$post['new_link'] 		= $val->new_link;
					$post['contact_name'] 	= $val->contact_name;
					$post['permission'] 	= $val->permission;
					$post['next_action'] 	= $val->next_action;
					$post['next_action_date'] = $val->next_action_date;
					$post['attachment'] 		= $val->attachment;
					$post['lead_lat'] 			= $val->lead_lat;
					$post['lead_long'] 			= $val->lead_long;
					$post['location_taken_by'] 			= $val->location_taken_by;
					$post['location_approved'] 			= $val->location_approved;
					$post['location_taken_date_time']	= $val->location_taken_date_time;

					$check_res = $this->comman_model->check_by(array('lead_id' => $post['lead_id'] ) ,'tbl_leads');
					// $check_res = $this->lead_model->checkData($post['lead_id']);
					if(!empty($check_res))
					{
						// $this->lead_model->updateData($post);
						$this->comman_model->updateData('tbl_leads', array('lead_id' => $post['lead_id']) , $post);

						$u_id_arr[] = array('lead_id'=>$post['lead_id']);
					}
					else
					{
						$lead_id_x = $this->comman_model->addData('tbl_leads', $post);
						// $lead_id_x = $this->lead_model->addData($post);

						$as_post['assign_id'] 	= $this->generate_id();
						$as_post['lead_id']		= $val->lead_id;
						$as_post['user_id']		= $val->user_id;
						$as_post['assign_date_time'] =  date('Y-m-d H:i:s');
						$as_post['assign_by'] 		=	$val->user_id;
						$this->comman_model->addData('tbl_assign_user', $as_post);
						if($lead_id_x)
						{
							$u_id_arr[] = array('lead_id'=>$post['lead_id']);
						}
					}
					
				}
			}
		}
		if(!empty($u_id_arr))
		{
			echo json_encode(array("status"=>1, "data"=>$u_id_arr)); 
		}
		else
		{
			echo json_encode(array("status"=>0, "data"=>array())); 
		}
    }

    public function leadProcessDetailAddUpdateData()
    {
    	$rawData = file_get_contents("php://input");
		$st_data = json_decode($rawData);
		// print_r($st_data->data);die();
		$u_id_arr = array();
		if(!empty($st_data->data))
		{
			foreach ($st_data->data as $val)
			{
				if(!empty($val))
				{
					$post['leads_process_id']   = $val->leads_process_id;
					$post['meeting_minutes'] 	= $val->meeting_minutes;
					$post['response_levels'] 	= $val->response_levels;
					$post['next_meeting_call'] 	= $val->next_meeting_call;
					$post['next_meeting_date'] 	= $val->next_meeting_date;
					$post['next_meeting_time'] 	= $val->next_meeting_time;
					$post['to_do_list'] 		= $val->to_do_list;
					$post['sample_request'] 	= $val->sample_request;
					$post['quote_request'] 		= $val->quote_request;
					$post['leads_process_details'] = $val->leads_process_details;
					$post['sync_date_time'] 	= $val->sync_date_time;

					$check_res = $this->comman_model->check_by(array('leads_process_details_id' =>$post['leads_process_id'] ) ,'tbl_leads');
					// $check_res = $this->lead_model->checkData($post['leads_process_details_id']);
					if(!empty($check_res))
					{
					$this->comman_model->updateData('tbl_leads_process_details', array('leads_process_details_id' => $post['leads_process_details_id']),$post);

						$u_id_arr[] = array('leads_process_details_id'=>$post['leads_process_details_id']);
					}
					else
					{
						$lead_PD_id_x = $this->comman_model->addData('tbl_leads_process_details', $post);
						if($lead_PD_id_x)
						{
							$u_id_arr[] = array('leads_process_details_id'=>$post['leads_process_details_id']);
						}
					}
					
				}
			}
		}
		if(!empty($u_id_arr))
		{
			echo json_encode(array("status"=>1, "data"=>$u_id_arr)); 
		}
		else
		{
			echo json_encode(array("status"=>0, "data"=>array())); 
		}
    }

    public function leadProcessAddUpdateData()
    {
    	$rawData = file_get_contents("php://input");
		$st_data = json_decode($rawData);
		// print_r($st_data->data);die();
		$u_id_arr = array();
		if(!empty($st_data->data))
		{
			foreach ($st_data->data as $val)
			{
				if(!empty($val))
				{
					$post['lead_id'] 			= $val->lead_id;
					$post['leads_process_date'] = $val->leads_process_date;
					$post['leads_process_type'] = $val->leads_process_type;
					$post['leads_process_status']= $val->leads_process_status;
					$post['create_date'] 		= $val->create_date;
					$post['Meeting'] 			= $val->Meeting;
					$post['sync_date_time'] 	= $val->sync_date_time;

					$check_res = $this->lead_model->checkData($post['leads_process_id']);
					if(!empty($check_res))
					{
						$this->lead_model->updateData($post);
						$u_id_arr[] = array('leads_process_id'=>$post['leads_process_id']);
					}
					else
					{
						$lead_id_x = $this->lead_model->addData($post);
						if($lead_id_x)
						{
							$u_id_arr[] = array('leads_process_id'=>$post['leads_process_id']);
						}
					}
					
				}
			}
		}
		if(!empty($u_id_arr))
		{
			echo json_encode(array("status"=>1, "data"=>$u_id_arr)); 
		}
		else
		{
			echo json_encode(array("status"=>0, "data"=>array())); 
		}
    }
	public function leadStatusAddUpdateData()
    {
    	$rawData = file_get_contents("php://input");
		$st_data = json_decode($rawData);
		// print_r($st_data->data);die();
		$u_id_arr = array();
		if(!empty($st_data->data))
		{
			foreach ($st_data->data as $val)
			{
				if(!empty($val))
				{
					$post['lead_status']       	      = $val->lead_status;
					$post['lead_type']                = $val->lead_type;
					$post['lead_status_status']       = $val->lead_status_status;
					$post['lead_status_created_date'] = $val->lead_status_created_date;
					$post['lead_status_update_date']  = $val->lead_status_update_date;
					$post['sync_date_time'] 		  = $val->sync_date_time;

					$check_res = $this->comman_model->check_by('tbl_lead_status', array('lead_status_id' => $lead_status_id));
					if(!empty($check_res))
					{
						$this->comman_model->updateData('tbl_lead_status', array('lead_status_id' => $lead_status_id));

						$u_id_arr[] = array('lead_status_id'=>$post['lead_status_id']);
					}
					else
					{
						$lead_id_x = $this->comman_model->addData('tbl_lead_status',$post);
						if($lead_id_x)
						{
							$u_id_arr[] = array('lead_status_id'=>$post['lead_status_id']);
						}
					}
					
				}
			}
		}
		if(!empty($u_id_arr))
		{
			echo json_encode(array("status"=>1, "data"=>$u_id_arr)); 
		}
		else
		{
			echo json_encode(array("status"=>0, "data"=>array())); 
		}
    }

    public function leadSourceAddUpdateData()
    {
    	$rawData = file_get_contents("php://input");
		$st_data = json_decode($rawData);
		// print_r($st_data->data);die();
		$u_id_arr = array();
		if(!empty($st_data->data))
		{
			foreach ($st_data->data as $val)
			{
				if(!empty($val))
				{
					$post['lead_source']       	      = $val->lead_source;
					$post['lead_source_status']       = $val->lead_source_status;
					$post['lead_source_created_date'] = $val->lead_source_created_date;
					$post['lead_source_update_date']  = $val->lead_source_update_date;
					$post['sync_date_time']       	  = $val->sync_date_time;

					$check_res = $this->comman_model->check_by('tbl_lead_source', array('lead_source_id' => $lead_source_id));
					if(!empty($check_res))
					{
						$this->comman_model->updateData('tbl_lead_source', array('lead_source_id' => $lead_source_id));

						$u_id_arr[] = array('lead_source_id'=>$post['lead_source_id']);
					}
					else
					{
						$lead_id_x = $this->comman_model->addData('tbl_lead_source',$post);
						if($lead_id_x)
						{
							$u_id_arr[] = array('lead_source_id'=>$post['lead_source_id']);
						}
					}
					
				}
			}
		}
		if(!empty($u_id_arr))
		{
			echo json_encode(array("status"=>1, "data"=>$u_id_arr)); 
		}
		else
		{
			echo json_encode(array("status"=>0, "data"=>array())); 
		}
    }

    public function leadMeetingAddUpdateData()
    {
    	$rawData = file_get_contents("php://input");
		$st_data = json_decode($rawData);
		
		$u_id_arr = array();
		if(!empty($st_data->data))
		{
			foreach ($st_data->data as $val)
			{
				if(!empty($val))
				{
					$post['lm_id']               = $val->lm_id;
					$post['lead_id']             = $val->lead_id;
					$post['client_id']           = $val->client_id;
					$post['lm_date']             = $val->lm_date;
					$post['lm_time']             = $val->lm_time;
					$post['lm_start_time']       = $val->lm_start_time;
					$post['lm_end_time']         = $val->lm_end_time;
					$post['lm_start_lat']        = $val->lm_start_lat;
					$post['lm_start_lng']        = $val->lm_start_lng;
					$post['lm_end_lat']          = $val->lm_end_lat;
					$post['lm_end_lng']          = $val->lm_end_lng;
					$post['lm_notes']          	 = $val->lm_notes;
					$post['status']              = $val->status;
					$post['create_date']         = $val->create_date;
					$post['update_date']         = $val->update_date;
					$post['sync_date_time']		 = $val->sync_date_time;
					// $post['action']              = $val->action;
					// $post['action_status']       = $val->action_status;

					// $check_res = $this->lead_model->checkData($post['id']);
					$check_res = $this->comman_model->check_by(array('lm_id' => $post['lm_id']),'tbl_lead_meeting');
					if(!empty($check_res))
					{
						$this->comman_model->updateData('tbl_lead_meeting', array('lm_id' => $post['lm_id']),$post);

						$u_id_arr[] = array('lm_id'=>$post['lm_id']);
					}
					else
					{
						$lead_id_x = $this->comman_model->addData('tbl_lead_meeting',$post);
						if($lead_id_x)
						{
							$u_id_arr[] = array('lm_id'=>$post['lm_id']);
						}
					}
				}
			}
		}
		if(!empty($u_id_arr))
		{
			echo json_encode(array("status"=>1, "data"=>$u_id_arr)); 
		}
		else
		{
			echo json_encode(array("status"=>0, "data"=>array())); 
		}
    }
/*---------------Lead End----------------*/ 
/*---------------Item Start----------------*/ 
	public function ItemAddUpdateData()
    {
    	$rawData = file_get_contents("php://input");
		$st_data = json_decode($rawData);
		// print_r($st_data->data);die();
		$u_id_arr = array();
		if(!empty($st_data->data))
		{
			foreach ($st_data->data as $val)
			{
				if(!empty($val))
				{
					$post['item_id']          = $val->item_id;
					$post['invoices_id']      = $val->invoices_id;
					$post['item_tax_rate']    = $val->item_tax_rate;
					$post['item_tax_total']   = $val->item_tax_total;
					$post['quantity']         = $val->quantity;
					$post['total_cost']       = $val->total_cost;
					$post['item_name']        = $val->item_name;
					$post['item_desc']        = $val->item_desc;
					$post['unit_cost']        = $val->unit_cost;
					$post['item_order']       = $val->item_order;
					$post['date_saved']       = $val->date_saved;

					// $check_res = $this->lead_model->checkData($post['lead_status_id']);
					$check_res = $this->comman_model->check_by(array('item_id' => $post['item_id']),'tbl_items');
					if(!empty($check_res))
					{
						$this->comman_model->updateData('tbl_items', array('item_id' => $item_id),$post);
						$u_id_arr[] = array('item_id'=>$post['item_id']);
					}
					else
					{
						$lead_id_x = $this->comman_model->addData('tbl_items',$post);
						if($lead_id_x)
						{
							$u_id_arr[] = array('item_id'=>$post['item_id']);
						}
					}
				}
			}
		}
		if(!empty($u_id_arr))
		{
			echo json_encode(array("status"=>1, "data"=>$u_id_arr)); 
		}
		else
		{
			echo json_encode(array("status"=>0, "data"=>array())); 
		}
    }

    public function itemAttachmentAddUpdateData()
    {
    	$rawData = file_get_contents("php://input");
		$st_data = json_decode($rawData);
		// print_r($st_data->data);die();
		$u_id_arr = array();
		if(!empty($st_data->data))
		{
			foreach ($st_data->data as $val)
			{
				if(!empty($val))
				{
					$post['item_doc_id']      = $val->item_doc_id;
					$post['item_id']          = $val->item_id;
					$post['item_description'] = $val->item_description;
					$post['item_attachment']  = $val->item_attachment;
					$post['states']           = $val->states;
					$post['created_date']     = $val->created_date;
					$post['update_date']      = $val->update_date;
					$post['create_b']         = $val->create_by;
					$post['update_by']        = $val->update_by;
					$post['sync_date_time']   = $val->sync_date_time;

					// $check_res = $this->lead_model->checkData($post['leads_process_id']);
					$check_res = $this->comman_model->check_by('tbl_item_attachment', array('id' => $id));
					if(!empty($check_res))
					{
						$this->comman_model->updateData('tbl_item_attachment', array('id' => $id));

						$u_id_arr[] = array('id'=>$post['id']);
					}
					else
					{
						$lead_id_x = $this->comman_model->addData('tbl_item_attachment',$post);
						if($lead_id_x)
						{
							$u_id_arr[] = array('id'=>$post['id']);
						}
					}
					
				}
			}
		}
		if(!empty($u_id_arr))
		{
			echo json_encode(array("status"=>1, "data"=>$u_id_arr)); 
		}
		else
		{
			echo json_encode(array("status"=>0, "data"=>array())); 
		}
    }

    public function leadProductAddUpdateData()
    {
    	$rawData = file_get_contents("php://input");
		$st_data = json_decode($rawData);
		// print_r($st_data->data);die();
		$u_id_arr = array();
		if(!empty($st_data->data))
		{
			foreach ($st_data->data as $val)
			{
				if(!empty($val))
				{
					$post['lead_id']                     = $val->lead_id;
					$post['lead_process_id']             = $val->lead_process_id;
					$post['lead_product_id']             = $val->lead_product_id;
				    $post['opportunity_process_id']      = $val->opportunity_process_id;
					$post['product_type']                = $val->product_type;
					$post['product_id']                  = $val->product_id;
					$post['product_name']                = $val->product_name;
					$post['product_price']               = $val->product_price;
					$post['lead_product_status']         = $val->lead_product_status;
					$post['create_by']       	         = $val->create_by;
					$post['update_by']       	         = $val->update_by;
					$post['create_date']     	         = $val->create_date;
					$post['update_date']     	         = $val->update_date;
					$post['product_desc']    	         = $val->product_desc;

					// $check_res = $this->lead_model->checkData($post['id']);
					$check_res = $this->comman_model->check_by(array('lead_product_id' => $post['lead_product_id']) ,'tbl_lead_product');
					if(!empty($check_res))
					{
						$this->comman_model->updateData('tbl_lead_product', array('lead_product_id' => $post['lead_product_id']),$post);
						$u_id_arr[] = array('lead_product_id'=>$post['lead_product_id']);
					}
					else
					{
						$lead_id_x = $this->comman_model->addData('tbl_lead_product',$post);
						if($lead_id_x)
						{
							$u_id_arr[] = array('lead_product_id'=>$post['lead_product_id']);
						} 
					}
					
				}
			}
		}
		if(!empty($u_id_arr))
		{
			echo json_encode(array("status"=>1, "data"=>$u_id_arr)); 
		}
		else
		{
			echo json_encode(array("status"=>0, "data"=>array())); 
		}
    }
/*---------------Item End----------------*/   
/*---------------Company Start----------------*/   
	public function addUpdateCompanyList()
	{	
		$rawData = file_get_contents("php://input");
		$st_data = json_decode($rawData);
		// print_r($st_data->data);die();
		$u_id_arr = array();
		if(!empty($st_data->data))
		{	
			foreach ($st_data->data as $val)
			{
				if(!empty($val))
				{
					$post['client_id']      = $val->user_id;
					$post['leads_id'] 		= $val->company_id;
					$post['company_name'] 	= $val->company_name;
					$post['address'] 		= $val->company_address;
					$post['contact_name'] 	= $val->concerne_person;
					$post['mobile'] 		= $val->contact_no;
					$post['email'] 			= $val->email;
					$post['status'] 		= $val->status;
					$check_res = $this->comman_model->getData('tbl_leads' , array('leads_id'=>$post['leads_id']) , 'single');
					if(!empty($check_res))
					{
						$this->comman_model->updateData('tbl_leads' , array('leads_id'=>$post['leads_id']) , $post);
						$u_id_arr[] = array('leads_id'=>$post['leads_id']);
					}
					else
					{
						$attendance_id_x = $this->comman_model->addData('tbl_leads' , $post);
						if($attendance_id_x)
						{
							$u_id_arr[] = array('leads_id'=>$post['leads_id']);
						}
					}
				}
			}
		}
		if(!empty($u_id_arr))
		{
			echo json_encode(array("status"=>1, "data"=>$u_id_arr)); 
		}
		else
		{
			echo json_encode(array("status"=>0, "data"=>array())); 
		}
	}



	public function addUpdateCompanyMeetingList()
	{	
		$rawData = file_get_contents("php://input");
		$st_data = json_decode($rawData);
		// print_r($st_data->data);die();
		$u_id_arr = array();
		if(!empty($st_data->data))
		{	
			foreach ($st_data->data as $val)
			{
				if(!empty($val))
				{
					$post['cm_id']          				= $val->cm_id;
					$post['client_id'] 						= $val->user_id;
					$post['company_id'] 					= $val->company_id;
					$post['cm_date'] 						= $val->cm_date;
					$post['cm_start_time'] 					= $val->cm_start_time;
					$post['cm_end_time'] 					= $val->cm_end_time;
					$post['cm_start_lat'] 					= $val->cm_start_lat;
					$post['cm_start_lng'] 					= $val->cm_start_lng;
					$post['cm_end_lat'] 					= $val->cm_end_lat;
					$post['cm_end_lng'] 					= $val->cm_end_lng;
					$post['status'] 						= $val->status;
					$post['created_date'] 					= $val->created_date;
					$post['update_date'] 					= $val->update_date;
					$check_res = $this->comman_model->getData('tbl_company_meeting' , array('cm_id'=>$post['cm_id']) , 'single');
					if(!empty($check_res))
					{
						$this->comman_model->updateData('tbl_company_meeting' , array('cm_id'=>$post['cm_id']) , $post);
						$u_id_arr[] = array('cm_id'=>$post['cm_id']);
					}
					else
					{
						$attendance_id_x = $this->comman_model->addData('tbl_company_meeting' , $post);
						if($attendance_id_x)
						{
							$u_id_arr[] = array('cm_id'=>$post['cm_id']);
						}
					}
				}
			}
		}
		if(!empty($u_id_arr))
		{
			echo json_encode(array("status"=>1, "data"=>$u_id_arr)); 
		}
		else
		{
			echo json_encode(array("status"=>0, "data"=>array())); 
		}
	}
	/*---------------Company End----------------*/ 
	
	/*---------------Expense Start----------------*/ 
	public function addUpdateExpense()
	{	
		$rawData = file_get_contents("php://input");
		$st_data = json_decode($rawData);
		// print_r($st_data->data);die();
		$u_id_arr = array();
		if(!empty($st_data->data))
		{	
			foreach ($st_data->data as $val)
			{
				if(!empty($val))
				{
					$post['expenses_id']           			= $val->expenses_id;
					$post['expenses_category_id']           = $val->expenses_category_id;
					$post['expenses_amt']              		= $val->expenses_amt;
					$post['expenses_narration']             = $val->expenses_narration;
					$post['expenses_attachment']            = $val->expenses_attachment;
					$post['user_id']              			= $val->user_id;
					$post['expenses_long']              	= $val->expenses_long;
					$post['expenses_lat']              		= $val->expenses_lat;
					$post['expenses_status']              	= $val->expenses_status;
					$post['expenses_created_date']          = (isset($val->expenses_created_date)) ? $val->expenses_created_date : $val->sync_date_time;
					$post['expenses_update_date']           = $val->expenses_update_date;
					$post['sync_date_time']              	= $val->sync_date_time;

					$check_res = $this->comman_model->check_by(array('expenses_id' => $post['expenses_id']),'tbl_expenses');

					if(!empty($check_res))
					{
						$this->comman_model->updateData('tbl_expenses', array('expenses_id' => $post['expenses_id']),$post);
						$u_id_arr[] = array('expenses_id'=>$post['expenses_id']);
					}
					else
					{
						$expenses_id_x = $this->comman_model->addData('tbl_expenses',$post);
						if($expenses_id_x)
						{
							$u_id_arr[] = array('expenses_id'=>$post['expenses_id']);
						}
					}
				}
			}
		}
		if(!empty($u_id_arr))
		{
			echo json_encode(array("status"=>1, "data"=>$u_id_arr)); 
		}
		else
		{
			echo json_encode(array("status"=>0, "data"=>array())); 
		}
    }
	/*---------------Expense End----------------*/ 




}

