<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tickets extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('tickets/tickets_model');
    }
    /*	Validation Rules */
	 protected $validation_rules = array
        (
        
		'companyAddEdit' => array(
        	
            array(
                'field' => 'company_name',
                'label' => ' Company name',
                'rules' => 'trim|required'
            ),			
			array(
                'field' => 'company_legal_name',
                'label' => 'Company Legal name',
                'rules' => 'trim|required'
            ),            	
            array(
                'field' => 'contact_person',
                'label' => 'Company Contact',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'company_address',
                'label' => 'Company Address',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'company_country_id',
                'label' => 'Company Country',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'company_state_id',
                'label' => 'Company State',
                'rules' => 'trim|required'
            ),           
            array(
                'field' => 'company_city',
                'label' => 'Company City',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'company_zip_code',
                'label' => 'Company Zip Code',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'company_phone',
                'label' => 'Company Phone',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'company_email',
                'label' => 'Company Email',
                'rules' => 'trim|required'
            ), 
            array(
                'field' => 'company_website',
                'label' => 'Company Website',
                'rules' => 'trim|required'
            ),             
        ),

        'incomeCategoryAdd' => array(
			array(
                'field' => 'income_category',
                'label' => 'Income Category Name',
                'rules' => 'trim|required'
            )
        ),

        'expenseCategoryAdd' => array(
			array(
                'field' => 'expense_category',
                'label' => 'Expense Category Name',
                'rules' => 'trim|required'
            )
        ),

        'depositeAdd' => array(
			array(
                'field' => 'account_id',
                'label' => 'Expense account Name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'amount',
                'label' => 'Expense amount Name',
                'rules' => 'trim|required'
            )
        ),

        'expensesAdd' => array(
			array(
                'field' => 'account_id',
                'label' => 'Expense account Name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'amount',
                'label' => 'Expense amount Name',
                'rules' => 'trim|required'
            )
        ),

         'transferAdd' => array(
			array(
                'field' => 'from_account_id',
                'label' => 'from account name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'to_account_id',
                'label' => 'TO account name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'amount',
                'label' => 'Expense amount Name',
                'rules' => 'trim|required'
            )
        ),


       'answerdAdd' => array(
            array(
                'field' => 'ticket_code',
                'label' => 'ticket code',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'subject',
                'label' => 'subject',
                'rules' => 'trim|required'
            ),  
            array(
                'field' => 'reporter',
                'label' => 'reporter',
                'rules' => 'trim|required'
            ), 
            array(
                'field' => 'priority',
                'label' => 'priority',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'departments_id',
                'label' => 'DepartmentsName',
                'rules' => 'trim|required'
            )
        ),

       'openAdd' => array(
            array(
                'field' => 'ticket_code',
                'label' => 'ticket code',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'subject',
                'label' => 'subject',
                'rules' => 'trim|required'
            ),  
            array(
                'field' => 'reporter',
                'label' => 'reporter',
                'rules' => 'trim|required'
            ), 
            array(
                'field' => 'priority',
                'label' => 'priority',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'departments_id',
                'label' => 'Departments Name',
                'rules' => 'trim|required'
            )
        ),

        'allticketsAdd' => array(
            array(
                'field' => 'ticket_code',
                'label' => 'ticket code',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'subject',
                'label' => 'subject',
                'rules' => 'trim|required'
            ),  
            array(
                'field' => 'reporter',
                'label' => 'reporter',
                'rules' => 'trim|required'
            ), 
            array(
                'field' => 'priority',
                'label' => 'priority',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'departments_id',
                'label' => 'Departments Name',
                'rules' => 'trim|required'
            )
        ),

       'inprogressAdd' => array(
            array(
                'field' => 'ticket_code',
                'label' => 'ticket code',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'subject',
                'label' => 'subject',
                'rules' => 'trim|required'
            ),  
            array(
                'field' => 'reporter',
                'label' => 'reporter',
                'rules' => 'trim|required'
            ), 
            array(
                'field' => 'priority',
                'label' => 'priority',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'departments_id',
                'label' => 'Departments Name',
                'rules' => 'trim|required'
            )
        ), 

       'closedAdd' => array(
            array(
                'field' => 'ticket_code',
                'label' => 'ticket code',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'subject',
                'label' => 'subject',
                'rules' => 'trim|required'
            ),  
            array(
                'field' => 'reporter',
                'label' => 'reporter',
                'rules' => 'trim|required'
            ), 
            array(
                'field' => 'priority',
                'label' => 'priority',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'departments_id',
                'label' => 'Departments Name',
                'rules' => 'trim|required'
            )
        ),

        'goaltypeAdd' => array(
			array(
                'field' => 'type_name',
                'label' => 'Goal Type Name',
                'rules' => 'trim|required'
            )
        ),

        'leadStatusAdd' => array(
			array(
                'field' => 'lead_status',
                'label' => 'Lead Status name',
                'rules' => 'trim|required'
            ),

            array(
                'field' => 'lead_type',
                'label' => 'Lead Status type',
                'rules' => 'trim|required'
            )

        ),

        'leadSourceAdd' => array(
			array(
                'field' => 'lead_source',
                'label' => 'Lead source name',
                'rules' => 'trim|required'
            ), 
        ),

         'OpportunitiesStateReasonAdd' => array(
			array(
                'field' => 'opportunities_state_reason',
                'label' => 'Opportunities State Reason',
                'rules' => 'trim|required'
            ),
         ),       

        'paymentMethodsAdd' => array(
			array(
                'field' => 'method_name',
                'label' => 'payment Method name',
                'rules' => 'trim|required'
            ),
         ),   

        'departmentAdd' => array(
			array(
                'field' => 'deptname',
                'label' => 'Department name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'company_id',
                'label' => 'Company',
                'rules' => 'trim|required'
            )
         )       
    );
//########### deposit Setting Start ##############

   public function answered()
   {
   		if($this->checkViewPermission())
		{			
			$this->data['answered_result'] = $this->tickets_model->getAllanswerd();
			$this->data['advance_data_tbl'] = '1';	
			$this->show_view_admin('admin/tickets/answered', $this->data);
		}
		else
		{	
			redirect(base_url().'dashboard/error/1');
		}
   }

   public function addanswered($tickets_id ='')
   {

   		if($tickets_id != '')
   		{
   			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{					
					$this->form_validation->set_rules($this->validation_rules['answerdAdd']);
					if($this->form_validation->run())
					{

						$tickets_id = $tickets_id;
						$post['ticket_code'] = $this->input->post('ticket_code');
                        $post['departments_id'] = $this->input->post('departments_id'); 
                        $post['subject'] = $this->input->post('subject');
                        $post['reporter'] = $this->input->post('reporter');
                        $post['priority'] = $this->input->post('priority');
                        $post['comment'] = $this->input->post('comment');
						if ($_FILES["attachement"]["name"])
						{
	                        $attachement = 'attachement';
	                        $fieldName = "attachement";
	                        $Path = 'webroot/upload/deposit/';
	                         $attachement = $this->ImageUpload($_FILES["attachement"]["name"], $attachement, $Path, $fieldName);
	                        $post['attachement'] = $Path.''.$attachement;
	                    }	      
						$edit_result =  $this->tickets_model->updateanswerd($post,$tickets_id);	
						if($edit_result)
						{					
							$msg = 'Answered Update successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'tickets/answered');
						}
					}
					else
					{	
					   
						$this->data['department_list'] = $this->tickets_model->getALLDepartment();
						$this->data['user_list'] = $this->tickets_model->getALLUser();				
						$this->data['edit_answerd'] = $this->tickets_model->editanswerd($tickets_id);
						$this->show_view_admin('admin/tickets/answered_update', $this->data);
					}		
				}
				else
				{
					  
                        $this->data['department_list'] = $this->tickets_model->getALLDepartment();
                        $this->data['user_list'] = $this->tickets_model->getALLUser();              
                        $this->data['edit_answerd'] = $this->tickets_model->editanswerd($tickets_id);
                        $this->show_view_admin('admin/tickets/answered_update', $this->data);
				}
			}
			else
			{
				redirect( base_url().'dashboard/error/1');
			}
   		}
   		else
   		{
   			if($this->checkAddPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Add") 
				{
                  
					$this->form_validation->set_rules($this->validation_rules['answerdAdd']);
					if($this->form_validation->run())
					{
					  
						$post['ticket_code'] = $this->input->post('ticket_code');
                        $post['type'] = 'Answerd';
                        $post['status'] = 'answerd';
						$post['departments_id'] = $this->input->post('departments_id');	
						$post['subject'] = $this->input->post('subject');
						$post['reporter'] = $this->input->post('reporter');
                        $post['priority'] = $this->input->post('priority');
						$post['permission'] = $this->input->post('permission');
                        $post['comment'] = $this->input->post('comment');
						$tickets_id =  $this->tickets_model->addanswerd($post);	
						if($tickets_id)
						{ 
                            if($_POST['permission'] == '0')
                            {
                                $permission_arr = $this->input->post('assigned_to');
                                if(sizeof($permission_arr) > 0)
                                {   
                                    for ($i=0; $i < count($permission_arr) ; $i++) 
                                    {                                       
                                        $post_permission['tickets_id'] = $tickets_id;
                                        $post_permission['user_id'] = $permission_arr[$i];
                                        $post_permission['permission_view'] = $this->input->post('view_'.$permission_arr[$i]);
                                        $post_permission['permission_edit'] = $this->input->post('edit_'.$permission_arr[$i]);
                                        $post_permission['permission_delete'] = $this->input->post('delete_'.$permission_arr[$i]);
                                        $post_permission['others_permission_status'] = 1;
                                        $post_permission['others_permission_created_date'] = date('Y-m-d');
                                        $post_permission['others_permission_update_date'] = date('Y-m-d');
                                        $this->tickets_model->addTicketsPermission($post_permission);
                                    }                               
                                }
                                
                            }               
							if($_FILES["attachement"]['name'])
								{							
									$attachment_array = $_FILES["attachement"]["name"];
									for($k = 0; $k < count($attachment_array); $k++)
									{	
										$_FILES['new_file']['name'] = $_FILES['attachement']['name'][$k];
										$_FILES['new_file']['type'] = $_FILES['attachement']['type'][$k];
						                $_FILES['new_file']['tmp_name'] = $_FILES['attachement']['tmp_name'][$k];
						                $_FILES['new_file']['error'] = $_FILES['attachement']['error'][$k];
						                $_FILES['new_file']['size'] = $_FILES['attachement']['size'][$k];
						              	$name = 'transaction_attechment';
						              	$imagePath = 'webroot/upload/tickets/';
						               	$temp = explode(".",$_FILES['new_file']['name']);				
										$extension = end($temp);
										$filenew =  date('d-M-Y').'_'.str_replace($_FILES['new_file']['name'],$name,$_FILES['new_file']['name']).'_'.time().''.rand(). "." .$extension;  		
										$config['file_name'] = $filenew;
										$config['upload_path'] = $imagePath;
									    //$config['allowed_types'] = 'GIF | gif | JPE | jpe | JPEG | jpeg | JPG | jpg | PNG | png | odt | pdf | sql | doc ';
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
						                   	$post_img['attachement'] = $imagePath.''.$imageName;
											$post_img['tickets_id'] =  $tickets_id;	
                                            $post_img['type'] =  'Answerd';	
											$this->tickets_model->addTicketFile($post_img);
						              	}
                                    }

                                }
							$msg = 'Answered added successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'tickets/answered');
						}
					}
					else
					{				
					
						$this->data['role_list'] = $this->tickets_model->getRoleList();
						$this->data['department_list'] = $this->tickets_model->getALLDepartment();
						$this->data['user_list'] = $this->tickets_model->getALLUser();		
					    $this->data['role_list'] = $this->tickets_model->getRoleList();
					    $this->show_view_admin('admin/tickets/answered_add', $this->data);
					}		
				}
				else
				{		
						$this->data['role_list'] = $this->tickets_model->getRoleList();
						$this->data['department_list'] = $this->tickets_model->getALLDepartment();
						$this->data['user_list'] = $this->tickets_model->getALLUser();		
					    $this->data['role_list'] = $this->tickets_model->getRoleList();
					    $this->show_view_admin('admin/tickets/answered_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'dashboard/error/1');
			}
   		}

   }

   /* Delete */
	public function deleteAnswerd()
	{
		if($this->checkDeletePermission())
		{
			$tickets_id = $this->uri->segment(3);	
			$this->tickets_model->deleteanswerd($tickets_id);
			$msg = 'Answered remove successfully...!';
			$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
			redirect(base_url().'tickets/answered');
			
		}
		else
		{
			redirect( base_url().'dashboard/error/1');
		}		
	}

//########### answered Setting End  ##############


//########### open Setting Start  ##############

    public function open()
   {
        if($this->checkViewPermission())
        {           
            $this->data['open_result'] = $this->tickets_model->getAllopen();
            $this->data['advance_data_tbl'] = '1';  
            $this->show_view_admin('admin/tickets/open', $this->data);
        }
        else
        {   
            redirect(base_url().'dashboard/error/1');
        }
   }

   public function addOpen($tickets_id ='')
   {

        if($tickets_id != '')
        {
            if($this->checkEditPermission())
            {
                if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
                {                   
                    $this->form_validation->set_rules($this->validation_rules['openAdd']);
                    if($this->form_validation->run())
                    {

                        $tickets_id = $tickets_id;
                        $post['ticket_code'] = $this->input->post('ticket_code');
                        $post['departments_id'] = $this->input->post('departments_id'); 
                        $post['subject'] = $this->input->post('subject');
                        $post['reporter'] = $this->input->post('reporter');
                        $post['priority'] = $this->input->post('priority');
                        $post['comment'] = $this->input->post('comment');
                        if ($_FILES["attachement"]["name"])
                        {
                            $attachement = 'attachement';
                            $fieldName = "attachement";
                            $Path = 'webroot/upload/deposit/';
                             $attachement = $this->ImageUpload($_FILES["attachement"]["name"], $attachement, $Path, $fieldName);
                            $post['attachement'] = $Path.''.$attachement;
                        }         
                        $edit_result =  $this->tickets_model->updateopen($post,$tickets_id); 
                        if($edit_result)
                        {                   
                            $msg = 'Open Update successfully!!';                    
                            $this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
                            redirect(base_url().'tickets/open');
                        }
                    }
                    else
                    {   
                       
                        $this->data['department_list'] = $this->tickets_model->getALLDepartment();
                        $this->data['user_list'] = $this->tickets_model->getALLUser();              
                        $this->data['edit_open'] = $this->tickets_model->editopen($tickets_id);
                        $this->show_view_admin('admin/tickets/open_update', $this->data);
                    }       
                }
                else
                {
                      
                        $this->data['department_list'] = $this->tickets_model->getALLDepartment();
                        $this->data['user_list'] = $this->tickets_model->getALLUser();              
                        $this->data['edit_open'] = $this->tickets_model->editopen($tickets_id);
                        $this->show_view_admin('admin/tickets/open_update', $this->data);
                }
            }
            else
            {
                redirect( base_url().'dashboard/error/1');
            }
        }
        else
        {
            if($this->checkAddPermission())
            {
                if (isset($_POST['Submit']) && $_POST['Submit'] == "Add") 
                {

                    $this->form_validation->set_rules($this->validation_rules['openAdd']);
                    if($this->form_validation->run())
                    {
                    
                        $post['ticket_code'] = $this->input->post('ticket_code');
                        $post['type'] = 'Open';
                        $post['status'] = 'open';
                        $post['departments_id'] = $this->input->post('departments_id'); 
                        $post['subject'] = $this->input->post('subject');
                        $post['reporter'] = $this->input->post('reporter');
                        $post['priority'] = $this->input->post('priority');
                        $post['permission'] = $this->input->post('permission');
                        $post['comment'] = $this->input->post('comment');
                        $tickets_id =  $this->tickets_model->addopen($post); 
                        if($tickets_id)
                        { 
                            if($_POST['permission'] == '0')
                            {
                                $permission_arr = $this->input->post('assigned_to');
                                if(sizeof($permission_arr) > 0)
                                {   
                                    for ($i=0; $i < count($permission_arr) ; $i++) 
                                    {                                       
                                        $post_permission['tickets_id'] = $tickets_id;
                                        $post_permission['user_id'] = $permission_arr[$i];
                                        $post_permission['permission_view'] = $this->input->post('view_'.$permission_arr[$i]);
                                        $post_permission['permission_edit'] = $this->input->post('edit_'.$permission_arr[$i]);
                                        $post_permission['permission_delete'] = $this->input->post('delete_'.$permission_arr[$i]);
                                        $post_permission['others_permission_status'] = 1;
                                        $post_permission['others_permission_created_date'] = date('Y-m-d');
                                        $post_permission['others_permission_update_date'] = date('Y-m-d');
                                        $this->tickets_model->addTicketsPermission($post_permission);
                                    }                               
                                }
                                
                            }   
                            if($_FILES["attachement"]['name'])
                                {                           
                                    $attachment_array = $_FILES["attachement"]["name"];
                                    for($k = 0; $k < count($attachment_array); $k++)
                                    {   
                                        $_FILES['new_file']['name'] = $_FILES['attachement']['name'][$k];
                                        $_FILES['new_file']['type'] = $_FILES['attachement']['type'][$k];
                                        $_FILES['new_file']['tmp_name'] = $_FILES['attachement']['tmp_name'][$k];
                                        $_FILES['new_file']['error'] = $_FILES['attachement']['error'][$k];
                                        $_FILES['new_file']['size'] = $_FILES['attachement']['size'][$k];
                                        $name = 'transaction_attechment';
                                        $imagePath = 'webroot/upload/tickets/';
                                        $temp = explode(".",$_FILES['new_file']['name']);               
                                        $extension = end($temp);
                                        $filenew =  date('d-M-Y').'_'.str_replace($_FILES['new_file']['name'],$name,$_FILES['new_file']['name']).'_'.time().''.rand(). "." .$extension;         
                                        $config['file_name'] = $filenew;
                                        $config['upload_path'] = $imagePath;
                                        //$config['allowed_types'] = 'GIF | gif | JPE | jpe | JPEG | jpeg | JPG | jpg | PNG | png | odt | pdf | sql | doc ';
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
                                            $post_img['attachement'] = $imagePath.''.$imageName;
                                            $post_img['tickets_id'] =  $tickets_id;
                                             $post_img['type'] =  'Open';         
                                            $this->tickets_model->addTicketFile($post_img);
                                        }
                                    }

                                }
                            $msg = 'Open added successfully!!';                 
                            $this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
                            redirect(base_url().'tickets/open');
                        }
                    }
                    else
                    {               
                    
                        $this->data['role_list'] = $this->tickets_model->getRoleList();
                        $this->data['department_list'] = $this->tickets_model->getALLDepartment();
                        $this->data['user_list'] = $this->tickets_model->getALLUser();      
                        $this->data['role_list'] = $this->tickets_model->getRoleList();
                        $this->show_view_admin('admin/tickets/open_add', $this->data);
                    }       
                }
                else
                {       
                        $this->data['role_list'] = $this->tickets_model->getRoleList();
                        $this->data['department_list'] = $this->tickets_model->getALLDepartment();
                        $this->data['user_list'] = $this->tickets_model->getALLUser();      
                        $this->data['role_list'] = $this->tickets_model->getRoleList();
                        $this->show_view_admin('admin/tickets/open_add', $this->data);
                }
            }
            else
            {
                redirect( base_url().'dashboard/error/1');
            }
        }

   }

   /* Delete */
    public function deleteOpen()
    {
        if($this->checkDeletePermission())
        {
            $tickets_id = $this->uri->segment(3);   
            $this->tickets_model->deleteopen($tickets_id);
            $msg = 'Answered remove successfully...!';
            $this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
            redirect(base_url().'tickets/open');
            
        }
        else
        {
            redirect( base_url().'dashboard/error/1');
        }       
    }
//########### open Setting End  ##############

 //########### Inprogress Setting start ##############   


  public function inProgress()
   {
        if($this->checkViewPermission())
        {           
            $this->data['inprogress_result'] = $this->tickets_model->getAllinprogress();
            $this->data['advance_data_tbl'] = '1';  
            $this->show_view_admin('admin/tickets/inprogress', $this->data);
        }
        else
        {   
            redirect(base_url().'dashboard/error/1');
        }
   }

   public function addinProgress($tickets_id ='')
   {

        if($tickets_id != '')
        {
            if($this->checkEditPermission())
            {
                if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
                {                   
                    $this->form_validation->set_rules($this->validation_rules['inprogressAdd']);
                    if($this->form_validation->run())
                    {

                        $tickets_id = $tickets_id;
                        $post['ticket_code'] = $this->input->post('ticket_code');
                        $post['departments_id'] = $this->input->post('departments_id'); 
                        $post['subject'] = $this->input->post('subject');
                        $post['reporter'] = $this->input->post('reporter');
                        $post['priority'] = $this->input->post('priority');
                        $post['comment'] = $this->input->post('comment');
                        if ($_FILES["attachement"]["name"])
                        {
                            $attachement = 'attachement';
                            $fieldName = "attachement";
                            $Path = 'webroot/upload/deposit/';
                             $attachement = $this->ImageUpload($_FILES["attachement"]["name"], $attachement, $Path, $fieldName);
                            $post['attachement'] = $Path.''.$attachement;
                        }         
                        $edit_result =  $this->tickets_model->updatinprogress($post,$tickets_id); 
                        if($edit_result)
                        {                   
                            $msg = 'Inprogress Update successfully!!';                    
                            $this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
                            redirect(base_url().'tickets/inProgress');
                        }
                    }
                    else
                    {   
                       
                        $this->data['department_list'] = $this->tickets_model->getALLDepartment();
                        $this->data['user_list'] = $this->tickets_model->getALLUser();              
                        $this->data['edit_inprogress'] = $this->tickets_model->editinprogress($tickets_id);
                        $this->show_view_admin('admin/tickets/inprogress_update', $this->data);
                    }       
                }
                else
                {
                      
                        $this->data['department_list'] = $this->tickets_model->getALLDepartment();
                        $this->data['user_list'] = $this->tickets_model->getALLUser();              
                        $this->data['edit_inprogress'] = $this->tickets_model->editinprogress($tickets_id);
                        $this->show_view_admin('admin/tickets/inprogress_update', $this->data);
                }
            }
            else
            {
                redirect( base_url().'dashboard/error/1');
            }
        }
        else
        {
            if($this->checkAddPermission())
            {
                if (isset($_POST['Submit']) && $_POST['Submit'] == "Add") 
                {

                    $this->form_validation->set_rules($this->validation_rules['inprogressAdd']);
                    if($this->form_validation->run())
                    {
                    
                        $post['ticket_code'] = $this->input->post('ticket_code');
                        $post['type'] = 'Inprogress';
                        $post['status'] = 'in_progress';
                        $post['departments_id'] = $this->input->post('departments_id'); 
                        $post['subject'] = $this->input->post('subject');
                        $post['reporter'] = $this->input->post('reporter');
                        $post['priority'] = $this->input->post('priority');
                        $post['permission'] = $this->input->post('permission');
                        $post['comment'] = $this->input->post('comment');
                        $tickets_id =  $this->tickets_model->addinprogress($post); 
                        if($tickets_id)
                        { 
                            if($_POST['permission'] == '0')
                            {
                                $permission_arr = $this->input->post('assigned_to');
                                if(sizeof($permission_arr) > 0)
                                {   
                                    for ($i=0; $i < count($permission_arr) ; $i++) 
                                    {                                       
                                        $post_permission['tickets_id'] = $tickets_id;
                                        $post_permission['user_id'] = $permission_arr[$i];
                                        $post_permission['permission_view'] = $this->input->post('view_'.$permission_arr[$i]);
                                        $post_permission['permission_edit'] = $this->input->post('edit_'.$permission_arr[$i]);
                                        $post_permission['permission_delete'] = $this->input->post('delete_'.$permission_arr[$i]);
                                        $post_permission['others_permission_status'] = 1;
                                        $post_permission['others_permission_created_date'] = date('Y-m-d');
                                        $post_permission['others_permission_update_date'] = date('Y-m-d');
                                        $this->tickets_model->addTicketsPermission($post_permission);
                                    }                               
                                }
                                
                            }   
                            if($_FILES["attachement"]['name'])
                                {                           
                                    $attachment_array = $_FILES["attachement"]["name"];
                                    for($k = 0; $k < count($attachment_array); $k++)
                                    {   
                                        $_FILES['new_file']['name'] = $_FILES['attachement']['name'][$k];
                                        $_FILES['new_file']['type'] = $_FILES['attachement']['type'][$k];
                                        $_FILES['new_file']['tmp_name'] = $_FILES['attachement']['tmp_name'][$k];
                                        $_FILES['new_file']['error'] = $_FILES['attachement']['error'][$k];
                                        $_FILES['new_file']['size'] = $_FILES['attachement']['size'][$k];
                                        $name = 'transaction_attechment';
                                        $imagePath = 'webroot/upload/tickets/';
                                        $temp = explode(".",$_FILES['new_file']['name']);               
                                        $extension = end($temp);
                                        $filenew =  date('d-M-Y').'_'.str_replace($_FILES['new_file']['name'],$name,$_FILES['new_file']['name']).'_'.time().''.rand(). "." .$extension;         
                                        $config['file_name'] = $filenew;
                                        $config['upload_path'] = $imagePath;
                                        //$config['allowed_types'] = 'GIF | gif | JPE | jpe | JPEG | jpeg | JPG | jpg | PNG | png | odt | pdf | sql | doc ';
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
                                            $post_img['attachement'] = $imagePath.''.$imageName;
                                            $post_img['tickets_id'] =  $tickets_id;
                                             $post_img['type'] =  'Inprogress';         
                                            $this->tickets_model->addTicketFile($post_img);
                                        }
                                    }

                                }
                            $msg = 'Inprogress added successfully!!';                 
                            $this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
                            redirect(base_url().'tickets/inProgress');
                        }
                    }
                    else
                    {               
                    
                        $this->data['role_list'] = $this->tickets_model->getRoleList();
                        $this->data['department_list'] = $this->tickets_model->getALLDepartment();
                        $this->data['user_list'] = $this->tickets_model->getALLUser();      
                        $this->data['role_list'] = $this->tickets_model->getRoleList();
                        $this->show_view_admin('admin/tickets/inprogress_add', $this->data);
                    }       
                }
                else
                {       
                        $this->data['role_list'] = $this->tickets_model->getRoleList();
                        $this->data['department_list'] = $this->tickets_model->getALLDepartment();
                        $this->data['user_list'] = $this->tickets_model->getALLUser();      
                        $this->data['role_list'] = $this->tickets_model->getRoleList();
                        $this->show_view_admin('admin/tickets/inprogress_add', $this->data);
                }
            }
            else
            {
                redirect( base_url().'dashboard/error/1');
            }
        }

   }

   /* Delete */
    public function deleteinProgress()
    {
        if($this->checkDeletePermission())
        {
            $tickets_id = $this->uri->segment(3);   
            $this->tickets_model->deleteinprogress($tickets_id);
            $msg = 'Inprogress remove successfully...!';
            $this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
            redirect(base_url().'tickets/inProgress');
            
        }
        else
        {
            redirect( base_url().'dashboard/error/1');
        }       
    }

 //########### Inprogress Setting End ##############  

 //########### Closed Setting start ##############  

    public function closed()
   {
        if($this->checkViewPermission())
        {           
            $this->data['closed_result'] = $this->tickets_model->getAllclosed();
            $this->data['advance_data_tbl'] = '1';  
            $this->show_view_admin('admin/tickets/closed', $this->data);
        }
        else
        {   
            redirect(base_url().'dashboard/error/1');
        }
   }

   public function addClosed($tickets_id ='')
   {

        if($tickets_id != '')
        {
            if($this->checkEditPermission())
            {
                if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
                {                   
                    $this->form_validation->set_rules($this->validation_rules['closedAdd']);
                    if($this->form_validation->run())
                    {

                        $tickets_id = $tickets_id;
                        $post['ticket_code'] = $this->input->post('ticket_code');
                        $post['departments_id'] = $this->input->post('departments_id'); 
                        $post['subject'] = $this->input->post('subject');
                        $post['reporter'] = $this->input->post('reporter');
                        $post['priority'] = $this->input->post('priority');
                        $post['comment'] = $this->input->post('comment');
                        if ($_FILES["attachement"]["name"])
                        {
                            $attachement = 'attachement';
                            $fieldName = "attachement";
                            $Path = 'webroot/upload/deposit/';
                             $attachement = $this->ImageUpload($_FILES["attachement"]["name"], $attachement, $Path, $fieldName);
                            $post['attachement'] = $Path.''.$attachement;
                        }         
                        $edit_result =  $this->tickets_model->updatclosed($post,$tickets_id); 
                        if($edit_result)
                        {                   
                            $msg = 'closed Update successfully!!';                    
                            $this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
                            redirect(base_url().'tickets/closed');
                        }
                    }
                    else
                    {   
                       
                        $this->data['department_list'] = $this->tickets_model->getALLDepartment();
                        $this->data['user_list'] = $this->tickets_model->getALLUser();              
                        $this->data['edit_closed'] = $this->tickets_model->editclosed($tickets_id);
                        $this->show_view_admin('admin/tickets/closed_update', $this->data);
                    }       
                }
                else
                {
                      
                        $this->data['department_list'] = $this->tickets_model->getALLDepartment();
                        $this->data['user_list'] = $this->tickets_model->getALLUser();              
                        $this->data['edit_closed'] = $this->tickets_model->editclosed($tickets_id);
                        $this->show_view_admin('admin/tickets/closed_update', $this->data);
                }
            }
            else
            {
                redirect( base_url().'dashboard/error/1');
            }
        }
        else
        {
            if($this->checkAddPermission())
            {
                if (isset($_POST['Submit']) && $_POST['Submit'] == "Add") 
                {

                    $this->form_validation->set_rules($this->validation_rules['closedAdd']);
                    if($this->form_validation->run())
                    {
                      
                        $post['ticket_code'] = $this->input->post('ticket_code');
                        $post['type'] = 'Closed';
                        $post['status'] = 'closed';
                        $post['departments_id'] = $this->input->post('departments_id'); 
                        $post['subject'] = $this->input->post('subject');
                        $post['reporter'] = $this->input->post('reporter');
                        $post['priority'] = $this->input->post('priority');
                        $post['permission'] = $this->input->post('permission');
                        $post['comment'] = $this->input->post('comment');
                        $tickets_id =  $this->tickets_model->addclosed($post); 
                        if($tickets_id)
                        { 
                            if($_POST['permission'] == '0')
                            {
                                $permission_arr = $this->input->post('assigned_to');
                                if(sizeof($permission_arr) > 0)
                                {   
                                    for ($i=0; $i < count($permission_arr) ; $i++) 
                                    {                                       
                                        $post_permission['tickets_id'] = $tickets_id;
                                        $post_permission['user_id'] = $permission_arr[$i];
                                        $post_permission['permission_view'] = $this->input->post('view_'.$permission_arr[$i]);
                                        $post_permission['permission_edit'] = $this->input->post('edit_'.$permission_arr[$i]);
                                        $post_permission['permission_delete'] = $this->input->post('delete_'.$permission_arr[$i]);
                                        $post_permission['others_permission_status'] = 1;
                                        $post_permission['others_permission_created_date'] = date('Y-m-d');
                                        $post_permission['others_permission_update_date'] = date('Y-m-d');
                                        $this->tickets_model->addTicketsPermission($post_permission);
                                    }                               
                                }
                                
                            }   
                            if($_FILES["attachement"]['name'])
                                {                           
                                    $attachment_array = $_FILES["attachement"]["name"];
                                    for($k = 0; $k < count($attachment_array); $k++)
                                    {   
                                        $_FILES['new_file']['name'] = $_FILES['attachement']['name'][$k];
                                        $_FILES['new_file']['type'] = $_FILES['attachement']['type'][$k];
                                        $_FILES['new_file']['tmp_name'] = $_FILES['attachement']['tmp_name'][$k];
                                        $_FILES['new_file']['error'] = $_FILES['attachement']['error'][$k];
                                        $_FILES['new_file']['size'] = $_FILES['attachement']['size'][$k];
                                        $name = 'transaction_attechment';
                                        $imagePath = 'webroot/upload/tickets/';
                                        $temp = explode(".",$_FILES['new_file']['name']);               
                                        $extension = end($temp);
                                        $filenew =  date('d-M-Y').'_'.str_replace($_FILES['new_file']['name'],$name,$_FILES['new_file']['name']).'_'.time().''.rand(). "." .$extension;         
                                        $config['file_name'] = $filenew;
                                        $config['upload_path'] = $imagePath;
                                        //$config['allowed_types'] = 'GIF | gif | JPE | jpe | JPEG | jpeg | JPG | jpg | PNG | png | odt | pdf | sql | doc ';
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
                                            $post_img['attachement'] = $imagePath.''.$imageName;
                                            $post_img['tickets_id'] =  $tickets_id; 
                                            $post_img['type'] =  'Closed'; 
                                            $this->tickets_model->addTicketFile($post_img);
                                        }
                                    }

                                }
                            $msg = 'Closed added successfully!!';                 
                            $this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
                            redirect(base_url().'tickets/closed');
                        }
                    }
                    else
                    {               
                    
                        $this->data['role_list'] = $this->tickets_model->getRoleList();
                        $this->data['department_list'] = $this->tickets_model->getALLDepartment();
                        $this->data['user_list'] = $this->tickets_model->getALLUser();      
                        $this->data['role_list'] = $this->tickets_model->getRoleList();
                        $this->show_view_admin('admin/tickets/closed_add', $this->data);
                    }       
                }
                else
                {       
                        $this->data['role_list'] = $this->tickets_model->getRoleList();
                        $this->data['department_list'] = $this->tickets_model->getALLDepartment();
                        $this->data['user_list'] = $this->tickets_model->getALLUser();      
                        $this->data['role_list'] = $this->tickets_model->getRoleList();
                        $this->show_view_admin('admin/tickets/closed_add', $this->data);
                }
            }
            else
            {
                redirect( base_url().'dashboard/error/1');
            }
        }

   }

   /* Delete */
    public function deleteClosed()
    {
        if($this->checkDeletePermission())
        {
            $tickets_id = $this->uri->segment(3);   
            $this->tickets_model->deleteclosed($tickets_id);
            $msg = 'Closed remove successfully...!';
            $this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
            redirect(base_url().'tickets/closed');
            
        }
        else
        {
            redirect( base_url().'dashboard/error/1');
        }       
    }

//########### Closed Setting End  ##############


//########### All Tickets Setting Start  ##############

 public function alltickets()
   {
        if($this->checkViewPermission())
        {           
            $this->data['alltickets_result'] = $this->tickets_model->getAlltickets();
            $this->data['all_status'] = $this->tickets_model->getALLstatus();
            $this->data['advance_data_tbl'] = '1';  
            $this->show_view_admin('admin/tickets/all_tickets', $this->data);
        }
        else
        {   
            redirect(base_url().'dashboard/error/1');
        }
   }

   public function addalltickets($tickets_id ='')
   {

        if($tickets_id != '')
        {
            if($this->checkEditPermission())
            {
                if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
                {                   
                    $this->form_validation->set_rules($this->validation_rules['allticketsAdd']);
                    if($this->form_validation->run())
                    {

                        $tickets_id = $tickets_id;
                        $post['ticket_code'] = $this->input->post('ticket_code');
                        $post['departments_id'] = $this->input->post('departments_id'); 
                        $post['subject'] = $this->input->post('subject');
                        $post['reporter'] = $this->input->post('reporter');
                        $post['priority'] = $this->input->post('priority');
                        $post['comment'] = $this->input->post('comment');
                        if ($_FILES["attachement"]["name"])
                        {
                            $attachement = 'attachement';
                            $fieldName = "attachement";
                            $Path = 'webroot/upload/deposit/';
                             $attachement = $this->ImageUpload($_FILES["attachement"]["name"], $attachement, $Path, $fieldName);
                            $post['attachement'] = $Path.''.$attachement;
                        }         
                        $edit_result =  $this->tickets_model->updatealltickets($post,$tickets_id); 
                        if($edit_result)
                        {                   
                            $msg = 'tickets Update successfully!!';                    
                            $this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
                            redirect(base_url().'tickets/alltickets');
                        }
                    }
                    else
                    {   
                       
                        $this->data['department_list'] = $this->tickets_model->getALLDepartment();
                        $this->data['user_list'] = $this->tickets_model->getALLUser();              
                        $this->data['edit_alltickets'] = $this->tickets_model->editalltickets($tickets_id);
                        $this->show_view_admin('admin/tickets/all_tickets_update', $this->data);
                    }       
                }
                else
                {
                      
                        $this->data['department_list'] = $this->tickets_model->getALLDepartment();
                        $this->data['user_list'] = $this->tickets_model->getALLUser();              
                        $this->data['edit_alltickets'] = $this->tickets_model->editalltickets($tickets_id);
                        $this->show_view_admin('admin/tickets/all_tickets_update', $this->data);
                }
            }
            else
            {
                redirect( base_url().'dashboard/error/1');
            }
        }
        else
        {
            if($this->checkAddPermission())
            {
                if (isset($_POST['Submit']) && $_POST['Submit'] == "Add") 
                {

                    $this->form_validation->set_rules($this->validation_rules['allticketsAdd']);
                    if($this->form_validation->run())
                    {
                    
                        $post['ticket_code'] = $this->input->post('ticket_code');
                        $post['type'] = 'Open';
                        $post['status'] = 'open';
                        $post['departments_id'] = $this->input->post('departments_id'); 
                        $post['subject'] = $this->input->post('subject');
                        $post['reporter'] = $this->input->post('reporter');
                        $post['priority'] = $this->input->post('priority');
                        $post['permission'] = $this->input->post('permission');
                        $post['comment'] = $this->input->post('comment');
                        $tickets_id =  $this->tickets_model->addalltickets($post); 
                        if($tickets_id)
                        { 
                            if($_POST['permission'] == '0')
                            {
                                $permission_arr = $this->input->post('assigned_to');
                                if(sizeof($permission_arr) > 0)
                                {   
                                    for ($i=0; $i < count($permission_arr) ; $i++) 
                                    {                                       
                                        $post_permission['tickets_id'] = $tickets_id;
                                        $post_permission['user_id'] = $permission_arr[$i];
                                        $post_permission['permission_view'] = $this->input->post('view_'.$permission_arr[$i]);
                                        $post_permission['permission_edit'] = $this->input->post('edit_'.$permission_arr[$i]);
                                        $post_permission['permission_delete'] = $this->input->post('delete_'.$permission_arr[$i]);
                                        $post_permission['others_permission_status'] = 1;
                                        $post_permission['others_permission_created_date'] = date('Y-m-d');
                                        $post_permission['others_permission_update_date'] = date('Y-m-d');
                                        $this->tickets_model->addTicketsPermission($post_permission);
                                    }                               
                                }
                                
                            }   
                            if($_FILES["attachement"]['name'])
                                {                           
                                    $attachment_array = $_FILES["attachement"]["name"];
                                    for($k = 0; $k < count($attachment_array); $k++)
                                    {   
                                        $_FILES['new_file']['name'] = $_FILES['attachement']['name'][$k];
                                        $_FILES['new_file']['type'] = $_FILES['attachement']['type'][$k];
                                        $_FILES['new_file']['tmp_name'] = $_FILES['attachement']['tmp_name'][$k];
                                        $_FILES['new_file']['error'] = $_FILES['attachement']['error'][$k];
                                        $_FILES['new_file']['size'] = $_FILES['attachement']['size'][$k];
                                        $name = 'transaction_attechment';
                                        $imagePath = 'webroot/upload/tickets/';
                                        $temp = explode(".",$_FILES['new_file']['name']);               
                                        $extension = end($temp);
                                        $filenew =  date('d-M-Y').'_'.str_replace($_FILES['new_file']['name'],$name,$_FILES['new_file']['name']).'_'.time().''.rand(). "." .$extension;         
                                        $config['file_name'] = $filenew;
                                        $config['upload_path'] = $imagePath;
                                        //$config['allowed_types'] = 'GIF | gif | JPE | jpe | JPEG | jpeg | JPG | jpg | PNG | png | odt | pdf | sql | doc ';
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
                                            $post_img['attachement'] = $imagePath.''.$imageName;
                                            $post_img['tickets_id'] =  $tickets_id;
                                             $post_img['type'] =  'All';         
                                            $this->tickets_model->addTicketFile($post_img);
                                        }
                                    }

                                }
                            $msg = 'tickets added successfully!!';                 
                            $this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
                            redirect(base_url().'tickets/alltickets');
                        }
                    }
                    else
                    {               
                    
                        $this->data['role_list'] = $this->tickets_model->getRoleList();
                        $this->data['department_list'] = $this->tickets_model->getALLDepartment();
                        $this->data['user_list'] = $this->tickets_model->getALLUser();      
                        $this->data['role_list'] = $this->tickets_model->getRoleList();
                        $this->show_view_admin('admin/tickets/all_tickets_add', $this->data);
                    }       
                }
                else
                {       
                        $this->data['role_list'] = $this->tickets_model->getRoleList();
                        $this->data['department_list'] = $this->tickets_model->getALLDepartment();
                        $this->data['user_list'] = $this->tickets_model->getALLUser();      
                        $this->data['role_list'] = $this->tickets_model->getRoleList();
                        $this->show_view_admin('admin/tickets/all_tickets_add', $this->data);
                }
            }
            else
            {
                redirect( base_url().'dashboard/error/1');
            }
        }

   }

   /* Delete */
    public function deletealltickets()
    {
        if($this->checkDeletePermission())
        {
            $tickets_id = $this->uri->segment(3);   
            $this->tickets_model->deletealltickets($tickets_id);
            $msg = 'tickets remove successfully...!';
            $this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
            redirect(base_url().'tickets/alltickets');
            
        }
        else
        {
            redirect( base_url().'dashboard/error/1');
        }       
    }
    function changeAlltickets($status = '',$tickets_id='')
    {
          
          if($status != '' && $tickets_id != '')
        {

            $change_status = $this->tickets_model->changealltickets($status,$tickets_id);
            if($change_status)
            {
                redirect(base_url().'tickets/alltickets');
            }

        }
    }
//########### All Tickets Setting End  ##############



}
?>