<?php

class Login_model extends CI_Model {

	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}

	/*	Get all Country List  */
	public function getCountryList()
	{
		$this->db->select('*');
		$this->db->from('tbl_country');
		$this->db->where('country_id', '223');
		$this->db->or_where('country_id', '38');
		$this->db->where('country_status', '1');
		$query = $this->db->get();
		return $query->result() ;
	}

	/*	Get all State List  */
	public function getStateList()
	{
		$this->db->select('*');
		$this->db->from('tbl_state');
		$this->db->where('state_status', '1');
		$query = $this->db->get();
		return $query->result() ;
	}

	/* Edit details */	
	public function checkUserEmailId($email_id,$old_email)
	{
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('user_email', $email_id);
		$this->db->where('user_email !=', $old_email);
		$query = $this->db->get();
		return $query->num_rows();
	}

	/*	Get all State List by country list */
	public function getStateListByCountryId($country_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_state');
		$this->db->where('state_status', '1');
		$this->db->where('country_id', $country_id);
		$query = $this->db->get();
		return $query->result() ;
	}	

	function checkUserLogin($data)
	{
		$user_email = $data['user_email'];		
		$user_password = $data['password'];		
        $this->db->select('*');
		$this->db->from('tbl_user');	
		$this->db->where('user_email',$user_email);
		$this->db->where('user_password',$user_password);
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		return $query->row(); ;
	}	

	/*	get User details for update profile  */
	function getUserDetails($user_id)
	{	
        $this->db->select('*');
		$this->db->from('tbl_user');	
		$this->db->where('user_id',$user_id);
		$this->db->where('user_status','1');
		$query = $this->db->get();		
		return $query->result(); 
	}	

	/*	Block User */
	function blockUser($post)
	{
        $data = array(
			'admin_active_status'=>$post['admin_active_status'],
			'admin_modify_date'=>$post['admin_modify_date'],	
		);		
		$this->db->where('admin_email', $post['admin_email']);
		$this->db->update('admin', $data); 		
		return true; 
	}
	
	/* Get User Details */
	function getUserProfileDetails($admin_id)
	{
		$this->db->select('*');
		$this->db->from('admin');	
		$this->db->where('admin_id',$admin_id);
		$this->db->where('admin_active_status','1');
		$query = $this->db->get();		
		$result=$query->result();
		return $result ;
	}	
	
	/*	update User Password	*/
	function updateUserPassword($post)
	{
		$data['admin_password'] = $post['new_password'];
		$this->db->where('admin_id', $post['admin_id']);
		$this->db->update('admin', $data); 		
		return true; 		
	}
	
	/* Check mail for forgot password */
	function CheckEmail($email)
	{
		$this->db->select('*');
		$this->db->from('admin');	
		$this->db->where('admin_email',$email);
		$this->db->where('admin_active_inactive','1');
		$query = $this->db->get();		
		$result=$query->result();
		return $result ;
	}
	
	/*	Reset User Password	*/
	function reset_password($post)
	{
		$data['admin_password'] = $post['password'];
		$this->db->where('admin_email', $post['email']);
		$this->db->where('admin_active_inactive','1');
		$this->db->update('admin', $data); 		
		return true; 		
	}

	function updateAdminProfile($post,$user_id)
	{	
		$this->db->where('user_id', $user_id);
		$this->db->update('tbl_user', $post); 		
		return true; 		
	}

}
?>