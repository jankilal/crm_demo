<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Quotations extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('quotations_model');
		$this->load->model('quotations_model');
	}	
	/*	Validation Rules */
	 protected $validation_rules = array
        (
        'quotationsAdd' => array(
           array(
                'field' => 'opportunities_id',
                'label' => 'Opportunity',
                'rules' => 'trim|required'
            ),	
          	
           array(
                'field' => 'quotation_version',
                'label' => 'Quotation version',
                'rules' => 'trim|required'
            ),		
           array(
                'field' => 'quotation_time_from',
                'label' => 'Quotation time from',
                'rules' => 'trim|required'
            ),		
           array(
                'field' => 'quotation_budget',
                'label' => 'Quotation budget',
                'rules' => 'trim|required'
            ),		
           array(
                'field' => 'quotation_valid_up_to',
                'label' => 'Quotation valid up to',
                'rules' => 'trim|required'
            )          
        )    
    );	
	
	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{			
			if (login_role == '1') 
			{
				$this->data['quotations_result'] = $this->quotations_model->getAllQuotations();	
                $this->data['advance_data_tbl'] = '1';				
			}
			else
			{

				$this->data['quotations_result'] = $this->quotations_model->getAllQuotationsBYUserLogin(login_user);	
                $this->data['advance_data_tbl'] = '1';				
			}
			
			$this->show_view_admin('quotations/quotations', $this->data);
		}
		else
		{	
			redirect(base_url().'dashboard/error/1');
		}
    }

    /* Add and Update */
	public function addQuotations($quotations_id = '')
	{
		if($quotations_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{
					
					$this->form_validation->set_rules($this->validation_rules['quotationsAdd']);
					if($this->form_validation->run())
					{						
						$post['opportunities_id'] = $this->input->post('opportunities_id');						
						$post['quotation_version'] = $this->input->post('quotation_version');
						$post['quotation_time_from'] = $this->input->post('quotation_time_from');
						$post['quotation_budget'] = $this->input->post('quotation_budget');
						$post['quotation_valid_up_to'] = $this->input->post('quotation_valid_up_to');
						$post['terms_condition'] = $this->input->post('terms_condition');
						$post['quotation_attachment'] = $this->input->post('quotation_attachment');
						$post['quotation_repaly_date'] = $this->input->post('quotation_repaly_date');
						$post['quotation_status'] = $this->input->post('quotation_status');					
						$post['quotation_update_date'] = date('Y-m-d');
						if(!empty($_POST['opportunities_product_id']))
						{
							$post['opportunities_product_id'] = implode(',',$this->input->post('opportunities_product_id'));
						}
						$quotations_id = $this->quotations_model->updateQuotations($quotations_id,$post);
						if($quotations_id)
						{
							if(isset($_POST['product_details']))
							{
								$product_details_array = $this->input->post('product_details');
								for ($i=0; $i < count($product_details_array); $i++) 
								{ 
									$p_post['product_details'] = $product_details_array[$i];
									$p_post['quotations_id'] = $quotations_id;
									$quotations_products_id = $this->quotations_model->addQuotationsProducts($p_post);
									if($quotations_products_id)
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
								                   	$post_img['product_file_name'] = $imagePath.''.$imageName;
													$post_img['products_id'] =  $quotations_products_id;	
													$post_img['quotations_id'] = $quotations_id;	
													$this->quotations_model->addQuotationsProductsFile($post_img);
								              	}

											} // END FOR LOOP

										} // CHECK GALLERY IMAGE IS EXIST
									}//product detail if
								}
							}	
							$msg = 'quotations added successfully..!';
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'quotations');
						}
					}
					else
					{				
						$this->data['edit_quotations'] = $this->quotations_model->editQuotations($quotations_id);
						$this->data['role_list'] = $this->quotations_model->getRoleList();						
						$this->data['opportunities_result'] = $this->quotations_model->getAllOpportunities();
						$this->show_view_admin('quotations/quotations_update', $this->data);
					}		
				}
				else
				{
					$this->data['edit_quotations'] = $this->quotations_model->editquotations($quotations_id);				
					$this->data['role_list'] = $this->quotations_model->getRoleList();					
					$this->data['opportunities_result'] = $this->quotations_model->getAllOpportunities();
					$this->show_view_admin('quotations/quotations_update', $this->data);
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
					$this->form_validation->set_rules($this->validation_rules['quotationsAdd']);
					if($this->form_validation->run())
					{					
											
						$post['opportunities_id'] = $this->input->post('opportunities_id');						
						$post['quotation_version'] = $this->input->post('quotation_version');
						$post['quotation_time_from'] = $this->input->post('quotation_time_from');
						$post['quotation_budget'] = $this->input->post('quotation_budget');
						$post['quotation_valid_up_to'] = $this->input->post('quotation_valid_up_to');
						$post['terms_condition'] = $this->input->post('terms_condition');
						$post['quotation_attachment'] = $this->input->post('quotation_attachment');
						$post['quotation_repaly_date'] = $this->input->post('quotation_repaly_date');
						$post['quotation_status'] = $this->input->post('quotation_status');
						$post['quotation_created_date'] = date('Y-m-d');
						$post['quotation_update_date'] = date('Y-m-d');
						if(!empty($_POST['opportunities_product_id']))
						{
							$post['opportunities_product_id'] = implode(',',$this->input->post('opportunities_product_id'));
						}
						$quotations_id = $this->quotations_model->addQuotations($post);
						if($quotations_id)
						{

							if(isset($_POST['product_details']))
							{
								$product_details_array = $this->input->post('product_details');
								for ($i=0; $i < count($product_details_array); $i++) 
								{ 
									$p_post['product_details'] = $product_details_array[$i];
									$p_post['quotations_id'] = $quotations_id;
									$quotations_products_id = $this->quotations_model->addQuotationsProducts($p_post);
									if($quotations_products_id)
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
								                   	$post_img['product_file_name'] = $imagePath.''.$imageName;
													$post_img['products_id'] =  $quotations_products_id;	
													$post_img['quotations_id'] = $quotations_id;	
													$this->quotations_model->addQuotationsProductsFile($post_img);
								              	}

											} // END FOR LOOP

										} // CHECK GALLERY IMAGE IS EXIST
									}//product detail if
								}
							}	
							$msg = 'quotations added successfully..!';
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'quotations');
						}
					}
					else
					{		
						
						$this->data['role_list'] = $this->quotations_model->getRoleList();
						$this->data['opportunities_result'] = $this->quotations_model->getAllOpportunities();
						$this->show_view_admin('quotations/quotations_add', $this->data);
					}		
				}
				else
				{
					
					$this->data['role_list'] = $this->quotations_model->getRoleList();					
					$this->data['opportunities_result'] = $this->quotations_model->getAllOpportunities();	
					$this->show_view_admin('quotations/quotations_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'dashboard/error/1');
			}
		}		
	}

	public function viewQuote($quote_id)
	{
		$this->data['quote_details']	= $this->comman_model->getData('tbl_quotation' , array('quote_id' => $quote_id));
		$this->data['product_details']	= $this->comman_model->getData('tbl_quotation_products' , array('quote_id' => $quote_id));
		$this->show_view_admin('quotations/quotation_view', $this->data);
	}
	/* Delete */
	public function deletequotations()
	{
		if($this->checkDeletePermission())
		{
			$quotations_id = $this->uri->segment(3);	
			$this->quotations_model->deletequotations($quotations_id);
			
				$msg = 'quotations remove successfully...!';					
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'quotations');			
		}
		else
		{
			redirect( base_url().'dashboard/error/1');
		}		
	}

	/* Get State List */
	public function getOpportunityProducts()
	{
		$opportunity_id = $this->input->post('opportunity_id');
		$products_list = $this->quotations_model->getOpportunityProducts($opportunity_id);

		$html = '';
		if(!empty($products_list))
		{
			$html = '<table class="table table-striped table-bordered table-hover" id="datatable_sample"><thead><tr><th>Select</th><th>Product Details</th></tr></thead><tbody>';		

			foreach ($products_list as $op_list) 
			{
				$html .= '<tr><td width="6%"><input type="checkbox" class="checkboxes" name="opportunities_product_id[]" value="'.$op_list->opportunities_products_id.'"/></td><td>'.$op_list->product_details.'</td></tr>';
			}
			$html .= '</tbody></table>';
			echo $html; 
		}
		else
		{
			echo $html;
		}
	}

	function changequotationstatus($lead_status = '',$quotations_id='')
	{
		if($lead_status != '' && $quotations_id != '')
		{
			$change_status = $this->quotations_model->changequotationstatus($lead_status,$quotations_id);
			if($change_status)
			{
				redirect(base_url().'quotations');
			}

		}
	}

}
/* End of file */?>