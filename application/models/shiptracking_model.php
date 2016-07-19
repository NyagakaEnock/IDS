<?php
class shiptracking_model extends CI_Model
	{
		
		public function __construct()
        {
                $this->load->database();
        }
	
		public function ShowAllNewPurchaseData()
		{
				$query = $this->db->query("SELECT PurchaseOrderMain.*,ParamExporters.ExporterName FROM ParamExporters,PurchaseOrderMain WHERE ParamExporters.ExporterCode=PurchaseOrderMain.ExporterCode AND PurchaseOrderMain.ACK IS NOT NULL AND PurchaseOrderMain.DocsRec IS NOT NULL AND PurchaseOrderMain.Verify IS NULL ORDER BY PurchaseOrderMain.IndentNo");
				return $query->result();		
		}
		public function ShowAllNewPurchaseInfo($IndentNo)
		{
				$query = $this->db->query("SELECT PurchaseOrderMain.*,ParamExporters.ExporterName FROM ParamExporters,PurchaseOrderMain WHERE ParamExporters.ExporterCode=PurchaseOrderMain.ExporterCode AND PurchaseOrderMain.ACK IS NOT NULL AND PurchaseOrderMain.DocsRec IS NOT NULL AND PurchaseOrderMain.Verify IS NULL AND PurchaseOrderMain.IndentNo='{$IndentNo}'ORDER BY PurchaseOrderMain.IndentNo");
				return $query->result();		
		}
		public function ShowCommodityUnderIndent($IndentNo)
		{
				$query = $this->db->query("SELECT ParamCommodityBrands.ProductName,ParamCommodityBrands.CommodityCode,ParamCommodityBrands.SITC,ParamCommodityBrands.UnitsPerPack,ParamPackageTypes.PackageTypeName,PurchaseOrderData.* FROM PurchaseOrderData,ParamPackageTypes,ParamCommodityBrands WHERE ParamPackageTypes.PackageType=PurchaseOrderData.PackageType AND ParamCommodityBrands.ProductCode=PurchaseOrderData.ProductCode AND PurchaseOrderData.IndentNo='{$IndentNo}' AND PurchaseOrderData.Received IS NOT NULL AND PurchaseOrderData.Verify IS NULL ORDER BY PurchaseOrderData.ProductCode");
				return $query->result();			
		}
		public function ShowCommodityUnderIndentInfo($IndentNo,$ProductCode)
		{
				$query = $this->db->query("SELECT ParamCommodityBrands.ProductName,ParamCommodityBrands.CommodityCode,ParamCommodityBrands.SITC,ParamCommodityBrands.UnitsPerPack,ParamPackageTypes.PackageTypeName,PurchaseOrderData.* FROM PurchaseOrderData,ParamPackageTypes,ParamCommodityBrands WHERE ParamPackageTypes.PackageType=PurchaseOrderData.PackageType AND ParamCommodityBrands.ProductCode=PurchaseOrderData.ProductCode AND PurchaseOrderData.IndentNo='{$IndentNo}' AND PurchaseOrderData.Received IS NOT NULL AND PurchaseOrderData.Verify IS NULL AND PurchaseOrderData.ProductCode='{$ProductCode}' ORDER BY PurchaseOrderData.ProductCode");
				return $query->result();			
		}
		
		public Function ValidTypesScreen()
		{
			$ShippingDate=date_create($this->input->post('ShippingDate'));
			$DateExpected=date_create($this->input->post('DateExpected'));
			$diff=date_diff($ShippingDate,$DateExpected);
			$diff = $diff->format("%R%a");
				if($this->proformainvoices_model->GetCurrentSellingRate($this->input->post('Currency'))==NULL){
				echo "<font color='red'>This Weeks's Exchange Rate has not been Set. Please Contact System Administrator the Try again.</font>";
				$state = FALSE;
				}elseif($this->input->post('IndentNo')==NULL)
				{
				echo "<font color='red'>No Record Selected.</font>";
				$state = FALSE;
				}elseif($this->input->post('ShippingDate')==NULL)
				{
				echo "<font color='red'>Required Date of Shipping</font>";
				$state = FALSE;
				}elseif($this->input->post('DateExpected')==NULL)
				{
				echo "<font color='red'>Required Date Expected</font>";
				$state = FALSE;
				}elseif($diff<=0){
					echo "<font color='red'>Expected Date Cannot be earlier than or equal to Shipping Date.</font>";
					$state = FALSE;
				}elseif($this->input->post('LoadingPort')==NULL)
				{
				echo "<font color='red'>Required Port of Loading</font>";
				$state = FALSE;
				}elseif($this->input->post('VesselName')==NULL)
				{
				echo "<font color='red'>Required Vessel Code</font>";
				$state = FALSE;
				}elseif($this->input->post('TranshippingPort')==NULL)
				{
				echo "<font color='red'>Required Port of Transhipment or 'N/A' if there's None</font>";
				$state = FALSE;
				}elseif($this->input->post('TranshippingVessel')==NULL)
				{
				echo "<font color='red'>Required Transhipping Vessel or 'N/A' if there's None</font>";
				$state = FALSE;
				}elseif($this->input->post('DischargePort')==NULL)
				{
				echo "<font color='red'>Required Port of Discharge</font>";
				$state = FALSE;
				}elseif($this->input->post('MarksandNumbers')==NULL)
				{
				echo "<font color='red'>Required Container Marks and Numbers</font>";
				$state = FALSE;
				}elseif($this->input->post('NameofDeclarant')==NULL)
				{
				echo "<font color='red'>Required Declarant's Name</font>";
				$state = FALSE;
				}elseif($this->input->post('PackingMode')==NULL)
				{
				echo "<font color='red'>Required Packing Mode</font>";
				$state = FALSE;
				}elseif($this->input->post('Freightvalue')==NULL)
				{
				echo "<font color='red'>Required Value of Freight in the Specified Currency or Zero if Payable Locally</font>";
				$state = FALSE;
				}elseif($this->input->post('Insurance')==NULL)
				{
				echo "<font color='red'>Required Value of Insurance in the Specified Currency or Zero if Payable Locally</font>";
				$state = FALSE;
				}elseif($this->input->post('OtherCharges')==NULL)
				{
				echo "<font color='red'>Required Sum of Other Charges in the Specified Currency or Zero if There is None</font>";
				$state = FALSE;
				}elseif($this->input->post('Description')==NULL)
				{
				echo "<font color='red'>Required Description.</font>";
				$state = FALSE;
				}elseif($this->input->post('Total')==NULL)
				{
				echo "<font color='red'>Required Total Number.</font>";
				$state = FALSE;
				}else{
					$state= true;
				}
			return $state;
		}
		
		public function CommercialInvoice()
		{
					$IndentNo = $this->input->post('IndentNo');	
					$GrossWeight = $this->input->post('GrossWeight');	
					$NetWeight = $this->input->post('NetWeight');
					$array[] = $this->ShowAllNewPurchaseInfo($IndentNo);
					$productIDS = substr($this->input->get('productIDS'),2);
					$productIDSARRAY = explode(",",$productIDS);
					$counter = $this->input->get('counter');
					
			if(empty($productIDS))
			{
				echo "<font color='red'>Please Select a Product.</font>";
				return;
			}
		
			
					if(!empty($IndentNo)){
					foreach($array as $rows)
					{
						
									foreach($productIDSARRAY as $productID);
										
								$array2[] = $this->ShowCommodityUnderIndentInfo($IndentNo,$productID);
								foreach($array2 as $rows2)
								{
									$Currency = $rows2[0]->Currency;
			if($this->proformainvoices_model->GetCurrentSellingRate($rows2[0]->Currency)!=null)
			{
			
			$EXCHRATE = $this->proformainvoices_model->GetCurrentSellingRate($Currency)[0]->SellingRate;
			}else
			{
				$EXCHRATE='0.00';
				echo "<font color='red'>This week's Exchange Rate has not been Set. Contact System Administrator the try again.</font>";
				return;
			}	
			
				$totalVal = $this->input->post('TotalValue');
				$packageReceived = $this->input->post('PackagesReceived');
				$ValuePerPack = $totalVal/$packageReceived ;
				$UnitValue = $ValuePerPack/$rows2[0]->UnitsPerPack;
				$UnitValueKsh = ($UnitValue*$EXCHRATE);		
				
				if($this->input->post('PackagesReceived')==0)
				{
				$ActTotalValue = 0;
				$ActValuePerPack = 0;
				$ActUnitValue = 0;
				$ActUnitValueKsh = 0;
				}else{
				//Computing Actual Values
				$ActTotalValue = ($rows2[0]->FOBValue/$rows2[0]->TotalPackages)*$packageReceived;
				$ActValuePerPack = $ActTotalValue/$packageReceived;
				$ActUnitValue = $ActTotalValue / ($rows2[0]->UnitsPerPack*$packageReceived);
				$ActUnitValueKsh = $EXCHRATE* $ActUnitValue;
				//Computing Balances
				if($this->input->post('PackagesReceived')==$rows2[0]->TotalPackages)
				{
					$BalPackages=1;
				}else{
						$BalPackages = $rows2[0]->TotalPackages-$packageReceived;
				}
			
				$BalGrossWeight = $rows2[0]->GrossWeight-$GrossWeight;
				$BalNetWeight = $rows2[0]->NetWeight-$NetWeight;
				$BalTotalValue =$BalPackages*$ActTotalValue/$packageReceived;
				$BalValuePerPack = $BalTotalValue/$BalPackages;
				$BalUnitValue = $BalValuePerPack/$rows2[0]->UnitsPerPack;
				$BalUnitValueKsh = $BalUnitValue*$EXCHRATE;
				
											$data = array(
											'IndentNo' => $IndentNo,
											'ProductCode' => $productID,
											'UnitSize' => $rows2[0]->UnitSize,
											'QttyUnits' => $rows2[0]->QttyUnits,
											'Country' => $rows2[0]->Country,
											'Currency' => $rows2[0]->Currency,
											'ExchRate' => $EXCHRATE,
											'PackageType' => $rows2[0]->PackageType,
											'TotalPackages' => $rows2[0]->TotalPackages,
											'GrossWeight' => $rows2[0]->GrossWeight,
											'NetWeight' => $rows2[0]->NetWeight,
											'TotalValue' => $totalVal,
											'ValuePerPack' => $ValuePerPack,
											'UnitValue' => $UnitValue,
											'ActPacks' => $packageReceived,
											'ActGross' => $GrossWeight,
											'ActNetWt' => $NetWeight,
											'ActTotVal' => $ActTotalValue,
											'ActValPack' => $ActValuePerPack,
											'ActUnitVal' => $ActUnitValue,
											'BalPacks' => $BalPackages,
											'BalGross' => $BalGrossWeight,
											'BalNetWt' => $BalNetWeight,
											'BalTotVal' => $BalTotalValue,
											'BalValPack' => $BalValuePerPack,
											'BalUnitVal' => $BalUnitValue,
						
											);	
											$data2 = array(	'ShipTypAlloc' => '0',
											'ShipTypeBal' => $packageReceived,
											'CreatedBy' => $_SESSION['IDSUser'],
											'DateCreated' => date('Y-m-d'),
											'AccPeriod' => date("Y/m"));
											
											$arrayFinal = array_merge($data,$data2);
										
					if($this->ItemAlreadyExists($productID,$IndentNo)!=1)
					{
						
						$this->db->insert('PurchaseOrderComm', $arrayFinal);
						$this->db->query("UPDATE PurchaseOrderData SET Verify='1' WHERE IndentNo='{$IndentNo}' AND ProductCode='{$productID}'");
						$this->db->query("UPDATE PurchaseOrderShip SET Currency='{$rows2[0]->Currency}',ExchRate='{$EXCHRATE}',PackageType='{$rows2[0]->PackageType}',TotalPackages=(SELECT SUM(TotalPackages) AS TotalPACKS FROM PurchaseOrderComm WHERE PurchaseOrderComm.IndentNo='{$IndentNo}'),TotalFOBValue=(SELECT SUM(TotalValue) AS TotalFOB FROM PurchaseOrderComm WHERE PurchaseOrderComm.IndentNo='{$IndentNo}') WHERE IndentNo='{$IndentNo}'");
						if($this->AllItemsEntered($IndentNo)!=0)
							{
						$this->db->query("UPDATE PurchaseOrderMain SET Verify='1' WHERE IndentNo='{$IndentNo}'");	
							}
						if($this->input->post('PackagesReceived')!=$rows2[0]->TotalPackages)
							{
						$this->db->query("UPDATE PurchaseOrderMain SET Varian='Y' WHERE IndentNo='{$IndentNo}'");
							}
							
					
					}else{
						
						$this->db->where('IndentNo',$IndentNo);
						$this->db->where('ProductCode',$productID);
						$this->db->update('PurchaseOrderComm', $data);
						if($this->input->post('PackagesReceived')!=$rows2[0]->TotalPackages)
							{
						$this->db->query("UPDATE PurchaseOrderMain SET Varian='Y' WHERE IndentNo='{$IndentNo}'");
							}
					}
				}
								}										
								
						
								
					}
					
					
					echo "Record Saved Successfully.";
					}else{
						echo "<font color='red'>Select A record to Confirm.</font>";
					}	
		}
		public Function AllItemsEntered($IndentNo)
		{
				$query = $this->db->query("SELECT COUNT(ProductCode) AS MyProduct FROM PurchaseOrderData WHERE PurchaseOrderData.IndentNo='{$IndentNo}' AND PurchaseOrderData.Verify IS NULL");
				return $query->result()[0]->MyProduct;			
		}
		public Function ItemAlreadyExists($ProductCode,$IndentNo)
		{
				$query = $this->db->query("SELECT COUNT(ProductCode) AS MyProduct FROM PurchaseOrderComm WHERE PurchaseOrderComm.ProductCode='{$ProductCode}' AND PurchaseOrderComm.IndentNo='{$IndentNo}'");
				return $query->result()[0]->MyProduct;				
		}
		public Function GetNewAcknowledged()
		{
				$query = $this->db->query("SELECT PurchaseOrderMain.*,PurchaseOrderShip.InsuranceLocal,PurchaseOrderShip.Currency,PurchaseOrderShip.TotalFOBValue,PurchaseOrderShip.FreightValue,PurchaseOrderShip.InsuranceValue,PurchaseOrderShip.OtherChargesValue FROM PurchaseOrderShip,PurchaseOrderMain WHERE PurchaseOrderShip.IndentNo=PurchaseOrderMain.IndentNo AND PurchaseOrderMain.Verify IS NOT NULL AND (PurchaseOrderMain.Types IS NULL OR PurchaseOrderMain.Types='') ORDER BY PurchaseOrderMain.IndentNo");
				return $query->result();				
		}
		public Function GetNewAcknowledgedData($IndentNo)
		{
				$query = $this->db->query("SELECT PurchaseOrderMain.*,PurchaseOrderShip.InsuranceLocal,PurchaseOrderShip.Currency,PurchaseOrderShip.TotalFOBValue,PurchaseOrderShip.FreightValue,PurchaseOrderShip.InsuranceValue,PurchaseOrderShip.OtherChargesValue FROM PurchaseOrderShip,PurchaseOrderMain WHERE PurchaseOrderShip.IndentNo=PurchaseOrderMain.IndentNo AND PurchaseOrderMain.Verify IS NOT NULL AND (PurchaseOrderMain.Types IS NULL OR PurchaseOrderMain.Types='') AND PurchaseOrderMain.IndentNo='{$IndentNo}' ORDER BY PurchaseOrderMain.IndentNo");
				return $query->result();				
		}
		public function saveShippingType()
		{
			$type = $this->input->post('psivalue');
			$parts = $this->input->post('Handleval');
			$total = $this->input->post('Total');
			$IndentNo = $this->input->post('IndentNo');
			$query = $this->db->query("UPDATE PurchaseOrderMain SET Types='{$type}',PartsBy='{$parts}',TotalParts='{$total}' WHERE IndentNo='{$IndentNo }'");
			echo "Record Saved Successfully.";
		}
		public function ValidSipmentType()
		{
				
				if($this->input->post('IndentNo')==NULL)
				{
				echo "<font color='red'>No Record Selected.</font>";
				$state = FALSE;
				}elseif($this->input->post('psivalue')==NULL)
				{
				echo "<font color='red'>Select the Type of Shipment</font>";
				$state = FALSE;
				}elseif(($this->input->post('Handleval')==NULL)&& $this->input->post('psivalue')=='P')
				{
				echo "<font color='red'>Select How to Handle Part Shipment</font>";
				$state = FALSE;
				}elseif($this->input->post('Total')==NULL)
				{
				echo "<font color='red'>Total Parts Required.</font>";
				$state = FALSE;
				}else{
					$state = TRUE;
				}
				return $state;
		}

		public Function GetOrdersWithType()
		{
				$query = $this->db->query("SELECT PurchaseOrderMain.*,PurchaseOrderShip.InsuranceLocal,PurchaseOrderShip.Currency,PurchaseOrderShip.TotalFOBValue,PurchaseOrderShip.FreightValue,PurchaseOrderShip.InsuranceValue,PurchaseOrderShip.OtherChargesValue FROM PurchaseOrderShip,PurchaseOrderMain WHERE PurchaseOrderShip.IndentNo=PurchaseOrderMain.IndentNo AND PurchaseOrderMain.Types IS NOT NULL AND PurchaseOrderMain.Types<>'' AND (PurchaseOrderMain.STypes IS NULL OR PurchaseOrderMain.STypes='') ORDER BY PurchaseOrderMain.IndentNo");
				return $query->result();				
		}
		public Function GetOrdersWithTypeData($IndentNo)
		{
				$query = $this->db->query("SELECT PurchaseOrderMain.*,PurchaseOrderShip.InsuranceLocal,PurchaseOrderShip.Currency,PurchaseOrderShip.TotalFOBValue,PurchaseOrderShip.FreightValue,PurchaseOrderShip.InsuranceValue,PurchaseOrderShip.OtherChargesValue FROM PurchaseOrderShip,PurchaseOrderMain WHERE PurchaseOrderShip.IndentNo=PurchaseOrderMain.IndentNo AND PurchaseOrderMain.Types IS NOT NULL AND PurchaseOrderMain.Types<>'' AND (PurchaseOrderMain.STypes IS NULL OR PurchaseOrderMain.STypes='') AND PurchaseOrderMain.IndentNo='{$IndentNo}' ORDER BY PurchaseOrderMain.IndentNo");
				return $query->result();				
		}
		Public Function GetNextPartNo($id)
		{

	
			$strLastID = "SELECT MAX(PartNo) AS LastID FROM ShipmentTypeMain WHERE IndentNo='{$id}'";
			
		
			$query = $this->db->query($strLastID);
			
			$query1 = $this->db->query($strLastID);
			$query1->result_array();
			$result1 = $query1->result();

			foreach($result1 as $key);
			
			if($query->num_rows()==0){
			$GetNextIndentNumber = '1';
			}elseif($key->LastID==""){
			$GetNextIndentNumber = '1';
			}else{
			$strTemp = $key->LastID;
			
			$iNumPos = 0;
			$sChar="";
			$iIDLen="";
			$iIDLen=strlen($strTemp);
			$sChar = substr($strTemp,$iNumPos, 1);
			
			while(strpos("1234567890",$sChar)==0)
			{
			 $iNumPos = $iNumPos + 1;
             $sChar = substr($strTemp, $iNumPos, 1);
			}
			
			$strPrefix = substr($strTemp,$iNumPos-1);
			$lenght = strlen($strTemp) + 2 - $iNumPos;
			$strTemp = substr($strTemp, -$lenght);
			
			$strTemp = $strTemp+1;
			
             $GetNextIndentNumber = $strTemp;
			
			//echo $strPrefix;
			}
			return $GetNextIndentNumber;
			//echo $GetNextIndentNumber;
			
		}
		public Function MyIndentAlphabet($partNoLength,$IndentNo)
		{
			
			switch ($partNoLength)
			{
				case '1':
				$MyIndentAlphabet = $IndentNo."/A";
				 break;
				 case '2':
				$MyIndentAlphabet = $IndentNo."/B";
				 break;
				 case '3':
				$MyIndentAlphabet = $IndentNo."/C";
				 break;
				 case '4':
				$MyIndentAlphabet = $IndentNo."/D";
				 break;
				 case '5':
				$MyIndentAlphabet = $IndentNo."/E";
				 break;
				 case '6':
				$MyIndentAlphabet = $IndentNo."/F";
				 break;
				 case '7':
				$MyIndentAlphabet = $IndentNo."/G";
				 break;
				 case '8':
				$MyIndentAlphabet = $IndentNo."/H";
				 break;
				 case '9':
				$MyIndentAlphabet = $IndentNo."/I";
				 break;
				 case '10':
				$MyIndentAlphabet = $IndentNo."/J";
				 break;
				 case '11':
				$MyIndentAlphabet = $IndentNo."/K";
				 break;
				 case '12':
				$MyIndentAlphabet = $IndentNo."/L";
				 break;
				 case '13':
				$MyIndentAlphabet = $IndentNo."/M";
				 break;
				 case '14':
				$MyIndentAlphabet = $IndentNo."/N";
				 break;
				 case '15':
				$MyIndentAlphabet = $IndentNo."/O";
				 break;
				 case '16':
				$MyIndentAlphabet = $IndentNo."/P";
				 break;
				 case '17':
				$MyIndentAlphabet = $IndentNo."/Q";
				 break;
				 case '18':
				$MyIndentAlphabet = $IndentNo."/R";
				 break;
				 case '19':
				$MyIndentAlphabet = $IndentNo."/S";
				 break;
				 case '20':
				$MyIndentAlphabet = $IndentNo."/T";
				 break;
				 case '21':
				$MyIndentAlphabet = $IndentNo."/U";
				 break;
				 case '22':
				$MyIndentAlphabet = $IndentNo."/V";
				 break;
				 case '23':
				$MyIndentAlphabet = $IndentNo."/W";
				 break;
				 case '24':
				$MyIndentAlphabet = $IndentNo."/X";
				 break;
				 case '25':
				$MyIndentAlphabet = $IndentNo."/Y";
				 break;
				 case '26':
				$MyIndentAlphabet = $IndentNo."/Z";
				 break;
				default:
				$MyIndentAlphabet = "";
			}
			return $MyIndentAlphabet;
				
				
			
		}
		public function ValidRecordDocument()
		{
				
				if($this->input->post('IndentNo')==NULL)
				{
				echo "<font color='red'>No Record Selected.</font>";
				$state = FALSE;
				}elseif($this->input->post('PackagesReceived')==NULL)
				{
				echo "<font color='red'>Required   Packages Received</font>";
				$state = FALSE;
				}elseif(!is_numeric($this->input->post('PackagesReceived')))
				{
				echo "<font color='red'>Invalid   Packages Received</font>";
				$state = FALSE;
				}elseif($this->input->post('GrossWeight')==NULL)
				{
				echo "<font color='red'>Required Gross Weight</font>";
				$state = FALSE;
				}elseif(!is_numeric($this->input->post('GrossWeight')))
				{
				echo "<font color='red'>Invalid   Gross Weight</font>";
				$state = FALSE;
				}elseif($this->input->post('NetWeight')==NULL)
				{
				echo "<font color='red'>Required Net Weight</font>";
				$state = FALSE;
				}elseif(!is_numeric($this->input->post('NetWeight')))
				{
				echo "<font color='red'>Invalid   Net Weight</font>";
				$state = FALSE;
				}elseif($this->input->post('TotalValue')==NULL)
				{
				echo "<font color='red'>Required FOB Value</font>";
				$state = FALSE;
				}elseif(!is_numeric($this->input->post('TotalValue')))
				{
				echo "<font color='red'>Invalid  FOB Value</font>";
				$state = FALSE;
				}else{
					$state= TRUE;
				}
				RETURN $state;
		}
		
		public function safeShippingDetails()
		{
			$ShippingDate=date_create($this->input->post('ShippingDate'));
			$DateExpected=date_create($this->input->post('DateExpected'));
			$diff=date_diff($ShippingDate,$DateExpected);
			$diff = $diff->format("%R%a");
			$partNoLength =  strlen($this->GetNextPartNo($this->input->post('IndentNo')));
			$IndentNo = $this->input->post('IndentNo');	
			$MyIndentAlphabet =	$this->MyIndentAlphabet($partNoLength ,$IndentNo);
			$array[] = $this->GetOrdersWithTypeData($IndentNo);
			$StaffIDNo = $this->doctracking_model->GetCurrentStaffID();
			$PartNo  = $this->GetNextPartNo($this->input->post('IndentNo'));
			foreach($array as $rows)
			{
					$data = array(
						'PartIndentNo' => $MyIndentAlphabet,
						'IndentNo' => $this->input->post('IndentNo'),
						'TotalParts' => $rows[0]->TotalParts,
						'PartNo' => $PartNo,
						'ShipmentType' => $rows[0]->Types,
						'LoadingPort' => $this->input->post('LoadingPort'),
						'VesselName' => $this->input->post('VesselName'),
						'TranshipPort' =>  $this->input->post('TranshippingPort'),
						'TranshipVessel' => $this->input->post('TranshippingVessel'),
						'ShippingDate' => $this->input->post('ShippingDate'),
						'DateExpected' => $this->input->post('DateExpected'),
						'DischargePort' => $this->input->post('DischargePort'),
						'PackingMode' => $this->input->post('PackingMode'),
						'CNType' =>  $this->input->post('Description'),
						'CNTotal' => $this->input->post('Total'),
						'MarksNumbers' => $this->input->post('MarksandNumbers'),
						'DeclarantNo' => $this->input->post('NameofDeclarant'),
						'Currency' => $rows[0]->Currency,
						'TotalFOBValue' => $rows[0]->TotalFOBValue,
						'FreightCurrency' => $this->input->post('Currency'),
						'TotalFreight' => $this->input->post('Freightvalue'),
						'TotalInsurance' =>  $this->input->post('Insurance'),
						'TotalOtherCharges' => $this->input->post('OtherCharges'),
						'StaffIDNo' => $StaffIDNo,
						'Duration' => $diff,
						'DefinedBy' => $rows[0]->PartsBy,
						'CreatedBy' => $_SESSION['IDSUser'],
						'DateCreated' => date('Y-m-d'),
						'AccPeriod' => date('Y/m')
					);
					if($this->IndentDoesNotExist($IndentNo,$PartNo,$MyIndentAlphabet)!=null)
					{
						
						$this->db->insert('ShipmentTypeMain', $data);
						if($rows[0]->PartsBy=="F")
						{
						$this->CopyAllVerifiedItems($IndentNo,$MyIndentAlphabet);
						}
					}
					
			}
			echo "Record Saved Successfully.";
		}
		
		public Function ParamPorts()
		{
				$query = $this->db->query("SELECT * FROM ParamPorts WHERE ParamPorts.PortName IS NOT NULL ORDER BY ParamPorts.PortName");
				return $query->result();				
		}
		public Function DischargePorts()
		{
				$query = $this->db->query("SELECT * FROM ParamPorts WHERE ParamPorts.PortName IS NOT NULL AND ParamPorts.LocalPort='1' ORDER BY ParamPorts.PortName");
				return $query->result();				
		}
		public Function ParamPackingModes()
		{
				$query = $this->db->query("SELECT * FROM ParamPackingModes WHERE ParamPackingModes.PackingModeName IS NOT NULL ORDER BY ParamPackingModes.PackingModeName");
				return $query->result();				
		}
		public Function CNTypeName()
		{
				$query = $this->db->query("SELECT * FROM ParamContainerTypes WHERE ParamContainerTypes.CNTypeName IS NOT NULL ORDER BY ParamContainerTypes.CNTypeName");
				return $query->result();				
		}
		public Function DeclarantName()
		{
				$query = $this->db->query("SELECT * FROM ParamDeclarants WHERE (Type='S' OR Type='X') AND ParamDeclarants.DeclarantName IS NOT NULL ORDER BY ParamDeclarants.DeclarantName");
				return $query->result();				
		}
		public function getCurrency()
		{
				$query = $this->db->query("SELECT * FROM ParamCurrencies WHERE ParamCurrencies.Currency IS NOT NULL ORDER BY ParamCurrencies.Currency");
				return $query->result();
			
		}
		public Function IndentDoesNotExist($IndentNo,$PartNo,$PartIndentNo1)
		{
				$query = $this->db->query("SELECT COUNT(IndentNo) AS TCOunt FROM ShipmentTypeMain WHERE IndentNo='{$IndentNo}' AND PartIndentNo='{$PartIndentNo1}' AND PartNo='{$PartNo}'");
				return $query->result();			
		}
		public Function CopyAllVerifiedItems($IndentNo,$MyIndentAlphabet)
		{
				$query = $this->db->query("SELECT PurchaseOrderComm.*,ParamPackageTypes.PackageTypeName,ParamCommodityBrands.ProductName,ParamCommodityBrands.UnitsPerPack FROM ParamCommodityBrands,ParamPackageTypes,PurchaseOrderComm WHERE ParamCommodityBrands.ProductCode=PurchaseOrderComm.ProductCode AND ParamPackageTypes.PackageType=PurchaseOrderComm.PackageType AND PurchaseOrderComm.IndentNo='{$IndentNo}' ORDER BY PurchaseOrderComm.IndentNo");
				$PartNo  = $this->GetNextPartNo($this->input->post('IndentNo'));
				$IndentNo = $this->input->post('IndentNo');
				foreach( $query->result() as $key)
				{
					$ProductCode = $key->ProductCode;
					$ExchRate = $this->proformainvoices_model->GetCurrentSellingRate($key->ExchRate);
					if($this->ItemsAlreadyExists($ProductCode,$MyIndentAlphabet)==null)
					{
					$data = array(
						'PartIndentNo' => $MyIndentAlphabet,
						'IndentNo' => $IndentNo,
						'PartNo' => $PartNo,
						'ProductCode' => $ProductCode,
						'PackageType' => $key->PackageType,
						'TotalPackages' => $key->TotalPackages,
						'GrossWeight' => $key->GrossWeight,
						'NetWeight' =>  $key->NetWeight,
						'Currency' => $key->Currency,
						'ExchRate' => $ExchRate,
						'ValuePerPack' => $key->ValuePerPack,
						'TotalValue' =>  $key->TotalValue,
						'UnitSize' =>$key->UnitSize,
						'QttyUnits' => $key->QttyUnits,
						'Country' => $key->Country,
						'CreatedBy' => $_SESSION['IDSUser'],
						'DateCreated' => date('Y-m-d'),
						'AccPeriod' => date('Y/m')
					);	
						$this->db->insert('ShipmentTypeData', $data);
$this->db->query("UPDATE PurchaseOrderComm SET ShipTypAlloc='{$key->ActPacks}',ShipTypeBal='0' WHERE IndentNo='{$IndentNo}' AND ProductCode='{$ProductCode}'");
				
$this->db->query("UPDATE PurchaseOrderComm SET Types='1' WHERE IndentNo='{$IndentNo}' AND ProductCode='{$ProductCode}'");
$this->db->query("UPDATE ShipmentTypeMain SET TotalFOBValue=(SELECT SUM(ShipmentTypeData.TotalValue) AS TOTALFOB FROM ShipmentTypeData WHERE ShipmentTypeData.PartIndentNo=ShipmentTypeMain.PartIndentNo AND ShipmentTypeData.PartIndentNo='{$MyIndentAlphabet}') WHERE PartIndentNo='{$MyIndentAlphabet}'");
$this->db->query("UPDATE ShipmentTypeMain SET DataStatus='1' WHERE PartIndentNo='{$MyIndentAlphabet}'");						
					}
				}				
		}
		public Function ItemsAlreadyExists($ProductCode,$PartIndentNo)
		{
				$query = $this->db->query("SELECT COUNT(ProductCode) AS TCOunt FROM ShipmentTypeData WHERE PartIndentNo='{$PartIndentNo}' AND ProductCode='{$ProductCode}'");
				return $query->result();			
		}
		public Function GetItemsNewOrders()
		{
				$query = $this->db->query("SELECT ShipmentTypeMain.* FROM ShipmentTypeMain WHERE ShipmentTypeMain.DataStatus IS NULL ORDER BY ShipmentTypeMain.IndentNo");
				return $query->result();			
		}	
		
		public Function ShowProductsUnderIndent($IndentNo)	
		{
				$query = $this->db->query("SELECT ParamCommodityBrands.*,PurchaseOrderComm.* FROM PurchaseOrderComm,ParamCommodityBrands WHERE ParamCommodityBrands.ProductCode=PurchaseOrderComm.ProductCode AND PurchaseOrderComm.IndentNo='{$IndentNo}' AND (PurchaseOrderComm.Types IS NULL OR PurchaseOrderComm.ShipTypeBal>0) ORDER BY PurchaseOrderComm.ProductCode");
				return $query->result();			
		}
		public Function GetItemsNewOrdersData($IndentNo)
		{
				$query = $this->db->query("SELECT ShipmentTypeMain.* FROM ShipmentTypeMain WHERE ShipmentTypeMain.DataStatus IS NULL AND ShipmentTypeMain.IndentNo='{$IndentNo}'ORDER BY ShipmentTypeMain.IndentNo");
				return $query->result();			
		}	
	
		public Function ShowProductsUnderIndentData($IndentNo,$ProductCode)
		{
				$query = $this->db->query("SELECT ParamCommodityBrands.*,PurchaseOrderComm.* FROM PurchaseOrderComm,ParamCommodityBrands WHERE ParamCommodityBrands.ProductCode=PurchaseOrderComm.ProductCode AND PurchaseOrderComm.IndentNo='{$IndentNo}' AND (PurchaseOrderComm.Types IS NULL OR PurchaseOrderComm.ShipTypeBal>0) AND PurchaseOrderComm.ProductCode ='{$ProductCode}'ORDER BY PurchaseOrderComm.ProductCode");
				return $query->result();			
		}	
		
		public Function ShowDeterminedTypes()
		{
				$query = $this->db->query("SELECT ShipmentTypeMain.*,PurchaseOrderMain.IDFNumber,PurchaseOrderMain.ExporterCode,PurchaseOrderMain.ImporterCode,PurchaseOrderShip.TransMode FROM ShipmentTypeMain,PurchaseOrderMain,PurchaseOrderShip WHERE PurchaseOrderShip.IndentNo=PurchaseOrderMain.IndentNo AND PurchaseOrderMain.IndentNo=ShipmentTypeMain.IndentNo AND ShipmentTypeMain.DataStatus IS NOT NULL AND ShipmentTypeMain.Insured IS NULL ORDER BY ShipmentTypeMain.PartIndentNo");
				return $query->result();			
		}
		public Function ShowDeterminedTypesData($IndentNo)
		{
				$query = $this->db->query("SELECT ShipmentTypeMain.*,PurchaseOrderMain.IDFNumber,PurchaseOrderMain.ExporterCode,PurchaseOrderMain.ImporterCode,PurchaseOrderShip.TransMode FROM ShipmentTypeMain,PurchaseOrderMain,PurchaseOrderShip WHERE PurchaseOrderShip.IndentNo=PurchaseOrderMain.IndentNo AND PurchaseOrderMain.IndentNo=ShipmentTypeMain.IndentNo AND ShipmentTypeMain.DataStatus IS NOT NULL AND ShipmentTypeMain.Insured IS NULL AND ShipmentTypeMain.IndentNo='{$IndentNo}'ORDER BY ShipmentTypeMain.PartIndentNo");
				return $query->result();			
		}
		Public Function FindBillOfLadingNo($IndentNo)
		{
				$query = $this->db->query("SELECT DocumentNo FROM ShippingDocumentRec WHERE IndentNo='{$IndentNo}' AND DocumentCode='01'");
				return $query->result()[0]->DocumentNo;			
		}
		Public Function FindBillOfLadingDate($IndentNo)
		{
				$query = $this->db->query("SELECT Documentdate FROM ShippingDocumentRec WHERE IndentNo='{$IndentNo}' AND DocumentCode='01'");
				return $query->result()[0]->Documentdate;				
		}	
		
		Public Function GoodsDescription()
		{
				$query = $this->db->query("SELECT * FROM ParamInsuranceDesc ORDER BY CodeNumber");
				return $query->result();				
		}
		Public Function BrokersName()
		{
				$query = $this->db->query("SELECT  * FROM ParamInsuranceBrokers ORDER BY BrokersName");
				return $query->result();				
		}
		Public Function InsurersName()
		{
				$query = $this->db->query("SELECT * FROM ParamInsuranceCompanies ORDER BY InsurersName");
				return $query->result();				
		}
		public function ComputeInsuranceFigures($FreightType,$Currency,$FreightValue,$TotalFOBValue,$OtherCharges,$FreightCurrency)
		{
				$query = $this->db->query("SELECT MarineRate,WarStrikeRate FROM ParamFreightTypes WHERE FreightType='{$FreightType}'");
			
				foreach($query->result() as $keys);
						$MarineRate  = $keys->MarineRate;
						$WarStrikeRate = $keys->WarStrikeRate;
				
				
				$query2 = $this->db->query("SELECT MarkupRate FROM ParamSystemDefaults WHERE MarkupRate IS NOT NULL");
				foreach($query2->result() as $keys);
				$MarkupRate = $keys->MarkupRate;
				

				$MarkupRate = ($MarkupRate+100)/100;
				$FreightUnits = $this->GetCurrencyUnits($FreightCurrency);
				$FreightRate = $this->proformainvoices_model->GetCurrentSellingRate($Currency)[0]->SellingRate;
				$Freight = $FreightValue*$MarkupRate;
				$FreightKsh = ($Freight*$FreightRate)*$FreightUnits;
				$MyTotal = ($TotalFOBValue+$OtherCharges)*$MarkupRate;
				$MyTotalKsh = $MyTotal*$FreightRate;
				$MySum = $MyTotalKsh+$FreightKsh;
						$MarineInsured = $MySum;
						$WarStrikeInsured = $MarineInsured ;
						$MarineValue = $MarineInsured*$MarineRate/100;
						$WarStrikeValue = $WarStrikeInsured*$WarStrikeRate/100;
						$TotalValue = $MarineValue+$WarStrikeValue;
						$DeclaredAmount =  $MarineInsured;
		$ComputeInsuranceFigures = array('MarineInsured'=>$MarineInsured,
										'WarStrikeInsured'=>$WarStrikeInsured,
										'MarineValue'=>$MarineValue,
										'WarStrikeValue'=>$WarStrikeValue,
										'TotalValue'=>$TotalValue,
										'DeclaredAmount'=>$DeclaredAmount,
										'MarineRate'=>$MarineRate,
										'WarStrikeRate'=>$WarStrikeRate);
		return $ComputeInsuranceFigures ;
		}
		Public Function GetCurrencyUnits($Currency)
		{
				$query = $this->db->query("SELECT Units FROM ParamCurrencies WHERE Currency='{$Currency}'");
				return $query->result()[0]->Units;				
		}
		public function saveComoditiesInvoice()
		{
				$IndentNo = $this->input->post('IndentNo');	
					
					$array[] = $this->GetItemsNewOrdersData($IndentNo);
					$productIDS = $this->input->get('productIDS');
					$productIDSARRAY = explode(",",$productIDS);
					$counter = $this->input->get('counter');
					
			if(empty($productIDS))
			{
				echo "<font color='red'>Please Select a Product.</font>";
				return;
			}
		
			
					if(!empty($IndentNo)){
					foreach($array as $rows)
					{
						
									foreach($productIDSARRAY as $productID);
										
								$array2[] = $this->ShowProductsUnderIndentData($IndentNo,$productID);
								foreach($array2 as $rows2)
								{
									$Currency = $rows2[0]->Currency;
			if($this->proformainvoices_model->GetCurrentSellingRate($rows2[0]->Currency)!=null)
			{
			
			$EXCHRATE = $this->proformainvoices_model->GetCurrentSellingRate($Currency)[0]->SellingRate;
			}else
			{
				$EXCHRATE='0.00';
				echo "<font color='red'>This week's Exchange Rate has not been Set. Contact System Administrator then try again.</font>";
				return;
			}	
			
					$partNoLength =  strlen($rows[0]->PartNo);
					
					
					$MyIndentAlphabet =	$this->MyIndentAlphabet($partNoLength ,$IndentNo);
					if($this->ItemsAlreadyExists($productID,$rows[0]->PartIndentNo)[0]->TCOunt==0)
					{
											$data = array(
											'PartIndentNo' =>$rows[0]->PartIndentNo,
											'IndentNo' => $IndentNo,
											'ProductCode' =>  $rows2[0]->ProductCode,
											'PartNo' => $rows[0]->PartNo,
											'UnitSize' => $rows2[0]->UnitSize,
											'QttyUnits' => $rows2[0]->QttyUnits,
											'Country' => $rows2[0]->Country,
											'Currency' => $rows2[0]->Currency,
											'ExchRate' => $EXCHRATE,
											'PackageType' => $rows2[0]->PackageType,
											'TotalPackages' => $rows2[0]->TotalPackages,
											'GrossWeight' => $rows2[0]->GrossWeight,
											'NetWeight' => $rows2[0]->NetWeight,
											'ValuePerPack' => $rows2[0]->ValuePerPack,
											'TotalValue' => $rows2[0]->TotalValue,
						
											);	
											$data2 = array(												
											'CreatedBy' => $_SESSION['IDSUser'],
											'DateCreated' => date('Y-m-d'),
											'AccPeriod' => date("Y/m"));
											
											$arrayFinal = array_merge($data,$data2);
										
										$this->db->insert('ShipmentTypeData', $arrayFinal);
		$this->db->query("UPDATE PurchaseOrderComm SET Types='1' WHERE IndentNo='{$IndentNo}' AND ProductCode='{$rows2[0]->ProductCode}'");
		$this->db->query("UPDATE ShipmentTypeMain SET TotalFOBValue=(SELECT SUM(ShipmentTypeData.TotalValue) AS TOTALFOB FROM ShipmentTypeData WHERE ShipmentTypeData.PartIndentNo=ShipmentTypeMain.PartIndentNo AND ShipmentTypeData.PartIndentNo='{$rows[0]->PartIndentNo}') WHERE PartIndentNo='{$rows[0]->PartIndentNo}'");
		$this->db->query("UPDATE ShipmentTypeMain SET DataStatus='1' WHERE PartIndentNo='{$rows[0]->PartIndentNo}'");
					}
				
								}										
								
						
								
					}
					
					
					echo "Record Saved Successfully.";
					}else{
						echo "<font color='red'>Select A record to Confirm.</font>";
					}	
		}
		public Function FindThePackageTypeName($PartIndentNo)
		{
				$query = $this->db->query("SELECT ParamPackageTypes.PackageTypeName AS PTypeName,MAX(ShipmentTypeData.PackageType) AS PTYPE FROM ParamPackageTypes,ShipmentTypeData WHERE ShipmentTypeData.PackageType=ParamPackageTypes.PackageType AND ShipmentTypeData.PartIndentNo='{$PartIndentNo}' GROUP BY ParamPackageTypes.PackageTypeName");
				return $query->result();				
		}
		public Function FindTotalPackages($PartIndentNo,$IndentNo)
		{
				$query = $this->db->query("SELECT SUM(TotalPackages) AS TOTAL FROM ShipmentTypeData WHERE PartIndentNo='{$PartIndentNo}' AND IndentNo='{$IndentNo}'");
				return $query->result();			
		}
		public function saveInsuranceCover()
		{
					$IndentNo = $this->input->post('IndentNo');	
					$array[] = $this->ShowDeterminedTypesData($IndentNo);
					
					if(!empty($IndentNo)){
					foreach($array as $rows)
					{	
			$Currency = $rows[0]->Currency;
			$PTYPE = $this->FindThePackageTypeName($rows[0]->PartIndentNo)[0]->PTYPE;
			if($this->proformainvoices_model->GetCurrentSellingRate($Currency)!=null)
			{
			
			$EXCHRATE = $this->proformainvoices_model->GetCurrentSellingRate($Currency)[0]->SellingRate;
			}else
			{
				$EXCHRATE='0.00';
				echo "<font color='red'>This week's Exchange Rate has not been Set. Contact System Administrator then try again.</font>";
				return;
			}	
			$PartIndentNo = $rows[0]->PartIndentNo;
			
					$TotalPackages = $this->FindTotalPackages($PartIndentNo,$IndentNo)[0]->TOTAL;
					$FreightType = $rows[0]->TransMode;
					$Currency = $this->ShowDeterminedTypesData($IndentNo)[0]->Currency;
					$FreightValue = $this->ShowDeterminedTypesData($IndentNo)[0]->TotalFreight;
					$TotalFOBValue = $this->ShowDeterminedTypesData($IndentNo)[0]->TotalFOBValue;
					$OtherCharges = $this->ShowDeterminedTypesData($IndentNo)[0]->TotalOtherCharges;
					$FreightCurrency = $this->ShowDeterminedTypesData($IndentNo)[0]->FreightCurrency;
					$ComputeInsuranceFigures[] = $this->ComputeInsuranceFigures($FreightType,$Currency,$FreightValue,$TotalFOBValue,$OtherCharges,$FreightCurrency);		
	
					$data = array(
								'PartIndentNo' =>$rows[0]->PartIndentNo,
								'IndentNo' =>$rows[0]->IndentNo,
								'IDFNumber'=>$rows[0]->IDFNumber,
								'ImporterCode'=>$rows[0]->ImporterCode,
								'CoverNoteNo'=>$this->input->post('CoverNoteNo'),
								'DateInsured'=>$this->input->post('DateInsured'),
								'FOBValue'=>$rows[0]->TotalFOBValue,
								'FreightCurrency'=>$rows[0]->FreightCurrency,
								'FreightValue'=>$rows[0]->TotalFreight,
								'OtherCharges'=>$rows[0]->TotalOtherCharges,
								'PackageType'=>$PTYPE,
								'TotalPackages'=>$TotalPackages,
								'GoodsDescription'=>$this->input->post('GoodsDescription'),
								'InsurersCode'=>$this->input->post('InsuranceCompany'),
								'BrokersCode'=>$this->input->post('InsuranceBroker'),
								'OpenCoverNo'=>$this->OpenCoverNo(),
								'AWBBLNo'=>$this->input->post('AWBNo'),
								'AWBBLDate'=>$this->input->post('AWBDate'),
								'MarineInsured'=>number_format($ComputeInsuranceFigures[0]['MarineInsured'], 2, '.', ''),
								'MarineRate'=>number_format($ComputeInsuranceFigures[0]['MarineRate'], 2, '.', ''),
								'MarineValue'=>number_format($ComputeInsuranceFigures[0]['MarineValue'], 2, '.', ''),
								'MarineValueRnd'=>round(number_format($ComputeInsuranceFigures[0]['MarineValue'], 2, '.', '')),
								'WarStrikeInsured'=>number_format($ComputeInsuranceFigures[0]['WarStrikeInsured'], 2, '.', ''),
								'WarStrikeRate'=>number_format($ComputeInsuranceFigures[0]['WarStrikeRate'], 2, '.', ''),
								'WarStrikeValue'=>number_format($ComputeInsuranceFigures[0]['WarStrikeValue'], 2, '.', ''),
								'WarStrikeValueRnd'=>round(number_format($ComputeInsuranceFigures[0]['WarStrikeValue'], 2, '.', '')),
								'TotalValue'=>number_format($ComputeInsuranceFigures[0]['TotalValue'], 2, '.', ''),
								'TotalValueRnd'=>round(number_format($ComputeInsuranceFigures[0]['TotalValue'], 2, '.', '')),
								'DeclaredAMount'=>number_format($ComputeInsuranceFigures[0]['DeclaredAmount'], 2, '.', ''),
								'FreightType'=>$rows[0]->TransMode,
								'StaffIdNo'=>$this->doctracking_model->GetCurrentStaffID(),
								'DeclarantNo'=>$this->input->post('DeclarantNo'),
								'InsuredFrom'=>$this->input->post('LoadingPort'),
								'InsuredTo'=>$this->input->post('InsuredTo'),
								'Currency'=>$this->input->post('Currency'),
								'ExchRate'=>$EXCHRATE,
					);	
					$data2 = array(												
					'CreatedBy' => $_SESSION['IDSUser'],
					'DateCreated' => date('Y-m-d'),
					'AccPeriod' => date("Y/m"));
					
					$arrayFinal = array_merge($data,$data2);
			
			$this->db->insert('ShippingInsuranceMain', $arrayFinal);
			$query = $this->db->query("UPDATE ShipmentTypeMain SET Insured='1' WHERE PartIndentNo='{$PartIndentNo}'");
					
					}
					
					
					echo "Record Saved Successfully.";
					}else{
						echo "<font color='red'>Select A record.</font>";
					}				
		}
		public function OpenCoverNo()
		{
			$company = $this->input->post('InsuranceCompany');
				$query = $this->db->query("SELECT ParamInsuranceCompanies.* FROM ParamInsuranceCompanies WHERE ParamInsuranceCompanies.InsurersCode='{$company}'");
				return $query->result()[0]->OpenCoverNO;			
		}
		public function TownCity()
		{
			
				$query = $this->db->query("SELECT * FROM ParamTownCity WHERE LocalCity='1' OR LocalCity='1' ORDER BY TownCity");
				return $query->result();			
		}
		
		public function ShowWithDocuments()
		{
			
				$query = $this->db->query("SELECT ShippingInsuranceMain.*,ShipmentTypeMain.*,PurchaseOrderMain.ExporterCode FROM PurchaseOrderMain,ShipmentTypeMain,ShippingInsuranceMain WHERE PurchaseOrderMain.IndentNo=ShippingInsuranceMain.IndentNo AND ShipmentTypeMain.PartIndentNo=ShippingInsuranceMain.PartIndentNo AND ShippingInsuranceMain.Declarant IS NULL ORDER BY ShippingInsuranceMain.PartIndentNo");
				return $query->result();			
		}
		public function ShowWithDocumentsData($IndentNo)
		{
			
				$query = $this->db->query("SELECT ShippingInsuranceMain.*,ShipmentTypeMain.*,PurchaseOrderMain.ExporterCode FROM PurchaseOrderMain,ShipmentTypeMain,ShippingInsuranceMain WHERE PurchaseOrderMain.IndentNo=ShippingInsuranceMain.IndentNo AND ShipmentTypeMain.PartIndentNo=ShippingInsuranceMain.PartIndentNo AND ShippingInsuranceMain.Declarant IS NULL AND ShippingInsuranceMain.IndentNo='{$IndentNo}' ORDER BY ShippingInsuranceMain.PartIndentNo");
				return $query->result();			
		}
		
		public function ShowReceivedDocuments($IndentNo)
		{
			
				$query = $this->db->query("SELECT ParamShippingDocs.DocumentName,ShippingDocumentRec.* FROM ParamShippingDocs,ShippingDocumentRec WHERE ShippingDocumentRec.DocumentCode=ParamShippingDocs.DocumentCode AND ShippingDocumentRec.IndentNo='{$IndentNo}' ORDER BY ShippingDocumentRec.DocumentCode");
				return $query->result();			
		}
		public Function FindInstructMessage()
		{
				$query = $this->db->query("SELECT DeclarantInstruction FROM ParamDefaultMEssages");
				return $query->result()[0]->DeclarantInstruction;			
		}
		
		public function ValidRecordInstructions()
		{
			
				if($this->input->post('IndentNo')==NULL)
				{
				echo "<font color='red'>No Record Selected.</font>";
				$state = FALSE;
				}elseif($this->input->post('Subject')==NULL)
				{
				echo "<font color='red'>Required   Instruction Subject</font>";
				$state = FALSE;
				}elseif($this->input->post('Message')==NULL)
				{
				echo "<font color='red'>Required   Instruction Message</font>";
				$state = FALSE;
				}else{
					$state= TRUE;
				}
				RETURN $state;	
		}
		public function SaveInstructions()
		{
			
					$IndentNo = $this->input->post('IndentNo');				
					$array[] = $this->ShowWithDocumentsData($IndentNo);
					$productIDS = $this->input->get('productIDS');
					$productIDSARRAY = explode(",",$productIDS);
					
			if(empty($productIDS))
			{
				echo "<font color='red'>Please Select atleast one or More Documents.</font>";
				return;
			}
			
					if(!empty($IndentNo)){
					foreach($array as $rows)
					{
													$data = array(
													'IndentNo' => $IndentNo,
													'PartIndentNo' => $rows[0]->PartIndentNo,
													'DeclarantNo' => $this->input->post('DeclarantNo'),
													'Subject' => $this->input->post('Subject'),
													'InstructMessage' => $this->input->post('Message'),
													'ExporterCode' => $rows[0]->ExporterCode,
													'ImporterCode' => $rows[0]->ImporterCode,
													'StaffIdNo' => $this->doctracking_model->GetCurrentStaffID(),
													'CreatedBy' => $_SESSION['IDSUser'],
													'DateCreated' => date('Y-m-d'),
													'AccPeriod' => date("Y/m")
													);		
							$this->db->insert('ShippingClearanceInst', $data);	
						$PartIndentNo = $rows[0]->PartIndentNo;
						$array2 = $this->shiptracking_model->ShowReceivedDocuments($IndentNo);
									foreach($productIDSARRAY as $productID)
										{
	
						
						foreach($array2 as $rows2)
									{
						$DocumentCode = $rows2->DocumentCode;
						$DocumentNo = $rows2->DocumentNo;
						if($productID==$DocumentCode)
						{
						$this->db->query("UPDATE ShippingDocumentRec SET Issued='Y' WHERE IndentNo='{$IndentNo}' AND DocumentCode='{$DocumentCode }' AND DocumentNo='{$DocumentNo}'");
						}									
									}

										}
	$this->db->query("UPDATE ShippingInsuranceMain SET Declarant='1' WHERE PartIndentNo='{$PartIndentNo}'");									
							
											
								
										
							
					}
					
					
					echo "Record Saved Successfully.";
					}else{
						echo "<font color='red'>Select A record to Confirm.</font>";
					}		
		}	
		public function ShowNewDraftInst()
		{
			
				$query = $this->db->query("SELECT ParamExporters.ExporterName,ShipmentTypeMain.*,ShippingClearanceInst.* FROM ShipmentTypeMain,ShippingClearanceInst,ParamExporters WHERE ShipmentTypeMain.PartIndentNo=ShippingClearanceInst.PartIndentNo AND ShippingClearanceInst.ExporterCode=ParamExporters.ExporterCode AND ShippingClearanceInst.Bonded IS NULL ORDER BY ShippingClearanceInst.PartIndentNo");
				return $query->result();			
		}
		public function ShowNewDraftInstData($IndentNo)
		{
			
				$query = $this->db->query("SELECT ParamExporters.ExporterName,ShipmentTypeMain.*,ShippingClearanceInst.* FROM ShipmentTypeMain,ShippingClearanceInst,ParamExporters WHERE ShipmentTypeMain.PartIndentNo=ShippingClearanceInst.PartIndentNo AND ShippingClearanceInst.ExporterCode=ParamExporters.ExporterCode AND ShippingClearanceInst.Bonded IS NULL AND ShippingClearanceInst.IndentNo='{$IndentNo}'ORDER BY ShippingClearanceInst.PartIndentNo");
				return $query->result();			
		}	
		Public Function ShowCurrentIndentItems($IndentNo)	
		{
			$query = $this->db->query("SELECT ShipmentTypeData.*,ParamCommodityBrands.* FROM ShipmentTypeData,ParamCommodityBrands WHERE ShipmentTypeData.ProductCode=ParamCommodityBrands.ProductCode AND ShipmentTypeData.IndentNo='{$IndentNo}' ORDER BY ShipmentTypeData.ProductCode");
				return $query->result();		
		}		
		public function WareHouse()
		{
			
				$query = $this->db->query("SELECT * FROM ParamWarehouse WHERE (Kwal=1 OR Kwal='Y') ORDER BY WareHouse");
				return $query->result();			
		}
		public function SaveallocateWarehouse()
		{
			$IndentNo = $this->input->post('IndentNo');	
			$Warehouse = $this->input->post('Warehouse');	
			$date = date('Y-m-d');
			if($IndentNo==NULL)
			{
				echo "<font color='red'>Select a Record.</font>";
			}elseif($Warehouse==NULL)
			{
				echo "<font color='red'>Select a Ware house</font>";
			}else{
			$GetCurrentStaffID = $this->doctracking_model->GetCurrentStaffID();
		$query = $this->db->query("UPDATE ShippingClearanceInst SET Bonded='1',DateBonded='{$date}',BondedBy='{$GetCurrentStaffID}',Warehouse='{$Warehouse}' WHERE IndentNo='{$IndentNo}'");
		echo "Record Saved Successfully.";
			}
		}
		
		public function GetOrdersAwaitingCCRF()
		{
				$query = $this->db->query("SELECT ShipmentTypeMain.* FROM ShipmentTypeMain WHERE ShipmentTypeMain.CCRF IS NULL ORDER BY ShipmentTypeMain.PartIndentNo");
				return $query->result();			
		}
		
		public function GetOrdersAwaitingCCRFData($IndentNo)
		{
				$query = $this->db->query("SELECT ShipmentTypeMain.* FROM ShipmentTypeMain WHERE ShipmentTypeMain.CCRF IS NULL AND ShipmentTypeMain.PartIndentNo='{$IndentNo}' ORDER BY ShipmentTypeMain.PartIndentNo");
				return $query->result();			
		}
		public function ShowAWBBLDocuments($IndentNo)
		{
				$query = $this->db->query("SELECT ShippingDocumentRec.* FROM ShippingDocumentRec WHERE ShippingDocumentRec.IndentNo='{$IndentNo}' AND ShippingDocumentRec.DocumentCode='01' AND ShippingDocumentRec.CCRF IS NULL ORDER BY ShippingDocumentRec.DocumentNo");
				return $query->result();			
		}
		public function ShowCCRFDocuments($IndentNo)
		{
				$query = $this->db->query("SELECT ShippingDocumentRec.* FROM ShippingDocumentRec WHERE ShippingDocumentRec.IndentNo='{$IndentNo}' AND ShippingDocumentRec.DocumentCode='18' AND ShippingDocumentRec.CCRF IS NULL ORDER BY ShippingDocumentRec.DocumentNo");
				return $query->result();			
		}

		public function ShowCCRFDocumentsData($IndentNo,$CCRF)
		{
				$query = $this->db->query("SELECT ShippingDocumentRec.* FROM ShippingDocumentRec WHERE ShippingDocumentRec.IndentNo='{$IndentNo}' AND ShippingDocumentRec.DocumentCode='18' AND ShippingDocumentRec.CCRF IS NULL AND ShippingDocumentRec.DocumentNo='{$CCRF}'ORDER BY ShippingDocumentRec.DocumentNo");
				return $query->result();			
		}
		public function ShowProductsToAssign($IndentNo)
		{
				$query = $this->db->query("SELECT ParamCommodityBrands.UnitsPerPack,PurchaseOrderData.ProductName1,ShipmentTypeData.* FROM ShipmentTypeData,PurchaseOrderData,ParamCommodityBrands WHERE PurchaseOrderData.ProductCode=ShipmentTypeData.ProductCode AND PurchaseOrderData.IndentNo=ShipmentTypeData.IndentNo AND ParamCommodityBrands.ProductCode=ShipmentTypeData.ProductCode AND ShipmentTypeData.IndentNo='{$IndentNo}' AND ShipmentTypeData.CCRF IS NULL ORDER BY ShipmentTypeData.ProductCode");
				return $query->result();			
		}
	
		public function saveCCRF()
		{
			
$period = date("Y/m");
$date = date('Y-m-d');
$pass = "administrator$";
				$user = 'sa';
				$db = 'IDSYSTEM';
$connection = odbc_connect("Driver={SQL Server};Server=NYAGAKAvENOCK-PC\SQLSERVER;Database=$db;",$user , $pass ) or die(odbc_errormsg());			
			$IndentNo = $this->input->post('IndentNo');	
					
					$CCRF = $this->input->post('CCRF');	
					$PartIndentNo = $this->input->post('PartIndentNo');	
					$CCRFDATE = $this->input->post('CCRFDATE');	
					$array[] = $this->GetOrdersAwaitingCCRFData($IndentNo);
					$productIDS = $this->input->get('productIDS');
					$productIDSARRAY = explode(",",$productIDS);
					
			if(empty($productIDS))
			{
				echo "<font color='red'>Please Select atleast one or More Products.</font>";
				return;
			}
					if(!empty($IndentNo)){
					foreach($array as $rows)
					{							
						
						$array2 = $this->shiptracking_model->ShowProductsToAssign($IndentNo);
									foreach($productIDSARRAY as $productID)
										{
						foreach($array2 as $rows2)
						{
						$ProductCode = $rows2->ProductCode;
						
								if($ProductCode = $productID)
								{
									$data = array(
													'IndentNo' => $IndentNo,
													'PartIndentNo' => $PartIndentNo,
													'CCRFNo' => $this->input->post('CCRF'),
													'ProductCode' => $ProductCode,
													'Currency' => $rows2->Currency,
													'InvoiceValue' => $rows2->TotalValue,
													'CreatedBy' => $_SESSION['IDSUser'],
													'DateCreated' => date('Y-m-d'),
													'AccPeriod' => date("Y/m")
									);	

	$sql = "INSERT INTO CCRFItemsInfo(
					PartIndentNo,
					CCRFNo,
					IndentNo,
					ProductCode,
					Currency,
					InvoiceValue,
					CreatedBy,
					DateCreated,
					AccPeriod
					)VALUES('{$PartIndentNo}','{$CCRF}','{$IndentNo}','{$ProductCode}','{$rows2->Currency}','{$rows2->TotalValue}','{$_SESSION['IDSUser']}','{$date}','{$period}')";
					echo $sql;
			//odbc_exec($connection,$sql) or die(odbc_errormsg());
	/*$this->db->query("UPDATE ShipmentTypeData SET CCRF='Y' WHERE PartIndentNo='{$PartIndentNo}' AND ProductCode='{$ProductCode}'");
		IF($this->AllItemsEntered2($PartIndentNo)>=1)
		{
	$this->db->query("UPDATE ShipmentTypeMain SET CCRF='Y' WHERE PartIndentNo='{$PartIndentNo}'");			
		}
		$query2 = $this->db->query("SELECT SUM(InvoiceValue) AS TOTAL FROM CCRFItemsInfo WHERE PartIndentNo='{$PartIndentNo}' AND CCRFNo='{$CCRF}'");
		$InvoiceValue =  $query2->result()[0]->TOTAL;
		$query3 = $this->db->query("SELECT FOBValue,OtherCharges,FreightValue,TotalValue,Currency,FreightCurrency FROM ShippingInsuranceMain WHERE PartIndentNo='{$PartIndentNo}'");
				foreach($query3->result() as $key);
				$FOBValue = $key->FOBValue;
				$OtherCharges = $key->OtherCharges;
				$FreightValue = $key->FreightValue;
				$xInsure = $key->TotalValue;
				$Currency = $key->Currency;
				$FreightCurrency = $key->FreightCurrency;			
				$nInvoice = $InvoiceValue;
				$nInsure = ($InvoiceValue/$FOBValue)*$xInsure;
				$nOthers = ($InvoiceValue/$FOBValue)*$OtherCharges;
				$nFreight = ($InvoiceValue/$FOBValue)*$FreightValue;
				$nCurr = $Currency;
				$nFCurr = $FreightCurrency;
	$AWBBLNoARR[] = $this->ShowAWBBLDocuments($IndentNo);				
	$CCRFARR[] = $this->ShowCCRFDocumentsData($IndentNo,$CCRF);
	foreach($AWBBLNoARR as $AWBBLNo);
		foreach($CCRFARR as $CCRFKey);
						$data2 = array(
					'PartIndentNo' =>$PartIndentNo,
					'CCRFNo' =>$CCRF,
					'CCRFDate' => $CCRFDATE,
					'AWBBLNo' => $AWBBLNo[0]->DocumentNo,
					'AWBBLDate' => $AWBBLNo[0]->DocumentDate,
					'IndentNo' => $IndentNo,
					'Currency' =>$nCurr,
					'FreightCurrency' =>$nFCurr,
					'TotalInvoiceValue' =>$nInvoice,
					'TotalInsurance' =>$nInsure,
					'TotalOthers' =>$nOthers,
					'TotalFreight' =>$nFreight,
					'CreatedBy' => $_SESSION['IDSUser'],
					'DateCreated' => date('Y-m-d'),
					'AccPeriod' => date("Y/m")
						);*/

		/*	odbc_exec($connection,"INSERT INTO CCRFMainData(
					PartIndentNo,
					CCRFNo,
					CCRFDate,
					AWBBLNo,
					AWBBLDate,
					IndentNo,
					Currency,
					FreightCurrency,
					TotalInvoiceValue,
					TotalInsurance,
					TotalOthers,
					TotalFreight,
					CreatedBy,
					DateCreated,
					AccPeriod
					)VALUES('{$PartIndentNo}','{$CCRF}','{$CCRFDate}','{$AWBBLNo[0]->DocumentNo}','{$AWBBLNo[0]->DocumentDate}','{$IndentNo}','{$Curr}','{$FCurr}','{$nInvoice}','{$nInsure}','{$nOthers}','{$Freight}','{$_SESSION['IDSUser']}','{$date}','{$period}')") or die(odbc_error());*/
		
$this->db->query("UPDATE ShippingDocumentRec SET CCRF='Y' WHERE IndentNo='{$IndentNo}' AND DocumentCode='18' AND DocumentNo='{$CCRF}'");
	
								}
										}
										}		
					}
					
					
					echo "Record Saved Successfully.";
					}else{
						echo "<font color='red'>Select A record to Confirm.</font>";
					}		
		}

		public Function AllItemsEntered2($PartIndentNo)
		{
		$query = $this->db->query("SELECT COUNT(ShipmentTypeData.ProductCode) AS TOTAL FROM ShipmentTypeData WHERE PartIndentNo='{$PartIndentNo}' AND (CCRF IS NULL OR CCRF='')");
		return $query->result()[0]->TOTAL;			
		}
		public function ValidInsuranceCover()
		{
			if($this->proformainvoices_model->GetCurrentSellingRate($this->input->post('Currency'))==null)
			{
				echo "<font color='red'>This week's Exchange Rate has not been Set. Contact System Administrator then try again.</font>";
				return;			
			}
				if($this->input->post('IndentNo')==NULL)
				{
				echo "<font color='red'>No Record Selected.</font>";
				$state = FALSE;
				}elseif($this->input->post('OtherCharges')==NULL)
				{
				echo "<font color='red'>Required   Other Charges</font>";
				$state = FALSE;
				}elseif(!is_numeric($this->input->post('OtherCharges')))
				{
				echo "<font color='red'>Invalid   Other Charges</font>";
				$state = FALSE;
				}elseif($this->input->post('Freight')==NULL)
				{
				echo "<font color='red'>Required Total Freight</font>";
				$state = FALSE;
				}elseif(!is_numeric($this->input->post('Freight')))
				{
				echo "<font color='red'>Invalid   Total Freight</font>";
				$state = FALSE;
				}elseif($this->input->post('Currency')==NULL)
				{
				echo "<font color='red'>Required Currency</font>";
				$state = FALSE;
				}elseif($this->input->post('LoadingPort')==NULL)
				{
				echo "<font color='red'>Required Loading Port</font>";
				$state = FALSE;
				}elseif($this->input->post('InsuredTo')==NULL)
				{
				echo "<font color='red'>Required City Insured To</font>";
				$state = FALSE;
				}elseif($this->input->post('AWBNo')==NULL)
				{
				echo "<font color='red'>Required AWB/BL No</font>";
				$state = FALSE;
				}elseif($this->input->post('AWBDate')==NULL)
				{
				echo "<font color='red'>Required AWB/BL Date</font>";
				$state = FALSE;
				}elseif($this->input->post('DeclarantNo')==NULL)
				{
				echo "<font color='red'>Required Declarant No</font>";
				$state = FALSE;
				}elseif($this->input->post('DateInsured')==NULL)
				{
				echo "<font color='red'>Required Date Insured</font>";
				$state = FALSE;
				}elseif($this->input->post('GoodsDescription')==NULL)
				{
				echo "<font color='red'>Required Goods Description</font>";
				$state = FALSE;
				}elseif($this->input->post('InsuranceBroker')==NULL)
				{
				echo "<font color='red'>Required Insurance Broker</font>";
				$state = FALSE;
				}elseif($this->input->post('InsuranceCompany')==NULL)
				{
				echo "<font color='red'>Required Insurance Company</font>";
				$state = FALSE;
				}elseif($this->input->post('CoverNoteNo')==NULL)
				{
				echo "<font color='red'>Required Cover Note No</font>";
				$state = FALSE;
				}else{
					$state= TRUE;
				}
				RETURN $state;			
		}
	}
?>