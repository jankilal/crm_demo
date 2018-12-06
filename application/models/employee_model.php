<?php

class employee_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}
	
	/*	Show all employee  */
	public function getAllEmployee()
	{
		// ,d.user_full_name as company_name
		$this->db->select('a.* ,b.country_name , c.state_name');
		$this->db->from('tbl_user a');
		$this->db->join('tbl_country b', 'b.country_id = a.user_country_id', 'inner');
		$this->db->join('tbl_state c', 'c.state_id = a.user_state_id', 'inner');
		// $this->db->join('tbl_departments d', 'd.departments_id = a.department_id' , 'left');
		$this->db->where('a.user_role_id', '3');
		$this->db->where('a.user_type', 'Employee');
		$query = $this->db->get();
		// echo $this->db->last_query(); die();
		return $query->result() ;
	}

	/*	Show all Employe By role Id  */
	public function getAllEmployeeByRole($user_id)
	{
		$this->db->select('a.* , b.country_name,c.state_name,d.user_full_name as company_name');
		$this->db->from('tbl_user a');
		$this->db->join('tbl_country b', 'b.country_id = a.user_country_id', 'inner');
		$this->db->join('tbl_state c', 'c.state_id = a.user_state_id', 'inner');
		$this->db->where('a.user_role_id', '3');
		$this->db->join('tbl_user d', 'a.company_id = d.user_id' , 'inner');
		$this->db->where('a.user_type', 'Employee');
		$this->db->where('a.company_id', $user_id);
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
	
	public function getCompanyList()
	{
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('user_role_id', '2');
		$this->db->where('user_type', 'Company');
		$query = $this->db->get();
		return $query->result() ;
	}

	/* Add New employee */	
	public function addEmployee($post)
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
		//$this->db->or_where('country_id', '38');
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

	/*	Get all State List by country list */
	public function getDepartMentByCompanyId($company_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_departments');
		$this->db->where('department_status', 1);
		// $this->db->where('company_id', $company_id);
		$query = $this->db->get();
		return $query->result() ;
	}	

	/* Edit User details */	
	public function editEmployee($employee_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('user_id', $employee_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	/* Update User */
	public function updateEmployee($post,$user_id)
	{	
		$this->db->where('user_id', $user_id);
		$this->db->update('tbl_user', $post);
		return true;
	}
	
	/* Delete User detail */
	function deleteEmployee($employee_id)
	{
		$this->db->delete('tbl_user', array('user_id' => $employee_id));		
		return 1;		
	}

	/* check Company Email Id */	
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
