<?php
class confirmation_model extends CI_Model
	{
		
		public function __construct()
        {
                $this->load->database();
        }
		
		public function ShowAllNewIndent()
		{
			
			$SQL = "SELECT IDFMainData.*,IDFShippingInfo.TransactionTerms,ParamExporters.ExporterName FROM ParamExporters,IDFMainData,IDFShippingInfo WHERE ParamExporters.ExporterCode=IDFMainData.ExporterCode AND IDFMainData.IndentNo=IDFShippingInfo.IndentNo AND IDFMainData.Received IS NOT NULL AND IDFMainData.Orders IS NULL ORDER BY IDFMainData.IndentNo";
			
			$query = $this->db->query($SQL);
			$query->result_array();
			return $query->result();
		}
		public function IndentNos()
		{		
			$query = $this->db->query("SELECT IndentNo FROM PurchaseOrderMain WHERE ACK IS NOT NULL AND Shipping IS NULL ORDER BY IndentNo");
			return $query->result();
		}
		public function ProformaInvoiceItems()
		{	
			
			$query = $this->db->query("SELECT DISTINCT ProformaInvoiceRequest.IndentNo,ProformaInvoiceRequest.*,ParamExporters.* 	FROM ProformaInvoiceRequest,ProformaInvoiceItems,ParamExporters WHERE  ProformaInvoiceItems.IndentNo =ProformaInvoiceRequest.IndentNo 	AND ProformaInvoiceItems.Orders IS NULL AND ProformaInvoiceRequest.Received='1'  AND ParamExporters.ExporterCode=ProformaInvoiceRequest.ExporterCode");
			return $query->result();
		}	
		public function ProformaInvoiceItemsData($IndentNo)
		{	
			
			$query = $this->db->query("SELECT DISTINCT ProformaInvoiceRequest.IndentNo,ProformaInvoiceRequest.*,ParamExporters.*	FROM ProformaInvoiceRequest,ProformaInvoiceItems,ParamExporters WHERE  ProformaInvoiceItems.IndentNo =ProformaInvoiceRequest.IndentNo 	AND ProformaInvoiceItems.Orders IS NULL AND ProformaInvoiceRequest.Received='1'  AND ParamExporters.ExporterCode=ProformaInvoiceRequest.ExporterCode AND ProformaInvoiceRequest.IndentNo='{$IndentNo}'");
			return $query->result();
		}			
		public function loadShippingData($IndentNo)
		{		
			$query = $this->db->query("SELECT PurchaseOrderMain.*,ProformaInvoiceRequest.IndentDate,ProformaInvoiceRequest.Country,ProformaInvoiceRequest.ProfInvoiceNo,ProformaInvoiceRequest.ProfInvoiceDate,ParamExporters.Country FROM ProformaInvoiceRequest,PurchaseOrderMain,ParamExporters WHERE ProformaInvoiceRequest.IndentNo=PurchaseOrderMain.IndentNo AND ParamExporters.ExporterCode=PurchaseOrderMain.ExporterCode AND PurchaseOrderMain.IndentNo='{$IndentNo}'");
			return $query->result();
		}
		
		public function GetTotalPackages($IndentNo)
		{		
			$query = $this->db->query("SELECT SUM(PackagesReceived) AS TOTAL,MAX(PackageType) AS PackageType,MAX(Currency) AS MCurrency,MAX(ExchRate) AS MExchRate FROM ProformaInvoiceItems WHERE IndentNo='{$IndentNo}' AND PackagesReceived IS NOT NULL AND PackageType IS NOT NULL");
			foreach($query->result() as $key);
			$GetTotalPackages = array("MCurrency" =>$key->MCurrency,"TOTAL" =>$key->TOTAL,"PackageType" =>$key->PackageType,"MExchRate" =>$key->MExchRate);
			return $GetTotalPackages;
		}
	
		public function SearchShippingByIndentNo($IndentNo)
		{		
			$query = $this->db->query("SELECT IDFShippingInfo.*,IDFMainData.IndentDate,IDFMainData.IDFNumber FROM IDFShippingInfo,IDFMainData WHERE IDFMainData.IndentNo=IDFShippingInfo.IndentNo AND IDFShippingInfo.IndentNo='{$IndentNo}'");
			return $query->result();
		}
		public function ShowAllNewIndentData($IndentNo)
		{
		
			$SQL = "SELECT IDFMainData.*,IDFShippingInfo.TransactionTerms,ParamExporters.ExporterName FROM ParamExporters,IDFMainData,IDFShippingInfo WHERE ParamExporters.ExporterCode=IDFMainData.ExporterCode AND IDFMainData.IndentNo=IDFShippingInfo.IndentNo AND IDFMainData.Received IS NOT NULL AND IDFMainData.Orders IS NULL AND IDFMainData.IndentNo='{$IndentNo}' ORDER BY IDFMainData.IndentNo";
			
			$query = $this->db->query($SQL);
			$query->result_array();
			return $query->result();
		}		
		public function checkAllNewIndentData($IndentNo)
		{
			$SQL = "SELECT IDFMainData.*,IDFShippingInfo.TransactionTerms,ParamExporters.ExporterName FROM ParamExporters,IDFMainData,IDFShippingInfo WHERE ParamExporters.ExporterCode=IDFMainData.ExporterCode AND IDFMainData.IndentNo=IDFShippingInfo.IndentNo AND IDFMainData.Received IS NOT NULL AND IDFMainData.Orders IS NULL AND IDFMainData.IndentNo='{$IndentNo}' ORDER BY IDFMainData.IndentNo";
			$query = $this->db->query($SQL);
			return $query->num_rows();
			
		}
		public function ShowCommodityUnderIndent($IndentNo)
		{
				$SQL = "SELECT B.*,C.*,D.* FROM ProformaInvoiceItems C,ParamCommodityBrands B,ProformaInvoiceRequest D WHERE B.ProductCode=C.ProductCode AND C.IndentNo='{$IndentNo}' AND C.Orders IS NULL AND D.IndentNo=C.IndentNo AND D.Received='1' AND ExchRate IS NOT NULL ORDER BY C.ProductCode";
			$query = $this->db->query($SQL);
			$query->result_array();
			return $query->result();
			
		}
		public function ShowCommodityUnderIndentData($IndentNo,$ProductCode)
		{
			$SQL = "SELECT B.*,C.*,D.* FROM ProformaInvoiceItems C,ParamCommodityBrands B,ProformaInvoiceRequest D WHERE B.ProductCode=C.ProductCode AND C.IndentNo='{$IndentNo}' AND C.Orders IS NULL AND D.IndentNo=C.IndentNo AND D.Received='1' AND ExchRate IS NOT NULL AND C.ProductCode='{$ProductCode}'ORDER BY C.ProductCode";
			$query = $this->db->query($SQL);
			$query->result_array();
			return $query->result();
			
		}
		public function portsofDischarge()
		{
			$SQL = "SELECT * FROM ParamPorts WHERE LocalPort='1' ORDER BY PortCode";
			$query = $this->db->query($SQL);
			$query->result_array();
			return $query->result();
			
		}	
		public function ParamTransactionTerms()
		{
			$SQL = "SELECT  * FROM ParamTransactionTerms ORDER BY TransTerm";
			$query = $this->db->query($SQL);
			$query->result_array();
			return $query->result();
			
		}	
		public function ParamBankBranches()
		{
			$SQL = "SELECT * FROM ParamBankBranches ORDER BY BankCode";
			$query = $this->db->query($SQL);
			$query->result_array();
			return $query->result();
			
		}	
		public Function FindConfirmMessage($IndentNo)
		{
			$SQL = "SELECT OrderConfirm FROM ParamDefaultMEssages";
			$query = $this->db->query($SQL);
			$query->result_array();
			$FindThisPSIAgent = $this->FindThisPSIAgent($IndentNo);
			foreach($query->result() as $key);	
			$FindConfirmMessage = $key->OrderConfirm;
			 If($this->SubjectToPSI($IndentNo)==TRUE){
				 $FindConfirmMessage = $FindConfirmMessage. ". Please adhere to our documentation requirements.";
			}Else{
            $FindConfirmMessage = $FindConfirmMessage." subject to verification of comparative price by ".$FindThisPSIAgent.". Please adhere to our documentation requirements.";
			}
			return $FindConfirmMessage;
		}
	
		public function SubjectToPSI($IndentNo)
		{
			$SQL = "SELECT IDFMainData.PSIConfirm FROM IDFMainData WHERE IndentNo='{$IndentNo}'";
			$query = $this->db->query($SQL);
			$query->result_array();
			foreach($query->result() as $key);	
			
			if($query->result()!=null){
			$SubjectToPSI = $key->PSIConfirm;
			}else{
			$SubjectToPSI = "";
			return $SubjectToPSI;		
			}
			
			
			if($SubjectToPSI ==1)
			{
				return FALSE;
			}ELSE{
				RETURN TRUE;
			}
			
		}	
		public Function FindThisPSIAgent($IndentNo)
		{
			$SQL = "SELECT PSIAgency FROM IDFMainData WHERE IndentNo='{$IndentNo}'";
			$query = $this->db->query($SQL);
			$query->result_array();
			foreach($query->result() as $key);	
			if($query->result()!=null){
			$FindThisPSIAgent = $key->PSIAgency;
			return $FindThisPSIAgent;	
			}else{
			$FindThisPSIAgent = "";
			return $FindThisPSIAgent;		
			}
			
		}
				
		public function saveIDFShippingData()
		{
			
			if($this->input->post('Freight')==1)
			{
				$aA = "PAYABLE LOCALLY";
			}else{
				
				$aA = $this->input->post('ShipCurrency')." ".$this->input->post('FreightValue');
			}
			if($this->input->post('Insurance')==1)
			{
				$bB = "PAYABLE LOCALLY";
			}else{
				
				$bB = $this->input->post('ShipCurrency')." ".$this->input->post('Insurancevalue');
			}
			if($this->input->post('OtherChargesDesc')==NULL)
			{
				$cC = "N/A";
			}else{
				
				$cC = $this->input->post('ShipCurrency')." ".$this->input->post('OtherCharges');
			}
			

			$MyCurrentPeriod = $this-> MyCurrentPeriod();

			$IndentNo =$this->cleanData($this->input->post('IndentNo'));
			$DutyFree =$this->cleanData($this->input->post('DutyFree'));
			$CountryOrigin =$this->cleanData($this->input->post('Country'));
			$PortDischarge =$this->cleanData($this->input->post('Discharge'));
			$PortClearance =$this->cleanData($this->input->post('Clearance'));
			$TransMode =$this->cleanData($this->input->post('Transportation'));
			$ETD =$this->cleanData($this->input->post('EDT'));
			$LocalInsp =$this->cleanData($this->input->post('Inspectionvalue'));
			$COMESA =$this->cleanData($this->input->post('COMESAvalue'));
			$OriginalCert =$this->cleanData($this->input->post('Certificate'));
			$TransactionTerms =$this->cleanData($this->input->post('transactionTerms'));
			$Incoterm =$this->cleanData($this->input->post('Incoterm'));
			$ProfInvoiceNo = $this->cleanData($this->input->post('ProfInvoiceNo'));
			$ProfInvoiceDate =  $this->cleanData($this->input->post('InvoiceDate'));
			$Currency = $this->cleanData($this->input->post('ShipCurrency'));
			$ExchRate = $this->cleanData($this->input->post('ExchangeRate'));
			$TotalFOBValue = $this->cleanData($this->input->post('TotalFOBValue'));
			$FreightLocal = $this->cleanData($this->input->post('Freight'));
			$FreightValue = $this->cleanData($this->input->post('FreightValue'));
			$FreightString = $aA;
			$InsuranceLocal =$this->cleanData($this->input->post('Insurance'));
			$InsuranceValue =$this->cleanData($this->input->post('Insurancevalue'));
			$InsuranceString =$bB;
			$OtherCharges =$this->cleanData($this->input->post('OtherChargesDesc'));
			$currentUser = $_SESSION['IDSUser'];
			$OtherChargesValue =$this->cleanData($this->input->post('OtherCharges'));
			$OtherChargesString =$cC;
			$TotalPackages =$this->cleanData($this->input->post('TotalPackages'));
			$PackageType =$this->cleanData($this->input->post('PackageType'));
				$data = array(
				'IndentNo' => $IndentNo,
				'DutyFree' => $DutyFree,
				'CountryOrigin' => $CountryOrigin,
				'PortDischarge' => $PortDischarge,
				'PortClearance' => $PortClearance,
				'TransMode' => $TransMode,
				'ETD' => $ETD,
				'LocalInsp' => $LocalInsp,
				'COMESA' => $COMESA,
				'OriginalCert' => $OriginalCert,
				'TransactionTerms' => $TransactionTerms,
				'Incoterm' => $Incoterm,
				'ProfInvoiceNo' => $ProfInvoiceNo,
				'ProfInvoiceDate' => $ProfInvoiceDate,
				'Currency' => $Currency,
				'ExchRate' => $ExchRate,
				'TotalFOBValue' => $TotalFOBValue,
				'FreightLocal' => $FreightLocal,
				'FreightValue' => $FreightValue,
				'FreightString' => $FreightString,
				'InsuranceLocal' => $InsuranceLocal,
				'InsuranceValue' => $InsuranceValue,
				'InsuranceString' => $InsuranceString,
				'OtherCharges' => $OtherCharges,
				'OtherChargesValue' => $OtherChargesValue,
				'OtherChargesString' => $OtherChargesString,
				'TotalPackages' => $TotalPackages,
				'PackageType' => $PackageType,				
				'CreatedBy' => $currentUser,
				'DateCreated' => date('Y-m-d'),
				'AccPeriod' => $MyCurrentPeriod
				);	
				
				$this->db->insert('PurchaseOrderShip', $data);
			$this->db->query("UPDATE PurchaseOrderMain SET Shipping='1' WHERE IndentNo='{$IndentNo}'");
				echo "Record Saved Successfully.";
		}
		public function validConfirmation()
		{
			
				$state = FALSE;
				$date1=date_create(date('Y-m-d'));
				$date2=date_create($this->input->post('Date'));
				$diff=date_diff($date2,$date1);
				$diff = $diff->format("%R%a days");
				
				if($this->input->post('IndentNo')==NULL)
				{
				echo "<font color='red'>No Record Selected.</font>";
				$state = FALSE;
				}elseif($this->input->post('Date')==NULL)
				{
				echo "<font color='red'>Required  I.D.F. Date</font>";
				$state = FALSE;
				}elseif($diff>0)
				{
				echo "<font color='red'>Invalid Expected Date </font>";
				$state = FALSE;
				}elseif($this->input->post('Discharge')==NULL)
				{
				echo "<font color='red'>Port of Discharge Required</font>";
				$state = FALSE;
				}elseif($this->input->post('Terms')==NULL)
				{
				echo "<font color='red'>Terms of Payment Required</font>";
				$state = FALSE;
				}elseif($this->input->post('Bank')==NULL)
				{
				echo "<font color='red'>Required Bank </font>";
				$state = FALSE;
				}elseif($this->input->post('Message')==NULL)
				{
				echo "<font color='red'>Required Message of Confirmation. </font>";
				$state = FALSE;
				}elseif($this->input->get('counter')==0)
				{
				echo "<font color='red'>There are no Products Under this Intent. </font>";
				$state = FALSE;
				}else{
					$state = TRUE;
				}	
				RETURN $state;				
				
		}
		public function safeConfirmation()
		{
					$IndentNo = $this->input->post('IndentNo');				
					$array[] = $this->ProformaInvoiceItemsData($IndentNo);
					$productIDS = substr($this->input->get('productIDS'),2);
			
					$productIDSARRAY =explode(",",$productIDS);
					
				if($productIDS==NULL)
				{
				echo "<font color='red'>Select Products to Confirm. </font>";
				return;
				}
					if(!empty($IndentNo)){
					foreach($array as $rows);
					
			
			foreach($rows as $key);
							$ExporterCode = $key->ExporterCode;
							$ImporterCode = $key->ImporterCode;		
									
									foreach($productIDSARRAY as $productID)
										{
			$ProduARRY =$this-> ShowCommodityUnderIndentData($IndentNo,$productID);
			if($ProduARRY!=NULL){
										
													$data = array(
													'IndentNo' => $IndentNo,
													'ProductCode' => $productID,
													'ProductName1' =>  $ProduARRY[0]->ProductName,
													'PackageType' =>  $ProduARRY[0]->PackageType,
													'TotalPackages' => $ProduARRY[0]->PackagesReceived,
													'QttyUnits' => $ProduARRY[0]->QttyUnits,
													'Currency' => $ProduARRY[0]->Currency,	
													'ExchRate' => $ProduARRY[0]->ExchRate,	
													'FOBValue' => $ProduARRY[0]->TotalValue,
													'GrossWeight' => $ProduARRY[0]->GrossWeight,
													'NetWeight' => $ProduARRY[0]->NetWeight,
													'Country' => $ProduARRY[0]->Country,
													'CreatedBy' => $_SESSION['IDSUser'],
													'DateCreated' => date('Y-m-d'),
													'AccPeriod' => $this->MyCurrentPeriod()
													);	
								

					if($this->countConfirmed($IndentNo,$productID)==NULL)
					{	
					$this->db->insert('PurchaseOrderData', $data);
					}
					$this->db->query("UPDATE IDFCommoditiesInfo SET Orders='1' WHERE IndentNo='{$IndentNo}' AND ProductCode='{$productID}'");
				
						
		$this->db->query("UPDATE ProformaInvoiceItems SET Orders='1' WHERE IndentNo='{$IndentNo}' AND ProductCode='{$productID}'");	
					
					
										
											
										}
								
								}
					$DutyFree = "NO";
					$this->PurchaseOrderMain($DutyFree,$ImporterCode,$ExporterCode);
					echo "Record Saved Successfully.";
										
					}else{
						echo "<font color='red'>Select A record to Confirm.</font>";
					}
		}
		public function countConfirmed($IndentNo,$ProductCode)
		{
			$SQL = "SELECT PurchaseOrderData.* FROM PurchaseOrderData WHERE PurchaseOrderData.IndentNo='{$IndentNo}' AND ProductCode='{$ProductCode}' ";
			
			$query = $this->db->query($SQL);
			return $query->result();			
		}
		public function safeConfirmationNonIndent()
		{
					$IndentNo = $this->input->post('IndentNo');				
					$array[] = $this->ShowCommodityUnderIndent($IndentNo);
					$productIDS = substr($this->input->get('productIDS'),2);
					$productIDSARRAY =explode(",",$productIDS);
				
			if(empty($productIDS))
			{
				echo "<font color='red'>Please Select atleast one or More Products</font>";
				return;
			}
					if(!empty($IndentNo)){
					foreach($array as $rows)
					{
							foreach($rows as $key)
								{
									foreach($productIDSARRAY as $productID)
										{
											if($key->ProductCode==$productID)
												{
													
													
													$data = array(
													'IndentNo' => $IndentNo,
													'ProductCode' => $key->ProductCode,
													'ProductName1' =>  $key->ProductName,
													'PackageType' =>  $key->PackageType,
													'TotalPackages' => $key->TotalPackages,
													'UnitSize' =>  $key->UnitSize,
													'QttyUnits' => $key->QttyUnits,
													'Currency' => $key->Currency,	
													'ExchRate' => $key->ExchRate,	
													'FOBValue' => $key->FOBValue,
													'GrossWeight' => $key->GrossWeight,
													'NetWeight' => $key->NetWeight,
													'Country' => $key->Country,
													'CreatedBy' => $_SESSION['IDSUser'],
													'DateCreated' => date('Y-m-d'),
													'AccPeriod' => $this->MyCurrentPeriod()
													);	

										$this->db->insert('PurchaseOrderData', $data);
										$this->db->query("UPDATE IDFCommoditiesInfo SET Orders='1' WHERE IndentNo='{$IndentNo}' AND ProductCode='{$productID}'");
										$this->db->query("UPDATE ProformaInvoiceItems SET Orders='1' WHERE IndentNo='{$IndentNo}' AND ProductCode='{$productID}'");	
										
											}
										}
								}
					}
					$DutyFree = "YES";
					$this->PurchaseOrderMain($DutyFree);
					echo "Record Saved Successfully.";
					}else{
						echo "<font color='red'>Select A record to Confirm.</font>";
					}
		}
		public function PurchaseOrderMain($DutyFree,$ImporterCode,$ExporterCode)
		{
					$IndentNo = $this->input->post('IndentNo');	
					
	if(!empty($IndentNo)){
				
						if($DutyFree=="NO"){
					$IDFNumber = "";
					}elseif($DutyFree=="YES"){
					$IDFNumber = "";
					}
							$data = array(
										'IndentNo' => $IndentNo,
										'IDFNumber' => $IDFNumber,
										'DutyFree' =>  $DutyFree,
										'OrderDate' => date('Y-m-d'),
										'AckExpected' => $this->cleanData($this->input->post('date')),
										'ImporterCode' => $ImporterCode,
										'ExporterCode' =>  $ExporterCode,
										'ConfirmMEssage' => $this->cleanData($this->input->post('Message')),
										'OtherInformation' => "",
										'StaffIdNo' => $this->GetCurrentStaffID(),
										'TotalITems' => $this->cleanData($this->input->get('counter')),
										'TransTerm' => $this->cleanData($this->input->post('Terms')),
										'ShipTo' => $this->cleanData($this->input->post('Discharge')),
										'BankCode' =>  $this->cleanData($this->input->post('Bank')),
										'CreatedBy' => $_SESSION['IDSUser'],
										'DateCreated' => date('Y-m-d'),
										'AccPeriod' => $this->MyCurrentPeriod()
										);	
					if($this->ShowCommodityUnderIndent($IndentNo)==NULL)
					{	
					$this->db->query("UPDATE ProformaInvoiceRequest SET Orders='1' WHERE IndentNo='{$IndentNo}'");
					}
					if($this->checkPurchaseOrderMain($IndentNo)==NULL)
					{	
					$this->db->insert('PurchaseOrderMain', $data);
					}
					
					if($this->ShowCommodityUnderIndent($IndentNo)==NULL)
					{	
					$this->db->query("UPDATE ProformaInvoiceRequest SET Orders='1' WHERE IndentNo='{$IndentNo}'");
					}
					
					
					if($DutyFree=="NO"){
					$this->db->query("UPDATE IDFMainData SET Orders='1' WHERE IndentNo='{$IndentNo}'");
					}elseif($DutyFree=="YES"){
					$this->db->query("UPDATE ProformaInvoiceRequest SET Orders='1' WHERE IndentNo='{$IndentNo}'");	
					}
					$this->db->query("UPDATE PurchaseOrderMain SET TotalPacks=(SELECT SUM(TotalPackages) AS TOTAL FROM PurchaseOrderData WHERE PurchaseOrderData.IndentNo='{$IndentNo}'),PackageType=(SELECT MAX(PackageType) AS TYPE FROM PurchaseOrderData WHERE PurchaseOrderData.IndentNo='{$IndentNo}') WHERE IndentNo='{$IndentNo}'");
					
					
					}else{
						echo "<font color='red'>Select A record to Confirm.</font>";
					}			
		}
		public function cleanData($input)
		 {
			 $cleanData = $this->security->xss_clean($input );
			 $cleanData = strip_tags(str_replace(array("'","<script>","</script>"),array("`","<!--","-->"),$cleanData));
			 return $cleanData;
		 }
		public function MyCurrentPeriod()
		{
			return	$MyCurrentPeriod = date("Y/m");
		}
		Public Function GetCurrentStaffID()
		{
			$CurrentUserName=$_SESSION['IDSUser'];
			$query = $this->db->query("SELECT StaffIDNo FROM AdminUserRegister WHERE UserName='{$CurrentUserName}'");
			$query->result_array();
			foreach($query->result() as $key);
			return $key->StaffIDNo;
		}
		public function checkPurchaseOrderMain($IndentNo)
		{			
			$SQL = "SELECT * FROM PurchaseOrderMain WHERE IndentNo='{$IndentNo}'";			
			$query = $this->db->query($SQL);
			return $query->result();
		}		
		
		public function ShowCommodityDutyFree($IndentNo)
		{
			
			$SQL = "SELECT ParamCommodityBrands.*,ProformaInvoiceItems.* FROM ProformaInvoiceItems,ParamCommodityBrands WHERE ParamCommodityBrands.ProductCode=ProformaInvoiceItems.ProductCode AND ProformaInvoiceItems.IndentNo='{$IndentNo}' AND ProformaInvoiceItems.Orders IS NULL ORDER BY ProformaInvoiceItems.ProductCode";
			
			$query = $this->db->query($SQL);
			return $query->result();
		}
		public function ShowAllNewNonIDF()
		{
			
			$SQL = "SELECT ProformaInvoiceRequest.*,ParamExporters.ExporterName FROM ParamExporters,ProformaInvoiceRequest WHERE ParamExporters.ExporterCode=ProformaInvoiceRequest.ExporterCode AND ProformaInvoiceRequest.ProfInvoiceNo IS NOT NULL AND ProformaInvoiceRequest.Orders IS NULL AND (ProformaInvoiceRequest.DutyFree='1' OR ProformaInvoiceRequest.DutyFree='1' OR DestCountry<>'KE') ORDER BY ProformaInvoiceRequest.IndentNo";
			
			$query = $this->db->query($SQL);
			$query->result_array();
			return $query->result();
		}
		public function ShowAllNewNonIDFDATA($IndentNo)
		{
			
			$SQL = "SELECT ProformaInvoiceRequest.*,ParamExporters.ExporterName FROM ParamExporters,ProformaInvoiceRequest WHERE ParamExporters.ExporterCode=ProformaInvoiceRequest.ExporterCode AND ProformaInvoiceRequest.ProfInvoiceNo IS NOT NULL AND ProformaInvoiceRequest.Orders IS NULL AND (ProformaInvoiceRequest.DutyFree='1' OR ProformaInvoiceRequest.DutyFree='1' OR DestCountry<>'KE') AND ProformaInvoiceRequest.IndentNo='{$IndentNo}' ORDER BY ProformaInvoiceRequest.IndentNo";
			
			$query = $this->db->query($SQL);
			$query->result_array();
			return $query->result();
		}	
		public function checkShowAllNewNonIDF($IndentNo)
		{
			
			$SQL = "SELECT ProformaInvoiceRequest.*,ParamExporters.ExporterName FROM ParamExporters,ProformaInvoiceRequest WHERE ParamExporters.ExporterCode=ProformaInvoiceRequest.ExporterCode AND ProformaInvoiceRequest.ProfInvoiceNo IS NOT NULL AND ProformaInvoiceRequest.Orders IS NULL AND (ProformaInvoiceRequest.DutyFree='1' OR ProformaInvoiceRequest.DutyFree='1' OR DestCountry<>'KE') AND ProformaInvoiceRequest.IndentNo='{$IndentNo}' ORDER BY ProformaInvoiceRequest.IndentNo";
			
			$query = $this->db->query($SQL);
			
			return $query->num_rows();
		}		
		
		public function ShowAllNewPurchaseData()
		{
			$query = $this->db->query("SELECT PurchaseOrderMain.*,ParamExporters.ExporterName FROM ParamExporters,PurchaseOrderMain WHERE ParamExporters.ExporterCode=PurchaseOrderMain.ExporterCode AND PurchaseOrderMain.ACK IS NULL ORDER BY PurchaseOrderMain.IndentNo");
			$query->result_array();
			return $query->result();			
		}
		public function CHECKShowAllNewPurchaseData($IndentNo)
		{
			$query = $this->db->query("SELECT PurchaseOrderMain.*,ParamExporters.ExporterName FROM ParamExporters,PurchaseOrderMain WHERE ParamExporters.ExporterCode=PurchaseOrderMain.ExporterCode AND PurchaseOrderMain.ACK IS NULL AND PurchaseOrderMain.IndentNo='{$IndentNo}' ORDER BY PurchaseOrderMain.IndentNo");
			return $query->num_rows();			
		}
		public function ShowAllNewPurchaseDataInfo($IndentNo)
		{
			$query = $this->db->query("SELECT PurchaseOrderMain.*,ParamExporters.ExporterName FROM ParamExporters,PurchaseOrderMain WHERE ParamExporters.ExporterCode=PurchaseOrderMain.ExporterCode AND PurchaseOrderMain.ACK IS NULL AND PurchaseOrderMain.IndentNo='{$IndentNo}' ORDER BY PurchaseOrderMain.IndentNo");
			$query->result_array();
			return $query->result();			
		}
		
		public function safeAcknowledement()
		{
					$IndentNo = $this->input->post('IndentNo');				
					$array[] = $this->ShowAllNewPurchaseDataInfo($IndentNo);
					$productIDS = substr($this->input->get('productIDS'),2);
					$productIDSARRAY = explode(",",$productIDS);
					$date = $this->input->post('Date');
					$counter = $this->input->get('counter');
			if(empty($productIDS))
			{
				echo "<font color='red'>Please Select atleast one or More Products</font>";
				return;
			}
			
					if(!empty($IndentNo)){
					foreach($array as $rows)
					{
						
									foreach($productIDSARRAY as $productID)
										{
												
	$this->db->query("UPDATE PurchaseOrderMain SET ACK='1',ACKDate='{$date}',TotalItems='{$counter}' WHERE IndentNo='{$IndentNo}'");
	$this->db->query("UPDATE PurchaseOrderData SET Received='1' WHERE IndentNo='{$IndentNo}' AND ProductCode='{$productID}'");	
										
										}
								
					}
					
					
					echo "Record Saved Successfully.";
					}else{
						echo "<font color='red'>Select A record to Confirm.</font>";
					}			
		}
		public function ShowCommodityUnderIndentPurchase($IndentNo)
		{
			$query = $this->db->query("SELECT ParamCommodityBrands.*,PurchaseOrderData.* FROM PurchaseOrderData,ParamCommodityBrands WHERE ParamCommodityBrands.ProductCode=PurchaseOrderData.ProductCode AND PurchaseOrderData.IndentNo='{$IndentNo}' AND PurchaseOrderData.Received IS NULL ORDER BY PurchaseOrderData.ProductCode");
			$query->result_array();
			return $query->result();				
		}
		public function ShowAllOldPurchaseData()
		{
			$query = $this->db->query("SELECT PurchaseOrderMain.*,ParamExporters.ExporterName FROM ParamExporters,PurchaseOrderMain WHERE ParamExporters.ExporterCode=PurchaseOrderMain.ExporterCode AND PurchaseOrderMain.ACK IS NOT NULL ORDER BY PurchaseOrderMain.IndentNo");
			$query->result_array();
			return $query->result();				
		}
		public function ShowAllPurchaseData()
		{
			$query = $this->db->query("SELECT PurchaseOrderMain.*,ParamExporters.ExporterName FROM ParamExporters,PurchaseOrderMain WHERE ParamExporters.ExporterCode=PurchaseOrderMain.ExporterCode ORDER BY PurchaseOrderMain.IndentNo");
			$query->result_array();
			return $query->result();				
		}
		
		public function CHECKShowAllOldPurchaseData($IndentNo)
		{
			$query = $this->db->query("SELECT PurchaseOrderMain.*,ParamExporters.ExporterName FROM ParamExporters,PurchaseOrderMain WHERE ParamExporters.ExporterCode=PurchaseOrderMain.ExporterCode AND PurchaseOrderMain.ACK IS NOT NULL AND PurchaseOrderMain.IndentNo='{$IndentNo}' ORDER BY PurchaseOrderMain.IndentNo");
			
			return $query->num_rows();			
		}
		public function ShowAllOldPurchaseDataInfo($IndentNo)
		{
			$query = $this->db->query("SELECT PurchaseOrderMain.*,ParamExporters.ExporterName FROM ParamExporters,PurchaseOrderMain WHERE ParamExporters.ExporterCode=PurchaseOrderMain.ExporterCode AND PurchaseOrderMain.ACK IS NOT NULL AND PurchaseOrderMain.IndentNo='{$IndentNo}' ORDER BY PurchaseOrderMain.IndentNo");
			$query->result_array();
			return $query->result();		
		}
		
		public function CHECKShowAllPurchaseData($IndentNo)
		{
			$query = $this->db->query("SELECT PurchaseOrderMain.*,ParamExporters.ExporterName FROM ParamExporters,PurchaseOrderMain WHERE ParamExporters.ExporterCode=PurchaseOrderMain.ExporterCode AND PurchaseOrderMain.IndentNo='{$IndentNo}' ORDER BY PurchaseOrderMain.IndentNo");
			
			return $query->num_rows();			
		}
		public function ShowAllPurchaseDataInfo($IndentNo)
		{
			$query = $this->db->query("SELECT PurchaseOrderMain.*,ParamExporters.ExporterName FROM ParamExporters,PurchaseOrderMain WHERE ParamExporters.ExporterCode=PurchaseOrderMain.ExporterCode AND PurchaseOrderMain.IndentNo='{$IndentNo}' ORDER BY PurchaseOrderMain.IndentNo");
			$query->result_array();
			return $query->result();		
		}
	}
?>