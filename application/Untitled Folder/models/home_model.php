<?php

class Home_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();	  
	}
	
	/*	Show all tabs as per role_id  */
	public function getAllTabAsPerRole($role_id)
	{
		$this->db->select('a.*, b.*');
		$this->db->from('tbl_user_permission a'); 
		$this->db->join('tbl_sidebar_tabs b','a.tab_id = b.tab_id','inner');
		$this->db->where('a.role_id', $role_id);
		$this->db->where('b.status', 1);
		$this->db->order_by('b.tab_number', 'ASC');
		$query = $this->db->get();		
		return $query->result() ;
	}

	public function getSubmenuById($child_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_sidebar_tabs');
		$this->db->where('child_id', $child_id);
		$this->db->where('controller_name != ', '#');
		$this->db->order_by('tab_number', 'ASC');
		$query = $this->db->get();		
		return $query->result() ;
	}
}
?>