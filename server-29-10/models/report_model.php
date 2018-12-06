<?php
class Report_model extends CI_Model {
	
	public function getDayWiseReport()
	{
		$this->db->select('a.* , b.user_full_name,b.user_email,b.user_phone');
		$this->db->from('tbl_attendance a');
		$this->db->join('tbl_user b', 'a.user_id = b.user_id', 'inner');
		if(isset($_GET['by_employee']) && $_GET['by_employee'])
			$this->db->where('a.user_id', $_GET['by_employee']);
		
		if(isset($_GET['by_date']) && $_GET['by_date'])
			$this->db->where('a.attendance_date', $_GET['by_date']);
		
		$query = $this->db->get();
		return $query->row() ;
	}

	public function getDayWiseExpenses()
	{
		$this->db->select('sum(expenses_amt) as total_expenses');
		$this->db->from('tbl_expenses');
		if(isset($_GET['by_employee']) && $_GET['by_employee'])
			$this->db->where('user_id', $_GET['by_employee']);
		if(isset($_GET['by_date']) && $_GET['by_date'])
			$this->db->where('expenses_date', $_GET['by_date']);
		$query = $this->db->get();
		return $query->row() ;
	}

	public function getDayWiseMeeting($action = 'all' )
	{
		$this->db->select('*');
		$this->db->from('tbl_lead_meeting');
		if(isset($_GET['by_employee']) && $_GET['by_employee'])
			$this->db->where('create_by', $_GET['by_employee']);
		if(isset($_GET['by_date']) && $_GET['by_date'])
			$this->db->where('lm_date', $_GET['by_date']);
		if($action == 'Pending')
			$this->db->where("(lm_start_time = '' OR lm_start_time IS NULL)");
		elseif ($action == 'Done') 
			$this->db->where("(lm_end_time = '' OR lm_end_time IS NOT NULL)");

		$query = $this->db->get();
		return $query->result() ;
	}

	public function getEmpMeetingByDate($user_id , $date , $action = '')
	{
		$this->db->select('a.*');
		$this->db->from('tbl_lead_meeting a');
		$this->db->join('tbl_assign_user b', 'a.lead_id = b.lead_id', 'inner');
		$this->db->where('a.lm_date', $date);
		$this->db->where('b.user_id', $user_id);
		$this->db->order_by('a.lead_id', 'DESC');
		$query = $this->db->get();
		if($action == 'count')
		return $query->num_rows();
		else
		return $query->result();
	}	
}

