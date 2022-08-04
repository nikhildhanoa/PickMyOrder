<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  $valid = 'invalid';
  $status2=0;
  $this->load->helper('string');
  if(!empty($_POST['id'])&&!empty($_POST['customer_name'])&&!empty($_POST['full_address'])&&!empty($_POST['Project_Name'])&&
  !empty($_POST['contact_no'])&&!empty($_POST['city'])&&!empty($_POST['post_code'])&&
  !empty($_POST['delivery_address'])&&!empty($_POST['delivery_city'])&&!empty($_POST['delivery_post_code'])&&
  !empty($_POST['email_address'])&&!empty($_POST['engineer_id'])&&!empty($_POST['assign_engineer']))
  {
	   $word='[';
	if(strpos($_POST['assign_engineer'], $word))
	{   
	       $Project_id=$_POST['id'];
		
		   $customer_name=$_POST['customer_name'];
		   $full_address=$_POST['full_address'];
		   $project_Name=$_POST['Project_Name'];
		   $contact_no=$_POST['contact_no'];
		   $customer_city=$_POST['city'];
		   $customer_postcode=$_POST['post_code'];
		   $delivery_address=$_POST['delivery_address'];
		   $delivery_city=$_POST['delivery_city'];
		   $delivery_postcode=$_POST['delivery_post_code'];
		   $email_address=$_POST['email_address'];
		   $engineer_id=$_POST['engineer_id'];
		   $assign_engineer=$_POST['assign_engineer'];
		  
		  $arrforenginner=array();
		  $arrforenginner2=array();
          $asseng='';
          $Project_table="dev_projects";
		   
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
			
	   $where=array('id'=> $Project_id);
			$this->ProjectModel->update($Project_table,$Inser_array,$where);
			$status=$this->db->affected_rows();
			
		/**********************insert project id*********************/
	
		for($i=0;$i<$numof;$i++)
		 {
		 $arrforenginner2=explode('[',$arrforenginner[$i]);
		 $namewithid=$arrforenginner2[1];
		
	     $preprojects=$this->db->query("select enginnerproject from dev_engineer where id='$namewithid'");
		 $preprojectscheks=$preprojects->result_array();
		    
			
			  $Allpreprojects=$preprojectscheks[0]['enginnerproject'];
			  $new_values=$Allpreprojects.$Project_id.',';
			
			  $this->db->query("update dev_engineer set enginnerproject='$new_values' where id='$namewithid'");
			  
			
		 }
		 
        
		/**********************insert project id*********************/

	if($status )
		{
		echo json_encode(array("statusCode"=>200,"valid"=>true,"projectid"=>$project_id,"Message"=>'Project Update Successfully'),JSON_FORCE_OBJECT);
		}
		else
		{
			echo json_encode(array("statusCode"=>401,"valid"=>false,"Message"=>'Please Change Somthing To Update This Project'),JSON_FORCE_OBJECT);
		}   
	}
	else
	{
		echo json_encode(array("statusCode"=>401,"Message"=>"Assign enginer Format is wrong it shuld be like 'Engineer name[Engineer Id,Engineer name[Engineer Id,...'","valid"=>false),JSON_FORCE_OBJECT);
	}
  }
  else
  {
	  echo json_encode(array("statusCode"=>401,"Message"=>"All Fields Are Required","valid"=>false),JSON_FORCE_OBJECT);
  }
   
?>