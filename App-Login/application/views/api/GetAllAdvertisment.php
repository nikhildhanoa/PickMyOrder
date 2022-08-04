<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$valid = 'invalid';
$this->load->helper('string');
$status = $_REQUEST['status'];
		
	$Advertisment=$this->db->query("select source,url,Type,publish_status from dev_Advertisment where status='$status' and publish_status='1'");
    $Advertisment=$Advertisment->result_array();
	
	$Manage_carousel=$this->db->query("select carousel_status,carousel_time from dev_Manage_carousel  where status='$status'");
	$Manage_carousel=$Manage_carousel->result_array();
	
	$carousel_status=$Manage_carousel[0]['carousel_status'];
	$carousel_time=$Manage_carousel[0]['carousel_time'];
	
	
	
  
	       if($Advertisment)
		   {
           echo json_encode(array("statusCode"=>200,'premissioncarousel'=>$carousel_status,'Carouseltime'=>$carousel_time,'BannersArray'=>$Advertisment));
		   }
	       else
		   {
			echo json_encode(array("statusCode"=>401,"valid"=>false),JSON_FORCE_OBJECT);
		   }    
?>