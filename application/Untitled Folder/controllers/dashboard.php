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
			 $this->data['leads'] = $this->comman_model->getData('tbl_leads',array('current_status'=> 1) ,'count');
			 $this->data['opportunities'] = $this->comman_model->getData('tbl_leads', array('current_status'=> 2) ,'count');
			 $this->data['client'] = $this->comman_model->getData('tbl_leads', array('current_status'=> 3) ,'count');
			 $this->data['sampleRequest'] = $this->comman_model->getData('tbl_sample_request',Null ,'count');
			 $this->data['quotation'] = $this->comman_model->getData('tbl_quotation', Null ,'count');
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