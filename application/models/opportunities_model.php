<?php

class Opportunities_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	}
	
	/*	Show all opportunities  */
	public function getAllOpportunities()
	{
	    $this->db->select('a.* ,c.*, b.opportunities_state,b.opportunities_state_reason,b.opportunities_state_reason_id as opp_state_reson_id');
		$this->db->from('tbl_opportunities a');
		$this->db->join('tbl_leads c','c.lead_id = a.opportunities_id', 'inner');
		$this->db->join('tbl_opportunities_state_reason b','b.opportunities_state_reason_id = a.opportunities_state_reason_id', 'left');
	    $this->db->where('current_status !=' , '3');
		$this->db->order_by('a.lead_id', 'DESC');
		$query = $this->db->get();
		return $query->result() ;
	}
	public function getAllOpportunitiesUserlogin($user_id)
	{
	    $this->db->select('a.* ,c.*, b.opportunities_state,b.opportunities_state_reason,b.opportunities_state_reason_id as opp_state_reson_id,d.*');
		$this->db->from('tbl_opportunities a');
		$this->db->join('tbl_leads c','c.lead_id = a.opportunities_id', 'inner');
		$this->db->join('tbl_opportunities_state_reason b','b.opportunities_state_reason_id = a.opportunities_state_reason_id', 'left');
		$this->db->join('tbl_assign_user d','d.lead_id = a.opportunities_id', 'inner');
		$this->db->where('d.user_id' , $user_id);
        $this->db->where('current_status !=' , '3');
		$this->db->order_by('a.lead_id', 'DESC');
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

	/* Add New opportunities */	
	public function addOpportunities($op_post)
	{
		$this->db->insert('tbl_opportunities', $op_post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	
	
	/*	Get all State List  */
	public function getALLOpportunitiesStateList()
	{
		$this->db->select('*');
		$this->db->from('tbl_opportunities_state_reason');
		$this->db->where('opportunities_state_reason_status', '1');
		$query = $this->db->get();
		return $query->result() ;
	}
	
	/*	Get all State List by country list */
	public function getOpportunitiesStateById($op_state_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_opportunities_state_reason');
		$this->db->where('opportunities_state_reason_id', $op_state_id);
		$query = $this->db->get();
		return $query->result() ;
	}	

	/* Edit User details */	
	public function editOpportunities($leads_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_opportunities');
		$this->db->where('opportunities_id', $leads_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	/* Update User */
	public function updateOpportunities($post,$leads_id)
	{		
		
		$this->db->where('leads_id', $leads_id);
		$this->db->update('tbl_leads', $post);
		return true;
	}
	
	/* Delete User detail */
	function deleteOpportunities($leads_id)
	{
		$this->db->delete('tbl_leads', array('leads_id' => $leads_id));		
		return 1;		
	}

	/************** Opportunity Process Section Start *****************/

	/*	Get all opportunities Process */
	
	public function getAllOpportunitiesProcessList($opportunities_id)
	{
		$this->db->select('a.* , b.*');
		$this->db->from('tbl_opportunities_process a');
		$this->db->join('tbl_opportunities_process_details b', 'b.opportunities_process_id = a.opportunities_process_id');
		$this->db->where('a.opportunities_id', $opportunities_id );
		// $this->db->order_by('a.opportunities_process_id', 'DESC');
		$query = $this->db->get();
		// echo $this->db->last_query();die;
		return $query->result() ;
	}

	public function getProcessDtailsById($process_id)
	{
		$this->db->select('a.* , b.*');
		$this->db->from('tbl_opportunities_process a');
		$this->db->join('tbl_opportunities_process_details b', 'b.opportunities_process_id = a.opportunities_process_id');
		$this->db->where('opportunities_process_details_id' , $process_id);
		$query = $this->db->get();
		return $query->result() ;
	}

	public function getProductsDetailsById($process_id)
	{
		// $this->db->select('*');
		// $this->db->from('tbl_lead_product');
		// $this->db->where('opportunity_process_id', $process_id);
	
		$this->db->select('*');
		$this->db->from('tbl_opportunities_process_details a');
		$this->db->join('tbl_lead_product b', 'b.lead_process_id = a.opportunities_process_id');
		$this->db->where('opportunities_process_details_id' , $process_id);
		$query = $this->db->get();
		
		return $query->result() ;
	}

	public function addOpportunitiesProcess($post)
	{
		$this->db->insert('tbl_opportunities_process', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	public function addOpportunitiesProcessDetails($post)
	{
		$this->db->insert('tbl_opportunities_process_details', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	public function addOpportunitiesProductFileImg($post)
	{
		$this->db->insert('tbl_opportunities_product_files', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}
	public function addOpportunitiesProducts($post)
	{
		$this->db->insert('tbl_opportunities_products', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	public function UpdateOpportunityClientStatus($leads_id,$post)
	{
		$this->db->where('leads_id', $leads_id);
		$this->db->update('tbl_leads', $post);
		return true;
	}

	public function getAllSampleRequests()
	{	
		// $this->db->select('*');
		// $this->db->from('tbl_sample_request a');
		//  $this->db->join('tbl_opportunities_process_details b','b.opportunities_process_details_id = a.proccess_id','inner');
	    // // $this->db->where('a.id',$id);		
		// $query = $this->db->get();		
		// return $query->result() ;

		$this->db->select('a.*,b.*,c.*');
		$this->db->from('tbl_sample_request a');		
		$this->db->join('tbl_opportunities_process_details b', 'b.opportunities_process_details_id = a.proccess_id','inner');
		
		// $this->db->where('a.sample_request_status !=','NULL');
		// if($id != '')
		// {
		// 	$this->db->where('id',$id);
		// }
		$this->db->order_by('a.id');
		$query = $this->db->get();		
		return $query->result() ;
	}
	public function getAllSampleRequestsBYUserId($user_id)
	{	


		$this->db->select('a.*,b.*,c.*');
		$this->db->from('tbl_sample_request a');		
		$this->db->join('tbl_opportunities_process_details b', 'b.opportunities_process_details_id = a.proccess_id','inner');
		$this->db->join('tbl_assign_user c','c.lead_id = a.lead_id', 'inner');
		$this->db->where('c.user_id' , $user_id);
        $this->db->order_by('a.id');
		$query = $this->db->get();		
		return $query->result() ;
	}

	public function getSampleRequestsById($id)
	{		
		$this->db->select('*');
		$this->db->from('tbl_opportunities_products a');	
		$this->db->where('opportunities_products_id',$id);
		$query = $this->db->get();
		return $query->row() ;
	}

	public function changeApproveStatus($post,$id)
	{
		$this->db->where('opportunities_products_id', $id);
		$this->db->update('tbl_opportunities_products', $post);
		return true;
	}
}
?>
