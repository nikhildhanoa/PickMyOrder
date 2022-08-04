<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  $valid = 'invalid';
  $this->load->helper('string');

	   $SearchKey=$_REQUEST['SearchKey'];
	    $userid=$_REQUEST['userid'];
		$Business_id=$this->db->query("select * from dev_users where id='$userid'");
		 $Business_id=$Business_id->result_array();
		 $user_role=$Business_id[0]['role'];
		 $Busines_id=$Business_id[0]['business_id'];
		
		 if( $user_role=='3')  //if role 3 then get business id from enginer table
		 {
			 $Business_id=$this->db->query("select business_id from dev_engineer where user_id='$userid'");
			 $Business_id=$Business_id->result_array();
			 $Busines_id=$Business_id[0]['business_id'];
		 }
		  if($userid=='0')   /*if atrdeya guest user ************/
		  {
			  $Busines_id='16';
		  }
		$get_bussiness_details=$this->db->query("select * from dev_business where id='$Busines_id'");
			$get_bussiness_details1=$get_bussiness_details->result_array();
			$publishkey=$get_bussiness_details1[0]['stripe_publishkey'];
	   
		   $SearchKey=$this->db->query("Select * from dev_products where product_name LIKE '$SearchKey%' && business_id='$Busines_id' && publish_status='1'|| SKU='$SearchKey' && business_id='$Busines_id' && publish_status='1'|| title LIKE '%$SearchKey%' && business_id='$Busines_id' && publish_status='1' || description LIKE '$SearchKey%' && business_id='$Busines_id' && publish_status='1' || searchcat LIKE '$SearchKey%' && business_id='$Busines_id' && publish_status='1'|| searchsubcat LIKE '$SearchKey%' && business_id='$Busines_id' && publish_status='1' || searchsupercat LIKE '$SearchKey%' && business_id='$Busines_id' && publish_status='1'");
		   $SearchKeyData=$SearchKey->result_array();
	       
	 if($SearchKey->num_rows()!=0)
		{
			
			echo json_encode(array("statusCode"=>200,"valid"=>true,'SearchData'=>$SearchKeyData,'publishkey'=>$publishkey)); 
		}
		else
		{
			echo json_encode(array("statusCode"=>401,"valid"=>false,"message"=>"no result found"),JSON_FORCE_OBJECT);
		} 
?>