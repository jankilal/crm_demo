<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Deposit extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('deposit_model');
	}	
	/*	Validation Rules */
	 protected $validation_rules = array
        (
        'depositAdd' => array(
           array(
                'field' => 'deposit_name',
                'label' => ' deposit name',
                'rules' => 'trim|required'
            ),
			array(
                'field' => 'deposit_email',
                'label' => 'deposit email',
                'rules' => 'trim|required|is_unique[tbl_user.user_email]'
            ),
			array(
                'field' => 'deposit_phone',
                'label' => 'deposit phone',
                'rules' => 'trim|required'
            ),
             array( 
				'field' => 'deposit_password', 
				'label' => 'Password',   
				'rules' => 'trim|required'  
			),
			array(  
				'field' => 'deposit_conf_password',
				'label' => 'Confirm Password', 
				'rules' => 'trim|required|matches[deposit_password]'
            ),			
            array(
                'field' => 'deposit_country_id',
                'label' => 'Country',
                'rules' => 'trim|required'
            ),

            array(
                'field' => 'deposit_address',
                'label' => 'Address',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'deposit_state_id',
                'label' => 'State',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'deposit_city',
                'label' => 'city',
                'rules' => 'trim|required'
            ),           
            array(
                'field' => 'deposit_zip_code',
                'label' => 'Zip code',
                'rules' => 'trim|required'
            )           
        ),
		'depositEdit' => array(
        	
            array(
                'field' => 'deposit_name',
                'label' => ' deposit name',
                'rules' => 'trim|required'
            ),			
			array(
                'field' => 'deposit_phone',
                'label' => 'deposit phone',
                'rules' => 'trim|required'
            ),            	
            array(
                'field' => 'deposit_country_id',
                'label' => 'Country',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'deposit_address',
                'label' => 'Address',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'deposit_state_id',
                'label' => 'State',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'deposit_city',
                'label' => 'city',
                'rules' => 'trim|required'
            ),           
            array(
                'field' => 'deposit_zip_code',
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
			$this->data['deposit_result'] = $this->deposit_model->getAlldeposit();
			$this->show_view_admin('transactions/deposit', $this->data);
		}
		else
		{	
			redirect(base_url().'dashboard/error/1');
		}
    }


    /* Add and Update */
	public function adddeposit($deposit_id='')
	{
		if($deposit_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{
					
					$this->form_validation->set_rules($this->validation_rules['depositEdit']);
					if($this->form_validation->run())
					{
						$post['user_id'] = $deposit_id;
						$post['user_full_name'] = $this->input->post('deposit_name');
						$post['user_email'] = $this->input->post('deposit_email');
						$post['user_phone'] = $this->input->post('deposit_phone');						
						$post['user_city'] = $this->input->post('deposit_city');
						$post['user_zip_code'] = $this->input->post('deposit_zip_code');
						
						$post['user_country_id'] = $this->input->post('deposit_country_id');
						$post['user_state_id'] = $this->input->post('deposit_state_id');
						$post['user_address'] = $this->input->post('deposit_address');
						$post['user_currency_type'] = $this->input->post('deposit_currency_type');
						$post['user_short_note'] = $this->input->post('deposit_short_note');
						$post['user_fax'] = $this->input->post('deposit_fax');
						$post['user_website'] = $this->input->post('deposit_website');
						$post['user_skype_id'] = $this->input->post('deposit_skype_id');
						$post['user_facebook_url'] = $this->input->post('deposit_fb_id');
						$post['user_twitter_id'] = $this->input->post('deposit_twitter_id');
						$post['user_linkedin_url'] = $this->input->post('deposit_linkedin_url');
						$post['user_status'] = $this->input->post('deposit_status');					
						$post['user_created_date'] = date('Y-m-d');
						$post['user_update_date'] = date('Y-m-d');
						
						if ($_FILES["deposit_img"]["name"])
						{
	                        $deposit_img = 'deposit_img';
	                        $fieldName = "deposit_img";
	                        $Path = 'webroot/upload/user/';
	                         $deposit_img = $this->ImageUpload($_FILES["deposit_img"]["name"], $deposit_img, $Path, $fieldName);
	                        $post['user_profile_img'] = $Path.''.$deposit_img;
	                    }	     

						$deposit_id =  $this->deposit_model->updatedeposit($post);	
						if($deposit_id)
						{					
							$msg = 'deposit Update successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'deposit');
						}
					}
					else
					{				
						$this->data['edit_deposit'] = $this->deposit_model->editdeposit($deposit_id);
						$this->data['country_list'] = $this->deposit_model->getCountryList();
						$this->data['role_list'] = $this->deposit_model->getRoleList();
						$this->data['state_list'] = $this->deposit_model->getStateList();		
						$this->show_view_admin('deposit_update', $this->data);
					}		
				}
				else
				{
					$this->data['edit_deposit'] = $this->deposit_model->editdeposit($deposit_id);
					$this->data['country_list'] = $this->deposit_model->getCountryList();
					$this->data['role_list'] = $this->deposit_model->getRoleList();
					$this->data['state_list'] = $this->deposit_model->getStateList();
					$this->show_view_admin('transactions/deposit_update', $this->data);
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
					
					$this->form_validation->set_rules($this->validation_rules['depositAdd']);
					if($this->form_validation->run())
					{
						$post['user_full_name'] = $this->input->post('deposit_name');
						$post['user_email'] = $this->input->post('deposit_email');
						$post['user_phone'] = $this->input->post('deposit_phone');
						$post['user_password'] = $this->input->post('deposit_password');
						$post['user_city'] = $this->input->post('deposit_city');
						$post['user_zip_code'] = $this->input->post('deposit_zip_code');
						
						$post['user_country_id'] = $this->input->post('deposit_country_id');
						$post['user_state_id'] = $this->input->post('deposit_state_id');
						$post['user_address'] = $this->input->post('deposit_address');
						$post['user_currency_type'] = $this->input->post('deposit_currency_type');
						$post['user_short_note'] = $this->input->post('deposit_short_note');
						$post['user_fax'] = $this->input->post('deposit_fax');
						$post['user_website'] = $this->input->post('deposit_website');
						$post['user_skype_id'] = $this->input->post('deposit_skype_id');
						$post['user_facebook_url'] = $this->input->post('deposit_fb_id');
						$post['user_twitter_id'] = $this->input->post('deposit_twitter_id');
						$post['user_linkedin_url'] = $this->input->post('deposit_linkedin_url');
						$post['user_status'] = $this->input->post('deposit_status');
						$post['user_role_id'] = '3';
						$post['user_type'] = 'deposit';
						$post['user_created_date'] = date('Y-m-d');
						$post['user_update_date'] = date('Y-m-d');
						
						if ($_FILES["deposit_img"]["name"])
						{
	                        $deposit_img = 'deposit_img';
	                        $fieldName = "deposit_img";
	                        $Path = 'webroot/upload/user/';
	                         $deposit_img = $this->ImageUpload($_FILES["deposit_img"]["name"], $deposit_img, $Path, $fieldName);
	                        $post['user_profile_img'] = $Path.''.$deposit_img;
	                    }

						$deposit_id =  $this->deposit_model->adddeposit($post);	
						if($deposit_id)
						{					
							$msg = 'deposit added successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'deposit');
						}
					}
					else
					{				
						$this->data['country_list'] = $this->deposit_model->getCountryList();
						$this->data['role_list'] = $this->deposit_model->getRoleList();		
						$this->show_view_admin('transactions/deposit_add', $this->data);
					}		
				}
				else
				{
					$this->data['country_list'] = $this->deposit_model->getCountryList();
					$this->data['role_list'] = $this->deposit_model->getRoleList();
					$this->show_view_admin('transactions/deposit_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'dashboard/error/1');
			}
		}		
	}
	
	/* Delete */
	public function delete_deposit()
	{
		if($this->checkDeletePermission())
		{
			$deposit_id = $this->uri->segment(3);	
			$this->deposit_model->deletedeposit($deposit_id);
			if ($this->db->_error_number() == 1451)
			{		
				$msg = 'You need to delete child category first';
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'deposit'); 
			}
			else
			{
				$msg = 'deposit remove successfully...!';					
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'deposit');
			}
		}
		else
		{
			redirect( base_url().'dashboard/error/1');
		}		
	}



}
/* End of file */?>