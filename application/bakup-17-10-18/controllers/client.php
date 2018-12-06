<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Client extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('client_model');
	}	
	/*	Validation Rules */
	 protected $validation_rules = array
        (
        'clientAdd' => array(
           array(
                'field' => 'client_name',
                'label' => ' client name',
                'rules' => 'trim|required'
            ),
			array(
                'field' => 'client_email',
                'label' => 'client email',
                'rules' => 'trim|required|is_unique[tbl_user.user_email]'
            ),
			array(
                'field' => 'client_phone',
                'label' => 'client phone',
                'rules' => 'trim|required'
            ),
             array( 
				'field' => 'client_password', 
				'label' => 'Password',   
				'rules' => 'trim|required'  
			),
			array(  
				'field' => 'client_conf_password',
				'label' => 'Confirm Password', 
				'rules' => 'trim|required|matches[client_password]'
            ),			
            array(
                'field' => 'client_country_id',
                'label' => 'Country',
                'rules' => 'trim|required'
            ),

            array(
                'field' => 'client_address',
                'label' => 'Address',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'client_state_id',
                'label' => 'State',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'client_city',
                'label' => 'city',
                'rules' => 'trim|required'
            ),           
            array(
                'field' => 'client_zip_code',
                'label' => 'Zip code',
                'rules' => 'trim|required'
            )           
        ),
		'clientEdit' => array(
        	
            array(
                'field' => 'client_name',
                'label' => ' client name',
                'rules' => 'trim|required'
            ),			
			array(
                'field' => 'client_phone',
                'label' => 'client phone',
                'rules' => 'trim|required'
            ),            	
            array(
                'field' => 'client_country_id',
                'label' => 'Country',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'client_address',
                'label' => 'Address',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'client_state_id',
                'label' => 'State',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'client_city',
                'label' => 'city',
                'rules' => 'trim|required'
            ),           
            array(
                'field' => 'client_zip_code',
                'label' => 'Zip code',
                'rules' => 'trim|required'
            )           
        )
    );
	
	
	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{			

			$this->data['client_result'] = $this->client_model->getAllclient();

			 // echo "<pre>"; print_r($this->data['client_result'] ); die();
			$this->show_view_admin('client/client', $this->data);
		}
    }

    public function addClientProcess()
    {
    	$this->session->unset_userdata('client_process');
   		
        if(isset($_POST['submit']) && $_POST['submit'] != '')
    	{
			$post['client_process_id'] 	  = round(microtime(true) * 1000);
    		$post['lead_id']              = $this->input->post('client_id');;
    		$post['client_process_date']   = $this->input->post('client_process_date');
    		$post['client_process_type']   = $this->input->post('client_process_type');
    		$post['status']				  = '1';
  			$this->session->set_userdata('client_process' , $post);
			redirect(base_url().'client/clientProcessDetail');
    	}			
    	else
    	{
    		$this->session->set_userdata('client_process' , $post);
    	}
    }

    public function clientProcessDetail()
    {	
    	$client_process_data = $this->session->userdata('client_process');

		if (!empty($client_process_data)) 
		{
			$client_id = $client_process_data['lead_id'];

			if(isset($_POST['Submit']) && $_POST['Submit'] == 'Add')
			{
				 // echo "<pre>"; print_r($_POST); die();
				//Send Final Quotation Section 
				$items_list = array();
				if(sizeof(json_decode($_POST['product_id_array'])>0))
				{
					$process_products = json_decode($_POST['product_id_array']);
					if(!empty($process_products))
					{
						$items_list = $this->comman_model->getDataV2('tbl_items','where_in',array('item_id' => $process_products));
					}
				}
				


				// if(isset($_POST['move_to_client']) && $_POST['move_to_client'] == 'move')
				// {				
				// 	//##### Update Opportunity  To Client Status ##########	
				// 	$o_post['opportunity_status'] = '2';
				// 	$update_res = $this->client_model->UpdateOpportunityClientStatus($client_process_data['client_id'],$o_post);
				// }

				$op_post['client_process_id']  = round(microtime(true)* 1000);
				$op_post['client_id']          = $client_process_data['lead_id'];
				$op_post['client_process_date']= $client_process_data['client_process_date'];
				$op_post['client_process_type']= $client_process_data['client_process_type'];
				$op_post['client_process_status'] = '1';
				$op_post['client_process_created_date'] = date('Y-m-d');
				$process_id = $this->comman_model->addData('tbl_client_process', $op_post);
				
				// $process_id = $this->client_model->addOpportunitiesProcess($op_post);
				if($process_id)
				{
					$q_post['quote_id']		    =  round(microtime(true) * 1000);
					$q_post['lead_id']		    =  $client_id;
					$q_post['quote_to']		  	= $this->input->post('quote_to');
					$q_post['address1'] 	    = $this->input->post('address1');
					$q_post['address2'] 	  	= $this->input->post('address2');
					$q_post['location'] 	   	= $this->input->post('location');
					$q_post['city'] 	 	  	= $this->input->post('city');
					$q_post['additional_req'] 	= $this->input->post('additional_req');
					$q_post['quote_subtotal']	= $this->input->post('quote_subtotal');
					$q_post['submition_date']	= date('Y-m-d H:i:s');

					$last_result = $this->comman_model->getData('tbl_quotation' , NULL, 'single', 'DESC' ,1);
					if (!empty($last_result)) 
					{
						// $q_post['quote_name'] 		= $lead_details->organization.'-'.'V'.$last_result->id;
						// $q_post['quote_version'] 	='V'.$last_result->id;
					}
					else
					{
						$q_post['quote_name'] 		=1;
						$q_post['quote_version'] 	=1;
					}
					
					$quote_id= $this->comman_model->addData('tbl_quotation', $q_post);

					if(isset($_POST['selected_products']))
					{
						$qp_product_id   =  $this->input->post('selected_products');
						$qp_product_name = $this->input->post('qp_product_name');
						$qp_product_des = $this->input->post('qp_product_des');
						$qp_product_qty  = $this->input->post('qp_product_qty');
						$qp_product_price= $this->input->post('qp_product_price');

						for($i=0; $i<count($_POST['selected_products']); $i++)
						{
							$qp_post['quote_poroduct_id'] = $this->generate_id();
							$qp_post['quote_id']	   = $q_post['quote_id'];
							$qp_post['product_name']   = $qp_product_name[$i];
							$qp_post['product_desc']   = $qp_product_des[$i];
							$qp_post['product_qty']    = $qp_product_qty[$i];
							$qp_post['product_price']  = $qp_product_price[$i];
							$qp_post['type']  = 'client';

							$quote_product_id = $this->comman_model->addData('tbl_quotation_products', $qp_post);
						}	
					}
					
					// SEND QUOTATION SECTION END
					$post['client_process_details_id']  = round(microtime(true)* 1000);
					$post['client_process_id'] = $process_id;
					$post['meeting_minutes']          = $this->input->post('meeting_minutes');
					$post['response_levels']          = $this->input->post('response_levels');
					$post['next_meeting_call']        = $this->input->post('next_meeting_call');
					$post['to_do_list']               = $this->input->post('to_do_list');
					$post['next_meeting_date']        = $this->input->post('next_meeting_date');
					$post['next_meeting_time']        = $this->input->post('next_meeting_time');
					$post['sample_request']           = $this->input->post('sample_request');
					$post['quote_request']            = $this->input->post('quote_request');
				}
				 $process_details_id = $this->comman_model->addData('tbl_client_process_details', $post);
				 
				if($process_details_id)
				{

					if(!empty($items_list))
					{
						foreach ($items_list as $value) 
						{
							$checkProduct = $this->comman_model->getData('tbl_lead_product' , array('lead_id' => $client_process_data['lead_id'] , 'product_id' => $value->item_id));

						
							if(empty($checkProduct))
							{
								$p_post['product_type']		   = 'opportunitie_process';
							    $p_post['lead_id'] 	   		   = $client_process_data['lead_id'];
								$p_post['opportunity_process_id'] =  $process_id;
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
					if($process_details_id)
					{
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
											$sr_post['lead_id'] = $client_process_data['lead_id'];
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
						$this->session->unset_userdata('client_process');
						redirect(base_url().'client');
					}
					$this->session->unset_userdata('client_process');
					redirect(base_url().'client');
				}
			}
			$this->data['leads_products']   = $this->comman_model->getData('tbl_lead_product' , array('lead_id' => $client_id));

		    $this->data['send_quote_detail']= $this->comman_model->getData('tbl_leads' , array('lead_id'=>$client_id));

		    $this->data['approvedQuote']= $this->comman_model->getData('tbl_client_quotation', array('lead_id'=>$client_id));
// echo("<pre>"); print_r($this->data['approvedQuote']); die();


			$this->data['process_list'] = $this->comman_model->getData('tbl_quotation', array('lead_id'=>$client_id));
		     // $this->data['process_list']    = $this->client_model->getAllClientProcessList($client_id);
		   // echo "<pre>"; print_r($this->data['process_list']); die();
			
		    $lead_details = $this->comman_model->getData('tbl_leads', array('lead_id'=>$client_id));

			// $this->data['process_list'] = $this->client_model->getAllOpportunitiesProcessList($client_id);

	    	$client_process_data = $this->session->userdata('client_process');
	    	$this->show_view_admin('client/client_process_detail',$this->data);

        }
    }

    public function viewProcessDetails($process_id='')
	{
		if ($process_id) 
		{	
			
			 $this->data['process_details'] =$this->comman_model->getData('tbl_quotation',array('quote_id'=>$process_id));
			$this->data['products_details']= $this->comman_model->getData('tbl_quotation_products' , array('quote_id' => $process_id));
		$this->show_view_admin('client/view_process_details',$this->data);		
		}
		else
		{
			 redirect(base_url().'client');
		}
	}


    /* Add and Update */
	public function addClient($client_id='')
	{
		if($client_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{
					
					$this->form_validation->set_rules($this->validation_rules['clientEdit']);
					if($this->form_validation->run())
					{

						$post['user_full_name'] = $this->input->post('client_name');
						$post['user_email'] = $this->input->post('client_email');
						if(isset($_POST['client_new_pass']) && $_POST['client_new_pass'] != '')
						{
							$post['user_password'] = md5($this->input->post('client_new_pass'));
						}

						$post['user_phone'] = $this->input->post('client_phone');						
						$post['user_city'] = $this->input->post('client_city');
						$post['user_zip_code'] = $this->input->post('client_zip_code');
						
						$post['user_country_id'] = $this->input->post('client_country_id');
						$post['user_state_id'] = $this->input->post('client_state_id');
						$post['user_address'] = $this->input->post('client_address');
						$post['user_currency_type'] = $this->input->post('client_currency_type');
						$post['user_short_note'] = $this->input->post('client_short_note');
						$post['user_fax'] = $this->input->post('client_fax');
						$post['user_website'] = $this->input->post('client_website');
						$post['user_skype_id'] = $this->input->post('client_skype_id');
						$post['user_facebook_url'] = $this->input->post('client_fb_id');
						$post['user_twitter_id'] = $this->input->post('client_twitter_id');
						$post['user_linkedin_url'] = $this->input->post('client_linkedin_url');
						$post['user_status'] = $this->input->post('client_status');					
						$post['user_created_date'] = date('Y-m-d');
						$post['user_update_date'] = date('Y-m-d');
						
						
						if ($_FILES["client_img"]["name"])
						{
	                        $client_img = 'client_img';
	                        $fieldName = "client_img";
	                        $Path = 'webroot/upload/user/';
	                         $client_img = $this->ImageUpload($_FILES["client_img"]["name"], $client_img, $Path, $fieldName);
	                        $post['user_profile_img'] = $Path.''.$client_img;
	                    }	     
	                    
						$client_id =  $this->client_model->updateClient($post,$client_id);	

						if($client_id)
						{					
							$msg = 'Client Update successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'client');
						}
					}
					else
					{				
						$this->data['edit_client'] = $this->client_model->editClient($client_id);
						// echo "<pre>"; print_r($this->data['edit_client']); die();
						$this->data['country_list'] = $this->client_model->getCountryList();
						$this->data['role_list'] = $this->client_model->getRoleList();
						$this->data['state_list'] = $this->client_model->getStateList();		
						$this->show_view_admin('admin/client_update', $this->data);
					}		
				}
				else
				{
					$this->data['edit_client'] = $this->client_model->editClient($client_id);
					// echo "<pre>"; print_r($this->data['edit_client']) ; die();
					$this->data['country_list'] = $this->client_model->getCountryList();
					$this->data['role_list'] = $this->client_model->getRoleList();
					$this->data['state_list'] = $this->client_model->getStateList();
					// $this->data['opp_reson_states']   = $this->comman_model->getData('tbl_opportu_state_reason', array('client_state_reason_status'=>1));

					$this->data['quotation_list'] = $this->comman_model->getDataV2('tbl_quotation','where_in',array('lead_id' => $client_id));
					// echo "<pre>"; print_r($quotation_list); die();
					$this->data['approvedQuote']= $this->comman_model->getData('tbl_client_quotation', array('lead_id'=>$client_id));

					$this->show_view_admin('client/client_view', $this->data);
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
					
					$this->form_validation->set_rules($this->validation_rules['clientAdd']);
					if($this->form_validation->run())
					{
						$post['user_full_name'] = $this->input->post('client_name');
						$post['user_email'] = $this->input->post('client_email');
						$post['user_phone'] = $this->input->post('client_phone');
						$post['user_password'] = md5($this->input->post('client_password'));
						$post['user_city'] = $this->input->post('client_city');
						$post['user_zip_code'] = $this->input->post('client_zip_code');
						
						$post['user_country_id'] = $this->input->post('client_country_id');
						$post['user_state_id'] = $this->input->post('client_state_id');
						$post['user_address'] = $this->input->post('client_address');
						$post['user_currency_type'] = $this->input->post('client_currency_type');
						$post['user_short_note'] = $this->input->post('client_short_note');
						$post['user_fax'] = $this->input->post('client_fax');
						$post['user_website'] = $this->input->post('client_website');
						$post['user_skype_id'] = $this->input->post('client_skype_id');
						$post['user_facebook_url'] = $this->input->post('client_fb_id');
						$post['user_twitter_id'] = $this->input->post('client_twitter_id');
						$post['user_linkedin_url'] = $this->input->post('client_linkedin_url');
						$post['user_status'] = $this->input->post('client_status');
						$post['user_role_id'] = '3';
						$post['user_type'] = 'Client';
						$post['user_created_date'] = date('Y-m-d');
						$post['user_update_date'] = date('Y-m-d');
						$post['added_by'] = $this->data['user_id'];
						
						if ($_FILES["client_img"]["name"])
						{
	                        $client_img = 'client_img';
	                        $fieldName = "client_img";
	                        $Path = 'webroot/upload/user/';
	                         $client_img = $this->ImageUpload($_FILES["client_img"]["name"], $client_img, $Path, $fieldName);
	                        $post['user_profile_img'] = $Path.''.$client_img;
	                    }

						$client_id =  $this->client_model->addclient($post);	
						if($client_id)
						{					
							$msg = 'Client added successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'client');
						}
					}
					else
					{				
						$this->data['country_list'] = $this->client_model->getCountryList();
						$this->data['role_list'] = $this->client_model->getRoleList();
						// $this->data['approvedQuote']= $this->comman_model->getData('tbl_client_quotation', array('lead_id'=>$client_id));	
						$this->show_view_admin('admin/client_view', $this->data);
					}		
				}
				else
				{

					$this->data['country_list'] = $this->client_model->getCountryList();
					$this->data['role_list'] = $this->client_model->getRoleList();
					$this->show_view_admin('admin/client_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'dashboard/error/1');
			}
		}		
	}
	
	/* Delete */
	public function delete_client()
	{
		if($this->checkDeletePermission())
		{
			$client_id = $this->uri->segment(3);	
			$this->client_model->deleteClient($client_id);
			if ($this->db->_error_number() == 1451)
			{		
				$msg = 'You need to delete child category first';
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'client'); 
			}
			else
			{
				$msg = 'client remove successfully...!';					
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'client');
			}
		}
		else
		{
			redirect( base_url().'dashboard/error/1');
		}		
	}

	/* Get State List */
	public function getStateList()
	{
		$country_id = $this->input->post('country_id');
		$state_list = $this->client_model->getStateListByCountryId($country_id);

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
			echo $this->comman_model->deleteData('tbl_lead_product' , array('product_id' => $id , 'lead_id' => $_POST['lead_id']));
		}
	}
	public function addNewLeadProduct()
	{
		if(isset($_POST['action_add_product']) && $_POST['action_add_product'] == 'Add Product')
		{
			$post['item_name']     = $this->input->post('item_name');
	     	$post['unit_cost']     = $this->input->post('unit_price');
			$post['item_desc']     = $this->input->post('description');
			$post['quantity']      = $this->input->post('quantity');
			$post['item_tax_rate'] = $this->input->post('item_tax_rate');
			$item_id =  $this->comman_model->addData('tbl_items', $post);
			if($item_id)
			{
				$added_items_ids = json_decode($_POST['ids_array']);
				array_push($added_items_ids, $item_id);
				$data['items_list'] = $this->comman_model->getDataV2('tbl_items' , 'where_in' , array('item_id' => $added_items_ids));
				$data['new_item_id'] = $item_id;
				$this->load->view('leads/added_product_list' , $data);
			}
		}
	}

}
/* End of file */?>