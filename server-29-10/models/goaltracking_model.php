<?php

class goalTracking_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	}

	
	/*	Show all goalTracking  */
	public function getAllGoalTracking()
	{
		$this->db->select('*');
		$this->db->from('tbl_goal_tracking');		
		$query = $this->db->get();
		return $query->result() ;
	}
	
	/* Add New goalTracking */	
	public function addGoalTracking($post)
	{
		$this->db->insert('tbl_goal_tracking', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	
	/* Add New goalTracking */	
	public function addgoalTrackingPermission($post)
	{
		$this->db->insert('tbl_others_permission', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}


	/* ******** Company List ***********/
	public function getALLGoalTrackingcategory()
	{
		$this->db->select('*');
		$this->db->from('tbl_goal_tracking');		
		$query = $this->db->get();
		return $query->result() ;
	}
	
	/* Edit User details */	
	public function editGoalTracking($goal_tracking_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_goal_tracking');
		$this->db->where('goal_tracking_id', $goal_tracking_id);
		$query = $this->db->get();
		return $query->result();
	}

	
	/* Update User */
	public function updateGoalTracking($post,$goal_tracking_id)
	{
		$this->db->where('goal_tracking_id', $goal_tracking_id);
		$this->db->update('tbl_goal_tracking', $post);
		return true;
	}
	
	/* Delete User detail */
	function deletegoalTracking($goal_tracking_id)
	{
		$this->db->delete('tbl_goal_tracking', array('goal_tracking_id' => $goal_tracking_id));		
		return 1;		
	}

	  public function getALLUser()
	{
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('user_role_id !=','1');		
		$query = $this->db->get();
		return $query->result() ;
	}
		public function addTicketsPermission($post)
	{
		$this->db->insert('tbl_others_permission', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	

}
?>
