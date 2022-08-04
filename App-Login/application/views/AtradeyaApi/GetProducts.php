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
         $GetData=$this->db->query("select business_id from dev_users where id='$userid'");		
	     $GetArray=$GetData->result_array();
		 $business_id=$GetArray[0]['business_id'];
		 if($business_id)
		{
			
		     $GetProducts=$this->db->query("select * from dev_products where business_id='$business_id'");		
			 $GetProductArray=$GetProducts->result_array();	
			
			if($GetProductArray)
			 {
				 echo json_encode(array("statusCode"=>200,"data"=>$GetProductArray));
			 }
			 else
			 {
				 echo json_encode(array("statusCode"=>401,'Message'=>'No Product Founds',"valid"=>false),JSON_FORCE_OBJECT);
			 } 
			
		}
		else
		{
			echo json_encode(array("statusCode"=>401,'Message'=>'No User Found',"valid"=>false),JSON_FORCE_OBJECT);
		} 
?>