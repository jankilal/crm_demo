<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mailbox extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mailbox_model');    
       
    }
    /* Details */
    public function index($mailbox_id = '')
    {
        if($this->checkViewPermission())
        {    
            $session = $this->session->all_userdata(); 
            $this->data['inbox_count'] = $this->mailbox_model->getInboxCount($session[0]->user_email);                
            $this->data['trash_count'] = $this->mailbox_model->getTrashCount($session[0]->user_id);   
            if($mailbox_id)
            {
                $this->mailbox_model->updateViewStatus($mailbox_id);
                $this->data['email_view'] = $this->mailbox_model->getEmailDetailsById($mailbox_id);              
                $this->show_view_admin('admin/mailbox/mailbox', $this->data);
            }
            else
            {
                if(isset($_POST['Trash']) && $_POST['Trash'] == 'Trash')
                {
                    $checked_arr = $this->input->post('mail_checked');
                    for ($i=0; $i < count($checked_arr); $i++) 
                    { 
                        $this->mailbox_model->moveToTrash($checked_arr[$i]);
                    }
                    redirect(base_url().'mailbox');
                }
                $this->data['inbox_result'] = $this->mailbox_model->getInboxMessage($session[0]->user_email,$session[0]->user_id);
                $this->show_view_admin('admin/mailbox/mailbox', $this->data);
            }
        }
        else
        {   
            redirect(base_url().'dashboard/error/1');
        }
    } 


    /* Sent Mail */
    public function sentMail($mailbox_id = '')
    {
        if($this->checkViewPermission())
        {           
            $session = $this->session->all_userdata();
            $this->data['inbox_count'] = $this->mailbox_model->getInboxCount($session[0]->user_id);            
            $this->data['trash_count'] = $this->mailbox_model->getTrashCount($session[0]->user_id);   
            if($mailbox_id)
            {
                $this->mailbox_model->updateViewStatus($mailbox_id);
                $this->data['email_view'] = $this->mailbox_model->getEmailDetailsById($mailbox_id);              
                $this->show_view_admin('admin/mailbox/sent_mail', $this->data);
            }
            else
            {
                if(isset($_POST['Trash']) && $_POST['Trash'] == 'Trash')
                    {
                        $checked_arr = $this->input->post('mail_checked');
                        for ($i=0; $i < count($checked_arr); $i++) 
                        { 
                            $this->mailbox_model->moveToTrash($checked_arr[$i]);
                        }
                        redirect(base_url().'mailbox/sentMail');
                }                          
                $this->data['sentmail_result'] = $this->mailbox_model->getSentMail($session[0]->user_email,$session[0]->user_id);            
                $this->show_view_admin('admin/mailbox/sent_mail', $this->data);        
            }
        }
        else
        {   
            redirect(base_url().'dashboard/error/1');
        }
    }  
    
    /* Draft Mail */
    public function draftMail()
    {
        if($this->checkViewPermission())
        {           
            $session = $this->session->all_userdata();
            $this->data['inbox_count'] = $this->mailbox_model->getInboxCount($session[0]->user_email,$session[0]->user_id);            
            $this->data['trash_count'] = $this->mailbox_model->getTrashCount($session[0]->user_id);            
            $this->data['draft_result'] = $this->mailbox_model->getDraftMail($session[0]->user_id);
            $this->show_view_admin('admin/mailbox/draft_mail', $this->data);
        }
        else
        {   
            redirect(base_url().'dashboard/error/1');
        }
    }  

    /* Favourites Mail */
    public function favouritesMail()
    {
        if($this->checkViewPermission())
        {         
            if(isset($_POST['Unfav']) && $_POST['Unfav'] == 'Unfav')
                {
                    $checked_arr = $this->input->post('mail_checked');
                    for ($i=0; $i < count($checked_arr); $i++) 
                    { 
                        $this->mailbox_model->removeToFavourite($checked_arr[$i]);
                    }
                    redirect(base_url().'mailbox/favouritesMail');
            } 
            $session = $this->session->all_userdata();  
            $this->data['inbox_count'] = $this->mailbox_model->getInboxCount($session[0]->user_email,$session[0]->user_id);            
            $this->data['trash_count'] = $this->mailbox_model->getTrashCount($session[0]->user_id);          
            $this->data['favourites_result'] = $this->mailbox_model->getFavouritesMail($session[0]->user_email,$session[0]->user_id);
            $this->show_view_admin('admin/mailbox/favourites_mail', $this->data);
        }
        else
        {   
            redirect(base_url().'dashboard/error/1');
        }
    }   

    /* Favourites Mail */
    public function trashMail()
    {
        if($this->checkViewPermission())
        {     
            if(isset($_POST['Delete']) && $_POST['Delete'] == 'Delete')
            {
                $checked_arr = $this->input->post('mail_checked');
                for ($i=0; $i < count($checked_arr); $i++) 
                { 
                    $this->mailbox_model->permanentDeleteMail($checked_arr[$i]);
                }
                redirect(base_url().'mailbox/trashMail');
            }             
            $session = $this->session->all_userdata();           
            $this->data['inbox_count'] = $this->mailbox_model->getInboxCount($session[0]->user_email,$session[0]->user_id);            
            $this->data['trash_count'] = $this->mailbox_model->getTrashCount($session[0]->user_id,$session[0]->user_id);       
            $this->data['trash_result'] = $this->mailbox_model->getTrashMail($session[0]->user_id,$session[0]->user_id);            
            $this->show_view_admin('admin/mailbox/trash', $this->data);
        }
        else
        {   
            redirect(base_url().'dashboard/error/1');
        }
    }  

   public function compose()
    {
        if($this->checkAddPermission())
        {     
            $session = $this->session->all_userdata();
            if(isset($_POST['Send']) && $_POST['Send'] == 'Send')
            {
                $email_addresses = $this->input->post('email_addresses');
                $mail_attechment = '';
                if(!empty($_FILES['mail_attechment']['name']))
                {                       
                    $_FILES['new_file']['name'] = $_FILES['mail_attechment']['name'];
                    $_FILES['new_file']['type'] = $_FILES['mail_attechment']['type'];
                    $_FILES['new_file']['tmp_name'] = $_FILES['mail_attechment']['tmp_name'];
                    $_FILES['new_file']['error'] = $_FILES['mail_attechment']['error'];
                    $_FILES['new_file']['size'] = $_FILES['mail_attechment']['size'];
                    $name = 'mail_attechment';
                    $imagePath = 'webroot/upload/mail_attechment/';
                    $temp = explode(".",$_FILES['new_file']['name']);
                    $extension = end($temp);
                    $filenew = date('d-M-Y').'_'.str_replace($_FILES['new_file']['name'],$name,$_FILES['new_file']['name']).'_'.time().''.rand(). "." .$extension;
                    $config['file_name'] = $filenew;
                    $config['upload_path'] = $imagePath;
                    // $config['allowed_types'] = 'GIF | gif | JPE | jpe | JPEG | jpeg | JPG | jpg | PNG | png';
                    $this->upload->initialize($config);
                    $this->upload->set_allowed_types('*');
                    $this->upload->set_filename($config['upload_path'],$filenew);                       
                    if(!$this->upload->do_upload('new_file'))
                    {
                        $data = array('msg' => $this->upload->display_errors());
                    }
                    else 
                    { 
                        $data = $this->upload->data();  
                        $imageName = $data['file_name'];
                    }
                    if($imageName)
                    {                                      
                        $mail_attechment = $imagePath.''.$imageName; 
                    }
                
                } // CHECK GALLERY IMAGE IS EXIST                 
                for ($i=0; $i < count($email_addresses) ; $i++) 
                { 
                    for($k = 0; $k < 2; $k++)
                    {
                        if($k == 1)
                        {
                            $post['sent_mail_status'] = '1';
                        }
                        else
                        {
                            $post['sent_mail_status'] = '0';
                        }
                        $email_arr = explode(',', $email_addresses[$i]);
                        $post['mail_to'] = $email_arr[0];
                        $post['mail_to_id'] = $email_arr[1];
                        $post['mail_from_id'] = $session[0]->user_id;
                        $post['mail_from'] = $session[0]->user_email;
                        $post['message_body'] = $this->input->post('email_description');
                        $post['message_time'] = date('Y-m-d H:i:s');
                        $post['user_id'] = $session[0]->user_id;
                        $post['subject'] = $this->input->post('subject');
                        if(isset($mail_attechment) && $mail_attechment != '')
                        {
                            $post['attach_file'] = $mail_attechment;
                        }
                        $send_res = $this->mailbox_model->addMail($post);
                        if($send_res)
                        {
                            $this->mailbox_model->updateSendMailStatus($send_res);
                        }  
                        
                    }
                }   
                redirect(base_url().'mailbox');     
                
            }

            $this->data['all_user_mail'] = $this->mailbox_model->getAllUserMail();
            $this->data['inbox_count'] = $this->mailbox_model->getInboxCount($session[0]->user_email);            
            $this->data['trash_count'] = $this->mailbox_model->getTrashCount($session[0]->user_id);   
            $this->show_view_admin('admin/mailbox/compose_mail', $this->data);
        }
        else
        {   
            redirect(base_url().'dashboard/error/1');
        }
    } 

    public function moveToFavourite()
    {
        $mailbox_id = $this->input->post('mailbox_id');
        echo $f_res = $this->mailbox_model->moveToFavourite($mailbox_id);
    }

    public function removeToFavourite()
    {
        $mailbox_id = $this->input->post('mailbox_id');
        echo $f_res = $this->mailbox_model->removeToFavourite($mailbox_id);
    }
}
?>