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
	  if(isset($_REQUEST['userid'])){
	  $Business=$this->db->query("select * from dev_users where id='$GETUSER'");
	  $Business=$Business->result_array();
	  $user_role=$Business[0]['role'];
	 $fetch=$Business[0]['business_id'];
	
	  if( $user_role=='3')  //if role 3 then get business id from enginer table
		 {
		 $Business_id=$this->db->query("select business_id from dev_engineer where user_id=$GETUSER");
		 $Business_id=$Business_id->result_array();    
		 $fetch=$Business_id[0]['business_id'];
		 
		 }
		 
	  $data=$this->db->query("select *from dev_engineer inner join dev_engineer_permissions on dev_engineer.id=dev_engineer_permissions.engineer_id where dev_engineer.business_id='$fetch' && (dev_engineer_permissions.Operative='1' or dev_engineer_permissions.Supervisor=1)");

	 $fulldata= $data->result_array();
	
	 $emptyarray=array(array('name'=>'Assign Engineers','id'=>'0'));
	 foreach($fulldata as $pdf)
	 {
		 array_push($emptyarray,array('name'=>$pdf['user_name'].' ['.$pdf['engineer_id'],'id'=>$pdf['engineer_id'],'IosName'=>$pdf['user_name']));
	 }
	
	
	
		 if($emptyarray)
		{
			
			echo json_encode(array("statusCode"=>200,"valid"=>true,'Oprativedata'=>$emptyarray));
		}
		else
		{
			echo json_encode(array("statusCode"=>401,"valid"=>false),JSON_FORCE_OBJECT);
		} 
	  }else
	  {
		  echo json_encode(array("statusCode"=>401,"valid"=>false),JSON_FORCE_OBJECT);
	  }
?>