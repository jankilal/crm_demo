<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class SampleRequest extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('opportunities_model');
	}	

	public function index()
	{
		
		// $this->data['request_details'] = $this->comman_model->getData('tbl_sample_request', $id);
		$this->data['request_details'] = $this->opportunities_model->getAllSampleRequests();
		// print_r($this->data['request_details']);
		$this->show_view_admin('opportunities/sample_request',$this->data);
	}

	public function changeApproveStatus($id = '',$status = '')
	{
		if($id != '' && $status != '')
		{
			// $request_details = $this->opportunities_model->getSampleRequestsById($id);
			$change_res = $this->comman_model->updateData('tbl_sample_request', array('id'=> $id) , array('approve_status'=> $status));
			if($change_res)
			{
				$msg = 'Request approve status update successfully..!';
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect('sampleRequest');
			}
		}
		else
		{
			redirect('sampleRequest');
		}
	}

	public function editSampleRequest($id='')
	{
		if($id != '')
		{
			if(isset($_POST['Submit']) && $_POST['Submit'] == 'Edit')
		   {				
				$approve_status = $this->input->post('approve_status');
				$delivery_date = $this->input->post('delivery_date');				
				$request_details = $this->opportunities_model->getSampleRequestsById($id);
				// $json_to_array = json_decode($request_details->sample_request);
				// $json_to_array->approve_status = $approve_status;
				// $json_to_array->delivery_date = $delivery_date;
				// $post['sample_request'] = json_encode($json_to_array);
				$post['product_details'] = $this->input->post('product_details');
				$change_res = $this->opportunities_model->changeApproveStatus($post,$id);
				if($change_res)
				{
					$msg = 'Request update successfully..!';
					$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
					redirect('sampleRequest');
				}
			}
			$this->data['request_details'] = $this->opportunities_model->getAllSampleRequests($id);
			$this->show_view_admin('opportunities/sample_request_update', $this->data);
		}
		else
		{
			redirect('sampleRequest');
		}
	}

	public function deleteSampleRequest($id='')
	{
		if($id != '')
		{		
			$post['sample_request'] = NULL;
			$change_res = $this->opportunities_model->changeApproveStatus($post,$id);
			if($change_res)
			{
				$msg = 'Request deleted successfully..!';
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect('sampleRequest');
			}
		}
		else
		{
			redirect('sampleRequest');
		}
	}
}
/* End of file */?>