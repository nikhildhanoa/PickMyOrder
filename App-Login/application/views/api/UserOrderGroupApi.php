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
		 $qoutesstatus=$_REQUEST['qoutesstatus'];
		 if($qoutesstatus=='1')
		 {
			 $add="&& quotes_status='1'";
		 }
		 else
		 {
			 $add='';
		 }
		if(isset($_REQUEST['reorder']) && $_REQUEST['reorder']==1){
		   
		   
		   $add=$add."&& reorder='1' && reorder_complete!='1'";
	   }
		 
		 $FetchOrder=$this->db->query("select * from dev_orders where business_id='$Busines_id' $add && status='0' ORDER BY id ASC");
		
		 /*************************number of awatin******************/
		 if($Busines_id!='')
		 {
		 $Get_awating_orders = $this->db->query("select id from dev_orders where status=1&& business_id=$Busines_id");
			$numberofawating=$Get_awating_orders->num_rows();
		 }
		 /*************************close***************************/
	    if( $user_role=='3')  //if role 3 then get business id from enginer table
		 { 
		 $Business_id=$this->db->query("select * from dev_engineer where user_id='$GETUSER'");
		 $Business_id=$Business_id->result_array();
		 $engineer_id=$Business_id[0]['id'];
		 $Busines_id=$Business_id[0]['business_id'];  
		 $enginnerproject=$Business_id[0]['enginnerproject'];
         $enginnerproject=rtrim($enginnerproject,",");
         if(!empty($enginnerproject)){
            $given_project="givenprojectid in ('".$enginnerproject."') &&"; 
            }else
            {
             $given_project='';
            }
		 $FetchOrder=$this->db->query("select * from dev_orders where $given_project business_id='$Busines_id' $add && status='0'   ORDER BY id ASC");

        /****************NUMBER OF AWATING IF ENGINEER*******************/
			$Get_awating_orders = $this->db->query("select id from dev_orders where $given_project status=1&& business_id=$Busines_id");
			$numberofawating=$Get_awating_orders->num_rows();
			/*************************close**********************/


		 $check_oprative=$this->db->query("select * from dev_engineer_permissions where engineer_id='$engineer_id'");
		 $check_oprative=$check_oprative->result_array();
		 

		 if($check_oprative[0]['Operative']=='1')
		 {
			 $FetchOrder=$this->db->query("select * from dev_orders where engineer_id='$GETUSER' $add ORDER BY id ASC");
			  /****************NUMBER OF AWATING IF ENGINEER*******************/
			$Get_awating_orders = $this->db->query("select id from dev_orders where status=1&& business_id=$Busines_id&&engineer_id=$GETUSER");
			$numberofawating=$Get_awating_orders->num_rows();
			/*************************close**********************/
		 }
		 }
	 
	  
	  $FetchOrder=$FetchOrder->result_array(); 
	   
	  
	 $emptyarray=array();
	
	 foreach($FetchOrder as $Single)
	 {
	
		  // increment in po number
		 array_push($emptyarray,array('po_reffrence'=>$Single['id'],'order_id'=>$Single['po_number'],'date'=>$Single['date'],'total_ex_vat'=>$Single['total_ex_vat'],'total_inc_vat'=>$Single['total_inc_vat'],'status'=>$Single['status'],'Order_descrption'=>$Single['odrdescrp'],'Project'=>$Single['givenprojectname'],'OrderStatus'=>$Single['status'],'vanstock'=>$Single['van_stock'],'reorder'=>$Single['reorder']));
	 }
	
	
	
		 if($emptyarray)
		{
			
			echo json_encode(array("statusCode"=>200,"valid"=>true,'OrderData'=>$emptyarray,'Number_of_awting'=>$numberofawating));
		}
		else
		{
			echo json_encode(array("statusCode"=>401,"valid"=>false),JSON_FORCE_OBJECT);
		} 
?>