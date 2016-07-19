<?php
class Setup extends CI_Controller 
{
		
        public function __construct()
        {
				
                parent::__construct();
                $this->load->model('setup_model');
				$GLOBALS['userName'] = NULL;
                $this->load->helper('url_helper');
        }

        public function index()
        {
		
			if(isset($_SESSION['IDSUser']))
		{
		
				$data['setup'] = $this->setup_model->get_companyDetails();
				$this->load->view('templates/header', $data);
				$this->load->view('templates/navigation', $data);
				$this->load->view('templates/home_view', $data);
				$this->load->view('templates/footer', $data);
				$this->load->view('templates/footercontent');
		}else{
				 $this->load->view('templates/header');
				 $this->load->view('templates/login');
				 $this->load->view('templates/footer');
				 $this->load->view('templates/footercontent');
				}
        }
		
		public function Logout(){
		unset($_SESSION['IDSUser']);
		unset($_SESSION['IDSUserID']);
		}
		public function Login()
		{
		$this->form_validation->set_rules('pass', 'your Password', 'required',array('required' => 'Please provide  %s.'));
		$this->form_validation->set_rules('user', 'Your User Name', 'required',array('required' => 'Please provide  %s.'));
		if ($this->form_validation->run() == FALSE)
        {
                  echo "<font color='red' size='1%'>".validation_errors()."</font>";
					 
        }elseif($this->setup_model->login()=="YES"){
		
				echo "1";
				$arr = $this->setup_model->getLoggedUser();
			
				foreach($arr as $key);
				$_SESSION['IDSUser'] = $key->UserName;
				$_SESSION['IDSUserID'] = $key->Password;
		}else{
		echo "<font color='red' size='1%'>Access Denied!!!</font>";
		 
		}
	
		}
		public function companyCreate()
		{
		$this->form_validation->set_rules('companyName', 'company Name', 'required',array('required' => 'Please provide a %s.'));
		$this->form_validation->set_rules('address', 'company Address', 'required',array('required' => 'Please provide a %s.'));
		
		$this->form_validation->set_rules('website', 'company Website', 'required',array('required' => 'Please provide a %s.'));
		$this->form_validation->set_rules('contact', 'company Contact', 'required',array('required' => 'Please provide a %s.'));
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email',array('required' => 'Please provide a valid %s.'));
			if ($this->form_validation->run() == FALSE)
                {
                       echo "<font color='red' size='1%'>".validation_errors()."</font>";
					    //echo "<font color='red'>".form_error('companyName')."</font>";;
                }else{
		if($this->setup_model->saveCompany()){
		echo "Record Saved Successfully";
		}
		
		}
		}
				public function createRequest()
		{
			$this->form_validation->set_rules('request', 'Request Description', 'required',array('required' => 'Please provide a %s.'));
			if ($this->form_validation->run() == FALSE)
                {
                       echo "<font color='red' size='1%'>".validation_errors()."</font>";
					  
                }else
				{
					if($this->setup_model->saveRequest()){
					echo "Record Saved Successfully";
					}
		
			}
		}
		
						public function createLevel()
		{
			$this->form_validation->set_rules('level', 'Approver\'s Description', 'required',array('required' => 'Please provide %s.'));
			if ($this->form_validation->run() == FALSE)
                {
                       echo "<font color='red' size='1%'>".validation_errors()."</font>";
					  
                }else{
				
					if($this->setup_model->saveLevel()){
					echo "Record Saved Successfully";
					}
			}
		}
		
								public function createApprover()
		{
			$this->form_validation->set_rules('employeeid', 'Employee\'s Name', 'required',array('required' => 'Please Select %s.'));
			$this->form_validation->set_rules('levelid', 'Approver\'s Level', 'required',array('required' => 'Please Select %s.'));
			if ($this->form_validation->run() == FALSE)
                {
                       echo "<font color='red' size='1%'>".validation_errors()."</font>";
					  
                }elseif($this->setup_model->checkApprover()==TRUE){
				
				echo "<font color='red' size='1%'>This Employee is already an approver.</font>";
				}else{
				
					if($this->setup_model->saveApprover()){
					echo "Record Saved Successfully";
					}
			}
		}
		

						
				public function companyEmployee()
		{
		
		$this->form_validation->set_rules('employeename', 'Employee Name', 'required',array('required' => 'Please provide a %s.'));
		$this->form_validation->set_rules('code', 'Employee Code', 'required',array('required' => 'Please provide a %s.'));
		$this->form_validation->set_rules('contact', 'Employee Contact', 'required',array('required' => 'Please provide a %s.'));
		$this->form_validation->set_rules('email', 'Employee Email', 'required|valid_email',array('required' => 'Please provide a valid %s.'));
			if ($this->form_validation->run() == FALSE)
                {
                       echo "<font color='red' size='1%'>".validation_errors()."</font>";
					 
                }elseif($this->setup_model->checkEmployeeEmail()==TRUE){
				 echo "<font color='red' size='1%'>This Email already Exists.</font>";
				}elseif($this->setup_model->checkEmployeeContact()==TRUE){
				 echo "<font color='red' size='1%'>This Contact already Exists.</font>";
				 
				}elseif($this->setup_model->checkEmployeeCode()==TRUE){
				 echo "<font color='red' size='1%'>This Code already Exists.</font>";
				}else{
				
		 $this->setup_model->sendSMS($this->input->post('email'),$this->input->post('contact'));
		 global $password;
		 
		if($this->setup_model->saveEmployeeDetails($password)){
		echo "Record Saved Successfully";
		}
		}
		}
		

}