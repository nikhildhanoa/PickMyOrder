<?php 
require_once FCPATH. '/vendor/autoload.php';
use XeroAPI\XeroPHP\AccountingObjectSerializer;
defined('BASEPATH') OR exit('No direct script access allowed');

class SupplierController extends CI_Controller {

	public function __construct()
	{
	parent::__construct();
	$this->load->database();
	$this->load->Model('DataModel');
	$this->load->Model('EngineerModel');
	$this->load->Model('SupplierModel');
	$this->load->Model('CommonModel');
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
				
				if($this->input->post('vanstock'))
				{
					$vanstock="1";
				}
				else
				{
					$vanstock="0";
				}
				$Price_Increase_Monitoring= $this->input->post('Price_Increase_Monitoring');
				$Price_Increase_Tolerance= $this->input->post('Price_Increase_Tolerance');
				$Process_Invoices= $this->input->post('Process_Invoices');
				$Approval_Automation= $this->input->post('Approval_Automation');
				$Approval_Routing= $this->input->post('Approval_Routing');
				$Discard_Duplicated_Documents= $this->input->post('Discard_Duplicated_Documents');
				$Vendor= $this->input->post('Vendor');
				$Category= $this->input->post('Category');
				$Supplier_Payment_Terms= $this->input->post('Supplier_Payment_Terms');
			   /************insert supplier details in array****************/
		      $supplier_data=array('business_id'=>$business_id,'suppliers_name'=>$Suppliers_Name,'suppliers_city'=>$City,'contact_name'=>$Contact_Name,'address'=>$Address,'post_code'=>$Post_Code,'contact_number'=>$Contact_Number,'email'=>$Email,'website'=>$Website,'order_email_address'=>$Order_Email_Address,'AccountNumber'=>$AccountNumber,'van_stock'=>$vanstock,'Price_Increase_Monitoring'=>$Price_Increase_Monitoring,'Price_Increase_Tolerance'=>$Price_Increase_Tolerance,'Process_Invoices'=>$Process_Invoices,'Approval_Automation'=>$Approval_Automation,'Approval_Routing'=>$Approval_Routing,'Discard_Duplicated_Documents'=>$Discard_Duplicated_Documents,'xero_vendor'=>$Vendor,'xero_cateory'=>$Category,'Supplier_Payment_Terms'=>$Supplier_Payment_Terms);
			  
			  
			   
			  
			  /**************insert supplier details in dev_supplier****************/
			  /*  if(move_uploaded_file($logo["tmp_name"],"images/products/".$image_name_1))
			   { */
			  
			  $supplier_details="dev_supplier";
			  $check_insert=$this->SupplierModel->insert($supplier_details,$supplier_data);
			 /*   } */
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
				if($this->input->post('vanstock'))
				{
					$vanstock="1";
				}
				else
				{
					$vanstock="0";
				}
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
				$Price_Increase_Monitoring= $this->input->post('Price_Increase_Monitoring');
				$Price_Increase_Tolerance= $this->input->post('Price_Increase_Tolerance');
				$Process_Invoices= $this->input->post('Process_Invoices');
				$Approval_Automation= $this->input->post('Approval_Automation');
				$Approval_Routing= $this->input->post('Approval_Routing');
				$Discard_Duplicated_Documents= $this->input->post('Discard_Duplicated_Documents');
				
				$Vendor= $this->input->post('Vendor');
				$Category= $this->input->post('Category');
				$SupplierPayment_Terms= $this->input->post('SupplierPayment_Terms');
				$Where=array('id'=>$hid);
			   /************update supplier details in array****************/
		      $supplier_data=array('van_stock'=>$vanstock,'suppliers_city'=>$City,'suppliers_name'=>$Suppliers_Name,'contact_name'=>$Contact_Name,'address'=>$Address,'post_code'=>$Post_Code,'contact_number'=>$Contact_Number,'email'=>$Email,'website'=>$Website,'order_email_address'=>$Order_Email_Address,'AccountNumber'=>$AccountNumber,'Price_Increase_Monitoring'=>$Price_Increase_Monitoring,'Price_Increase_Tolerance'=>$Price_Increase_Tolerance,'Process_Invoices'=>$Process_Invoices,'Approval_Automation'=>$Approval_Automation,'Approval_Routing'=>$Approval_Routing,'Discard_Duplicated_Documents'=>$Discard_Duplicated_Documents,'xero_vendor'=>$Vendor,'xero_cateory'=>$Category,'Supplier_Payment_Terms'=>$SupplierPayment_Terms);
			  
			  
			  
			   
			  
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
				
			$ID=$_GET['id'];
            
			           $select3 = 'xero_vendor,xero_cateory';
					   $TableName3 = 'dev_supplier ';
					   $multiClause3 = array('id'=>$ID); 
					   $result_as_array = true;
					   $supplier_data = $this->CommonModel->Fetchdata($select3,$TableName3,$multiClause3,$result_as_array); 
			
			
			          $xero_vendor = $supplier_data[0]['xero_vendor'];
					  $xero_cateory = $supplier_data[0]['xero_cateory'];
			           
			      /////////////
				  $this->db->select('*');
		    $this->db->from('dev_Xero_Users');
		    $this->db->where('bussines_id',$this->BusinessIdFunction());
            $query = $this->db->get();
			
	     if($query->num_rows()==1)
		{
			
		    $query_data = $query->result_array();
			$xeroTenantId =   $query_data[0]['TenantId']; 
			$old =  $query_data[0]['expires_in']; 
			$new = strtotime(date("Y-m-d h:i:s")); 
		  
		  if(($old>$new) && round(abs($old-$new) / 60,2)>3)
		 { 
	 
	        /* echo round(abs($old-$new) / 60,2);
			ECHO '<BR>'; */
			 $access_token =  $query_data[0]['access_token']; 
			
		 }  else
         {
		
			$refresh_token =  $query_data[0]['refresh_token']; 
           $header = 'Authorization: Basic '.base64_encode('C7328F849DA24F7EA6D74FF4FDD70DEA'.":".'pkxnVZTWc_wa4VAjsvItCNcghOc94Cg9BTF1oxcjHYuFus5D');
			  $curl = curl_init();
			  curl_setopt_array($curl, array(
			  CURLOPT_URL => 'https://identity.xero.com/connect/token',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS => array('grant_type' => 'refresh_token','refresh_token' => $refresh_token),
			  CURLOPT_HTTPHEADER => array($header),
			));

               $response = curl_exec($curl);

             curl_close($curl);
             $response =  json_decode($response);
			
			 $access_token=$response->access_token;
			 $refresh_token=$response->refresh_token;
			 
             $new = strtotime(date("Y-m-d h:i:s"));
	         $old=$new+1800;
	
			 $TableName='dev_Xero_Users';
		     $multiclause=array('access_token'=>$access_token,'refresh_token'=>$refresh_token,'expires_in'=>$old);
		     $WhereClause=array('bussines_id'=>$this->BusinessIdFunction());
		     $All_TOKENS= $this->CommonModel->UpdateRecord($TableName,$multiclause,$WhereClause);
			 
			
	 	 }	
		 
		 /// start
		 $config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken($access_token);       

		$apiInstance = new XeroAPI\XeroPHP\Api\AccountingApi(
			new GuzzleHttp\Client(),
			$config
		);
		$order = "Name ASC";
	try {
		  $getContactss = $apiInstance->getContacts($xeroTenantId,$order);
		  
		              function accessProtected($obj, $prop) {  
					  $reflection = new ReflectionClass($obj);
					  $property = $reflection->getProperty($prop);
					  $property->setAccessible(true);
					  return $property->getValue($obj);
					   }  
		  
		  
		            $getContacts_id = accessProtected($getContactss, "container");
					  
					   $contact_HTML=null;
					   $check_contact_html='';  
                        $contact_HTML  .='<option value="" >Select</option>';					   
					  foreach($getContacts_id['contacts'] as $get_Single_Contacts)
					  {
						  $get_Single_Contacts = accessProtected($get_Single_Contacts, "container");
						    $check_contact_html='';   
						  if($get_Single_Contacts['name']==$xero_vendor){$check_contact_html='selected';}
						  
				   $contact_HTML  .='<option value="'.$get_Single_Contacts['name'].'"'.$check_contact_html.' >'.$get_Single_Contacts['name'].'</option>';  
					  }
					  
					  /// category start 
					  
					  $order = "Code ASC";
							 try {
						  $result = $apiInstance->getItems($xeroTenantId,$order);
						  
									   $get_item = accessProtected($result, "container");
						  
						  $item_HTML=null;
						  $item_HTML  .='<option value="" >Select</option>';
						 foreach($get_item['items'] as $get_single_item)
						 {		
						  $get_single_item = accessProtected($get_single_item, "container");
						  
						   $check_item_HTML='';   
						  if($get_single_item['name']==$xero_cateory){$check_item_HTML='selected';}
	$item_HTML  .='<option value="'.$get_single_item['name'].'"'.$check_item_HTML.'>'.$get_single_item['name'].'</option>';
						
						 }  
						
						  
						} catch (Exception $e) {
						  echo 'Exception when calling AccountingApi->getItems: ', $e->getMessage(), PHP_EOL;
						}
					  
					 /// category end
					  
		            $pass_array=array('contact'=>$contact_HTML,'category'=>$item_HTML);
		  
		  
		} catch (Exception $e) {
		  echo 'Exception when calling AccountingApi->getContacts: ', $e->getMessage(), PHP_EOL;
		}
		 
		 
		 }
		 else
		 {
			 // in this business xero not connect
			 
			 $pass_array=array('contact'=>'No Data Found','category'=>'No Data Found');
			 
		 }
				  
				  
				  
				  
				  
				  
				  ////////////////////
				
				
				
			$this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('EditSupplier.php',$pass_array);
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
