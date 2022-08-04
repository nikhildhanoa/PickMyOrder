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
	$this->load->Model('ProjectModel');
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
				 $eng_id= $this->input->post('enghid');
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
				$Engineer_id=implode(",",$Engineer_id_array);
				$Inser_array=array('business_id'=>$business_id,'project_name'=>$Project_Name,'customer_name'=>$Customer_Name,'address'=>$permanent_Address,'post_code'=>$Post_Code_permanent,'city'=>$City_permanent,'contact_number'=>$Contact_Number,'email_address'=>$Email_Address,'engineer_array'=>$Engineer_id,'id_array'=>$Engineer_array,'Delivery_Address'=>$Delivery_Address,'delivery_postcode'=> $Post_Code_delevery,'delivery_city'=>$Delevery_City);
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
		
	} //SESSION CHECK
			  else{
		redirect('dashboard');
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
				$this->db->query("update dev_projects SET project_name='$Project_Name',customer_name='$Customer_Name',address='$Address',post_code='$Post_Code',city='$City',contact_number='$Contact_Number',email_address='$Email_Address',engineer_array='$Engineer_id',id_array='$Engineer_array',Delivery_Address='$Delivery_Address',delivery_postcode='$Post_Code_delevery',delivery_city='$Delevery_City' where id='$proid'");
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
				  
			     $new_values=$Allpreprojects.$id.',';
				 
				 $this->db->query("update dev_engineer set enginnerproject='$new_values' where id=$namewithid");	
				 }
				 /**********close assign project to ennigners****************/
				 if($status)
				 {
					$this->load->view('header.php');
					$this->load->view('sidebar.php');
					$this->load->view('Projects.php');
					$this->load->view('footer.php');
				 }
		}else{
		 $this->load->view('header.php');
		$this->load->view('sidebar.php');
	 $this->load->view('EditProjects.php');
	 $this->load->view('footer.php');
	}
	
}
public function DeleteProject(){
	$id=$_GET['id'];
	$this->db->query("UPDATE `dev_engineer` SET  `enginnerproject` = CONCAT((TRIM(BOTH ',' FROM REPLACE(CONCAT(',', `enginnerproject`), ',$id', ''))),',') WHERE FIND_IN_SET('$id', `enginnerproject`)");
	$status=$this->ProjectModel->delete('dev_projects',$id);
	if($status)
	{
		            $this->load->view('header.php');
					$this->load->view('sidebar.php');
					$this->load->view('Projects.php');
					$this->load->view('footer.php');
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


}///

