<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class WebView extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
	}
	
	
	/* Details */
	public function viewAllData()
	{
		$post['user_email'] = $_GET['user_email'];
		$post['user_password'] = md5($_GET['user_password']);
		$segment = $_GET['segment'];
		$user_details = $this->comman_model->getData('tbl_user',$post);
		if(!empty($user_details))
		{
			$this->session->set_userdata($user_details);
			$this->session->set_userdata('app_web_view', 'CRM_WEB_VIEW_TRUE');
			if($segment == 'leads')
			{
				redirect('leads');
			}
			elseif($segment == 'knowledgebase')
			{
				redirect('leads/addleads');
			}
			elseif($segment == 'leads/processDetails/')
			{
				redirect('leads/processDetails/');
			}
			elseif($segment == 'labdata')
			{
				redirect('admin/labData');
			}
			elseif($segment == 'chat')
			{
				redirect('admin/chat');
			}
			elseif($segment == 'referralcentermonthly')
			{
				redirect('admin/referralCenterMonthly');
			}
		}
		else
		{
			
		}
    }

  
}

/* End of file */?>