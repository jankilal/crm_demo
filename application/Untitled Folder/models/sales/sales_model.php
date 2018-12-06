<?php

class Sales_model extends CI_Model 
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
// ############# deposit Settings Start ###############

	public function getAllrecurringinvoice()
	{
		$this->db->select('a.*,b.user_full_name');
		$this->db->from('tbl_invoices a');
		$this->db->join('tbl_user b', 'b.user_id = a.client_id');
		// $this->db->where('a.type','Answerd');	
		$query = $this->db->get();
		return $query->result() ;
	}
	
	
	public function addrecurringinvoice($post)
	{

		$this->db->insert('tbl_invoices', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	/* Delete deposit detail */
	function deleterecurringinvoice($invoices_id)
	{
		$this->db->delete('tbl_invoices', array('invoices_id' => $invoices_id));		
		return 1;		
	}

	/* Get Edit deposit */
	public function editrecurringinvoice($invoices_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_invoices');
		$this->db->where('invoices_id', $invoices_id);
		$query = $this->db->get();
		return $query->result();
	}

	/* Update Company Details */
	public function updaterecurringinvoice($post,$invoices_id)
	{
		$this->db->where('invoices_id',$invoices_id);
		$this->db->update('tbl_invoices', $post);
		return true;
	}
	
	
    public function getALLUser()
	{
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('user_role_id !=','1');		
		$query = $this->db->get();
		return $query->result() ;
	}
	public function addticketsPermission($post)
	{
		$this->db->insert('tbl_others_permission', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}


// ############# Answerd Settings End ###############


// ############# Estimates Settings start ###############	

	public function getAllestimates()
	{
		$this->db->select('a.*,b.user_full_name');
		$this->db->from('tbl_estimates a');
		$this->db->join('tbl_user b', 'b.user_id = a.client_id');
		// $this->db->where('a.type','Answerd');	
		$query = $this->db->get();
		return $query->result() ;
	}
	
	
	public function addestimates($post)
	{

		$this->db->insert('tbl_estimates', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	/* Delete deposit detail */
	function deleteestimates($estimates_id)
	{
		$this->db->delete('tbl_estimates', array('estimates_id' => $estimates_id));		
		return 1;		
	}

	/* Get Edit deposit */
	public function editestimates($estimates_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_estimates');
		$this->db->where('estimates_id', $estimates_id);
		$query = $this->db->get();
		return $query->result();
	}

	/* Update Company Details */
	public function updateestimates($post,$estimates_id)
	{
		$this->db->where('estimates_id',$estimates_id);
		$this->db->update('tbl_estimates', $post);
		return true;
	}

// ############# Estimates setting End ###############

// ############# Taxrate setting Start ###############

	public function getAlltaxrates()
	{
		$this->db->select('*');
		$this->db->from('tbl_tax_rates');
		$query = $this->db->get();
		return $query->result() ;
	}
	
	
	public function addtaxrates($post)
	{

		$this->db->insert('tbl_tax_rates', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	/* Delete deposit detail */
	function deletetaxrates($tax_rates_id)
	{
		$this->db->delete('tbl_tax_rates', array('tax_rates_id' => $tax_rates_id));		
		return 1;		
	}

	/* Get Edit deposit */
	public function edittaxrates($tax_rates_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_tax_rates');
		$this->db->where('tax_rates_id', $tax_rates_id);
		$query = $this->db->get();
		return $query->result();
	}

	/* Update Company Details */
	public function updatetaxrates($post,$tax_rates_id)
	{
		$this->db->where('tax_rates_id',$tax_rates_id);
		$this->db->update('tbl_tax_rates', $post);
		return true;
	}


// ############# Taxrate setting End ###############	

}
?>
