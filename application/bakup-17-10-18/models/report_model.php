<?php
class Report_model extends CI_Model {
	
	public function getDayWiseReport()
	{
		$this->db->select('a.* ,c.*, b.opportunities_state,b.opportunities_state_reason,b.opportunities_state_reason_id as opp_state_reson_id');
		$this->db->from('tbl_opportunities a');
		$this->db->join('tbl_leads c','c.lead_id = a.opportunities_id', 'inner');
		$this->db->join('tbl_opportunities_state_reason b','b.opportunities_state_reason_id = a.opportunities_state_reason_id', 'left');
		$this->db->where('c.current_status', '3');
		$this->db->order_by('a.lead_id', 'DESC');
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

