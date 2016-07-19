<?php
class Settings_model extends CI_Model
	{
		
		public function __construct()
        {
                $this->load->database();
        }
		
		public function ShowActiveCommodityBrands()
		{
			$query = $this->db->query("SELECT ParamCommodityBrands.*,ParamCommodityData.StandardDesc FROM ParamCommodityBrands,ParamCommodityData WHERE ParamCommodityData.CommodityCode=ParamCommodityBrands.CommodityCode AND ParamCommodityBrands.Discontinued IS NULL ORDER BY ParamCommodityBrands.ProductCode");
			return $query->result();			
		}
		public function ShowActiveCommodityBrandsData($ProductCode)
		{
			$query = $this->db->query("SELECT ParamCommodityBrands.*,ParamCommodityData.StandardDesc FROM ParamCommodityBrands,ParamCommodityData WHERE ParamCommodityData.CommodityCode=ParamCommodityBrands.CommodityCode AND ParamCommodityBrands.Discontinued IS NULL AND ParamCommodityBrands.ProductCode='{$ProductCode}'ORDER BY ParamCommodityBrands.ProductCode");
			return $query->result();			
		}
		public function get_Exporters($ExporterCode)
		{
			$query = $this->db->query("SELECT  * FROM ParamExporters WHERE Discontinued IS NULL AND ExporterCode='{$ExporterCode}' ORDER BY ExporterName");
			return $query->result();
		}

		public function ParamExporterProduct($ExporterCode,$ProductCode)
		{
			$query = $this->db->query("SELECT  * FROM ParamExporterProduct WHERE ExporterCode='{$ExporterCode}' AND ProductCode='{$ProductCode}'");
			return $query->result();
		}
		public function genearateExporterCodes()
		{
			$query = $this->db->query("SELECT * FROM ExpoterCodes");
			$ExporterCode = $query->result()[0]->ExporterCode;
			foreach($query->result() as $key);
			 $Count = strlen(trim($key->ExporterCode));
			$ExporterCode = trim($key->ExporterCode)+1;
			
			if($Count==0)
			{
		
				$Exporter = "Exp-000000000".$ExporterCode;
				
			}elseif($Count==1)
			{
				
				$Exporter = "Exp-00000000".$ExporterCode;
			}elseif($Count==2)
			{
				
				$Exporter = "Exp-0000000".$ExporterCode;
			}elseif($Count==3)
			{
				$Exporter = "Exp-00000".$ExporterCode;
			}elseif($Count==4)
			{
				$Exporter = "Exp-0000".$ExporterCode;
			}elseif($Count==5)
			{
				$Exporter = "Exp-000".$ExporterCode;
			}elseif($Count==6)
			{
				$Exporter = "Exp-00".$ExporterCode;
			}elseif($Count==7)
			{
				$Exporter = "Exp-0".$ExporterCode;
			}elseif($Count==8)
			{
				$Exporter = "Exp-".$ExporterCode;
			}
			
			return $Exporter;
		}
		
		public function getLastNos()
		{
			$query = $this->db->query("SELECT * FROM ExpoterCodes");
			foreach($query->result() as $key);
			$ExporterCode = trim($key->ExporterCode)+1;
			

			
			return $ExporterCode;
		}
		public function assignProduct()
		{
			$Exporter = $this->input->post('ExporterCode2');		
			$productIDS = $this->input->get('productIDS');
			$productIDSARRAY = explode(",",$productIDS);
			if(empty($productIDS))
			{
				echo "<font color='red'>Please Select atleast one or More Products.</font>";
				return;
			}elseif($this->input->post('ExporterCode2')==NULL)
			{
				echo "<font color='red'>Select an Exporter.</font>";
				return;
			}
	
				foreach($productIDSARRAY as $productID)
					{
						
						if($this->ParamExporterProduct($Exporter,$productID)==NULL)
						{
									$data = array(
								'ProductCode' => $productID,
								'ExporterCode' => $this->input->post('ExporterCode2'),
								'CreatedBy' => $_SESSION['IDSUser'],
								'DateCreated' => date('Y-m-d'),
								'AccPeriod' => date("Y/m")
								);	
						
				
				$this->db->insert('ParamExporterProduct', $data);													
						}
					}
					
								
					
					
					
					echo "Record Saved Successfully.";
							
		}
		public function validateExpoter()
		{
				$state = FALSE;
				if($this->input->post('ExporterCode')==NULL)
				{
				echo "<font color='red'>Exporter Code.</font>";
				$state = FALSE;
				}elseif($this->input->post('ExporterName')==NULL)
				{
				echo "<font color='red'>Exporter Name Requred</font>";
				$state = FALSE;
				}elseif($this->input->post('Country')==NULL)
				{
				echo "<font color='red'>Select Exporter Country</font>";
				$state = FALSE;
				}elseif($this->input->post('Currency')==NULL)
				{
				echo "<font color='red'>Select Exporter Currency</font>";
				$state = FALSE;
				}else{
				$state = TRUE;
				}	
				RETURN $state;
			
		}
		public function validateSellingRate()
		{
			
				$state = FALSE;
				if($this->input->post('Currency')==NULL)
				{
				echo "<font color='red'>Select a Currency.</font>";
				$state = FALSE;
				}elseif($this->input->post('BuyingRate')==NULL)
				{
				echo "<font color='red'>Buying Rate Required.</font>";
				$state = FALSE;
				}elseif(!is_numeric($this->input->post('BuyingRate')))
				{
				echo "<font color='red'>Invalid Buying Rate</font>";
				$state = FALSE;
				}elseif($this->input->post('SellingRate')==NULL)
				{
				echo "<font color='red'>Selling Requred</font>";
				$state = FALSE;
				}elseif(!is_numeric($this->input->post('SellingRate')))
				{
				echo "<font color='red'>Invalid Selling Rate</font>";
				$state = FALSE;
				}else{
				$state = TRUE;
				}	
				RETURN $state;		
		}
		public function validateProduct()
		{
				$state = FALSE;
				
				if($this->input->post('CommodityCode')==NULL)
				{
				echo "<font color='red'>Select Commodity Code.</font>";
				$state = FALSE;
				}elseif($this->input->post('ProductCode')==NULL)
				{
				echo "<font color='red'>Product Code Requred.</font>";
				$state = FALSE;
				}elseif($this->input->post('ProductName')==NULL)
				{
				echo "<font color='red'>Product Name Requred</font>";
				$state = FALSE;
				}elseif($this->input->post('PackegeType')==NULL)
				{
				echo "<font color='red'>Requred Packege Type</font>";
				$state = FALSE;
				}elseif($this->input->post('UnitsPerPack')==NULL)
				{
				echo "<font color='red'>Requred Units Per Pack</font>";
				$state = FALSE;
				}elseif(!is_numeric($this->input->post('UnitsPerPack')))
				{
				echo "<font color='red'>Invalid Units Per Pack</font>";
				$state = FALSE;
				}elseif($this->input->post('UnitSize')==NULL)
				{
				echo "<font color='red'>Requred Unit Size</font>";
				$state = FALSE;
				}elseif(!is_numeric($this->input->post('UnitSize')))
				{
				echo "<font color='red'>Invalid Unit Size</font>";
				$state = FALSE;
				}elseif($this->input->post('QttyUnits')==NULL)
				{
				echo "<font color='red'>Requred Quantity Units</font>";
				$state = FALSE;
				}else{
				$state = TRUE;
				}	
				RETURN $state;
			
		}
		public function saveProduct()
		{
			$CommodityCode= $this->input->post('CommodityCode');
			$array[] = $this->Settings_model->ShowRelevantCustomsData($CommodityCode)[0];
			foreach($array as $key);
			
			$data = array(
						'ProductCode' => $this->input->post('ProductCode'),
						'ProductName' => $this->input->post('ProductName'),
						'CommodityCode' => $key->CommodityCode,
						'NewCommodityCode' => $key->CommodityCode,
						'SITC' => $key->SITC,
						'NewSITC' => $key->SITC,
						'PackageType' => $this->input->post('PackegeType'),
						'UnitsPerPack' => $this->input->post('UnitsPerPack'),
						'PackageSize' => $this->input->post('UnitSize'),
						'QttyUnits' => $this->input->post('QttyUnits'),
						'QtyPerCase' => $this->input->post('QuantityPerCase'),
						'UnitsofQty' => $this->input->post('UnitsOfQuantity'),
						'Source' => $this->input->post('Source'),
						'Depart' => $this->input->post('Department'),
						'Category' => $this->input->post('Category'),
						'Notes' => $this->input->post('Notes'),
						'CreatedBy' => $_SESSION['IDSUser'],
						'DateCreated' => date('Y-m-d'),
						'AccPeriod' => date('Y/m')
				);	
				$ProductCode = $this->input->post('ProductCode');
				if($this->ShowActiveCommodityBrandsData($ProductCode)!=NULL)
				{	$this->db->where('ProductCode',$ProductCode);
					$this->db->update('ParamCommodityBrands', $data);
				}else{
					$this->db->insert('ParamCommodityBrands', $data);
				}
		echo "Record Saved Successfully.";	
		}
		public function saveSellingRate()
		{
			$Currency= $this->input->post('Currency');
			$array[] = $this->get_CurrencyData($Currency);
			foreach($array as $key);
			$dayOfWeek = date('w',strtotime(date('Y-m-d')))+1;
			$remDays = 6-$dayOfWeek;
			$data = array(
						'Currency' => $this->input->post('Currency'),
						'StartDate' => $this->getFirstDay("-".$dayOfWeek),
						'LastDate' => $this->getLastDay($remDays),
						'Week' => date('W'),
						'CurrentYear' => date('Y'),
						'Units' => $key[0]->Units,
						'BuyingRate' => $this->input->post('BuyingRate'),
						'SellingRate' => $this->input->post('SellingRate'),
						'FStartDate' =>$this->getFirstDay("-".$dayOfWeek),
						'FLastDate' => $this->getLastDay($remDays),
						'CreatedBy' => $_SESSION['IDSUser'],
						'DateCreated' => date('Y-m-d'),
						'AccPeriod' => date('Y/m')
				);	
				$data2 = array(

						'BuyingRate' => $this->input->post('BuyingRate'),
						'SellingRate' => $this->input->post('SellingRate'),
				);				
				if($this->WeeklyCurrency($Currency)!=NULL)
				{	$this->db->where('Currency',$Currency,'Week',date('W'),'CurrentYear',date('Y'));
					$this->db->update('ParamCurrencyByWeek', $data2);
					
				}else{
					$this->db->insert('ParamCurrencyByWeek', $data);
				}
		echo "Record Saved Successfully.";	
		}		
		
		public function saveExporter()
		{
				$data = array(
				'ExporterCode' => $this->input->post('ExporterCode'),
				'ExporterName' => $this->input->post('ExporterName'),
				'Country' => $this->input->post('Country'),
				'FaxNo' =>$this->input->post('Fax'),
				'Currency' =>$this->input->post('Currency'),
				'PhoneNo' => $this->input->post('Phone'),
				'EmailAddress' => $this->input->post('Email'),
				'ContactPerson' => $this->input->post('ContactPerson'),	
				'PostalAddress' => $this->input->post('Address'),	
				'CreatedBy' => $_SESSION['IDSUser'],
				'DateCreated' => date('Y-m-d'),
				'AccPeriod' => date('Y/m')
				);	
				$data2 = array(
				'ExporterName' => $this->input->post('ExporterName'),
				'Country' => $this->input->post('Country'),
				'FaxNo' =>$this->input->post('Fax'),
				'Currency' =>$this->input->post('Currency'),
				'PhoneNo' => $this->input->post('Phone'),
				'EmailAddress' => $this->input->post('Email'),
				'ContactPerson' => $this->input->post('ContactPerson'),
				'PostalAddress' => $this->input->post('Address')
				);	
				$ExporterCode = $this->input->post('ExporterCode');
				if($this->get_Exporters($ExporterCode)!=NULL)
				{
				$this->db->where('ExporterCode',$ExporterCode);
				$this->db->update('ParamExporters', $data2);
				}else
				{
					$this->db->insert('ParamExporters', $data);
				}
				$ExporterCode = $this->getLastNos();
				
				$this->db->query("UPDATE ExpoterCodes SET ExporterCode='{$ExporterCode}'");
				echo "Record Saved Successfully.";
		}
		public function ShowRelevantCustomsTarriffs()
		{
			$query = $this->db->query("SELECT ParamCommodityData.* FROM ParamCommodityData WHERE Relevant IS NOT NULL ORDER BY ParamCommodityData.CommodityCode");
			return $query->result();			
		}
		public function ShowRelevantCustomsData($CommodityCode)
		{
			$query = $this->db->query("SELECT ParamCommodityData.* FROM ParamCommodityData WHERE Relevant IS NOT NULL AND ParamCommodityData.CommodityCode='{$CommodityCode}' ORDER BY ParamCommodityData.CommodityCode");
			return $query->result();			
		}
		public function PackageTypes()
		{
			$query = $this->db->query("SELECT * FROM ParamPackageTypes ORDER BY PackageTypeName");
			return $query->result();			
		}
		public function QttyUnitsName()
		{
			$query = $this->db->query("SELECT * FROM ParamPackageUnits ORDER BY QttyUnitsName");
			return $query->result();			
		}
		public function UnitsofQtyName()
		{
			$query = $this->db->query("SELECT * FROM ParamLitreageUnits ORDER BY UnitsofQtyName");
			return $query->result();			
		}		
		
		public function DepartName()
		{
			$query = $this->db->query("SELECT *  FROM ParamProductDepart ORDER BY Depart");
			return $query->result();			
		}
		public function SourceName()
		{
			$query = $this->db->query("SELECT * FROM ParamProductSource ORDER BY Source");
			return $query->result();			
		}	
		public function get_Currency()
		{
			$query = $this->db->query("SELECT * FROM ParamCurrencies");
			return $query->result();
		}
		public function get_CurrencyData($Currency)
		{
			$query = $this->db->query("SELECT * FROM ParamCurrencies WHERE Currency='{$Currency}'");
			return $query->result();
		}
		public function WeeklyCurrency($Currency)
		{
			$dayOfWeek = date('w',strtotime(date('Y-m-d')))+1;
			$remDays = 6-$dayOfWeek;
			$FStart = $this->getFirstDay("-".$dayOfWeek);
			$FLast = $this->getLastDay($remDays );
			$CYear = date('Y');
			$query = $this->db->query("SELECT * FROM  ParamCurrencies,ParamCurrencyByWeek WHERE ParamCurrencyByWeek.Currency = ParamCurrencies.Currency AND CurrentYear='{$CYear }' AND FStartDate='{$FStart}' AND 	FLastDate='{$FLast}' AND ParamCurrencies.Currency = '{$Currency}' ORDER BY ParamCurrencies.Currency");
			return $query->result();	
			
		}

		public function getFirstDay($day)
		{
			$date=date_create(date('Y-m-d'));
			date_add($date,date_interval_create_from_date_string($day." days"));
			return date_format($date,"Y-m-d");
		}
		public function getLastDay($day)
		{
			$date=date_create(date('Y-m-d'));
			date_add($date,date_interval_create_from_date_string($day." days"));
			return date_format($date,"Y-m-d");
		}
	}
	?>