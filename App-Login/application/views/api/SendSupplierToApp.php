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
	  $Fetch=$this->db->query("select  business_id from  dev_users where id='$GETUSER'");
	  $Fetch=$Fetch->result_array();
	  $business_id=$Fetch[0]['business_id'];
	   if($business_id=='')
		{
	  $Fetch=$this->db->query("select  business_id	 from  dev_engineer where user_id='$GETUSER'");
	  $Fetch=$Fetch->result_array();
	  $business_id=$Fetch[0]['business_id'];
		}
	         
	 $FetchSupplier=$this->db->query("select *from  dev_supplier where business_id='$business_id'");
	  $FetchSupplier=$FetchSupplier->result_array();
	  
	 $emptyarray=array();
	  array_push($emptyarray,array('suppliers_name'=>'Select supplier'));
	 foreach($FetchSupplier as $Single)
	 {
		 array_push($emptyarray,array('id'=>$Single['id'],'business_id'=>$Single['business_id'],'suppliers_name'=>$Single['suppliers_name'],'contact_name'=>$Single['contact_name'],'suppliers_city'=>$Single['suppliers_city'],'contact_number'=>$Single['contact_number'],'	email'=>$Single['email'],'website'=>$Single['website'],'order_email_address'=>$Single['order_email_address']));
	 }
	
	
	
		 if($emptyarray)
		{
			
			echo json_encode(array("statusCode"=>200,"valid"=>true,'SupplierData'=>$emptyarray));
		}
		else
		{
			echo json_encode(array("statusCode"=>401,"valid"=>false),JSON_FORCE_OBJECT);
		} 
?>