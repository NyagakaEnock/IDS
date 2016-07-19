<?php
class Invoiceprocessing extends CI_Controller 
{
		
        public function __construct()
        {
				
                parent::__construct();
                $this->load->model('invoiceprocessing_model');
				$this->load->model('proformainvoices_model');
				$this->load->model('proformainvoiceremider_model');
				
                $this->load->helper('url_helper');
        }

        public function index()
        {
				$this->proformarequests();
        }
		
		public function proformarequests()
		{
			if(isset($_SESSION['IDSUser']))
		{		
				$IndentNo  = $this->uri->segment(3,"");
				if($IndentNo!=NULL)
				{
					if($this->invoiceprocessing_model->LoadExporterProducts($IndentNo)!=NULL)
					{
						$data['LoadExporterProducts'] = $this->invoiceprocessing_model->LoadExporterProducts($IndentNo);
						$data['IndentNumber'] = $this->uri->segment(4,'');
						
						$data['exporterCode'] = $this->uri->segment(3,'');
					}
				}
				$data['typeofIndents'] = $this->invoiceprocessing_model->get_typeofIndents();
				$data['get_Exporters'] = $this->invoiceprocessing_model->get_Exporters();
				$data['ParamCountries'] = $this->invoiceprocessing_model->get_countries();
				$data['ParamCompanyBranch'] = $this->invoiceprocessing_model->get_ParamCompanyBranch($id="");
				$data['ParamShipmentOwners'] = $this->invoiceprocessing_model->get_ParamShipmentOwners();
				$data['load_ParamEmpMaster'] = $this->invoiceprocessing_model->load_ParamEmpMaster();
				$data['LoadIndentNos'] = $this->invoiceprocessing_model->LoadIndentNos();
				$this->load->view('templates/header', $data);
				$this->load->view('templates/navigation', $data);
				$this->load->view('templates/invoiceprocessing_view', $data);
				$this->load->view('templates/footercontent');
				$this->load->view('templates/footer');
		}else{
				 $this->load->view('templates/header');
				 $this->load->view('templates/login');
				 $this->load->view('templates/footercontent');
				  $this->load->view('templates/footer');
				}		
		}
		
		
				public function proformainvoicesreminders()
		{
			if(isset($_SESSION['IDSUser']))
		{
				$id = "";
				$data['ShowAllOverDueRequests'] = $this->proformainvoiceremider_model->ShowAllOverDueRequests($id);
				$this->load->view('templates/header', $data);
				$this->load->view('templates/navigation', $data);
				$this->load->view('templates/proformainvoicereminders_view', $data);
				$this->load->view('templates/footercontent');
				$this->load->view('templates/footer');
		}else{
				 $this->load->view('templates/header');
				 $this->load->view('templates/login');
				 $this->load->view('templates/footercontent');
				  $this->load->view('templates/footer');
				}		
		}
		public  function getIndentNo()
		{
		$id = $_GET['getIndentNo'];
		$data['getIndentNo'] = $this->invoiceprocessing_model->GetNextIndentNumber($id);
		$data['id'] =$id;
		$this->load->view('templates/ajaxviews', $data);
		}
		public  function loadReminderDetails()
		{
			$id = $_GET['Indent'];
			$data['loadReminderDetails'] = $this->proformainvoiceremider_model->ShowAllOverDueRequests($id);
			$data['loadContactPeople'] = $this->proformainvoiceremider_model->loadContactPeople();
			$data['GetNextProformaReminder'] = $this->proformainvoiceremider_model->GetNextProformaReminder($id);
			$data['FindReminderMessage'] = $this->proformainvoiceremider_model->FindReminderMessage();
			//$data['FindReminderMessage'] = $this->proformainvoiceremider_model->FindReminderMessage();
			$data['id'] =$id;
			$this->load->view('templates/ajaxviews', $data);
		}
		
				public  function getcountryFax()
		{
		$id = $_GET['countryFax'];	
		$data['countryFax'] = $this->invoiceprocessing_model->getcountryFax($id);
		$data['id'] =$id;
		$data['ParamCountries'] = $this->invoiceprocessing_model->get_countries();
		$this->load->view('templates/ajaxviews', $data);
		}
		public  function getMessages()
		{	
		$id = $_GET['Messages'];
		$data['ProformaClosing'] = $this->invoiceprocessing_model->getMessages();
		$data['id'] =$id;
		$this->load->view('templates/ajaxviews', $data);
		}
		public  function loadMainData()
		{
		
			$id = $_GET['LoadIndentNosID'];
		$exporterCode = "";
		if(isset($_GET['exporterCode'])){
		$exporterCode = $_GET['exporterCode'];
		}
		$data['MainData'] = $this->invoiceprocessing_model->LoadMainData($id,$exporterCode);
		$data['id'] =$id;
		$this->load->view('templates/ajaxviews', $data);
		}
		public  function loadproductdetails()
		{
		$id = $_GET['ProductCode'];
		
		$data['productdetails'] = $this->invoiceprocessing_model->loadproductdetails($id);
		$data['id'] =$id;
		$this->load->view('templates/ajaxviews', $data);
		}
		
		public function createProformaRequest()
		{
		
		if($this->invoiceprocessing_model->ValidRecord()==FALSE)
		{
		
		$this->invoiceprocessing_model->saveProformaRequests();
		}
		}
		public function createProformaCommodity()
		{
		
		if($this->invoiceprocessing_model->ValidCommodityRecord()==FALSE)
		{
			$indentNo = $this->input->get('indentNo2');
			$ExporterCode = $this->input->get('ExporterCode2');
			$ProductCode = $this->input->get('ProductCode');
			if($this->invoiceprocessing_model->ItemsAlreadyExists($indentNo,$ProductCode)==NULL)
			{
				
				$this->invoiceprocessing_model->saveProformaCommodities();
			
			}else{
				
				$this->invoiceprocessing_model->updateProformaCommodities();
			
			}
			
		}
		}
		
		public function searchComoditiesData()
		{
		$ExporterCode = $_GET['ExporterCode2'];
		
		$id = $_GET['indentNo2'];
	
		if($id==""){
		echo "<font color='red'>Please Select Indent Number</font>";
		}elseif($ExporterCode==""){
		echo "<font color='red'>Please re-select Indent Number</font>";
		
		}else{
		$comoditySearch = $this->input->get('comoditySearch');
		
		$data['MainData'] = $this->invoiceprocessing_model->searchComodities($comoditySearch,$ExporterCode);
		//echo 45;
		$data['id'] =$id;
		$data['ExporterCode'] =$ExporterCode;
		$this->load->view('templates/ajaxviews', $data);
		}

		
		}
		public function searchInvoices()
		{
				if(isset($_GET['ProformaSearch'])){
				$indentNo=$this->input->get('ProformaSearch');
				}else{
				$indentNo="";
				}
				
				$data['PendingProformaInvoiceRequests'] = $this->proformainvoices_model->PendingProformaInvoiceRequests($indentNo);
				$this->load->view('templates/ajaxviews', $data);
		}
		public function proformainvoices()
		{
			if(isset($_SESSION['IDSUser']))
		{
					$indentNo="";
				$data['PendingProformaInvoiceRequests'] = $this->proformainvoices_model->PendingProformaInvoiceRequests($indentNo);
				$this->load->view('templates/header', $data);
				$this->load->view('templates/navigation', $data);
				$this->load->view('templates/proformainvoices_view', $data);
				$this->load->view('templates/footercontent');
				$this->load->view('templates/footer');
		}else{
				 $this->load->view('templates/header');
				 $this->load->view('templates/login');
				 $this->load->view('templates/footercontent');
				 $this->load->view('templates/footer');
				}
		}
		public function ShowCommodityUnderIndent()
		{
				if(isset($_GET['Indent'])){
				$indentNo=$this->input->get('Indent');
				}else{
				$indentNo="";
				}
			
				$data['ShowCommodityUnderIndent'] = $this->proformainvoices_model->ShowCommodityUnderIndent($indentNo,"");
				$data['indentNo'] = $indentNo;
				$data['InvoiceRequests'] = $this->proformainvoices_model->PendingProformaInvoiceRequests($indentNo);
				$data['get_Currency'] = $this->proformainvoices_model->get_Currency();
				$this->load->view('templates/ajaxviews', $data);
	
		}
		public function ShowCommodityUnderIndentProduct()
		{
		
				if(isset($_GET['ProductCode'])){
				$ProductCode=$this->input->get('ProductCode');
				$indentNo = $this->input->get('indentNo');
				}else{
				$ProductCode="";
				$indentNo = "";
				}
				$data['ShowCommodityUnderIndentProduct'] = $this->proformainvoices_model->ShowCommodityUnderIndent($indentNo ,$ProductCode);
				$this->load->view('templates/ajaxviews', $data);
	
		}
		public function createProformaInvoice()
		{
			IF($this->proformainvoices_model->validateInvoice()==TRUE)
			{
				$this->proformainvoices_model->saveProrformRequest();
			}
		}
		
		public function createReminderDetails()
		{			
		
			IF($this->proformainvoiceremider_model->validateReminder()==TRUE)
			{
				$this->proformainvoiceremider_model->createReminderDetails();
			}
		}
				

}