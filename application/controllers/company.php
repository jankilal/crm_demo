<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Company extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('company_model');
	}	
	/*	Validation Rules */
	 protected $validation_rules = array
        (
        'companyAdd' => array(
           	array(
                'field' => 'company_name',
                'label' => ' Company name',
                'rules' => 'trim|required'
            ),
			array(
                'field' => 'company_email',
                'label' => 'Company email',
                'rules' => 'trim|required|is_unique[tbl_user.user_email]'
            ),
			array(
                'field' => 'company_phone',
                'label' => 'Company phone',
                'rules' => 'trim|required'
            ),
             array( 
				'field' => 'company_password', 
				'label' => 'Password',   
				'rules' => 'trim|required'  
			),
			array(  
				'field' => 'company_conf_password',
				'label' => 'Confirm Password', 
				'rules' => 'trim|required|matches[company_password]'
            ),			
            array(
                'field' => 'company_country_id',
                'label' => 'Country',
                'rules' => 'trim|required'
            ),

            array(
                'field' => 'company_address',
                'label' => 'Address',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'company_state_id',
                'label' => 'State',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'company_city',
                'label' => 'city',
                'rules' => 'trim|required'
            ),   
            array(
                'field' => 'company_budget',
                'label' => 'Company Budget',
                'rules' => 'trim|required'
            ),    
            array(
                'field' => 'quote_per_employee',
                'label' => 'Leads/Employee',
                'rules' => 'trim|required'
            ),           
            array(
                'field' => 'company_zip_code',
                'label' => 'Zip code',
                'rules' => 'trim|required'
            )           
        ),

		'companyEdit' => array(
        	
            array(
                'field' => 'company_name',
                'label' => 'Company name',
                'rules' => 'trim|required'
            ),			
			array(
                'field' => 'company_phone',
                'label' => 'Company phone',
                'rules' => 'trim|required'
            ), 
            array(
                'field' => 'company_budget',
                'label' => 'Company Budget',
                'rules' => 'trim|required'
            ),    
            array(
                'field' => 'quote_per_employee',
                'label' => 'Leads/Employee',
                'rules' => 'trim|required'
            ),                	
            array(
                'field' => 'company_country_id',
                'label' => 'Country',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'company_address',
                'label' => 'Address',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'company_state_id',
                'label' => 'State',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'company_city',
                'label' => 'city',
                'rules' => 'trim|required'
            ),           
            array(
                'field' => 'company_zip_code',
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
			if(login_role == '1' && login_type == 'Admin')
			{
				$this->data['company_result'] = $this->company_model->getAllCompany();
			}
			else
			{
				$this->data['company_result'] = $this->client_model->getAllCompanyByRole();
			}
			$this->show_view_admin('admin/company/company', $this->data);
		}
		else
		{	
			redirect(base_url().'dashboard/error/1');
		}
    }


    /* Add and Update */
	public function addCompany($company_id='')
	{
		if($company_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{
					
					$this->form_validation->set_rules($this->validation_rules['companyEdit']);
					if($this->form_validation->run())
					{

						$post['user_full_name'] = $this->input->post('company_name');
						$post['user_email'] = $this->input->post('company_email');
						if(isset($_POST['company_new_pass']) && $_POST['company_new_pass'] != '')
						{
							$post['user_password'] = md5($this->input->post('company_new_pass'));
						}
						$post['user_phone'] = $this->input->post('company_phone');	
						$post['company_budget'] = $this->input->post('company_budget');
						$post['quote_per_employee'] = $this->input->post('quote_per_employee');
						$post['user_city'] = $this->input->post('company_city');
						$post['user_zip_code'] = $this->input->post('company_zip_code');
						$post['user_country_id'] = $this->input->post('company_country_id');
						$post['user_state_id'] = $this->input->post('company_state_id');
						$post['user_address'] = $this->input->post('company_address');
						$post['user_currency_type'] = $this->input->post('company_currency_type');
						$post['user_short_note'] = $this->input->post('company_short_note');
						$post['user_fax'] = $this->input->post('company_fax');
						$post['user_website'] = $this->input->post('company_website');
						$post['user_skype_id'] = $this->input->post('company_skype_id');
						$post['user_facebook_url'] = $this->input->post('company_fb_id');
						$post['user_twitter_id'] = $this->input->post('company_twitter_id');
						$post['user_linkedin_url'] = $this->input->post('company_linkedin_url');
						$post['user_status'] = $this->input->post('company_status');	
						$post['user_update_date'] = date('Y-m-d');						
						if ($_FILES["company_img"]["name"])
						{
	                        $company_img = 'company_img';
	                        $fieldName = "company_img";
	                        $Path = 'webroot/upload/user/';
	                         $company_img = $this->ImageUpload($_FILES["company_img"]["name"], $company_img, $Path, $fieldName);
	                        $post['user_profile_img'] = $Path.''.$company_img;
	                    }	                   
						$company_id =  $this->company_model->updateCompany($post,$company_id);	
						if($company_id)
						{					
							$msg = 'Company Update successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'company');
						}
					}
					else
					{				
						$this->data['edit_company'] = $this->company_model->editCompany($company_id);
						$this->data['country_list'] = $this->company_model->getCountryList();
						$this->data['role_list'] = $this->company_model->getRoleList();
						$this->data['state_list'] = $this->company_model->getStateList();		
						$this->show_view_admin('admin/company/company_update', $this->data);
					}		
				}
				else
				{
					$this->data['edit_company'] = $this->company_model->editCompany($company_id);
					$this->data['country_list'] = $this->company_model->getCountryList();
					$this->data['role_list'] = $this->company_model->getRoleList();
					$this->data['state_list'] = $this->company_model->getStateList();
					$this->show_view_admin('admin/company/company_update', $this->data);
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
					$this->form_validation->set_rules($this->validation_rules['companyAdd']);
					if($this->form_validation->run())
					{
						$post['user_id'] 	   = round(microtime(true) * 1000);
						$post['user_role_id']  = 2;
						$post['user_full_name']= $this->input->post('company_name');
						$post['user_email']    = $this->input->post('company_email');
						$post['user_phone']    = $this->input->post('company_phone');
						$post['company_budget']= $this->input->post('company_budget');
						$post['quote_per_employee'] = $this->input->post('quote_per_employee');
						$post['user_password'] = md5($this->input->post('company_password'));
						$post['user_city']     = $this->input->post('company_city');
						$post['user_zip_code'] = $this->input->post('company_zip_code');
						
						$post['user_country_id']= $this->input->post('company_country_id');
						$post['user_state_id']  = $this->input->post('company_state_id');
						$post['user_address']   = $this->input->post('company_address');
						$post['user_currency_type'] = $this->input->post('company_currency_type');
						$post['user_short_note']    = $this->input->post('company_short_note');
						$post['user_fax']      = $this->input->post('company_fax');
						$post['user_website']  = $this->input->post('company_website');
						$post['user_skype_id'] = $this->input->post('company_skype_id');
						$post['user_facebook_url'] = $this->input->post('company_fb_id');
						$post['user_twitter_id']   = $this->input->post('company_twitter_id');
						$post['user_linkedin_url'] = $this->input->post('company_linkedin_url');
						$post['user_status']       = $this->input->post('company_status');
						
						//$role_res = $this->comman_model->getData('tbl_role' , array('role_id' => $post['user_role_id']) ,'single');
						$post['user_type'] = 'Company';
						$post['user_created_date'] = date('Y-m-d');
						$post['user_update_date'] = date('Y-m-d');
						$post['added_by'] = login_user;
						
						if ($_FILES["company_img"]["name"])
						{
	                        $company_img = 'company_img';
	                        $fieldName = "company_img";
	                        $Path = 'webroot/upload/user/';
	                         $company_img = $this->ImageUpload($_FILES["company_img"]["name"], $company_img, $Path, $fieldName);
	                        $post['user_profile_img'] = $Path.''.$company_img;
	                    }
	                    $company_id =  $this->company_model->addCompany($post);	
						if($company_id)
						{					
							$msg = 'Company added successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'company');
						}
					}
					else
					{				
						$this->data['country_list'] = $this->company_model->getCountryList();
						$this->data['role_list'] = $this->company_model->getRoleList();		
						$this->show_view_admin('admin/company/company_add', $this->data);
					}		
				}
				else
				{
					$this->data['country_list'] = $this->company_model->getCountryList();
					$this->data['role_list'] = $this->company_model->getRoleList();
					$this->show_view_admin('admin/company/company_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'dashboard/error/1');
			}
		}		
	}
	
	/* Delete */
	public function delete_company()
	{
		if($this->checkDeletePermission())
		{
			$company_id = $this->uri->segment(3);	
			$res = $this->company_model->deleteCompany($company_id);
			if($res)
			{
				$res = $this->company_model->deleteCompanyEmployee($company_id);
			}
			if ($this->db->_error_number() == 1451)
			{		
				$msg = 'You need to delete child category first';
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'company'); 
			}
			else
			{
				$msg = 'Company remove successfully...!';					
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'company');
			}
		}
		else
		{
			redirect( base_url().'dashboard/error/1');
		}		
	}


    public function checkCompanyEmailId()
    {
    	
    	$user_email = $this->input->post('company_ragister_email');
    	$user_id = $this->input->post('user_id');
	  	$check_user = $this->company_model->checkCompanyEmailId($user_email,$user_id);
	    if(empty($check_user))
	    {						
		   echo "0";
		}
		else
		{
			echo "1";
		}
    }	

	/* Get State List */
	public function getStateList()
	{
		$country_id = $this->input->post('country_id');
		$state_list = $this->company_model->getStateListByCountryId($country_id);

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

}
/* End of file */?>
