<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class companyDetails extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('settings/company_details_model');
	}	
	/*	Validation Rules */
	 protected $validation_rules = array
        (
        
		'companyAddEdit' => array(
        	
            array(
                'field' => 'company_name',
                'label' => ' Company name',
                'rules' => 'trim|required'
            ),			
			array(
                'field' => 'company_legal_name',
                'label' => 'Company Legal name',
                'rules' => 'trim|required'
            ),            	
            array(
                'field' => 'contact_person',
                'label' => 'Company Contact',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'company_address',
                'label' => 'Company Address',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'company_country_id',
                'label' => 'Company Country',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'company_state_id',
                'label' => 'Company State',
                'rules' => 'trim|required'
            ),           
            array(
                'field' => 'company_city',
                'label' => 'Company City',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'company_zip_code',
                'label' => 'Company Zip Code',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'company_phone',
                'label' => 'Company Phone',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'company_email',
                'label' => 'Company Email',
                'rules' => 'trim|required'
            ), 
            array(
                'field' => 'company_website',
                'label' => 'Company Website',
                'rules' => 'trim|required'
            ),             
        )
    );
	
	
	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{			
			
			if($this->checkEditPermission())
			{
			
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit" || isset($_POST['Submit']) && $_POST['Submit'] == "Add" ) 
				{	
					
					$this->form_validation->set_rules($this->validation_rules['companyAddEdit']);
					if($this->form_validation->run())
					{	

						$post['company_name'] = $this->input->post('company_name');
						$post['company_legal_name'] = $this->input->post('company_legal_name');
						$post['company_contact_person'] = $this->input->post('contact_person');						
						$post['company_address'] = $this->input->post('company_address');
						$post['company_country_id'] = $this->input->post('company_country_id');						
						$post['company_state_id'] = $this->input->post('company_state_id');
						$post['company_city'] = $this->input->post('company_city');
						$post['company_zip_code'] = $this->input->post('company_zip_code');
						$post['company_email'] = $this->input->post('company_email');
						$post['company_phone'] = $this->input->post('company_phone');	
						$post['company_website'] = $this->input->post('company_website');	
						$post['company_vat'] = $this->input->post('company_vat');

						if(isset($_POST['Submit']) && $_POST['Submit'] == 'Edit')
						{
							$user_id = $this->data['user_id'];
							$comp_res =  $this->company_details_model->updateAdminCompanyDetails($post,$user_id);
							if($comp_res)
							{										
								$msg = 'Company Update successfully!';					
								$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
								redirect(base_url().'companyDetails');
							}		
						}
						else 
						{
							$post['user_id'] = $this->data['user_id'];
							$comp_res =  $this->company_details_model->addAdminCompanyDetails($post);
							if($comp_res)
							{		
										
								$msg = 'Company Details Add successfully!';					
								$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
								redirect(base_url().'companyDetails');
							}	
						}
						

					}
					else
					{				

						$this->data['company_details'] = $this->company_details_model->getCompanyDetailsById($this->data['user_id']);

						$this->data['country_list'] = $this->company_details_model->getCountryList();								
						$this->show_view_admin('admin/settings/company_details', $this->data);
					}		
				}
				else
				{

					$this->data['company_details'] = $this->company_details_model->getCompanyDetailsById($this->data['user_id']);
					$this->data['country_list'] = $this->company_details_model->getCountrylist();

					$this->show_view_admin('admin/settings/company_details', $this->data);

				}
			}
			else
			{
				redirect( base_url().'dashboard/error/1');
			}
		}
		else
		{	
			redirect(base_url().'dashboard/error/1');
		}
    }

	/* Get State List */
	public function getStateList()
	{
		$country_id = $this->input->post('country_id');
		$state_list = $this->company_details_model->getStateListByCountryId($country_id);

		$html = '';
		if(count($state_list) > 0)
		{
			foreach ($state_list as $s_list) 
			{
				$html .= '<option value="'.$s_list->state_id.'">'.$s_list->state_name.'</option>';
			}
			
			echo $html; 
		}
		else
		{
			echo $html;
		}
	}

}
/* End of file */?>