<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Employee extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('employee_model');
	}	
	/*	Validation Rules */
	 protected $validation_rules = array
        (
        'employeeAdd' => array(
           array(
                'addDa' => 'employee_name',
                'label' => ' employee name',
                'rules' => 'trim|required'
            ),
			array(
                'field' => 'employee_email',
                'label' => 'employee email',
                'rules' => 'trim|required|is_unique[tbl_user.user_email]'
            ),
			array(
                'field' => 'employee_phone',
                'label' => 'employee phone',
                'rules' => 'trim|required'
            ),
             array( 
				'field' => 'employee_password', 
				'label' => 'Password',   
				'rules' => 'trim|required'  
			),
			array(  
				'field' => 'employee_conf_password',
				'label' => 'Confirm Password', 
				'rules' => 'trim|required|matches[employee_password]'
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
        )
    );
	
	
	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{			
			if(login_role == '1' && login_type == 'Admin')
			{
				$this->data['employee_result'] = $this->employee_model->getAllEmployee();	
			}
			else
			{	
				$this->data['employee_result'] = $this->employee_model->getAllEmployeeByRole(login_user);
			}
			$this->show_view_admin('admin/employee/employee', $this->data);
		}
		else
		{	
			redirect(base_url().'dashboard/error/1');
		}
    }

    /* Add and Update */
	public function addEmployee($employee_id='')
	{
		$role_id = login_role;
		if($employee_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{
					$this->form_validation->set_rules($this->validation_rules['employeeEdit']);
					if($this->form_validation->run())
					{
						$post['user_full_name'] = $this->input->post('employee_name');
						$post['user_email'] = $this->input->post('employee_email');
						if(isset($_POST['employee_new_pass']) && $_POST['employee_new_pass'] != '')
						{
							$post['user_password'] = md5($this->input->post('employee_new_pass'));
						}
						if($role_id == 1)
						{
							$post['company_id'] = $this->input->post('company_id');
						}
						else
						{
							$post['company_id'] = $this->data['user_id'];
						}
						$post['department_id'] 	= $this->input->post('department_id');
						$post['user_phone'] = $this->input->post('employee_phone');						
						$post['user_city'] = $this->input->post('employee_city');
						$post['user_zip_code'] = $this->input->post('employee_zip_code');						
						$post['user_country_id'] = $this->input->post('employee_country_id');
						$post['user_state_id'] = $this->input->post('employee_state_id');
						$post['user_address'] = $this->input->post('employee_address');
						$post['user_currency_type'] = $this->input->post('employee_currency_type');
						$post['user_short_note'] = $this->input->post('employee_short_note');
						// $post['user_fax'] = $this->input->post('employee_fax');
						// $post['user_website'] = $this->input->post('employee_website');
						$post['user_skype_id'] = $this->input->post('employee_skype_id');
						$post['user_facebook_url'] = $this->input->post('employee_fb_id');
						$post['user_twitter_id'] = $this->input->post('employee_twitter_id');
						$post['user_linkedin_url'] = $this->input->post('employee_linkedin_url');
						$post['user_status'] = $this->input->post('employee_status');					
						$post['user_created_date'] = date('Y-m-d');
						$post['user_update_date'] = date('Y-m-d');
						
						if ($_FILES["employee_img"]["name"])
						{
	                        $employee_img = 'employee_img';
	                        $fieldName = "employee_img";
	                        $Path = 'webroot/upload/user/';
	                         $employee_img = $this->ImageUpload($_FILES["employee_img"]["name"], $employee_img, $Path, $fieldName);
	                        $post['user_profile_img'] = $Path.''.$employee_img;
	                    }	                   
						$employee_id =  $this->employee_model->updateEmployee($post,$employee_id);	
						if($employee_id)
						{					
							$msg = 'Employee Update Successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'employee');
						}
					}
					else
					{				
						$edit_employee = $this->employee_model->editEmployee($employee_id);
						$this->data['edit_employee'] = $edit_employee;
						$this->data['country_list'] = $this->employee_model->getCountryList();
						$this->data['role_list'] = $this->employee_model->getRoleList();
						$this->data['state_list'] = $this->comman_model->getData('tbl_state' , array('country_id' => $edit_employee[0]->country_id));		
						// $this->data['company_list'] = $this->employee_model->getCompanyList();
						$this->data['department_list'] = $this->employee_model->getDepartMentByCompanyId(login_user);
						// echo "<pre>"; print_r($this->data['department_list']); die();

						$this->show_view_admin('admin/employee/employee_update', $this->data);
					}		
				}
				else
				{
					$edit_employee = $this->employee_model->editEmployee($employee_id);
					$this->data['edit_employee'] = $edit_employee;
					$this->data['country_list'] = $this->employee_model->getCountryList();
					$this->data['role_list'] = $this->employee_model->getRoleList();
					$this->data['state_list'] = $this->comman_model->getData('tbl_state' , array('country_id' => $edit_employee[0]->user_country_id));		
					$this->data['department_list'] = $this->employee_model->getDepartMentByCompanyId(login_user);
					// echo "<pre>"; print_r($this->data['department_list']); die();

					$this->show_view_admin('admin/employee/employee_update', $this->data);
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
					$this->form_validation->set_rules($this->validation_rules['employeeAdd']);
					if($this->form_validation->run())
					{
						$post['user_full_name'] = $this->input->post('employee_name');
						$post['user_id'] 	 = round(microtime(true) * 1000);
					
						$post['user_email'] 	= $this->input->post('employee_email');
						$post['department_id'] 	= $this->input->post('department_id');
						$post['user_phone'] 	= $this->input->post('employee_phone');
						$post['user_password']	= md5($this->input->post('employee_password'));
						$post['user_city'] 		= $this->input->post('employee_city');
						$post['user_zip_code'] 	= $this->input->post('employee_zip_code');
						$post['user_country_id']= $this->input->post('employee_country_id');
						$post['user_state_id'] 	= $this->input->post('employee_state_id');
						$post['user_address'] 	= $this->input->post('employee_address');
						$post['user_currency_type'] = $this->input->post('employee_currency_type');
						$post['user_short_note'] = $this->input->post('employee_short_note');
						// $post['user_fax'] = $this->input->post('employee_fax');
						// $post['user_website'] = $this->input->post('employee_website');
						$post['user_skype_id'] 		= $this->input->post('employee_skype_id');
						$post['user_facebook_url'] 	= $this->input->post('employee_fb_id');
						$post['user_twitter_id'] 	= $this->input->post('employee_twitter_id');
						$post['user_linkedin_url'] 	= $this->input->post('employee_linkedin_url');
						$post['user_status'] 		= $this->input->post('employee_status');
						$post['user_role_id'] 		= '3';
						$post['user_type'] 			= 'Employee';
						$post['user_created_date'] 	= date('Y-m-d');
						$post['user_update_date'] 	= date('Y-m-d');
						$post['added_by'] 			= login_user;						
						if ($_FILES["employee_img"]["name"])
						{
	                        $employee_img = 'employee_img';
	                        $fieldName = "employee_img";
	                        $Path = 'webroot/upload/user/';
	                         $employee_img = $this->ImageUpload($_FILES["employee_img"]["name"], $employee_img, $Path, $fieldName);
	                        $post['user_profile_img'] = $Path.''.$employee_img;
	                    }
						$employee_id =  $this->employee_model->addemployee($post);	
						if($employee_id)
						{					
							$msg = 'Employee Added Successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'employee');
						}
					}
					else
					{

						$this->data['country_list'] = $this->employee_model->getCountryList();
						$this->data['role_list'] 	= $this->employee_model->getRoleList();	
						
					   $this->data['department_list'] = $this->employee_model->getDepartMentByCompanyId(login_user);
						
						$this->show_view_admin('admin/employee/employee_add', $this->data);
					}		
				}
				else
				{
					$this->data['country_list'] 	= $this->employee_model->getCountryList();
					
					$this->data['department_list'] 	= $this->employee_model->getDepartMentByCompanyId(login_user);
					$this->data['role_list'] 		= $this->employee_model->getRoleList();
					$this->show_view_admin('admin/employee/employee_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'dashboard/error/1');
			}
		}		
	}
	
	/* Delete */
	public function delete_employee()
	{
		if($this->checkDeletePermission())
		{
			$employee_id = $this->uri->segment(3);	
			$this->employee_model->deleteEmployee($employee_id);
			if ($this->db->_error_number() == 1451)
			{		
				$msg = 'You need to delete child category first';
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'employee'); 
			}
			else
			{
				$msg = 'Employee Remove Successfully...!';					
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'employee');
			}
		}
		else
		{
			redirect( base_url().'dashboard/error/1');
		}		
	}

	/* Get Detpartment List */
	public function getDepartMentByCompanyId()
	{
		$company_id = $this->input->post('company_id');
		$department_list = $this->employee_model->getDepartMentByCompanyId($company_id);

		$html = '';
		if(count($department_list) > 0)
		{
			$html .= '<option value="">Select Any Department</option>';
			foreach ($department_list as $d_list) 
			{
				$html .= '<option value="'.$d_list->departments_id.'">'.$d_list->deptname.'</option>';
			}
			
			echo $html; 
		}
		else
		{
			echo $html;
		}
	}

	/* Get State List */
	public function getStateList()
	{
		$country_id = $this->input->post('country_id');
		$state_list = $this->employee_model->getStateListByCountryId($country_id);

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

	public function checkCompanyEmailId()
    {
    	
    	$user_email = $this->input->post('employee_email');
    	$user_id = $this->input->post('user_id');
	  	$check_user = $this->employee_model->checkCompanyEmailId($user_email,$user_id);
	    if(empty($check_user))
	    {						
		   echo "0";
		}
		else
		{
			echo "1";
		}
    }	

}
/* End of file */?>