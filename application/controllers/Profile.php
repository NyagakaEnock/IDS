<?php
class Profile extends CI_Controller 
{

        public function __construct()
        {
                parent::__construct();
                $this->load->model('profile_model');
                $this->load->helper('url_helper');
        }

        public function index()
        {
				$data['request'] = $this->profile_model->get_requestDetails();
				$this->load->view('templates/header', $data);
				$this->load->view('templates/navigation', $data);
				$this->load->view('templates/profile', $data);
				$this->load->view('templates/footer', $data);
				//$this->settings();
        }

		

}