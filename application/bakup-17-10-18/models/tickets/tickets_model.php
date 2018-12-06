<?php

class Tickets_model extends CI_Model 
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
// ############# deposit Settings Start ###############

	public function getAllanswerd()
	{
		$this->db->select('a.*,b.user_full_name,c.deptname');
		$this->db->from('tbl_tickets a');
		$this->db->join('tbl_user b', 'b.user_id = a.reporter');
		$this->db->join('tbl_departments c', 'c.departments_id = a.departments_id');
		$this->db->where('a.type','Answerd');
		$this->db->where('a.status','answerd');	
		$query = $this->db->get();
		return $query->result() ;
	}

	
	public function addanswerd($post)
	{

		$this->db->insert('tbl_tickets', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	/* Delete deposit detail */
	function deleteanswerd($tickets_id)
	{
		$this->db->delete('tbl_tickets', array('tickets_id' => $tickets_id));		
		return 1;		
	}

	/* Get Edit deposit */
	public function editanswerd($tickets_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_tickets');
		$this->db->where('tickets_id', $tickets_id);
		$query = $this->db->get();
		return $query->result();
	}
	public function addTicketFile($post)
	{
		$this->db->insert('tbl_tickets_attacment', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	/* Update Company Details */
	public function updateanswerd($post,$tickets_id)
	{
		$this->db->where('tickets_id',$tickets_id);
		$this->db->update('tbl_tickets', $post);
		return true;
	}
	
	public function getALLDepartment()
	{
		$this->db->select('*');
		$this->db->from(' tbl_departments');		
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
	public function addTicketsPermission($post)
	{
		$this->db->insert('tbl_others_permission', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}


// ############# Answerd Settings End ###############

// ############# Open Settings Start ###############


	public function getAllopen()
	{
		$this->db->select('a.*,b.user_full_name,c.deptname');
		$this->db->from('tbl_tickets a');
		$this->db->join('tbl_user b', 'b.user_id = a.reporter');
		$this->db->join('tbl_departments c', 'c.departments_id = a.departments_id');
		$this->db->where('a.type','Open');
		$this->db->where('a.status','open');		
		$query = $this->db->get();
		return $query->result() ;
	}

	
	public function addopen($post)
	{

		$this->db->insert('tbl_tickets', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	/* Delete deposit detail */
	function deleteopen($tickets_id)
	{
		$this->db->delete('tbl_tickets', array('tickets_id' => $tickets_id));		
		return 1;		
	}

	/* Get Edit deposit */
	public function editopen($tickets_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_tickets');
		$this->db->where('tickets_id', $tickets_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	/* Update Company Details */
	public function updateopen($post,$tickets_id)
	{
		$this->db->where('tickets_id',$tickets_id);
		$this->db->update('tbl_tickets', $post);
		return true;
	}
	
// ############# Open Settings End ###############


// ############# inprogress Settings start ###############	


public function getAllinprogress()
	{
		$this->db->select('a.*,b.user_full_name,c.deptname');
		$this->db->from('tbl_tickets a');
		$this->db->join('tbl_user b', 'b.user_id = a.reporter');
		$this->db->join('tbl_departments c', 'c.departments_id = a.departments_id');
		$this->db->where('a.type','Inprogress');
		$this->db->where('a.status','in_progress');		
		$query = $this->db->get();
		return $query->result() ;
	}

	
	public function addinprogress($post)
	{

		$this->db->insert('tbl_tickets', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	/* Delete deposit detail */
	function deleteinprogress($tickets_id)
	{
		$this->db->delete('tbl_tickets', array('tickets_id' => $tickets_id));		
		return 1;		
	}

	/* Get Edit deposit */
	public function editinprogress($tickets_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_tickets');
		$this->db->where('tickets_id', $tickets_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	/* Update Company Details */
	public function updatinprogress($post,$tickets_id)
	{
		$this->db->where('tickets_id',$tickets_id);
		$this->db->update('tbl_tickets', $post);
		return true;
	}

// ############# Inprogress setting End ###############

// ############# Closed setting start ###############

    public function getAllclosed()
	{
		$this->db->select('a.*,b.user_full_name,c.deptname');
		$this->db->from('tbl_tickets a');
		$this->db->join('tbl_user b', 'b.user_id = a.reporter');
		$this->db->join('tbl_departments c', 'c.departments_id = a.departments_id');
		$this->db->where('a.type','Closed');
		$this->db->where('a.status','closed');		
		$query = $this->db->get();
		return $query->result() ;
	}

	
	public function addclosed($post)
	{

		$this->db->insert('tbl_tickets', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	/* Delete deposit detail */
	function deleteclosed($tickets_id)
	{
		$this->db->delete('tbl_tickets', array('tickets_id' => $tickets_id));		
		return 1;		
	}

	/* Get Edit deposit */
	public function editclosed($tickets_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_tickets');
		$this->db->where('tickets_id', $tickets_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	/* Update Company Details */
	public function updatclosed($post,$tickets_id)
	{
		$this->db->where('tickets_id',$tickets_id);
		$this->db->update('tbl_tickets', $post);
		return true;
	}
// ############# Closed setting End ###############

// ############# All Tickets setting Start ###############	
	public function getAlltickets()
	{
		$this->db->select('a.*,b.user_full_name,c.deptname');
		$this->db->from('tbl_tickets a');
		$this->db->join('tbl_user b', 'b.user_id = a.reporter');
		$this->db->join('tbl_departments c', 'c.departments_id = a.departments_id');			
		$query = $this->db->get();
		return $query->result() ;
	}

	
	public function addalltickets($post)
	{

		$this->db->insert('tbl_tickets', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	/* Delete deposit detail */
	function deletealltickets($tickets_id)
	{
		$this->db->delete('tbl_tickets', array('tickets_id' => $tickets_id));		
		return 1;		
	}

	/* Get Edit deposit */
	public function editalltickets($tickets_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_tickets');
		$this->db->where('tickets_id', $tickets_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	/* Update Company Details */
	public function updatealltickets($post,$tickets_id)
	{
		$this->db->where('tickets_id',$tickets_id);
		$this->db->update('tbl_tickets', $post);
		return true;
	}
	public function changealltickets($status,$tickets_id)
	{
		$data['status'] = $status;
		$this->db->where('tickets_id', $tickets_id);
		$this->db->update('tbl_tickets', $data);
		return true;
	}
	  public function getALLstatus()
	{
		$this->db->select('*');
		$this->db->from('tbl_tickets');		
		$query = $this->db->get();
		return $query->result() ;
	}
// ############# All Tickets setting End ###############

}
?>
