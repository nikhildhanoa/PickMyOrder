<?php error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class EngineerController extends CI_Controller {
public function __construct()
	{
	parent::__construct();
	$this->load->database();
	$this->load->Model('DataModel');
	$this->load->Model('EngineerModel');
	 $this->load->library('form_validation');
	}
   public function Engineer()
   {
	   if(isset($_SESSION['status']))
	   {
	     if($this->input->post('add_enginner'))
			{
				$userid=$_SESSION['status']['user_id'];
			    if(isset($_SESSION['Current_Business']))
					{
					 $business_id=$_SESSION['Current_Business'];
					}
					else
					{
					 $business_id=$_SESSION['status']['business_id'];
					}
			   
				$Enginner_table='dev_engineer';
				$Enginner_permi_table='dev_engineer_permissions';
				$eng_name= $this->input->post('Name');
				$eng_username= $this->input->post('uname');
				$eng_email= $this->input->post('email');
				
				$eng_pass= $this->input->post('Password');
				$eng_password = $eng_pass;
				$eng_conpass= $this->input->post('Conpassword');
				/***************************GET eXTRA VALUES FROM WHOLLSELLER ENGINER IF WHOLESELLER*****************/
				if($this->input->post('HiddenWholeSeller_Value'))
			    {
					$lastname= $this->input->post('lastName');
					$acnumber= $this->input->post('accnumber');
					$sellerbusinessname= $this->input->post('businessName');
					$billingaddress= $this->input->post('billingaddress');
					$billingcompany= $this->input->post('billingcompany');
					$billingcompanyaddress= $this->input->post('billingcompanyaddress');
					$billingcity= $this->input->post('billingcity');
					$billingpostcode= $this->input->post('billingpostcode');
					$deliveryadress= $this->input->post('deliveryaddress');
					$deliverycompnay= $this->input->post('delivercompanyname');
					$deliverycompnayaddress= $this->input->post('diliverycompanyaddress');
					$deliverycompnaycity= $this->input->post('diliverycompnycity');
					$deliverycompnaypostcode= $this->input->post('diliverycompanypostcode');
				}
				/*****************************************CLOSE*********************************************/
				
				
				
				
				
				/***Permission*****/
				 if($this->input->post('Supervisor')){$eng_p1='1';}else{$eng_p1='0';}
			 if($this->input->post('Operative')){$eng_p2='1';}else{$eng_p2='0';}
		     if($this->input->post('All_orders')){$eng_p3='1';}else{$eng_p3='0';}
			 if($this->input->post('Orders_to_Approve')){ $eng_p4='1';}else{$eng_p4='0';}
			 if($this->input->post('See_costs')){$eng_p5='1';}else{$eng_p5='0';}
			 
			 if($this->input->post('Categories')){$eng_p6='1';}else{$eng_p6='0';}
			 if($this->input->post('Orders')){$eng_p7='1';}else{$eng_p7='0';}
		     if($this->input->post('Project_details')){$eng_p8='1';}else{$eng_p8='0';}
			
			 if($this->input->post('Catalogues')){$eng_p10='1';}else{$eng_p10='0';}
			  if($this->input->post('addproduct')){$eng_p11='1';}else{$eng_p11='0';}
			  if($this->input->post('quotes')){$eng_p12='1';}else{$eng_p12='0';}
				$opd=$this->input->post('order_per_day');
				if($opd=='')
				{
				$opd='100000';
				}
				$sopd=$this->input->post('single_order_per_day');
				if($sopd=='')
				{
				$sopd='100000'; 
				}
				if($this->input->post('Meterial_cost'))
				{
					$met_co='1';
				}
				else
				{
					$met_co='0';
				}
			 
			 /*****************Add Details in deV_user********************/
		 	 $Add_enigneer_in_dev_user=array('user_name'=>$eng_username,'email'=>$eng_email,'role'=>3,'	password'=>$eng_password,'is_supervisor'=>$eng_p1,'from_bussi'=>$business_id);
			 $Insert_Status=$this->DataModel->insert('dev_users',$Add_enigneer_in_dev_user);
			 if($Insert_Status)
			 {
			 $Insert_Status_id=$this->db->insert_id();
			 if($this->input->post('HiddenWholeSeller_Value'))
			 {
				  $Eng_data=array('user_id'=>$Insert_Status_id,'name'=>$eng_name,'user_name'=>$eng_username,'business_id'=>$business_id,'email'=>$eng_email,'password'=>$eng_password,'newlastname'=>$lastname,'newaccnumber'=>$acnumber,'newbussiname'=>$sellerbusinessname,'newBaddress'=>$billingaddress,'	newCname'=>$billingcompany,'newCaddress'=>$billingcompanyaddress,'newCcity'=>$billingcity,'newCpostcode'=>$billingpostcode,'newDaddress'=>$deliveryadress,'newDCname'=>$deliverycompnay,'newDCaddress'=>$deliverycompnayaddress,'newDCcity'=>$deliverycompnaycity,'newDCpostcode'=>$deliverycompnaypostcode,'wholeseller_status'=>1);
			 }
			 else
			 {
			    $Eng_data=array('user_id'=>$Insert_Status_id,'name'=>$eng_name,'user_name'=>$eng_username,'business_id'=>$business_id,'email'=>$eng_email,'password'=>$eng_password);
			 }
			 
			 }
			 
			$insert=$this->DataModel->insert($Enginner_table,$Eng_data);
			$insert_id = $this->db->insert_id(); 
			/*  $Eng_permi_data=array('engineer_id'=>$insert_id,'Supervisor'=>$eng_p1,'Operative'=>$eng_p2,'All_orders'=>$eng_p3,'Orders_to_Approve'=>$eng_p4,'See_costs'=>$eng_p5,'limit_order_per_day'=>$opd,'single_order_limit'=>$sopd,'status_meterial_cost'=>$met_co,'Categories'=>$eng_p6,'Orders'=>$eng_p7,'Project_details'=>$eng_p8,'Catalogues'=>$eng_p10,'AddProduct'=>$eng_p11,'Wholeseller'=>1); */
			 if($insert)
			 {
					 if($this->input->post('HiddenWholeSeller_Value'))
					 {
					 /***********************check if engineer is add by wholesheller app************************/
					  $Eng_permi_data=array('engineer_id'=>$insert_id,'Supervisor'=>$eng_p1,'Operative'=>$eng_p2,'All_orders'=>$eng_p3,'Orders_to_Approve'=>$eng_p4,'See_costs'=>$eng_p5,'limit_order_per_day'=>$opd,'single_order_limit'=>$sopd,'status_meterial_cost'=>$met_co,'Categories'=>$eng_p6,'Orders'=>$eng_p7,'Project_details'=>$eng_p8,'Catalogues'=>$eng_p10,'AddProduct'=>$eng_p11,'Quotes'=>$eng_p12,'Wholeseller'=>1);
					 /***************************************Close***********************************************/
					 }
					 else
					 {
					  $Eng_permi_data=array('engineer_id'=>$insert_id,'Supervisor'=>$eng_p1,'Operative'=>$eng_p2,'All_orders'=>$eng_p3,'Orders_to_Approve'=>$eng_p4,'See_costs'=>$eng_p5,'limit_order_per_day'=>$opd,'single_order_limit'=>$sopd,'status_meterial_cost'=>$met_co,'Categories'=>$eng_p6,'Orders'=>$eng_p7,'Project_details'=>$eng_p8,'Catalogues'=>$eng_p10,'AddProduct'=>$eng_p11,'Quotes'=>$eng_p12,'Wholeseller'=>0);
					 // print_r($Eng_permi);die;
					 }
					 
					  
				  $insert_permi=$this->DataModel->insert($Enginner_permi_table,$Eng_permi_data);
			      if($insert_permi)
			       {
					   if($this->input->post('HiddenWholeSeller_Value'))
						{
							/***************to save this user in atrdeya **********************/
							$curl = curl_init();
							  curl_setopt_array($curl, array(
							  CURLOPT_URL => "http://atradeya.co.uk/CreateUserFromPickMyorder.php",
							  CURLOPT_RETURNTRANSFER => true,
							  CURLOPT_ENCODING => "",
							  CURLOPT_MAXREDIRS => 10,
							  CURLOPT_TIMEOUT => 30,
							  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							  CURLOPT_CUSTOMREQUEST => "POST",
							  CURLOPT_POSTFIELDS => "user_name=$eng_username&password=$eng_password&email=$eng_email",
							  CURLOPT_HTTPHEADER => array(
								"cache-control: no-cache",
								"content-type: application/x-www-form-urlencoded",
								"postman-token: e5d0c122-8ab4-1337-acee-865acd7b5d93"
							  ),
							));
							$response = curl_exec($curl);
							$err = curl_error($curl);
							curl_close($curl);
							/******************************************************************/
				        redirect('wholesaler');
						}
						else
						{
							redirect('engineer');
						}
			       }
			
			 }
			
			}
			else
			{	
			$this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('Engineers.php');
			$this->load->view('footer.php'); 
            }
	   } //END OF SESSION IF
	else
	    {
		redirect('dashboard');
	    }	
    }
		
      /******************************Edit_engineers*********************************/
	public function EditEngineer()                                            
	{
		if($this->input->post('Edit_Enginner'))
		{
			
		
				$Enginner_table='dev_engineer';
				$Enginner_permi_table='dev_engineer_permissions';
				
				$Engineer_id=$this->input->post('hid');
				$hiduserid=$this->input->post('hiduserid');
				$eng_name= $this->input->post('name');
				
				$eng_username= $this->input->post('uname');
				$eng_email= $this->input->post('email');
				
			   $eng_password= $this->input->post('Password');
			$eng_conpass= $this->input->post('Conpassword');
			/***************************GET eXTRA VALUES FROM WHOLLSELLER ENGINER IF WHOLESELLER*****************/
				if($this->input->post('HiddenWholeSeller_Value'))
			    {
					$lastname= $this->input->post('lastName');
					$acnumber= $this->input->post('accnumber');
					$sellerbusinessname= $this->input->post('businessName');
					$billingaddress= $this->input->post('billingaddress');
					$billingcompany= $this->input->post('billingcompany');
					$billingcompanyaddress= $this->input->post('billingcompanyaddress');
					$billingcity= $this->input->post('billingcity');
					$billingpostcode= $this->input->post('billingpostcode');
					$deliveryadress= $this->input->post('deliveryaddress');
					$deliverycompnay= $this->input->post('delivercompanyname');
					$deliverycompnayaddress= $this->input->post('diliverycompanyaddress');
					$deliverycompnaycity= $this->input->post('diliverycompnycity');
					$deliverycompnaypostcode= $this->input->post('diliverycompanypostcode');
				}
				/*****************************************CLOSE*********************************************/
		/***Permission*****/
		     if($this->input->post('Supervisor')){$eng_p1='1';}else{$eng_p1='0';}
			 if($this->input->post('Operative')){$eng_p2='1';}else{$eng_p2='0';}
		     if($this->input->post('All_orders')){$eng_p3='1';}else{$eng_p3='0';}
			 if($this->input->post('Orders_to_Approve')){ $eng_p4='1';}else{$eng_p4='0';}
			 if($this->input->post('See_costs')){$eng_p5='1';}else{$eng_p5='0';}
			 
			 if($this->input->post('Categories')){$eng_p6='1';}else{$eng_p6='0';}
			 if($this->input->post('Orders')){$eng_p7='1';}else{$eng_p7='0';}
		     if($this->input->post('Project_details')){$eng_p8='1';}else{$eng_p8='0';}
			
			 if($this->input->post('Catalogues')){$eng_p10='1';}else{$eng_p10='0';}
			 if($this->input->post('addproduct')){$eng_p11='1';}else{$eng_p11='0';}
			 if($this->input->post('quotes')){$eng_p12='1';}else{$eng_p12='0';}
			$opd=$this->input->post('order_per_day');
					if($opd=='')
						{
						$opd='100000';
						}
		 $sopd=$this->input->post('single_order_per_day');
				if($sopd=='')
				{
				$sopd='100000';
				}
				 if($this->input->post('HiddenWholeSeller_Value'))
					{
					  $Eng_data=array('name'=>$eng_name,'user_name'=>$eng_username,'email'=>$eng_email,'password'=>$eng_password,'newlastname'=>$lastname,'newaccnumber'=>$acnumber,'newbussiname'=>$sellerbusinessname,'newBaddress'=>$billingaddress,'	newCname'=>$billingcompany,'newCaddress'=>$billingcompanyaddress,'newCcity'=>$billingcity,'newCpostcode'=>$billingpostcode,'newDaddress'=>$deliveryadress,'newDCname'=>$deliverycompnay,'newDCaddress'=>$deliverycompnayaddress,'newDCcity'=>$deliverycompnaycity,'newDCpostcode'=>$deliverycompnaypostcode,'wholeseller_status'=>1);
					  $wholesell='1';
					}
					else
					{
						$Eng_data=array('name'=>$eng_name,'user_name'=>$eng_username,'email'=>$eng_email,'password'=>$eng_password); 
						 $wholesell='0';
				    }
						$where=array('id'=>$Engineer_id);
						$update=$this->DataModel->update($Enginner_table,$Eng_data,$where);
				
				
				
					$update_enigneer_in_dev_user=array('user_name'=>$eng_username,'email'=>$eng_email,'password'=>$eng_password,'is_supervisor'=>$eng_p1);
					$where=array('id'=>$hiduserid);
					$update=$this->DataModel->update('dev_users',$update_enigneer_in_dev_user,$where);
			
				 $where=array('engineer_id'=>$Engineer_id);
				 $Eng_permi_data=array('Supervisor'=>$eng_p1,'Operative'=>$eng_p2,'All_orders'=>$eng_p3,'Orders_to_Approve'=>$eng_p4,'See_costs'=>$eng_p5,'limit_order_per_day'=>$opd,'single_order_limit'=>$sopd,'Categories'=>$eng_p6,'Orders'=>$eng_p7,'Project_details'=>$eng_p8,'Catalogues'=>$eng_p10,'AddProduct'=>$eng_p11,'Quotes'=>$eng_p12,'Wholeseller'=>$wholesell);
				 
				 $update_permi=$this->DataModel->update($Enginner_permi_table,$Eng_permi_data,$where);
				 $this->session->set_flashdata('successdetails', "Updated Successfully");
				 
					if($this->input->post('HiddenWholeSeller_Value'))
					{
						redirect('EditWholesaler?id='.$Engineer_id);
					}
					else
					{
						redirect('editengineer?id='.$Engineer_id);
					}
				
				
				
			
		
		}
		else
		{
					
			$this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('Edit_Engineer.php');
			$this->load->view('footer.php'); 
        }
				
    }
		public function EditWholeseller()
		{
			$this->load->view('header.php');
			$this->load->view('sidebar.php');
			$this->load->view('EditWholeseller.php');
			$this->load->view('footer.php'); 
		}
		public function DeleteEngineer()
		{
			$get_id=$_GET['id'];
			$userid=$_GET['uid'];
			$this->db->query("delete from dev_users where id='$userid'");
			$this->db->query("UPDATE `dev_projects` SET  `engineer_array` = TRIM(BOTH ',' FROM REPLACE(CONCAT(',', `engineer_array`), ',$get_id', '')) WHERE FIND_IN_SET('$get_id', `engineer_array`)");
			$this->EngineerModel->delete_engineers($get_id);
			
		}
		public function SendOprativeEnigineers()
		{
			$this->load->view('api/SendOprativeEnigineers');
		}
		public function SendOprativeEnigineersFromApp()
		{
			$this->load->view('api/SendOprativeEnigineersFromApp');
		}
		public function Engineer_address_list()
		{ 
		    $this->load->view('api/EnginnerAllAddress');
		}
			public function Send_enginner_alladdress()
		{ 
		    $this->load->view('api/sendEnginnerAllAddress');
		}
			public function Edit_enigneer_alladdress()
		{ 
		    $this->load->view('api/EditEnginnerAllAddress');
		}
				public function delete_enigneer_alladdress()
		{ 
		    $this->load->view('api/DeletEenigneerAllAddress');
		}
	
		
}
	


