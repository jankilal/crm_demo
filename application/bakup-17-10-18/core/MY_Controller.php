<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->data['session'] = $this->session->userdata('web_admin');
		$this->load->helper('language');
		$this->load->model('home_model');
		$this->load->model('dashboard_model');
		$session = $this->session->userdata('web_admin');
		$user_id = '';
		$user_role_id = '';
		$user_type = '';
		if(!empty($session) && $session->user_id != '')
		{
			$user_id = $session->user_id;
			$user_role_id = $session->user_role_id;
			$user_type = $session->user_type;
		}
		define('login_user', $user_id);
		define('login_role', $user_role_id);
		define('login_type', $user_type);
	}
	
	/* load the view files admin */
	public function show_view_admin($view, $data = '') 
	{    		
		if($this->checkSessionAdmin())
		{		
			$data['welcome']	=	$this; 
			$role_id = login_role;	
			$data['getAllTabAsPerRole'] = $this->home_model->getAllTabAsPerRole($role_id);
			$this->load->view('header');
			$this->load->view('sidebar',$data);
			$this->load->view($view, $data);
			$this->load->view('footer');
		}
		else
		{
			redirect(base_url());
		}
    }
		
	/*	Check Session Admin */
	public function checkSessionAdmin() 
	{
		$session = $this->session->userdata('web_admin');
		if(empty($session->user_id))
		{
			return false;		
		}
		if(isset($session) && !empty($session))
		{
            $this->user = $session->user_name;
            $this->email = $session->user_email;
			$this->user_id = $session->user_id;
			$this->role_id = $session->user_role_id;
			return true;
        }		
	}
	
	/* Check tab Permissions */
	/* View */
	public function checkViewPermission()
	{
		if(!$this->checkSessionAdmin()){
			redirect(base_url());
		}
		$session = $this->session->userdata('web_admin');
		if(isset($session) && $session->user_id != '')
		{
			$role_id = $session->user_role_id;
			$TabAsPerRole = $this->home_model->getAllTabAsPerRole($role_id);
			foreach($TabAsPerRole as $tab_list)
			{
				if($tab_list->controller_name == $this->uri->segment(1))
				{
					if($tab_list->userView == '1')
					{					
						return true;
					}
					else
					{						
						return false;
					}
				}
			}
		}
		else
		{
			redirect(base_url());
		}
	}
	/* Add */
	public function checkAddPermission()
	{
		if(!$this->checkSessionAdmin()){
			redirect(base_url());
		}

		$session = $this->session->userdata('web_admin');	
		$role_id = $session->user_role_id;
		$TabAsPerRole = $this->home_model->getAllTabAsPerRole($role_id);

		foreach($TabAsPerRole as $tab_list)
		{
			if($tab_list->controller_name == $this->uri->segment(1))
			{
				if($tab_list->userAdd == '1')
				{
					return true;
				}
				else
				{
					return false;
				}
			}
		}
	}
	/* Edit */
	public function checkEditPermission()
	{
		if(!$this->checkSessionAdmin()){
			redirect(base_url());
		}

		$session = $this->session->userdata('web_admin');	
		$role_id = $session->user_role_id;
		$TabAsPerRole = $this->home_model->getAllTabAsPerRole($role_id);

		foreach($TabAsPerRole as $tab_list)
		{
			if($tab_list->controller_name == $this->uri->segment(1))
			{
				if($tab_list->userEdit == '1')
				{
					return true;
				}
				else
				{
					return false;
				}
			}
		}
	}	
	/* Delete */
	public function checkDeletePermission()
	{
		if(!$this->checkSessionAdmin()){
			redirect(base_url());
		}
		
		$session = $this->session->userdata('web_admin');	
		$role_id = $session->user_role_id;
		$TabAsPerRole = $this->home_model->getAllTabAsPerRole($role_id);

		foreach($TabAsPerRole as $tab_list)
		{
			if($tab_list->controller_name == $this->uri->segment(1))
			{
				if($tab_list->userDelete == '1')
				{
					return true;
				}
				else
				{
					return false;
				}
			}
		}
	}	
	/* END check permission */




	/*	Mail Send */
	public function send_mail($email, $subject, $message)	
	{		
		$config = array(	
			'protocol' => 'SMTP',			
			'smtp_host' => 'tls://smtp.gmail.com',		
			'smtp_port' => 465,				
			'smtp_user' => 'arvind.sixthsense@gmail.com', 	
			'smtp_pass' => 'arvind@123', 			
			'mailtype' => 'html',			
			'charset' => 'iso-8859-1',			
			'wordwrap' => TRUE,				
			'charset'  => 'utf-8',			
			'priority' => '1',	
		);	
		$this->load->library('email',$config);	
		$this->email->set_newline("\n");	
		$this->email->from('arvind.sixthsense@gmail.com', "Sixth Sense");	
		$this->email->to($email);  	
		$this->email->subject($subject);	
		$this->email->message($message);
		return $this->email->send();
	}
	
	
	/* send push notification */
	public function sendPushNotification($device_id, $message, $title)
	{		
		$to      = array($device_id);
		define( 'API_ACCESS_KEY', 'AIzaSyDjVzaw6vlmI_IzMYOAdT6c0MB99cUsg6c');
		$img_url = 'http://cdn2.thr.com/sites/default/files/2012/12/img_logo_blue.jpg';
		$registrationIds = $to;
		$msg = array(
			'message' => $message,
			'title' => $title,
			'vibrate' => 1,
			'sound' => 1,
			'image'=>$img_url
		);
		$fields = array(
			'registration_ids' => $registrationIds,
			'data' => $msg
		);
		$headers = array(
				'Authorization: key=' . API_ACCESS_KEY,
				'Content-Type: application/json'
			);
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		curl_close( $ch );
		//echo $result;
	}

	/* Upload Image */
	public function ImageUpload($filename, $name, $imagePath, $fieldName)
	{
		$temp = explode(".",$filename);
		$extension = end($temp);
		$filenew =  time().'_'.str_replace($filename,$name,$filename)."." .$extension;  		
		$config['file_name'] = $filenew;
		$config['upload_path'] = $imagePath;
		$config['allowed_types'] = 'GIF | gif | JPE | jpe | JPEG | jpeg | JPG | jpg | PNG | png';
		$this->upload->initialize($config);
		$this->upload->set_allowed_types('*');
		$this->upload->set_filename($config['upload_path'],$filenew);
		
		if(!$this->upload->do_upload($fieldName))
		{
			$data = array('msg' => $this->upload->display_errors());
		}
		else 
		{ 
			$data = $this->upload->data();	
			$imageName = $data['file_name'];			
			return $imageName;
		}		
	}

	function loadPo($word) 
	{
		$sess=$this->session->userdata('web_admin');
		if(isset($sess['lng'])){
			$filename='language/'.$sess['lng'].'.po';
		}else{
			$filename='language/eng.po'; 
		}
		if (!$file = fopen($filename, 'r')){
			return false;
		}
		$type = 0;
		$translations = array();
		$translationKey = '';
		$plural = 0;
		$header = '';
			do {
			$line = trim(fgets($file));
			if ($line === '' || $line[0] === '#') {
				continue;
			}
			if (preg_match("/msgid[[:space:]]+\"(.+)\"$/i", $line, $regs)) {
				$type = 1;
				$translationKey = stripcslashes($regs[1]);
			} elseif (preg_match("/msgid[[:space:]]+\"\"$/i", $line, $regs)) {
				$type = 2;
				$translationKey = '';
			} elseif (preg_match("/^\"(.*)\"$/i", $line, $regs) && ($type == 1 || $type == 2 || $type == 3)) {
				$type = 3;
				$translationKey .= stripcslashes($regs[1]);
			} elseif (preg_match("/msgstr[[:space:]]+\"(.+)\"$/i", $line, $regs) && ($type == 1 || $type == 3) && $translationKey) {
				$translations[$translationKey] = stripcslashes($regs[1]);
				$type = 4;
			} elseif (preg_match("/msgstr[[:space:]]+\"\"$/i", $line, $regs) && ($type == 1 || $type == 3) && $translationKey) {
				$type = 4;
				$translations[$translationKey] = '';
			} elseif (preg_match("/^\"(.*)\"$/i", $line, $regs) && $type == 4 && $translationKey) {
				$translations[$translationKey] .= stripcslashes($regs[1]);
			} elseif (preg_match("/msgid_plural[[:space:]]+\".*\"$/i", $line, $regs)) {
				$type = 6;
			} elseif (preg_match("/^\"(.*)\"$/i", $line, $regs) && $type == 6 && $translationKey) {
				$type = 6;
			} elseif (preg_match("/msgstr\[(\d+)\][[:space:]]+\"(.+)\"$/i", $line, $regs) && ($type == 6 || $type == 7) && $translationKey) {
				$plural = $regs[1];
				$translations[$translationKey][$plural] = stripcslashes($regs[2]);
				$type = 7;
			} elseif (preg_match("/msgstr\[(\d+)\][[:space:]]+\"\"$/i", $line, $regs) && ($type == 6 || $type == 7) && $translationKey) {
				$plural = $regs[1];
				$translations[$translationKey][$plural] = '';
				$type = 7;
			} elseif (preg_match("/^\"(.*)\"$/i", $line, $regs) && $type == 7 && $translationKey) {
				$translations[$translationKey][$plural] .= stripcslashes($regs[1]);
			} elseif (preg_match("/msgstr[[:space:]]+\"(.+)\"$/i", $line, $regs) && $type == 2 && !$translationKey) {
				$header .= stripcslashes($regs[1]);
				$type = 5;
			} elseif (preg_match("/msgstr[[:space:]]+\"\"$/i", $line, $regs) && !$translationKey) {
				$header = '';
				$type = 5;
			} elseif (preg_match("/^\"(.*)\"$/i", $line, $regs) && $type == 5) {
				$header .= stripcslashes($regs[1]);
			} else {
				unset($translations[$translationKey]);
				$type = 0;
				$translationKey = '';
				$plural = 0;
			}
		} while (!feof($file));
		fclose($file);
		$merge[''] = $header;
		$translations= array_merge($merge, $translations);
		if (array_key_exists($word,$translations)){
			return $translations[$word];
		}else{
			return $word;
		}
	}

	public function generateUnicId($id,$action = '')
	{
		if($action == 'car_quote')
		{
			return $unic_req_id = 'CQR-'.substr(mt_rand(),0,3).'-'.substr(mt_rand(),0,2).'-'.$id;
		}
		if($action == 'client_unic_id')
		{
			return $unic_req_id = 'CDF-'.substr(mt_rand(),0,3).'-'.substr(mt_rand(),0,2).'-'.$id;
		}
	}
	public function generate_id()
	{
		$id=  rand(round(microtime(true) * 1000) , 15);

		return $id =($id < 0)? $id+1: $id;
	}	
}
?>