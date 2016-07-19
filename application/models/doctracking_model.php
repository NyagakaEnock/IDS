<?php
class doctracking_model extends CI_Model
	{
		
		public function __construct()
        {
                $this->load->database();
        }
		
		public function ShowNewAcknowledged()
		{
			$query = $this->db->query("SELECT PurchaseOrderMain.*,ProformaInvoiceRequest.AttentionTo,ProformaInvoiceRequest.CarbonCopy,ProformaInvoiceRequest.FaxNo,ParamExporters.ExporterName FROM ParamExporters,ProformaInvoiceRequest,PurchaseOrderMain WHERE ParamExporters.ExporterCode=PurchaseOrderMain.ExporterCode AND ProformaInvoiceRequest.IndentNo=PurchaseOrderMain.IndentNo AND PurchaseOrderMain.ACK IS NOT NULL AND PurchaseOrderMain.Docs IS NULL ORDER BY PurchaseOrderMain.IndentNo");
			$query->result_array();
			return $query->result();				
		}
		public function ShowNewAcknowledgedData($IndentNo)
		{
			$query = $this->db->query("SELECT PurchaseOrderMain.*,ProformaInvoiceRequest.AttentionTo,ProformaInvoiceRequest.CarbonCopy,ProformaInvoiceRequest.FaxNo,ParamExporters.ExporterName FROM ParamExporters,ProformaInvoiceRequest,PurchaseOrderMain WHERE ParamExporters.ExporterCode=PurchaseOrderMain.ExporterCode AND ProformaInvoiceRequest.IndentNo=PurchaseOrderMain.IndentNo AND PurchaseOrderMain.ACK IS NOT NULL AND PurchaseOrderMain.Docs IS NULL AND PurchaseOrderMain.IndentNo='{$IndentNo}' ORDER BY PurchaseOrderMain.IndentNo");
			$query->result_array();
			return $query->result();				
		}
		
		public Function FindRequestMessage()
		{
			$query = $this->db->query("SELECT DocumentRequest FROM ParamDefaultMessages");
			return $query->result()[0]->DocumentRequest;			
		}
		public function ShowShippingDocumentMain()
		{
			$query = $this->db->query("SELECT ParamShippingDocs.* FROM ParamShippingDocs ORDER BY ParamShippingDocs.DocumentCode");
			$query->result_array();
			return $query->result();				
		}
		public function ShowRequestsNotReceived()
		{
			$query = $this->db->query("SELECT ParamExporters.ExporterName,PurchaseOrderMain.*,PurchaseOrderShip.currency,PurchaseOrderShip.ExchRate FROM ParamExporters,PurchaseOrderMain,PurchaseOrderShip WHERE PurchaseOrderShip.IndentNo=PurchaseOrderMain.IndentNo AND ParamExporters.ExporterCode=PurchaseOrderMain.ExporterCode AND PurchaseOrderMain.Docs IS NOT NULL AND PurchaseOrderMain.DocsRec IS NULL ORDER BY PurchaseOrderMain.IndentNo");
			$query->result_array();
			return $query->result();				
		}
		public function ShowRequestsNotReceivedData($IndentNo)
		{
			$query = $this->db->query("SELECT ParamExporters.ExporterName,PurchaseOrderMain.*,PurchaseOrderShip.currency,PurchaseOrderShip.ExchRate FROM ParamExporters,PurchaseOrderMain,PurchaseOrderShip WHERE PurchaseOrderShip.IndentNo=PurchaseOrderMain.IndentNo AND ParamExporters.ExporterCode=PurchaseOrderMain.ExporterCode AND PurchaseOrderMain.Docs IS NOT NULL AND PurchaseOrderMain.DocsRec IS NULL AND PurchaseOrderMain.IndentNo='{$IndentNo}'ORDER BY PurchaseOrderMain.IndentNo");
			$query->result_array();
			return $query->result();				
		}
		public function ShowShippingDocumentRec()
		{
			$query = $this->db->query("SELECT ParamShippingDocs.* FROM ParamShippingDocs ORDER BY ParamShippingDocs.DocumentCode");
			$query->result_array();
			return $query->result();		
		}
		public function loadDocs($DocumentNo)
		{
			$query = $this->db->query("SELECT ParamShippingDocs.* FROM ParamShippingDocs WHERE DocumentCode='{$DocumentNo}' ORDER BY ParamShippingDocs.DocumentCode");
			$query->result_array();
			return $query->result();		
		}
		
		public function safeShippingDocs()
		{
					$IndentNo = $this->input->post('IndentNo');				
					$array[] = $this->ShowNewAcknowledgedData($IndentNo);
					$productIDS = substr($this->input->get('productIDS'),2);
					$productIDSARRAY = explode(",",$productIDS);
					$date = $this->input->post('Date');
					$counter = $this->input->get('counter');
			if(empty($productIDS))
			{
				echo "<font color='red'>Please Select atleast one or More Documents.</font>";
				return;
			}
			
					if(!empty($IndentNo)){
					foreach($array as $rows)
					{
						
									foreach($productIDSARRAY as $productID)
										{
													$data = array(
													'IndentNo' => $IndentNo,
													'DocumentCode' => $productID,
													'CreatedBy' => $_SESSION['IDSUser'],
													'DateCreated' => date('Y-m-d'),
													'AccPeriod' => date("Y/m")
													);	
								$this->db->insert('ShippingDocumentData', $data);													

										}
										if($this->MainDataExists($IndentNo)==FALSE)
										{
											
													$data = array(
													'IndentNo' => $IndentNo,
													'ExporterCode' => $rows[0]->ExporterCode,
													'ImporterCode' => $rows[0]->ImporterCode,
													'FaxNo' => $rows[0]->FaxNo,
													'Subject' => $this->input->post('Subject'),
													'AttentionTo' => $this->input->post('AttentionTo'),
													'CarbonCopy' => $this->input->post('CarbonCopy'),
													'RequestMessage' => $this->input->post('Message'),
													'DateRequested' =>  date('Y-m-d'),
													'DateExpected' => $date,
													'StaffIdNo' => $this->GetCurrentStaffID(),
													'CreatedBy' => $_SESSION['IDSUser'],
													'DateCreated' => date('Y-m-d'),
													'AccPeriod' => date("Y/m")
													);		
										$this->db->insert('ShippingDocumentMain', $data);
								$this->db->query("UPDATE PurchaseOrderMain SET Docs='1' WHERE IndentNo='{$IndentNo}'");										
										}
								
					}
					
					
					echo "Record Saved Successfully.";
					}else{
						echo "<font color='red'>Select A record to Confirm.</font>";
					}			
		}	
		Public Function GetCurrentStaffID()
		{
			$CurrentUserName=$_SESSION['IDSUser'];
			$query = $this->db->query("SELECT StaffIDNo FROM AdminUserRegister WHERE UserName='{$CurrentUserName}'");
			$query->result_array();
			foreach($query->result() as $key);
			return $key->StaffIDNo;
		}
		public function MainDataExists($IndentNo)
		{
			$query = $this->db->query("SELECT COUNT(IndentNo) AS TCOunt FROM ShippingDocumentMain WHERE IndentNo='{$IndentNo}'");
			$query->result_array();
			$TCOunt = $query->result()[0]->TCOunt;		
				if($TCOunt>=1){
					return TRUE;
				}else{
					return FALSE;
				}
		}
		public function FindTheIDF($IndentNo)
		{
			$query = $this->db->query("SELECT IDFNumber,IDFDate FROM IDFMainData WHERE IDFMainData.IndentNo='{$IndentNo}'");
			$query->result_array();
			return $query->result();			
		}
		public function FindProformaInvoice($IndentNo)
		{
			$query = $this->db->query("SELECT ProformaInvoiceRequest.ProfInvoiceNo,ProformaInvoiceRequest.ProfInvoiceDate FROM ProformaInvoiceRequest WHERE ProformaInvoiceRequest.IndentNo='{$IndentNo}'");
			$DocumentNo = $query->result()[0]->ProfInvoiceNo;	
			$DocumentDate = $query->result()[0]->ProfInvoiceDate;
			$query2 = $this->db->query("SELECT SUM(ProformaInvoiceItems.TotalValue) AS TOTAL,MAX(ProformaInvoiceItems.Currency) AS CURRENCY,MAX(ProformaInvoiceItems.ExchRate) AS EXCHRATE FROM ProformaInvoiceItems WHERE ProformaInvoiceItems.IndentNo='{$IndentNo}'");
			$Currency = $query2->result()[0]->CURRENCY;	
			$total = $query2->result()[0]->TOTAL;
			if($this->proformainvoices_model->GetCurrentSellingRate($Currency)!=null){
			$EXCHRATE = $this->proformainvoices_model->GetCurrentSellingRate($Currency)->SellingRate;
			}else{$EXCHRATE='0.00';}
			return $array= array('DocumentNo'=>$DocumentNo,'DocumentDate'=>$DocumentDate,'Currency'=>$Currency,'total'=>$total,'ExchRate'=>$EXCHRATE);
		}
		
		public function FindDepositSlip($IndentNo)
		{
			$query = $this->db->query("SELECT Depositslipno,DateDeposited,PrepaidAmount FROM IDFMainData WHERE IDFMainData.IndentNo='{$IndentNo}'");
			$DocumentNo = $query->result()[0]->Depositslipno;	
			$DocumentDate = $query->result()[0]->DateDeposited;
			$total = $query->result()[0]->PrepaidAmount;	
			$ExchRate = number_format(1,2,'.', '');
			return $array= array('DocumentNo'=>$DocumentNo,'DocumentDate'=>$DocumentDate,'Currency'=>'KSh','total'=>$total,'ExchRate'=>$ExchRate);
		}
		public Function ApproxInvoiceValue($IndentNo)
		{
			$query = $this->db->query("SELECT SUM(PurchaseOrderData.FOBValue) AS TOTAL FROM PurchaseOrderData WHERE PurchaseOrderData.IndentNo='{$IndentNo}'");
			$total = $query->result()[0]->TOTAL;
			return $array= array('DocumentNo'=>'','DocumentDate'=>'','Currency'=>'','total'=>$total,'ExchRate'=>'');			
		}
		public function ValidRecordDocument()
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
				echo "<font color='red'>Required   Date Expected</font>";
				$state = FALSE;
				}elseif($diff>0)
				{
				echo "<font color='red'>Invalid Expected Date </font>";
				$state = FALSE;
				}elseif($this->input->post('AttentionTo')==NULL)
				{
				echo "<font color='red'>Required Suppliers Contact Person</font>";
				$state = FALSE;
				}elseif($this->input->post('Subject')==NULL)
				{
				echo "<font color='red'>Required Subject </font>";
				$state = FALSE;
				}elseif($this->input->post('Message')==NULL)
				{
				echo "<font color='red'>Required Request Message </font>";
				$state = FALSE;
				}else{
					$state =TRUE;
				}
				return $state;				
		}
		public function safeShippingDocsReceived()
		{
					$IndentNo = $this->input->post('IndentNo');				
					$array[] = $this->ShowRequestsNotReceivedData($IndentNo);
					$productIDS = $this->input->get('productIDS');
					$productIDSARRAY = explode(",",$productIDS);
					$date = $this->input->post('Date');
					$Amount = $this->input->post('Amount');
					$counter = $this->input->get('counter');
					$dateN = date('Y-m-d');
					$Currency = $this->input->post('Currency');
					$ExchRate = $this->input->post('ExchRate');
					$DocumentNo = $this->input->post('DocumentNo');
			if(empty($productIDS))
			{
				echo "<font color='red'>Please Select a Document.</font>";
				return;
			}
					if(!empty($IndentNo)){
					foreach($array as $rows);
									foreach($productIDSARRAY as $productID)
										{
											$array2[] = $this->loadDocs($productID);
											foreach($array2 as $document);
								$DocumentCode = $document[0]->DocumentCode;				
							if(($document[0]->DocumentType=="F")&&($Amount==""))
							{
								echo "<font color='red'>Required Amount for ALL Financial Documents.</font>";
								
							}elseif(($document[0]->DocumentType=="F")&&($Amount!="")&&(!is_numeric($Amount)))
							{
								echo "<font color='red'>Invalid Amount.</font>";
							}elseif($this->DocumentAlreadyExists($IndentNo,$document[0]->DocumentCode,$this->input->post('DocumentNo'))==0)
							{
									if($document[0]->DocumentType=="F")
									{
															$data = array(
															'IndentNo' => $IndentNo,
															'DocumentCode' => $document[0]->DocumentCode,
															'DocumentNo' => $this->input->post('DocumentNo'),
															'DateReceived' => date('Y-m-d'),
															'documentDate' => $date,
															'DocumentType' => $document[0]->DocumentType,
															'ApplicableValue' => 'Y',
															'Currency' => $this->input->post('Currency'),
															'ExchRate' => $this->input->post('ExchRate'),
															'AmountValue' => $Amount,
															'CreatedBy' => $_SESSION['IDSUser'],
															'DateCreated' => date('Y-m-d'),
															'AccPeriod' => date("Y/m")
															);	
															
															$this->db->insert('ShippingDocumentRec', $data);													
									}else{
															$data = array(
															'IndentNo' => $IndentNo,
															'DocumentCode' => $document[0]->DocumentCode,
															'DocumentNo' => $this->input->post('DocumentNo'),
															'DateReceived' => date('Y-m-d'),
															'documentDate' => $date,
															'DocumentType' => 'G',
															'ApplicableValue' => 'N',
															'CreatedBy' => $_SESSION['IDSUser'],
															'DateCreated' => date('Y-m-d'),
															'AccPeriod' => date("Y/m")
															);	
															
															$this->db->insert('ShippingDocumentRec', $data);								
									}
								
								$this->db->query("UPDATE ShippingDocumentData SET Received='1' WHERE IndentNo='{$IndentNo}' AND DocumentCode='{$DocumentCode}'");
							}else
							{
								
									if($document[0]->DocumentType=="F")
									{
		$this->db->query("UPDATE ShippingDocumentRec SET documentDate='{$date}',DocumentType='F',ApplicableValue='Y',Currency='{$Currency}',ExchRate='{$ExchRate}',AmountValue='{$Amount}' WHERE IndentNo='{$IndentNo}' AND DocumentCode='{$DocumentCode}' AND DocumentNo='{$DocumentNo}'");
																												
									}else{
		$this->db->query("UPDATE ShippingDocumentRec SET documentDate='{$date}',DocumentType='G',ApplicableValue='N' WHERE IndentNo='{$IndentNo}' AND DocumentCode='{$DocumentCode}' AND DocumentNo='{$DocumentNo}'");																							
									}							
							}

										}
					echo "Record Saved Successfully.";
					}else{
						echo "<font color='red'>Select A record to Confirm.</font>";
					}			
		}
		public Function DocumentAlreadyExists($IndentNo,$DocumentCode,$DocumentNo) 
		{
			$query = $this->db->query("SELECT COUNT(DocumentCode) AS TCOunt FROM ShippingDocumentRec WHERE IndentNo='{$IndentNo}' AND DocumentCode='{$DocumentCode}' AND DocumentNo='{$DocumentNo}'");
			return $query->result()[0]->TCOunt;				
		}
		public function ValidRecordDocumentRec()
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
				echo "<font color='red'>Required  Document Date</font>";
				$state = FALSE;
				}elseif($this->input->post('DocumentNo')==NULL)
				{
				echo "<font color='red'>Required Document Number</font>";
				$state = FALSE;
				}else{
					$state =TRUE;
				}
				return $state;				
		}
	}
?>