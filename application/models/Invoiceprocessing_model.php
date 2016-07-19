<?php
class Invoiceprocessing_model extends CI_Model
	{

		public function __construct()
        {
                $this->load->database();
        }
		
		public function get_typeofIndents()
		{
			$query = $this->db->get('ParamIndentTypes');
			$query->result_array();
			return $query->result();
		}
		public function get_countries()
		{
			$query = $this->db->get('ParamCountries');
			$query->result_array();
			return $query->result();
		}
		
		public function get_ParamCompanyBranch($id)
		{
		if($id!=""){
			$sql = "SELECT ParamCompanyBranch.* FROM ParamCompanyBranch WHERE ParamCompanyBranch.BranchCode='{$id}'";
		}else{
	
		$sql = "SELECT * FROM ParamCompanyBranch";
		
		}
		
			$query = $this->db->query($sql);
			$query->result_array();
			return $query->result();
		}
		public function get_ParamShipmentOwners()
		{
			$query = $this->db->get('ParamShipmentOwners');
			$query->result_array();
			return $query->result();
		}
		
		public function load_ParamEmpMaster()
		{
			$query = $this->db->query("SELECT * FROM ParamEmpMaster WHERE StaffIDNo<>'X0002' ORDER BY StaffIDNo");
			$query->result_array();
			return $query->result();
		}
		
		public function searchIndent()
		{
			$query = $this->db->query("SELECT ProformaInvoiceRequest.* FROM ProformaInvoiceRequest WHERE ProfInvoiceNo IS NOT NULL");
			return $query->result();
		}
		public function load_AttentionTo($id)
		{
			$query = $this->db->query("SELECT * FROM ParamEmpMaster WHERE StaffIDNo<>'X0002' ORDER BY StaffIDNo");
			$query->result_array();
			return $query->result();
		}
		public function load_ParamIndentTypes($id)
		{
			$query = $this->db->query("SELECT ParamIndentTypes.* FROM ParamIndentTypes WHERE ParamIndentTypes.SampleIndent='{$id}'");
			$query->result_array();
			return $query->result();
		}
		public function get_Exporters()
		{
			$query = $this->db->query("SELECT  * FROM ParamExporters WHERE Discontinued IS NULL ORDER BY ExporterName");
			$query->result_array();
			return $query->result();
		}
		public function getcountryFax($id)
		{
			$query = $this->db->query("SELECT  * FROM ParamExporters WHERE Discontinued IS NULL  AND ExporterCode='{$id}' ORDER BY ExporterName");
			$query->result_array();
			return $query->result();
		}
		public function getMessages()
		{
			$query = $this->db->query("SELECT  * FROM ParamDefaultMessages");
			$query->result_array();
			return $query->result();
		}
		public function getProformaInvoiceRequest($id)
		{
			$query = $this->db->query("SELECT ProformaInvoiceRequest.* FROM ProformaInvoiceRequest WHERE ProformaInvoiceRequest.IndentNo='{$id}'");
			$query->result_array();
			return $query->result();
		}
		public function LoadMainData($id,$exporterCode)
		{
		
			$query = $this->db->query("SELECT ParamCommodityBrands.*,ParamExporterProduct.ExporterCode FROM ParamExporterProduct,ParamCommodityBrands WHERE ParamExporterProduct.ProductCode=ParamCommodityBrands.ProductCode AND (ParamCommodityBrands.Discontinued IS NULL OR ParamCommodityBrands.Discontinued='0') AND ParamExporterProduct.ExporterCode='{$exporterCode}'  ORDER BY ParamCommodityBrands.ProductCode");
			
			$query->result_array();
			return $query->result();
			
		}
		public function LoadExporterProducts($exporterCode)
		{
		
			$query = $this->db->query("SELECT ParamCommodityBrands.*,ParamExporterProduct.ExporterCode FROM ParamExporterProduct,ParamCommodityBrands WHERE ParamExporterProduct.ProductCode=ParamCommodityBrands.ProductCode AND (ParamCommodityBrands.Discontinued IS NULL OR ParamCommodityBrands.Discontinued='0') AND ParamExporterProduct.ExporterCode='{$exporterCode}'  ORDER BY ParamCommodityBrands.ProductCode");
			
			$query->result_array();
			return $query->result();
			
		}
		public function searchComodities($comoditySearch,$ExporterCode)
		{
			$query = $this->db->query("SELECT ParamCommodityBrands.*,ParamExporterProduct.ExporterCode FROM ParamExporterProduct,ParamCommodityBrands WHERE ParamExporterProduct.ProductCode=ParamCommodityBrands.ProductCode AND (ParamCommodityBrands.Discontinued IS NULL OR ParamCommodityBrands.Discontinued='0') AND ParamExporterProduct.ExporterCode = '{$ExporterCode}' AND ParamCommodityBrands.ProductName LIKE '%{$comoditySearch}%' ORDER BY ParamCommodityBrands.ProductCode");
		
		$query->result_array();
		return $query->result();
			//echo $query->num_rows();
		}
		public function LoadIndentNos()
		{
			$query = $this->db->query("SELECT IndentNo AS SelectField FROM ProformaInvoiceRequest WHERE ProfItems IS NULL ORDER BY IndentNo");
			$query->result_array();
			return $query->result();
		}
		
		public function  GetImporterCode()
		{
			$query = $this->db->query("SELECT ImporterCode FROM ParamImporters WHERE ImporterCode ='KWAL'");
			$query->result_array();
			foreach($query->result() as $key);
			return $key->ImporterCode;
		}
		public function loadproductdetails($id)
		{
			$query = $this->db->query("SELECT ParamCommodityBrands.*,ParamExporterProduct.ExporterCode FROM ParamExporterProduct,ParamCommodityBrands WHERE ParamExporterProduct.ProductCode=ParamCommodityBrands.ProductCode AND (ParamCommodityBrands.Discontinued IS NULL OR ParamCommodityBrands.Discontinued='0') AND ParamCommodityBrands.ProductCode='{$id}'  ORDER BY ParamCommodityBrands.ProductCode");
			$query->result_array();
			return $query->result();
		}
		
		public function cleanData($input)
		 {
		 $cleanData = $this->security->xss_clean($input );
		 $cleanData = strip_tags(str_replace(array("'","<script>","</script>"),array("`","<!--","-->"),$input));
		 return $cleanData;
		 }
		 
		 
		public Function ValidCommodityRecord() 
		{
		
		
				$state = TRUE;
				if($this->cleanData($this->input->get('indentNo2'))==NULL)
				{
				echo "<font color='red'>Indent Number is Required</font>";
				$state = TRUE;
				}elseif($this->cleanData($this->input->get('ExporterCode2'))==NULL)
				{
				echo "<font color='red'>Select Exporter / Supplier</font>";
				$state = TRUE;
				}elseif($this->cleanData($this->input->get('CommodityCode'))==NULL)
				{
				echo "<font color='red'>Required S.I.T.C. Please Select One.</font>";
				$state = TRUE;
				}elseif($this->cleanData($this->input->get('ProductName'))==NULL)
				{
				echo "<font color='red'>Product Name is Required.</font>";
				$state = TRUE;
				}elseif($this->cleanData($this->input->get('TotalPackages'))==NULL)
				{
				echo "<font color='red'>Enter Total Packages Ordered.</font>";
				$state = TRUE;
				}elseif(!filter_var($this->cleanData($this->input->get('TotalPackages')), FILTER_VALIDATE_INT)) {
				echo "<font color='red'>Enter Valid Total Packages Ordered.</font>";
				}elseif($this->cleanData($this->input->get('PackageType'))==NULL)
				{
				echo "<font color='red'>Select Package Type</font>";
				$state = TRUE;
				}elseif($this->cleanData($this->input->get('QttyUnits'))==NULL)
				{
				echo "<font color='red'>Required Units of Package size</font>";
				$state = TRUE;
				}elseif($this->cleanData($this->input->get('UnitsPerPack'))==NULL)
				{
				echo "<font color='red'>Required Number of Units Per Package</font>";
				$state = TRUE;
				}elseif($this->cleanData($this->input->get('UnitSize'))==NULL)
				{
				echo "<font color='red'>Unit Size is Required</font>";
				$state = TRUE;
				}elseif(!is_numeric($this->cleanData($this->input->get('UnitSize')))) {
				echo "<font color='red'>Enter Valid Unit Size.</font>";
				}else{
				
				$state = FALSE;
				}
			return $state ;
	
		}

		public function ItemsAlreadyExists($IndentNo,$ProductCode)
		{
			$query = $this->db->query("SELECT * FROM ProformaInvoiceItems WHERE IndentNo='{$IndentNo}' AND ProductCode='{$ProductCode}'");
			return $query->result_array();
		
		}
		
		public Function ValidRecord() 
		{
		
		
				$state = TRUE;
				$date1=date_create(date('Y-m-d'));
				$date2=date_create($this->input->get('reservation2'));
				$diff=date_diff($date1,$date2);
			
				if($this->cleanData($this->input->get('IndentType'))==NULL)
				{
				echo "<font color='red'>Select Type of Indent</font>";
				$state = TRUE;
				}elseif($this->cleanData($this->input->get('ExporterCode'))==NULL)
				{
				echo "<font color='red'>Select Exporter / Supplier</font>";
				$state = TRUE;
				}elseif($this->cleanData($this->input->get('SupplyCountry'))==NULL)
				{
				echo "<font color='red'>Country of Supply is Required</font>";
				$state = TRUE;
				}elseif($this->cleanData($this->input->get('reservation2'))==NULL)
				{
				echo "<font color='red'>Select Expected Date</font>";
				$state = TRUE;
				}elseif($diff->format("%R%a")<=0)
				{
				echo "<font color='red'>Please Select a Future Date Date</font>";
				$state = TRUE;
				}elseif($this->cleanData($this->input->get('Fax'))==NULL)
				{
				echo "<font color='red'>Fax No is Required</font>";
				$state = TRUE;
				}elseif($this->cleanData($this->input->get('ContactName'))==NULL)
				{
				echo "<font color='red'>Our Contact Person is Required</font>";
				$state = TRUE;
				}elseif($this->cleanData($this->input->get('BranchCode'))==NULL)
				{
				echo "<font color='red'>Select Destination Store</font>";
				$state = TRUE;
				}elseif($this->cleanData($this->input->get('OwnerNo'))==NULL)
				{
				echo "<font color='red'>Select Shipment Owner</font>";
				$state = TRUE;
				}elseif($this->cleanData($this->input->get('OrderNumber'))==NULL)
				{
				echo "<font color='red'>Order Number is Compulsory</font>";
				$state = TRUE;
				}elseif($this->cleanData($this->input->get('Subject'))==NULL)
				{
				echo "<font color='red'> Message Subject is required</font>";
				$state = TRUE;
				}elseif($this->cleanData($this->input->get('LeadingMessage'))==NULL)
				{
				echo "<font color='red'> Leading Message / Instructions are required</font>";
				$state = TRUE;
				}elseif($this->cleanData($this->input->get('ClossingMessage'))==NULL)
				{
				echo "<font color='red'> Closing Message / Instructions are required</font>";
				$state = TRUE;
				}else{
				
				$state = FALSE;
				}
			return $state ;
	
		}
		public function updateProformaCommodities()
		{
		$IndentNo =  $this->cleanData($this->input->get('indentNo2'));
		$ProductCode =  $this->cleanData($this->input->get('ProductCode'));
		$PackagesOrdered =  $this->cleanData($this->input->get('TotalPackages'));
		$PackageType =  $this->cleanData($this->input->get('PackageType'));
		$UnitSize =  $this->cleanData($this->input->get('UnitSize'));
		$QttyUnits =  $this->cleanData($this->input->get('QttyUnits'));
		$PackageType =  $this->cleanData($this->input->get('PackageType'));
		$query = $this->db->query("UPDATE ProformaInvoiceItems SET PackagesOrdered='{$PackagesOrdered}',UnitSize='{$UnitSize}',QttyUnits='{$QttyUnits}' WHERE IndentNo='{$IndentNo}' AND ProductCode='{$ProductCode}'");
		$query = $this->db->query("UPDATE ProformaInvoiceRequest SET TotalPackages=(SELECT SUM(PackagesOrdered) AS TOTAL FROM ProformaInvoiceItems WHERE ProformaInvoiceItems.IndentNo='{$IndentNo}'),PackageType='{$PackageType}' WHERE IndentNo='{$IndentNo}'");
		echo "Record Saved Successfully";
		}
		public function saveProformaCommodities()
		{
	
		$MyCurrentPeriod = $this->MyCurrentPeriod();
		$MyCurrentDate = date('Y-m-d');
		$CurrentUserName = $_SESSION['IDSUser'];
		$GetImporterCode = $this->GetImporterCode();
	
		$IndentNo =  $this->cleanData($this->input->get('indentNo2'));
		$ProductCode =  $this->cleanData($this->input->get('ProductCode'));
		$PackagesOrdered =  $this->cleanData($this->input->get('TotalPackages'));
		$PackageType =  $this->cleanData($this->input->get('PackageType'));
		$UnitSize =  $this->cleanData($this->input->get('UnitSize'));
		$QttyUnits =  $this->cleanData($this->input->get('QttyUnits'));
		$PackageType =  $this->cleanData($this->input->get('PackageType'));
		$data = array(
				'IndentNo' => $IndentNo,
				'ProductCode' => $ProductCode,
				'PackagesOrdered' => $PackagesOrdered,
				'PackageType' => $PackageType,
				'UnitSize' => $UnitSize,
				'QttyUnits' => $QttyUnits,
				'CreatedBy' => $CurrentUserName,
				'DateCreated' => $MyCurrentDate,
				'AccPeriod' => $MyCurrentPeriod
				);
		$this->db->insert('ProformaInvoiceITems', $data);
		$query = $this->db->query("UPDATE ProformaInvoiceRequest SET TotalPackages=(SELECT SUM(PackagesOrdered) AS TOTAL FROM ProformaInvoiceItems WHERE ProformaInvoiceItems.IndentNo='{$IndentNo}'),PackageType='{$PackageType}', ProfItems='1' WHERE IndentNo='{$IndentNo}'");
			echo "Record Saved Successfully";
		}
		
		public function saveProformaRequests()
		{
	
		$MyCurrentPeriod = $this->MyCurrentPeriod();
		$MyCurrentDate = date('Y-m-d');
		$CurrentUserName = $_SESSION['IDSUser'];
		$GetImporterCode = $this->GetImporterCode();
		$DutyFree =  $this->cleanData($this->input->post('DutyFree'));
		if($DutyFree==""){
		$DutyFree = 0;
		}
		$IndentNo = $this->cleanData($this->input->get('IndentNumber'));
		$IndentType =  $this->cleanData($this->input->get('IndentType'));
		$BranchCode =  $this->cleanData($this->input->get('BranchCode'));
		$country =  $this->cleanData($this->input->get('country'));
		$ExporterCode =  $this->cleanData($this->input->get('ExporterCode'));
		$Subject =  $this->cleanData($this->input->get('Subject'));
		$Subject = $Subject." ".$IndentNo;
		$AttentionTo = $this->cleanData($this->input->get('AttentionTo'));
		$CarbonCopy = $this->cleanData($this->input->get('CarbonCopy'));
		$OrderNumber =  $this->cleanData($this->input->get('OrderNumber'));
		$LeadingMessage =  $this->cleanData($this->input->get('LeadingMessage'));
		$LeadingMessage = str_replace("&"," and ",$LeadingMessage);
		$OwnerNo =  $this->cleanData($this->input->get('OwnerNo'));
		$Fax =  $this->cleanData($this->input->get('Fax'));
		$ClossingMessage =  $this->cleanData($this->input->get('ClossingMessage'));
		$IndentNumber =  $this->cleanData($this->input->get('IndentNumber'));
		$ContactName = $this->cleanData($this->input->get('ContactName'));
		
		$OrderNo = $this->cleanData($this->input->get('OrderNumber'));
		$expectedDate = $this->cleanData($this->input->get('reservation2'));
		$OtherInformation = $this->cleanData($this->input->get('OtherInformation'));
		$SupplyCountry = $this->cleanData($this->input->get('SupplyCountry'));
		$GetDefaultMailDelivery = $this->GetDefaultMailDelivery();
		$GetCurrentStaffID = $this->GetCurrentStaffID();
		$data = array(
				'IndentNo' => $IndentNo,
				'IndentType' => $IndentType,
				'DutyFree' => $DutyFree,
				'BranchCode' => $BranchCode,
				'DestCountry' => $country,
				'ImporterCode' => $GetImporterCode,
				'ExporterCode' => $ExporterCode,
				'Country' => $SupplyCountry,
				'Subject' => $Subject,
				'AttentionTo' => $AttentionTo,
				'CarbonCopy' => $CarbonCopy,
				'LeadMessage' => $LeadingMessage,
				'ClosingMessage' => $ClossingMessage,
				'OtherInformation' => $OtherInformation,
				'PreparedBy' => $GetCurrentStaffID,
				'IndentDate' => $MyCurrentDate,
				'DateExpected' => $expectedDate,
				'DeliveryType' => $GetDefaultMailDelivery,
				'FaxNo' => $Fax,
				'StaffIDNo' => $ContactName,
				'OwnerNo' => $OwnerNo,
				'OrderNo' => $OrderNo,
				'CreatedBy' => $CurrentUserName,
				'DateCreated' => $MyCurrentDate,
				'AccPeriod' => $MyCurrentPeriod
			);

if($this->db->insert('ProformaInvoiceRequest', $data)){
//update the last indent number
$GetNextIndentNumber = $this->GetNextIndentNumber($IndentType);
if($IndentType =="B"){
$this->db->query("UPDATE SetMyLastNumber SET BIndents='{$GetNextIndentNumber}'");
}elseif($IndentType =="C"){
$this->db->query("UPDATE SetMyLastNumber SET CIndents='{$GetNextIndentNumber}'");
}elseif($IndentType =="PD"){
$this->db->query("UPDATE SetMyLastNumber SET PDIndents='{$GetNextIndentNumber}'");
}
//'update the supplier's file with the fax number
$this->db->query("UPDATE ParamExporters SET FaxNo='{$Fax}',Country='{$SupplyCountry}' WHERE ExporterCode='{$ExporterCode}'");
echo "Record Saved Successfully";
		}
		}
		Public Function GetDefaultMailDelivery()
		{
			$query = $this->db->query("SELECT DefaultMail FROM ParamSystemDefaults");
			$query->result_array();
			foreach($query->result() as $key);
			return $key->DefaultMail;
		}
		Public Function GetCurrentStaffID()
		{
			$CurrentUserName=$_SESSION['IDSUser'];
			$query = $this->db->query("SELECT StaffIDNo FROM AdminUserRegister WHERE UserName='{$CurrentUserName}'");
			$query->result_array();
			foreach($query->result() as $key);
			return $key->StaffIDNo;
		}
		public function MyCurrentPeriod()
		{
		return	$MyCurrentPeriod = date("Y/m");
		}
		Public Function GetNextIndentNumber($id)
		{

			if($id=='B'){
			$strLastID = "SELECT MAX(BIndents) AS LastID FROM SetMyLastNumber";
			}elseif($id=='C'){
			$strLastID = "SELECT MAX(CIndents) AS LastID FROM SetMyLastNumber";
			}elseif($id=='PD'){
			$strLastID = "SELECT MAX(PDIndents) AS LastID FROM SetMyLastNumber";
			}else{
			$strLastID = "SELECT MAX(CIndents) AS LastID FROM SetMyLastNumber";
			}
		
			$query = $this->db->query($strLastID);
			
			$query1 = $this->db->query($strLastID);
			$query1->result_array();
			$result1 = $query1->result();

			foreach($result1 as $key);
			
			if($query->num_rows()==0){
			$GetNextIndentNumber = '00001';
			}elseif($key->LastID==""){
			$GetNextIndentNumber = '00001';
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
	}