<?php error_reporting(0); 
defined('BASEPATH') OR exit('No direct script access allowed');

class ProjectController extends CI_Controller {

	
	public function __construct()
	{
	parent::__construct();
	$this->load->database();
	$this->load->Model('DataModel');
	$this->load->Model('EngineerModel');
    $this->load->Model('SupplierModel');
	 $this->load->Model('CommonModel');
	$this->load->Model('ProjectModel');
	}
	
	public function BusinessIdFunction()
	{
		if(isset($_SESSION['Current_Business']))
			   {
				   $bid=$_SESSION['Current_Business'];
			   }
			  else
			  { 
				   $bid=$_SESSION['status']['business_id'];
			  }
			  return $bid;
	}
	
	
    public function AddProjects()
	{
		 if(isset($_SESSION['status'])){
	    $this->load->view('header.php');
		$this->load->view('sidebar.php');
		$this->load->view('Projects.php');
		$this->load->view('footer.php'); 
		 if($this->input->post('Insert_Project'))
		 {
			
			 
			 
			 $Engineer_table='dev_projects';
			
			 if(isset($_SESSION['Current_Business']))
				{
					$business_id=$_SESSION['Current_Business'];
				}
				else
				{
					 $business_id=$_SESSION['status']['business_id'];
				}

			     $Project_Name= $this->input->post('Project_Name');
				 $Customer_Name= $this->input->post('Customer_Name');
				 $permanent_Address= $this->input->post('permanent_Address');
				 $Post_Code_permanent= $this->input->post('Post_Code_permanent');
				 $City_permanent= $this->input->post('City_permanent');
				 $billingAddress= $this->input->post('billingAddress');
				 $Post_Code_billing= $this->input->post('Post_Code_billing');
				 $City_billing= $this->input->post('City_billing');
				 $Delivery_Address= $this->input->post('Delivery_Address');
				 $Post_Code_delevery= $this->input->post('Post_Code_delevery');
				 $Delevery_City= $this->input->post('Delevery_City');
				 $Contact_Number=$this->input->post('Contact_Number');
				 $Email_Address= $this->input->post('Email_Address');
				 $invioce_Order_Number= $this->input->post('invioce_Order_Number');
				 $eng_id= $this->input->post('enghid');
				
				 
				 /* 
				  (this is old code written by rohit sir)
				 
				 $Engineer_array=array();
			    for($i=0;$i<=$eng_id;$i++)
				{
				
				 if($this->input->post('engineer'.$i))
				 {
					 $id=$this->input->post('engineer'.$i);
					 $engData=$this->db->query("select * from dev_engineer where id='$id'");
					 $engin=$engData->result_array();
					$Engineer_array_with_name[$i]=$engin[0]['user_name'].' ['.$engin[0]['id'];
					$Engineer_id_array[$i]=$engin[0]['id'];
					$Engineer_array[$i]= $this->input->post('engineer'.$i);
				 }
				}
				$Engineer_array=implode(",",$Engineer_array);
				$Engineer_array_name=implode(",",$Engineer_array_with_name);
				$Engineer_id=implode(",",$Engineer_id_array); */

				 $Operativearray= $this->input->post('Operativearray');
				 $supervisorarray= $this->input->post('supervisorarray');
				 if(!empty($Operativearray) && !empty($supervisorarray))
				 {
                      $Engineer_array=array_merge($Operativearray,$supervisorarray);				 
			     }elseif(!empty($supervisorarray)) 
                 {
					 $Engineer_array=$supervisorarray;
				 }else
                 {
					  $Engineer_array=$Operativearray;
				 }	
				 
				 if(!empty($Engineer_array)){
				 $Engineer_array=array_unique($Engineer_array); 
				 $Engineer_array=implode(",",$Engineer_array);
				 }
				 else
				 {
				$this->session->set_flashdata('err', '**Select one supervisor or  operative');
					redirect('AddNewProjects'); 
				 }
				$Inser_array=array('business_id'=>$business_id,'project_name'=>$Project_Name,'customer_name'=>$Customer_Name,'address'=>$permanent_Address,'post_code'=>$Post_Code_permanent,'city'=>$City_permanent,'contact_number'=>$Contact_Number,'email_address'=>$Email_Address,'engineer_array'=>$Engineer_array,'id_array'=>$Engineer_array,'Delivery_Address'=>$Delivery_Address,'delivery_postcode'=> $Post_Code_delevery,'delivery_city'=>$Delevery_City,'invioce_Order_Number'=>$invioce_Order_Number);
			     $status=$this->ProjectModel->insert($Engineer_table,$Inser_array);
				 $project_id=$this->db->insert_id(); 
				 
				 /***********assign project to ennigners*************/
				 $arrforenginner=explode(',',$Engineer_array);
				 $numof=count($arrforenginner);
				
				 
				 for($i=0;$i<=$numof-1;$i++)
				 {
				 $namewithid=$arrforenginner[$i];
				 if($namewithid=='')
				 {
					$namewithid=0; 
				 }
				 $preprojects=$this->db->query("select enginnerproject from dev_engineer where id='$namewithid'");
				 $preprojectscheks=$preprojects->result_array();
				 $Allpreprojects=$preprojectscheks[0]['enginnerproject'];
			     $new_values=$Allpreprojects.$project_id.',';
				 
				 $this->db->query("update dev_engineer set enginnerproject='$new_values' where id=$namewithid");	
				 }
				 /**********close assign project to ennigners****************/
				 
				 if($status)
				 {
					redirect('projects');
				 }
		 }
		
	} 
		 
	}
	
	public function EditProjects(){
		if($this->input->post('Edit_Project'))
		{ 
			$proid=$this->input->post('hid');
			 $Engineer_table='dev_projects';
			     $Project_Name= $this->input->post('Project_Name');
				 $Customer_Name= $this->input->post('Customer_Name');
				 $Address= $this->input->post('Address');
				 $Post_Code= $this->input->post('Post_Code');
				 $City= $this->input->post('City');
				 $Delivery_Address= $this->input->post('Delivery_Address');
				 $Post_Code_delevery= $this->input->post('Post_Code_delevery');
				 $Delevery_City= $this->input->post('Delevery_City');
				 $Contact_Number=$this->input->post('Contact_Number');
				 $Email_Address= $this->input->post('Email_Address');
				 $eng_id= $this->input->post('enghid');
				 $AddEngineerArray= $this->input->post('AddEngineerArray');
				 $supervisorarray= $this->input->post('supervisorarray');
				 $Operativearray= $this->input->post('Operativearray');
				 $invioce_Order_Number= $this->input->post('invioce_Order_Number');
				 
				  if(!empty($Operativearray) && !empty($supervisorarray))
				 {
                      $Engineer_array1=array_merge($Operativearray,$supervisorarray);	
					  
			     }elseif(!empty($supervisorarray)) 
                 {
					 $Engineer_array1=$supervisorarray;
				 }else
                 {
					  $Engineer_array1=$Operativearray;
				 }	
				 
				 if(!empty($AddEngineerArray) && !empty($Engineer_array1))
				 {
					$Engineer_array=array_merge($Engineer_array1,$AddEngineerArray);  
				 }elseif(!empty($AddEngineerArray))
				 {
					 $Engineer_array=$AddEngineerArray;
				 }
				 else
				 {
					 $Engineer_array=$Engineer_array1;
				 } 
				 
				 if(!empty($Engineer_array))
				 {
				$Engineer_array=array_unique($Engineer_array); 
				 $Engineer_array=implode(",",$Engineer_array);
				 }else{
					 
				$this->session->set_flashdata('err', '**Select one supervisor or  operative');
					redirect('editprojects?id='.$proid);  
				 } 
				 
				 
				 /* 
				  (this is old code written by rohit sir)
				 
				 $Engineer_array=array();
			    for($i=0;$i<=$eng_id;$i++)
				{
				
				 if($this->input->post('engineer'.$i))
				 {
					  $id=$this->input->post('engineer'.$i);
					 $engData=$this->db->query("select * from dev_engineer where id='$id'");
					 $engin=$engData->result_array();
					$Engineer_array_with_name[$i]=$engin[0]['user_name'].' ['.$engin[0]['id'];
					$Engineer_id_array[$i]=$engin[0]['id'];
					$Engineer_array[$i]= $this->input->post('engineer'.$i);
				 }
				}
				$Engineer_array=implode(",",$Engineer_array);
				$Engineer_array_n=implode(",",$Engineer_array_with_name);
				$Engineer_id=implode(",",$Engineer_id_array);
				*/
				
				$this->db->query("update dev_projects SET project_name='$Project_Name',customer_name='$Customer_Name',address='$Address',post_code='$Post_Code',city='$City',contact_number='$Contact_Number',email_address='$Email_Address',engineer_array='$Engineer_array',id_array='$Engineer_array',Delivery_Address='$Delivery_Address',delivery_postcode='$Post_Code_delevery',delivery_city='$Delevery_City',invioce_Order_Number='$invioce_Order_Number' where id='$proid'");
				//$Where=array('id'=>$id);
			     $status=$this->db->affected_rows();
				 /***********assign project to ennigners*************/
				 $arrforenginner=explode(',',$Engineer_array);
				 $numof=count($arrforenginner);
				
				 
				 for($i=0;$i<=$numof-1;$i++)
				 {
				 $namewithid=$arrforenginner[$i];
				 if($namewithid=='')
				 {
					$namewithid=0; 
				 }
				 $preprojects=$this->db->query("select enginnerproject from dev_engineer where id='$namewithid'");
				 $preprojectscheks=$preprojects->result_array();
				 $Allpreprojects=$preprojectscheks[0]['enginnerproject'];
				  
			     $new_values=$Allpreprojects.$proid.',';
				 
				 $this->db->query("update dev_engineer set enginnerproject='$new_values' where id=$namewithid");	
				 }
				 /**********close assign project to ennigners****************/
				
					 redirect('projects');
				
		}else{ 
		
		    $business_id=$this->BusinessIdFunction();
			 $select='dev_engineer.id,dev_engineer.name';
	         $TableName='dev_engineer';
	         $Supervisor_multiClause=array('dev_engineer.business_id'=>$business_id,'dev_engineer_permissions.Supervisor'=>1);
			 $opprative_multiClause=array('dev_engineer.business_id'=>$business_id,'dev_engineer_permissions.Operative'=>1);
			 $join_table='dev_engineer_permissions';
			 $join_relation='dev_engineer_permissions.engineer_id=dev_engineer.id';
	         $result_as_array=true;
			 
			 
$All_Supervisor= $this->CommonModel->Fetchjoindata($select,$TableName,$Supervisor_multiClause,$result_as_array,$join_table,$join_relation);
$All_opprative= $this->CommonModel->Fetchjoindata($select,$TableName,$opprative_multiClause,$result_as_array,$join_table,$join_relation);

			$engineer_Send_in_view['supervisor_key']=$All_Supervisor;
			$engineer_Send_in_view['Operative_key']=$All_opprative;
		
		
		
		 $this->load->view('header.php');
		$this->load->view('sidebar.php');
	    $this->load->view('EditProjects.php',$engineer_Send_in_view);
	    $this->load->view('footer.php');
	}
	
}
public function DeleteProject(){
	$id=$_GET['id'];
	$this->db->query("UPDATE `dev_engineer` SET  `enginnerproject` = CONCAT((TRIM(BOTH ',' FROM REPLACE(CONCAT(',', `enginnerproject`), ',$id', ''))),',') WHERE FIND_IN_SET('$id', `enginnerproject`)");
	$status=$this->ProjectModel->delete('dev_projects',$id);
	if($status)
	{
		          redirect('projects');
	}
}
public function SendProjectToAppApi()
{
	$this->load->view('api/SendProjectToAppApi.php');
}
public function GetProjectsApp()
{
	$this->load->view('api/GetProjectsApp.php');
}
public function GetProjectFromAppApi()
{
	$this->load->view('api/GetProjectByApp.php');
}
public function CaddProjectFromApp()
{
	$this->load->view('api/AddProjectFromApp.php');
}
public function GetProjectFromIos()
{
	$this->load->view('api/GetProjectByIosApp.php');
}
public function EditProjectFromApp()
{
	$this->load->view('api/EditProjectFromApp.php'); 
} 

public function EditProjectAndroid()
{
	$this->load->view('api/EditProjectAndroid.php'); 
} 
public function  DeleteProjectFromApp()
{
	$this->load->view('api/DeleteProjectFromApp.php');     
}

public function  EditProjectFromIosApp()
{
	$this->load->view('api/EditProjectFromIosApp.php');      

}

public function GetWebBook()
{
	$this->load->view('api/GetWebBook.php');      

}

public function create_oauth_token()
{
	$this->load->view('api/create_oauth_token.php');      

}

public function post_webhook_subscriptions()
{
	$this->load->view('api/post_webhook_subscriptions.php');      

}

public function get_webhook_subscriptions()
{
	$this->load->view('api/get_webhook_subscriptions.php');      

}

public function delete_webhook_subscriptions()
{
	$this->load->view('api/delete_webhook_subscriptions.php');      

}

public function StaffAllocation()
{
	$this->load->view('api/StaffAllocation.php');      

}

public function StaffAllocation1()
{
	$this->load->view('api/StaffAllocation1.php');      

}



}