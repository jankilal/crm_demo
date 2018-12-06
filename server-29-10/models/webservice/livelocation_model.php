<?php

class Livelocation_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}

	/*	Show all */
	public function getLiveLocation($offset, $user_id, $location_flag_date_time)
	{
		$this->db->select('*');
		$this->db->from('tbl_live_location');
		$where = "FIND_IN_SET('".$user_id."', user_all_level)";
		if($location_flag_date_time != '0')
		{
			$this->db->where('location_action_status', '0');
		}
		$this->db->where($where);
		$this->db->limit(50, $offset);
		$query = $this->db->get();
		return $query->result() ;
	}

	/*	Check Data by UID */
	public function checkData($location_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_live_location');
		$this->db->where('location_id', $location_id);
		$query = $this->db->get();
		return $query->result() ;
	}


	/* Add New  */	
	public function addData($post)
	{
		$this->db->insert('tbl_live_location', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	

	/* Update */
	public function updateData($post)
	{
		$this->db->where('location_id', $post['location_id']);
		$this->db->update('tbl_live_location', $post);
		return true;
	}
}
?>
