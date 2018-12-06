<?php

class Itemslist_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	}
		
	/*	Show all item  */
	public function getAllitem()
	{
		$this->db->select('*');
		$this->db->from('tbl_items');		
		$query = $this->db->get();
		return $query->result() ;
	}
	
	/* Add New item */	
	public function additem($post)
	{
		$this->db->insert('tbl_items', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	
	/* Add New item */	
	public function additemPermission($post)
	{
		$this->db->insert('tbl_others_permission', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}


	/* ******** Company List ***********/
	public function getALLitemcategory()
	{
		$this->db->select('*');
		$this->db->from('tbl_items');		
		$query = $this->db->get();
		return $query->result() ;
	}
	
	/* Edit User details */	
	public function edititem($item_id)
	{
		$this->db->select('*');		
		$this->db->from('tbl_items');
		$this->db->where('item_id' , $item_id );
		$query = $this->db->get();
		return $query->result();
	}
	// public function editattachment($item_id)
	// {
	// 	$this->db->select('*');		
	// 	$this->db->from('tbl_item_attachment');
	// 	// $this->db->join('tbl_item_attachment b', 'b.item_id = a.item_id');
	// 	$this->db->where('item_id' , $item_id);
	// 	$query = $this->db->get();
	// 	return $query->result();
	// }

	/* Update User */
	public function updateitem($post,$items_id)
	{
		$this->db->where('items_id', $items_id);
		$this->db->update('tbl_items', $post);
		return true;
	}
	
	/* Delete User detail */
	function deleteitem($item_id)
	{
		$this->db->delete('tbl_items', array('items_id' => $item_id));		
		return 1;		
	}

	

}
?>
