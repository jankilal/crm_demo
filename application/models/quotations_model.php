<?php

class Quotations_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	}

	/*	Show all quotations  */
	public function getAllQuotations()
	{
		$this->db->select('a.*,b.opportunity_name');
		$this->db->from('tbl_quotation a');
		$this->db->join('tbl_opportunities b', 'b.opportunities_id = a.lead_id');
		$query = $this->db->get();
		return $query->result() ;
	}
	public function getAllQuotationsBYUserLogin($user_id)
	{
		$this->db->select('a.*,b.opportunity_name,c.*');
		$this->db->from('tbl_quotation a');
		$this->db->join('tbl_opportunities b', 'b.opportunities_id = a.lead_id');
		$this->db->join('tbl_assign_user c','c.lead_id = a.lead_id', 'inner');
		$this->db->where('c.user_id' , $user_id);
		$query = $this->db->get();
		return $query->result() ;
	}


	/*	Show all quotations  */
	public function getAllOpportunities()
	{
		$this->db->select('*');
		$this->db->from('tbl_opportunities');		
		$query = $this->db->get();
		return $query->result() ;
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

	/* Add New quotations */	
	public function addQuotations($post)
	{
		$this->db->insert('tbl_quotations', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	

	public function addQuotationsProducts($post)
	{
		$this->db->insert('tbl_quotations_products', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	

	public function addQuotationsProductsFile($post)
	{
		$this->db->insert('tbl_quotations_products_files', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	
	/* Add New quotations */	
	public function addQuotationsPermission($post)
	{
		$this->db->insert('tbl_others_permission', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	//Add quotations Contact Details
	public function addQuotationsCotactDetails($post)
	{
		$this->db->insert('tbl_quotations_contact', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	
	
	/*	Get all State List  */
	public function getOpportunityProducts($opportunities_id)
	{
		$this->db->select('c.*');
		$this->db->from('tbl_opportunities_process a');
		$this->db->join('tbl_opportunities_process_details b', 'b.opportunities_process_id = a.opportunities_process_id');
		$this->db->join('tbl_opportunities_products c', 'b.opportunities_process_details_id = c.opportunities_process_detail_id');		
		$this->db->where('a.opportunities_id', $opportunities_id);
		$query = $this->db->get();
		return $query->result() ;
	}

	/*	Get all State List  */
	public function getALLQuotationsSourceList()
	{
		$this->db->select('*');
		$this->db->from('tbl_lead_source');
		$this->db->where('lead_source_status', '1');
		$query = $this->db->get();
		return $query->result() ;
	}

	/* ******** Company List ***********/
	public function getClientList()
	{
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('user_role_id', '3');
		$this->db->where('user_type', 'Client');
		$query = $this->db->get();
		return $query->result() ;
	}
	
	/*	Get all State List by country list */
	public function getQuotationsStateById($op_state_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_quotations_state_reason');
		$this->db->where('quotations_state_reason_id', $op_state_id);
		$query = $this->db->get();
		return $query->result() ;
	}	

	/* Edit User details */	
	public function editQuotations($quotations_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_quotations');
		$this->db->where('quotations_id', $quotations_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	/* Update User */
	public function updateQuotations($post,$quotations_id)
	{
		$this->db->where('quotations_id', $quotations_id);
		$this->db->update('tbl_quotations', $post);
		return true;
	}
	/* Update status */
	public function changeQuotationstatus($lead_status_id,$quotations_id)
	{
		$data['lead_status_id'] = $lead_status_id;
		$this->db->where('quotations_id', $quotations_id);
		$this->db->update('tbl_quotations', $data);
		return true;
	}
	
	/* Delete User detail */
	function deleteQuotations($quotations_id)
	{
		$this->db->delete('tbl_quotations', array('quotations_id' => $quotations_id));		
		return 1;		
	}

}
?>
