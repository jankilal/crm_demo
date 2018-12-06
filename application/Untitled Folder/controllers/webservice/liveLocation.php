<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class LiveLocation extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('webservice/livelocation_model');
	}
	
	
	/* Details */
	public function viewData()
	{
		$offset = $_POST['offset'];
		$user_id = $_POST['user_id'];
		$location_flag_date_time = $_POST['location_flag_date_time'];

		$res = $this->livelocation_model->getLiveLocation($offset, $user_id, $location_flag_date_time);
		if(!empty($res))
		{
			echo json_encode(array("status"=>1, "data"=>$res)); 
		}
		else
		{
			echo json_encode(array("status"=>0, "data"=>array())); 
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
					$post['location_id'] = $val->location_id; 
					$post['user_id'] = $val->user_id; 
					$post['location_lat'] = $val->location_lat; 
					$post['location_long'] = $val->location_long; 
					$post['location_date_time'] = $val->location_date_time; 
					// $post['user_all_level'] = $val->user_all_level; 
					$post['location_flag_date_time'] = $val->location_flag_date_time; 
					// $post['location_action'] = $val->location_action; 
					$post['location_status'] = $val->location_status; 
					// $post['location_action_status'] = '1'; 
					$check_res = $this->livelocation_model->checkData($post['location_id']);
					if(!empty($check_res))
					{
						$this->livelocation_model->updateData($post);
						$u_id_arr[] = array('location_id'=>$post['location_id']);
					}
					else
					{
						$location_id_x = $this->livelocation_model->addData($post);
						if($location_id_x)
						{
							$u_id_arr[] = array('location_id'=>$post['location_id']);
						}
					}
					
				}
			}
		}
		if(!empty($u_id_arr))
		{
			echo json_encode(array("status"=>1, "data"=>$u_id_arr)); 
		}
		else
		{
			echo json_encode(array("status"=>0, "data"=>array())); 
		}
    }


    public function getResponseAddUpdateData()
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
					// $post['location_action_status'] = '1';
					$post['location_id'] = $val->id;

					$this->livelocation_model->updateData($post);
					$u_id_arr[] = array('location_id'=>$post['location_id']); 
				}
			}
		}
		if(!empty($u_id_arr))
		{
			echo json_encode(array("status"=>1, "data"=>$u_id_arr)); 
		}
		else
		{
			echo json_encode(array("status"=>0, "data"=>array())); 
		}
    }
}

/* End of file */?>