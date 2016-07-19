<?php
class Proformainvoiceremider_model extends CI_Model
	{

		public function __construct()
        {
                $this->load->database();
        }
		
		public function ShowAllOverDueRequests($indentNo)
		{
			
		$MyCurrentDate = date('Y-m-d');
		if($indentNo!=""){
		$query = $this->db->query("SELECT ProformaInvoiceRequest.*,ParamExporters.ExporterName FROM ParamExporters,ProformaInvoiceRequest WHERE ParamExporters.ExporterCode=ProformaInvoiceRequest.ExporterCode AND ProformaInvoiceRequest.Received IS NULL AND ProformaInvoiceRequest.DateEXpected<='{$MyCurrentDate}' AND ProformaInvoiceRequest.IndentNo='{$indentNo}' ORDER BY ProformaInvoiceRequest.IndentNo");
		
		}else{
		$query = $this->db->query("SELECT ProformaInvoiceRequest.*,ParamExporters.ExporterName FROM ParamExporters,ProformaInvoiceRequest WHERE ParamExporters.ExporterCode=ProformaInvoiceRequest.ExporterCode AND ProformaInvoiceRequest.Received IS NULL AND ProformaInvoiceRequest.DateEXpected<='{$MyCurrentDate}' ORDER BY ProformaInvoiceRequest.IndentNo");
		}
		$query->result_array();
		return $query->result();
		}
		public function loadContactPeople()
		{	
		$query = $this->db->query("SELECT * FROM ParamEmpMaster WHERE StaffIDNo<>'X0002' ORDER BY StaffIDNo");
		
		$query->result_array();
		return $query->result();
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
		public function validateReminder()
		{
		
				$state = FALSE;
				if($this->input->get('IndentNo')==NULL)
				{
				echo "<font color='red'>Select a Pending Proforma Invoice Request.</font>";
				$state = FALSE;
				}elseif($this->input->get('Subject')==NULL)
				{
				echo "<font color='red'>Please enter Subject</font>";
				$state = FALSE;
				}elseif($this->input->post('ReminderMessage')==NULL)
				{
				echo "<font color='red'>Reminder Message is Requred</font>";
				$state = FALSE;
				}elseif($this->input->post('ReminderClosing')==NULL)
				{
				echo "<font color='red'>Invoice Date is Requred</font>";
				$state = FALSE;
				}elseif($this->input->get('StaffIDNo')==NULL)
				{
				echo "<font color='red'>Please Select Contact Person.</font>";
				$state = FALSE;
				}else{
						$state = TRUE;
				}
				return $state;
		}
		public function createReminderDetails()
		{
			$MyCurrentPeriod = $this->MyCurrentPeriod();
			$IndentNo =$this->cleanData($this->input->get('IndentNo'));
			$ReminderNo =$this->GetNextProformaReminder($IndentNo);
			
			$ExporterCode =$this->cleanData($this->input->get('ExporterCode'));
			$ImporterCode =$this->cleanData($this->input->get('ImporterCode'));
			$ReminderDate =date('Y-m-d');
			$date = date_create($ReminderDate);
			$LastExpected = date_add($date,date_interval_create_from_date_string("4 days"));
			$ReminderMessage =$this->cleanData($this->input->post('ReminderMessage'));
			$ReminderClosing =$this->cleanData($this->input->post('ReminderClosing'));
			$Subject =$this->cleanData($this->input->post('Subject'));
			$AttentionTo =$this->cleanData($this->input->get('StaffIDNo'));
			$StaffIDNo =$this->GetCurrentStaffID();
			
			$data = array(
				'IndentNo' => $IndentNo,
				'ReminderNo' => $ReminderNo,
				'ExporterCode' => $ExporterCode,
				'ImporterCode' => $ImporterCode,
				'ReminderDate' => $ReminderDate,
				'LastExpected' => $LastExpected,
				'PreparedBy' => $_SESSION['IDSUser'],
				'StaffIDNo' => $StaffIDNo,
				'AttentionTo' => $AttentionTo,
				'ReminderClosing' => $ReminderClosing,
				'Subject' => $Subject,
				'ReminderMessage' => $ReminderMessage,
				'CreatedBy' => $_SESSION['IDSUser'],
				'DateCreated' => $ReminderDate,
				'AccPeriod' => $MyCurrentPeriod
				);		
			$this->db->insert('ProformaInvoiceRem', $data);
			echo "Record Saved Succssfully.";
		}
		
		Public Function GetNextProformaReminder($id)
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
		
		
		PUBLIC Function FindReminderMessage()
		{
			
			$query1 = $this->db->query("SELECT * FROM ParamDefaultMessages");
			$query1->result_array();
			RETURN $query1->result();
		}
	}