<?php
class Attendance_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	   //$this->load->database();
	}

	/* Add New */	
	public function addAttendance($post)
	{
		$this->db->insert('tbl_attendance', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	/* Update details */
	public function updateAttendance($post)
	{	
		$data['attendance_logout_time'] = $post['attendance_logout_time'];
		$data['attendance_logout_lat'] = $post['attendance_logout_lat'];
		$data['attendance_date'] = $post['attendance_date'];
		$data['attendance_status'] = $post['attendance_status'];
		$data['attendance_update_date'] = $post['attendance_update_date'];	
		$data['user_id'] = $post['user_id'];		
		$data['user_all_levels'] = $post['user_all_levels'];		
		$this->db->where('attendance_id', $post['attendance_id']);
		$this->db->update('tbl_attendance', $data);
		return true;
	}
}
?>
