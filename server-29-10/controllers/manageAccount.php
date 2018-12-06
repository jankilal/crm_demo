<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ManageAccount extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('manageAccount_model');
		
	}
	 /*	Validation Rules */
	 protected $validation_rules = array
        (
        
		'bankcashAdd' => array(
        	
            array(
                'field' => 'account_name',
                'label' => 'Account Name',
                'rules' => 'trim|required'
            ),			
             array(
                'field' => 'total_balance',
                'label' => 'Initial Balance',
                'rules' => 'trim|required'
            
          )
         )
        );


	public function index()
	{
		if($this->checkViewPermission())
		{			
			$this->data['bankcash_result'] = $this->manageAccount_model->getAllBankCash();
			$this->data['advance_data_tbl'] = '1';				
			$this->show_view_admin('bankcash/bank_cash' ,$this->data);
		}
		else
		{	
			redirect(base_url().'dashboard/error/1');
		}
    }

    /* Add and Update */
	public function addBankCash($account_id = '')
	{ 
		if($account_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit")
				{	
					$this->form_validation->set_rules($this->validation_rules['bankcashAdd']);
					if($this->form_validation->run())
					{
						$post['account_name'] = $this->input->post('account_name');
						$post['total_balance'] = $this->input->post('total_balance');
						$post['description'] = $this->input->post('description');
						$BankCash_res =  $this->manageAccount_model->updateBankCash($post,$account_id);	
						if($BankCash_res)
						{					
							$msg = 'BankCash added successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'manageAccount');
						}
					}
				}
					else
					{				
						$this->data['edit_bankcash'] = $this->manageAccount_model->editBankCash($account_id);
						
						
						$this->show_view_admin('bankcash/bank_cash_update', $this->data);
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
                    $this->form_validation->set_rules($this->validation_rules['bankcashAdd']);
					if($this->form_validation->run())
					{
						$post['account_name'] = $this->input->post('account_name');
						$post['total_balance'] = $this->input->post('total_balance');
						$post['description'] = $this->input->post('description');
						$post['permission'] = $this->input->post('permission');

						$account_id =  $this->manageAccount_model->addBankCash($post);

						if($account_id)
						{  
						   if($post['permission'] == '0')
                            {
                                $permission_arr = $this->input->post('assigned_to');
                                if(sizeof($permission_arr) > 0)
                                {   
                                    for ($i=0; $i < count($permission_arr) ; $i++) 
                                    {                                       
                                        $post_permission['account_id'] = $account_id;
                                        $post_permission['user_id'] = $permission_arr[$i];
                                        $post_permission['permission_view'] = $this->input->post('view_'.$permission_arr[$i]);
                                        $post_permission['permission_edit'] = $this->input->post('edit_'.$permission_arr[$i]);
                                        $post_permission['permission_delete'] = $this->input->post('delete_'.$permission_arr[$i]);
                                        $post_permission['others_permission_status'] = 1;
                                        $post_permission['others_permission_created_date'] = date('Y-m-d');
                                        $post_permission['others_permission_update_date'] = date('Y-m-d');
                                        $this->manageAccount_model->addticketsPermission($post_permission);
                                    }                               
                                }
                                
                            }   	
							
							$msg = 'bankcash added successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'manageAccount');			
						}
					}
					else
					{
					   $this->data['GoalTracking_category'] = $this->manageAccount_model->getALLBankCashcategory();
					   $this->data['user_list'] = $this->manageAccount_model->getALLUser();
					   $this->show_view_admin('bankcash/bank_cash_add', $this->data);
					}
				}		
				else
				{	
					$this->data['GoalTracking_category'] = $this->manageAccount_model->getALLBankCashcategory();
					  $this->data['user_list'] = $this->manageAccount_model->getALLUser();
					$this->show_view_admin('bankcash/bank_cash_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'dashboard/error/1');
			}
		}		
	}
	
	/* Delete */
	public function deleteBankCash()
	{
		if($this->checkDeletePermission())
		{
			$account_id = $this->uri->segment(3);	
			$this->manageAccount_model->deletebankcash($account_id);
			
				$msg = 'bankcash remove successfully...!';					
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'manageAccount');			
		}
		else
		{
			redirect( base_url().'dashboard/error/1');
		}		
	}

	
}
/* End of file */?>