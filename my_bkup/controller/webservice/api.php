<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Api extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('webservice/api_model');	
	}	

	public function login()
	{
    	$post['user_email'] = $_POST['email'];
    	$post['user_password'] = md5($_POST['password']);
    	$user_detail = $this->comman_model->getData('tbl_user',$post);
    	if(!empty($user_detail))
		{			
			echo json_encode(array("status"=>1,'user_details'=>$user_detail));
		}
		else
		{
			echo json_encode(array("status"=>0));
		}
	}

	public function logout()
	{	
		echo json_encode(array("status"=>1)); 
	}

	public function country()
	{
    	$country_list =  $this->comman_model->getData('tbl_country');
    	if (!empty($country_list))
    	{
    		echo json_encode(array("status" =>1, 'country_list'=> $country_list));
    	}
    	else
    	{
    		echo json_encode(array("status"=>0));
    	}
	}
	public function state()
	{
    	$state =  $this->comman_model->getData('tbl_state');
    	if (!empty($state))
    	{
    		echo json_encode(array("status" =>1, 'state'=> $state));
    	}
    	else
    	{
    		echo json_encode(array("status"=>0));
    	}
	}

	public function getLeadSource()
	{
		if(isset($_POST['sync_date_time']))
		{
			$sync_date_time = $_POST['sync_date_time'];
			if($sync_date_time == 0)
			{
				$res = $this->comman_model->getData('tbl_lead_source',NULL , 'multi' , NULL);	
			}
			else
			{
				$res = $this->comman_model->getData('tbl_lead_source', array('sync_date_time >' => $sync_date_time) , 'multi', NULL);
			}

			if(!empty($res))
			{
				echo json_encode(array("status"=>1, "tbl_lead_source"=>$res)); 
			}
			else
			{
				echo json_encode(array("status"=>0, "tbl_lead_source"=>array())); 
			}
		}
	}

	public function getLeadstatus()
	{
		if(isset($_POST['sync_date_time']))
		{
			$sync_date_time = $_POST['sync_date_time'];
			if($sync_date_time == 0)
			{
				$res = $this->comman_model->getData('tbl_lead_status',NULL , 'multi' , NULL);	
			}
			else
			{
				$res = $this->comman_model->getData('tbl_lead_status', array('sync_date_time >' => $sync_date_time) , 'multi', NULL);
			}

			if(!empty($res))
			{
				echo json_encode(array("status"=>1, "lead_status_list"=>$res)); 
			}
			else
			{
				echo json_encode(array("status"=>0, "lead_status_list"=>array())); 
			}
		}
	}

/*---------Leads Start-------------*/
	public function lead()
	{
		// sync_date_time
		if(isset($_POST['sync_date_time']))
		{
			$sync_date_time = $_POST['sync_date_time'];
			if($sync_date_time == 0)
			{
				$res = $this->comman_model->getData('tbl_leads',NULL,'multi',NULL);
			}
			else
			{
				$res = $this->comman_model->getData('tbl_leads', array('sync_date_time >' => $sync_date_time) , 'multi', NULL);
			}

			if(!empty($res))
			{
				echo json_encode(array("status"=>1, "lead_list"=>$res)); 
			}
			else
			{
				echo json_encode(array("status"=>0, "lead_list"=>array())); 
			}
		}

	}

	public function leadProcess()
	{
		// sync_date_time
		$leadProcess =  $this->comman_model->getData('tbl_leads_process');
    	if (!empty($leadProcess))
    	{
    		echo json_encode(array("status" =>1, 'lead_process_list'=> $leadProcess));
    	}
    	else
    	{
    		echo json_encode(array("status"=>0));
    	}
	}
	public function leadProcessDetail()
	{
		// sync_date_time
		$leadProcessDetail =  $this->comman_model->getData('tbl_leads_process_details');
    	if (!empty($leadProcessDetail))
    	{
    		echo json_encode(array("status" =>1, 'lead_process_detail_list'=> $leadProcessDetail));
    	}
    	else
    	{
    		echo json_encode(array("status"=>0));
    	}
	}

	public function leadMeeting()
	{
		// sync_date_time
		if(isset($_POST['sync_date_time']))
		{
			$sync_date_time = $_POST['sync_date_time'];
			if($sync_date_time == 0)
			{
				$res = $this->comman_model->getData('tbl_lead_meeting',NULL , 'multi' , NULL);	
			}
			else
			{
				$res = $this->comman_model->getData('tbl_lead_meeting', array('sync_date_time >' => $sync_date_time) , 'multi', NULL);
			}

			if(!empty($res))
			{
				echo json_encode(array("status"=>1, "lead_Meeting_list"=>$res)); 
			}
			else
			{
				echo json_encode(array("status"=>0, "lead_Meeting_list"=>array())); 
			}
		}

	}
/*---------Leads End-------------*/
/*---------Item Start-------------*/
	public function items()
	{
		// sync_date_time
		$item =  $this->comman_model->getData('tbl_items');
    	if (!empty($item))
    	{
    		echo json_encode(array("status" =>1, 'item_list'=> $item));
    	}
    	else
    	{
    		echo json_encode(array("status"=>0));
    	}
	}

	public function itemAttachment()
	{
		if(isset($_POST['sync_date_time']))
		{
			$sync_date_time = $_POST['sync_date_time'];
			if($sync_date_time == 0)
			{
				$res = $this->comman_model->getData('tbl_item_attachment',NULL , 'multi' , NULL);	
			}
			else
			{
				$res = $this->comman_model->getData('tbl_item_attachment', array('sync_date_time >' => $sync_date_time) , 'multi', NULL);
			}

			if(!empty($res))
			{
				echo json_encode(array("status"=>1, "item_attachment_list"=>$res));
			}
			else
			{
				echo json_encode(array("status"=>0, "item_attachment_list"=>array())); 
			}
		}
    }

    public function leadProduct()
	{
		// sync_date_time
		$leadProduct =  $this->comman_model->getData('tbl_lead_product');
    	if (!empty($leadProduct))
    	{
    		echo json_encode(array("status" =>1, 'lead_product_list'=> $leadProduct));
    	}
    	else
    	{
    		echo json_encode(array("status"=>0));
    	}
	}
/*---------item end-------------*/

/*---------Opportunities Start-------------*/
	public function opportunities()
	{
		// sync_date_time
		if(isset($_POST['sync_date_time']))
		{
			$sync_date_time = $_POST['sync_date_time'];
			if($sync_date_time == 0)
			{
				$res = $this->comman_model->getData('tbl_opportunities',NULL , 'multi' , NULL);	
			}
			else
			{
				$res = $this->comman_model->getData('tbl_opportunities', array('sync_date_time >' => $sync_date_time) , 'multi', NULL);
			}

			if(!empty($res))
			{
				echo json_encode(array("status"=>1, "opportunities_list"=>$res)); 
			}
			else
			{
				echo json_encode(array("status"=>0, "opportunities_list"=>array())); 
			}
		}

	}

	public function opportunitiesProcess()
	{
		// sync_date_time
		$opportunitiesProcess =  $this->comman_model->getData('tbl_opportunities_process');
    	if (!empty($opportunitiesProcess))
    	{
    		echo json_encode(array("status" =>1, 'oppo_process_list'=> $opportunitiesProcess));
    	}
    	else
    	{
    		echo json_encode(array("status"=>0));
    	}
	}

	public function opportunitiesProcessDetail()
	{
		// sync_date_time
		$oppoProcessDetail =  $this->comman_model->getData('tbl_opportunities_process_details');
    	if (!empty($oppoProcessDetail))
    	{
    		echo json_encode(array("status" =>1, 'oppo_process_detail_list'=> $oppoProcessDetail));
    	}
    	else
    	{
    		echo json_encode(array("status"=>0));
    	}
	}



/*---------Opportunities End-------------*/

/*---------User Start-------------*/
/*---------User End-------------*/


	public function showProfile()
	{
		$user_id = $_POST['user_id']; 
		$user_detail = $this->api_model->showProfile($user_id);
		if(!empty($user_detail))
		{
			echo json_encode(array("status"=>1, "user_detail"=>$user_detail)); 
		}
		else
		{
			echo json_encode(array("status"=>0)); 
		}
	}

	public function changePassword()
	{
		$post['user_id'] = $_POST['user_id'];       
		$post['user_password'] = $_POST['user_password'];  
		$post['user_updated_date'] = date('Y-m-d');
		$user_detail = $this->api_model->changePassword($post);

		if($user_detail == 'true')
		{
		  	echo json_encode(array("status"=>1));
		}
		else
		{
			echo json_encode(array("status"=>0));
		}
	}

	/* ==================== Company Meeting Api's =================== */

	public function syncCompanyDetails()
	{
		if(isset($_POST['last_sync_time']))
		{
			$offset = $_POST['offset'];
			$user_id = $_POST['user_id'];
			$last_sync_time = $_POST['last_sync_time'];
			if($last_sync_time == 0)
			{
				$res = $this->comman_model->getData('tbl_leads', array('create_by'=>$user_id) , 'multi' , NULL ,10 , $offset);	
			}
			else
			{
				$res = $this->comman_model->getData('tbl_leads', array('sync_date_time >' => $last_sync_time , 'create_by'=>$user_id) , 'multi' , NULL ,10, $offset);
			}

			if(!empty($res))
			{
				echo json_encode(array("status"=>1, "res"=>$res)); 
			}
			else
			{
				echo json_encode(array("status"=>0, "res"=>array())); 
			}
		}
    }

	public function addUpdateCompany()
	{	
		$rawData = file_get_contents("php://input");
		$st_data = json_decode($rawData);
		// print_r($st_data->data);die();
		$u_id_arr = array();
		if(!empty($st_data->data))
		{	
			foreach ($st_data->data as $val)
			{
				if(!empty($val))
				{
					$post['client_id'] = $val->user_id;
					$post['leads_id'] = $val->company_id;
					$post['company_name'] = $val->company_name;
					$post['address'] = $val->company_address;
					$post['contact_name'] = $val->concerne_person;
					$post['mobile'] = $val->contact_no;
					$post['email'] = $val->email;
					$post['status'] = $val->status;
					$check_res = $this->comman_model->getData('tbl_leads' , array('leads_id'=>$post['leads_id']) , 'single');
					if(!empty($check_res))
					{
						$this->comman_model->updateData('tbl_leads' , array('leads_id'=>$post['leads_id']) , $post);
						$u_id_arr[] = array('leads_id'=>$post['leads_id']);
					}
					else
					{
						$attendance_id_x = $this->comman_model->addData('tbl_leads' , $post);
						if($attendance_id_x)
						{
							$u_id_arr[] = array('leads_id'=>$post['leads_id']);
						}
					}
				}
			}
		}
		if(!empty($u_id_arr))
		{
			echo json_encode(array("status"=>1, "res"=>$u_id_arr)); 
		}
		else
		{
			echo json_encode(array("status"=>0, "res"=>array())); 
		}
	}

	public function AddCompanyAttachment()
	{
		//$company_id = $_GET['company_id'];
		//print_r($_REQUEST); die();
		if(!empty($_FILES['attachment_online']['name']))
		{
			//echo $_FILES['attachment_online']['name']; die();
			$name = 'attachment_online';
	      	$imagePath = 'webroot/upload/leads/';
	       	$temp = explode(".",$_FILES['attachment_online']['name']);
			$extension = end($temp);
			$filenew =  str_replace($_FILES['attachment_online']['name'],$name,$_FILES['attachment_online']['name']).'_'.time().''. "." .$extension;  		
			$config['file_name'] = $filenew;
			$config['upload_path'] = $imagePath;
			$this->upload->initialize($config);
			$this->upload->set_allowed_types('*');
			$this->upload->set_filename($config['upload_path'],$filenew);
			
			if(!$this->upload->do_upload('attachment_online'))
			{
				$data = array('msg' => $this->upload->display_errors());
			}
			else 
			{ 
				$data = $this->upload->data();	
				$imageName = $data['file_name'];
				
				if(!empty($imageName))
				{
					/*if($company_id != '')
					{
						$post['attachment_online'] = $imagePath.''.$imageName;
						$res = $this->comman_model->updateData('tbl_leads' , array('leads_id'=>$company_id) , $post);
						if($res)
						{
							echo json_encode(array("status"=>1, "res"=>$imagePath.''.$imageName)); 

						}
						else
						{
							echo json_encode(array("status"=>0, "res"=>array())); 
						}
					}*/
					//else
					//{
						echo json_encode(array("status"=>1, "res"=>$imagePath.''.$imageName)); 
					//}
				}
				else
				{
					echo json_encode(array("status"=>0, "res"=>array())); 
				}
			}
		}	
		else
		{
			echo json_encode(array("status"=>0, "res"=>array())); 
		}
	}

	/* ============================================================ */

	public function syncCompanyMeetingDetails()
	{
		if(isset($_POST['last_sync_time']))
		{
			$offset = $_POST['offset'];
			$user_id = $_POST['user_id'];
			$last_sync_time = $_POST['last_sync_time'];
			if($last_sync_time == 0)
			{
				$res = $this->comman_model->getData('tbl_company_meeting', array('client_id'=>$user_id) , 'multi' , 'cm_start_time' ,10, $offset);	
			}
			else
			{
				$res = $this->comman_model->getData('tbl_company_meeting', array('sync_date_time >' => $last_sync_time , 'client_id'=>$user_id) , 'multi' , 'cm_start_time',10 , $offset);
			}

			if(!empty($res))
			{
				echo json_encode(array("status"=>1, "res"=>$res)); 
			}
			else
			{
				echo json_encode(array("status"=>0, "res"=>array())); 
			}
		}
    }

	public function addUpdateCompanyMeeting()
	{	
		$rawData = file_get_contents("php://input");
		$st_data = json_decode($rawData);
		// print_r($st_data->data);die();
		$u_id_arr = array();
		if(!empty($st_data->data))
		{	
			foreach ($st_data->data as $val)
			{
				if(!empty($val))
				{
					$post['cm_id'] = $val->cm_id;
					$post['client_id'] = $val->user_id;
					$post['company_id'] = $val->company_id;
					$post['cm_date'] = $val->cm_date;
					$post['cm_start_time'] = $val->cm_start_time;
					$post['cm_end_time'] = $val->cm_end_time;
					$post['cm_start_lat'] = $val->cm_start_lat;
					$post['cm_start_lng'] = $val->cm_start_lng;
					$post['cm_end_lat'] = $val->cm_end_lat;
					$post['cm_end_lng'] = $val->cm_end_lng;
					$post['status'] = $val->status;
					$post['created_date'] = $val->created_date;
					$post['update_date'] = $val->update_date;
					$check_res = $this->comman_model->getData('tbl_company_meeting' , array('cm_id'=>$post['cm_id']) , 'single');
					if(!empty($check_res))
					{
						$this->comman_model->updateData('tbl_company_meeting' , array('cm_id'=>$post['cm_id']) , $post);
						$u_id_arr[] = array('cm_id'=>$post['cm_id']);
					}
					else
					{
						$attendance_id_x = $this->comman_model->addData('tbl_company_meeting' , $post);
						if($attendance_id_x)
						{
							$u_id_arr[] = array('cm_id'=>$post['cm_id']);
						}
					}
				}
			}
		}
		if(!empty($u_id_arr))
		{
			echo json_encode(array("status"=>1, "res"=>$u_id_arr)); 
		}
		else
		{
			echo json_encode(array("status"=>0, "res"=>array())); 
		}
	}


/* End of file */
}
?>