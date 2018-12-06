<?php

class Expense_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	}

	
	/*	Show all Expense  */
	public function getAllExpense()
	{
		$this->db->select('a.*,b.expense_category');
		$this->db->from('tbl_expenses a');
		$this->db->join('tbl_expense_category b', 'b.expense_category_id = a.expenses_category_id');
		$query = $this->db->get();
		return $query->result() ;
	}
	
	/* Add New Expense */	
	public function addexpense($post)
	{
		$this->db->insert('tbl_expenses', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	
	/* Add New Expense */	
	public function addExpensePermission($post)
	{
		$this->db->insert('tbl_others_permission', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}


	/* ******** Company List ***********/
	public function getALLexpensecategory()
	{
		$this->db->select('*');
		$this->db->from('tbl_expense_category');
		$this->db->where('expense_category_status' , 1);	
		$query = $this->db->get();
		return $query->result() ;
	}
	
	/* Edit User details */	
	public function editExpense($expenses_id)
	{
		$this->db->select('*');
		$this->db->from(' tbl_expenses');
		$this->db->where('expenses_id', $expenses_id);
		$query = $this->db->get();
		return $query->result();
	}

	
	/* Update User */
	public function updateExpense($post,$expenses_id)
	{
		$this->db->where('expenses_id', $expenses_id);
		$this->db->update('tbl_expenses', $post);
		return true;
	}
	
	/* Delete User detail */
	function deleteExpense($expenses_id)
	{
		$this->db->delete('tbl_expenses', array('expenses_id' => $expenses_id));		
		return 1;		
	}

	

}
?>
