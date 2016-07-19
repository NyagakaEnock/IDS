<?php
class Shiptracking extends CI_Controller 
{
		
        public function __construct()
        {
				
                parent::__construct();
                $this->load->model('shiptracking_model');	
				$this->load->model('proformainvoices_model');	
				$this->load->model('doctracking_model');				
                $this->load->helper('url_helper');
        }

        public function index()
        {
		
                if(isset($_SESSION['IDSUser']))
        {
			
			$data['ShowAllNewPurchaseData'] = $this->shiptracking_model->ShowAllNewPurchaseData();
						
					$IndentNo = $this->uri->segment(3,"");
					$ProductCode = $this->uri->segment(4,"");
						

						if($IndentNo !="")
						{
						if($this->shiptracking_model-> ShowAllNewPurchaseInfo($IndentNo)!= null)
							{
					$data['ShowNewAcknowledgedInfo'] = $this->shiptracking_model->ShowAllNewPurchaseInfo($IndentNo);
					$data['ShowCommodityUnderIndent'] = $this->shiptracking_model->ShowCommodityUnderIndent($IndentNo);
							if($ProductCode !="")
							{
							if($this->shiptracking_model-> ShowCommodityUnderIndentInfo($IndentNo,$ProductCode)!= null)
							{
							$data['ShowCommodityUnderIndentInfo'] = $this->shiptracking_model->ShowCommodityUnderIndentInfo($IndentNo,$ProductCode);
						
							}else
							{
								echo "<font color='red'>Invalid Product Code!!!</font>";
							}
							}
							}else
							{
								echo "<font color='red'>Invalid IndentNo No!!!</font>";
							}
						
						}
					
                        $this->load->view('templates/header', $data);
                        $this->load->view('templates/navigation', $data);
                        $this->load->view('templates/shiptracking_view', $data);
                        $this->load->view('templates/footercontent');
                        $this->load->view('templates/footer');
        }else{
                        $this->load->view('templates/header');
                        $this->load->view('templates/login');
                        $this->load->view('templates/footercontent');
                        $this->load->view('templates/footer');
                        }
        }

		public function CommercialInvoice()
		{
			if($this->shiptracking_model->ValidRecordDocument()==TRUE)
			{
			$this->shiptracking_model->CommercialInvoice();	
			}
		}
		
        public function Shippingtypes()
        {
		
                if(isset($_SESSION['IDSUser']))
        {
			
			$data['GetNewAcknowledged'] = $this->shiptracking_model->GetNewAcknowledged();
						
					$IndentNo = $this->uri->segment(3,"");
					$ProductCode = $this->uri->segment(4,"");
						

						if($IndentNo !="")
						{
						if($this->shiptracking_model-> GetNewAcknowledgedData($IndentNo)!= null)
							{
					$data['GetNewAcknowledgedData'] = $this->shiptracking_model->GetNewAcknowledgedData($IndentNo);
		
							}else
							{
								echo "<font color='red'>Invalid IndentNo No!!!</font>";
							}
						
						}
					
                        $this->load->view('templates/header', $data);
                        $this->load->view('templates/navigation', $data);
                        $this->load->view('templates/Shippingtypes_view', $data);
                        $this->load->view('templates/footercontent');
                        $this->load->view('templates/footer');
        }else{
                        $this->load->view('templates/header');
                        $this->load->view('templates/login');
                        $this->load->view('templates/footercontent');
                        $this->load->view('templates/footer');
                        }
        }
		
		public function saveShippingType()
		{
			if($this->shiptracking_model->ValidSipmentType()==true)
			{
				$this->shiptracking_model->saveShippingType();
			}
		}
		public function ShippingDetails()
		{

                if(isset($_SESSION['IDSUser']))
        {
			
			$data['GetOrdersWithType'] = $this->shiptracking_model->GetOrdersWithType();
						
					$IndentNo = $this->uri->segment(3,"");
					$ProductCode = $this->uri->segment(4,"");
						

						if($IndentNo !="")
						{
						if($this->shiptracking_model-> GetOrdersWithTypeData($IndentNo)!= null)
							{
					$data['GetOrdersWithTypeData'] = $this->shiptracking_model->GetOrdersWithTypeData($IndentNo);
					
					$partNoLength = strlen($this->shiptracking_model->GetNextPartNo($IndentNo));
					 $this->shiptracking_model->MyIndentAlphabet($partNoLength,$IndentNo);
				
					$data['ParamPorts'] = $this->shiptracking_model->ParamPorts();
					$data['DischargePorts'] = $this->shiptracking_model->DischargePorts();
					$data['ParamPackingModes'] = $this->shiptracking_model->ParamPackingModes();
					$data['CNTypeName'] = $this->shiptracking_model->CNTypeName();
					$data['DeclarantName'] = $this->shiptracking_model->DeclarantName();
					$data['getCurrency'] = $this->shiptracking_model->getCurrency();
					
							}else
							{
								echo "<font color='red'>Invalid IndentNo No!!!</font>";
							}
						
						}
					
                        $this->load->view('templates/header', $data);
                        $this->load->view('templates/navigation', $data);
                        $this->load->view('templates/Shippingdetails_view', $data);
                        $this->load->view('templates/footercontent');
                        $this->load->view('templates/footer');
        }else{
                        $this->load->view('templates/header');
                        $this->load->view('templates/login');
                        $this->load->view('templates/footercontent');
                        $this->load->view('templates/footer');
                        }
		}
			
		public function saveShippingDetails()
		{
			if($this->shiptracking_model->ValidTypesScreen()==true)
			{
				$this->shiptracking_model->safeShippingDetails();
			}
		}
		
					
		public function saveComoditiesInvoice()
		{
			
				$this->shiptracking_model->saveComoditiesInvoice();
			
		}
		public function SaveallocateWarehouse()
		{
			
				$this->shiptracking_model->SaveallocateWarehouse();
			
		}
		
		public function commoditiesInfo()
		{
                if(isset($_SESSION['IDSUser']))
        {
			
			$data['GetItemsNewOrders'] = $this->shiptracking_model->GetItemsNewOrders();
						
					$IndentNo = $this->uri->segment(3,"");
					$ProductCode = $this->uri->segment(4,"");
						

						if($IndentNo !="")
						{
						if($this->shiptracking_model-> GetItemsNewOrdersData($IndentNo)!= null)
							{
								if($ProductCode!="")
								{
										if($this->shiptracking_model-> ShowProductsUnderIndentData($IndentNo,$ProductCode )!= null)
											{
									$data['ShowProductsUnderIndentData'] = $this->shiptracking_model->ShowProductsUnderIndentData($IndentNo,$ProductCode );			
											}else{
											echo "<font color='red'>Invalid Product Code !!!</font>";	
											}
									
								}
					
					$data['ShowProductsUnderIndent'] = $this->shiptracking_model->ShowProductsUnderIndent($IndentNo);
					
					$data['GetItemsNewOrdersData'] = $this->shiptracking_model->GetItemsNewOrdersData($IndentNo);
					
						
							}else
							{
								echo "<font color='red'>Invalid IndentNo No!!!</font>";
							}
						
						}
					
                        $this->load->view('templates/header', $data);
                        $this->load->view('templates/navigation', $data);
                        $this->load->view('templates/commoditiesinfo_view', $data);
                        $this->load->view('templates/footercontent');
                        $this->load->view('templates/footer');
        }else{
                        $this->load->view('templates/header');
                        $this->load->view('templates/login');
                        $this->load->view('templates/footercontent');
                        $this->load->view('templates/footer');
                        }			
		}
		
		public function InsuranceCover()
		{
                if(isset($_SESSION['IDSUser']))
        {
			
			$data['ShowDeterminedTypes'] = $this->shiptracking_model->ShowDeterminedTypes();
						
					$IndentNo = $this->uri->segment(3,"");
					$ProductCode = $this->uri->segment(4,"");
						

						if($IndentNo !="")
						{
						if($this->shiptracking_model-> ShowDeterminedTypesData($IndentNo)!= null)
							{
								
					$data['ShowDeterminedTypesData'] = $this->shiptracking_model->ShowDeterminedTypesData($IndentNo);
					$data['getCurrency'] = $this->shiptracking_model->getCurrency();
					$data['FindBillOfLadingNo'] = $this->shiptracking_model->FindBillOfLadingNo($IndentNo);
					$data['FindBillOfLadingDate'] = $this->shiptracking_model->FindBillOfLadingDate($IndentNo);
					$data['GoodsDescription'] = $this->shiptracking_model->GoodsDescription();
					$data['BrokersName'] = $this->shiptracking_model->BrokersName();
					$data['InsurersName'] = $this->shiptracking_model->InsurersName();
					$data['DeclarantName'] = $this->shiptracking_model->DeclarantName();
					$data['ParamPorts'] = $this->shiptracking_model->ParamPorts();
					$data['TownCity'] = $this->shiptracking_model->TownCity();
				
					$FreightType = $this->shiptracking_model->ShowDeterminedTypesData($IndentNo)[0]->TransMode;
					
					$Currency = $this->shiptracking_model->ShowDeterminedTypesData($IndentNo)[0]->Currency;
					$FreightValue = $this->shiptracking_model->ShowDeterminedTypesData($IndentNo)[0]->TotalFreight;
					$TotalFOBValue = $this->shiptracking_model->ShowDeterminedTypesData($IndentNo)[0]->TotalFOBValue;
					$OtherCharges = $this->shiptracking_model->ShowDeterminedTypesData($IndentNo)[0]->TotalOtherCharges;
					$FreightCurrency = $this->shiptracking_model->ShowDeterminedTypesData($IndentNo)[0]->FreightCurrency;
					$data['ComputeInsuranceFigures'] = $this->shiptracking_model->ComputeInsuranceFigures($FreightType,$Currency,$FreightValue,$TotalFOBValue,$OtherCharges,$FreightCurrency);
					
					
						
							}else
							{
								echo "<font color='red'>Invalid IndentNo No!!!</font>";
							}
						
						}
					
                        $this->load->view('templates/header', $data);
                        $this->load->view('templates/navigation', $data);
                        $this->load->view('templates/InsuranceCover_view', $data);
                        $this->load->view('templates/footercontent');
                        $this->load->view('templates/footer');
        }else{
                        $this->load->view('templates/header');
                        $this->load->view('templates/login');
                        $this->load->view('templates/footercontent');
                        $this->load->view('templates/footer');
                        }			
		}
		public function saveInsuranceCover()
		{
		
			if($this->shiptracking_model->ValidInsuranceCover()==true)
			{
				$this->shiptracking_model->saveInsuranceCover();
			}		
		}
		 public function SaveInstructions()
		 { 
			if($this->shiptracking_model->ValidRecordInstructions()==TRUE)
			{
			$this->shiptracking_model->SaveInstructions();	
			}			 
		 }	

		public function CCRF()
		{
                if(isset($_SESSION['IDSUser']))
        {
			
			$data['GetOrdersAwaitingCCRF'] = $this->shiptracking_model->GetOrdersAwaitingCCRF();
						
					$IndentNo = $this->uri->segment(3,"");
					$CCRF = $this->uri->segment(4,"");
				
						

	if($IndentNo !="")
	{
		if($this->shiptracking_model-> ShowAWBBLDocuments($IndentNo)!= null)
		{
		$data['ShowCCRFDocuments'] = $this->shiptracking_model->ShowCCRFDocuments($IndentNo);
		
		if($CCRF !="")
		{
			$CCRF = str_replace("_","/",$CCRF);
		if($this->shiptracking_model-> ShowCCRFDocumentsData($IndentNo,$CCRF)!= null)
		{
		$data['ShowCCRFDocumentsData'] = $this->shiptracking_model->ShowCCRFDocumentsData($IndentNo,$CCRF);
		$data['ShowProductsToAssign'] = $this->shiptracking_model->ShowProductsToAssign($IndentNo);
		$data['ShowAWBBLDocuments'] = $this->shiptracking_model->ShowAWBBLDocuments($IndentNo);
			
		}else
		{
			echo "<font color='red'>Invalid CCRF No !!!</font>";
		}
		}
		$data['GetOrdersAwaitingCCRFData'] = $this->shiptracking_model->GetOrdersAwaitingCCRFData($IndentNo);
		
		}else
		{
			echo "<font color='red'>Invalid IndentNo !!!</font>";
		}
	
	}
					
                        $this->load->view('templates/header', $data);
                        $this->load->view('templates/navigation', $data);
                        $this->load->view('templates/ccrf_view', $data);
                        $this->load->view('templates/footercontent');
                        $this->load->view('templates/footer');
        }else{
                        $this->load->view('templates/header');
                        $this->load->view('templates/login');
                        $this->load->view('templates/footercontent');
                        $this->load->view('templates/footer');
                        }			
		}		 
		public function Instructions()
		{
                if(isset($_SESSION['IDSUser']))
        {
			
			$data['ShowWithDocuments'] = $this->shiptracking_model->ShowWithDocuments();
						
					$IndentNo = $this->uri->segment(3,"");
					$ProductCode = $this->uri->segment(4,"");
						

						if($IndentNo !="")
						{
						if($this->shiptracking_model-> ShowWithDocumentsData($IndentNo)!= null)
							{
					
					$data['ShowReceivedDocuments'] = $this->shiptracking_model->ShowReceivedDocuments($IndentNo);
					$data['DeclarantName'] = $this->shiptracking_model->DeclarantName();
					$data['FindInstructMessage'] = $this->shiptracking_model->FindInstructMessage();
					$data['ShowWithDocumentsData'] = $this->shiptracking_model->ShowWithDocumentsData($IndentNo);
					
						
							}else
							{
								echo "<font color='red'>Invalid IndentNo No!!!</font>";
							}
						
						}
					
                        $this->load->view('templates/header', $data);
                        $this->load->view('templates/navigation', $data);
                        $this->load->view('templates/agentsinst_view', $data);
                        $this->load->view('templates/footercontent');
                        $this->load->view('templates/footer');
        }else{
                        $this->load->view('templates/header');
                        $this->load->view('templates/login');
                        $this->load->view('templates/footercontent');
                        $this->load->view('templates/footer');
                        }			
		}
		
		 public function saveCCRF()
		 { 
			
			$this->shiptracking_model->saveCCRF();	
						 
		 }
		public function allocateWarehouse()
		{
                if(isset($_SESSION['IDSUser']))
        {
			
			$data['ShowNewDraftInst'] = $this->shiptracking_model->ShowNewDraftInst();
						
					$IndentNo = $this->uri->segment(3,"");
					$ProductCode = $this->uri->segment(4,"");
						

						if($IndentNo !="")
						{
						if($this->shiptracking_model-> ShowNewDraftInstData($IndentNo)!= null)
							{
					
					$data['ShowCurrentIndentItems'] = $this->shiptracking_model->ShowCurrentIndentItems($IndentNo);
					$data['WareHouse'] = $this->shiptracking_model->WareHouse();
					$data['ShowNewDraftInstData'] = $this->shiptracking_model->ShowNewDraftInstData($IndentNo);
					
						
							}else
							{
								echo "<font color='red'>Invalid IndentNo No!!!</font>";
							}
						
						}
					
                        $this->load->view('templates/header', $data);
                        $this->load->view('templates/navigation', $data);
                        $this->load->view('templates/allocatewarehouse_view', $data);
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