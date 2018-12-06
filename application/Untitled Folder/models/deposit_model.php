<?php

class Deposit_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}
	
	/*	Show all deposit  */
	public function getAlldeposit()
	{
		$this->db->select('a.* , b.country_name,c.state_name');
		$this->db->from('tbl_user a');
		$this->db->join('tbl_country b', 'b.country_id = a.user_country_id');
		 $this->db->join('tbl_state c', 'c.state_id = a.user_state_id');
		$this->db->where('user_role_id', '3');
		$this->db->where('user_type', 'deposit');
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

	

	/* Add New deposit */	
	public function adddeposit($post)
	{
		$this->db->insert('tbl_user', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	
	
	/*	Get all Country List  */
	public function getCountryList()
	{
		$this->db->select('*');
		$this->db->from('tbl_country');
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

	/* Edit User details */	
	public function editdeposit($deposit_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('user_id', $deposit_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	/* Update User */
	public function updatedeposit($post)
	{		
		
		$data['user_full_name'] = $post['user_full_name'];
		$data['user_email'] = $post['user_email'];
		$data['user_phone'] = $post['user_phone'];
		$data['user_status'] = $post['user_status'];
		$data['user_country_id'] = $post['user_country_id'];
		$data['user_state_id'] = $post['user_state_id'];
		$data['user_city'] = $post['user_city'];
		$data['user_address'] = $post['user_address'];
		
		$data['user_currency_type'] = $post['user_currency_type'];
		$data['user_short_note'] = $post['user_short_note']; 
		$data['user_fax'] = $post['user_fax']; 
		$data['user_website'] = $post['user_website'];
		$data['user_skype_id'] = $post['user_skype_id'];
		$data['user_facebook_url']=$post['user_facebook_url'];
		$data['user_twitter_id']=$post['user_twitter_id'];
		$data['user_linkedin_url']=$post['user_linkedin_url'];	

		$data['user_zip_code'] = $post['user_zip_code'];
		$data['user_update_date'] = $post['user_update_date'];
		
		if(isset($post['user_profile_img']) && $post['user_profile_img'] != '')
		{
			$data['user_profile_img'] = $post['user_profile_img'];  
		}
		
		$this->db->where('user_id', $post['user_id']);
		$this->db->update('tbl_user', $data);
		return true;
	}
	
	/* Delete User detail */
	function deletedeposit($deposit_id)
	{
		$this->db->delete('tbl_user', array('user_id' => $deposit_id));		
		return 1;		
	}
}
?>
