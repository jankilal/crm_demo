<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Transactions extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transactions/transactions_model');
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

        'depositeAdd' => array(
			array(
                'field' => 'account_id',
                'label' => 'Expense account Name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'amount',
                'label' => 'Expense amount Name',
                'rules' => 'trim|required'
            )
        ),

        'expensesAdd' => array(
			array(
                'field' => 'account_id',
                'label' => 'Expense account Name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'amount',
                'label' => 'Expense amount Name',
                'rules' => 'trim|required'
            )
        ),

         'transferAdd' => array(
			array(
                'field' => 'from_account_id',
                'label' => 'From Account',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'to_account_id',
                'label' => 'To Account',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'amount',
                'label' => 'Amount',
                'rules' => 'trim|required'
            )
        ),

        'goaltypeAdd' => array(
			array(
                'field' => 'type_name',
                'label' => 'Goal Type Name',
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
            ),
            array(
                'field' => 'company_id',
                'label' => 'Company',
                'rules' => 'trim|required'
            )
         )       
    );
//########### deposit Setting Start ##############

   public function deposit()
   {
   		if($this->checkViewPermission())
		{			
			$this->data['deposit_result'] = $this->transactions_model->getAlldeposit();
			$this->data['advance_data_tbl'] = '1';	
			$this->show_view_admin('admin/transactions/deposit', $this->data);
		}
		else
		{	
			redirect(base_url().'dashboard/error/1');
		}
   }

   public function addeposit($transactions_id ='')
   {

   		if($transactions_id != '')
   		{
   			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{					
					$this->form_validation->set_rules($this->validation_rules['depositeAdd']);
					if($this->form_validation->run())
					{

						$transactions_id = $transactions_id;
						$post['date'] = $this->input->post('date');
						$post['account_id'] = $this->input->post('account_id');
						$post['amount'] = $this->input->post('amount');
						$post['category_id'] = $this->input->post('income_category_id');
						$post['paid_by'] = $this->input->post('paid_by');
						$post['payment_methods_id'] = $this->input->post('payment_methods_id');
						$post['reference'] = $this->input->post('reference');
						$post['notes'] = $this->input->post('notes');
						if ($_FILES["attachement"]["name"])
						{
	                        $attachement = 'attachement';
	                        $fieldName = "attachement";
	                        $Path = 'webroot/upload/deposit/';
	                         $attachement = $this->ImageUpload($_FILES["attachement"]["name"], $attachement, $Path, $fieldName);
	                        $post['attachement'] = $Path.''.$attachement;
	                    }	      
						$edit_result =  $this->transactions_model->updatedeposit($post,$transactions_id);	
						if($edit_result)
						{					
							$msg = 'Income Update successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'transactions/deposit');
						}
					}
					else
					{	
					    $this->data['account_details'] = $this->transactions_model->getALLAccountDetails();
						
						$this->data['income_category'] = $this->transactions_model->getALLCategory();
						$this->data['user_list'] = $this->transactions_model->getALLUser();	
						$this->data['payment_methode'] = $this->transactions_model->getPaymentMethode();			
						$this->data['edit_deposit'] = $this->transactions_model->editdeposit($transactions_id);
						$this->show_view_admin('admin/transactions/deposit_update', $this->data);
					}		
				}
				else
				{
					$this->data['account_details'] = $this->transactions_model->getALLAccountDetails();
						
						$this->data['income_category'] = $this->transactions_model->getALLCategory();
						$this->data['user_list'] = $this->transactions_model->getALLUser();	
						$this->data['payment_methode'] = $this->transactions_model->getPaymentMethode();
					$this->data['edit_deposit'] = $this->transactions_model->editdeposit($transactions_id);					
					$this->show_view_admin('admin/transactions/deposit_update', $this->data);
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

					$this->form_validation->set_rules($this->validation_rules['depositeAdd']);
					if($this->form_validation->run())
					{
						$post['date'] = $this->input->post('date');
						$post['type'] = 'Income';
						$post['account_id'] = $this->input->post('account_id');
						$post['amount'] = $this->input->post('amount');
						$post['credit'] = $this->input->post('amount');
						$post['category_id'] = $this->input->post('income_category_id');
						$post['paid_by'] = $this->input->post('paid_by');
						$post['payment_methods_id'] = $this->input->post('payment_methods_id');
						$post['reference'] = $this->input->post('reference');
                        $post['permission'] = $this->input->post('permission');
						$post['notes'] = $this->input->post('notes');
						$ac_bal = $this->transactions_model->getAccountBalanceById($post['account_id']);
						$post['total_balance'] = $ac_bal[0]->total_balance+$post['amount'];
						$transactions_id =  $this->transactions_model->addeposit($post);	
						if($transactions_id)
						{

						if($_POST['permission'] == '0')
                            {
                                $permission_arr = $this->input->post('assigned_to');
                                if(sizeof($permission_arr) > 0)
                                {   
                                    for ($i=0; $i < count($permission_arr) ; $i++) 
                                    {                                       
                                        $post_permission['transactions_id'] = $transactions_id;
                                        $post_permission['user_id'] = $permission_arr[$i];
                                        $post_permission['permission_view'] = $this->input->post('view_'.$permission_arr[$i]);
                                        $post_permission['permission_edit'] = $this->input->post('edit_'.$permission_arr[$i]);
                                        $post_permission['permission_delete'] = $this->input->post('delete_'.$permission_arr[$i]);
                                        $post_permission['others_permission_status'] = 1;
                                        $post_permission['others_permission_created_date'] = date('Y-m-d');
                                        $post_permission['others_permission_update_date'] = date('Y-m-d');
                                        $this->transactions_model->addticketsPermission($post_permission);
                                    }                               
                                }
                                
                            }    
						  $this->transactions_model->updateBalanceById($post['account_id'],$post['total_balance']);	
							if($_FILES["attachement"]['name'])
								{							
									$attachment_array = $_FILES["attachement"]["name"];
									for($k = 0; $k < count($attachment_array); $k++)
									{	
										$_FILES['new_file']['name'] = $_FILES['attachement']['name'][$k];
										$_FILES['new_file']['type'] = $_FILES['attachement']['type'][$k];
						                $_FILES['new_file']['tmp_name'] = $_FILES['attachement']['tmp_name'][$k];
						                $_FILES['new_file']['error'] = $_FILES['attachement']['error'][$k];
						                $_FILES['new_file']['size'] = $_FILES['attachement']['size'][$k];
						              	$name = 'transaction_attechment';
						              	$imagePath = 'webroot/upload/transactions/';
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
						                   	$post_img['attachement'] = $imagePath.''.$imageName;
											$post_img['transactions_id'] =  $transactions_id;	
											$post_img['transactions_type'] =  'Deposit';	
											$this->transactions_model->addTransactonFile($post_img);
						              	}
                                    }

                                }
							$msg = 'Income added successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'transactions/deposit');
						}
					}
					else
					{				
					
						$this->data['role_list'] = $this->transactions_model->getRoleList();
						$this->data['account_details'] = $this->transactions_model->getALLAccountDetails();
						
						$this->data['income_category'] = $this->transactions_model->getALLCategory();
						$this->data['user_list'] = $this->transactions_model->getALLUser();
						$this->data['payment_methode'] = $this->transactions_model->getPaymentMethode();
						$this->show_view_admin('admin/transactions/deposit_add', $this->data);
					}		
				}
				else
				{		
						$this->data['role_list'] = $this->transactions_model->getRoleList();
						$this->data['account_details'] = $this->transactions_model->getALLAccountDetails();
						
						$this->data['income_category'] = $this->transactions_model->getALLCategory();
						$this->data['user_list'] = $this->transactions_model->getALLUser();	
						$this->data['payment_methode'] = $this->transactions_model->getPaymentMethode();			
					$this->data['role_list'] = $this->transactions_model->getRoleList();
					$this->show_view_admin('admin/transactions/deposit_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'dashboard/error/1');
			}
   		}

   }

   /* Delete */
	public function deletedeposit()
	{
		if($this->checkDeletePermission())
		{
			$transactions_id = $this->uri->segment(3);	
			$this->transactions_model->deletedeposit($transactions_id);
			$msg = 'Income deposit remove successfully...!';
			$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
			redirect(base_url().'transactions/deposit');
			
		}
		else
		{
			redirect( base_url().'dashboard/error/1');
		}		
	}

//########### deposit Setting End  ##############

//############## Expense  Setting Start #################

 public function expense()
   {
   		if($this->checkViewPermission())
		{			
			$this->data['expenses_result'] = $this->transactions_model->getAllexpenses();
			$this->data['advance_data_tbl'] = '1';	
			$this->show_view_admin('admin/transactions/expenses', $this->data);
		}
		else
		{	
			redirect(base_url().'dashboard/error/1');
		}
   }

   public function addexpenses($transactions_id ='')
   {

   		if($transactions_id != '')
   		{
   			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{					
					$this->form_validation->set_rules($this->validation_rules['expensesAdd']);
					if($this->form_validation->run())
					{

						$transactions_id = $transactions_id;
						$post['date'] = $this->input->post('date');
						$post['account_id'] = $this->input->post('account_id');
						$post['amount'] = $this->input->post('amount');
						$post['category_id'] = $this->input->post('income_category_id');
						$post['paid_by'] = $this->input->post('paid_by');
						$post['payment_methods_id'] = $this->input->post('payment_methods_id');
						$post['reference'] = $this->input->post('reference');
						$post['notes'] = $this->input->post('notes');
						if ($_FILES["attachement"]["name"])
						{
	                        $attachement = 'attachement';
	                        $fieldName = "attachement";
	                        $Path = 'webroot/upload/deposit/';
	                         $attachement = $this->ImageUpload($_FILES["attachement"]["name"], $attachement, $Path, $fieldName);
	                        $post['attachement'] = $Path.''.$attachement;
	                    }	      
						$edit_result =  $this->transactions_model->updateexpenses($post,$transactions_id);	
						if($edit_result)
						{					
							$msg = 'Expenses Update successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'transactions/expense');
						}
					}
					else
					{	
					    $this->data['account_details'] = $this->transactions_model->getALLAccountDetails();
						
						$this->data['income_category'] = $this->transactions_model->getALLCategory();
						$this->data['user_list'] = $this->transactions_model->getALLUser();	
						$this->data['payment_methode'] = $this->transactions_model->getPaymentMethode();			
						$this->data['edit_expense'] = $this->transactions_model->editexpenses($transactions_id);
						$this->show_view_admin('admin/transactions/expenses_update', $this->data);
					}		
				}
				else
				{
					$this->data['account_details'] = $this->transactions_model->getALLAccountDetails();
						
						$this->data['income_category'] = $this->transactions_model->getALLCategory();
						$this->data['user_list'] = $this->transactions_model->getALLUser();	
						$this->data['payment_methode'] = $this->transactions_model->getPaymentMethode();
					$this->data['edit_expense'] = $this->transactions_model->editexpenses($transactions_id);					
					$this->show_view_admin('admin/transactions/expenses_update', $this->data);
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
					$this->form_validation->set_rules($this->validation_rules['expensesAdd']);
					if($this->form_validation->run())
					{
						$post['date'] = $this->input->post('date');
						$post['type'] = 'Expenses';
						$post['account_id'] = $this->input->post('account_id');
						$post['amount'] = $this->input->post('amount');
						$post['debit'] = $this->input->post('amount');
						$post['category_id'] = $this->input->post('income_category_id');
						$post['paid_by'] = $this->input->post('paid_by');
						$post['payment_methods_id'] = $this->input->post('payment_methods_id');
						$post['reference'] = $this->input->post('reference');
                        $post['permission'] = $this->input->post('permission');
						$post['notes'] = $this->input->post('notes');
						$ac_bal = $this->transactions_model->getAccountBalanceById($post['account_id']);
						$post['total_balance'] = $ac_bal[0]->total_balance-$post['amount'];
						$transactions_id =  $this->transactions_model->addexpenses($post);	
						if($transactions_id)
						{

						   if($_POST['permission'] == '0')
                            {
                                $permission_arr = $this->input->post('assigned_to');
                                if(sizeof($permission_arr) > 0)
                                {   
                                    for ($i=0; $i < count($permission_arr) ; $i++) 
                                    {                                       
                                        $post_permission['transactions_id'] = $transactions_id;
                                        $post_permission['user_id'] = $permission_arr[$i];
                                        $post_permission['permission_view'] = $this->input->post('view_'.$permission_arr[$i]);
                                        $post_permission['permission_edit'] = $this->input->post('edit_'.$permission_arr[$i]);
                                        $post_permission['permission_delete'] = $this->input->post('delete_'.$permission_arr[$i]);
                                        $post_permission['others_permission_status'] = 1;
                                        $post_permission['others_permission_created_date'] = date('Y-m-d');
                                        $post_permission['others_permission_update_date'] = date('Y-m-d');
                                        $this->transactions_model->addticketsPermission($post_permission);
                                    }                               
                                }
                                
                            }    	
						 $this->transactions_model->updateBalanceById($post['account_id'],$post['total_balance']);
							if($_FILES["attachement"]['name'])
								{							
									$attachment_array = $_FILES["attachement"]["name"];
									for($k = 0; $k < count($attachment_array); $k++)
									{	
										$_FILES['new_file']['name'] = $_FILES['attachement']['name'][$k];
										$_FILES['new_file']['type'] = $_FILES['attachement']['type'][$k];
						                $_FILES['new_file']['tmp_name'] = $_FILES['attachement']['tmp_name'][$k];
						                $_FILES['new_file']['error'] = $_FILES['attachement']['error'][$k];
						                $_FILES['new_file']['size'] = $_FILES['attachement']['size'][$k];
						              	$name = 'transaction_attechment';
						              	$imagePath = 'webroot/upload/transactions/';
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
						                   	$post_img['attachement'] = $imagePath.''.$imageName;
											$post_img['transactions_id'] =  $transactions_id;	
											$post_img['transactions_type'] =  'Expenses';	
											$this->transactions_model->addTransactonFile($post_img);
						              	}
                                    }

                                }
							$msg = 'Expenses added successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'transactions/expense');
						}
					}
					else
					{				
					
						$this->data['role_list'] = $this->transactions_model->getRoleList();
						$this->data['account_details'] = $this->transactions_model->getALLAccountDetails();
						
						$this->data['income_category'] = $this->transactions_model->getALLCategory();
						$this->data['user_list'] = $this->transactions_model->getALLUser();
						$this->data['payment_methode'] = $this->transactions_model->getPaymentMethode();
						$this->show_view_admin('admin/transactions/expenses_add', $this->data);
					}		
				}
				else
				{		
						$this->data['role_list'] = $this->transactions_model->getRoleList();
						$this->data['account_details'] = $this->transactions_model->getALLAccountDetails();
						
						$this->data['income_category'] = $this->transactions_model->getALLCategory();
						$this->data['user_list'] = $this->transactions_model->getALLUser();	
						$this->data['payment_methode'] = $this->transactions_model->getPaymentMethode();			
					$this->data['role_list'] = $this->transactions_model->getRoleList();
					$this->show_view_admin('admin/transactions/expenses_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'dashboard/error/1');
			}
   		}

   }

   /* Delete */
	public function deleteexpenses()
	{
		if($this->checkDeletePermission())
		{
			$transactions_id = $this->uri->segment(3);	
			$this->transactions_model->deleteexpenses($transactions_id);
			$msg = ' Expenses remove successfully...!';
			$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
			redirect(base_url().'transactions/deposit');
			
		}
		else
		{
			redirect( base_url().'dashboard/error/1');
		}		
	}

//############## Expense  Setting End #################


//############## Transfer Setting Start ################
 
 public function transfer()
   {
   		if($this->checkViewPermission())
		{			
			$this->data['transfer_result'] = $this->transactions_model->getAlltransfer();
			$this->data['advance_data_tbl'] = '1';	
			$this->show_view_admin('admin/transactions/transfer', $this->data);
		}
		else
		{	
			redirect(base_url().'dashboard/error/1');
		}
   }

   public function addtransfer($transfer_id ='')
   {

   		if($transfer_id != '')
   		{
   			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{					
					$this->form_validation->set_rules($this->validation_rules['transferAdd']);
					if($this->form_validation->run())
					{
						

						$post['transfer_date'] = $this->input->post('transfer_date');
						$post['to_account_id'] = $this->input->post('to_account_id');
						$post['from_account_id'] = $this->input->post('from_account_id');
						$post['amount'] = $this->input->post('amount');
						$post['payment_methods_id'] = $this->input->post('payment_methods_id');
						$post['reference'] = $this->input->post('reference');
						$post['notes'] = $this->input->post('notes');
						if ($_FILES["attachement"]["name"])
						{
	                        $attachement = 'attachement';
	                        $fieldName = "attachement";
	                        $Path = 'webroot/upload/deposit/';
	                         $attachement = $this->ImageUpload($_FILES["attachement"]["name"], $attachement, $Path, $fieldName);
	                        $post['attachement'] = $Path.''.$attachement;
	                    }	      
						$edit_result =  $this->transactions_model->updatetransfer($post,$transfer_id);	
						if($edit_result)
						{					
						
							$msg = 'Transfer Update successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'transactions/transfer');
						}
					}
					else
					{	
					    $this->data['account_details'] = $this->transactions_model->getALLAccountDetails();
						
						$this->data['income_category'] = $this->transactions_model->getALLCategory();
						$this->data['user_list'] = $this->transactions_model->getALLUser();	
						$this->data['payment_methode'] = $this->transactions_model->getPaymentMethode();			
						$this->data['edit_transfer'] = $this->transactions_model->edittransfer($transfer_id);
						$this->show_view_admin('admin/transactions/transfer_update', $this->data);
					}		
				}
				else
				{
					$this->data['account_details'] = $this->transactions_model->getALLAccountDetails();
						
						$this->data['income_category'] = $this->transactions_model->getALLCategory();
						$this->data['user_list'] = $this->transactions_model->getALLUser();	
						$this->data['payment_methode'] = $this->transactions_model->getPaymentMethode();
					$this->data['edit_transfer'] = $this->transactions_model->edittransfer($transfer_id);					
					$this->show_view_admin('admin/transactions/transfer_update', $this->data);
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
					$this->form_validation->set_rules($this->validation_rules['transferAdd']);
					if($this->form_validation->run())
					{						
						$post['transfer_date'] = $this->input->post('transfer_date');
						$post['to_account_id'] = $this->input->post('to_account_id');
						$post['from_account_id'] = $this->input->post('from_account_id');
						$post['amount'] = $this->input->post('amount');
						$post['payment_methods_id'] = $this->input->post('payment_methods_id');
						$post['reference'] = $this->input->post('reference');
                        $post['permission'] = $this->input->post('permission');
						$post['notes'] = $this->input->post('notes');
						$transfer_id =  $this->transactions_model->addtransfer($post);	
						if($transfer_id)
						{
							  if($_POST['permission'] == '0')
                            {
                                $permission_arr = $this->input->post('assigned_to');
                                if(sizeof($permission_arr) > 0)
                                {   
                                    for ($i=0; $i < count($permission_arr) ; $i++) 
                                    {                                       
                                        $post_permission['transactions_id'] = $transfer_id;
                                        $post_permission['user_id'] = $permission_arr[$i];
                                        $post_permission['permission_view'] = $this->input->post('view_'.$permission_arr[$i]);
                                        $post_permission['permission_edit'] = $this->input->post('edit_'.$permission_arr[$i]);
                                        $post_permission['permission_delete'] = $this->input->post('delete_'.$permission_arr[$i]);
                                        $post_permission['others_permission_status'] = 1;
                                        $post_permission['others_permission_created_date'] = date('Y-m-d');
                                        $post_permission['others_permission_update_date'] = date('Y-m-d');
                                        $this->transactions_model->addticketsPermission($post_permission);
                                    }                               
                                }
                                
                            }    	

							$from_account_bal = $this->transactions_model->getAccountBalanceById($this->input->post('from_account_id'));	
							$from_total_bal = $from_account_bal[0]->total_balance - $this->input->post('amount');
							$this->transactions_model->updateBalanceById($this->input->post('from_account_id'),$from_total_bal);
							$to_account_bal = $this->transactions_model->getAccountBalanceById($this->input->post('to_account_id'));	
							$to_total_bal = $to_account_bal[0]->total_balance+$this->input->post('amount');
							$this->transactions_model->updateBalanceById($this->input->post('to_account_id'),$to_total_bal);
							if($_FILES["attachement"]['name'])
								{							
									$attachment_array = $_FILES["attachement"]["name"];
									for($k = 0; $k < count($attachment_array); $k++)
									{	
										$_FILES['new_file']['name'] = $_FILES['attachement']['name'][$k];
										$_FILES['new_file']['type'] = $_FILES['attachement']['type'][$k];
						                $_FILES['new_file']['tmp_name'] = $_FILES['attachement']['tmp_name'][$k];
						                $_FILES['new_file']['error'] = $_FILES['attachement']['error'][$k];
						                $_FILES['new_file']['size'] = $_FILES['attachement']['size'][$k];
						              	$name = 'transaction_attechment';
						              	$imagePath = 'webroot/upload/transactions/';
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
						                   	$post_img['attachement'] = $imagePath.''.$imageName;
											$post_img['transfer_id'] =  $transfer_id;	
											$post_img['transactions_type'] =  'Transfer';	
											$this->transactions_model->addTransactonFile($post_img);
						              	}
                                    }

                                }
							$msg = 'Transfer added successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'transactions/transfer');
						}
					}
					else
					{				
					
						$this->data['role_list'] = $this->transactions_model->getRoleList();
						$this->data['account_details'] = $this->transactions_model->getALLAccountDetails();	
						$this->data['income_category'] = $this->transactions_model->getALLCategory();
						$this->data['user_list'] = $this->transactions_model->getALLUser();
						$this->data['payment_methode'] = $this->transactions_model->getPaymentMethode();
						$this->show_view_admin('admin/transactions/transfer_add', $this->data);
					}		
				}
				else
				{		
						$this->data['role_list'] = $this->transactions_model->getRoleList();
						$this->data['account_details'] = $this->transactions_model->getALLAccountDetails();
						$this->data['income_category'] = $this->transactions_model->getALLCategory();
						$this->data['user_list'] = $this->transactions_model->getALLUser();	
						$this->data['payment_methode'] = $this->transactions_model->getPaymentMethode();			
					$this->data['role_list'] = $this->transactions_model->getRoleList();
					$this->show_view_admin('admin/transactions/transfer_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'dashboard/error/1');
			}
   		}

   }

   /* Delete */
	public function deletetransfer()
	{
		if($this->checkDeletePermission())
		{
			$transfer_id = $this->uri->segment(3);	
			$this->transactions_model->deletetransfer($transfer_id);
			$msg = 'Transfer remove successfully...!';
			$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
			redirect(base_url().'transactions/transfer');
			
		}
		else
		{
			redirect( base_url().'dashboard/error/1');
		}		
	}

    public function getTransferToaccountList()
    {
         $from_account_id = $this->input->post('from_account_id');
         $toaccount_details = $this->transactions_model->getALLToAccountDetails($from_account_id);
       
         $html = '';
        if(count($toaccount_details) > 0)
        {
            foreach ($toaccount_details as $res) 
            {
                $html .= '<option value="'.$res->account_id.'">'.$res->account_name.'</option>';
            }            
            echo $html; 
        }
        else
        {
            echo $html;
        }
    }
//########### Transfer Setting End ######################

//###########  Transactions Reports Start ##############

  
 public function transactionsReport()
   {
   		if($this->checkViewPermission())
		{			
			$this->data['transactions_reports_result'] = $this->transactions_model->getAlltransactionsreport();
			$this->data['advance_data_tbl'] = '1';	
			$this->show_view_admin('admin/transactions/transactions_report', $this->data);
		}
		else
		{	
			redirect(base_url().'dashboard/error/1');
		}
   }

//########### Transactions Reports End ##############


//########### Balance sheet start ##############

	public function balanceSheet()
   {
   		if($this->checkViewPermission())
		{			
			$this->data['blnce_sheet_result'] = $this->transactions_model->getAllblancesheet();
			$this->data['advance_data_tbl'] = '1';	
			$this->show_view_admin('admin/transactions/balance_sheet', $this->data);
		}
		else
		{	
			redirect(base_url().'dashboard/error/1');
		}
   }

   public function transferReport()
   {
   		if($this->checkViewPermission())
		{			
			$this->data['transfer_reports_result'] = $this->transactions_model->getAlltransferreport();
			$this->data['advance_data_tbl'] = '1';	
			$this->show_view_admin('admin/transactions/transfer_report', $this->data);
		}
		else
		{	
			redirect(base_url().'dashboard/error/1');
		}
   }

//########### Balance sheet End ##############

}
?>