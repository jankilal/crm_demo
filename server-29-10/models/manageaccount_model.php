<?php

class manageAccount_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	}

	
	/*	Show all bankcash  */

	public function addticketsPermission($post)
	{
		$this->db->insert('tbl_others_permission', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}
	public function getAllBankCash()
	{
		$this->db->select('*');
		$this->db->from('tbl_accounts');		
		$query = $this->db->get();
		return $query->result() ;
	}
	
	/* Add New Bankcash */	
	public function addBankCash($post)
	{
		$this->db->insert('tbl_accounts', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	
	/* Add New BankCash */	
	public function addBankCashPermission($post)
	{
		$this->db->insert('tbl_others_permission', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}


	/* ******** Company List ***********/
	public function getALLBankCashcategory()
	{
		$this->db->select('*');
		$this->db->from('tbl_accounts');		
		$query = $this->db->get();
		return $query->result() ;
	}
	
	/* Edit User details */	
	public function editBankCash($account_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_accounts');
		$this->db->where('account_id', $account_id);
		$query = $this->db->get();
		return $query->result();
	}

	
	/* Update User */
	public function updateBankCash($post,$account_id)
	{
		$this->db->where('account_id', $account_id);
		$this->db->update('tbl_accounts', $post);
		return true;
	}
	
	/* Delete User detail */
	function deletebankcash($account_id)
	{
		$this->db->delete('tbl_accounts', array('account_id' => $account_id));		
		return 1;		
	}
	public function getALLUser()
	{
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('user_role_id !=','1');		
		$query = $this->db->get();
		return $query->result() ;
	}

	

}
?>
