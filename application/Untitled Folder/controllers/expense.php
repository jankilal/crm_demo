<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Expense extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('expense_model');
		
	}	

	public function index()
	{
		if($this->checkViewPermission())
		{			
			$this->data['expense_result'] = $this->expense_model->getAllExpense();			
			$this->data['advance_data_tbl'] = '1';				
			$this->show_view_admin('expenses/expense_view', $this->data);
		}
		else
		{	
			redirect(base_url().'dashboard/error/1');
		}
    }

    /* Add and Update */
	public function addexpense($expense_id = '')
	{ 
		if($expense_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit")
				{	
						$post['expenses_id'] = $expense_id;				
						$post['expenses_amt'] = $this->input->post('expenses_amt');
						$post['expenses_category_id'] = $this->input->post('expenses_category_id');
						$post['expenses_narration'] = $this->input->post('expenses_narration');
						if ($_FILES["expenses_attachment"]["name"])
						{
	                        $expenses_attachment = 'expenses_attachment';
	                        $fieldName = "expenses_attachment";
	                        $Path = 'webroot/upload/expenses/';
	                         $expenses_attachment = $this->ImageUpload($_FILES["expenses_attachment"]["name"], $expenses_attachment, $Path, $fieldName);
	                        $post['expenses_attachment'] = $Path.''.$expenses_attachment;
	                    }	     
						$expense_res =  $this->expense_model->updateExpense($post,$expense_id);	
						if($expense_res)
						{					
							$msg = 'expense added successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'expense/index');
						}
					}
					else
					{				
						$this->data['edit_expense'] = $this->expense_model->editexpense($expense_id);
						$this->data['expense_category'] = $this->expense_model->getALLexpensecategory();
						$this->show_view_admin('expenses/expense_update', $this->data);
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
						$post['expenses_id'] = round(microtime(true) * 1000);
			         	$post['expenses_amt'] = $this->input->post('expenses_amt');
						$post['expenses_category_id'] = $this->input->post('expenses_category_id');
						$post['expenses_narration'] = $this->input->post('expenses_narration');
						if ($_FILES["expenses_attachment"]["name"])
						{
	                        $expenses_attachment = 'expenses_attachment';
	                        $fieldName = "expenses_attachment";
	                        $Path = 'webroot/upload/expenses/';
	                         $expenses_attachment = $this->ImageUpload($_FILES["expenses_attachment"]["name"], $expenses_attachment, $Path, $fieldName);
	                        $post['expenses_attachment'] = $Path.''.$expenses_attachment;
	                    }	     

						$expense_id =  $this->expense_model->addexpense($post);

						if($expense_id)
						{	
							
							$msg = 'Leads added successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'expense');			
						}
					}		
				else
				{	
					$this->data['expense_category'] = $this->expense_model->getALLexpensecategory();
					$this->show_view_admin('expenses/expense_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'dashboard/error/1');
			}
		}		
	}
	
	/* Delete */
	public function deleteexpense()
	{
		if($this->checkDeletePermission())
		{
			$expenses_id = $this->uri->segment(3);	
			$this->expense_model->deleteExpense($expenses_id);
			
				$msg = 'expense remove successfully...!';					
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'expense');			
		}
		else
		{
			redirect( base_url().'dashboard/error/1');
		}		
	}

	
}
/* End of file */?>