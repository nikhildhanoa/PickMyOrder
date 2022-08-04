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
	  
	  $Business=$this->db->query("select * from dev_users where id='$GETUSER'");
	  $Business=$Business->result_array();
	  $user_role=$Business[0]['role'];
	 $fetchpdfs=$Business[0]['business_id'];
	 
	  if( $user_role=='3')  //if role 3 then get business id from enginer table
		 {
		 $Business_id=$this->db->query("select business_id from dev_engineer where user_id='$GETUSER'");
		 $Business_id=$Business_id->result_array();
		 $fetchpdfs=$Business_id[0]['business_id'];
		 }
	  $pdfdata=$this->db->query("select * from cetalouges where bussinessid	='$fetchpdfs'");
	 $pdfdata= $pdfdata->result_array();
	 $emptyarray=array();
	 foreach($pdfdata as $pdf)
	 {
		 array_push($emptyarray,array('name'=>$pdf['name'],'url'=>trim($pdf['url']),'size'=>$pdf['size'],'date'=>$pdf['date']));
	 }
	
	
	
		 if($emptyarray)
		{
			
			echo json_encode(array("statusCode"=>200,"valid"=>true,'data'=>$emptyarray));
		}
		else
		{
			echo json_encode(array("statusCode"=>401,"valid"=>false),JSON_FORCE_OBJECT);
		} 
?>