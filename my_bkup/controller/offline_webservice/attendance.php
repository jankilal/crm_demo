<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Attendance extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('offline_webservice/attendance_model');
	}
	
	
	/* Details */
	public function viewData()
	{
		$offset = $_POST['offset'];
		$user_id = $_POST['user_id'];
		$attendance_flag_date_time = $_POST['attendance_flag_date_time'];

		$res = $this->attendance_model->getAttendance($offset, $user_id, $attendance_flag_date_time);
		if(!empty($res))
		{
			echo json_encode(array("status"=>1, "res"=>$res)); 
		}
		else
		{
			echo json_encode(array("status"=>0, "res"=>'')); 
		}
    }

    public function addUpdateData()
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
					$post['attendance_id'] = $val->attendance_id; 
					$post['user_id'] = $val->user_id; 
					$post['attendance_login_time'] = $val->attendance_login_time; 
					$post['attendance_logout_time'] = $val->attendance_logout_time; 
					$post['attendance_date'] = $val->attendance_date; 
					$post['attendance_login_lat'] = $val->attendance_login_lat; 
					$post['attendance_login_long'] = $val->attendance_login_long; 
					$post['attendance_logout_lat'] = $val->attendance_logout_lat; 
					$post['attendance_logout_long'] = $val->attendance_logout_long;
					$post['attendance_status'] = $val->attendance_status; 
					$post['created_date'] = $val->attendance_created_date; 
					$post['update_date'] = $val->attendance_update_date; 
					
					$check_res = $this->attendance_model->checkData($post['attendance_id']);
					if(!empty($check_res))
					{
						$this->attendance_model->updateData($post);
						$u_id_arr[] = array('attendance_id'=>$post['attendance_id']);
					}
					else
					{
						$attendance_id_x = $this->attendance_model->addData($post);
						if($attendance_id_x)
						{
							$u_id_arr[] = array('attendance_id'=>$post['attendance_id']);
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
			echo json_encode(array("status"=>0, "res"=>'')); 
		}
    }


    public function getResponseAddUpdateData()
    {
    	$rawData = file_get_contents("php://input");
		$st_data = json_decode($rawData);
		$u_id_arr = array();
		if(!empty($st_data->data))
		{
			foreach ($st_data->data as $val) 
			{
				if(!empty($val))
				{
					$post['attendance_action_status'] = '1';
					$post['attendance_id'] = $val->id;
					$this->attendance_model->updateData($post);
					$u_id_arr[] = array('attendance_id'=>$post['attendance_id']); 
				}
			}
		}
		if(!empty($u_id_arr))
		{
			echo json_encode(array("status"=>1, "res"=>$u_id_arr)); 
		}
		else
		{
			echo json_encode(array("status"=>0, "res"=>'')); 
		}
    }
}

/* End of file */?>