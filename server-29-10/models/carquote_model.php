<?php

class Carquote_model extends CI_Model {

    public $_table_name;
    public $_order_by;
    public $_primary_key;

    function task_spent_time_by_id($task_id) {
        $total_time = "SELECT start_time,end_time,end_time - start_time time_spent 
						FROM tbl_tasks_timer WHERE task_id = '$task_id'";
        $result = $this->db->query($total_time)->result();
        $time_spent = array();
        foreach ($result as $time) {
            $time_spent[] = $time->time_spent;
        }
        if (is_array($time_spent)) {
            return array_sum($time_spent);
        } else {
            return 0;
        }
    }

    


     public function addPersonalInformation($post){

            $this->db->insert('tbl_personal_info', $post);
            $this->result = $this->db->insert_id() ; 
            return $this->result;
     }

     public function addCarInformation($post){

            $this->db->insert('tbl_car_info', $post);
            $this->result = $this->db->insert_id() ; 
            return $this->result;
     }

     public function addVhicalProtection($post){

            $this->db->insert('tbl_vehicle_protection', $post);
            $this->result = $this->db->insert_id() ; 
            return $this->result;
     }

     public function addDriverInformation($post){

            $this->db->insert('tbl_driver_info', $post);

            $this->result = $this->db->insert_id() ; 
            return $this->result;
     }

     public function addVhicalClaim($post){

            $this->db->insert('tbl_vehicle_claim', $post);
            
            $this->result = $this->db->insert_id() ; 
            return $this->result;
     }

     public function addInsuranceInformation($post){

            $this->db->insert('tbl_insurance_info', $post);
            $this->result = $this->db->insert_id() ; 
            return $this->result;
     }

     public function GetPersonalProfileById($user_id)
     {
            $this->db->select('*');
            $this->db->from('tbl_personal_info');
            $this->db->where('user_id', $user_id);  
            $query = $this->db->get();      
            return $query->result();
     }
     public function GetCarInfoById($personal_info_id)
     {
            $this->db->select('*');
            $this->db->from('tbl_car_info');
            $this->db->where('personal_info_id', $personal_info_id);  
            $query = $this->db->get();      
            return $query->result();
     }
     
     public function GetDriverInfoById($personal_info_id)
     {
            $this->db->select('*');
            $this->db->from('tbl_driver_info');
            $this->db->where('personal_info_id', $personal_info_id);  
            $query = $this->db->get();      
            return $query->result();
     }
     
     public function GetVehicleClaimById($personal_info_id)
     {
            $this->db->select('*');
            $this->db->from('tbl_vehicle_claim');
            $this->db->where('personal_info_id', $personal_info_id);  
            $query = $this->db->get();      
            return $query->result();
     }
     
     public function GetVehicleProtactionById($personal_info_id)
     {
            $this->db->select('*');
            $this->db->from('tbl_vehicle_protection');
            $this->db->where('personal_info_id', $personal_info_id);  
            $query = $this->db->get();      
            return $query->result();
     }

     public function GetInsuranceInfoById($personal_info_id)
     {
            $this->db->select('*');
            $this->db->from('tbl_insurance_info');
            $this->db->where('personal_info_id', $personal_info_id);  
            $query = $this->db->get();      
            return $query->result();
     }

 
    public function removeUserDetails($pp_id){

            $this->db->delete('tbl_car_info', array('personal_info_id' => $pp_id));
            $this->db->delete('tbl_vehicle_claim', array('personal_info_id' => $pp_id));  
            $this->db->delete('tbl_vehicle_protection', array('personal_info_id' => $pp_id));
            $this->db->delete('tbl_driver_info', array('personal_info_id' => $pp_id)); 
            $this->db->delete('tbl_insurance_info', array('personal_info_id' => $pp_id));       
            $this->db->delete('tbl_personal_info', array('personal_info_id' => $pp_id));       
            return 1;
    }


}
