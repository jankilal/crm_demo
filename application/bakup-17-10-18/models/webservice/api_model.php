<?php
class Api_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}
	

	public function addSocialUser($post)
	{
		$this->db->insert('tbl_user', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result;
	}
 	public function checkSocialUser($check)
 	{		
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('user_email', $check['user_email']);
		$this->db->or_where('user_phone', $check['user_phone']);
		$query = $this->db->get();
		return $query->result() ;
 	} 

 	public function loginUser($post)
 	{		
		$user_email_phone = $post['user_email_phone'];
		$this->db->select('a.*,b.state_name,c.customer_unic_id,c.customer_type_name');
		$this->db->from('tbl_user a');
		$this->db->join('state b','a.user_state_id = b.state_id','left');
		$this->db->join('tbl_customer_type c','a.customer_type_id = c.customer_type_id','left');
		$this->db->where("(a.user_email = '".$user_email_phone."' OR a.user_phone = '".$user_email_phone."')");
		$this->db->where('a.user_password', $post['user_password']);
		$this->db->where('a.user_status', '1');
		$this->db->where('a.user_status_type', 'Approved');
		$query = $this->db->get();		

		return $query->result() ;
 	} 

 	public function loginPosUser($post)
 	{		
		$user_email_phone = $post['user_email_phone'];
		$this->db->select('a.*,b.state_name');
		$this->db->from('tbl_user a');
		$this->db->join('state b','a.user_state = b.id','left');		
		$this->db->where("(a.user_email = '".$user_email_phone."' OR a.user_phone = '".$user_email_phone."')");
		$this->db->where('a.user_password', $post['user_password']);
		$this->db->where('a.user_status', '1');
		$query = $this->db->get();	
		return $query->result();
 	} 

 	public function showProfile($user_id)
 	{		
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('user_id', $user_id);
		$this->db->where('user_status', '1');
		$query = $this->db->get();
		return $query->result() ;
 	}

 	public function getLeadByUserId($user_id ,$sync_date_time = NULL)
 	{
 		$this->db->select('*');
 		$this->db->from('tbl_leads a');
 		$this->db->join('tbl_assign_user b', 'a.lead_id = b.lead_id', 'inner');
 		$this->db->where('b.user_id',  $user_id);
 		if($sync_date_time)
 		$this->db->where('a.sync_date_time >', $sync_date_time);
 		$query = $this->db->get();
 		return $query->result();
 	}

 	public function updateProfile($post)
 	{
 		$data['user_name'] = $post['user_name'];
		$data['user_phone'] = $post['user_phone'];
		$data['user_dob'] = $post['user_dob'];
		$data['user_address_1'] = $post['user_address_1'];
		$data['user_address_2'] = $post['user_address_2'];
		$data['user_city'] = $post['user_city'];
		$data['user_state_id'] = $post['user_state_id'];
		$data['user_country_id'] = $post['user_country_id'];
		$data['user_postal_code'] = $post['user_postal_code'];
		$data['user_updated_date'] = $post['user_updated_date'];
		$this->db->where('user_id', $post['user_id']);
		$this->db->update('tbl_user', $data);
		return true;
 	}
 	public function changePassword($post)
 	{
 		$data['user_password'] = $post['user_password'];
		$data['user_updated_date'] = $post['user_updated_date'];
		$this->db->where('user_id', $post['user_id']);
		$this->db->update('tbl_user', $data);
		return true;
 	}

 	public function updateloginStatus($post)
 	{
 		$data['user_log_status'] = $post['user_log_status'];
		$this->db->where('user_id', $post['user_id']);
		$this->db->update('tbl_user', $data);
		return true;
 	}

 	public function getLeadMeetingList($user_id , $sync_date_time = 0)
 	{
 		$this->db->select('c.*');
 		$this->db->from('tbl_assign_user a');
 		$this->db->join('tbl_lead_meeting c', 'a.lead_id = c.lead_id', 'inner');
 		if($sync_date_time)
 		$this->db->where('c.sync_date_time >', $sync_date_time);
 		
 		$this->db->where('a.user_id', $user_id);
 		$query = $this->db->get();
 		// echo $this->db->last_query();
 		return $query->result();
 	}


}
?>
