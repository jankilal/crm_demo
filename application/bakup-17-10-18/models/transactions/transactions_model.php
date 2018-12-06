<?php

class Transactions_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
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
	public function addticketsPermission($post)
	{
		$this->db->insert('tbl_others_permission', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}
// ############# deposit Settings Start ###############

	public function getAlldeposit()
	{
		$this->db->select('a.*,b.account_name,c.income_category,d.user_full_name,user_type,e.method_name');
		$this->db->from('tbl_transactions a');
		$this->db->join('tbl_accounts b', 'b.account_id = a.account_id');
		$this->db->join('tbl_income_category c', 'c.income_category_id = a.category_id');
		$this->db->join('tbl_user d', 'd.user_id = a.paid_by');
		$this->db->join('tbl_payment_methods e', 'e.payment_methods_id = a.payment_methods_id');
		$this->db->where('a.type','Income');
		$query = $this->db->get();
		return $query->result() ;
	}
		
	public function addeposit($post)
	{

		$this->db->insert('tbl_transactions', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	/* Delete deposit detail */
	function deletedeposit($transactions_id)
	{
		$this->db->delete('tbl_transactions', array('transactions_id' => $transactions_id));		
		return 1;		
	}

	/* Get Edit deposit */
	public function editdeposit($transactions_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_transactions');
		$this->db->where('transactions_id', $transactions_id);
		$query = $this->db->get();
		return $query->result();
	}
	public function addTransactonFile($post)
	{
		$this->db->insert('tbl_transactions_attachment', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	/* Update Company Details */
	public function updatedeposit($post,$transactions_id)
	{
		$this->db->where('transactions_id',$transactions_id);
		$this->db->update('tbl_transactions', $post);
		return true;
	}
	public function getAccountBalanceById($account_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_accounts');
		$this->db->where('account_id', $account_id);
		$query = $this->db->get();
		return $query->result();
	}
	public function updateBalanceById($account_id,$total_bal)
    {
		$data['total_balance'] = $total_bal;
		$this->db->where('account_id', $account_id);
		$this->db->update('tbl_accounts', $data);
		return true;
    }
	public function getALLAccountDetails()
	{
		$this->db->select('*');
		$this->db->from(' tbl_accounts');		
		$query = $this->db->get();
		return $query->result() ;
	}
	public function getALLCategory()
	{
		$this->db->select('*');
		$this->db->from(' tbl_income_category');		
		$query = $this->db->get();
		return $query->result() ;
	}

    public function getALLUser()
	{
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('user_role_id !=','1');		
		$query = $this->db->get();
		return $query->result() ;
	}
	public function getPaymentMethode()
	{
		$this->db->select('*');
		$this->db->from(' tbl_payment_methods');		
		$query = $this->db->get();
		return $query->result() ;
	}

// ############# Expenses Settings Start ###############
	
	public function getAllexpenses()
	{
		$this->db->select('a.*,b.account_name,c.income_category,d.user_full_name,e.method_name');
		$this->db->from('tbl_transactions a');
		$this->db->join('tbl_accounts b', 'b.account_id = a.account_id');
		$this->db->join('tbl_income_category c', 'c.income_category_id = a.category_id');
		$this->db->join('tbl_user d', 'd.user_id = a.paid_by');
		$this->db->join('tbl_payment_methods e', 'e.payment_methods_id = a.payment_methods_id');
		$this->db->where('a.type','Expenses');
		$query = $this->db->get();
		return $query->result() ;
	}
	
	
		
	public function addexpenses($post)
	{

		$this->db->insert('tbl_transactions', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	/* Delete Expenses detail */
	function deleteexpenses($transactions_id)
	{
		$this->db->delete('tbl_transactions', array('transactions_id' => $transactions_id));		
		return 1;		
	}

	/* Get Edit Expenses */
	public function editexpenses($transactions_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_transactions');
		$this->db->where('transactions_id', $transactions_id);
		$query = $this->db->get();
		return $query->result();
	}

	/* Update Expenses Details */
	public function updateexpenses($post,$transactions_id)
	{
		$this->db->where('transactions_id',$transactions_id);
		$this->db->update('tbl_transactions', $post);
		return true;
	}
// ############# transfer Settings Start ###############

	
	public function getAlltransfer()
	{
		$this->db->select('a.*,b.account_name as from_account_name,f.account_name as to_account_name,e.method_name');
		$this->db->from('tbl_transfer a');
		$this->db->join('tbl_accounts b', 'b.account_id = a.to_account_id','inner');
		$this->db->join('tbl_accounts f', 'f.account_id = a.from_account_id','inner');	 
	 	
	 	$this->db->join('tbl_payment_methods e', 'e.payment_methods_id = a.payment_methods_id');
		$query = $this->db->get();
		return $query->result() ;
	}
		
	public function addtransfer($post)
	{
		$this->db->insert('tbl_transfer', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	/* Delete Transfer detail */
	function deletetransfer($transfer_id)
	{
		$this->db->delete('tbl_transfer', array('transfer_id' => $transfer_id));		
		return 1;		
	}

	/* Get Edit Transfer */
	public function edittransfer($transfer_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_transfer');
		$this->db->where('transfer_id', $transfer_id);
		$query = $this->db->get();
		return $query->result();
	}

	/* Update transfer Details */
	public function updatetransfer($post,$transfer_id)
	{
		$this->db->where('transfer_id',$transfer_id);
		$this->db->update('tbl_transfer', $post);
		return true;
	}
	public function getALLToAccountDetails($from_account_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_accounts');		
		$this->db->where('account_id !=', $from_account_id);
		$query = $this->db->get();
		//echo $this->db->last_query();die; 
		return $query->result() ;
	}

	
	public function updateAccounFormById($from_account_id,$total_bal)
    {
		$data['total_balance'] = $total_bal;
		$this->db->where('from_account_id', $from_account_id);
		$this->db->update('tbl_transfer', $data);
		return true;
    }
    public function updateAccountToById($to_account_id,$total_bal)
    {
		$data['total_balance'] = $total_bal;
		$this->db->where('to_account_id', $to_account_id);
		$this->db->update('tbl_transfer', $data);
		return true;
    }
// ############# transfer Settings End ###############	 

// ############# transactionReport start ###############	

	public function getAlltransactionsreport()
	{
		$this->db->select('a.*,b.account_name');
		$this->db->from('tbl_transactions a');
		$this->db->join('tbl_accounts b', 'b.account_id = a.account_id');
		$query = $this->db->get();
		return $query->result() ;
	}

		
	public function addtransactionsreport($post)
	{

		$this->db->insert('tbl_transactions', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	/* Delete TransactionsReports detail */
	function deletetransactionsreport($transactions_id)
	{
		$this->db->delete('tbl_transactions', array('transactions_id' => $transactions_id));		
		return 1;		
	}

	/* Get Edit TransactionsReports */
	public function edittransactionsreport($transactions_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_transactions');
		$this->db->where('transactions_id', $transactions_id);
		$query = $this->db->get();
		return $query->result();
	}

	/* Update TransactionsReports Details */
	public function updatetransactionsreport($post,$transactions_id)
	{
		$this->db->where('transactions_id',$transactions_id);
		$this->db->update('tbl_transactions', $post);
		return true;
	}
  // ############# transactions Reports End ###############

 // ############# Balance Sheet start ###############

    public function getAllblancesheet()
	{
		$this->db->select('*');
		$this->db->from(' tbl_accounts');	
		$query = $this->db->get();
		return $query->result() ;
	}

	public function getAlltransferreport()
	{
		$this->db->select('a.*,b.account_name as from_account_name,f.account_name as to_account_name');
		$this->db->from('tbl_transfer a');
		$this->db->join('tbl_accounts b', 'b.account_id = a.to_account_id','inner');
		$this->db->join('tbl_accounts f', 'f.account_id = a.from_account_id','inner');	
		$query = $this->db->get();
		return $query->result() ;
	}

// ############# Balance Sheet End ###############


}
?>
