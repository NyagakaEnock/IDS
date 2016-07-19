<?php
class Reports extends CI_Controller 
{

        public function __construct()
        {
                parent::__construct();
				$this->load->model('Reports_model');
                $this->load->helper('url_helper');
				
        }

        public function NewOrders()
        {
				if(isset($_SESSION['IDSUser']))
				{
						$IndentNo = $this->uri->segment(3,"");
						$data['printNewOrders'] = $this->Reports_model->printNewOrdersSingle();
						
					
					
						$this->load->view('templates/header');
						$this->load->view('templates/navigation');
						$this->load->view('templates/mainreport',$data);
						$this->load->view('templates/footercontent');
						$this->load->view('templates/footer');
				}else{
						 $this->load->view('templates/header');
						 $this->load->view('templates/login');
						 $this->load->view('templates/footercontent');
						 $this->load->view('templates/footer');
						}	
				
        }
        public function ReceivedOrders()
        {
				if(isset($_SESSION['IDSUser']))
				{
						$IndentNo = $this->uri->segment(3,"");
						$data['printNewOrders'] = $this->Reports_model->printReceivedOrdersSingle();
						
					
					
						$this->load->view('templates/header');
						$this->load->view('templates/navigation');
						$this->load->view('templates/mainreport2',$data);
						$this->load->view('templates/footercontent');
						$this->load->view('templates/footer');
				}else{
						 $this->load->view('templates/header');
						 $this->load->view('templates/login');
						 $this->load->view('templates/footercontent');
						 $this->load->view('templates/footer');
						}	
				
        }	
		
        public function StatusReport()
        {

				if(isset($_SESSION['IDSUser']))
				{
						$IndentNo = $this->uri->segment(3,"");
						$data['printNewOrders'] = $this->Reports_model->statusReportCombobox();
						
					
					
						$this->load->view('templates/header');
						$this->load->view('templates/navigation');
						$this->load->view('templates/statusreport',$data);
						$this->load->view('templates/footercontent');
						$this->load->view('templates/footer');
				}else{
						 $this->load->view('templates/header');
						 $this->load->view('templates/login');
						 $this->load->view('templates/footercontent');
						 $this->load->view('templates/footer');
						}	
				
        }
        public function ConfirmedOrders()
        {
				if(isset($_SESSION['IDSUser']))
				{
						$IndentNo = $this->uri->segment(3,"");
						$data['printNewOrders'] = $this->Reports_model->printConfirmedOrdersSingle();
						
					
					
						$this->load->view('templates/header');
						$this->load->view('templates/navigation');
						$this->load->view('templates/mainreport3',$data);
						$this->load->view('templates/footercontent');
						$this->load->view('templates/footer');
				}else{
						 $this->load->view('templates/header');
						 $this->load->view('templates/login');
						 $this->load->view('templates/footercontent');
						 $this->load->view('templates/footer');
						}	
				
        }	
		public function SaveNewOrders()
		{
			$IndentDate = trim($this->input->post('IndentDate'));
			
				if($this->input->post('IndentNo')==NULL)
				{
					echo "<font color='red'>Select a Record to Print.</font>";
				return;
				}elseif(($this->input->post('IndentNo')=="Print All")&& ($this->input->post('IndentDate')==NULL))
				{
					echo "<font color='red'>Select the date the New Orders were Made.</font>";
					return;
				}
				if($this->Reports_model->printNewOrders($this->input->post('IndentNo'),$IndentDate)!=NULL)
				{
				$data['printNewOrders'] = $this->Reports_model->getParamRequest($this->input->post('IndentNo'),$IndentDate);
				$data['$dates'] = $IndentDate;
				$this->load->view('templates/rptneworders',$data);
				}
				
				
				
		}
		
		public function ReceiveNewOrders()
		{
		
			$IndentDate = trim($this->input->post('IndentDate'));
				if($this->input->post('IndentNo')==NULL)
				{
					echo "<font color='red'>Select a Record to Print.</font>";
				
				}elseif(($this->input->post('IndentNo')=="Print All")&& ($this->input->post('IndentDate')==NULL))
				{
					echo "<font color='red'>Select the date the New Orders were Made.</font>";
					
				}
					if($this->Reports_model->getParamReceivedRequest($this->input->post('IndentNo'),$IndentDate)!=NULL)
				{
				
				
				$data['printNewOrders'] = $this->Reports_model->getParamReceivedRequest($this->input->post('IndentNo'),$IndentDate);
				$data['$dates'] = $IndentDate;
				
				$this->load->view('templates/rptreceived',$data);
				}
				
				
				
		}
		
		public function ConfirmedNewOrders()
		{
			$IndentDate = trim($this->input->post('IndentDate'));
				if($this->input->post('IndentNo')==NULL)
				{
					echo "<font color='red'>Select a Record to Print.</font>";
				return;
				}elseif(($this->input->post('IndentNo')=="Print All")&& ($this->input->post('IndentDate')==NULL))
				{
					echo "<font color='red'>Select the date the New Orders were Made.</font>";
					return;
				}
				if($this->Reports_model->getParamConfirmedRequest($this->input->post('IndentNo'),$IndentDate)!=NULL)
				{
				$data['printNewOrders'] = $this->Reports_model->getParamConfirmedRequest($this->input->post('IndentNo'),$IndentDate);
				$data['$dates'] = $IndentDate;
				
				$this->load->view('templates/rptconfirmed',$data);
				}
				
				
				
		}		

		public function viewStatusReport()
		{
	
			$IndentDate = trim($this->input->post('IndentDate'));
				if($this->input->post('IndentNo')==NULL)
				{
					echo "<font color='red'>Select a Record to Print.</font>";
				return;
				}elseif(($this->input->post('IndentNo')=="Print All")&& ($this->input->post('IndentDate')==NULL))
				{
					echo "<font color='red'>Select the date the New Orders were Made.</font>";
					return;
				}
				
				if(($this->input->post('IndentNo')!=NULL)&&($this->input->post('IndentNo')!="Print All"))
				{
					
				
				if($this->Reports_model->statusReportSingles($this->input->post('IndentNo'),$IndentDate)!=NULL)
				{
				$data['printNewOrders'] = $this->Reports_model->statusReportSingles($this->input->post('IndentNo'));
				}
				}elseif(($this->input->post('IndentNo')=="Print All")&& ($this->input->post('IndentDate')!=NULL))
				{
				$data['printNewOrders'] = $this->Reports_model->statusReportDate($IndentDate);
			
				}
				
				
				$data['$dates'] = $IndentDate;
				
				$this->load->view('templates/rptstatus',$data);
					
				
				
		}
		public function invoice()
		{
			if(isset($_SESSION['IDSUser']))
				{
					$IndentNo = $this->uri->segment(3,"");
			$data['printNewOrders'] = $this->Reports_model->printNewOrdersSingle();
			$data['printInvoiceOrders'] = $this->Reports_model->printInvoiceSingle($IndentNo);
			$data['printInvoice'] = $this->Reports_model->printInvoice($IndentNo);
			
			$this->load->view('templates/header');
			$this->load->view('templates/navigation');
			$this->load->view('templates/invoicereport',$data);					
			$this->load->view('templates/footer');
				}else{
				 $this->load->view('templates/header');
				 $this->load->view('templates/login');
				 $this->load->view('templates/footercontent');
				 $this->load->view('templates/footer');
				}				
		}
		public function invoicePreview()
		{
			if(isset($_SESSION['IDSUser']))
				{
					$IndentNo = $this->uri->segment(3,"");
			$data['printNewOrders'] = $this->Reports_model->printNewOrdersSingle();
			$data['printInvoiceOrders'] = $this->Reports_model->printInvoiceSingle($IndentNo);
			$data['printInvoice'] = $this->Reports_model->printInvoice($IndentNo);
			
			$this->load->view('templates/header');
			
			$this->load->view('templates/rptinvoice',$data);					
			$this->load->view('templates/footer');
				}else{
				 $this->load->view('templates/header');
				 $this->load->view('templates/login');
				 $this->load->view('templates/footercontent');
				 $this->load->view('templates/footer');
				}				
		}
		public function SupplierCopy()
		{
			if(isset($_SESSION['IDSUser']))
				{
					$IndentNo = $this->uri->segment(3,"");
			$data['printNewOrders'] = $this->Reports_model->printConfirmedOrdersSingle();
			$data['printconfirmedOriginal'] = $this->Reports_model->confirmedOriginalData($IndentNo);
			$data['confirmedOriginalDetails'] = $this->Reports_model->confirmedOriginalDetails($IndentNo);
			
			$this->load->view('templates/header');
			$this->load->view('templates/navigation');
			$this->load->view('templates/originalcopy',$data);					
			$this->load->view('templates/footer');
				}else{
				 $this->load->view('templates/header');
				 $this->load->view('templates/login');
				 $this->load->view('templates/footercontent');
				 $this->load->view('templates/footer');
				}				
		}		
		public function Original()
		{
			if(isset($_SESSION['IDSUser']))
				{
					$IndentNo = $this->uri->segment(3,"");
			$data['printNewOrders'] = $this->Reports_model->printConfirmedOrdersSingle();
			$data['printconfirmedOriginal'] = $this->Reports_model->confirmedOriginalData($IndentNo);
			$data['confirmedOriginalDetails'] = $this->Reports_model->confirmedOriginalDetails($IndentNo);
			
			$this->load->view('templates/header');
			$this->load->view('templates/rptoriginalcopy',$data);					
			$this->load->view('templates/footer');
				}else{
				 $this->load->view('templates/header');
				 $this->load->view('templates/login');
				 $this->load->view('templates/footercontent');
				 $this->load->view('templates/footer');
				}				
		}	
		public function BlueCopy()
		{
			if(isset($_SESSION['IDSUser']))
				{
					$IndentNo = $this->uri->segment(3,"");
			$data['printNewOrders'] = $this->Reports_model->printConfirmedOrdersSingle();
			$data['printconfirmedOriginal'] = $this->Reports_model->confirmedOriginalData($IndentNo);
			$data['confirmedOriginalDetails'] = $this->Reports_model->confirmedOriginalDetails($IndentNo);
			
			$this->load->view('templates/header');
			$this->load->view('templates/rptoriginalcopy',$data);					
			$this->load->view('templates/footer');
				}else{
				 $this->load->view('templates/header');
				 $this->load->view('templates/login');
				 $this->load->view('templates/footercontent');
				 $this->load->view('templates/footer');
				}				
		}
		public function GreenCopy()
		{
			if(isset($_SESSION['IDSUser']))
				{
					$IndentNo = $this->uri->segment(3,"");
			$data['printNewOrders'] = $this->Reports_model->printConfirmedOrdersSingle();
			$data['printconfirmedOriginal'] = $this->Reports_model->confirmedOriginalData($IndentNo);
			$data['confirmedOriginalDetails'] = $this->Reports_model->confirmedOriginalDetails($IndentNo);
			
			$this->load->view('templates/header');
			$this->load->view('templates/rptoriginalcopy',$data);					
			$this->load->view('templates/footer');
				}else{
				 $this->load->view('templates/header');
				 $this->load->view('templates/login');
				 $this->load->view('templates/footercontent');
				 $this->load->view('templates/footer');
				}				
		}		
}