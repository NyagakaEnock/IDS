<?php
class Request extends CI_Controller 
{

        public function __construct()
        {
                parent::__construct();
                $this->load->model('request_model');
				
                $this->load->helper('url_helper');
        }

        public function index()
        {
				$data['request'] = $this->request_model->get_requestDetails();
				$data['rejectedrequest'] = $this->request_model->get_rejectedrequestDetails();
				$data['pendingrequest'] = $this->request_model->get_pendingrequestDetails();
				$data['approvedrequest'] = $this->request_model->get_approvedrequestDetails();
				$this->load->view('templates/header', $data);
				$this->load->view('templates/navigation', $data);
				$this->load->view('templates/requests', $data);
				$this->load->view('templates/footer', $data);
				
        }
		
						public function createRequest()
		{
			$this->form_validation->set_rules('request', 'Request', 'required',array('required' => 'Please select a %s.'));
			$this->form_validation->set_rules('requestDescription', 'Request Description', 'required',array('required' => 'Please provide a %s.'));
			if ($this->form_validation->run() == FALSE)
                {
                       echo "<font color='red' size='1%'>".validation_errors()."</font>";
					  
                }else
				{
					if($this->request_model->saveRequest()){
					echo "Record Saved Successfully";
					}
		
			}
		}

		

}