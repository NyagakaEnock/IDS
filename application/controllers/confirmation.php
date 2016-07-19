<?php
class Confirmation extends CI_Controller 
{
		
        public function __construct()
        {
				
                parent::__construct();
                $this->load->model('confirmation_model');	
					$this->load->model('idf_model');
					$this->load->model('Reports_model');
					
                $this->load->helper('url_helper');
        }

        public function index()
        {
		
                if(isset($_SESSION['IDSUser']))
        {
					$IndentNo = $this->uri->segment(3,"");
					
					$data['ShowAllNewIndent'] = $this->confirmation_model-> ProformaInvoiceItems($IndentNo);
					
					$data['portsofDischarge'] = $this->confirmation_model-> portsofDischarge();
					$data['ParamTransactionTerms'] = $this->confirmation_model-> ParamTransactionTerms();
					$data['ParamBankBranches'] = $this->confirmation_model-> ParamBankBranches();
						
						if($IndentNo !="")
						{
							if($this->confirmation_model->ProformaInvoiceItemsData($IndentNo)!=NULL)
							{
							$data['ShowAllNewIndentData'] = $this->confirmation_model-> ProformaInvoiceItemsData($IndentNo);
							$data['ShowCommodityUnderIndent'] = $this->confirmation_model-> ShowCommodityUnderIndent($IndentNo);
							$data['FindConfirmMessage'] = $this->confirmation_model-> FindConfirmMessage($IndentNo);
							}
						
						}
						$data['IndentNumber'] = $IndentNo;
                        $this->load->view('templates/header', $data);
                        $this->load->view('templates/navigation', $data);
                        $this->load->view('templates/purchaseconfirmation_view', $data);
                        $this->load->view('templates/footercontent');
                        $this->load->view('templates/footer');
        }else{
                        $this->load->view('templates/header');
                        $this->load->view('templates/login');
                        $this->load->view('templates/footercontent');
                        $this->load->view('templates/footer');
                        }
        }
		
		public function saveIDFShippingData()
		{
			 IF($this->idf_model->ValidShipping()==TRUE)
			 {
				 $this->confirmation_model->saveIDFShippingData();
				
			 }			
		}
        public function VerifyShipping()
        {
			if(isset($_SESSION['IDSUser']))
{
		$IndentNo = $this->uri->segment(3,"");

		$data['IndentNos'] = $this->confirmation_model->IndentNos();
		$data['coutryofSupply'] = $this->idf_model->coutryofSupply();
		$data['portofDischarge'] = $this->idf_model->portofDischarge();
		$data['transactionTerms'] = $this->idf_model->transactionTerms();
		$data['transportationMode'] = $this->idf_model->transportationMode();
		$data['IncotermName'] = $this->idf_model->IncotermName();
		 
		if($IndentNo !="")
		{
			if($this->idf_model->loadShippingData($IndentNo)!=null)
			{
		$data['loadShippingData'] = $this->confirmation_model->loadShippingData($IndentNo);
		$data['GetTotalPackages'] = $this->confirmation_model->GetTotalPackages($IndentNo);
		$data['SumofReceivedItems'] = $this->idf_model->SumofReceivedItems($IndentNo);
		$data['SearchShippingByIndentNo'] = $this->confirmation_model->SearchShippingByIndentNo($IndentNo);
		
			}else{
				echo "<font color='red'>Invalid Indent Number.</font>";
			}
		
		}
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/verifyshipping_view', $data);
		$this->load->view('templates/footercontent');
		$this->load->view('templates/footer');
}else{
		$this->load->view('templates/header');
		$this->load->view('templates/login');
		$this->load->view('templates/footercontent');
		$this->load->view('templates/footer');
		}
        }
        public function NonIDFIndents()
        {
		
                if(isset($_SESSION['IDSUser']))
        {
					$IndentNo = $this->uri->segment(3,"");
					$data['ShowAllNewNonIDF'] = $this->confirmation_model-> ShowAllNewNonIDF();
					$data['portsofDischarge'] = $this->confirmation_model-> portsofDischarge();
					$data['ParamTransactionTerms'] = $this->confirmation_model-> ParamTransactionTerms();
					$data['ParamBankBranches'] = $this->confirmation_model-> ParamBankBranches();
						
						if($IndentNo !="")
						{
							if($this->confirmation_model->checkShowAllNewNonIDF($IndentNo)!=0)
							{
							$data['ShowAllNewIndentData'] = $this->confirmation_model-> ShowAllNewNonIDFDATA($IndentNo);
							$data['ShowCommodityUnderIndent'] = $this->confirmation_model-> ShowCommodityDutyFree($IndentNo);
							$data['FindConfirmMessage'] = $this->confirmation_model-> FindConfirmMessage($IndentNo);
							}else{
								echo "<font color='red'>Invalid Indent Number.</font>";
							}
						
						}
						
                        $this->load->view('templates/header', $data);
                        $this->load->view('templates/navigation', $data);
                        $this->load->view('templates/purchaseconfirmation2_view', $data);
                        $this->load->view('templates/footercontent');
                        $this->load->view('templates/footer');
        }else{
                        $this->load->view('templates/header');
                        $this->load->view('templates/login');
                        $this->load->view('templates/footercontent');
                        $this->load->view('templates/footer');
                        }
        }

		public function safeConfirmation()
		{
			if($this->confirmation_model->validConfirmation()==TRUE)
			{
				$this->confirmation_model->safeConfirmation();
			}
		}
		public function safeAcknowledement()
		{
				$date1=date_create(date('Y-m-d'));
				$date2=date_create($this->input->post('Date'));
				$diff=date_diff($date2,$date1);
				$diff = $diff->format("%R%a days");
			if($this->input->post('Date')==NULL)
			{
				echo "<font color='red'>Required Date of Acknowledgement.</font>";
				
			}elseif($diff <0)
			{
				echo "<font color='red'>Date of Acknowledgement can't be in the Future.</font>";
			}else{
				$this->confirmation_model->safeAcknowledement();
			}
		}		
		
		public function safeConfirmationNonIndent()
		{
			if($this->confirmation_model->validConfirmation()==TRUE)
			{
				$this->confirmation_model->safeConfirmationNonIndent();
			}
		}
		public function acknowledgeOrders()
		{
               if(isset($_SESSION['IDSUser']))
        {
						
						$type = $this->uri->segment(3,"");
						if($type =="old"){
								$IndentNo = $this->uri->segment(4,"");
								$data['ShowAllNewPurchaseData'] = $this->confirmation_model-> ShowAllOldPurchaseData();
								if($IndentNo !="")
								{
									if($this->confirmation_model->CHECKShowAllOldPurchaseData($IndentNo)!=0)
									{
									$data['ShowAllNewPurchaseDataInfo'] = $this->confirmation_model-> ShowAllOldPurchaseDataInfo($IndentNo);
									$data['ShowCommodityUnderIndentPurchase'] = $this->confirmation_model-> ShowCommodityUnderIndentPurchase($IndentNo);
									}else{
										echo "<font color='red'>Invalid Indent Number.</font>";
									}
								
								}	
							
						}elseif($type =="all"){
					
								$IndentNo = $this->uri->segment(4,"");
								$data['ShowAllNewPurchaseData'] = $this->confirmation_model-> ShowAllPurchaseData();
								if($IndentNo !="")
								{
									if($this->confirmation_model->CHECKShowAllPurchaseData($IndentNo)!=0)
									{
									$data['ShowAllNewPurchaseDataInfo'] = $this->confirmation_model-> ShowAllPurchaseDataInfo($IndentNo);
									$data['ShowCommodityUnderIndentPurchase'] = $this->confirmation_model-> ShowCommodityUnderIndentPurchase($IndentNo);
									}else{
										echo "<font color='red'>Invalid Indent Number.</font>";
									}
								
								}						
						}else{
								$IndentNo = $this->uri->segment(3,"");
								$data['ShowAllNewPurchaseData'] = $this->confirmation_model-> ShowAllNewPurchaseData();
								if($IndentNo !="")
								{
									if($this->confirmation_model->CHECKShowAllNewPurchaseData($IndentNo)!=0)
									{
									$data['ShowAllNewPurchaseDataInfo'] = $this->confirmation_model-> ShowAllNewPurchaseDataInfo($IndentNo);
									$data['type']=$type;
									$data['ShowCommodityUnderIndentPurchase'] = $this->confirmation_model-> ShowCommodityUnderIndentPurchase($IndentNo);
									}else{
										echo "<font color='red'>Invalid Indent Number.</font>";
									}
								
								}
						}
						$data['type'] = $type = $this->uri->segment(3,"");
                        $this->load->view('templates/header', $data);
                        $this->load->view('templates/navigation', $data);
                        $this->load->view('templates/acknowledgeOrders_view', $data);
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
?>