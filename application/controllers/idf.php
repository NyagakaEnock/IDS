<?php
class Idf extends CI_Controller 
{
		
        public function __construct()
        {
				
                parent::__construct();
                $this->load->model('idf_model');				
                $this->load->helper('url_helper');
        }

        public function index()
        {
		
                if(isset($_SESSION['IDSUser']))
        {
						$IndentNo = $this->uri->segment(3,"");
						
						 $data['searchIDFRecord'] = $this->idf_model->searchIDFRecord();
						
                        $data['loadIndentNos'] = $this->idf_model->loadIndentNos();
						$data['loadContactPeople'] = $this->idf_model->loadContactPeople();
						$data['loadPSIAgencyName'] = $this->idf_model->loadPSIAgencyName();
						
						if($IndentNo !="")
						{
							if($this->idf_model->checkIndentNos($IndentNo)!=0)
							{
						$data['loadData'] = $this->idf_model->loadData($IndentNo);
						$data['FindTheUSDValues'] = $this->idf_model->FindTheUSDValues($IndentNo);
						$data['CalculateAmountUSD'] = $this->idf_model->CalculateAmountUSD($IndentNo);
						$data['GetMyPrepaidAmount'] = $this->idf_model->GetMyPrepaidAmount();
						$data['loadTownCity'] = $this->idf_model->loadTownCity();
						
							}elseif($this->idf_model->editIDFRecord($IndentNo)!=NULL){
						$data['editIDFRecord'] = $this->idf_model->editIDFRecord($IndentNo);
						$data['FindTheUSDValues'] = $this->idf_model->FindTheUSDValues($IndentNo);
								
							}else{
								echo "<font color='red'>Invalid Indent Number.</font>";
							}
						
						}
						
                        $this->load->view('templates/header', $data);
                        $this->load->view('templates/navigation', $data);
                        $this->load->view('templates/idf_view', $data);
                        $this->load->view('templates/footercontent');
                        $this->load->view('templates/footer');
        }else{
                        $this->load->view('templates/header');
                        $this->load->view('templates/login');
                        $this->load->view('templates/footercontent');
                        $this->load->view('templates/footer');
                        }
        }
		public function reports()
		{
			$IndentNo = $this->uri->segment(3,"");
			$data['printIDFRecord'] = $this->idf_model->printIDFRecord($IndentNo);
			$data['printIDFRecord2'] = $this->idf_model->printIDFRecord2($IndentNo);
						
                        $this->load->view('templates/header');
                        $this->load->view('reports/idf_report',$data);
                       
                        $this->load->view('templates/footer');			
		}
		public function idfShippingInfo()
		{
			if(isset($_SESSION['IDSUser']))
{
		$IndentNo = $this->uri->segment(3,"");

		$data['loadShippingIndentNos'] = $this->idf_model->loadShippingIndentNos();
		$data['coutryofSupply'] = $this->idf_model->coutryofSupply();
		$data['portofDischarge'] = $this->idf_model->portofDischarge();
		$data['transactionTerms'] = $this->idf_model->transactionTerms();
		$data['transportationMode'] = $this->idf_model->transportationMode();
		$data['IncotermName'] = $this->idf_model->IncotermName();
		 
		if($IndentNo !="")
		{
			if($this->idf_model->checkShippingIndentNos($IndentNo)!=0)
			{
		$data['loadShippingData'] = $this->idf_model->loadShippingData($IndentNo);
		$data['GetTotalPackages'] = $this->idf_model->GetTotalPackages($IndentNo);
		$data['SumofReceivedItems'] = $this->idf_model->SumofReceivedItems($IndentNo);
			}else{
				echo "<font color='red'>Invalid Indent Number.</font>";
			}
		
		}
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/idfshipping_view', $data);
		$this->load->view('templates/footercontent');
		$this->load->view('templates/footer');
}else{
		$this->load->view('templates/header');
		$this->load->view('templates/login');
		$this->load->view('templates/footercontent');
		$this->load->view('templates/footer');
		}
		}
		
		public function createidfmain()
		{
			 IF($this->idf_model->ValidMainData()==TRUE)
			 {
				 $this->idf_model->saveIDFMainData();
			 }
		}
		public function createidfshipping()
		{
			 IF($this->idf_model->ValidShipping()==TRUE)
			 {
				 $this->idf_model->saveIDFShippingData();
				
			 }			
		}

		public function idfitemsInfo()
		{
			if(isset($_SESSION['IDSUser']))
{
		$IndentNo = $this->uri->segment(3,"");

		$data['idfItemsIndentNos'] = $this->idf_model->idfItemsIndentNos();
		$data['coutryofSupply'] = $this->idf_model->coutryofSupply();
		$data['portofDischarge'] = $this->idf_model->portofDischarge();
		$data['transactionTerms'] = $this->idf_model->transactionTerms();
		$data['transportationMode'] = $this->idf_model->transportationMode();
		$data['IncotermName'] = $this->idf_model->IncotermName();
		 
		if($IndentNo !="")
		{
			if($this->idf_model->checkidfItemsIndentNos($IndentNo)!=0)
			{
		$data['ShowCommodityUnderIndent'] = $this->idf_model->ShowCommodityUnderIndent($IndentNo);
		$data['loadExporterDetails'] = $this->idf_model->loadExporterDetails($IndentNo);
		$data['SumofReceivedItems'] = $this->idf_model->SumofReceivedItems($IndentNo);

		
			}else{
				echo "<font color='red'>Invalid Indent Number.</font>";
			}
		
		}
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navigation', $data);
		$this->load->view('templates/idfitems_view', $data);
		$this->load->view('templates/footercontent');
		$this->load->view('templates/footer');
}else{
		$this->load->view('templates/header');
		$this->load->view('templates/login');
		$this->load->view('templates/footercontent');
		$this->load->view('templates/footer');
		}
		}	
		
		public function saveIDFItems()
		{	
			$this->idf_model->saveIDFItems();
		}
		public function IDFNumber()
		{	
						if(isset($_SESSION['IDSUser']))
			{
					$IndentNo = $this->uri->segment(3,"");

					$data['ShowAllPendingIDF'] = $this->idf_model->ShowAllPendingIDF();
					 
					if($IndentNo !="")
					{
						if($this->idf_model->checkShowAllPendingIDF($IndentNo)!=0)
						{
					$data['AllPendingIDFData'] = $this->idf_model->AllPendingIDFData($IndentNo);
						}else{
							echo "<font color='red'>Invalid Indent Number.</font>";
						}
					
					}
					
					$this->load->view('templates/header', $data);
					$this->load->view('templates/navigation', $data);
					$this->load->view('templates/idfupdate_view', $data);
					$this->load->view('templates/footercontent');
					$this->load->view('templates/footer');
			}else{
					$this->load->view('templates/header');
					$this->load->view('templates/login');
					$this->load->view('templates/footercontent');
					$this->load->view('templates/footer');
					}
		}
		
		public function updateIDFNo()
		{
			if($this->idf_model->ValidIDFNo()==TRUE)
			{
				$this->idf_model->updateIDFNo();
			}
		}
		

		public function Productsamendements()
		{	
						if(isset($_SESSION['IDSUser']))
			{
					$IndentNo = $this->uri->segment(3,"");
					$ProductCode = $this->uri->segment(4,"");

					$data['ShowDataSheet'] = $this->idf_model->ShowDataSheet();
					 
					if($IndentNo !="")
					{
						if($this->idf_model->checkShowDataSheetIndents($IndentNo)!=0)
						{
							$data['checkProductsUnderIndent'] = $this->idf_model->checkProductsUnderIndent($IndentNo,$ProductCode);
							if($ProductCode =="")
								{
							$data['ShowProductsUnderIndent'] = $this->idf_model->ShowProductsUnderIndent($IndentNo,$ProductCode);
							
								}else{
							if($this->idf_model->checkProductsUnderIndent($IndentNo,$ProductCode)!=0)
							{
								$data['ShowProductsUnderIndent'] = $this->idf_model->ShowProductsUnderIndent($IndentNo,$ProductCode);
							}else{
							echo "<font color='red'>Invalid Product Code.</font>";
						}
								}
					
						}else{
							echo "<font color='red'>Invalid Indent Number.</font>";
						}
					
					}
					
					$this->load->view('templates/header', $data);
					$this->load->view('templates/navigation', $data);
					$this->load->view('templates/productsamendment_view', $data);
					$this->load->view('templates/footercontent');
					$this->load->view('templates/footer');
			}else{
					$this->load->view('templates/header');
					$this->load->view('templates/login');
					$this->load->view('templates/footercontent');
					$this->load->view('templates/footer');
					}
		}
		public function amendements()
		{	
						if(isset($_SESSION['IDSUser']))
			{
					$IndentNo = $this->uri->segment(3,"");

					$data['ShowAllNewIndents'] = $this->idf_model->ShowAllNewIndents();
					 
					if($IndentNo !="")
					{
						if($this->idf_model->checkShowAllNewIndents($IndentNo)!=0)
						{
					$data['ShowAllNewIndentsData'] = $this->idf_model->ShowAllNewIndentsData($IndentNo);
					$data['GoodsDescription'] = $this->idf_model->GoodsDescription();
					$data['amendmentTypes'] = $this->idf_model->amendmentTypes();
					$data['amendmentPurpose'] = $this->idf_model->amendmentPurpose();
					
						}else{
							echo "<font color='red'>Invalid Indent Number.</font>";
						}
					
					}
					
					$this->load->view('templates/header', $data);
					$this->load->view('templates/navigation', $data);
					$this->load->view('templates/idfamendment_view', $data);
					$this->load->view('templates/footercontent');
					$this->load->view('templates/footer');
			}else{
					$this->load->view('templates/header');
					$this->load->view('templates/login');
					$this->load->view('templates/footercontent');
					$this->load->view('templates/footer');
					}
		}
		
		public function safeAmendments()
		{	
			IF($this->idf_model->validateAmendment()==TRUE)
			{
			$this->idf_model->safeAmendments();
			}
		}
		public function safeProductAmendments()
		{	
			IF($this->idf_model->validateProductAmendment()==TRUE)
			{
			$this->idf_model->safeProductAmendments();
			}
		}	
	
		public function Procesedamendments()
		{	
						if(isset($_SESSION['IDSUser']))
			{
					$IndentNo = $this->uri->segment(3,"");

					$data['ShowProcessedIndents'] = $this->idf_model->ShowProcessedIndents();
				//	 print_r($this->idf_model->ShowProcessedIndents($IndentNo));
					if($IndentNo !="")
					{
						if($this->idf_model->checkShowProcessedIndents($IndentNo)!=0)
						{
						$data['ShowProcessedIndentsData'] = $this->idf_model->ShowProcessedIndentsData($IndentNo);
						$processed = $this->idf_model->ShowProcessedIndentsData($IndentNo);
						$AmendNo = $processed[0]->AmendNo;
						$data['ShowAmendedProducts'] = $this->idf_model->ShowAmendedProducts($IndentNo,$AmendNo);
					
						}else{
							echo "<font color='red'>Invalid Indent Number.</font>";
						}
					
					}
					
					$this->load->view('templates/header', $data);
					$this->load->view('templates/navigation', $data);
					$this->load->view('templates/procesedamendments_view', $data);
					$this->load->view('templates/footercontent');
					$this->load->view('templates/footer');
			}else{
					$this->load->view('templates/header');
					$this->load->view('templates/login');
					$this->load->view('templates/footercontent');
					$this->load->view('templates/footer');
					}
		}	
		
		public function safeProcesedAmendments()
		{
			IF($this->idf_model->validateProcessed()==TRUE)
			{
				
			$this->idf_model->safeProcessedAmendments();
			}
		}
}
		