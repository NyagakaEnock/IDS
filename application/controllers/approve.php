<?php
class Reports extends CI_Controller 
{

        public function __construct()
        {
                parent::__construct();
               // $this->load->model('approve_model');
                $this->load->helper('url_helper');
				
        }

        public function index()
        {
				$this->load->view('templates/header');
				$this->load->view('templates/navigation');
				$this->load->view('templates/invoiceprocessing_view');
				$this->load->view('templates/footercontent');
				$this->load->view('templates/footer');
		}else{
				 $this->load->view('templates/header');
				 $this->load->view('templates/login');
				 $this->load->view('templates/footercontent');
				  $this->load->view('templates/footer');
				}	
				
        }
		
		
		

}