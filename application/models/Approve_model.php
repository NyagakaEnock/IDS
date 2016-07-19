<?php
class Approve_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
		
				public function get_requestDetails()
		{
						$this->db->select('*,employeerequests.id AS RID');
						$this->db->from('employeerequests');
						$this->db->join('employees', 'employees.id = employeerequests.employeeid');
						$this->db->join('requests', 'requests.id = employeerequests.requestid');
						 
						$query = $this->db->get();

						$query->result_array();

						return $query->result();
		}
				public function saveApproval($x,$y,$z)
		{		
			$data = array(
				'requestid' => $x,
				'reason' => $y,
				'approverid' => $_SESSION['fortuneUserID'],
				'status' => $z,
				'dateapproved' => date("Y-m-d h:i:sa")
				
			);

			return $this->db->insert('approvals', $data);
			
		
		}

			public function get_approvedRequests()
		{
						$query = $this->db->get('approvals');
						$query->result_array();
						return $query->result();		
		}
			public function checkapprovedRequests($x,$y)
		 {
		 $state = FALSE;
			$arr = $this->get_approvedRequests();
		 foreach($arr as $row){
		 if(($x == $row->requestid)&&($y == $row->approverid)&&($row->approverid!='')){
		 $state = TRUE;
		 }
		 }
		 return  $state;
		 }
}