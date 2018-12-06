<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class AttendanceReport extends MY_Controller 
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
			if(isset($_GET['employee']) && $_GET['employee'])
			{
				$this->data['attendance_list'] = $this->comman_model->getData('tbl_attendance' , array('attendance_status' => '1' , 'user_id' => $_GET['employee']));
			}
			else
			{
				$this->data['attendance_list'] = $this->comman_model->getData('tbl_attendance' , array('attendance_status' => '1'));
			}
			$this->show_view_admin('report/attendance_report_view', $this->data);
		}
		else
		{	
			redirect(base_url().'dashboard/error/1');
		}
    }

    public function meetingDetails($id)
    {
    	$res = $this->comman_model->getData('tbl_attendance' , array('attendance_id' => $id) , 'single');
		if(!empty($res))
		{
			$this->data['attendance_dtl'] = $res;
			$this->data['employee_dtl'] = $this->comman_model->getData('tbl_user' , array('user_id' => $res->user_id) , 'single');
			$this->data['meeting_list'] = $this->report_model->getEmpMeetingByDate($res->user_id , $res->attendance_date);
			$this->show_view_admin('report/meeting_details_view' , $this->data);
		}
		else
			redirect('attendanceReport');
    }
	
	public function expensesDetails($id , $attendance_date)
    {
    	$this->data['expenses_list'] = $this->comman_model->getData('tbl_expenses' , array('user_id' => $id , 'expenses_date' => $attendance_date));
    	$this->show_view_admin('report/expenses_report_view' , $this->data);
    }
}
/* End of file */?>