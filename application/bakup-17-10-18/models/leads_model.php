<?php
class Leads_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	}

	var $column_order = array(null,'a.lead_name', 'a.organization',null,null,'b.lead_status','c.lead_source'); 
    //set column field database for datatable orderable
    var $column_search = array('a.lead_name', 'a.organization','a.industry','a.name','a.email','a.address','d.country_name','e.state_name','a.city','a.designation','a.mobile_number','a.phone_number','a.annual_revenue','a.create_date','b.lead_status','c.lead_source'); 
    //set column field database for datatable searchable 
    var $order = array('product_id' => 'ASC'); // default order 

	private function _get_query($param1 = NULL)
    {       
    	$sql = array();
    	$f_sql = '';
    	foreach ($this->column_search as $cmn) // loop column 
        {
	        if(isset($_POST["search"]["value"]) && $_POST["search"]["value"] != '')
			{
				$sql[] = '('.$cmn.' LIKE '. "'".$_POST["search"]["value"]."%'" . ' OR  '.$cmn.' LIKE ' . "'%".$_POST["search"]["value"]."%'".' OR '.$cmn.' LIKE ' . "'%".$_POST["search"]["value"]."'".')';
			}
		}
		$sql[] = 'a.current_status != 3';

		if(isset($_POST['order'])) // here order processing
		{
			$order_by = $this->column_order[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'];
		} 
		else
		{
			$order_by = 'lead_id ASC';
		}
		
		if(sizeof($sql) > 0)
		$f_sql = implode(' OR ', $sql);

		if(isset($_POST['show_leads_by']))
		{
			switch ($_POST['show_leads_by']) {
				case 'converted':
					$f_sql .= ($f_sql) ? " AND a.current_status = '2'" : "a.current_status = '2'";
					break;
				case 'assign':
					$f_sql .= ($f_sql) ? " AND a.lead_assign_status = '1'" : "a.lead_assign_status = '1'";
					break;
				case 'non-assign':
					$f_sql .= ($f_sql) ? " AND a.lead_assign_status = '0'" : "a.lead_assign_status = '0'";
					break;
				case 'today':
						$f_sql .= ($f_sql) ? " AND a.create_date = '".date('Y-m-d')."'" : "a.create_date = '".date('Y-m-d')."'";
						break;
				case 'my':
					if(login_role == 1){
						$f_sql .= ($f_sql) ? " AND a.create_by = '".login_user."'": "a.create_by = '".login_user."'";
					}
					break;
				default:
					break;
			}
		}

		if(login_role != 1){
			$f_sql .= ($f_sql) ? " AND a.create_by = '".login_user."'": "a.create_by = '".login_user."'";
		}


		if($param1 == 'show_list' && isset($_POST["length"]) && $_POST["length"] != -1)  
       	{  
            $limit = $_POST['length'];
            $offset = $_POST['start'];
            if($f_sql)
            {
				return "SELECT a.*, b.*, c.*,d.country_name,e.state_name FROM tbl_leads a LEFT JOIN tbl_lead_status b ON b.lead_status_id = a.lead_status_id LEFT JOIN tbl_lead_source c ON c.lead_source_id = a.lead_source_id LEFT JOIN tbl_country d ON d.country_id = a.country LEFT JOIN tbl_state e ON e.state_id = a.state WHERE $f_sql ORDER BY $order_by LIMIT $limit OFFSET $offset";
            }
            else
            {
				return "SELECT a.*, b.*, c.*,d.country_name,e.state_name FROM tbl_leads a LEFT JOIN tbl_lead_status b ON b.lead_status_id = a.lead_status_id LEFT JOIN tbl_lead_source c ON c.lead_source_id = a.lead_source_id LEFT JOIN tbl_country d ON d.country_id = a.country LEFT JOIN tbl_state e ON e.state_id = a.state ORDER BY $order_by LIMIT $limit OFFSET $offset";
            }
       	}  
       	else
       	{
			if($f_sql)
            {
				return "SELECT a.*, b.*, c.*,d.country_name,e.state_name FROM tbl_leads a LEFT JOIN tbl_lead_status b ON b.lead_status_id = a.lead_status_id LEFT JOIN tbl_lead_source c ON c.lead_source_id = a.lead_source_id LEFT JOIN tbl_country d ON d.country_id = a.country LEFT JOIN tbl_state e ON e.state_id = a.state WHERE $f_sql";
            }
            else
            {
				return "SELECT a.*, b.*, c.*,d.country_name,e.state_name FROM tbl_leads a LEFT JOIN tbl_lead_status b ON b.lead_status_id = a.lead_status_id LEFT JOIN tbl_lead_source c ON c.lead_source_id = a.lead_source_id LEFT JOIN tbl_country d ON d.country_id = a.country LEFT JOIN tbl_state e ON e.state_id = a.state";
            }
       	}
    }

    function count_filtered()
    {
       $query = $this->_get_query();
       return $result = $this->db->query($query)->num_rows();
    }

	public function getAllleads()
	{		
		$query = $this->_get_query('show_list');
       	return $result = $this->db->query($query)->result();
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
		$this->db->where('country_id', '99');
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

	/*	Show all leads  */
	public function getAllUsersList()
	{
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('user_status', '1');
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

	/* Add New leads */	
	public function addLeads($post)
	{
		$this->db->insert('tbl_leads', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	
	/* Add New leads */	
	public function addLeadsPermission($post)
	{
		$this->db->insert('tbl_others_permission', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}
	
	public function getMeetingByLead($lead_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_lead_meeting');
		$this->db->where('lead_id', $lead_id);
		$this->db->order_by('lm_date' , 'ASC');
		$this->db->order_by('lm_time' , 'ASC');
		$query = $this->db->get();
		return $query->result() ;
	}

	//Add Leads Contact Details
	public function addLeadsCotactDetails($post)
	{
		$this->db->insert('tbl_leads_contact', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	
	
	/*	Get all State List  */
	public function getALLleadsStatusList()
	{
		$this->db->select('*');
		$this->db->from('tbl_lead_status');
		$this->db->where('lead_status_status', '1');
		$query = $this->db->get();
		return $query->result() ;
	}

	/*	Get all State List  */
	public function getALLleadsSourceList()
	{
		$this->db->select('*');
		$this->db->from('tbl_lead_source');
		$this->db->where('lead_source_status', '1');
		$query = $this->db->get();
		return $query->result() ;
	}

	/* ******** Company List ***********/
	public function getClientList()
	{
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('user_role_id', '3');
		$this->db->where('user_type', 'Client');
		$query = $this->db->get();
		return $query->result() ;
	}
	
	/*	Get all State List by country list */
	public function getleadsStateById($op_state_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_leads_state_reason');
		$this->db->where('leads_state_reason_id', $op_state_id);
		$query = $this->db->get();
		return $query->result() ;
	}	

	/* Edit User details */	
	public function editleads($leads_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_leads');
		$this->db->where('leads_id', $leads_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	/* Update User */
	public function updateleads($post,$leads_id)
	{
		$this->db->where('lead_id', $leads_id);
		$this->db->update('tbl_leads', $post);
		return true;
	}
	/* Update status */
	public function changeLeadStatus($lead_status_id,$leads_id)
	{
		$data['lead_status_id'] = $lead_status_id;
		$this->db->where('leads_id', $leads_id);
		$this->db->update('tbl_leads', $data);
		return true;
	}
	
	/* Delete User detail */
	function deleteleads($leads_id)
	{
		$this->db->delete('tbl_leads', array('leads_id' => $leads_id));		
		return 1;		
	}
	function removeLeadProductsById($id)
	{
		$this->db->delete('tbl_items', array('item_id' => $id));		
		return 1;
	}
	// /********delete update psage item list*************/
	// function deleteleads($leads_id)
	// {
	// 	$this->db->delete('tbl_leads', array('leads_id' => $leads_id));		
	// 	return 1;		
	// }
	/************** leads Process Section Start *****************/
	public function UpdateLeadsOpportunityStatus($lead_id,$o_post)
	{
		$this->db->where('lead_id', $lead_id);
		$this->db->update('tbl_leads', $o_post);
		return true;
	}

	/*	Get all leads Process */
	public function getAllleadsProcessList($lead_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_leads_process a');
		$this->db->join('tbl_leads_process_details b',  'a.leads_process_id  = b.leads_process_id');
		$this->db->where('a.lead_id', $lead_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getAllAddMetting($lead_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_company_meeting');
		$this->db->where('company_id', $lead_id);
		$query = $this->db->get();
		return $query->result() ;
	}

	public function getAllOppoProcessList($leads_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_opportunities_process a');
		$this->db->join('tbl_opportunities_process_details b',  'a.opportunities_process_id  = b.opportunities_process_id');
		$this->db->where('a.opportunities_id', $leads_id);
		$query = $this->db->get();
		return $query->result() ;
		// tbl_opportunities_process tbl_opportunities_process_details
	}

	public function getProcessDtailsById($lead_id)
	{
		$this->db->select('a.* , b.*');
		$this->db->from('tbl_leads_process a');
		$this->db->join('tbl_leads_process_details b', 'b.leads_process_id = a.leads_process_id' , 'inner');
		$this->db->where('b.leads_process_details_id' , $lead_id);
		$query = $this->db->get();
		return $query->result() ;
	}

	public function getProductDetailById($process_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_leads_process_details a');
		$this->db->join('tbl_lead_product b', ' a.leads_process_id = b.lead_process_id');
		$this->db->where('a.leads_process_details_id', $process_id);
		$query = $this->db->get();
		return $query->result() ;
	}

	public function getProductsDetailsById($op_process_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_lead_product');
		$this->db->where('lead_process_id', $op_process_id);
		$query = $this->db->get();
		return $query->result() ;
	}

	public function getAllProductsDetailsById($lead_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_lead_product');
		$this->db->where('lead_id', $lead_id);
		$query = $this->db->get();
		return $query->result() ;
	} 

	public function getProcessById($leads_id)
	{
		$this->db->select('a.* , b.*');
		$this->db->from('tbl_leads_process a');
		$this->db->join('tbl_leads_process_details b', 'b.leads_process_id = a.leads_process_id','inner');
		$this->db->where('a.leads_id' , $leads_id);
		$query = $this->db->get();
		return $query->result() ;
	}

	public function getLeadItemDocuments($lead_id)
	{
		$this->db->select('a.product_name , b.*');
		$this->db->from('tbl_lead_product a');
		$this->db->join('tbl_item_attachment b', 'a.product_id = b.item_id', 'inner');
		$this->db->where('a.lead_id' , $lead_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getEmailById($lead_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_leads');
		$this->db->where('lead_id', $lead_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function addLeadsProcess($post)
	{
		$this->db->insert('tbl_leads_process', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	public function addLeadsProcessDetails($post)
	{
		$this->db->insert('tbl_leads_process_details', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	public function addLeadsProductFileImg($post)
	{
		$this->db->insert('tbl_leads_product_files', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}
	public function addLeadsProducts($post)
	{
		$this->db->insert('tbl_lead_product', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	public function countRow()
	{
		$query = $this->db->query("SELECT *,count(id) AS num_of_time FROM tbl_quotation");
    // print_r($query->result());
    	return $query->result();
	}

	public function searchLeadsForAssign($conditions)
	{
		if(!empty($conditions))
		{
			$where = '';
			if(isset($conditions['search_column']) && $conditions['search_column'] == 'address')
			{
				$where = 'address LIKE ' . "'%".$conditions["search_key"]."%'".' OR state LIKE ' . "'%".$conditions["search_key"]."%'".' OR zip_code LIKE ' . "'%".$conditions["search_key"]."%'".' OR city LIKE ' . "'%".$conditions["search_key"]."%'";
				$query = "SELECT * FROM tbl_leads WHERE $where AND lead_assign_status = '0' AND lead_status = '1'";
			}
			else if(isset($conditions['search_key']) && $conditions['search_key'] != '')
			{
				$clmn = $conditions['search_column'];
				$search_key = $conditions['search_key'];
				$query = "SELECT * FROM tbl_leads WHERE $clmn LIKE '%".$search_key."%' AND lead_assign_status = '0' AND lead_status = '1'";
			}
			else
			{
				$query = "SELECT * FROM tbl_leads WHERE lead_assign_status = '0' AND lead_status = '1'";
			}
			return $result = $this->db->query($query)->result();
		}
	}
}
?>
