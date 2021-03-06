<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class EmployeeDayReport extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('report_model');
	}	

	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{
			$this->data['employee_list'] = $this->comman_model->getData('tbl_user' , array('user_role_id' => 3 , 'user_type' => 'Employee'));
			$getData = $this->input->get();
			if(isset($getData['search']) && $getData['search'] == 'search-report')
			{
				$this->data['day_wise_list'] = $this->report_model->getDayWiseReport();
				$this->data['expenses_report'] = $this->report_model->getDayWiseExpenses();
				$this->data['total_meetings'] = $this->report_model->getDayWiseMeeting();
				$this->data['done_meetings'] = $this->report_model->getDayWiseMeeting('Done');
				$this->data['pending_meetings'] = $this->report_model->getDayWiseMeeting('Pending');
			}
			else
			{
				$this->data['day_wise_list'] = array();	
			}
			$this->show_view_admin('report/employee_day_report_view', $this->data);
		}
		else
		{	
			redirect(base_url().'dashboard/error/1');
		}
    }
}
/* End of file */?>