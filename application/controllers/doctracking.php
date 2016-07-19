<?php
class Doctracking extends CI_Controller 
{
		
        public function __construct()
        {
				
                parent::__construct();
                $this->load->model('doctracking_model');	
				$this->load->model('proformainvoices_model');					
                $this->load->helper('url_helper');
        }
		 public function safeShippingDocs()
		 { 
			if($this->doctracking_model->ValidRecordDocument()==TRUE)
			{
			$this->doctracking_model->safeShippingDocs();	
			}			 
		 }
        public function index()
        {
		
                if(isset($_SESSION['IDSUser']))
        {
					$IndentNo = $this->uri->segment(3,"");
						
						$data['ShowNewAcknowledged'] = $this->doctracking_model->ShowNewAcknowledged();
						if($IndentNo !="")
						{
							if($this->doctracking_model-> ShowNewAcknowledgedData($IndentNo)!= null)
							{
							$data['ShowNewAcknowledgedData'] = $this->doctracking_model-> ShowNewAcknowledgedData($IndentNo);
							$data['ShowShippingDocumentMain'] = $this->doctracking_model-> ShowShippingDocumentMain($IndentNo);
							$data['FindRequestMessage'] = $this->doctracking_model-> FindRequestMessage();
							
							}else{
								echo "<font color='red'>Invalid Indent Number.</font>";
							}
						
						}
					
                        $this->load->view('templates/header', $data);
                        $this->load->view('templates/navigation', $data);
                        $this->load->view('templates/doctracking_view', $data);
                        $this->load->view('templates/footercontent');
                        $this->load->view('templates/footer');
        }else{
                        $this->load->view('templates/header');
                        $this->load->view('templates/login');
                        $this->load->view('templates/footercontent');
                        $this->load->view('templates/footer');
                        }
        }
		public function receiveDocument()
		{
			if($this->doctracking_model->ValidRecordDocumentRec()==TRUE)
			{
			
			$this->doctracking_model->safeShippingDocsReceived();	
			}				
		}
        public function receivingdocuments()
        {
		
                if(isset($_SESSION['IDSUser']))
        {
					$IndentNo = $this->uri->segment(3,"");
					$DocumentNo = $this->uri->segment(4,"");	
						$data['ShowRequestsNotReceived'] = $this->doctracking_model->ShowRequestsNotReceived();
						if($IndentNo !="")
						{
							if($this->doctracking_model-> ShowRequestsNotReceivedData($IndentNo)!=null)
							{
								if($DocumentNo!=""){
								if($this->doctracking_model-> loadDocs($DocumentNo)!=null)
								{
								$data['loadDocs'] = $this->doctracking_model-> loadDocs($DocumentNo);
								if($this->doctracking_model-> loadDocs($DocumentNo)[0]->DocumentCode==10)
								{
								$data['FindTheIDF'] = $this->doctracking_model-> FindTheIDF($IndentNo);
								}elseif($this->doctracking_model-> loadDocs($DocumentNo)[0]->DocumentCode==11)
								{
								$data['FindProformaInvoice'] = $this->doctracking_model-> FindProformaInvoice($IndentNo);
								}elseif($this->doctracking_model-> loadDocs($DocumentNo)[0]->DocumentCode==16)
								{
								$data['FindProformaInvoice'] = $this->doctracking_model-> FindDepositSlip($IndentNo);
								}elseif($this->doctracking_model-> loadDocs($DocumentNo)[0]->DocumentCode==17)
								{
								$data['FindProformaInvoice'] = $this->doctracking_model-> ApproxInvoiceValue($IndentNo);
								}
																	
								}else{
								echo "<font color='red'>Invalid DocumentNo Number.</font>";
							}
								}
						$data['ShowRequestsNotReceivedData'] = $this->doctracking_model-> ShowRequestsNotReceivedData($IndentNo);
						$data['ShowShippingDocumentRec'] = $this->doctracking_model-> ShowShippingDocumentRec();
							
							}else{
								echo "<font color='red'>Invalid Indent Number.</font>";
							}
						
						}
					
                        $this->load->view('templates/header', $data);
                        $this->load->view('templates/navigation', $data);
                        $this->load->view('templates/receivingdocuments_view', $data);
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
