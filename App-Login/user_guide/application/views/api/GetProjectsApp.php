<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  $valid = 'invalid';
  $this->load->helper('string');
		
	  $GETUSER=$_REQUEST['userid'];
	  $enginnerproject='0';
	  $whatstatus='';
	  /**************************GET BUSSINESS OF USER  *************************/
	  
	  $Fetch=$this->db->query("select  * from  dev_users where id='$GETUSER'");
	  $Fetch=$Fetch->result_array();
	  $business_id=$Fetch[0]['business_id'];
	  $role=$Fetch[0]['role'];
	 
	 /**************************GET BUSSINESS ID IF USER ENGINER *************************/
	  if($role=='3')
	  {
	  $Fetch=$this->db->query("select * from  dev_engineer where user_id='$GETUSER'");
	  $Fetch=$Fetch->result_array();
	  $business_id=$Fetch[0]['business_id'];
	  $enginnerproject=$Fetch[0]['enginnerproject'];
	 
	  if($enginnerproject && $enginnerproject!=',')
	  {
	  $enginnerproject=trim($enginnerproject,',');
	  
	  }
	  else
	  {
		  $enginnerproject='0';
	  }
	  $enginnerid=$Fetch[0]['id'];
	  $checkOprative=$this->db->query("select * from dev_engineer_permissions where engineer_id='$enginnerid'");
	  $isoprative=$checkOprative->result_array();
	  $whatstatus=$isoprative[0]['Operative'];
	  
	  }
	 
	  /************GET PROJECTS IN CASE ADMIN,SUPERADMIN,SUPERVISIOR*********/
     $FetchProject=$this->db->query("select *from  dev_projects where business_id='$business_id'");
	 
	 if($whatstatus=='1')
	 {
		$FetchProject=$this->db->query("select *from  dev_projects where id in ( $enginnerproject)"); 
			
	 }
	 
	 
	 
	 $FetchProject=$FetchProject->result_array();
	

	 $emptyarray=array();
	 $Engineer_name=array();
     array_push($emptyarray,array('project_name'=>'Default Delivery Address ','id'=>'0'));
	 foreach($FetchProject as $Single)
	 {
		
		 $numof=count($Single['engineer_array']);
		
		 $id_array = explode(",",$Single['engineer_array']);  
		
		 for($i=0;$i<count($id_array);$i++)
				{
					
					 $id=$id_array[$i];
					 $nameData=$this->db->query("select * from dev_engineer where id='$id'");
					 $engin=$nameData->result_array();
					$Engineer_name[$i]=$engin[0]['user_name'];
					
				 
				}
				$ename=implode(",",$Engineer_name);	
		 $fulldeladd=$Single['Delivery_Address'].','.$Single['delivery_city'].','.$Single['delivery_postcode'];
		  $fullCustomeradd=$Single['address'].','.$Single['city'].','.$Single['post_code'];
		 array_push($emptyarray,array('id'=>$Single['id'],'customer'=>$Single['customer_name'],'business_id'=>$Single['business_id'],'project_name'=>$Single['project_name'],'address'=>$fullCustomeradd,'Delivery_Address'=>$fulldeladd,'contact_number'=>$Single['contact_number'],'email_address'=>$Single['email_address'],'job_status'=>$Single['job_status'],'AllotedEngineers'=>$ename));
	 }
		 if($emptyarray)
		{
			
			echo json_encode(array("statusCode"=>200,"valid"=>true,'ProjectData'=>$emptyarray));
		}
		else
		{
			echo json_encode(array("statusCode"=>401,"valid"=>false),JSON_FORCE_OBJECT);
		}  
?>