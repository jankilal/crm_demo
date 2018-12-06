<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Opportunities extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('opportunities_model');
	}	
	/*	Validation Rules */
	 protected $validation_rules = array
        (
        'opportunitiesAdd' => array(
           array(
                'field' => 'Opportunities_name',
                'label' => ' opportunities name',
                'rules' => 'trim|required'
            ),		
        ),
		'opportunitiesEdit' => array(
            array(
                'field' => 'Opportunities_name',
                'label' => ' opportunities name',
                'rules' => 'trim|required'
            ),
        )
    );
	
	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{			
			$this->data['opportunities_result']     = $this->opportunities_model->getAllOpportunities();
		    $this->data['advance_data_tbl']  		= '1';
			$this->data['opportunities_state_list'] = $this->opportunities_model->getALLOpportunitiesStateList();		
			$this->session->unset_userdata('opportunities_process');
			$this->show_view_admin('opportunities/opportunities', $this->data);
		}
		else
		{	
			redirect(base_url().'dashboard/error/1');
		}
    }

    /* Add and Update */
	public function addopportunities($opportunities_id='')
	{
		if($opportunities_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{
					$this->form_validation->set_rules($this->validation_rules['opportunitiesEdit']);
					if($this->form_validation->run())
					{
						$post['lead_name'] 	= $this->input->post('Opportunities_name');
						$post['stages'] 	     = $this->input->post('stages');
						$post['probability']     = $this->input->post('probability');
						$post['opportunities_state_reason_id'] = $this->input->post('opportunities_state_reason_id');
						$post['close_date']      = $this->input->post('close_date');
						$post['expected_revenue']= $this->input->post('expected_revenue');
						$post['new_link'] 		 = $this->input->post('new_link');
						$post['next_action']	 = $this->input->post('next_action');
						$post['next_action_date']= $this->input->post('next_action_date');
						$post['permission']      = $this->input->post('permission');
						$post['notes'] 	         = $this->input->post('notes');
						$c_post 	             = commanPostArray('create');
						$add_post  		         = array_merge($post,$c_post);
						    
						$opportunities_id        = $this->opportunities_model->updateOpportunities($add_post,$opportunities_id);	
						if($opportunities_id)
						{					
							$msg = 'opportunities added successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'opportunities');
						}
					}
					else
					{
						$this->data['edit_opportunities'] = $this->comman_model->getData('tbl_opportunities',$opportunities_id);
						$this->data['opp_reson_states']   = $this->opportunities_model->getALLOpportunitiesStateList();
						$this->show_view_admin('opportunities/opportunities_update', $this->data);
					}		
				}
				else
				{
					$this->data['edit_opportunities'] = $this->opportunities_model->editOpportunities($opportunities_id);	
					$this->data['opp_reson_states']   = $this->opportunities_model->getALLOpportunitiesStateList();
					$this->data['role_list'] 		  = $this->opportunities_model->getRoleList();
					$this->data['process_list'] = $this->opportunities_model->getAllOpportunitiesProcessList($opportunities_id);				

					// $leads_process = $this->session->userdata('leads_process');
                 
                    $addedProduct = $this->comman_model->getData('tbl_lead_product',array('lead_id'=> $opportunities_id));
					$this->show_view_admin('opportunities/opportunities_view', $this->data);
				}
			}
			else
			{
				redirect( base_url().'dashboard/error/1');
			}
		}	
	}
	
	/* Delete */
	public function deleteOpportunities()
	{
		if($this->checkDeletePermission())
		{
			$opportunities_id = $this->uri->segment(3);	
			$this->opportunities_model->deleteOpportunities($opportunities_id);
			
				$msg = 'opportunities remove successfully...!';					
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'opportunities');			
		}
		else		{
			redirect( base_url().'dashboard/error/1');
		}		
	}

	/* Get State List */
	public function getStateList()
	{
		$country_id = $this->input->post('country_id');
		$state_list = $this->opportunities_model->getStateListByCountryId($country_id);

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

//###### Opportunity Process Section Start ###########

	public function addOpportunitiesProcess()
	{
		$this->session->unset_userdata('opportunities_process');
		if(isset($_POST['submit']) && $_POST['submit'] != '')
		{
			$post['opportunities_id'] = $this->input->post('opportunities_id');
			// $post['opportunities_process_id']   = round(microtime(true)* 1000);
			$post['opportunities_process_date'] = $this->input->post('opportunities_process_date');
			$post['opportunities_process_type'] = $this->input->post('opportunities_process_type');

			$this->session->set_userdata('opportunities_process',$post);	
			redirect(base_url().'opportunities/opportunitiesProcessDetails');			
		}
		else
		{
			redirect(base_url().'opportunities');
		}
	}
	
	public function addMeeting()
	{
		// echo "<pre>"; print_r($_POST); die();
		if(isset($_POST['submit']) && $_POST['submit'] == 'Submit')
    	{
    		$post['lm_id']        = round(microtime(true) * 1000);
    		$post['lead_id']      = $this->input->post('opportunities_id');
    		$post['lm_date']      = $this->input->post('metting_date');
    		$post['lm_time']      = $this->input->post('metting_time');
			$id = $this->comman_model->addData('tbl_lead_meeting', $post);
    		$msg = 'Opportunities meeting added successfully.';
			$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
			redirect('opportunities');

		}
		$meeting_result = $this->comman_model->getData('tbl_lead_meeting' , array('lead_id' => $_POST['opportunities_id']));
	}

	public function loadMeetingData()
    {
    	if(isset($_POST['opportunities_id']))
    	{
    		$meeting_result = $this->comman_model->getData('tbl_lead_meeting' , array('lead_id' => $_POST['opportunities_id']));
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

	public function opportunitiesProcessDetails()
	{	
		$sreq_result = array();
		$opp_process_data = $this->session->userdata('opportunities_process');
		if (!empty($opp_process_data)) 
		{
			$opportunities_id = $opp_process_data['opportunities_id'];
			$lead_details = $this->comman_model->getData('tbl_opportunities', array('opportunities_id'=>$opportunities_id));
			if(isset($_POST['Submit']) && $_POST['Submit'] == 'Add')
			{
				//######### Send & Add Quote Details In DataBase #########
				if(isset($_POST['send_quote']) && $_POST['send_quote'] == 'Send')
				{
					$quote_arr = array();
					$quote_product_arr = array();
					$q_post['quote_id']		    = round(microtime(true) * 1000);
					$q_post['lead_id']		    = $opportunities_id;
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
							$qp_post['document_details'] = $this->comman_model->addData('tbl_quotation_products', $add_post);
							//Calculate Total Amount Of Quotation
							$qt_total = $qt_total+($qp_post['product_price']*$qp_product_qty[$i]);
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
				$items_list = array();
				if(sizeof(json_decode($_POST['product_id_array'])>0))
				{
					$process_products = json_decode($_POST['product_id_array']);
					if(!empty($process_products))
					{
						$items_list = $this->comman_model->getDataV2('tbl_items','where_in',array('item_id' => $process_products));
					}
				}

				$op_post['opportunities_process_id']  = round(microtime(true)* 1000);
				$op_post['opportunities_id']          = $opportunities_id;
				$op_post['opportunities_process_date']= $opp_process_data['opportunities_process_date'];
				$op_post['opportunities_process_type']= $opp_process_data['opportunities_process_type'];
				$op_post['opportunities_process_status'] = '1';
				$op_post['opportunities_process_created_date'] = date('Y-m-d');
				$process_id = $this->opportunities_model->addOpportunitiesProcess($op_post);
				if($process_id)
				{
					$post['opportunities_process_details_id']  = round(microtime(true)* 1000);
					$post['opportunities_process_id'] = $op_post['opportunities_process_id'];
					$post['meeting_minutes']          = $this->input->post('meeting_minutes');
					$post['response_levels']          = $this->input->post('response_levels');
					$post['next_meeting_call']        = $this->input->post('next_meeting_call');
					$post['to_do_list']               = $this->input->post('to_do_list');
					$post['next_meeting_date']        = $this->input->post('next_meeting_date');
					$post['next_meeting_time']        = $this->input->post('next_meeting_time');
					$post['sample_request']           = $this->input->post('sample_request');
					$post['quote_request']            = $this->input->post('quote_request');
					$process_details_id = $this->opportunities_model->addOpportunitiesProcessDetails($post);
					if($process_details_id)
					{
						if(!empty($items_list))
						{
							foreach ($items_list as $value) 
							{
								$checkProduct = $this->comman_model->getData('tbl_lead_product' , array('lead_id' => $opp_process_data['opportunities_id'] , 'product_id' => $value->item_id));
								if(empty($checkProduct))
								{
									$p_post['product_type']		   	= 'opportunitie_process';
									$p_post['lead_product_id']		= $this->generate_id();
								    $p_post['lead_id'] 	   		   	= $opp_process_data['opportunities_id'];
									$p_post['opportunity_process_id']=$op_post['opportunities_process_id'];
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
						
							$product_details_array = $this->input->post('sample_details');
							for ($i=0; $i < count($product_details_array); $i++) 
							{ 
								$sr_post['sample_description'] = $product_details_array[$i];
								if(isset($_POST['sampleRequest']) && $_POST['sampleRequest'] == 'yes')
								{		
									for ($i=0; $i < count($product_details_array); $i++) 
									{ 
										/**** ADD MULTIPLE HOME TEMPLATE IMAGES *******/
										if($_FILES["sample_files_".$i]['name'])
										{						
											$prod_files_array = $_FILES["sample_files_".$i]["name"];
											for($k = 0; $k < count($prod_files_array); $k++)
											{
												$_FILES['new_file']['name'] = $_FILES['sample_files_'.$i]['name'][$k];
												$_FILES['new_file']['type'] = $_FILES['sample_files_'.$i]['type'][$k];
								                $_FILES['new_file']['tmp_name'] = $_FILES['sample_files_'.$i]['tmp_name'][$k];
								                $_FILES['new_file']['error'] = $_FILES['sample_files_'.$i]['error'][$k];
								                $_FILES['new_file']['size'] = $_FILES['sample_files_'.$i]['size'][$k];
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
								                  $post_img = $imagePath.''.$imageName;
								              	}
												$sr_post['lead_id'] = $opp_process_data['opportunities_id'];
												$sr_post['proccess_id'] = $process_id;
												$sr_post['order_date'] = $this->input->post('order_date_'.$i);
												$sr_post['delivery_date'] = $this->input->post('delivery_date_'.$i);
												$sr_post['sample_img'] = $post_img;
												$sr_post['approve_status'] = 'pending';
												$sr_post['sample_request_status'] = 'Forward to ERP';
												$sr_post['type'] = 'Opportunities';						
												$sample_id= $this->comman_model->addData('tbl_sample_request' , $sr_post);	
											} // END FOR LOOP

										} // CHECK GALLERY IMAGE IS EXIST
									}
								}	
							}
							$this->session->unset_userdata('opportunities_process');
						}

						$this->session->unset_userdata('opportunities_process');
						$msg = 'Opportunities process added successfully.';
						$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect('opportunities');
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
			$this->data['leads_products']   = $this->comman_model->getData('tbl_lead_product' , array('lead_id' => $opportunities_id));
			$this->data['opportunities_id']   = $opportunities_id;
		    $this->data['send_quote_detail']= $this->comman_model->getData('tbl_leads' , array('lead_id'=>$opportunities_id) , 'single');
			$this->data['quotation_detail'] = $this->comman_model->getData('tbl_quotation' , array('lead_id'=>$opportunities_id));
			$this->data['process_list'] = $this->opportunities_model->getAllOpportunitiesProcessList($opportunities_id);
			$this->data['company_details']   = $this->comman_model->getData('tbl_company' , NULL , 'single');
			$this->show_view_admin('opportunities/opportunities_process_details',$this->data);
		}
	}

	public function loadProductData()
	{
		if(isset($_POST['action_load_product']))
		{
			$data['items_list'] = $this->comman_model->getData('tbl_items');
			$this->load->view('opportunities/product_modal' , $data );

		}
	}

	public function moveToClient($id)
	{
		if(isset($_POST['move_to_client']) && $_POST['move_to_client'] == 'Move')
		{
			if (isset($_POST['approve_products']) && !empty($_POST['approve_products']))
			{
				$quotation_ids =  $this->input->post('approve_products');
				$quotation_list = $this->comman_model->getDataV2('tbl_quotation','where_in',array('quote_id' => $quotation_ids));
				if(!empty($quotation_list))
				{
					foreach ($quotation_list as $q_res) 
					{
						$quote_products = $this->comman_model->getData('tbl_quotation_products' , array('quote_id' => $q_res->quote_id));
						$temp_arr = array();
						$temp_arr = json_decode(json_encode($q_res) , true);
						$temp_arr['client_quotation_id'] = $this->generate_id();
						$temp_arr['additional_details'] = $q_res->additional_detail;

						unset($temp_arr['id']);
						unset($temp_arr['additional_detail']);
						unset($temp_arr['sync_date_time']);
						$temp_arr['product_details'] = serialize($quote_products);
						$c_post 	    = commanPostArray('create');
					    $add_post  	    = array_merge($temp_arr,$c_post);
						$res = $this->comman_model->addData('tbl_client_quotation' , $add_post);
					}
					if($res)
					{
						$this->comman_model->updateData('tbl_leads' , array('lead_id' => $id) , array('current_status' => 3));
						$msg = 'Opportunities moved in client successfully';
						$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect('opportunities');
					}
				}
			}
		}
		if($id && $this->checkSessionAdmin())
		{
			$this->data['quotation_list'] = $this->comman_model->getData('tbl_quotation' , array('lead_id' => $id));
			$quotation_list  = $this->data['quotation_list'];
			if(!empty($quotation_list))
			{
				$this->show_view_admin('opportunities/move_to_client' , $this->data);
			}
			else
			{
				redirect('opportunities');
			}
		}
		else
		{
			redirect('opportunities');
		}
	}

	public function viewProcessDetails($process_id = '')
	{
		if($process_id)
		{
			$this->data['process_details'] = $this->opportunities_model->getProcessDtailsById($process_id);
			$this->show_view_admin('opportunities/view_process_details',$this->data);
		}
		else
		{
			redirect(base_url().'opportunities');
		}
	}

	public function opportunitiesProductData()
	{
		if(isset($_POST['action_load_product']))
		{
			$data['items_list'] = $this->comman_model->getData('tbl_items');
			$this->load->view('leads/product_modal' , $data );
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
			$this->load->view('opportunities/added_product_list' , $data );
		}
	}

	public function removeLeadProductsById()
	{
		if(isset($_POST['lead_product_id']))
		{
			$id = $_POST['lead_product_id'];
			echo $this->comman_model->deleteData('tbl_lead_product' , array('product_id' => $id , 'lead_id' => $_POST['lead_id']));
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
					$this->load->view('opportunities/added_product_list' , $data);
				}
				else
				{
					$data['items_list'] = $this->comman_model->getData('tbl_items' , array('item_id' => $post['item_id']));
					$data['new_item_id'] = $post['item_id'];
					$this->load->view('opportunities/added_product_list' , $data);
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
							$lp_post['lead_product_id']   = round(microtime(true) * 1000);
							$lp_post['product_type']	  = 'opportunitie_process';
							$lp_post['lead_id'] 		  = $leads_id;
							$lp_post['product_id'] 		  = $lp_res->item_id;
							$lp_post['product_name'] 	  = $lp_res->item_name;
							$lp_post['product_price'] 	  = $lp_res->unit_cost;
							$lp_post['product_desc'] 	  = $lp_res->item_desc;
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

	public function view_sample($id = '')
	{
		if($id)
		{
			$this->data['sample_details'] = $this->comman_model->getData('tbl_sample_request', $id);
			$this->load->view('opportunities/sample_request',$this->data);
		}
		else
		{
			echo "fail"; die();
		}
	}
}
/* End of file */?>