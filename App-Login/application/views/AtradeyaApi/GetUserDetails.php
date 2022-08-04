<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  $valid = 'invalid';
  $this->load->helper('string');
		//$data = file_get_contents("php://input");
		$userid = $_REQUEST['userid'];
         $GetData=$this->db->query("select * from dev_users where id='$userid'");		
	     $GetArray=$GetData->result_array();
		 
		 if($GetArray)
		{
			
		     
			 echo json_encode(array("statusCode"=>200,"data"=>$GetArray));
		}
		else
		{
			 echo json_encode(array("statusCode"=>401,'Message'=>'No user Founds',"valid"=>false),JSON_FORCE_OBJECT);
		} 
			
			
?>