<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');	
	}
	
	/*	Validation Rules */
	 protected $validation_rules = array
        (
        'login' => array(
            array(
                'field' => 'user_email',
                'label' => 'Email',
                'rules' => 'trim|required'
            ),
			 array(
                'field' => 'user_password',
                'label' => 'Password',
                'rules' => 'trim|required'
            )
        ),

		'adminEdit' => array(
            array(
                'field' => 'admin_name',
                'label' => ' admin name',
                'rules' => 'trim|required'
            ),      
      		array(
                'field' => 'admin_phone',
                'label' => 'admin phone',
                'rules' => 'trim|required'
            ),
        ),

        'companyEdit' => array(
        	
            array(
                'field' => 'company_name',
                'label' => ' Company name',
                'rules' => 'trim|required'
            ),			
			array(
                'field' => 'company_phone',
                'label' => 'Company phone',
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
        ),
        'employeeEdit' => array(
        	
            array(
                'field' => 'employee_name',
                'label' => ' employee name',
                'rules' => 'trim|required'
            ),			
			array(
                'field' => 'employee_phone',
                'label' => 'employee phone',
                'rules' => 'trim|required'
            ),            	
            array(
                'field' => 'employee_country_id',
                'label' => 'Country',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'employee_address',
                'label' => 'Address',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'employee_state_id',
                'label' => 'State',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'employee_city',
                'label' => 'city',
                'rules' => 'trim|required'
            ),           
            array(
                'field' => 'employee_zip_code',
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
        ),

		'forgotPassword_email' => array(
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email'
            )
        ),
		'resetpassword' => array(
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required|matches[rpassword]'
            ),
			array(
                'field' => 'rpassword',
                'label' => 'Re-Type Password',
                'rules' => 'trim|required'
            )
        )
    );
		
	/* Login */
	public function index()
	{
		if($this->checkSessionAdmin())
		{
			redirect('dashboard');
		}
		else
		{	
			if(isset($_POST['login']) && $_POST['login'] =='Login')
			{	
				$this->form_validation->set_rules($this->validation_rules['login']);
				if ($this->form_validation->run()) 
				{
					$this->data['user_email'] = $_POST['user_email'];
					$this->data['password'] = md5($_POST['user_password']);
					$user_details = $this->login_model->checkUserLogin($this->data);
					if(!empty($user_details))
					{
						$this->session->set_userdata('web_admin' , $user_details);
						redirect('dashboard');
					}
					else
					{
						$msg = 'Invalid Email And Password';
						$this->session->set_flashdata('message', '<div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div>');
						redirect('login');
					}
				}
				else
				{					
					$this->load->view('login', $this->data);
				}
			}
			else
			{
				// To Load second database and perform query operation.
				$this->load->view('login');
			}
		}
    }

    /*	Logout */
	public function logout() 
	{        
        $this->session->sess_destroy();		
        redirect(base_url());
    }


    /*	Update Profile */
	public function profile() 
	{   
		$session = $this->session->all_userdata();		
		$user_id = $session[0]->user_id;
		// echo "<pre>";	
		// print_r($session);die;
		if($session[0]->user_role_id == 1 && $session[0]->user_type == 'Admin')
		{
			if(isset($_POST['Submit']) && $_POST['Submit'] =='Profile')
		    {
			        $this->form_validation->set_rules($this->validation_rules['adminEdit']);
			        if($this->form_validation->run())
			        {	
			        	  $post['user_full_name'] = $this->input->post('admin_name');
				          $post['user_email'] = $this->input->post('admin_email');
				          $post['user_phone'] = $this->input->post('admin_phone');
				          $post['user_city'] = $this->input->post('admin_city');
				          $post['user_zip_code'] = $this->input->post('admin_zip_code');
				          if($_POST['admin_country_id'] == '')
				          {
				         	 $post['user_country_id'] = 0;
				          }
				          else
				          {
				          	 $post['user_country_id'] = $this->input->post('admin_country_id');
				          }
				          if($_POST['admin_state_id'] == '')
				          {

				         	 $post['user_state_id'] = 0;
				          }
				          else
				          {
				          	 $post['user_state_id'] = $this->input->post('admin_state_id');
				          }
				          $post['user_address'] = $this->input->post('admin_address');
				          $post['user_currency_type'] = $this->input->post('admin_currency_type');				      
				          $post['user_update_date'] = date('Y-m-d');
				          if($_POST['check_change_password'] != '' && $_POST['admin_new_pass'])
				          {
				          	  $post['user_password'] = md5($this->input->post('admin_new_pass'));
				          }				          
				          if ($_FILES["admin_img"]["name"])
				          {
		                        $admin_img = 'admin_img';
		                        $fieldName = "admin_img";
		                        $Path = 'webroot/upload/user/';
		                         $admin_img = $this->ImageUpload($_FILES["admin_img"]["name"], $admin_img, $Path, $fieldName);
		                        $post['user_profile_img'] = $Path.''.$admin_img;
		                  } 
				          $admin_res =  $this->login_model->updateAdminProfile($post,$user_id);  
				          if($admin_res)
				          {         
				          	$this->session->unset_userdata('user_email');
							$this->session->set_userdata('user_email',$post['user_email']);
							$this->session->unset_userdata('login_user_name');
							$this->session->set_userdata('login_user_name',$post['user_full_name']);
							$this->session->set_userdata('user_email',$post['user_email']);
							$this->session->unset_userdata('login_profile_img');
							$this->session->set_userdata('login_profile_img',$post['user_profile_img']);
				            $msg = 'Profile Update successfully!!';          
				            $this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				            redirect(base_url().'dashboard');
				          }
			        }
			        else
			        {       
			          $this->data['user_details'] = $this->login_model->getUserDetails($user_id);
			          $this->data['country_list'] = $this->login_model->getCountryList();
		        	  $this->data['state_list'] = $this->login_model->getStateList();   
			          $this->show_view_admin('admin/admin_profile', $this->data);
			        }   
		      }
		      else
		      {
		        $this->data['user_details'] = $this->login_model->getUserDetails($user_id);
		        $this->data['country_list'] = $this->login_model->getCountryList();
		        
		        $this->data['state_list'] = $this->login_model->getStateList();
		        $this->show_view_admin('admin/admin_profile', $this->data);
		      }
		}
		else if($session[0]->user_role_id == 4)
		{
			if(isset($_POST['Submit']) && $_POST['Submit'] =='Profile')
			{
				$this->form_validation->set_rules($this->validation_rules['companyEdit']);
				if($this->form_validation->run())
				{					
					$post['user_full_name'] = $this->input->post('company_name');
					$post['user_email'] = $this->input->post('company_email');
					$post['user_phone'] = $this->input->post('company_phone');
					$post['user_city'] = $this->input->post('company_city');
					$post['user_zip_code'] = $this->input->post('company_zip_code');
					  if($_POST['company_country_id'] == '')
			          {
			         	 $post['user_country_id'] = 0;
			          }
			          else
			          {
			          	 $post['user_country_id'] = $this->input->post('company_country_id');
			          }
			          if($_POST['company_state_id'] == '')
			          {

			         	 $post['user_state_id'] = 0;
			          }
			          else
			          {
			          	 $post['user_state_id'] = $this->input->post('company_state_id');
			          }
					$post['user_address'] = $this->input->post('company_address');
					$post['user_currency_type'] = $this->input->post('company_currency_type');
					$post['user_short_note'] = $this->input->post('company_short_note');
					$post['user_fax'] = $this->input->post('company_fax');
					$post['user_website'] = $this->input->post('company_website');
					$post['user_skype_id'] = $this->input->post('company_skype_id');
					$post['user_facebook_url'] = $this->input->post('company_fb_id');
					$post['user_twitter_id'] = $this->input->post('company_twitter_id');
					$post['user_linkedin_url'] = $this->input->post('company_linkedin_url');
					 if($_POST['check_change_password'] != '' && $_POST['company_new_pass'])
			          {
			          	  $post['user_password'] = md5($this->input->post('company_new_pass'));
			          }				
					$post['user_update_date'] = date('Y-m-d');
					
					if ($_FILES["company_img"]["name"])
					{
                        $company_img = 'company_img';
                        $fieldName = "company_img";
                        $Path = 'webroot/upload/user/';
                         $company_img = $this->ImageUpload($_FILES["company_img"]["name"], $company_img, $Path, $fieldName);
                        $post['user_profile_img'] = $Path.''.$company_img;
                    }	                   
					$company_id =  $this->login_model->updateAdminProfile($post,$user_id);	
					if($company_id)
					{
						$this->session->unset_userdata('user_email');
						$this->session->set_userdata('user_email',$post['user_email']); 
						$this->session->unset_userdata('login_user_name');
							$this->session->set_userdata('login_user_name',$post['user_full_name']);
						$this->session->unset_userdata('login_profile_img');
						$this->session->set_userdata('login_profile_img',$post['user_profile_img']);
						$msg = 'Company added successfully!!';					
						$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().'dashboard');
					}
				}
				else
				{				
					$this->data['user_details'] = $this->login_model->getUserDetails($user_id);
					$this->data['country_list'] = $this->login_model->getCountryList();
					
					$this->data['state_list'] = $this->login_model->getStateList();		
					$this->show_view_admin('company/company_profile', $this->data);
				}		
			}
			else
			{
				$this->data['user_details'] = $this->login_model->getUserDetails($user_id);
				$this->data['country_list'] = $this->login_model->getCountryList();
				
				$this->data['state_list'] = $this->login_model->getStateList();
				$this->show_view_admin('company/company_profile', $this->data);
			}
		}

		else if($session[0]->user_role_id == 5)
		{
			if(isset($_POST['Submit']) && $_POST['Submit'] =='Profile')
			{
				$this->form_validation->set_rules($this->validation_rules['employeeEdit']);
				if($this->form_validation->run())
				{
					$user_id = $user_id;
					$post['user_full_name'] = $this->input->post('employee_name');
					$post['user_email'] = $this->input->post('employee_email');
					$post['user_phone'] = $this->input->post('employee_phone');						
					$post['user_city'] = $this->input->post('employee_city');
					$post['user_zip_code'] = $this->input->post('employee_zip_code');
					
					 if($_POST['employee_country_id'] == '')
			          {
			         	 $post['user_country_id'] = 0;
			          }
			          else
			          {
			          	 $post['user_country_id'] = $this->input->post('employee_country_id');
			          }
			          if($_POST['employee_state_id'] == '')
			          {

			         	 $post['user_state_id'] = 0;
			          }
			          else
			          {
			          	 $post['user_state_id'] = $this->input->post('employee_state_id');
			          }
					$post['user_address'] = $this->input->post('employee_address');
					$post['user_currency_type'] = $this->input->post('employee_currency_type');
					$post['user_short_note'] = $this->input->post('employee_short_note');
					$post['user_fax'] = $this->input->post('employee_fax');
					$post['user_website'] = $this->input->post('employee_website');
					$post['user_skype_id'] = $this->input->post('employee_skype_id');
					$post['user_facebook_url'] = $this->input->post('employee_fb_id');
					$post['user_twitter_id'] = $this->input->post('employee_twitter_id');
					$post['user_linkedin_url'] = $this->input->post('employee_linkedin_url');
					if($_POST['check_change_password'] != '' && $_POST['employee_new_pass'])
			          {
			          	  $post['user_password'] = md5($this->input->post('employee_new_pass'));
			          }		
					$post['user_update_date'] = date('Y-m-d');
					
					if ($_FILES["employee_img"]["name"])
					{
                        $employee_img = 'employee_img';
                        $fieldName = "employee_img";
                        $Path = 'webroot/upload/user/';
                         $employee_img = $this->ImageUpload($_FILES["employee_img"]["name"], $employee_img, $Path, $fieldName);
                        $post['user_profile_img'] = $Path.''.$employee_img;
                    }	                   
					$employee_id =  $this->login_model->updateAdminProfile($post,$user_id);	
					if($employee_id)
					{					
						$this->session->unset_userdata('user_email');
						$this->session->set_userdata('user_email',$post['user_email']); 	
						$this->session->unset_userdata('login_profile_img');
						$this->session->set_userdata('login_profile_img',$post['user_profile_img']);
						$msg = 'Profile Update successfully!!';					
						$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().'dashboard');
					}
				}
				else
				{	
					$this->data['user_details'] = $this->login_model->getUserDetails($user_id);
					$this->data['country_list'] = $this->login_model->getCountryList();
					
					$this->data['state_list'] = $this->login_model->getStateList();		
					$this->show_view_admin('employee/employee_profile', $this->data);
				}
			}
			else
			{
				$this->data['user_details'] = $this->login_model->getUserDetails($user_id);
				$this->data['country_list'] = $this->login_model->getCountryList();
				
				$this->data['state_list'] = $this->login_model->getStateList();			
				$this->show_view_admin('employee/employee_profile', $this->data);
			}
		}
		else
		{
			if(isset($_POST['Submit']) && $_POST['Submit'] =='Profile')
			{
				$this->form_validation->set_rules($this->validation_rules['clientEdit']);
				if($this->form_validation->run())
				{

					$user_id = $user_id;
					$post['user_full_name'] = $this->input->post('client_name');
					$post['user_email'] = $this->input->post('client_email');
					$post['user_phone'] = $this->input->post('client_phone');
					$post['user_city'] = $this->input->post('client_city');
					$post['user_zip_code'] = $this->input->post('client_zip_code');	
					  if($_POST['client_country_id'] == '')
			          {
			         	 $post['user_country_id'] = 0;
			          }
			          else
			          {
			          	 $post['user_country_id'] = $this->input->post('client_country_id');
			          }
			          if($_POST['client_state_id'] == '')
			          {

			         	 $post['user_state_id'] = 0;
			          }
			          else
			          {
			          	 $post['user_state_id'] = $this->input->post('client_state_id');
			          }
					$post['user_address'] = $this->input->post('client_address');
					$post['user_currency_type'] = $this->input->post('client_currency_type');
					$post['user_short_note'] = $this->input->post('client_short_note');
					$post['user_fax'] = $this->input->post('client_fax');
					$post['user_website'] = $this->input->post('client_website');
					$post['user_skype_id'] = $this->input->post('client_skype_id');
					$post['user_facebook_url'] = $this->input->post('client_fb_id');
					$post['user_twitter_id'] = $this->input->post('client_twitter_id');
					$post['user_linkedin_url'] = $this->input->post('client_linkedin_url');
					if($_POST['check_change_password'] != '' && $_POST['client_new_pass'])
			          {
			          	  $post['user_password'] = md5($this->input->post('client_new_pass'));
			          }		
					$post['user_update_date'] = date('Y-m-d');
					
					if ($_FILES["client_img"]["name"])
					{
                        $client_img = 'client_img';
                        $fieldName = "client_img";
                        $Path = 'webroot/upload/user/';
                         $client_img = $this->ImageUpload($_FILES["client_img"]["name"], $client_img, $Path, $fieldName);
                        $post['user_profile_img'] = $Path.''.$client_img;
                    }	     

					$client_id =  $this->login_model->updateAdminProfile($post,$user_id);	
					if($client_id)
					{				
						$this->session->unset_userdata('user_email');
						$this->session->set_userdata('user_email',$post['user_email']); 	
						$this->session->unset_userdata('login_profile_img');
						$this->session->set_userdata('login_profile_img',$post['user_profile_img']);	
						$msg = 'Profile Update successfully!!';					
						$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().'dashboard');
					}
				}
				else
				{	
					$this->data['user_details'] = $this->login_model->getUserDetails($user_id);
					$this->data['country_list'] = $this->login_model->getCountryList();
					
					$this->data['state_list'] = $this->login_model->getStateList();		
					$this->show_view_admin('client/client_profile', $this->data);
				}
			}
			else
			{
				$this->data['user_details'] = $this->login_model->getUserDetails($user_id);
				$this->data['country_list'] = $this->login_model->getCountryList();
				
				$this->data['state_list'] = $this->login_model->getStateList();			
				$this->show_view_admin('client/client_profile', $this->data);
			}
		}

       
    }

    public function checkUserEmailId()
    {
    	$session = $this->session->all_userdata();		
    	if(isset($session['user_email']) && !empty($session['user_email']))
    	{
    		$old_email =  $session['user_email'];    		
    	}
    	else
    	{
    		$old_email =  $session[0]->user_email;
    	}
    	$user_email = $this->input->post('user_ragister_email');
	  	$check_user = $this->login_model->checkUserEmailId($user_email,$old_email);
	    if(empty($check_user))
	    {						
		   echo "0";
		}
		else
		{
			echo "1";
		}
    }	

    public function getStateList()
	{
		$country_id = $this->input->post('country_id');
		$state_list = $this->login_model->getStateListByCountryId($country_id);
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
/* End of file */