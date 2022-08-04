<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	if(isset($_REQUEST['id']))
	{
	$id=$_REQUEST['id'];
	$data=$this->db->query("select * from dev_projects where id='$id'");
	$isexsist=$data->result_array();
	if($isexsist)
	{
	$this->db->query("UPDATE `dev_engineer` SET  `enginnerproject` = CONCAT((TRIM(BOTH ',' FROM REPLACE(CONCAT(',', `enginnerproject`), ',$id', ''))),',') WHERE FIND_IN_SET('$id', `enginnerproject`)");
	$status=$this->db->query("delete from dev_projects where id='$id'");
	
	
	if($status)
		{
		
		echo json_encode(array("statusCode"=>200,"valid"=>true,'message'=>'Project Remove Successfully'),JSON_FORCE_OBJECT);
		}
		else
		{
			echo json_encode(array("statusCode"=>401,'Message'=>'Error From Server',"valid"=>false),JSON_FORCE_OBJECT);
		} 
	}
   else
   {
	   echo json_encode(array("statusCode"=>401,'Message'=>'Project Not Exist',"valid"=>false),JSON_FORCE_OBJECT);
   }	   
	}else{
		echo json_encode(array("statusCode"=>401,'Message'=>'Send A Project Id',"valid"=>false),JSON_FORCE_OBJECT);
	}
	
	?>