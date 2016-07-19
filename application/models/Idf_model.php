<?php
class Idf_model extends CI_Model
	{
		
		public function __construct()
        {
                $this->load->database();
        }

		public function loadIndentNos()
		{	
			$query = $this->db->query("SELECT * FROM ProformaInvoiceRequest WHERE ProfInvoiceNo IS NOT NULL AND ProfInvoiceNo<>'' AND IDF IS NULL AND DutyFree='0' AND DestCountry='KE' ORDER BY IndentNo");
			$query->result_array();
			return $query->result();
		}

		public function checkIndentNos($IndentNo)
		{	
			$query = $this->db->query("SELECT * FROM ProformaInvoiceRequest WHERE ProfInvoiceNo IS NOT NULL AND ProfInvoiceNo<>'' AND IDF IS NULL AND DutyFree='0' AND DestCountry='KE' AND IndentNo='{$IndentNo}'ORDER BY IndentNo");
			return $query->num_rows();
		}
		
		public function loadData($IndentNo)
		{	
			$query = $this->db->query("SELECT ProformaInvoiceRequest.*,ParamImporters.ImporterName,ParamImporters.CustomsCode,ParamExporters.PostalCode,ParamExporters.ExporterName,ParamExporters.PostalAddress,ParamExporters.TownCity,ParamExporters.Country FROM ProformaInvoiceRequest,Paramimporters,ParamExporters WHERE ParamImporters.ImporterCode=ProformaInvoiceRequest.ImporterCode AND ParamExporters.ExporterCode=ProformaInvoiceRequest.ExporterCode AND ProformaInvoiceRequest.IndentNo='{$IndentNo}'");
			$query->result_array();
			return $query->result();
		}
		
		public function loadContactPeople()
		{	
			$query = $this->db->query("SELECT * FROM ParamEmpMaster WHERE StaffIDNo<>'X0002' ORDER BY StaffIDNo");
			$query->result_array();
			return $query->result();
		}
		public function loadTownCity()
		{	
			$query = $this->db->query("SELECT * FROM ParamTownCity ORDER BY TownCity");
			$query->result_array();
			return $query->result();
		}
		
		public function loadPSIAgencyName()
		{	
			$query = $this->db->query("SELECT * FROM ParamPSIAgency ORDER BY PSIAgency");	
			$query->result_array();
			return $query->result();
		}
		Public Function GetMyPrepaidAmount()
		{
			$query = $this->db->query("SELECT IDFPrepaid FROM ParamSystemDefaults WHERE IDFPrepaid IS NOT NULL");
			$query->result_array();
			foreach($query->result() as $key);
			return $key->IDFPrepaid;
		}
		Public Function FindTheUSDValues($IndentNo)
		{
			$query = $this->db->query("SELECT SUM(TotalValue) AS TOTAL,MAX(Currency) AS MCurrency FROM ProformaInvoiceItems WHERE IndentNo='{$IndentNo}' AND Currency IS NOT NULL AND ExchRate IS NOT NULL");	
			$query->result_array();
			return $query->result();	
		}
		
		Public Function CalculateAmountUSD($IndentNo) 
		{
		$CalculateAmountUSD = array('CalculateAmountUSD' => 0,'ExchRate' => '');
		$MyUnits ="";
		$AmountKsh = $MyDollarRate=0;
		$MyWeek = date('W',strtotime(date('Y-m-d')));
		$Currency = $this->FindTheUSDValues($IndentNo);
		$year = date('Y');
		foreach($Currency as $key);
		$Currency = $key->MCurrency;
		$SQL = "SELECT ParamCurrencyByWeek.* FROM ParamCurrencyByWeek WHERE ParamCurrencyByWeek.CurrentYear='{$year}' AND ParamCurrencyByWeek.Week='{$MyWeek}' AND ParamCurrencyByWeek.Currency='{$Currency}'";
		$numSQL = $this->db->query($SQL);
		if($numSQL->num_rows()!=0){
		$query = $this->db->query($SQL);	
		$query->result_array();
		foreach ($query->result() as $row);
		if($row->Currency==""){
		$CalculateAmountUSD =0;
		}
		
		$ExchRate = $row->SellingRate;
		$MyUnits = $row->Units;
		$AmountKsh = ($key->TOTAL * $ExchRate)/$MyUnits;
		$query2 = $this->db->query("SELECT * FROM ParamCurrencyByWeek WHERE ParamCurrencyByWeek.CurrentYear='{$year}' AND ParamCurrencyByWeek.Week='{$MyWeek}' AND (ParamCurrencyByWeek.Currency='USD' OR ParamCurrencyByWeek.Currency='Usd')");	
		$query2->result_array();
		foreach ($query2->result() as $row2);
		if($row2->SellingRate==""){
		$MyDollarRate =0;
		}else{
		$MyDollarRate =$row2->SellingRate;
		}
		
		$CalculateAmountUSD = $AmountKsh/$MyDollarRate;
		$CalculateAmountUSD = array('CalculateAmountUSD' => $CalculateAmountUSD,'ExchRate' => $ExchRate);
		}
		return $CalculateAmountUSD;
		
		}		
		
		Public Function ValidMainData()
		{
				$state = FALSE;
				if($this->input->post('IndentNo')==NULL)
				{
				echo "<font color='red'>Select an Indent Number.</font>";
				$state = FALSE;
				}elseif($this->input->post('ExpectedDate')==NULL)
				{
				echo "<font color='red'>Select Expected Date</font>";
				$state = FALSE;
				}elseif($this->input->post('ImporterCode')==NULL)
				{
				echo "<font color='red'>Select Importer</font>";
				$state = FALSE;
				}elseif($this->input->post('ExporterCode')==NULL)
				{
				echo "<font color='red'>Select Exporter</font>";
				$state = FALSE;
				}elseif($this->input->post('Address')==NULL)
				{
				echo "<font color='red'>Required Postal Address</font>";
				$state = FALSE;
				}elseif($this->input->post('Contact')==NULL)
				{
				echo "<font color='red'>Required Company's Official Contact</font>";
				$state = FALSE;
				}elseif($this->input->post('Contact')==NULL)
				{
				echo "<font color='red'>Required Company's Official Contact</font>";
				$state = FALSE;
				}elseif($this->input->post('TownCity')==NULL)
				{
				echo "<font color='red'>Required Town / City</font>";
				$state = FALSE;
				}elseif(($this->input->post('psivalue')==1) && ($this->input->post('psi')==NULL))
				{
				echo "<font color='red'>Required PSI Agency</font>";
				$state = FALSE;
				}elseif($this->input->post('IndentDate')==NULL)
				{
				echo "<font color='red'>Date of Indent not found.</font>";
				$state = FALSE;
				}elseif($this->input->post('PrepaidAmount')==NULL)
				{
				echo "<font color='red'>Required Prepaid Amount.</font>";
				$state = FALSE;
				}else{
					$state = TRUE;
				}
				return $state;
		}
		public function cleanData($input)
		 {
			 $cleanData = $this->security->xss_clean($input );
			 $cleanData = strip_tags(str_replace(array("'","<script>","</script>"),array("`","<!--","-->"),$cleanData));
			 return $cleanData;
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
		public function saveIDFMainData()
		 {
			$MyCurrentPeriod = $this-> MyCurrentPeriod();
			$ExporterCode =$this->cleanData($this->input->post('ExporterCode'));
			$ImporterCode =$this->cleanData($this->input->post('ImporterCode'));
			$IndentNo =$this->cleanData($this->input->post('IndentNo'));
			$ExpectedDate =$this->cleanData($this->input->post('ExpectedDate'));
			$ExpPostAddress =$this->cleanData($this->input->post('Address'));
			$Contact =$this->cleanData($this->input->post('Contact'));
			$ExpTownCity =$this->cleanData($this->input->post('TownCity'));
			$PSIConfirm =$this->cleanData($this->input->post('psivalue'));
			$IndentDate =$this->cleanData($this->input->post('IndentDate'));
			$PrePaidAmount =$this->cleanData($this->input->post('PrepaidAmount'));
			$CustomsCode =$this->cleanData($this->input->post('CustomsCode'));
			$ExporterName =$this->cleanData($this->input->post('ExporterName'));
			$Country = $this->cleanData($this->input->post('Country'));
			$PSIAgency =  $this->cleanData($this->input->post('psi'));
			$InterventionCode = $this->cleanData($this->input->post('InterventionCode'));
			$PostalCode = $this->cleanData($this->input->post('PostalCode'));
			$GOKFee = $this->cleanData($this->input->post('GOKProcessingFee'));
			$PriorApproval = $this->cleanData($this->input->post('PriorApprovalvalue'));
			$StaffIDNo = $this->GetCurrentStaffID();
			$IndentType = $this->cleanData($this->input->post('IndentType'));
			$DateApplied =date('Y-m-d');
			$currentUser = $_SESSION['IDSUser'];
			
				$data = array(
				'IndentNo' => $IndentNo,
				'IndentType' => $IndentType,
				'IndentDate' => $IndentDate,
				'DateApplied' => $DateApplied,
				'LastExpected' => $ExpectedDate,
				'StaffIDNo' => $Contact,
				'ImporterCode' => $ImporterCode,
				'PreparedBy' => $currentUser,
				'CustomsCode' => $CustomsCode,
				'ExporterCode' => $ExporterCode,
				'ExporterName' => $ExporterName,
				'ExpPostAddress' => $ExpPostAddress,
				'ExpTownCity' => $ExpTownCity,
				'ExpCountry' => $Country,
				'PSIConfirm' => $PSIConfirm,
				'PSIAgency' => $PSIAgency,
				'InterventionCode' => $InterventionCode,
				'GOKFee' => $GOKFee,
				'PriorApproval' => $PriorApproval,
				'PrepaidAmount' => $PrePaidAmount,
				'PostalCode' => $PostalCode,
				'CreatedBy' => $currentUser,
				'DateCreated' => $DateApplied,
				'AccPeriod' => $MyCurrentPeriod
				);	
				
				$this->db->insert('IDFMainData', $data);
			$this->db->query("UPDATE ProformaInvoiceRequest SET IDF='1' WHERE IndentNo='{$IndentNo}'");
				echo "Record Saved Successfully.";
			
		 }
		public function loadShippingIndentNos()
		{	
			$query = $this->db->query("SELECT * FROM IDFMainData WHERE Shipping IS NULL ORDER BY IndentNo");
			$query->result_array();
			return $query->result();
		}
		public function checkShippingIndentNos($IndentNo)
		{	
			$query = $this->db->query("SELECT * FROM IDFMainData WHERE Shipping IS NULL AND IndentNo='{$IndentNo}'ORDER BY IndentNo");
			return $query->num_rows();
		}
		public function coutryofSupply()
		{	
			$query = $this->db->query("SELECT * FROM ParamCountries ORDER BY CountryName");
			$query->result_array();
			return $query->result();
		}
		
		public function loadShippingData($IndentNo)
		{	
			$query = $this->db->query("SELECT IDFMainData.*,ParamExporters.*,ProformaInvoiceRequest.ProfInvoiceNo,ProformaInvoiceRequest.ProfInvoiceDate,ProformaInvoiceRequest.DutyFree FROM IDFMainData,ParamExporters,ProformaInvoiceRequest WHERE ParamExporters.ExporterCode=IDFMainData.ExporterCode AND IDFMainData.IndentNo=ProformaInvoiceRequest.IndentNo AND IDFMainData.IndentNo='{$IndentNo}'");
			$query->result_array();
			return $query->result();
		}
		public function portofDischarge()
		{	
			$query = $this->db->query("SELECT * FROM ParamPorts WHERE LocalPort='1' ORDER BY PortName");
			$query->result_array();
			return $query->result();
		}
		public function transactionTerms()
		{	
			$query = $this->db->query("SELECT * FROM ParamTransactionTerms ORDER BY TransTerm");
			$query->result_array();
			return $query->result();
		}	
		public function transportationMode()
		{	
			$query = $this->db->query("SELECT * FROM ParamTransportModes ORDER BY TransMode");
			$query->result_array();
			return $query->result();
		}	
		public function IncotermName()
		{	
			$query = $this->db->query("SELECT * FROM ParamIncoterm ORDER BY IncotermName");
			$query->result_array();
			return $query->result();
		}			
		public Function SumofReceivedItems($IndentNo)
		{
			$query = $this->db->query("SELECT SUM(TotalValue) AS TOTAL FROM ProformaInvoiceItems WHERE IndentNo='{$IndentNo}' AND TotalValue IS NOT NULL");
			$query->result_array();
			foreach($query->result() AS $key);	
			
			$SumofReceivedItems =$key->TOTAL;
			return $SumofReceivedItems;
		}
		public function GetTotalPackages($IndentNo)
		{
			$query = $this->db->query("SELECT SUM(PackagesReceived) AS TOTAL,MAX(PackageType) AS PackageType,MAX(Currency) AS MCurrency,MAX(ExchRate) AS MExchRate FROM ProformaInvoiceItems WHERE IndentNo='{$IndentNo}' AND PackagesReceived IS NOT NULL AND PackageType IS NOT NULL");
			$query->result_array();
			foreach($query->result() as $key);
			$GetTotalPackages = array("MCurrency" =>$key->MCurrency,"TOTAL" =>$key->TOTAL,"PackageType" =>$key->PackageType,"MExchRate" =>$key->MExchRate);
			return $GetTotalPackages;
	
		}
		public function ValidShipping()
		{
				$state = FALSE;
				if($this->input->post('IndentNo')==NULL)
				{
				echo "<font color='red'>Select an Indent Number.</font>";
				$state = FALSE;
				}elseif($this->input->post('Country')==NULL)
				{
				echo "<font color='red'>Required Country of Origin</font>";
				$state = FALSE;
				}elseif($this->input->post('Incoterm')==NULL)
				{
				echo "<font color='red'>Required Incoterm</font>";
				$state = FALSE;
				}elseif($this->input->post('Discharge')==NULL)
				{
				echo "<font color='red'>Required Port of Discharge</font>";
				$state = FALSE;
				}elseif($this->input->post('Clearance')==NULL)
				{
				echo "<font color='red'>Required Port of Customs Clearance</font>";
				$state = FALSE;
				}elseif($this->input->post('ProfInvoiceNo')==NULL)
				{
				echo "<font color='red'>Required Proforma Invoice Number</font>";
				$state = FALSE;
				}elseif($this->input->post('InvoiceDate')==NULL)
				{
				echo "<font color='red'>Required Invoice Date</font>";
				$state = FALSE;
				}elseif($this->input->post('OtherCharges')==NULL)
				{
				echo "<font color='red'>Required Other Charges Value or Zero</font>";
				$state = FALSE;
				}elseif(($this->input->post('Freight')==1)&&($this->input->post('FreightValue')==NULL))
				{
				echo "<font color='red'>Required Freight Value Since it is NOT Payable Locally</font>";
				$state = FALSE;
				}elseif(($this->input->post('Insurance')==1)&&($this->input->post('Insurancevalue')==NULL))
				{
				echo "<font color='red'>Required Insurance Value Since it is NOT Payable Locally</font>";
				$state = FALSE;
				}elseif(($this->input->post('OtherCharges')!=NULL)&&($this->input->post('OtherChargesDesc')==NULL))
				{
				echo "<font color='red'>Required Other Charges Description.</font>";
				$state = FALSE;
				}elseif($this->input->post('ShipCurrency')==NULL)
				{
				echo "<font color='red'>Required Ship Currency</font>";
				$state = FALSE;
				}elseif($this->input->post('ExchangeRate')==NULL)
				{
				echo "<font color='red'>Required Exchange Rate</font>";
				$state = FALSE;
				}elseif($this->input->post('TotalFOBValue')==NULL)
				{
				echo "<font color='red'>Required Total FOBValue</font>";
				$state = FALSE;
				}elseif($this->input->post('TotalPackages')==NULL)
				{
				echo "<font color='red'>Required Total Number of Packages</font>";
				$state = FALSE;
				}elseif($this->input->post('PackageType')==NULL)
				{
				echo "<font color='red'>Required Package Type</font>";
				$state = FALSE;
				}else{
					$state = TRUE;
				}
				return $state;
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
				
				$this->db->insert('IDFShippingInfo', $data);
			$this->db->query("UPDATE IDFMainData SET Shipping='1' WHERE IndentNo='{$IndentNo}'");
				echo "Record Saved Successfully.";
		}
 
		public function idfItemsIndentNos()
		{
			$query = $this->db->query("SELECT IndentNo AS SelectField FROM IDFMainData WHERE Items IS NULL ORDER BY IndentNo");
			$query->result_array();
			return $query->result();
			
		}
		public function checkidfItemsIndentNos($IndentNo)
		{	
			$query = $this->db->query("SELECT IndentNo AS SelectField FROM IDFMainData WHERE Items IS NULL AND IndentNo='{$IndentNo}' ORDER BY IndentNo");
			return $query->num_rows();
		}
		
		public function loadItemsData($IndentNo)
		{
			
		}
		
		public function loadExporterDetails($IndentNo)
		{
			$query = $this->db->query("SELECT IDFMainData.*,ParamExporters.ExporterName FROM IDFMainData,ParamExporters WHERE ParamExporters.ExporterCode=IDFMainData.ExporterCode AND IDFMainData.IndentNo='{$IndentNo}'");
			$query->result_array();
			return $query->result();
			
		}
		public function ShowCommodityUnderIndent($IndentNo)
		{
			$query = $this->db->query("SELECT ParamCommodityBrands.*,ProformaInvoiceItems.* FROM ParamCommodityBrands,ProformaInvoiceItems WHERE ParamCommodityBrands.ProductCode=ProformaInvoiceItems.ProductCode AND ProformaInvoiceItems.IndentNo='{$IndentNo}' AND ProformaInvoiceItems.IDF IS NULL AND ProformaInvoiceItems.PackagesReceived IS NOT NULL ORDER BY ProformaInvoiceItems.ProductCode");
			$query->result_array();
			return $query->result();
		}
		public function ShowProductsUnderIndent($IndentNo,$ProductCode)
		{
			if($ProductCode!=""){
				$SQL = "SELECT ParamCommodityBrands.*,IDFCommoditiesInfo.* FROM IDFCommoditiesInfo,ParamCommodityBrands WHERE ParamCommodityBrands.ProductCode=IDFCommoditiesInfo.ProductCode AND IDFCommoditiesInfo.IndentNo='{$IndentNo}' AND IDFCommoditiesInfo.Amended IS NULL AND IDFCommoditiesInfo.ProductCode='{$ProductCode}' ORDER BY IDFCommoditiesInfo.ProductCode";
			}else{
				$SQL = "SELECT ParamCommodityBrands.*,IDFCommoditiesInfo.* FROM IDFCommoditiesInfo,ParamCommodityBrands WHERE ParamCommodityBrands.ProductCode=IDFCommoditiesInfo.ProductCode AND IDFCommoditiesInfo.IndentNo='{$IndentNo}' AND IDFCommoditiesInfo.Amended IS NULL ORDER BY IDFCommoditiesInfo.ProductCode";				
			}
			$query = $this->db->query($SQL);
			$query->result_array();
			return $query->result();
			
		}
		
		
		public function searchIDFRecord()
		{
			$query = $this->db->query("SELECT IDFMainData.*,ParamImporters.ImporterName,ParamEmpMaster.AllNames FROM IDFMainData,ParamEmpMaster,ParamImporters WHERE ParamEmpMaster.StaffIDNo=IDFMainData.StaffIDNo AND IDFMainData.ImporterCode=ParamImporters.ImporterCode");
			return $query->result();
		}
		
		public function printIDFRecord($PrintPartIndentNo)
		{
		$query = $this->db->query("SELECT
    IDFMainData.IndentNo, IDFMainData.IndentType, IDFMainData.ExporterName, IDFMainData.ExpPostAddress, IDFMainData.ExpTownCity, IDFMainData.PostalCode, IDFMainData.PSIAgency, IDFMainData.GOKFee, IDFMainData.PrepaidAmount,
    IDFCommoditiesInfo.ProductName1, IDFCommoditiesInfo.UnitSize, IDFCommoditiesInfo.Country, IDFCommoditiesInfo.TotalPackages, IDFCommoditiesInfo.FOBValue, IDFCommoditiesInfo.NewUsedString,
    ParamImporters.ImporterName, ParamImporters.PinNumber, ParamImporters.PostalAddress, ParamImporters.TownCity, ParamImporters.PhoneNo AS CONTACTS, ParamImporters.FaxTelex , ParamImporters.ContactNames, ParamImporters.ContactEmail,
    IDFShippingInfo.CountryOrigin, IDFShippingInfo.PortDischarge, IDFShippingInfo.PortClearance, IDFShippingInfo.ETD, IDFShippingInfo.OriginalCert, IDFShippingInfo.TransactionTerms, IDFShippingInfo.IncoTerm, IDFShippingInfo.ProfInvoiceNo, IDFShippingInfo.ProfInvoiceDate, IDFShippingInfo.Currency AS MYCURRENCY, IDFShippingInfo.ExchRate AS MYRATE, IDFShippingInfo.TotalFOBValue, IDFShippingInfo.FreightString, IDFShippingInfo.InsuranceString, IDFShippingInfo.OtherChargesValue,
    ParamEmpMaster.AllNames,
    ParamCountries.CountryName,
    ParamExporters.PhoneNo, ParamExporters.FaxNo, ParamExporters.ContactPerson, ParamExporters.ContactEMail,ParamExporters.ExporterName AS ExporterNames, ParamExporters.PostalAddress AS PostAdress,
    ParamCommodityBrands.UnitsPerPack, ParamCommodityBrands.QttyUnits, ParamCommodityBrands.PackageType, ParamCommodityBrands.NewCommodityCode,
    ParamCountries_1.CountryName AS CountryNAMES,
    ParamTransportModes.TransModeName
FROM
    { oj ((((((((IDSYSTEM.dbo.IDFMainData IDFMainData INNER JOIN IDSYSTEM.dbo.ParamImporters ParamImporters ON
        IDFMainData.ImporterCode = ParamImporters.ImporterCode)
     INNER JOIN IDSYSTEM.dbo.IDFShippingInfo IDFShippingInfo ON
        IDFMainData.IndentNo = IDFShippingInfo.IndentNo)
     INNER JOIN IDSYSTEM.dbo.ParamEmpMaster ParamEmpMaster ON
        IDFMainData.StaffIDNo = ParamEmpMaster.StaffIDNo)
     INNER JOIN IDSYSTEM.dbo.ParamCountries ParamCountries ON
        IDFMainData.ExpCountry = ParamCountries.Country)
     INNER JOIN IDSYSTEM.dbo.ParamExporters ParamExporters ON
        IDFMainData.ExporterCode = ParamExporters.ExporterCode)
     INNER JOIN IDSYSTEM.dbo.IDFCommoditiesInfo IDFCommoditiesInfo ON
        IDFMainData.IndentNo = IDFCommoditiesInfo.IndentNo)
     INNER JOIN IDSYSTEM.dbo.ParamCountries ParamCountries_1 ON
        ParamImporters.Country = ParamCountries_1.Country)
     INNER JOIN IDSYSTEM.dbo.ParamTransportModes ParamTransportModes ON
        IDFShippingInfo.TransMode = ParamTransportModes.TransMode)
     INNER JOIN IDSYSTEM.dbo.ParamCommodityBrands ParamCommodityBrands ON
        IDFCommoditiesInfo.ProductCode = ParamCommodityBrands.ProductCode} WHERE IDFMainData.IndentNo='{$PrintPartIndentNo}'");
			return $query->result();
		}
		public function printIDFRecord2($IndentNo)
		{
			$query = $this->db->query("SELECT IDFMainData.PSIConfirm,IDFMainData.PriorApproval,IDFShippingInfo.LocalInsp,IDFShippingInfo.Comesa FROM IDFMAinData,IDFShippingInfo WHERE IDFShippingInfo.IndentNo=IDFMainData.IndentNo AND IDFMainData.IndentNo='{$IndentNo}'");
			return $query->result();
		}
		public function editIDFRecord($IndentNo)
		{
			$query = $this->db->query("SELECT IDFMainData.*,ParamImporters.ImporterName,ParamEmpMaster.AllNames FROM IDFMainData,ParamEmpMaster,ParamImporters WHERE ParamEmpMaster.StaffIDNo=IDFMainData.StaffIDNo AND IDFMainData.ImporterCode=ParamImporters.ImporterCode AND IDFMainData.IndentNo='{$IndentNo}'");
			return $query->result();
		}
		public function checkProductsUnderIndent($IndentNo,$ProductCode)
		{
		$SQL = "SELECT ParamCommodityBrands.*,IDFCommoditiesInfo.* FROM IDFCommoditiesInfo,ParamCommodityBrands WHERE ParamCommodityBrands.ProductCode=IDFCommoditiesInfo.ProductCode AND IDFCommoditiesInfo.IndentNo='{$IndentNo}' AND IDFCommoditiesInfo.Amended IS NULL AND IDFCommoditiesInfo.ProductCode='{$ProductCode}' ORDER BY IDFCommoditiesInfo.ProductCode";
		$query = $this->db->query($SQL);
		return $query->num_rows();
			
		}		
		public function checkIDFItem($IndentNo,$ProductCode)
		{
			$query = $this->db->query("SELECT * FROM IDFCommoditiesInfo WHERE IndentNo='{$IndentNo}' AND ProductCode='{$ProductCode}'ORDER BY IndentNo");
			return $query->num_rows();			
		}
		public function saveIDFItems()
		{	

			$productIDS = $this->input->get('productIDS');
			$IndentNo = $this->input->get('IndentNo');	
			$productIDSARRAY =explode(",",$productIDS);
			 if($this->input->post('COMESAvalue')==0)
			 {
				$aA = "N";
                $bB = "NEW";
			 }elseif($this->input->post('COMESAvalue')==1)
			 {
				$aA = "U";
                $bB = "USED-".$this->input->post('ItemUsedYear');				 
			 }
			if(empty($productIDSARRAY[0]))
			{
				echo "<font color='red'>Please Select atleast one or More Products</font>";
				return;
			}
			if($IndentNo !="")
			{
				if($this->checkidfItemsIndentNos($IndentNo)!=0)
				{
					$array[] = $this->ShowCommodityUnderIndent($IndentNo);
					foreach($array as $rows)
					{
						foreach($rows as $item)
						{	
							foreach($productIDSARRAY as $productID)
							{
								if($item->ProductCode==$productID)
								{
										$data = array(
													'IndentNo' => $IndentNo,
													'ProductCode' => $item->ProductCode,
													'ProductName1' => $item->ProductName,
													'UnitSize' => $item->UnitSize,
													'QttyUnits' => $item->QttyUnits,
													'Country' => $item->CountryOrigin,
													'Currency' => $item->Currency,
													'ExchRate' => $item->ExchRate,
													'TotalPackages' => $item->PackagesReceived,
													'FOBValue' => $item->TotalValue,
													'GrossWeight' => $item->GrossWeight,
													'NetWeight' => $item->NetWeight,
													'NewUsed' => $aA,
													'UsedYear' => $this->input->post('ItemUsedYear'),
													'NewUsedString' => $bB,
													'CreatedBy' => $_SESSION['IDSUser'],
													'DateCreated' => date('Y-m-d'),
													'AccPeriod' => $this->MyCurrentPeriod()
										);	
								if($this->checkIDFItem($IndentNo,$item->ProductCode)==0)
								{
								$this->db->insert('IDFCommoditiesInfo', $data);
								}else
								{
									$array = array('IndentNo =' => $IndentNo, 'ProductCode =' => $item->ProductCode);
									$this->db->where($array);
									$this->db->update('IDFCommoditiesInfo', $data);
								}
								
								$ProductCode = $item->ProductCode;
								$this->db->query("UPDATE ProformaInvoiceItems SET IDF='1' WHERE IndentNo='{$IndentNo}' AND ProductCode='{$ProductCode}'");
								$this->db->query("UPDATE IDFMainData SET ITems='1' WHERE IndentNo='{$IndentNo}'");
								$this->db->query("UPDATE IDFShippingInfo SET TotalFOBValue=(SELECT SUM(IDFCommoditiesInfo.FOBValue) AS TOTAL FROM IDFCommoditiesInfo WHERE IDFShippingInfo.IndentNo=IDFCommoditiesInfo.IndentNo AND IDFCommoditiesInfo.IndentNo='{$IndentNo}') WHERE IDFShippingInfo.IndentNo='{$IndentNo}'");
								}
							}
						}
					}
					echo "Record Saved Successfully.";
								
				}
		}
		}
		
		public function ShowAllPendingIDF()
		{
			$query = $this->db->query("SELECT ParamExporters.ExporterName,IDFMainData.* FROM IDFMainData,ParamExporters WHERE IDFMainData.ExporterCode=ParamExporters.ExporterCode AND IDFMainData.Received IS NULL ORDER BY IDFMainData.IndentNo");
			$query->result_array();
			return $query->result();			
		}
		public function checkShowAllPendingIDF($IndentNo)
		{
			$query = $this->db->query("SELECT ParamExporters.ExporterName,IDFMainData.* FROM IDFMainData,ParamExporters WHERE IDFMainData.ExporterCode=ParamExporters.ExporterCode AND IDFMainData.Received IS NULL AND  IDFMainData.IndentNo ='{$IndentNo}' ORDER BY IDFMainData.IndentNo");
			return $query->num_rows();			
		}

		public function AllPendingIDFData($IndentNo)
		{
			$query = $this->db->query("SELECT ParamExporters.ExporterName,IDFMainData.* FROM IDFMainData,ParamExporters WHERE IDFMainData.ExporterCode=ParamExporters.ExporterCode AND IDFMainData.Received IS NULL AND  IDFMainData.IndentNo ='{$IndentNo}' ORDER BY IDFMainData.IndentNo");
			$query->result_array();
			return $query->result();			
		}
		
			public function ValidIDFNo()
		{
				$date1=date_create(date('Y-m-d'));
				$date2=date_create($this->input->post('DateReceived'));
				$diff=date_diff($date2,$date1);
				$diff = $diff->format("%R%a days");
				$date2=date_create($this->input->post('IDFDate'));
				$diff2=date_diff($date2,$date1);
				$diff2 = $diff2->format("%R%a days");
			
				$state = FALSE;
				if($this->input->post('indentNo2')==NULL)
				{
				echo "<font color='red'>Please Select a Record</font>";
				$state = FALSE;
				}elseif($this->input->post('IDFNumber')==NULL)
				{
				echo "<font color='red'>Required IDF Number</font>";
				$state = FALSE;
				}elseif($this->input->post('IDFDate')==NULL)
				{
				echo "<font color='red'>Required IDF Date</font>";
				$state = FALSE;
				}elseif($diff2<0)
				{
				echo "<font color='red'>IDF Date Cannot be in the Future</font>";
				$state = FALSE;
				}elseif($this->input->post('DateReceived')==NULL)
				{
				echo "<font color='red'>Required Date Received</font>";
				$state = FALSE;
				}elseif($diff<0)
				{
				echo "<font color='red'>Received Date Cannot be in the Future</font>";
				$state = FALSE;
				}else{
					$state = TRUE;
				}
				RETURN $state;
		}
		
		public function updateIDFNo()
		{
			$dateRecvd = $this->input->post('DateReceived');
			$IDFDate = $this->input->post('IDFDate');
			$IDFNumber = $this->input->post('IDFNumber');
			$indentNo2 = $this->input->post('indentNo2');
			$this->db->query("UPDATE IDFMainData SET 
								Received='1',
								DateReceived='{$dateRecvd}',
								IDFNumber='{$IDFNumber}',
								IDFDate='{$IDFDate}' WHERE IndentNo='{$indentNo2}'");
			echo "IDF Number Updated Successfully.";
		}
		public function ShowAllNewIndents()
		{
			$query = $this->db->query("SELECT IDFMainData.*,IDFShippingInfo.ProfInvoiceNo,IDFShippingInfo.ProfInvoiceDate,IDFShippingInfo.Currency,IDFShippingInfo.ExchRate,IDFShippingInfo.FreightValue,IDFShippingInfo.OtherChargesValue,IDFShippingInfo.TotalFOBValue FROM IDFMainData,IDFShippingInfo WHERE IDFShippingInfo.IndentNo=IDFMainData.IndentNo AND IDFMainData.Received IS NOT NULL AND IDFMainData.Amended IS NULL ORDER BY IDFMainData.IndentNo");
			$query->result_array();
			return $query->result();
		}
		public function checkShowAllNewIndents($IndentNo)
		{
			$query = $this->db->query("SELECT IDFMainData.*,IDFShippingInfo.ProfInvoiceNo,IDFShippingInfo.ProfInvoiceDate,IDFShippingInfo.Currency,IDFShippingInfo.ExchRate,IDFShippingInfo.FreightValue,IDFShippingInfo.OtherChargesValue,IDFShippingInfo.TotalFOBValue FROM IDFMainData,IDFShippingInfo WHERE IDFShippingInfo.IndentNo=IDFMainData.IndentNo AND IDFMainData.Received IS NOT NULL AND IDFMainData.Amended IS NULL AND IDFMainData.IndentNo='{$IndentNo}'ORDER BY IDFMainData.IndentNo");
			return $query->num_rows();			
		}
		public function ShowAllNewIndentsData($IndentNo)
		{
			$query = $this->db->query("SELECT IDFMainData.*,IDFShippingInfo.ProfInvoiceNo,IDFShippingInfo.ProfInvoiceDate,IDFShippingInfo.Currency,IDFShippingInfo.ExchRate,IDFShippingInfo.FreightValue,IDFShippingInfo.OtherChargesValue,IDFShippingInfo.TotalFOBValue FROM IDFMainData,IDFShippingInfo WHERE IDFShippingInfo.IndentNo=IDFMainData.IndentNo AND IDFMainData.Received IS NOT NULL AND IDFMainData.Amended IS NULL AND IDFMainData.IndentNo='{$IndentNo}'ORDER BY IDFMainData.IndentNo");
			$query->result_array();
			return $query->result();		
		}
		public function GoodsDescription()
		{	
			$query = $this->db->query("SELECT * FROM ParamInsuranceDesc ORDER BY CodeNumber");
			$query->result_array();
			return $query->result();
		}		
		
		public function amendmentTypes()
		{	
			$query = $this->db->query("SELECT  * FROM ParamIDFAmendType ORDER BY AmendType");
			$query->result_array();
			return $query->result();
		}	
		public function amendmentPurpose()
		{	
			$query = $this->db->query("SELECT * FROM ParamIDFAmendPurp ORDER BY AmendPurpose");
			$query->result_array();
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
		Public Function GetNextAmendmentNo($id)
		{
			$strLastID = "SELECT MAX(ReminderNo) AS LastID FROM ProformaInvoiceRem WHERE IndentNo='{$id}'";
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
			$strTemp = $strTemp+1;
             $GetNextIndentNumber = $strTemp;
			
			}
			return $GetNextIndentNumber;
		}
		public function validateAmendment()
		{
				$state = FALSE;
				if($this->input->post('TotFOBAmend')==NULL)
				{
				echo "<font color='red'>Required Total FOB Value.</font>";
				$state = FALSE;
				}elseif(!is_numeric($this->input->post('TotFOBAmend')))
				{
				echo "<font color='red'>Invalid Total FOB Value.</font>";
				$state = FALSE;
				}elseif($this->input->post('Freight')==NULL)
				{
				echo "<font color='red'>Required Total Freight Value</font>";
				$state = FALSE;
				}elseif(!is_numeric($this->input->post('Freight')))
				{
				echo "<font color='red'>Invalid Total Freight Value.</font>";
				$state = FALSE;
				}elseif($this->input->post('Charges')==NULL)
				{
				echo "<font color='red'>Required Current Total Other Charges or Zero(0)</font>";
				$state = FALSE;
				}elseif(!is_numeric($this->input->post('Charges')))
				{
				echo "<font color='red'>Invalid Other Charges Value.</font>";
				$state = FALSE;
				}elseif($this->input->post('CommodityDesc')==NULL)
				{
				echo "<font color='red'>Required Commodity Description</font>";
				$state = FALSE;
				}elseif($this->input->post('AmendType')==NULL)
				{
				echo "<font color='red'>Required Type of Amendment</font>";
				$state = FALSE;
				}elseif($this->input->post('AmendPurpose')==NULL)
				{
				echo "<font color='red'>Required Purpose of Amendment</font>";
				$state = FALSE;
				}else{
					$state = TRUE;
				}			
				return $state;
		}
		public function safeAmendments()
		{			
					$IndentNo = $this->input->get('IndentNo');	
					$array[] = $this->ShowAllNewIndentsData($IndentNo);
					if(!empty($IndentNo)){
					foreach($array as $rows)
					{
							foreach($this->GetCurrentSellingRate($rows[0]->Currency) as $key);
							if(!isset($key))
							{
								echo "<font color='red'>This Week's Exchange Rate Has not been Set. Kindly Contact System Administrator.</font>";
								return;
							}
							$data = array(
										'IndentNo' => $IndentNo,
										'AmendNo' => $this->GetNextAmendmentNo($IndentNo),
										'IDFNumber' => $rows[0]->IDFNumber,
										'IDFDate' =>  $rows[0]->IDFDate,
										'AmendType' => $this->cleanData($this->input->post('AmendType')),
										'DateAmended' => date('Y-m-d'),
										'CommodityDesc' => $this->cleanData($this->input->post('CommodityDesc')),
										'AmendPurpose' =>  $this->cleanData($this->input->post('AmendPurpose')),
										'Currency' => $rows[0]->Currency,
										'ExchRate' => $key->SellingRate,
										'FreightCurrent' => $rows[0]->FreightValue,
										'FreightAmend' => $this->cleanData($this->input->post('Freight')),
										'OtherCurrent' => $rows[0]->OtherChargesValue,
										'OtherAmend' => $this->cleanData($this->input->post('Charges')),
										'TotFOBCurrent' =>  $rows[0]->TotalFOBValue,
										'TotFOBAmend' => $this->cleanData($this->input->post('TotFOBAmend')),
										'StaffIDNo' => $this->GetCurrentStaffID(),
										'CreatedBy' => $_SESSION['IDSUser'],
										'DateCreated' => date('Y-m-d'),
										'AccPeriod' => $this->MyCurrentPeriod()
										);	
					$this->db->insert('IDFAmendMain', $data);
					$this->db->query("UPDATE IDFMainData SET Amended='1' WHERE IndentNo='{$IndentNo}'");
					echo "Record Saved Successfully.";
					}
					}else{
						echo "<font color='red'>Select A record to Ammend.</font>";
					}
		}

		public function ShowDataSheet()
		{	
			$query = $this->db->query("SELECT IDFAmendMain.*,ParamIDFAmendType.AmendName FROM IDFAmendMain,ParamIDFAmendType WHERE ParamIDFAmendType.AmendType=IDFAmendMain.AmendType AND IDFAmendMain.Items IS NULL ORDER BY IDFAmendMain.IndentNo");
			$query->result_array();
			return $query->result();
		}	
		public function checkShowDataSheetIndents($IndentNo)
		{	
			$query = $this->db->query("SELECT IDFAmendMain.*,ParamIDFAmendType.AmendName FROM IDFAmendMain,ParamIDFAmendType WHERE ParamIDFAmendType.AmendType=IDFAmendMain.AmendType AND IDFAmendMain.Items IS NULL AND IDFAmendMain.IndentNo='{$IndentNo}' ORDER BY IDFAmendMain.IndentNo");
			return $query->num_rows();	
		}			
	
		public function validateProductAmendment()
		{
				$state = FALSE;
				if($this->input->post('TotalPackages')==NULL)
				{
				echo "<font color='red'>Required Total Packages.</font>";
				$state = FALSE;
				}elseif(!is_numeric($this->input->post('TotalPackages')))
				{
				echo "<font color='red'>Invalid Total Total Packages</font>";
				$state = FALSE;
				}elseif($this->input->post('FOBValue')==NULL)
				{
				echo "<font color='red'>Required Total FOB Value</font>";
				$state = FALSE;
				}elseif(!is_numeric($this->input->post('FOBValue')))
				{
				echo "<font color='red'>Invalid Total FOB Value.</font>";
				$state = FALSE;
				}elseif($this->input->post('GrossWeight')==NULL)
				{
				echo "<font color='red'>Required Gross Weight</font>";
				$state = FALSE;
				}elseif(!is_numeric($this->input->post('GrossWeight')))
				{
				echo "<font color='red'>Invalid  Gross Weight Value.</font>";
				$state = FALSE;
				}elseif($this->input->post('NetWeight')==NULL)
				{
				echo "<font color='red'>Required Net Weight</font>";
				$state = FALSE;
				}elseif(!is_numeric($this->input->post('NetWeight')))
				{
				echo "<font color='red'>Invalid  Net  Value.</font>";
				$state = FALSE;
				}else{
					$state = TRUE;
				}			
				return $state;
		}
		public function safeProductAmendments()
		{			
					$IndentNo = $this->input->post('IndentNo');
					$ProductCode = $this->input->post('ProductCode');					
					$array[] = $this->ShowProductsUnderIndent($IndentNo,$ProductCode);
					if(!empty($IndentNo)){
					foreach($array as $rows)
					{
						
							if(!isset($rows))
							{
								echo "<font color='red'>This Week's Exchange Rate Has not been Set. Kindly Contact System Administrator.</font>";
								return;
							}
							$data = array(
										'IndentNo' => $IndentNo,
										'AmendNo' => $this->cleanData($this->input->post('AmendNo')),
										'ProductCode' => $rows[0]->ProductCode,
										'ProductName1' =>  $rows[0]->ProductName,
										'UnitsPerPack' => $rows[0]->UnitsPerPack,
										'UnitSize' =>  $rows[0]->UnitSize,
										'QttyUnits' => $rows[0]->QttyUnits,
										'PackageType' =>  $rows[0]->PackageType,
										'PacksCurrent' => $rows[0]->TotalPackages,
										'PacksAmend' => $this->cleanData($this->input->post('TotalPackages')),
										'FOBCurrent' => $rows[0]->FOBValue,
										'FOBAmend' => $this->cleanData($this->input->post('FOBValue')),
										'GrossCurrent' => $rows[0]->GrossWeight,
										'GrossAmend' => $this->cleanData($this->input->post('GrossWeight')),
										'NetCurrent' =>  $rows[0]->NetWeight,
										'NetAmend' => $this->cleanData($this->input->post('NetWeight')),
										'CreatedBy' => $_SESSION['IDSUser'],
										'DateCreated' => date('Y-m-d'),
										'AccPeriod' => $this->MyCurrentPeriod()
										);	
							
					$AmendNo = $this->cleanData($this->input->post('AmendNo'));
					$SumCurrentFOB = $this->SumCurrentFOB($IndentNo);
					$SumAmendedFOB = $this->SumAmendedFOB($IndentNo,$AmendNo);
					$this->db->insert('IDFAmendData', $data);
					$this->db->query("UPDATE IDFCommoditiesInfo SET Amended='1' WHERE IndentNo='{$IndentNo}'");
					$this->db->query("UPDATE IDFAmendMain SET Items='1' WHERE IndentNo='{$IndentNo}' AND AmendNo='{$AmendNo}'");
					$this->db->query("UPDATE IDFAmendMain SET TotFOBCurrent='{$SumCurrentFOB}',TotFOBAmend='{$SumAmendedFOB}' WHERE IndentNo='{$IndentNo}' AND AmendNo='{$AmendNo}'");
					echo "Record Saved Successfully.";
					}
					}else{
						echo "<font color='red'>Select A record to Ammend.</font>";
					}
		}
		public Function SumCurrentFOB($IndentNo)
		{
				$query = $this->db->query("SELECT SUM(IDFCommoditiesInfo.FOBValue) AS TOTAL FROM IDFCommoditiesInfo WHERE IDFCommoditiesInfo.IndentNo='{$IndentNo}'");
			$query->result_array();
			foreach($query->result() as $key);
			
			return $key->TOTAL;		
		}
		public Function SumAmendedFOB($IndentNo,$AmendNo)
		{
			$cFob = 0;
			$xFOB = 0;
			$nFob = 0;
				$query = $this->db->query("SELECT SUM(IDFCommoditiesInfo.FOBValue) AS TOTAL FROM IDFCommoditiesInfo WHERE IDFCommoditiesInfo.IndentNo='{$IndentNo}'");
			$query->result_array();	
			foreach($query->result() as $key);
			
			$cFob = $key->TOTAL;
			
			$query2 = $this->db->query("SELECT SUM(IDFAmendData.FOBCurrent) AS TOTAL,SUM(IDFAmendData.FOBAmend) AS TOTAL1 FROM IDFAmendData WHERE IDFAmendData.IndentNo='{$IndentNo}' AND  IDFAmendData.AmendNo='{$AmendNo}'");
			
			$query2->result_array();	
			foreach($query2->result() as $key2);	

				$xFOB = $key2->TOTAL;
				$nFob = $key2->TOTAL1;
				$SumAmendedFOB = ($cFob - $xFOB) + $nFob;
				return $SumAmendedFOB;
				
		
		}
		public function ShowProcessedIndents()
		{
		
		$sql = "SELECT IDFAmendMain.*,IDFMainData.PSIAgency FROM IDFAmendMain,IDFMainData WHERE IDFAmendMain.IndentNo=IDFMainData.IndentNo AND IDFAmendMain.Approved IS NULL OR IDFAmendMain.Approved='' ORDER BY IDFAmendMain.IndentNo";
			$query = $this->db->query($sql);
			$query->result_array();
			return $query->result();
		}

		public function ShowProcessedIndentsData($IndentNo)
		{
			$sql = "SELECT IDFAmendMain.*,IDFMainData.PSIAgency FROM IDFAmendMain,IDFMainData WHERE IDFAmendMain.IndentNo=IDFMainData.IndentNo AND (IDFAmendMain.Approved IS NULL OR IDFAmendMain.Approved='') AND IDFAmendMain.IndentNo='{$IndentNo}' ORDER BY IDFAmendMain.IndentNo";
			$query = $this->db->query($sql);
			$query->result_array();
			return $query->result();
		}
		public function checkShowProcessedIndents($IndentNo)
		{	
			$query = $this->db->query("SELECT IDFAmendMain.*,IDFMainData.PSIAgency FROM IDFAmendMain,IDFMainData WHERE IDFAmendMain.IndentNo=IDFMainData.IndentNo AND (IDFAmendMain.Approved IS NULL OR IDFAmendMain.Approved='') AND IDFAmendMain.IndentNo='{$IndentNo}' ORDER BY IDFAmendMain.IndentNo");
			return $query->num_rows();	
		}	
	
		public function validateProcessed()
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
				}elseif($diff<0)
				{
				echo "<font color='red'>I.D.F. Date Cannot be in the future.</font>";
				$state = FALSE;
				}elseif(($this->input->post('ApprovedNotvalue')=='N')&& ($this->input->post('Approvedvalue')=='N'))
				{
				echo "<font color='red'>Select if Approved or not approved.</font>";
				$state = FALSE;
				}elseif(($this->input->post('Reason')==NULL)&&($this->input->post('ApprovedNotvalue')=='Y'))
				{
				echo "<font color='red'>Kindly give a reason why not approved.</font>";
				$state = FALSE;
				}else{
					$state = TRUE;
				}		
				return $state;
		}
		
		public function safeProcessedAmendments()
		{
			$approved =  $this->input->post('approv');
			$IndentNo =  $this->input->post('IndentNo');
			$Reason =  $this->input->post('Reason');
			$date =  $this->input->post('date');
			$AmendNo =  $this->input->post('AmendNo');
			$approver = $this->GetCurrentStaffID();
			//$this->UpdateTheIDFRecords($IndentNo,$AmendNo);
			
		$this->db->query("UPDATE IDFAmendMain SET Approved='{$approved}',DateApproved='{$date}',ApprovedBy='{$approver}',ApprovalNotes='{$Reason}' WHERE IndentNo='{$IndentNo}' AND AmendNo='{$AmendNo}'");
		echo "Record Saved Successfully.";
		
		/*
        If .optApprove(0).Value = True Then
            'update idfcommoditiesinfo and idfshippinginfo where replacement exists
            Call UpdateTheIDFRecords
            'update purchaseorderrecords if the record had progressed to purchase orders
            Call UpdatePurchaseOrders
            'update commercial invoice records if the record already reached there
            Call UpdateCommercialInvoices
            'update shipmenttypemain if the indent has reached thus far
            Call UpdateShipmentTypes
            'update shipmenttypemain if the indent has reached thus far
            Call UpdateTheMotherEntry
        End If
		
		*/
		}
		
		PUBLIC function ShowAmendedProducts($IndentNo,$AmendNo)
		{
			$query = $this->db->query("SELECT ParamCommodityBrands.CommodityCode,ParamCommodityBrands.SITC,IDFAmendData.* FROM IDFAmendData,ParamCommodityBrands WHERE ParamCommodityBrands.ProductCode=IDFAmendData.ProductCode AND IDFAmendData.IndentNo='{$IndentNo}' AND IDFAmendData.AmendNo='{$AmendNo}' ORDER BY IDFAmendData.ProductCode");
			$query->result_array();
			return $query->result();				
		}
		public function UpdateTheIDFRecords($IndentNo,$AmendNo)
		{
			$query = $this->db->query("SELECT IDFAmendLog.* FROM IDFAmendLog WHERE IDFAmendLog.IndentNo='{$IndentNo}' AND IDFAmendLog.AmendNo='{$AmendNo}' AND (IDFAmendLog.Replaced IS NULL OR IDFAmendLog.Replaced='') ORDER BY IDFAmendLog.ProductCode");
			$result_array = $query->result_array();
			if(empty($result_array))
			{
				goto UpdateCommodities;
			}ELSE{
				
			}
			UpdateCommodities:
			$query2 = $this->db->query("SELECT IDFAmendData.* FROM IDFAmendData WHERE IDFAmendData.IndentNo='{$IndentNo}' AND IDFAmendData.AmendNo='{$AmendNo}'");
			$result_array2 = $query2->result_array();
			if(empty($result_array))
			{
				goto UpdateShipping;
			}ELSE{
				
			}
			UpdateShipping:
			$query3 = $this->db->query("SELECT IDFAmendMain.* FROM IDFAmendMain WHERE IDFAmendMain.IndentNo='{$IndentNo}' AND IDFAmendMain.AmendNo='{$AmendNo}'");
			$result_array3 = $query3->result_array();
			if(empty($result_array))
			{
				goto UpdateMain;
			}ELSE{
				
			}	
			UpdateMain:		
			$this->db->query("UPDATE IDFMainData SET Amended=NULL WHERE IndentNo='{$IndentNo}'");
			
		}
		public function UpdatePurchaseOrders()
		{
			$query = $this->db->query("SELECT IDFAmendLog.* FROM IDFAmendLog WHERE IDFAmendLog.IndentNo='{$IndentNo}' AND IDFAmendLog.AmendNo='{$AmendNo}' AND IDFAmendLog.Replaced IS NOT NULL AND (IDFAmendLog.Orders='' OR IDFAmendLog.Orders IS NULL) ORDER BY IDFAmendLog.ProductCode");
			$result_array = $query->result_array();
			if(empty($result_array))
			{
				goto UpdateCommodities;
			}ELSE{
				
			}
			UpdateCommodities:
			$query2 = $this->db->query("SELECT IDFAmendData.* FROM IDFAmendData WHERE IDFAmendData.IndentNo='{$IndentNo}' AND IDFAmendData.AmendNo='{$AmendNo}'");
			$result_array2 = $query2->result_array();
			if(empty($result_array))
			{
				goto UpdateShipping;
			}ELSE{
				
			}
			UpdateShipping:
			$query3 = $this->db->query("SELECT IDFAmendMain.* FROM IDFAmendMain WHERE IDFAmendMain.IndentNo='{$IndentNo}' AND IDFAmendMain.AmendNo='{$AmendNo}'");
			$result_array3 = $query3->result_array();
			if(empty($result_array))
			{
				goto UpdateMain;
			}ELSE{
				
			}	
			UpdateMain:		
			$this->db->query("UPDATE IDFMainData SET Amended=NULL WHERE IndentNo='{$IndentNo}'");			
		}
	}
