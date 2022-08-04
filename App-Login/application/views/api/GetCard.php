<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  $valid = 'invalid';
  $this->load->helper('string');
		//$data = file_get_contents("php://input");
	   $GETUSER=$_REQUEST['userid'];
	  
	  $CardsObj=$this->db->query("select * from dev_PaymentMethod where user_id='$GETUSER'");
	  $Card=$CardsObj->result_array();
		if($Card)
		{
			
			echo json_encode(array("statusCode"=>200,"valid"=>true,'SaveCards'=>$Card));
		}
		else
		{
			echo json_encode(array("statusCode"=>401,"valid"=>false,'message'=>"No Cards Found"),JSON_FORCE_OBJECT);
		} 
?>