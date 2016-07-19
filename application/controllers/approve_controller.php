<?php
class Approvecontroller extends CI_Controller 
{

        public function __construct()
        {
                parent::__construct();
                $this->load->model('approve_model');
                $this->load->helper('url_helper');
        }

        public function index()
        {
				$data['request'] = $this->approve_model->get_requestDetails();
				$this->load->view('templates/header', $data);
				$this->load->view('templates/navigation', $data);
				$this->load->view('templates/approve', $data);
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
					if($this->approve_model->saveRequest()){
					echo "Record Saved Successfully";
					}
		
			}
		}

		

}