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
	    $Business_id=$this->db->query("select * from dev_users where id='$GETUSER'");
		 $Business_id=$Business_id->result_array();
		 $user_role=$Business_id[0]['role'];
		 $Busines_id=$Business_id[0]['business_id'];
		 $FetchOrder=$this->db->query("select * from dev_orders where business_id='$Busines_id' && status='1' ORDER BY id DESC");
		 
	    if( $user_role=='3')  //if role 3 then get business id from enginer table
		 {
		 $Business_id=$this->db->query("select * from dev_engineer where user_id='$GETUSER'");
		 $Business_id=$Business_id->result_array();
		 $engineer_id=$Business_id[0]['id'];
		 $Busines_id=$Business_id[0]['business_id'];
		 $FetchOrder=$this->db->query("select * from dev_orders where business_id='$Busines_id' && status='1' ORDER BY id ASC");
		 $check_oprative=$this->db->query("select * from dev_engineer_permissions where engineer_id='$engineer_id'");
		 $check_oprative=$check_oprative->result_array();
		 if($check_oprative[0]['Operative']=='1')
		 {
			 $FetchOrder=$this->db->query("select * from dev_orders where engineer_id='$GETUSER' && status='1' ORDER BY id ASC");
		 }
		 }
	 
	  
	  $FetchOrder=$FetchOrder->result_array(); 
	   
	  
	 $emptyarray=array();
	
	 foreach($FetchOrder as $Single)
	 {
		
		 array_push($emptyarray,array('po_reffrence'=>$Single['po_reffrence'],'order_id'=>$Single['po_number'],'date'=>$Single['date'],'total_ex_vat'=>$Single['total_ex_vat'],'total_inc_vat'=>$Single['total_inc_vat'],'status'=>$Single['status'],'Order_descrption'=>$Single['odrdescrp'],'projectname'=>$Single['givenprojectname'],'vanstock'=>$single['van_stock']));
	 }
	
	
	
		 if($emptyarray)
		{
			
			echo json_encode(array("statusCode"=>200,"valid"=>true,'AwatingOrderData'=>$emptyarray));
		}
		else
		{
			echo json_encode(array("statusCode"=>401,"valid"=>false),JSON_FORCE_OBJECT);
		} 
?>