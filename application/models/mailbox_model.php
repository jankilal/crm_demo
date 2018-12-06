<?php
class Mailbox_Model extends CI_Model 
{
    function __construct()
    {
       parent::__construct();
    }

    public function getInboxMessage($email,$user_id) 
    {
        $this->db->select('a.*,b.user_full_name');
        $this->db->from('tbl_mailbox a');
        $this->db->join('tbl_user b', 'b.user_id = a.mail_from_id' ,'inner');
        $this->db->where('a.mail_to',$email);
        $this->db->where('a.mail_to_id',$user_id);
        $this->db->where('a.trash_status','0');
        $this->db->where('a.sent_mail_status','0');
        $this->db->where('a.send_status','1');
        $this->db->order_by('a.message_time', 'DESC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function getEmailDetailsById($mailbox_id) 
    {
        $this->db->select('a.*,b.user_full_name,user_profile_img');
        $this->db->from('tbl_mailbox a');
        $this->db->join('tbl_user b', 'b.user_id = a.mail_from_id' ,'inner');
        $this->db->where('a.mailbox_id',$mailbox_id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function getInboxCount($user_id) 
    {
        $this->db->select('*');
        $this->db->from('tbl_mailbox');
        //$this->db->where('mail_to',$email);
        $this->db->where('mail_to_id',$user_id);
        $this->db->where('trash_status','0');
        $this->db->where('send_status','1');
        $this->db->where('sent_mail_status','0');
        $this->db->where('view_status','0');
        $query_result = $this->db->get();
        $result = $query_result->num_rows();
        return $result;
    }

    public function getTrashCount($user_id) 
    {
        $this->db->select('a.*,b.user_full_name,user_profile_img');
        $this->db->from('tbl_mailbox a');
        $this->db->join('tbl_user b', 'b.user_id = a.mail_from_id' ,'inner');
        $this->db->where('a.user_id',$user_id);
        $this->db->where('a.trash_status','1');
        $this->db->where('a.send_status','1');
        $query_result = $this->db->get();
        $result = $query_result->num_rows();
        return $result;
    }
    
    public function getSentMail($email,$user_id) 
    {
        $this->db->select('a.*,b.user_full_name,user_profile_img');
        $this->db->from('tbl_mailbox a');
        $this->db->join('tbl_user b', 'b.user_id = a.mail_to_id' ,'inner');
        $this->db->where('a.mail_from',$email);
        $this->db->where('a.mail_from_id',$user_id);
        $this->db->where('a.trash_status','0');
        $this->db->where('a.sent_mail_status','1');
        $this->db->where('a.send_status','1');
        $this->db->order_by('message_time', 'DESC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function getFavouritesMail($email,$user_id) 
    {
        $this->db->select('*');
        $this->db->from('tbl_mailbox');
        $this->db->where('mail_to',$email);
        $this->db->where('mail_to_id',$user_id);
        $this->db->where('trash_status','0');
        $this->db->where('send_status','1');
        $this->db->where('favourites','1');
        $this->db->order_by('message_time', 'DESC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    } 
    public function getTrashMail($user_id) 
    {
        $this->db->select('*');
        $this->db->from('tbl_mailbox');
        $this->db->where('user_id',$user_id);
        //$this->db->or_where('mail_to',$email);
        $this->db->where('trash_status','1');
        $this->db->where('send_status','1');
        $this->db->order_by('message_time', 'DESC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    } 

    public function getDraftMail($user_id) 
    {
        $this->db->select('*');
        $this->db->from('tbl_mailbox');       
        $this->db->where('mail_from_id',$user_id);
        $this->db->where('trash_status','0');
        $this->db->where('send_status','0');
        $this->db->order_by('message_time', 'DESC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function getSentMessage($user_id) 
    {
        $this->db->select('*');
        $this->db->from('tbl_sent');
        $this->db->where('user_id', $user_id);
        $this->db->where('send_status','1');
        $this->db->order_by('message_time', 'DESC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }  
    public function getAllUserMail() 
    {
        $this->db->select('*');
        $this->db->from('tbl_user');
        $this->db->where('user_status','1');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }  
    
    public function getFavouritesMessage($user_id,$user_email) 
    {
        $this->db->select('*');
        $this->db->from('tbl_sent');
        $this->db->where('user_id', $user_id);
        $this->db->order_by('message_time', 'DESC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function getDraftMessage($user_id) 
    {
        $this->db->select('*');
        $this->db->from('tbl_draft');
        $this->db->where('user_id', $user_id);       
        $this->db->order_by('message_time', 'DESC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    /* Add New Mail */ 
    public function addMail($post)
    {
        $this->db->insert('tbl_mailbox', $post);
        $this->result = $this->db->insert_id() ; 
        return $this->result ;
    }   

    public function updateSendMailStatus($mailbox_id)
    {
        $data['send_status'] = '1';
        $this->db->where('mailbox_id', $mailbox_id);
        $this->db->update('tbl_mailbox' , $data);
        return true;
    } 

    public function moveToFavourite($mailbox_id)
    {
        $data['favourites'] = '1';
        $this->db->where('mailbox_id', $mailbox_id);
        $this->db->update('tbl_mailbox', $data);
        return true;
    }
    public function removeToFavourite($mailbox_id)
    {
        $data['favourites'] = '0';
        $this->db->where('mailbox_id', $mailbox_id);
        $this->db->update('tbl_mailbox', $data);
        return true;
    }
    public function moveToTrash($mailbox_id)
    {
        $data['trash_status'] = '1';
        $this->db->where('mailbox_id', $mailbox_id);
        $this->db->update('tbl_mailbox', $data);
        return true;
    }
    
    public function updateViewStatus($mailbox_id)
    {
        $data['view_status'] = '1';
        $this->db->where('mailbox_id', $mailbox_id);
        $this->db->update('tbl_mailbox', $data);
        return true;
    }

    public function permanentDeleteMail($mailbox_id)
    {
        $this->db->delete('tbl_mailbox', array('mailbox_id' => $mailbox_id));
        return 1;
    }

}
