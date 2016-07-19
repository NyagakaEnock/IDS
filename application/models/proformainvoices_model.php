<?php
class Proformainvoices_model extends CI_Model
	{
		public $ExchangeRate;
		public function __construct()
        {
                $this->load->database();
        }
		public function PendingProformaInvoiceRequests($indentNo)
		{
		if($indentNo!=""){
		$query = $this->db->query("SELECT ProformaInvoiceRequest.*,ParamExporters.ExporterName,ParamExporters.Country,ParamExporters.Currency FROM ParamExporters,ProformaInvoiceRequest WHERE ParamExporters.ExporterCode=ProformaInvoiceRequest.ExporterCode AND ProformaInvoiceRequest.Received IS NULL AND ProformaInvoiceRequest.IndentNo LIKE '%{$indentNo}%'ORDER BY ProformaInvoiceRequest.IndentNo");
		}else{
		$query = $this->db->query("SELECT ProformaInvoiceRequest.*,ParamExporters.ExporterName,ParamExporters.Country,ParamExporters.Currency FROM ParamExporters,ProformaInvoiceRequest WHERE ParamExporters.ExporterCode=ProformaInvoiceRequest.ExporterCode AND ProformaInvoiceRequest.Received IS NULL ORDER BY ProformaInvoiceRequest.IndentNo");
		}
			return $query->result();
		
		}
		public function ShowCurrentIndentItems($IndentNo,$ProductCode)
		{

		if($ProductCode!=NULL){
		$query = $this->db->query("SELECT ParamCommodityBrands.*,ProformaInvoiceItems.* FROM ProformaInvoiceItems,ParamCommodityBrands WHERE ParamCommodityBrands.ProductCode=ProformaInvoiceItems.ProductCode AND ProformaInvoiceItems.ProductCode='{$ProductCode}' AND ProformaInvoiceItems.IndentNo='{$IndentNo}' AND ProformaInvoiceItems.PackagesReceived IS NOT NULL ORDER BY ProformaInvoiceItems.ProductCode");
		}else{
			
		$query = $this->db->query("SELECT ParamCommodityBrands.*,ProformaInvoiceItems.* FROM ProformaInvoiceItems,ParamCommodityBrands WHERE ParamCommodityBrands.ProductCode=ProformaInvoiceItems.ProductCode AND ProformaInvoiceItems.IndentNo='{$IndentNo}' AND ProformaInvoiceItems.PackagesReceived IS NOT NULL ORDER BY ProformaInvoiceItems.ProductCode");
			}					
			return $query->result();			
		}
		public function ShowCommodityUnderIndent($id,$ProductCode)
		{
		
		if($ProductCode!=NULL){
		$query = $this->db->query("SELECT ProformaInvoiceRequest.Country,ParamCommodityBrands.*,ProformaInvoiceItems.* FROM ProformaInvoiceRequest,ProformaInvoiceItems,ParamCommodityBrands WHERE ProformaInvoiceRequest.IndentNo=ProformaInvoiceItems.IndentNo AND ParamCommodityBrands.ProductCode=ProformaInvoiceItems.ProductCode AND ProformaInvoiceItems.IndentNo='{$id}' AND ProformaInvoiceItems.PackagesReceived IS NULL AND ProformaInvoiceItems.ProductCode ='{$ProductCode}' ORDER BY ProformaInvoiceItems.ProductCode");
		}else{
			
		$query = $this->db->query("SELECT ProformaInvoiceRequest.Country,ParamCommodityBrands.*,ProformaInvoiceItems.* FROM ProformaInvoiceRequest,ProformaInvoiceItems,ParamCommodityBrands WHERE ProformaInvoiceRequest.IndentNo=ProformaInvoiceItems.IndentNo AND ParamCommodityBrands.ProductCode=ProformaInvoiceItems.ProductCode AND ProformaInvoiceItems.IndentNo='{$id}' AND ProformaInvoiceItems.PackagesReceived IS NULL ORDER BY ProformaInvoiceItems.ProductCode");
			}	
			return $query->result();
			
			
		}
		public function get_Currency()
		{
			$query = $this->db->get('ParamCurrencies');
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
		Public Function GetCurrentSellingRate($currency)
		{
			
			$dayOfWeek = date('w',strtotime(date('Y-m-d')))+1;
			$remDays = 6-$dayOfWeek;
			$FStart = $this->getFirstDay("-".$dayOfWeek);
			$FLast = $this->getLastDay($remDays );
			$CYear = date('Y');
			$SQL = "SELECT * FROM ParamCurrencyByWeek WHERE CurrentYear='{$CYear }' AND FStartDate='{$FStart}' AND 		FLastDate='{$FLast}' AND Currency='{$currency}'";
			$query2 = $this->db->query($SQL);
			$query2->result_array();
		
			return $query2->result();
						
		}
		public function cleanData($input)
		 {
		 $cleanData = $this->security->xss_clean($input );
		 $cleanData = strip_tags(str_replace(array("'","<script>","</script>"),array("`","<!--","-->"),$cleanData));
		 return $cleanData;
		 }
		 
		 public function SearchIndent($IndentNo)
		 {
			 $query = $this->db->query("SELECT ProformaInvoiceRequest.*,ParamExporters.ExporterName FROM ParamExporters,ProformaInvoiceRequest WHERE ParamExporters.ExporterCode=ProformaInvoiceRequest.ExporterCode");
			 return $query->result();
		 }
		 public function getCurrencyUnits($IndentNo)
		 {
			 $query = $this->db->query("SELECT MAX(ProformaInvoiceItems.Currency) AS Currency,MAX(ProformaInvoiceItems.ExchRate) AS ExchRate,ParamCurrencies.Units FROM ParamCurrencies,ProformaInvoiceItems WHERE ProformaInvoiceItems.Currency=ParamCurrencies.Currency AND ProformaInvoiceItems.IndentNo='{$IndentNo}' GROUP BY ParamCurrencies.Units");
			 return $query->result();			 
		 }
		 public function EditRecord($IndentNo)
		 {
			 $query = $this->db->query("SELECT ProformaInvoiceRequest.*,ParamExporters.ExporterName FROM ParamExporters,ProformaInvoiceRequest WHERE ParamExporters.ExporterCode=ProformaInvoiceRequest.ExporterCode AND ProformaInvoiceRequest.IndentNo='{$IndentNo}'");
			 return $query->result();
		 }
		public function saveProrformRequest()
		{
				$totalVal = $this->input->post('TotalValue');
				$packageReceived = $this->input->post('PackagesReceived');
				$ValuePerPack = $totalVal/$packageReceived ;
				$UnitValue = $ValuePerPack/$this->input->get('UnitsPerPack');
				$ExchRate = $this->input->get('ExchRate');
				$UnitValueKsh = ($UnitValue*$ExchRate)/$this->input->get('Units');
				
				$IndentNumber =$this->cleanData($this->input->get('IndentNumber'));
				$DateReceived =$this->cleanData($this->input->get('DateReceived'));
				$Invoice =$this->cleanData($this->input->get('Invoice'));
				$InvoiceDate =$this->cleanData($this->input->get('InvoiceDate'));
				$ProductCode =$this->cleanData($this->input->get('ProductCode'));
				$PackagesReceived =$this->cleanData($this->input->get('PackagesReceived'));
				$TotalValue =$this->cleanData($this->input->get('TotalValue'));
				$UnitSize =$this->cleanData($this->input->get('UnitSize'));
				$UnitsPerPack =$this->cleanData($this->input->get('UnitsPerPack'));
				$ExchRate =$this->cleanData($this->input->get('ExchRate'));
				$Units =$this->cleanData($this->input->get('Units'));
				$CountryOrigin =$this->cleanData($this->input->post('CountryOrigin'));
				$FullDescription =$this->cleanData($this->input->post('FullDescription'));
				$Currency =$this->cleanData($this->input->get('Currency'));
				$GrossWeight =$this->cleanData($this->input->post('GrossWeight'));
				$NetWeight =$this->cleanData($this->input->post('NetWeight'));
				$QttyUnits =$this->cleanData($this->input->post('QttyUnits'));
				$ProductName =$this->cleanData($this->input->post('ProductName'));
				
				
				if($GrossWeight==""){
					$GrossWeight=0;
				}
				if($NetWeight==""){
					$NetWeight=0;
				}
				$data = array(
				'PackagesReceived' => $packageReceived,
				'FullDescription' => $FullDescription,
				'ProfInvoiceNo1' => $Invoice,
				'NetWeight' => $NetWeight,
				'Currency' => $Currency,
				'ExchRate' => $ExchRate,
				'TotalValue' => $TotalValue,
				'CountryOrigin' => $CountryOrigin,
				'UnitSize' => $UnitSize,
				'GrossWeight' => $GrossWeight,
				'ValuePerPack' => $ValuePerPack,
				'UnitValue' => $UnitValue
				);
				
				
				$array = array('IndentNo =' => $IndentNumber, 'ProductCode =' => $ProductCode);
				$this->db->where($array);
				$this->db->update('ProformaInvoiceItems', $data);
				
			//update proforma invoice request with proforma invoice number and date	
				$data = array(
				'ProfInvoiceNo' => $Invoice,
				'ProfInvoiceDate' => $InvoiceDate,
				'DateReceived' => $DateReceived
				);
				$array = array('IndentNo =' => $IndentNumber);
				$this->db->where($array);
								
				$this->db->update('ProformaInvoiceRequest', $data);

				
			//  'update country in idfcommoditiesinfo if the item is in the idf
				$data = array(
				'Country' => $CountryOrigin,
				'TotalPackages' => $packageReceived,
				'UnitSize' => $UnitSize,
				'QttyUnits' => $QttyUnits,
				'NetWeight' => $NetWeight,
				'FOBValue' => $TotalValue,
				'GrossWeight' => $GrossWeight
				);
				$array = array('IndentNo =' => $IndentNumber, 'ProductCode =' => $ProductCode);
				$this->db->where($array);
				$this->db->update('IDFCommoditiesInfo', $data);	
			//'update purchaseordersdata	
			
				$data = array(
				'ProductName1' => $ProductName,
				'UnitSize' => $UnitSize
				);
				$array = array('IndentNo =' => $IndentNumber, 'ProductCode =' => $ProductCode);
				$this->db->where($array);
				$this->db->update('IDFCommoditiesInfo', $data);	
			
			// 'update idfshippinginfo to reflect any changes in the FOB Values occassioned by edit
				
				$this->db->query("UPDATE IDFShippingInfo SET TotalPackages=(SELECT SUM(IDFCommoditiesInfo.TotalPackages) AS TOTAL FROM IDFCommoditiesInfo WHERE IDFCommoditiesInfo.IndentNo=IDFShippingInfo.IndentNo AND IDFCommoditiesInfo.IndentNo='{$IndentNumber}'),TotalFOBValue=(SELECT SUM(IDFCommoditiesInfo.FOBValue) AS TOTAL FROM IDFCommoditiesInfo WHERE IDFCommoditiesInfo.IndentNo=IDFShippingInfo.IndentNo AND IDFCommoditiesInfo.IndentNo='{$IndentNumber}') WHERE IDFShippingInfo.IndentNo='{$IndentNumber}'");
				
			
				
				
				if($this->ShowCommodityUnderIndent($IndentNumber,"")==NULL)
				{
				echo "Received";
					$this->db->query("UPDATE ProformaInvoiceRequest SET Received='1' WHERE IndentNo='{$IndentNumber}'");
			
			
				}
				echo "<p>Record Saved Successfully</p>";
		}
		Private Function AllItemsReceived()
		{
			$IndentNumber =$this->cleanData($this->input->get('IndentNumber'));
			$query2 = $this->db->query("SELECT COUNT(ProductCode) AS TCOunt FROM ProformaInvoiceItems WHERE IndentNo='{$IndentNumber}' AND PackagesReceived IS NULL");
			$query2->result_array();
			foreach($query2->result() AS $key);
			return $key->TCOunt;
		}
		public function validateInvoice()
		{
				$state = FALSE;
				if($this->GetCurrentSellingRate($this->cleanData($this->input->get('Currency')))==NULL)
				{
					echo "<font color='red'>This Weeks Exchange Rate Has not been set. Contact System Administrator.</font>";
				$state = FALSE;
				}
				elseif($this->input->get('IndentNumber')==NULL)
				{
				echo "<font color='red'>Select a Pending Proforma Invoice Request.</font>";
				$state = FALSE;
				}elseif($this->input->get('DateReceived')==NULL)
				{
				echo "<font color='red'>Please enter Date Received</font>";
				$state = FALSE;
				}elseif($this->input->get('Invoice')==NULL)
				{
				echo "<font color='red'>Invoice Number is Requred</font>";
				$state = FALSE;
				}elseif($this->input->get('InvoiceDate')==NULL)
				{
				echo "<font color='red'>Invoice Date is Requred</font>";
				$state = FALSE;
				}elseif($this->input->post('ProductCode')==NULL)
				{
				echo "<font color='red'>Please Select a Product</font>";
				$state = FALSE;
				}elseif($this->input->post('PackagesReceived')==NULL)
				{
				echo "<font color='red'>Please Enter Total Packages Received</font>";
				$state = FALSE;
				}elseif(!is_numeric($this->input->post('PackagesReceived')))
				{
				echo "<font color='red'>Invalid Total Packages Received</font>";
				$state = FALSE;
				}elseif($this->input->post('TotalValue')==NULL)
				{
				echo "<font color='red'>Please Enter Total Value</font>";
				$state = FALSE;
				}elseif(!is_numeric($this->input->post('TotalValue')))
				{
				echo "<font color='red'>Invalid Total Value</font>";
				$state = FALSE;
				}elseif($this->input->post('UnitSize')==NULL)
				{
				echo "<font color='red'>Required Package Size for Each Unit.</font>";
				$state = FALSE;
				}elseif($this->input->get('UnitsPerPack')==NULL)
				{
				echo "<font color='red'>Required Units Per Pack.</font>";
				$state = FALSE;
				}elseif(!is_numeric($this->input->post('GrossWeight')))
				{
				echo "<font color='red'>Invalid Gross Weight.</font>";
				$state = FALSE;
				}elseif(!is_numeric($this->input->post('NetWeight')))
				{
				echo "<font color='red'>Invali Net Weight.</font>";
				$state = FALSE;
				}else{
				$state = TRUE;
				}	
				RETURN $state;
			
		}
	
	
	}
?>