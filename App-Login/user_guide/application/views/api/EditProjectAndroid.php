<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  $valid = 'invalid';
  $this->load->helper('string');
  $data=$_REQUEST['Project'];
  $data=json_decode($data);
  $arrforenginner=array();
  $arrforenginner2=array();
  $asseng='';
  $data_array=$data->Orderdetails;
 if(isset($_REQUEST['Project']))
 {
  $Project_table="dev_projects";
          $project_id=$data_array[0]->id;
		  $customer_name=$data_array[0]->customer_name;
		  $full_address=$data_array[0]->full_address;
		  $project_Name=$data_array[0]->project_Name;
		 // $job_status=$data_array[0]->job_status;
		   $contact_no=$data_array[0]->contact_no;
		   $customer_city=$data_array[0]->city;
		   $customer_postcode=$data_array[0]->post_code;
		   $delivery_address=$data_array[0]->delivery_address;
		   $delivery_city=$data_array[0]->delivery_city;
		   $delivery_postcode=$data_array[0]->delivery_post_code;
		   $email_address=$data_array[0]->email_address;
		  $engineer_id=$data_array[0]->engineer_id;
		  $assign_engineer=$data_array[0]->assign_engineer;
		  
		 $arrforenginner=explode(',',$assign_engineer);
		 $numof=count($arrforenginner);
		
		 //Business id of engineer_id
		 $Business_id=$this->db->query("select business_id from dev_users where id='$engineer_id'");
		 $Business_id1=$Business_id->result_array();
		 $B_id=$Business_id1[0]['business_id'];
		 if($B_id=='')
		{
			$Business_id=$this->db->query("select business_id from  dev_engineer where user_id='$engineer_id'");
			$Business_id1=$Business_id->result_array();
			$B_id=$Business_id1[0]['business_id'];
		}
		
		
		   $Inser_array=array('business_id'=> $B_id,'contact_number'=>$contact_no,'Delivery_Address'=>$delivery_address,'delivery_city'=>$delivery_city,'delivery_postcode'=>$delivery_postcode,'project_name'=>$project_Name,'customer_name'=>$customer_name,'address'=>$full_address,'email_address'=>$email_address,'city'=>$customer_city,'post_code'=>$customer_postcode,'engineer_array'=>$assign_engineer);
				$where=array('id'=>$project_id);
			$this->ProjectModel->update($Project_table,$Inser_array,$where);
			$status=$this->db->affected_rows();
		/**********************insert project id*********************/
	
		for($i=0;$i<$numof;$i++)
		 {
			// $arrforenginner2=explode('[',$arrforenginner[$i]);
			 $namewithid=$arrforenginner[0];
			 $preprojects=$this->db->query("select enginnerproject from dev_engineer where id='$namewithid'");
			 $preprojectscheks=$preprojects->result_array();
			 $Allpreprojects=$preprojectscheks[0]['enginnerproject'];
			 $new_values=$Allpreprojects.$project_id.','; 
			 
			 $this->db->query("update dev_engineer set enginnerproject='$new_values' where id=$namewithid");
			  
			
		 } 
		  
        
		/**********************insert project id*********************/
	
		
	if($status)
		{
         echo json_encode(array("statusCode"=>200,"valid"=>true,"projectid"=>$project_id),JSON_FORCE_OBJECT);
		}
		else
		{
			echo json_encode(array("statusCode"=>401,'Message'=>'Please Change Somthing To Update This Project ',"valid"=>false),JSON_FORCE_OBJECT);
		}   
 }else{
	 echo json_encode(array("statusCode"=>401,'Message'=>'All Field Is required ',"valid"=>false),JSON_FORCE_OBJECT);
 }
?>