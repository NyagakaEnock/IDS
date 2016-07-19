<?php
class Request_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
		
				public function get_requestDetails()
		{
						$query = $this->db->get('requests');
						 $query->result_array();
						return $query->result();
		}
				public function saveRequest()
		{		
			$data = array(
				'employeeid' => $_SESSION['fortuneUserID'],
				'requestid' => $this->input->post('request'),
				'requestDescription' => $this->input->post('requestDescription'),
				'daterequested' => date("Y-m-d h:i:sa")
				
			);

			return $this->db->insert('employeerequests', $data);
			
		
		}
		
						public function get_rejectedrequestDetails()
		{
				$query = $this->db->query("SELECT * FROM approvals,employeerequests,requests,approvers,employees 
													WHERE 
													employeerequests.employeeid='{$_SESSION['fortuneUserID']}'  
													AND
													employeerequests.id=approvals.requestid
													AND
													requests.id=employeerequests.requestid
													AND
                                                    approvals.status='N'
                                                    AND
                                                    approvers.employeeid=approvals.approverid
													AND
                                                    employees.id= approvers.employeeid");
				return $query->result();
			
		}
						public function get_approvedrequestDetails()
		{
				$query = $this->db->query("SELECT * FROM approvals,employeerequests,requests,approvers,employees 
													WHERE 
													employeerequests.employeeid='{$_SESSION['fortuneUserID']}'  
													AND
													employeerequests.id=approvals.requestid
													AND
													requests.id=employeerequests.requestid
													AND
                                                    approvals.status='Y'
                                                    AND
                                                    approvers.employeeid=approvals.approverid
													AND
                                                    employees.id= approvers.employeeid");
				return $query->result();
			
		}
						public function get_pendingrequestDetails()
		{
				$query = $this->db->query("SELECT *, employeerequests.id AS RID FROM employeerequests,requests 
													WHERE 
													employeerequests.employeeid='{$_SESSION['fortuneUserID']}'  
													AND
													employeerequests.requestid=requests.id
													
                                                   ");
				return $query->result();
			
		}
		

}