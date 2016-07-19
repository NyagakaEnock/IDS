<?php
class Reports_model extends CI_Model
	{

		public function __construct()
        {
                $this->load->database();
        }
		
		
		public function printNewOrders($IndentNo,$IndentDate)
		{
			if($IndentDate!=NULL)
			{
		$sql = "SELECT * FROM ProformaInvoiceItems,ProformaInvoiceRequest,ParamExporters,ParamCommodityBrands WHERE ProformaInvoiceRequest.IndentNo = ProformaInvoiceItems.IndentNo AND ProformaInvoiceRequest.IndentDate>='{$IndentDate}' AND ParamExporters.ExporterCode=ProformaInvoiceRequest.ExporterCode AND ParamCommodityBrands.ProductCode = ProformaInvoiceItems.ProductCode AND ProformaInvoiceRequest.Received IS NULL";
			}else{
		$sql = "SELECT * FROM ProformaInvoiceItems,ProformaInvoiceRequest,ParamExporters,ParamCommodityBrands WHERE ProformaInvoiceRequest.IndentNo = ProformaInvoiceItems.IndentNo AND ProformaInvoiceRequest.IndentNo='{$IndentNo}' AND ParamExporters.ExporterCode = ProformaInvoiceRequest.ExporterCode AND ParamCommodityBrands.ProductCode = ProformaInvoiceItems.ProductCode AND ProformaInvoiceRequest.Received IS NULL";				
			}
		$query = $this->db->query($sql);
		return $query->result();
		}
		public function printReceivedOrders($IndentNo,$IndentDate)
		{
			if($IndentDate!=NULL)
			{
		$sql = "SELECT * FROM ProformaInvoiceItems,ProformaInvoiceRequest,ParamExporters,ParamCommodityBrands WHERE ProformaInvoiceRequest.IndentNo = ProformaInvoiceItems.IndentNo AND ProformaInvoiceRequest.IndentDate>='{$IndentDate}' AND ParamExporters.ExporterCode=ProformaInvoiceRequest.ExporterCode AND ParamCommodityBrands.ProductCode = ProformaInvoiceItems.ProductCode AND ProformaInvoiceRequest.Received IS NOT NULL";
			}else{
		$sql = "SELECT * FROM ProformaInvoiceItems,ProformaInvoiceRequest,ParamExporters,ParamCommodityBrands WHERE ProformaInvoiceRequest.IndentNo = ProformaInvoiceItems.IndentNo AND ProformaInvoiceRequest.IndentNo='{$IndentNo}' AND ParamExporters.ExporterCode = ProformaInvoiceRequest.ExporterCode AND ParamCommodityBrands.ProductCode = ProformaInvoiceItems.ProductCode AND ProformaInvoiceRequest.Received IS NOT NULL";				
			}
		$query = $this->db->query($sql);
		return $query->result();
		}

		public function printConfirmedOrders($IndentNo,$IndentDate)
		{
			if($IndentDate!=NULL)
			{
		$sql = "SELECT * FROM ProformaInvoiceItems,ProformaInvoiceRequest,ParamExporters,ParamCommodityBrands WHERE ProformaInvoiceRequest.IndentNo = ProformaInvoiceItems.IndentNo AND ProformaInvoiceRequest.IndentDate>='{$IndentDate}' AND ParamExporters.ExporterCode=ProformaInvoiceRequest.ExporterCode AND ParamCommodityBrands.ProductCode = ProformaInvoiceItems.ProductCode AND ProformaInvoiceRequest.Received IS NOT NULL AND ProformaInvoiceRequest.Orders IS NOT NULL";
			}else{
		$sql = "SELECT * FROM ProformaInvoiceItems,ProformaInvoiceRequest,ParamExporters,ParamCommodityBrands WHERE ProformaInvoiceRequest.IndentNo = ProformaInvoiceItems.IndentNo AND ProformaInvoiceRequest.IndentNo='{$IndentNo}' AND ParamExporters.ExporterCode = ProformaInvoiceRequest.ExporterCode AND ParamCommodityBrands.ProductCode = ProformaInvoiceItems.ProductCode AND ProformaInvoiceRequest.Received IS NOT NULL AND ProformaInvoiceRequest.Orders IS NOT NULL";				
			}
		$query = $this->db->query($sql);
		return $query->result();
		}
		
		public function printNewOrdersSingle()
		{
	
		$sql = "SELECT * FROM ProformaInvoiceItems,ProformaInvoiceRequest WHERE ProformaInvoiceRequest.IndentNo = ProformaInvoiceItems.IndentNo AND ProformaInvoiceRequest.Received IS NULL";				
		$query = $this->db->query($sql);
		return $query->result();
		}
		public function printInvoice($IndentNo)
		{
	
		$sql = "SELECT * FROM ProformaInvoiceItems,ProformaInvoiceRequest,ParamCommodityBrands WHERE ProformaInvoiceRequest.IndentNo = ProformaInvoiceItems.IndentNo AND ProformaInvoiceRequest.Received IS NULL AND ProformaInvoiceRequest.IndentNo ='{$IndentNo}' AND ParamCommodityBrands.ProductCode = ProformaInvoiceItems.ProductCode";				
		$query = $this->db->query($sql);
		return $query->result();
		}	
		public function printInvoiceSingle($IndentNo)
		{
		$sql = "SELECT * FROM ProformaInvoiceRequest,ParamExporters,ParamEmpMaster,ParamOfficialTitles,ParamPackageTypes WHERE  ProformaInvoiceRequest.Received IS NULL AND ProformaInvoiceRequest.IndentNo ='{$IndentNo}' AND ParamExporters.ExporterCode = ProformaInvoiceRequest.ExporterCode AND ParamEmpMaster.StaffIDNo=ProformaInvoiceRequest.StaffIDNo AND ParamOfficialTitles.JobCode = ParamEmpMaster.JobCode AND ParamPackageTypes.PackageType = ProformaInvoiceRequest.PackageType";				
		$query = $this->db->query($sql);
		return $query->result();
		}		
		public function printReceivedOrdersSingle()
		{
	
		$sql = "SELECT * FROM ProformaInvoiceItems,ProformaInvoiceRequest WHERE ProformaInvoiceRequest.IndentNo = ProformaInvoiceItems.IndentNo AND ProformaInvoiceRequest.Received IS NOT NULL";				
		$query = $this->db->query($sql);
		return $query->result();
		}	
		public function printConfirmedOrdersSingle()
		{
	
		$sql = "SELECT * FROM ProformaInvoiceItems,ProformaInvoiceRequest WHERE ProformaInvoiceRequest.IndentNo = ProformaInvoiceItems.IndentNo AND ProformaInvoiceRequest.Received IS NOT NULL AND ProformaInvoiceRequest.Orders IS NOT NULL";				
		$query = $this->db->query($sql);
		return $query->result();
		}			
		public function getExporters($ExporterCode)
		{
	
		$sql = "SELECT * FROM ParamExporters WHERE ExporterCode='{$ExporterCode}'";				
		$query = $this->db->query($sql);
		return $query->result();
		}
		public function getParamRequest($IndentNo,$IndentDate)
		{
			if($IndentDate!=NULL)
			{
		$sql = "SELECT * FROM ProformaInvoiceRequest WHERE ProformaInvoiceRequest.IndentDate>='{$IndentDate}' AND Received IS NULL";
			}else{
		$sql = "SELECT * FROM ProformaInvoiceRequest WHERE IndentNo='{$IndentNo}' AND Received IS NULL";				
			}
		$query = $this->db->query($sql);
		return $query->result();
		}	
		public function getParamReceivedRequest($IndentNo,$IndentDate)
		{
			if($IndentDate!=NULL)
			{
		$sql = "SELECT * FROM ProformaInvoiceRequest WHERE ProformaInvoiceRequest.DateReceived>='{$IndentDate}' AND Received IS NOT NULL";
			}else{
		$sql = "SELECT * FROM ProformaInvoiceRequest WHERE IndentNo='{$IndentNo}' AND Received IS NOT NULL";				
			}
		$query = $this->db->query($sql);
		return $query->result();
		}		

		public function getParamConfirmedRequest($IndentNo,$IndentDate)
		{
			if($IndentDate!=NULL)
			{
		$sql = "SELECT * FROM ProformaInvoiceRequest WHERE ProformaInvoiceRequest.DateReceived>='{$IndentDate}' AND Received IS NOT NULL AND Orders IS NOT NULL";
			}else{
		$sql = "SELECT * FROM ProformaInvoiceRequest WHERE IndentNo='{$IndentNo}' AND Received IS NOT NULL AND Orders IS NOT NULL";				
			}
		$query = $this->db->query($sql);
		return $query->result();
		}	
		public function statusReport($IndentNo,$IndentDate)
		{
			if($IndentDate!=NULL)
			{
		$sql = "SELECT * FROM ProformaInvoiceRequest,ProformaInvoiceItems,ParamCommodityBrands WHERE ProformaInvoiceRequest.DateReceived>='{$IndentDate}' AND ProformaInvoiceItems.IndentNo = ProformaInvoiceRequest.IndentNo AND ProformaInvoiceItems.ProductCode = ParamCommodityBrands.ProductCode ";
			}else{
		$sql = "SELECT ProformaInvoiceItems.*,ParamCommodityBrands.*,ProformaInvoiceRequest.* FROM ProformaInvoiceRequest,ProformaInvoiceItems,ParamCommodityBrands WHERE ProformaInvoiceRequest.IndentNo='{$IndentNo}' AND ProformaInvoiceItems.IndentNo = ProformaInvoiceRequest.IndentNo AND ProformaInvoiceItems.ProductCode = ParamCommodityBrands.ProductCode";				
			}
		$query = $this->db->query($sql);
		return $query->result();
		}
		public function statusReportCombobox()
		{
			
		$sql = "SELECT DISTINCT ProformaInvoiceRequest.IndentNo FROM ProformaInvoiceRequest,ProformaInvoiceItems WHERE ProformaInvoiceItems.IndentNo = ProformaInvoiceRequest.IndentNo";
			
		$query = $this->db->query($sql);
		return $query->result();
		}
		public function statusReportSingles($IndentNo)
		{
			
		$sql = "SELECT * FROM ProformaInvoiceRequest WHERE IndentNo='{$IndentNo}'";
			
		$query = $this->db->query($sql);
		return $query->result();
		}
		public function statusReportDate($IndentDate)
		{
			
		$sql = "SELECT * FROM ProformaInvoiceRequest WHERE DateReceived>='{$IndentDate}'";
			
		$query = $this->db->query($sql);
		return $query->result();
		}
		public function confirmedOriginal($IndentNo)
		{	
		$sql = "SELECT * FROM ProformaInvoiceRequest WHERE IndentNo='{$IndentNo}' AND Received IS NOT NULL AND Orders IS NOT NULL";					
		$query = $this->db->query($sql);
		return $query->result();
		}	
		public function confirmedOriginalData($IndentNo)
		{	
		$sql = "SELECT ParamBankBranches.PostalAddress AS ADDRESS,ParamBankBranches.TownCity AS Town,* FROM PurchaseOrderMain,ParamTransactionTerms,ParamPorts,ParamImporters,ParamCountries,ParamBankBranches , ParamPackageTypes,ParamExporters  WHERE IndentNo='{$IndentNo}' AND ParamTransactionTerms.TransTerm = PurchaseOrderMain.TransTerm AND ParamPorts.PortName = PurchaseOrderMain.ShipTo AND ParamBankBranches.BankCode = PurchaseOrderMain.BankCode AND ParamImporters.ImporterCode = PurchaseOrderMain.ImporterCode AND ParamCountries.Country = ParamImporters.Country AND ParamPackageTypes.PackageType = PurchaseOrderMain.PackageType AND ParamExporters.ExporterCode = PurchaseOrderMain.ExporterCode";						
		$query = $this->db->query($sql);
		return $query->result();
		}
		public function getExporterCountry($ExporterCode)
		{
		$sql = "SELECT * FROM ParamCountries,ParamExporters WHERE ParamCountries.Country = ParamExporters.Country AND ExporterCode='{$ExporterCode}'";					
		$query = $this->db->query($sql);
		return $query->result();			
		}
		public function confirmedOriginalDetails($IndentNo)
		{
	
		$sql = "SELECT * FROM ParamCommodityBrands,PurchaseOrderData,PurchaseOrderMain WHERE PurchaseOrderData.ProductCode = ParamCommodityBrands.ProductCode AND PurchaseOrderMain.IndentNo = PurchaseOrderData.IndentNo AND PurchaseOrderMain.IndentNo = '{$IndentNo}'";				
		$query = $this->db->query($sql);
		return $query->result();
		}		
		public function getProducts($ProductCode)
		{
	
		$sql = "SELECT * FROM ParamCommodityBrands WHERE ProductCode='{$ProductCode}'";				
		$query = $this->db->query($sql);
		return $query->result();
		}
		public function confirmationDetails($IndentNo)
		{
	
		$sql = "SELECT * FROM PurchaseOrderMain,ParamTransactionTerms,ParamPorts,ParamBankBranches WHERE IndentNo='{$IndentNo}' AND ParamTransactionTerms.TransTerm = PurchaseOrderMain.TransTerm AND ParamPorts.PortName = PurchaseOrderMain.ShipTo AND ParamBankBranches.BankCode = PurchaseOrderMain.BankCode";				
		$query = $this->db->query($sql);
		return $query->result();
		}
	}