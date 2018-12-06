<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Settings extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('settings/settings_model');
    }

    /*	Validation Rules */
	 protected $validation_rules = array
        (
		'companyAddEdit' => array(
        	
            array(
                'field' => 'company_name',
                'label' => ' Company name',
                'rules' => 'trim|required'
            ),			
			array(
                'field' => 'company_legal_name',
                'label' => 'Company Legal name',
                'rules' => 'trim|required'
            ),            	
            array(
                'field' => 'contact_person',
                'label' => 'Company Contact',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'company_address',
                'label' => 'Company Address',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'company_country_id',
                'label' => 'Company Country',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'company_state_id',
                'label' => 'Company State',
                'rules' => 'trim|required'
            ),           
            array(
                'field' => 'company_city',
                'label' => 'Company City',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'company_zip_code',
                'label' => 'Company Zip Code',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'company_phone',
                'label' => 'Company Phone',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'company_email',
                'label' => 'Company Email',
                'rules' => 'trim|required'
            ), 
            array(
                'field' => 'company_website',
                'label' => 'Company Website',
                'rules' => 'trim|required'
            ),             
        ),

        'incomeCategoryAdd' => array(
			array(
                'field' => 'income_category',
                'label' => 'Income Category Name',
                'rules' => 'trim|required'
            )
        ),

        'expenseCategoryAdd' => array(
			array(
                'field' => 'expense_category',
                'label' => 'Expense Category Name',
                'rules' => 'trim|required'
            )
        ),

        'leadStatusAdd' => array(
			array(
                'field' => 'lead_status',
                'label' => 'Lead Status name',
                'rules' => 'trim|required'
            ),

            array(
                'field' => 'lead_type',
                'label' => 'Lead Status type',
                'rules' => 'trim|required'
            )

        ),

        'leadSourceAdd' => array(
			array(
                'field' => 'lead_source',
                'label' => 'Lead source name',
                'rules' => 'trim|required'
            ), 
        ),

        'OpportunitiesStateReasonAdd' => array(
			array(
                'field' => 'opportunities_state_reason',
                'label' => 'Opportunities State Reason',
                'rules' => 'trim|required'
            ),
         ),       

        'paymentMethodsAdd' => array(
			array(
                'field' => 'method_name',
                'label' => 'payment Method name',
                'rules' => 'trim|required'
            ),
         ),   

        'departmentAdd' => array(
			array(
                'field' => 'deptname',
                'label' => 'Department name',
                'rules' => 'trim|required'
            )
           
         ),   

         'stagesAdd' => array(
			array(
                'field' => 'stage_name',
                'label' => 'Stages name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'stage_description',
                'label' => 'Stage Description',
                'rules' => 'trim|required'
            )
         )       
    );
	
 // ##################### Genral Setting Start ###############

	public function index()
	{
		if($this->checkViewPermission())
		{			
			
			if($this->checkEditPermission())
			{
			
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit" || isset($_POST['Submit']) && $_POST['Submit'] == "Add" ) 
				{	
					
					$this->form_validation->set_rules($this->validation_rules['companyAddEdit']);
					if($this->form_validation->run())
					{	
						$post['company_name'] = $this->input->post('company_name');
						$post['company_legal_name'] = $this->input->post('company_legal_name');
						$post['company_contact_person'] = $this->input->post('contact_person');						
						$post['company_address'] = $this->input->post('company_address');
						$post['company_country_id'] = $this->input->post('company_country_id');						
						$post['company_state_id'] = $this->input->post('company_state_id');
						$post['company_city'] = $this->input->post('company_city');
						$post['company_zip_code'] = $this->input->post('company_zip_code');
						$post['company_email'] = $this->input->post('company_email');
						$post['company_phone'] = $this->input->post('company_phone');	
						$post['company_website'] = $this->input->post('company_website');	
						$post['company_vat'] = $this->input->post('company_vat');

						if(isset($_POST['Submit']) && $_POST['Submit'] == 'Edit')
						{
							$user_id = $this->data['user_id'];
							$comp_res =  $this->settings_model->updateAdminCompanyDetails($post,$user_id);
							if($comp_res)
							{										
								$msg = 'Company Update successfully!';					
								$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
								redirect(base_url().'settings');
							}		
						}
						else 
						{
							$post['id'] = $this->data['id'];
							$comp_res =  $this->settings_model->addAdminCompanyDetails($post);
							if($comp_res)
							{		
										
								$msg = 'Company Details Add successfully!';					
								$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
								redirect(base_url().'settings');
							}	
						}
					}
					else
					{		
						$this->data['company_details'] = $this->settings_model->getCompanyDetailsById($this->data['id']);

						$this->data['country_list'] = $this->settings_model->getCountryList();								
						$this->show_view_admin('admin/settings/company_details', $this->data);
					}		
				}
				else
				{

					$this->data['company_details'] = $this->settings_model->getCompanyDetailsById($this->data['id']);
					$this->data['country_list'] = $this->settings_model->getCountrylist();	
					$this->show_view_admin('admin/settings/company_details', $this->data);

				}
			}
			else
			{
				redirect( base_url().'dashboard/error/1');
			}
		}
		else
		{	
			redirect(base_url().'dashboard/error/1');
		}
    }

//##################### Genral Setting End #############

//########### Income Category Setting Start ############

   public function incomeCategory()
   {
   	if($this->checkViewPermission())
		{			
			$this->data['income_category_result'] = $this->settings_model->getAllIncomeCategory();
			$this->show_view_admin('admin/settings/income_category', $this->data);
		}
		else
		{	
			redirect(base_url().'dashboard/error/1');
		}
   }

   public function addincomeCategory($income_category_id ='')
   {

   		if($income_category_id != '')
   		{
   			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{
					
					$this->form_validation->set_rules($this->validation_rules['incomeCategoryAdd']);
					if($this->form_validation->run())
					{
						$income_category_id = $income_category_id;
						$post['income_category'] = $this->input->post('income_category');
						$post['description'] = $this->input->post('description');
						$post['income_category_status'] = $this->input->post('income_category_status');
						$post['income_category_update_date'] = date('Y-m-d');  
						$edit_result =  $this->settings_model->updateIncomeCategory($post,$income_category_id);	
						if($edit_result)
						{					
							$msg = 'Income Category Update successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'settings/incomeCategory');
						}
					}
					else
					{				
						$this->data['edit_income_category'] = $this->settings_model->editIncomeCategory($income_category_id);
						$this->show_view_admin('admin/settings/income_category_update', $this->data);
					}		
				}
				else
				{
					$this->data['edit_income_category'] = $this->settings_model->editIncomeCategory($income_category_id);					
					$this->show_view_admin('admin/settings/income_category_update', $this->data);
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

					$this->form_validation->set_rules($this->validation_rules['incomeCategoryAdd']);
					if($this->form_validation->run())
					{						
						
						$post['income_category'] = $this->input->post('income_category');
						$post['description'] = $this->input->post('description');
						$post['income_category_status'] = $this->input->post('income_category_status');
						$post['income_category_created_date'] = date('Y-m-d');
						$post['income_category_update_date'] = date('Y-m-d');
						$add_res =  $this->settings_model->addIncomeCategory($post);	
						if($add_res)
						{					
							$msg = 'Income Category added successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'settings/incomeCategory');
						}
					}
					else
					{				
						$this->data['country_list'] = $this->settings_model->getCountryList();
						$this->data['role_list'] = $this->settings_model->getRoleList();		
						$this->show_view_admin('admin/settings/income_category_add', $this->data);
					}		
				}
				else
				{
					$this->data['country_list'] = $this->settings_model->getCountryList();
					$this->data['role_list'] = $this->settings_model->getRoleList();
					$this->show_view_admin('admin/settings/income_category_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'dashboard/error/1');
			}
   		}
   }

   /* Delete */
	public function deleteIncomeCategory()
	{
		if($this->checkDeletePermission())
		{
			$income_category_id = $this->uri->segment(3);	
			$this->settings_model->deleteIncomeCategory($income_category_id);
			$msg = 'Income Category remove successfully...!';
			$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
			redirect(base_url().'settings/incomeCategory');
			
		}
		else
		{
			redirect( base_url().'dashboard/error/1');
		}		
	}

 
//########### Income Category Setting End ##############

//########### Expense Category Setting Start ##############

   public function expenseCategory()
   {
   		if($this->checkViewPermission())
		{			
			$this->data['expense_category_result'] = $this->settings_model->getAllExpenseCategory();
			$this->show_view_admin('settings/expense_category', $this->data);
		}
		else 
		{	
			redirect(base_url().'dashboard/error/1');
		}
   }

   public function addExpenseCategory($expense_category_id ='')
   {
		if($expense_category_id != '')
		{
   		if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{					
					$this->form_validation->set_rules($this->validation_rules['expenseCategoryAdd']);
					if($this->form_validation->run())
					{
						$expense_category_id = $expense_category_id;
						$post['expense_category'] = $this->input->post('expense_category');
						$post['description'] = $this->input->post('description');
						$post['expense_category_status'] = $this->input->post('expense_category_status');
						$post['expense_category_update_date'] = date('Y-m-d');  
						$edit_result =  $this->settings_model->updateExpenseCategory($post,$expense_category_id);	
						if($edit_result)
						{					
							$msg = 'Income Category Update successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'settings/expenseCategory');
						}
					}
					else
					{				
						$this->data['edit_expense_category'] = $this->settings_model->editExpenseCategory($expense_category_id);
						$this->show_view_admin('settings/expense_category_update', $this->data);
					}		
				}
				else
				{
					$this->data['edit_expense_category'] = $this->settings_model->editExpenseCategory($expense_category_id);					
					$this->show_view_admin('settings/expense_category_update', $this->data);
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

					$this->form_validation->set_rules($this->validation_rules['expenseCategoryAdd']);
					if($this->form_validation->run())
					{						
						$post['expense_category_id']= round(microtime(true) * 1000);
						$post['expense_category'] = $this->input->post('expense_category');
						$post['description'] = $this->input->post('description');
						$post['expense_category_status'] = $this->input->post('expense_category_status');
						$post['expense_category_update_date'] = date('Y-m-d');  
						$post['expense_category_created_date'] = date('Y-m-d');						
						$add_res =  $this->settings_model->addExpenseCategory($post);	
						if($add_res)
						{					
							$msg = 'Expense Category added successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'settings/expenseCategory');
						}
					}
					else
					{				
					
						$this->data['role_list'] = $this->settings_model->getRoleList();		
						$this->show_view_admin('settings/expense_category_add', $this->data);
					}		
				}
				else
				{					
					$this->data['role_list'] = $this->settings_model->getRoleList();
					$this->show_view_admin('settings/expense_category_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'dashboard/error/1');
			}
		}
  	 }

   /* Delete */
	public function deleteExpenseCategory()
	{
		if($this->checkDeletePermission())
		{
			$expense_category_id = $this->uri->segment(3);	
			$this->settings_model->deleteExpenseCategory($expense_category_id);
			$msg = 'Income Category remove successfully...!';
			$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
			redirect(base_url().'settings/expenseCategory');
			
		}
		else
		{
			redirect( base_url().'dashboard/error/1');
		}		
	}

//########### Expense Category Setting Start ##############

//########### Lead Status Setting Start ##############

   public function leadStatus()
   {
   		if($this->checkViewPermission())
		{			
			$this->data['lead_status_result'] = $this->settings_model->getAllLeadStatus();
			$this->show_view_admin('settings/lead_status', $this->data);
		}
		else
		{	
			redirect(base_url().'dashboard/error/1');
		}
   }

   public function addLeadStatus($lead_status_id ='')
   {

		if($lead_status_id != '')
		{
   		if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{					
					$this->form_validation->set_rules($this->validation_rules['leadStatusAdd']);
					if($this->form_validation->run())
					{

						// $lead_status_id = round(microtime(true) * 1000);
						$post['lead_status'] = $this->input->post('lead_status');
						$post['lead_type'] = $this->input->post('lead_type');
						$post['lead_status_status'] = $this->input->post('lead_status_status');
						$post['lead_status_update_date'] = date('Y-m-d');  
						$edit_result =  $this->settings_model->updateLeadStatus($post,$lead_status_id);	
						if($edit_result)
						{					
							$msg = 'Lead Status Update successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'settings/leadStatus');
						}
					}
					else
					{				
						$this->data['edit_lead_status'] = $this->settings_model->editLeadStatus($lead_status_id);
						$this->show_view_admin('settings/lead_status_update', $this->data);
					}		
				}
				else
				{
					$this->data['edit_lead_status'] = $this->settings_model->editLeadStatus($lead_status_id);					
					$this->show_view_admin('settings/lead_status_update', $this->data);
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

					$this->form_validation->set_rules($this->validation_rules['leadStatusAdd']);
					if($this->form_validation->run())
					{						
						$post['lead_status_id'] = round(microtime(true) * 1000);
						$post['lead_status'] = $this->input->post('lead_status');
						$post['lead_type'] = $this->input->post('lead_type');
						$post['lead_status_status'] = $this->input->post('lead_status_status');
						$post['lead_status_update_date'] = date('Y-m-d');  
						$post['lead_status_created_date'] = date('Y-m-d');						
						$add_res =  $this->settings_model->addLeadStatus($post);	
						if($add_res)
						{					
							$msg = 'Lead Status added successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'settings/leadStatus');
						}
					}
					else
					{				
					
						$this->data['role_list'] = $this->settings_model->getRoleList();		
						$this->show_view_admin('settings/lead_status_add', $this->data);
					}		
				}
				else
				{					
					$this->data['role_list'] = $this->settings_model->getRoleList();
					$this->show_view_admin('settings/lead_status_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'dashboard/error/1');
			}
		}
   }

   /* Delete */
	public function deleteleadStatus()
	{
		if($this->checkDeletePermission())
		{
			$lead_status_id = $this->uri->segment(3);	
			$this->settings_model->deleteleadStatus($lead_status_id);
			$msg = 'Income Category remove successfully...!';
			$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
			redirect(base_url().'settings/leadStatus');
			
		}
		else
		{
			redirect( base_url().'dashboard/error/1');
		}		
	}

//############## Expense Category Setting Start #################


//############## Lead source Setting Start ###################

   public function leadSource()
   {
   		if($this->checkViewPermission())
		{			
			$this->data['lead_source_result'] = $this->settings_model->getAllLeadSource();
			$this->show_view_admin('settings/lead_source', $this->data);
		}
		else
		{	
			redirect(base_url().'dashboard/error/1');
		}
   }

   public function addLeadSource($lead_source_id ='')
   {

   		if($lead_source_id != '')
   		{
   			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{					
					$this->form_validation->set_rules($this->validation_rules['leadSourceAdd']);
					if($this->form_validation->run())
					{
						$lead_source_id = $lead_source_id;
						$post['lead_source'] = $this->input->post('lead_source');						
						$post['lead_source_status'] = $this->input->post('lead_source_status');
						$post['lead_source_update_date'] = date('Y-m-d');  
						$edit_result =  $this->settings_model->updateLeadSource($post,$lead_source_id);	
						if($edit_result)
						{					
							$msg = 'Lead source Update successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'settings/leadSource');
						}
					}
					else
					{				
						$this->data['edit_lead_source'] = $this->settings_model->editLeadSource($lead_source_id);
						$this->show_view_admin('settings/lead_source_update', $this->data);
					}		
				}
				else
				{
					$this->data['edit_lead_source'] = $this->settings_model->editLeadSource($lead_source_id);					
					$this->show_view_admin('settings/lead_source_update', $this->data);
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

					$this->form_validation->set_rules($this->validation_rules['leadSourceAdd']);
					if($this->form_validation->run())
					{						
						$post['lead_source_id'] = round(microtime(true) * 1000);
						$post['lead_source'] = $this->input->post('lead_source');					
						$post['lead_source_status'] = $this->input->post('lead_source_status');
						$post['lead_source_update_date'] = date('Y-m-d');  
						$post['lead_source_created_date'] = date('Y-m-d');						
						$add_res =  $this->settings_model->addLeadSource($post);	
						if($add_res)
						{					
							$msg = 'Lead source added successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'settings/leadSource');
						}
					}
					else
					{				
					
						$this->data['role_list'] = $this->settings_model->getRoleList();		
						$this->show_view_admin('settings/lead_source_add', $this->data);
					}		
				}
				else
				{					
					$this->data['role_list'] = $this->settings_model->getRoleList();
					$this->show_view_admin('settings/lead_source_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'dashboard/error/1');
			}
   		}

   }

   /* Delete */
	public function deleteLeadSource()
	{
		if($this->checkDeletePermission())
		{
			$lead_source_id = $this->uri->segment(3);	
			$this->settings_model->deleteLeadSource($lead_source_id);
			$msg = 'Lead source remove successfully...!';
			$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
			redirect(base_url().'settings/leadSource');
			
		}
		else
		{
			redirect(base_url().'dashboard/error/1');
		}		
	}

//############ Lead Source Settings End ########################

//############## Opportunities State Reason Setting Start ################

   public function opportunitiesStateReason()
   {
   		if($this->checkViewPermission())
		{			
			$this->data['opportunities_state_reason_result'] = $this->settings_model->getAllOpportunitiesStateReason();
			$this->show_view_admin('settings/opportunities_state_reason', $this->data);
		}
		else
		{	
			redirect(base_url().'dashboard/error/1');
		}
   }

   public function addOpportunitiesStateReason($opportunities_state_reason_id ='')
   {

   		if($opportunities_state_reason_id != '')
   		{
   			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{					
					$this->form_validation->set_rules($this->validation_rules['OpportunitiesStateReasonAdd']);
					if($this->form_validation->run())
					{

						$opportunities_state_reason_id = $opportunities_state_reason_id;
						$post['opportunities_state_reason'] = $this->input->post('opportunities_state_reason');
						$post['opportunities_state'] = $this->input->post('opportunities_state');				
						$post['opportunities_state_reason_status'] = $this->input->post('opportunities_state_reason_status');
						$post['opportunities_state_reason_update_date'] = date('Y-m-d');  
						$edit_result =  $this->settings_model->updateOpportunitiesStateReason($post,$opportunities_state_reason_id);	
						if($edit_result)
						{					
							$msg = 'Opportunities State Reason Update successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'settings/opportunitiesStateReason');
						}
					}
					else
					{				
						$this->data['edit_opportunities_state_reason'] = $this->settings_model->editOpportunitiesStateReason($opportunities_state_reason_id);
						$this->show_view_admin('settings/opportunities_state_reason_update', $this->data);
					}		
				}
				else
				{
					$this->data['edit_opportunities_state_reason'] = $this->settings_model->editOpportunitiesStateReason($opportunities_state_reason_id);					
					$this->show_view_admin('settings/opportunities_state_reason_update', $this->data);
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

					$this->form_validation->set_rules($this->validation_rules['OpportunitiesStateReasonAdd']);
					if($this->form_validation->run())
					{						

						$post['opportunities_state'] = $this->input->post('opportunities_state');					
						$post['opportunities_state_reason'] = $this->input->post('opportunities_state_reason');					
						$post['opportunities_state_reason_status'] = $this->input->post('opportunities_state_reason_status');
						$post['opportunities_state_reason_update_date'] = date('Y-m-d');  
						$post['opportunities_state_reason_created_date'] = date('Y-m-d');						
						$add_res =  $this->settings_model->addOpportunitiesStateReason($post);	
						if($add_res)
						{					
							$msg = 'Opportunities State Reason added successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'settings/opportunitiesStateReason');
						}
					}
					else
					{				
					
						$this->data['role_list'] = $this->settings_model->getRoleList();		
						$this->show_view_admin('settings/opportunities_state_reason_add', $this->data);
					}		
				}
				else
				{					
					$this->data['role_list'] = $this->settings_model->getRoleList();
					$this->show_view_admin('settings/opportunities_state_reason_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'dashboard/error/1');
			}
   		}
    }

   /* Delete */
	public function deleteOpportunitiesStateReason()
	{
		if($this->checkDeletePermission())
		{
			$opportunities_state_reason_id = $this->uri->segment(3);	
			$this->settings_model->deleteOpportunitiesStateReason($opportunities_state_reason_id);
			$msg = 'Opportunities State Reason remove successfully...!';
			$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
			redirect(base_url().'settings/opportunitiesStateReason');
			
		}
		else
		{
			redirect(base_url().'dashboard/error/1');
		}		
	}

//########### Opportunities State Reason Settings End ####################


//############## payment Methods Setting Start ################

   public function paymentMethods()
   {
   		if($this->checkViewPermission())
		{			
			$this->data['payment_methods_result'] = $this->settings_model->getAllPaymentMethods();
			$this->show_view_admin('settings/payment_methods', $this->data);
		}
		else
		{	
			redirect(base_url().'dashboard/error/1');
		}
   }

   public function addPaymentMethods($payment_methods_id ='')
   {

   		if($payment_methods_id != '')
   		{
   			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{					
					$this->form_validation->set_rules($this->validation_rules['paymentMethodsAdd']);
					if($this->form_validation->run())
					{
						$payment_methods_id = $payment_methods_id;
						$post['method_name'] = $this->input->post('method_name');						
						$post['payment_methods_status'] = $this->input->post('payment_methods_status');
						$post['payment_methods_update_date'] = date('Y-m-d');  
						$edit_result =  $this->settings_model->updatePaymentMethods($post,$payment_methods_id);	
						if($edit_result)
						{					
							$msg = 'payment Methods Update successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'settings/paymentMethods');
						}
					}
					else
					{				
						$this->data['edit_payment_methods'] = $this->settings_model->editPaymentMethods($payment_methods_id);
						$this->show_view_admin('settings/payment_methods_update', $this->data);
					}		
				}
				else
				{
					$this->data['edit_payment_methods'] = $this->settings_model->editPaymentMethods($payment_methods_id);					
					$this->show_view_admin('settings/payment_methods_update', $this->data);
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

					$this->form_validation->set_rules($this->validation_rules['paymentMethodsAdd']);
					if($this->form_validation->run())
					{	

						$post['method_name'] = $this->input->post('method_name');					
						$post['payment_methods_status'] = $this->input->post('payment_methods_status');
						$post['payment_methods_update_date'] = date('Y-m-d');  
						$post['payment_methods_created_date'] = date('Y-m-d');						
						$add_res =  $this->settings_model->addPaymentMethods($post);	
						if($add_res)
						{					
							$msg = 'payment Methods added successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'settings/paymentMethods');
						}
					}
					else
					{				
					
						$this->data['role_list'] = $this->settings_model->getRoleList();		
						$this->show_view_admin('settings/payment_methods_add', $this->data);
					}		
				}
				else
				{					
					$this->data['role_list'] = $this->settings_model->getRoleList();
					$this->show_view_admin('settings/payment_methods_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'dashboard/error/1');
			}
   		}
    }

   /* Delete */
	public function deletePaymentMethods()
	{
		if($this->checkDeletePermission())
		{
			$payment_methods_id = $this->uri->segment(3);	
			$this->settings_model->deletePaymentMethods($payment_methods_id);
			$msg = 'payment Methods remove successfully...!';
			$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
			redirect(base_url().'settings/paymentMethods');
			
		}
		else
		{
			redirect(base_url().'dashboard/error/1');
		}		
	}

//########### payment Methods Settings End ######################


//############## Department Setting Start ################

   public function department()
   {
   	if($this->checkViewPermission())
		{			

			// $this->data['department_result'] = $this->comman_model->getData('tbl_depa')
			 $this->data['department_result'] = $this->settings_model->getAllDepartment();
			 $this->show_view_admin('settings/department', $this->data);
		}
		else
		{	
			redirect(base_url().'dashboard/error/1');
		}
   }

   public function addDepartment($department_id ='')
   {
   		if($department_id != '')
   		{
   			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{	
					$department_id = $department_id;
					$company_id = $company_id;
					$post['deptname'] = $this->input->post('deptname');		
					$post['department_status'] = $this->input->post('department_status');
					$post['department_update_date'] = date('Y-m-d');  

					$edit_result =  $this->settings_model->updateDepartment($post,$department_id);	

					if($edit_result)
					{					
						$msg = 'Department Update successfully!!';					
						$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().'settings/department');
					}
						
				}
				else
				{
					$this->data['edit_department'] = $this->settings_model->editDepartment($department_id);
					$this->data['company_list'] = $this->settings_model->getAllDepartmentCompany();							
					$this->show_view_admin('settings/department_update', $this->data);
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
					$this->form_validation->set_rules($this->validation_rules['departmentAdd']);
					// echo "<pre>"; print_r($_POST); die();
					if($this->form_validation->run())
					{	
						$post['departments_id'] = round(microtime(true) * 1000);	
						$post['deptname'] = $this->input->post('deptname');
						 // $post['company_id'] = $this->input->post('company_id');
						$post['department_status'] = $this->input->post('department_status');
						$post['department_update_date'] = date('Y-m-d');
						$post['department_created_date'] = date('Y-m-d');  
						// echo "<pre>"; print_r($post); die();
						$add_res =  $this->settings_model->addDepartment($post);	
						if($add_res)
						{					
							$msg = 'Department added successfully!';
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'settings/department');
						}
					}
					else
					{
						$this->data['role_list'] = $this->settings_model->getRoleList();		
						$this->data['company_list'] = $this->settings_model->getAllDepartmentCompany();	
						$this->show_view_admin('settings/department_add', $this->data);
					}		
				}
				else
				{					
					$this->data['role_list'] = $this->settings_model->getRoleList();
					$this->data['company_list'] = $this->settings_model->getAllDepartmentCompany();	
					$this->show_view_admin('settings/department_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'dashboard/error/1');
			}
   		}

   }

   /* Delete */
	public function deleteDepartment()
	{
		if($this->checkDeletePermission())
		{
			$department_id = $this->uri->segment(3);	
			$this->settings_model->deleteDepartment($department_id);
			$msg = 'Department remove successfully...!';
			$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
			redirect(base_url().'settings/department');
			
		}
		else
		{
			redirect(base_url().'dashboard/error/1');
		}		
	}

//########### Department Settings End ####################

//############## Stages Setting Start ################
	public function stages()
   {
   	if($this->checkViewPermission())
		{			
			$this->data['stages_result'] = $this->settings_model->getAllStages();
			// echo "<pre>"; print_r($this->data['stages_result']); die();

			$this->show_view_admin('settings/stages', $this->data);
		}
		else
		{	
			redirect(base_url().'dashboard/error/1');
		}
   }

   public function addStages($id ='')
   {
		if($id != '')
		{
	   		if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{   	
					$post['stage_name'] = $this->input->post('stage_name');
					$post['stage_description'] = $this->input->post('stage_description');
					$post['status'] = $this->input->post('status');
					$res =  $this->comman_model->updateData('tbl_stage', array('id'=>$id) , $post);
					if($res)
					{					
						$msg = 'Stage Update successfully!!';					
						$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().'settings/stages');
					}			
				}
				else
				{	
					$this->data['edit_stages'] = $this->comman_model->getData('tbl_stage' , array('id'=> $id) , 'single');

					$this->show_view_admin('settings/stages_update', $this->data);
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
					$id = $id;
					$post['stage_name'] = $this->input->post('stageName');
					$post['stage_description'] = $this->input->post('stageDescription');
					$post['status'] = $this->input->post('status');
					$add_res =  $this->settings_model->addStages($post);	
					if($add_res)
					{					
						$msg = 'Stage added successfully!';
						$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().'settings/stages');
					}	
				}
				else
				{				
					// $this->data['role_list'] = $this->settings_model->getRoleList();
					// $this->data['company_list'] = $this->settings_model->getAllDepartmentCompany();	
					$this->show_view_admin('settings/stages_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'dashboard/error/1');
			}
		}
   }

/* Delete */
	public function deleteStage()
	{
		if($this->checkDeletePermission())
		{
			$id = $this->uri->segment(3);
			$this->comman_model->deleteData('tbl_stage' ,array('id'=> $id));
			$msg = 'Stages remove successfully...!';
			$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
			redirect(base_url().'settings/Stages');
		}
		else
		{
			redirect(base_url().'dashboard/error/1');
		}		
	}

//########### Stages Settings End ####################

	/* Get State List */
	public function getStateList()
	{
		$country_id = $this->input->post('country_id');
		$state_list = $this->settings_model->getStateListByCountryId($country_id);

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
?>