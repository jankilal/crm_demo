<?php

class Attendance_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}

	/*	Show all */
	public function getAttendance($offset, $user_id, $attendance_flag_date_time)
	{
		$this->db->select('*');
		$this->db->from('tbl_attendance');
		if($attendance_flag_date_time != '0')
		{
			$this->db->where('attendance_action_status', '0');
		}
		$this->db->limit(50, $offset);
		$query = $this->db->get();
		return $query->result() ;
	}

	/*	Check Data by UID */
	public function checkData($attendance_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_attendance');
		$this->db->where('attendance_id', $attendance_id);
		$query = $this->db->get();
		return $query->result() ;
	}


	/* Add New  */	
	public function addData($post)
	{
		$this->db->insert('tbl_attendance', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	

	/* Update */
	public function updateData($post)
	{
		$this->db->where('attendance_id', $post['attendance_id']);
		$this->db->update('tbl_attendance', $post);
		return true;
	}
}
?>
