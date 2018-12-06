<?php

class company_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}
	
	/*	Show all company  */
	public function getAllCompany()
	{
		$this->db->select('a.* , b.country_name,c.state_name');
		$this->db->from('tbl_user a');
		$this->db->join('tbl_country b', 'b.country_id = a.user_country_id');
		$this->db->join('tbl_state c', 'c.state_id = a.user_state_id');
		$this->db->where('a.user_role_id', '2');
		$this->db->where('a.user_type', 'Company');
		$this->db->order_by('a.user_id', 'DESC');
		$query = $this->db->get();
		return $query->result() ;
	}

	/*	Show all Company By Id  */
	public function getAllCompanyByRole($user_id)
	{
		$this->db->select('a.* , b.country_name,c.state_name');
		$this->db->from('tbl_user a');
		$this->db->join('tbl_country b', 'b.country_id = a.user_country_id');
		$this->db->join('tbl_state c', 'c.state_id = a.user_state_id');
		$this->db->where('a.user_role_id', '2');
		$this->db->where('a.user_type', 'Company');
		$this->db->where('a.added_by', $user_id);
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

	

	/* Add New company */	
	public function addCompany($post)
	{
		$this->db->insert('tbl_user', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	
	
	/*	Get all Country List  */
	public function getCountryList()
	{
		$this->db->select('*');
		$this->db->from('tbl_country');
		$this->db->where('country_id', '99');
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

	/* Edit User details */	
	public function editCompany($company_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('user_id', $company_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	/* Update User */
	public function updateCompany($post,$user_id)
	{		
		$this->db->where('user_id', $user_id);
		$this->db->update('tbl_user', $post);
		return true;
	}
	
	/* Delete User detail */
	function deleteCompany($company_id)
	{
		$this->db->delete('tbl_user', array('user_id' => $company_id));		
		return 1;		
	}

	/* Delete User detail */
	function deleteCompanyEmployee($company_id)
	{
		$this->db->delete('tbl_user', array('company_id' => $company_id));		
		return 1;		
	}

	/* Edit details */	
	public function checkCompanyEmailId($email_id,$user_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('user_email', $email_id);
		$this->db->where('user_id !=', $user_id);
		$query = $this->db->get();
		return $query->num_rows();
	}
}
?>
