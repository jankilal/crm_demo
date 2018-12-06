<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('dashboard_model');
		$this->load->helper('admin_helper');		
	}
	
	/* Dashboard Show */
	public function index($action = NULL)
	{
		if($this->checkSessionAdmin())
		{    
			$lead_arr['current_status']=1;
			$opp_arr['current_status']=2;
			$client_arr['current_status']=3;
			 if (login_role == '1') 
			 {
					 $this->data['leads'] = $this->comman_model->getData('tbl_leads',$lead_arr ,'count');
					 $this->data['opportunities'] = $this->comman_model->getData('tbl_leads', $opp_arr ,'count');
					 $this->data['client'] = $this->comman_model->getData('tbl_leads', $client_arr ,'count');
					 $this->data['sampleRequest'] = $this->comman_model->getData('tbl_sample_request',NULL ,'count');
					 $this->data['quotation'] = $this->comman_model->getData('tbl_quotation', NULL ,'count');
			 }
			 else
			 {


			 	
			 	 $this->data['leads'] = $this->dashboard_model->getAllcountinglead(login_user);
			 	 $this->data['opportunities'] = $this->dashboard_model->getAllcountingopp(login_user);
			 	 $this->data['client'] = $this->dashboard_model->getAllcountingclient(login_user);
			 	 $this->data['sampleRequest'] = $this->dashboard_model->getAllcountingsamplerequest(login_user);
			 	 $this->data['quotation'] = $this->dashboard_model->getAllcountingquotation(login_user);






                               

			 }
			
	        $this->show_view_admin('admin/dashboard', $this->data);
		}
		else
		{
			redirect('admin/dashboard/error/1');
		}
    }

	/* Dashboard Show */
	public function error()
	{	
		$value = $this->uri->segment(4);
		$error_msg = $this->uri->segment(5);
		if($value == '1')
		{
			$this->data['error_msg'] = $error_msg;
			$this->show_view_admin('admin/error/error_permission', $this->data);
		}		
    }


}

/* End of file */?>