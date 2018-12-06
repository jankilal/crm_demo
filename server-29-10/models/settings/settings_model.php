<?php

class Settings_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}
	
	/*	Get all Role List  */
	public function getRoleList()
	{
		$this->db->select('*');
		$this->db->from('tbl_role');
		$this->db->where('role_status', '1');
		$this->db->where('role_id !=', '1');
		$query = $this->db->get();
		return $query->result() ;
	}

	/*	Get all Country List  */
	public function getCountrylist()
	{
		$this->db->select('*');
		$this->db->from('tbl_country');
		$this->db->where('country_status', '1');
		$query = $this->db->get();
		return $query->result() ;
	}

	/*	Get all State List  */
	public function getStateList()
	{
		$this->db->select('*');
		$this->db->from('tbl_state');
		$this->db->where('state_status', '1');
		$query = $this->db->get();
		return $query->result() ;
	}


	/*	Get all State List by country list */
	public function getStateListByCountryId($country_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_state');
		$this->db->where('state_status', '1');
		$this->db->where('country_id', $country_id);
		$query = $this->db->get();
		return $query->result() ;
	}	

// ################## Genral Settings Start ##################
	
	/*	Show Company Details  */
	public function getCompanyDetails()
	{
		$this->db->select('*');
		$this->db->from('tbl_company');	
		$query = $this->db->get();		
		return $query->result() ;
	}	

	/* Add New Company details */	
	public function addAdminCompanyDetails($post)
	{
		$this->db->insert('tbl_company', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	
	

	/* Edit Company details */	
	public function getCompanyDetailsById($user_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_company');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	/* Update Company Details */
	public function updateAdminCompanyDetails($post,$user_id)
	{
		$this->db->where('user_id',$user_id);
		$this->db->update('tbl_company', $post);
		return true;
	}

// ##################### Genral Settings End ##################

// ############# Income Category Settings Start ###############
	
	public function getAllIncomeCategory()
	{
		$this->db->select('*');
		$this->db->from('tbl_income_category');
		$this->db->where('income_category_status','1');
		$this->db->order_by('income_category_update_date','DESC');
		$query = $this->db->get();		
		return $query->result() ;
	}	

	public function addIncomeCategory($post)
	{
		$this->db->insert('tbl_income_category', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	/* Delete Income Category detail */
	function deleteIncomeCategory($income_cate_id)
	{
		$this->db->delete('tbl_income_category', array('income_category_id' => $income_cate_id));		
		return 1;		
	}

	/* Get Edit Income Category */
	public function editIncomeCategory($income_cate_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_income_category');
		$this->db->where('income_category_id', $income_cate_id);
		$query = $this->db->get();
		return $query->result();
	}

	/* Update Company Details */
	public function updateIncomeCategory($post,$income_cate_id)
	{
		$this->db->where('income_category_id',$income_cate_id);
		$this->db->update('tbl_income_category', $post);
		return true;
	}

// ############# Expense Category Settings Start ###############
	
	public function getAllExpenseCategory()
	{
		$this->db->select('*');
		$this->db->from('tbl_expense_category');
		//$this->db->where('expense_category_status','1');
		$this->db->order_by('expense_category_update_date','DESC');	
		$query = $this->db->get();		
		return $query->result() ;
	}	

	public function addExpenseCategory($post)
	{

		$this->db->insert('tbl_expense_category', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	/* Delete Expense Category detail */
	function deleteExpenseCategory($Expense_cate_id)
	{
		$this->db->delete('tbl_expense_category', array('expense_category_id' => $Expense_cate_id));		
		return 1;		
	}

	/* Get Edit Expense Category */
	public function editExpenseCategory($Expense_cate_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_expense_category');
		$this->db->where('expense_category_id', $Expense_cate_id);
		$query = $this->db->get();
		return $query->result();
	}

	/* Update Company Details */
	public function updateExpenseCategory($post,$Expense_cate_id)
	{
		$this->db->where('expense_category_id',$Expense_cate_id);
		$this->db->update('tbl_expense_category', $post);
		return true;
	}

// ############# Lead Status Settings Start ###############
	
	public function getAllLeadStatus()
	{
		$this->db->select('*');
		$this->db->from('tbl_lead_status');
		// $this->db->where('lead_status_status','1');	
		$this->db->order_by('lead_status_update_date','DESC');
		$query = $this->db->get();		
		return $query->result() ;
	}	

	public function addLeadStatus($post)
	{
		
		$this->db->insert('tbl_lead_status', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	/* Delete  Lead Status detail */
	function deleteLeadStatus($lead_status_id)
	{
		$this->db->delete('tbl_lead_status', array('lead_status_id' => $lead_status_id));		
		return 1;		
	}

	/* Get Edit  Lead Status */
	public function editLeadStatus($lead_status_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_lead_status');
		$this->db->where('lead_status_id', $lead_status_id);
		$query = $this->db->get();
		return $query->result();
	}

	/* Update  Lead Status Details */
	public function updateLeadStatus($post,$lead_status_id)
	{
		$this->db->where('lead_status_id',$lead_status_id);
		$this->db->update('tbl_lead_status', $post);
		return true;
	}

// ############# Lead source Settings Start ###############
	
	public function getAllLeadSource()
	{
		$this->db->select('*');
		$this->db->from('tbl_lead_source');
		// $this->db->where('lead_source_status','1');	
		$this->db->order_by('lead_source_update_date','DESC');
		$query = $this->db->get();		
		return $query->result() ;
	}	

	public function addLeadSource($post)
	{
		
		$this->db->insert('tbl_lead_source', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	/* Delete  Lead source detail */
	function deleteLeadSource($lead_source_id)
	{
		$this->db->delete('tbl_lead_source', array('lead_source_id' => $lead_source_id));		
		return 1;		
	}

	/* Get Edit  Lead source */
	public function editLeadSource($lead_source_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_lead_source');
		$this->db->where('lead_source_id', $lead_source_id);
		$query = $this->db->get();
		return $query->result();
	}

	/* Update  Lead source Details */
	public function updateLeadSource($post,$lead_source_id)
	{
		$this->db->where('lead_source_id',$lead_source_id);
		$this->db->update('tbl_lead_source', $post);
		return true;
	}


// ############# Lead source Settings End ###############


// ############# Opportunities State Reason Settings Start ###############
	
	public function getAllOpportunitiesStateReason()
	{
		$this->db->select('*');
		$this->db->from('tbl_opportunities_state_reason');
		// $this->db->where('opportunities_state_reason_status','1');	
		$this->db->order_by('opportunities_state_reason_update_date','DESC');
		$query = $this->db->get();		
		return $query->result() ;
	}	

	public function addOpportunitiesStateReason($post)
	{
		
		$this->db->insert('tbl_opportunities_state_reason', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	/* Delete  Lead source detail */
	function deleteOpportunitiesStateReason($opportunities_state_reason_id)
	{
		$this->db->delete('tbl_opportunities_state_reason', array('opportunities_state_reason_id' => $opportunities_state_reason_id));		
		return 1;		
	}

	/* Get Edit  Lead source */
	public function editOpportunitiesStateReason($opportunities_state_reason_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_opportunities_state_reason');
		$this->db->where('opportunities_state_reason_id', $opportunities_state_reason_id);
		$query = $this->db->get();
		return $query->result();
	}

	/* Update  Lead source Details */
	public function updateOpportunitiesStateReason($post,$opportunities_state_reason_id)
	{
		$this->db->where('opportunities_state_reason_id',$opportunities_state_reason_id);
		$this->db->update('tbl_opportunities_state_reason', $post);
		return true;
	}

// ############# Opportunities State Reason Settings End ###############


// ############# Opportunities State Reason Settings Start ###############
	
	public function getAllPaymentMethods()
	{
		$this->db->select('*');
		$this->db->from('tbl_payment_methods');
		$this->db->where('payment_methods_status','1');	
		$this->db->order_by('payment_methods_update_date','DESC');
		$query = $this->db->get();		
		return $query->result() ;
	}	

	public function addPaymentMethods($post)
	{
		
		$this->db->insert('tbl_payment_methods', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	/* Delete  Lead source detail */
	function deletePaymentMethods($payment_methods_id)
	{
		$this->db->delete('tbl_payment_methods', array('payment_methods_id' => $payment_methods_id));		
		return 1;		
	}

	/* Get Edit  Lead source */
	public function editPaymentMethods($payment_methods_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_payment_methods');
		$this->db->where('payment_methods_id', $payment_methods_id);
		$query = $this->db->get();
		return $query->result();
	}

	/* Update  Lead source Details */
	public function updatePaymentMethods($post,$payment_methods_id)
	{
		$this->db->where('payment_methods_id',$payment_methods_id);
		$this->db->update('tbl_payment_methods', $post);
		return true;
	}

// ############# Opportunities State Reason Settings End ###############

// ############# Department Settings Start ###############
	
	public function getAllDepartmentCompany()
	{
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('user_role_id','2');	
		$this->db->where('user_type','Company');	
		$this->db->where('user_status','1');	
		$this->db->order_by('user_update_date','DESC');
		$query = $this->db->get();		
		return $query->result() ;
	}	
	public function getAllDepartment()
	{
		$this->db->select('*');
		$this->db->from('tbl_departments a');
		// $this->db->join('tbl_user b', 'a.company_id = b.user_id');
		// $this->db->where('department_status','1');	
		$this->db->order_by('department_update_date','DESC');
		$query = $this->db->get();		
		return $query->result() ;
	}

	public function addDepartment($post)
	{
		$this->db->insert('tbl_departments', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	/* Delete  Lead source detail */
	function deleteDepartment($departments_id)
	{
		$this->db->delete('tbl_departments', array('departments_id' => $departments_id));		
		return 1;		
	}

	/* Get Edit  Lead source */
	public function editDepartment($departments_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_departments');
		$this->db->where('departments_id', $departments_id);
		$query = $this->db->get();
		return $query->result();
	}

	/* Update  Lead source Details */
	public function updateDepartment($post,$departments_id)
	{
		$this->db->where('departments_id',$departments_id);
		$this->db->update('tbl_departments', $post);
		return true;
	}

// ############# Department Settings End ###############

// ############# Stages Settings End ###############


	public function getAllStages()
	{
		$this->db->select('*');
		$this->db->from('tbl_stage');
		$query = $this->db->get();		
		return $query->result() ;
	}

	public function addStages($post)
	{
		$this->db->insert('tbl_stage', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}
	public function updateStages($post,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('tbl_stage', $post);
		return true;
	}
// ############# Stages Settings End ###############

}
?>
