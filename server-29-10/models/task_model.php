
<?php

class task_model extends Comman_model 
{
	function __construct()
	{
       parent::__construct();
	}
	
	/*	Show all task  */
	public function getAlltask()
	{
		$this->db->select('*');
		$this->db->from('tbl_task');
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
	public function getALLUser()
	{
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('user_role_id !=','1');		
		$query = $this->db->get();
		return $query->result() ;
	}
		public function addticketsPermission($post)
	{
		$this->db->insert('tbl_others_permission', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	

	/* Add New task */	
	public function addtask($post)
	{
		$this->db->insert('tbl_task', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	
	
	/*	Get all State List  */
	public function getALLtaskStateList()
	{
		$this->db->select('*');
		$this->db->from('tbl_task_state_reason');
		$this->db->where('task_state_reason_status', '1');
		$query = $this->db->get();
		return $query->result() ;
	}


	/*	Get all State List by country list */
	public function getReletedModuleitem()
	{
		$this->db->select('*');
		$this->db->from('tbl_items');
		$query = $this->db->get();
		return $query->result() ;
	}	

	public function getReletedModuleOpportunities()
	{
		$this->db->select('*');
		$this->db->from('tbl_opportunities');
		$query = $this->db->get();
		return $query->result() ;
	}	

	public function getReletedModuleLeads()
	{
		$this->db->select('*');
		$this->db->from('tbl_leads');
		$query = $this->db->get();
		return $query->result() ;
	}	

	public function getReletedModuletask()
	{
		$this->db->select('*');
		$this->db->from('tbl_task');
		$query = $this->db->get();
		return $query->result() ;
	}	
	
	public function getReletedModuleGoal()
	{
		$this->db->select('*');
		$this->db->from('tbl_goal_tracking');
		$query = $this->db->get();
		return $query->result() ;
	}	

	/* Edit User details */	
	public function edittask($task_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_task');
		$this->db->where('task_id', $task_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	/* Update User */
	public function updateTask($post,$task_id)
	{		
		
		$this->db->where('task_id', $task_id);
		$this->db->update('tbl_task', $post);
		return true;
	}
	
	/* Delete User detail */
	function deletetask($task_id)
	{
		$this->db->delete('tbl_task', array('task_id' => $task_id));		
		return 1;		
	}
}
?>
