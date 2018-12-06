<?php

class Client_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}
	
	/*	Show all client  */
	public function getAllclient()
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
     	public function getAllclientByUserID($user_id)
	{

		
		$this->db->select('a.* ,c.*, b.opportunities_state,b.opportunities_state_reason,b.opportunities_state_reason_id as opp_state_reson_id,d.*');
		$this->db->from('tbl_opportunities a');
		$this->db->join('tbl_leads c','c.lead_id = a.opportunities_id', 'inner');
		$this->db->join('tbl_opportunities_state_reason b','b.opportunities_state_reason_id = a.opportunities_state_reason_id', 'left');
	    $this->db->join('tbl_assign_user d','d.lead_id = a.opportunities_id', 'inner');
		$this->db->where('d.user_id' , $user_id);
		$this->db->where('c.current_status', '3');
		$this->db->order_by('a.lead_id', 'DESC');
		$query = $this->db->get();
		return $query->result() ;

	
	}

	/*	Show all client  */
	public function getAllclientByRole($user_id)
	{
		$this->db->select('a.* , b.country_name,c.state_name');
		$this->db->from('tbl_user a');
		$this->db->join('tbl_country b', 'b.country_id = a.user_country_id');
		$this->db->join('tbl_state c', 'c.state_id = a.user_state_id');
		$this->db->where('a.user_role_id', '3');
		$this->db->where('a.user_type', 'Client');
		$this->db->where('a.added_by', $user_id);
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

	

	/* Add New client */	
	public function addclient($post)
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
		$this->db->where('country_id', '99');		
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
	public function editClient($client_id)
	{
		// $this->db->select('*');
		// $this->db->from('tbl_leads');
		// $this->db->where('lead_id', $client_id);
		// $query = $this->db->get();
		// return $query->result();
		$this->db->select('*');
		$this->db->from('tbl_opportunities');
		$this->db->where('opportunities_id', $client_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	/* Update User */
	public function updateClient($post,$user_id)
	{		
		
		// $data['user_full_name'] = $post['user_full_name'];
		// $data['user_email'] = $post['user_email'];
		// $data['user_phone'] = $post['user_phone'];
		// $data['user_status'] = $post['user_status'];
		// $data['user_country_id'] = $post['user_country_id'];
		// $data['user_state_id'] = $post['user_state_id'];
		// $data['user_city'] = $post['user_city'];
		// $data['user_address'] = $post['user_address'];
		
		// $data['user_currency_type'] = $post['user_currency_type'];
		// $data['user_short_note'] = $post['user_short_note']; 
		// $data['user_fax'] = $post['user_fax']; 
		// $data['user_website'] = $post['user_website'];
		// $data['user_skype_id'] = $post['user_skype_id'];
		// $data['user_facebook_url']=$post['user_facebook_url'];
		// $data['user_twitter_id']=$post['user_twitter_id'];
		// $data['user_linkedin_url']=$post['user_linkedin_url'];	

		// $data['user_zip_code'] = $post['user_zip_code'];
		// $data['user_update_date'] = $post['user_update_date'];
		
		// if(isset($post['user_profile_img']) && $post['user_profile_img'] != '')
		// {
		// 	$data['user_profile_img'] = $post['user_profile_img'];  
		// }
		
		$this->db->where('leads_id', $leads_id);
		$this->db->update('tbl_leads', $post);
		return true;
	}

	// public function getAllClientProcessList($client_id)
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('tbl_client_process a');
	// 	$this->db->join('tbl_client_process_details b',  'a.id  = b.id');
	// 	$this->db->where('a.client_id', $client_id);
	// 	$query = $this->db->get();
	// 	return $query->result();
	// }

	public function getProcessDtailsById($process_id)
	{
		

		// $this->db->select('*');
		// $this->db->from('tbl_client_process_details');
		// $this->db->where('client_id', $client_id);
		// $query = $this->db->get();
		// return $query->result();
		// // $this->db->select('a.* , b.*');
		// // $this->db->from('tbl_client_process a');
		// // $this->db->join('tbl_client_process_details b', 'b.id = a.id');
		// // $this->db->where('client_process_details_id' , $process_id);
		// // $query = $this->db->get();
		// // return $query->result() ;
	}

	public function getProductsDetailsById($op_process_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_lead_product');
		$this->db->where('lead_process_id', $op_process_id);
		$query = $this->db->get();
		return $query->result();
	}

	/* Delete User detail */
	function deleteClient($client_id)
	{
		$this->db->delete('tbl_leads', array('leads_id' => $client_id));		
		return 1;		
	}
}
?>
