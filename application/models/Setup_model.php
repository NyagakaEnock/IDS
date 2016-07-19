<?php
class Setup_model extends CI_Model {

				public function __construct()
        {
                $this->load->database();
        }
		
				public function get_companyDetails()
		{
		
				
						
		}
		 
		 		 public function login()
		 {	
		
			$username = $this->input->post('user');	
			$password = $this->GetFullDecryption($this->input->post('pass'));
			$password =$this->security->xss_clean($password );			
			$username =$this->security->xss_clean($username );			 
			$query = $this->db->query("SELECT * FROM AdminUserRegister WHERE UserName = '{$username}'  AND Password = '{$password}' AND Penabled<>'N'");			
			$state="";
			if($query->num_rows()==1){
			$state ="YES";
			}else{
			$state ="NO";
			}
			return $state;
			
		 }
		 
		 public function cleanData($input)
		 {
		 $cleanData = strip_tags(str_replace(array("'","<script>","</script>"),array("`","<!--","-->"),$input));
		 return $cleanData;
		 }
		 public function getLoggedUser()
		 {
			$username = $this->input->post('user');	
			$password = $this->GetFullDecryption($this->input->post('pass'));
			$password =$this->security->xss_clean($password );			
			$username =$this->security->xss_clean($username );
			$password = $this->GetFullDecryption($this->input->post('pass'));
			$query = $this->db->query("SELECT * FROM AdminUserRegister WHERE UserName = '{$username}'  AND Password = '{$password}' AND Penabled<>'N'");
			return $query->result();		
		 }

		

		public function GetFullDecryption($input)
           {

              $charARR = str_split($input);
               for ($i = 0; $i < count($charARR); $i++)
               {
                  
                   if ($charARR[$i] == '!'){
                       $char[] = 'a';
                   }elseif ($charARR[$i] == '@'){
                       $char[] = 'b';
                   }elseif ($charARR[$i] == '#'){
                       $char[] = 'c';
                   }elseif ($charARR[$i] == '$'){
                       $char[] = 'd';
                   }elseif ($charARR[$i] == '%'){
                       $char[] = 'e';
                   }elseif ($charARR[$i] == '^'){
                       $char[] = 'f';
                   }elseif ($charARR[$i] == '&'){
                       $char[] = 'g';
                   }elseif ($charARR[$i] == '*'){
                       $char[] = 'h';
                   }elseif ($charARR[$i] == '('){
                       $char[] = 'i';
                   }elseif ($charARR[$i] == ')'){
                       $char[] = 'j';
                   }elseif ($charARR[$i] == '-'){
                       $char[] = 'k';
                   }elseif ($charARR[$i] == '_'){
                       $char[] = 'l';
                   }elseif ($charARR[$i] == '='){
                       $char[] = 'm';
                   }elseif ($charARR[$i] == '+'){
                       $char[] = 'n';
                   }elseif ($charARR[$i] == '\\'){
                       $char[] = 'o';
                   }elseif ($charARR[$i] == '|'){
                       $char[] = 'p';
                   }elseif ($charARR[$i] == '/'){
                       $char[] = 'q';
                   }elseif ($charARR[$i] == '>'){
                       $char[] = 'r';
                   }elseif ($charARR[$i] == '<'){
                       $char[] = 's';
                   }elseif ($charARR[$i] == '?'){
                       $char[] = 't';
                   }elseif ($charARR[$i] == '['){
                       $char[] = 'u';
                   }elseif ($charARR[$i] == ']'){
                       $char[] = 'v';
                   }elseif ($charARR[$i] == '~'){
                       $char[] = 'w';
                   }elseif ($charARR[$i] == '{'){
                       $char[] = 'x';
                  }elseif ($charARR[$i] == '}'){
                       $char[] = 'y';
                   }elseif ($charARR[$i] == 'Z'){
                       $char[] = '0';
                   }elseif ($charARR[$i] == '0'){
                       $char[] = 'Z';
                   }elseif ($charARR[$i] == '1'){
                       $char[] = 'Y';
                   }elseif ($charARR[$i] == '2'){
                       $char[] = 'X';
                   }elseif ($charARR[$i] == '3'){
                       $char[] = 'W';
                   }elseif ($charARR[$i] == '4'){
                       $char[] = 'V';
                   }elseif ($charARR[$i] == '5'){
                       $char[] = 'U';
                   }elseif ($charARR[$i] == '6'){
                       $char[] = 'T';
                   }elseif ($charARR[$i] == '7'){
                       $char[] = 'S';
                   }elseif ($charARR[$i] == '8'){
                       $char[] = 'R';
                   }elseif ($charARR[$i] == '9'){
                       $char[] = 'Q';
                   }elseif ($charARR[$i] == 'A'){
                       $char[] = 'q';
                   }elseif ($charARR[$i] == 'B'){
                       $char[] = 'w';
                   }elseif ($charARR[$i] == 'C'){
                       $char[] = 'e';
                   }elseif ($charARR[$i] == 'D'){
                       $char[] = 'r';
                   }elseif ($charARR[$i] == 'E'){
                       $char[] = 't';
                   }elseif ($charARR[$i] == 'F'){
                       $char[] = 'y';
                   }elseif ($charARR[$i] == 'G'){
                       $char[] = 'u';
                   }elseif ($charARR[$i] == 'H'){
                       $char[] = 'i';
                   }elseif ($charARR[$i] == 'I'){
                       $char[] = 'o';
                   }elseif ($charARR[$i] == 'J'){
                       $char[] = 'p';
                   }elseif ($charARR[$i] == 'K'){
                       $char[] = 'a';
                   }elseif ($charARR[$i] == 'L'){
                       $char[] = 's';
                   }elseif ($charARR[$i] == 'M'){
                       $char[] = 'd';
                   }elseif ($charARR[$i] == 'N'){
                       $char[] = 'f';
                   }elseif ($charARR[$i] == 'O'){
                       $char[] = 'g';
                   }elseif ($charARR[$i] == 'P'){
                       $char[] = 'h';
                   }elseif ($charARR[$i] == 'Q'){
                       $char[] = 'j';
                   }elseif ($charARR[$i] == 'R'){
                       $char[] = 'k';
                   }elseif ($charARR[$i] == 'S'){
                       $char[] = 'l';
                   }elseif ($charARR[$i] == 'T'){
                       $char[] = 'z';
                   }elseif ($charARR[$i] == 'U'){
                       $char[] = 'x';
                   }elseif ($charARR[$i] == 'V'){
                       $char[] = 'c';
                   }elseif ($charARR[$i] == 'W'){
                       $char[] = 'v';
                   }elseif ($charARR[$i] == 'X'){
                       $char[] = 'b';
                   }elseif ($charARR[$i] == 'Y'){
                       $char[] = 'n';
                   }elseif ($charARR[$i] == 'Z'){
                       $char[] = 'm';
                   }elseif ($charARR[$i] == '~'){
                       $char[] = 'P';
                   }elseif ($charARR[$i] == '`'){
                       $char[] = 'O';
                   }elseif ($charARR[$i] == '!'){
                       $char[] = 'N';
                   }elseif ($charARR[$i] == '@'){
                       $char[] = 'M';
                   }elseif ($charARR[$i] == '#'){
                       $char[] = 'L';
                   }elseif ($charARR[$i] == '$'){
                       $char[] = 'K';
                   }elseif ($charARR[$i] == '%'){
                       $char[] = 'J';
                   }elseif ($charARR[$i] == '^'){
                       $char[] = 'I';
                   }elseif ($charARR[$i] == '&'){
                       $char[] = 'H';
                   }elseif ($charARR[$i] == '*'){
                       $char[] = 'G';
                   }elseif ($charARR[$i] == '('){
                       $char[] = 'F';
                   }elseif ($charARR[$i] == ')'){
                       $char[] = 'E';
                   }elseif ($charARR[$i] == '-'){
                       $char[] = 'D';
                   }elseif ($charARR[$i] == '_'){
                       $char[] = 'C';
                   }elseif ($charARR[$i] == '+'){
                       $char[] = 'B';
                   }elseif ($charARR[$i] == '='){
                       $char[] = 'A';
                   }elseif ($charARR[$i] == '{'){
                       $char[] = '0';
                   }elseif ($charARR[$i] == '['){
                       $char[] = '1';
                   }elseif ($charARR[$i] == '}'){
                       $char[] = '2';
                   }elseif ($charARR[$i] == ']'){
                       $char[] = '3';
                   }elseif ($charARR[$i] == '|'){
                       $char[] = '4';
                   }elseif ($charARR[$i] == '\\'){
                       $char[] = '5';
                   }elseif ($charARR[$i] == ':'){
                       $char[] = '6';
                   }elseif ($charARR[$i] == ';'){
                       $char[] = '7';
                   }elseif ($charARR[$i] == '"'){
                       $char[] = '8';
                   }elseif ($charARR[$i] == '\''){
                       $char[] = '9';
                   }elseif ($charARR[$i] == '<'){
                       $char[] = ':';
                   }elseif ($charARR[$i] == ','){
                       $char[] = ';';
                   }elseif ($charARR[$i] == '>'){
                       $char[] = '"';
                   }elseif ($charARR[$i] == '.'){
                       $char[] = '`';
                   }elseif ($charARR[$i] == '?'){
                       $char[] = '.';
                   }elseif ($charARR[$i] == '/'){
                       $char[] = '\'';
					}elseif ($charARR[$i] == 'a'){
                       $char[] = '!';
                   }elseif ($charARR[$i] == 'b'){
                       $char[] = '@';
                   }elseif ($charARR[$i] == 'c'){
                       $char[] = '#';
                   }elseif ($charARR[$i] == 'd'){
                       $char[] = '$';
                   }elseif ($charARR[$i] == 'e'){
                       $char[] = '%';
                   }elseif ($charARR[$i] == 'f'){
                       $char[] = '^';
                   }elseif ($charARR[$i] == 'g'){
                       $char[] = '&';
                   }elseif ($charARR[$i] == 'h'){
                       $char[] = '*';
                   }elseif ($charARR[$i] == 'i'){
                       $char[] = '(';
                   }elseif ($charARR[$i] == 'j'){
                       $char[] = ')';
                   }elseif ($charARR[$i] == 'k'){
                       $char[] = '-';
                   }elseif ($charARR[$i] == 'l'){
                       $char[] = '_';
                   }elseif ($charARR[$i] == 'm'){
                       $char[] = '=';
                   }elseif ($charARR[$i] == 'n'){
                       $char[] = '+';
                   }elseif ($charARR[$i] == 'o'){
                       $char[] = '\\';
                   }elseif ($charARR[$i] == 'p'){
                       $char[] = '|';
                   }elseif ($charARR[$i] == 'q'){
                       $char[] = '/';
                   }elseif ($charARR[$i] == 'r'){
                       $char[] = '>';
                   }elseif ($charARR[$i] == 's'){
                       $char[] = '<';
                   }elseif ($charARR[$i] == 't'){
                       $char[] = '?';
                   }elseif ($charARR[$i] == 'u'){
                       $char[] = '[';
                   }elseif ($charARR[$i] == 'v'){
                       $char[] = ']';
                   }elseif ($charARR[$i] == 'w'){
                       $char[] = '~';
                   }elseif ($charARR[$i] == 'x'){
                       $char[] = '{';
                  }elseif ($charARR[$i] == 'y'){
                       $char[] = '}';
                   }elseif ($charARR[$i] == 'z'){
                       $char[] = 'T';
                   }
              
           }
			$json_encode = json_encode($char);
		    $json_encode = str_replace("[","",$json_encode);
			$json_encode = str_replace("]","",$json_encode);
			$json_encode = str_replace("\"","",$json_encode);
			$json_encode = str_replace(",","",$json_encode);
			return $json_encode;


}
}