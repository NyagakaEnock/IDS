<?php
class Profile_model extends CI_Model {

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


}