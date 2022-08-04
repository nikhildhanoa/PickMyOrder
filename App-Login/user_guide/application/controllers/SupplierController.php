<?php error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class SupplierController extends CI_Controller {

	public function __construct()
	{
	parent::__construct();
	$this->load->database();
	$this->load->Model('DataModel');
	$this->load->Model('EngineerModel');
	$this->load->Model('SupplierModel');
    }
   public function Supplier()
   {
	        
			  if(isset($_SESSION['status'])){
			if($this->input->post('Insert_suppliers'))
			{
				/*********Supplier Details***************/
				 if(isset($_SESSION['Current_Business'])){
					 $business_id=$_SESSION['Current_Business'];
				 }
				 else
				 {
					 $business_id=$_SESSION['status']['business_id'];
				 }
				
				$Suppliers_Name= $this->input->post('Suppliers_Name');
				$Contact_Name= $this->input->post('Contact_Name');
				$City= $this->input->post('City');
				$Address= $this->input->post('Address');
				$Post_Code= $this->input->post('Post_Code');
			    $Contact_Number= $this->input->post('Contact_Number');
			    $Email= $this->input->post('Email');
		        $Website= $this->input->post('Website');
				$Order_Email_Address=$this->input->post('Order_Email_Address');
				/*******************Supplier Account details ***********/
				$Ac_Contact_Name= $this->input->post('Ac_Contact_Name');
				$Ac_City= $this->input->post('Ac_City');
				$Ac_Address= $this->input->post('Ac_Address');
				$Ac_Post_Code= $this->input->post('Ac_Post_Code');
				$Ac_Contact_Number= $this->input->post('Ac_Contact_Number');
			    $Ac_Email= $this->input->post('Ac_Email');
			    $Account_Limit= $this->input->post('Account_Limit');
				$AccountNumber= $this->input->post('AccountNumber');
		        $Terms= $this->input->post('Terms');
				$Account_Status= $this->input->post('Account_Status');
				
			   /************insert supplier details in array****************/
		      $supplier_data=array('business_id'=>$business_id,'suppliers_name'=>$Suppliers_Name,'suppliers_city'=>$City,'contact_name'=>$Contact_Name,'address'=>$Address,'post_code'=>$Post_Code,'contact_number'=>$Contact_Number,'email'=>$Email,'website'=>$Website,'order_email_address'=>$Order_Email_Address,'AccountNumber'=>$AccountNumber);
			  
			  
			   
			  
			  /**************insert supplier details in dev_supplier****************/
			  $supplier_details="dev_supplier";
			  $check_insert=$this->SupplierModel->insert($supplier_details,$supplier_data);
			  if($check_insert)
			  {
				    /************get last insert id form dev_supplier****************/
				  $supplier_id = $this->db->insert_id();
				  /************insert supplier details in array****************/
		      $supplier_account_data=array('ac_city'=>$Ac_City,'supplier_id'=>$supplier_id,'ac_contact_name'=>$Ac_Contact_Name,'ac_address'=>$Ac_Address,'ac_post_code'=>$Ac_Post_Code,'ac_contact_number'=>$Ac_Contact_Number,'ac_email'=>$Ac_Email,'account_limit'=>$Account_Limit,'terms'=>$Terms,'account_status'=>$Account_Status);
			   /**************insert supplier details in dev_supplier_account****************/
			  $supplier_acc="dev_supplier_account";
			  $check_acc_insert=$this->SupplierModel->insert($supplier_acc,$supplier_account_data);
			  if($check_acc_insert)
			  {
				  redirect('suppliers');
			  }
				  
			  }
			 
			}
			else
			{
			$this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('Suppliers.php');
			$this->load->view('footer.php');
			}
			  } //SESSION CHECK
			  else{
		redirect('dashboard');
	    }	
		
   }
   
   /***************************************Edit Supplier*************************/
	public function EditSupplier(){
		if($this->input->post('Edit_Supplier'))
			{
				  				$hid=$this->input->post('hid');
				/*********Edit Supplier Details***************/
				$Suppliers_Name= $this->input->post('Suppliers_Name');
				$Contact_Name= $this->input->post('Contact_Name');
				$City= $this->input->post('City');
				$Address= $this->input->post('Address');
				$Post_Code= $this->input->post('Post_Code');
			    $Contact_Number= $this->input->post('Contact_Number');
			    $Email= $this->input->post('Email');
		        $Website= $this->input->post('Website');
				$Order_Email_Address=$this->input->post('Order_Email_Address');
				/*******************Edit Supplier Account details ***********/
				$Ac_Contact_Name= $this->input->post('Ac_Contact_Name');
				$Ac_City= $this->input->post('Ac_City');
				$Ac_Address= $this->input->post('Ac_Address');
				$Ac_Post_Code= $this->input->post('Ac_Post_Code');
				$Ac_Contact_Number= $this->input->post('Ac_Contact_Number');
			    $Ac_Email= $this->input->post('Ac_Email');
			    $Account_Limit= $this->input->post('Account_Limit');
				$AccountNumber= $this->input->post('AccountNumber');
		        $Terms= $this->input->post('Terms');
				$Account_Status= $this->input->post('Account_Status');
				$Where=array('id'=>$hid);
			   /************update supplier details in array****************/
		      $supplier_data=array('suppliers_city'=>$City,'suppliers_name'=>$Suppliers_Name,'contact_name'=>$Contact_Name,'address'=>$Address,'post_code'=>$Post_Code,'contact_number'=>$Contact_Number,'email'=>$Email,'website'=>$Website,'order_email_address'=>$Order_Email_Address,'AccountNumber'=>$AccountNumber);
			  
			  
			  
			   
			  
			  /**************updatesupplier details in dev_supplier****************/
			  $supplier_details="dev_supplier";
			  $check=$this->SupplierModel->update($supplier_details,$supplier_data,$Where);
			  if($check)
			  {
				  $Where2=array('id'=>$hid);
				    /************get last insert id form dev_supplier****************/
				  
				  /************update supplier details in array****************/
		      $supplier_account_data=array('ac_city'=>$Ac_City,'ac_contact_name'=>$Ac_Contact_Name,'ac_address'=>$Ac_Address,'ac_post_code'=>$Ac_Post_Code,'ac_contact_number'=>$Ac_Contact_Number,'ac_email'=>$Ac_Email,'account_limit'=>$Account_Limit,'terms'=>$Terms,'account_status'=>$Account_Status);
			   /**************update supplier details in dev_supplier_account****************/
			  $supplier_acc="dev_supplier_account";
			  $check_acc_insert=$this->SupplierModel->update($supplier_acc,$supplier_account_data,$Where2);
			  if($check_acc_insert)
			  {
				  redirect('suppliers');
			  }
				  
			  }
			 
			}
			else
			{
			$this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('EditSupplier.php');
			$this->load->view('footer.php');
			}
		
	}
	public function Delete_Supplier(){
		$id=$_GET['id'];
		$check=$this->SupplierModel->delete("dev_supplier",$id);
		if($check)
		{
			$check_again=$this->db->query("delete from dev_supplier_account where supplier_id='$id'");
			if($check_again)
			{
				redirect('suppliers');
			}
		}
	}
	//Send Supplier to App Api
	public function SendSupplierToApp()
	{
		$this->load->view('api/SendSupplierToApp');
	}
	
	
}
