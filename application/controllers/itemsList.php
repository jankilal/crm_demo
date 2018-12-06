<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ItemsList extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('itemsList_model');
		
	}	

	public function index()
	{
		if($this->checkViewPermission())
		{		
			$this->data['item_result'] = $this->itemsList_model->getAllitem();
			$this->data['advance_data_tbl'] = '1';				
			$this->show_view_admin('item/item',$this->data);
		}
		else
		{	
			redirect(base_url().'dashboard/error/1');
		}
    }

    /* Add and Update */
	public function additem($item_id = '')
	{ 
		if($item_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit")
				{	
					$post['item_name'] 			= $this->input->post('item_name');
					$post['unit_cost'] 			= $this->input->post('unit_cost');
					$post['item_desc'] 			= $this->input->post('description');
					$post['quantity'] 			= $this->input->post('quantity');
					$post['item_tax_rate'] 		= $this->input->post('item_tax_rate');
					// $post['item_description'] 	= $this->input->post('item_description');
					$c_post 	    = commanPostArray('update');
					$add_post  		= array_merge($post,$c_post);
					$item_res =  $this->comman_model->updateData('tbl_items' , array('item_id' => $item_id) , $add_post);

					$product_details_array = $this->input->post('product_details');
					if(!empty($product_details_array) && count($product_details_array) > 0)
					{
						for ($i=0; $i< count($product_details_array); $i++) 
						{ 
							$attachment_images = array();
							/**** ADD MULTIPLE HOME TEMPLATE IMAGES *******/
							if($_FILES["product_img_file_".$i]['name'][0] != '')
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
					                  $post_img = $imagePath.''.$imageName;
					              	}
									$attachment_images[] =$post_img;
								} // END FOR LOOP							

							} // CHECK GALLERY IMAGE IS EXIST

							$p_post['item_id'] = $item_id;
							$p_post['item_doc_id'] = $this->generate_id();
							$p_post['item_attachment'] = serialize($attachment_images);
							$p_post['item_description'] = $product_details_array[$i];
							$this->comman_model->addData('tbl_item_attachment' , $p_post);
						}
					}

					if($item_res)
					{					
						$msg = 'Item Update successfully!!';					
						$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().'itemsList');
					}
				}
				else
				{	
				$this->data['edit_item'] = $this->itemsList_model->edititem($item_id);
				$this->data['attachment_list'] = $this->comman_model->getData('tbl_item_attachment', array('item_id'=>$item_id));
				$this->show_view_admin('item/item_update', $this->data);
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
					$post['item_id'] 	= round(microtime(true) * 1000);
		         	$post['item_name'] 	= $this->input->post('item_name');
		         	$post['unit_cost'] 	= $this->input->post('unit_price');
					$post['item_desc'] 	= $this->input->post('description');
					$post['quantity'] 	= $this->input->post('quantity');
					$post['item_tax_rate'] = $this->input->post('item_tax_rate');
					$c_post 			    = commanPostArray('create');
					$add_post  				= array_merge($post,$c_post);
					
					$item_id =  $this->comman_model->addData('tbl_items', $add_post);
					if($item_id)
					{
						$product_details_array = $this->input->post('product_details');
						if(!empty($product_details_array) && count($product_details_array) > 0)
						{
							for ($i=0; $i< count($product_details_array); $i++) 
							{ 
								$attachment_images = array();
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
						                  $post_img = $imagePath.''.$imageName;
						              	}
										$attachment_images[] =$post_img;
									} // END FOR LOOP							
									$p_post['item_id'] = $post['item_id'];
									$p_post['item_doc_id'] = $this->generate_id();
									$p_post['item_attachment'] = serialize($attachment_images);
									$p_post['item_description'] = $product_details_array[$i];
									$this->comman_model->addData('tbl_item_attachment' , $p_post);

								} // CHECK GALLERY IMAGE IS EXIST
							}
						}
						if($item_id)
						{	
							$msg = 'Item added successfully!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'itemsList');			
						}
					}		
					else
					{	
						$this->data['GoalTracking_category'] = $this->itemsList_model->getALLitemcategory();
						$this->show_view_admin('item/item_add', $this->data);
					}
				}
				else
				{
					$this->show_view_admin('item/item_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'dashboard/error/1');
			}
		}		
	}
	
	public function removeItemById()
	{
		if(isset($_POST['id']))
		{	
			$id = $_POST['id'];
			echo $this->comman_model->deleteData('tbl_item_attachment' , array('item_doc_id' => $id ));
		}
	}
	/* Delete */
	public function deleteitem()
	{
		if($this->checkDeletePermission())
		{
			$item_id = $this->uri->segment(3);
				$this->comman_model->deleteData('tbl_items', array('item_doc_id' => $item_id));
			// $this->itemsList_model->deleteitem($id);
			
				$msg = 'Item remove successfully...!';					
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'itemsList');			
		}
		else
		{
			redirect( base_url().'dashboard/error/1');
		}		
	}

	
}
/* End of file */