<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$firstname='';
$lastname='';
if(isset($_REQUEST['contact_first_name'])&&isset($_REQUEST['contact_last_name'])&&isset($_REQUEST['account_password'])&&isset($_REQUEST['contact_email_address'])&&isset($_REQUEST['billing_address_line1'])
&&isset($_REQUEST['billing_business_name'])&&isset($_REQUEST['billing_address_line2'])&&isset($_REQUEST['billing_city'])&&isset($_REQUEST['billing_postcode'])
&&isset($_REQUEST['shipping_address_line1'])&&isset($_REQUEST['shipping_Business_name'])&&isset($_REQUEST['shipping_address_line2'])
&&isset($_REQUEST['shipping_city'])&&isset($_REQUEST['shipping_postcode']))
{
	$retail=0;
	$trade=0;
	$basic_user=0;
	$email=$_REQUEST['contact_email_address'];
   $users=$this->db->query("select id from dev_users where email='$email'");
			if(!$users->num_rows())
			{
                if(isset($_REQUEST['business_id']) && $_REQUEST['business_id']==2)
				{
					$business_id=$_REQUEST['business_id'];
					$Wholeseller=0;
					$eng_p6=1;
					$eng_p10=1;
					$eng_p7=1;
					$eng_p2='1';
					$eng_p1='0';
					$eng_p3='0';
					$eng_p4='0';
					$eng_p5='0';
					$eng_p8='0';
					$eng_p11='0';
					$basic_user='1';
					
				}
				else {
					 if(isset($_REQUEST['Supervisor'])){$eng_p1='1';}else{$eng_p1='0';}
				 if(isset($_REQUEST['Operative'])){$eng_p2='1';}else{$eng_p2='1';}
				 if(isset($_REQUEST['All_orders'])){$eng_p3='1';}else{$eng_p3='0';}
				 if(isset($_REQUEST['Orders_to_Approve'])){ $eng_p4='1';}else{$eng_p4='0';}
				 if(isset($_REQUEST['See_costs'])){$eng_p5='1';}else{$eng_p5='0';}
				 if(isset($_REQUEST['Categories'])){$eng_p6='1';}else{$eng_p6='0';}
				 if(isset($_REQUEST['Orders'])){$eng_p7='1';}else{$eng_p7='0';}
				 if(isset($_REQUEST['Project_details'])){$eng_p8='1';}else{$eng_p8='0';}
				 if(isset($_REQUEST['Catalogues'])){$eng_p10='1';}else{$eng_p10='0';}
				 if(isset($_REQUEST['addproduct'])){$eng_p11='1';}else{$eng_p11='0';}
				
					if(isset($_REQUEST['usertype'])){$trade='1';}else{$retail='1';}
					
					$business_id=16;
					$Wholeseller=1;

				}			/********************here i put static id for atradeya business make it dynamic*********************/
				$Enginner_table='dev_engineer';
				$Enginner_permi_table='dev_engineer_permissions';
				$phone_number=$_REQUEST['contact_telephone']; //new
				$eng_name= $_REQUEST['contact_first_name'];
				$eng_username= $_REQUEST['contact_first_name'].' '.$_REQUEST['contact_last_name'];
				$eng_email= $_REQUEST['contact_email_address'];
				$eng_password= $_REQUEST['account_password'];
				$eng_conpass= '';
				$lastname= $_REQUEST['contact_last_name'];
				$acnumber= '';//
				$sellerbusinessname= '';  //
				$billing_fname==$_REQUEST['billing_first_name']; //new
				$billing_lname=$_REQUEST['billing_last_name']; //new
				$billingaddress= $_REQUEST['billing_address_line1'];
				$billingcompany= $_REQUEST['billing_business_name'];   
				$billingcompanyaddress= $_REQUEST['billing_address_line2'];
				$billingcity= $_REQUEST['billing_city'];     
				$billingpostcode= $_REQUEST['billing_postcode'];
				
				$shipping_first_name=$_REQUEST['shipping_first_name'];//new
				$shipping_last_name=$_REQUEST['shipping_last_name'];//new
				$deliveryadress= $_REQUEST['shipping_address_line1'];  //     
				$deliverycompnay= $_REQUEST['shipping_Business_name'];
				$deliverycompnayaddress= $_REQUEST['shipping_address_line2'];
				$deliverycompnaycity= $_REQUEST['shipping_city'];
				$deliverycompnaypostcode= $_REQUEST['shipping_postcode'];
			    $usertype= 'guest'; 
				/***Permission*****/
				
				 if(isset($_REQUEST['order_per_day'])){$opd='1';}else{$opd='100000';}
				 if(isset($_REQUEST['single_order_per_day'])){$sopd='1';}else{$sopd='100000';}
				 if(isset($_REQUEST['Meterial_cost'])){$met_co='1';}else{$met_co='100000';}
				 
			
			 /*****************Add Details in deV_user********************/
		 	 $Add_enigneer_in_dev_user=array('user_name'=>$eng_username,'email'=>$eng_email,'role'=>3,'	password'=>$eng_password,'is_supervisor'=>$eng_p1,'from_bussi'=>$business_id);
			 $Insert_Status=$this->DataModel->insert('dev_users',$Add_enigneer_in_dev_user);
			 if($Insert_Status)
			 {
					$Insert_Status_id=$this->db->insert_id();
			        $Eng_data=array('user_id'=>$Insert_Status_id,'name'=>$eng_name,'user_name'=>$eng_username,'business_id'=>$business_id,
					'email'=>$eng_email,'password'=>$eng_password,'newlastname'=>$lastname,'newaccnumber'=>$acnumber,'newbussiname'=>$sellerbusinessname,
					'newBaddress'=>$billingaddress,'	newCname'=>$billingcompany,'newCaddress'=>$billingcompanyaddress,'newCcity'=>$billingcity,
					'newCpostcode'=>$billingpostcode,'newDaddress'=>$deliveryadress,'newDCname'=>$deliverycompnay,'newDCaddress'=>$deliverycompnayaddress,
					'newDCcity'=>$deliverycompnaycity,'newDCpostcode'=>$deliverycompnaypostcode,'wholeseller_status'=>1);
			 }
			 else     
			 {
				 echo json_encode(array("statusCode"=>500,"valid"=>false,'Message'=>"Internel server error"),JSON_FORCE_OBJECT);
			 }
			
		     $insert=$this->DataModel->insert($Enginner_table,$Eng_data);
			 $insert_id = $this->db->insert_id(); 
			/*  $Eng_permi_data=array('engineer_id'=>$insert_id,'Supervisor'=>$eng_p1,'Operative'=>$eng_p2,'All_orders'=>$eng_p3,'Orders_to_Approve'=>$eng_p4,'See_costs'=>$eng_p5,'limit_order_per_day'=>$opd,'single_order_limit'=>$sopd,'status_meterial_cost'=>$met_co,'Categories'=>$eng_p6,'Orders'=>$eng_p7,'Project_details'=>$eng_p8,'Catalogues'=>$eng_p10,'AddProduct'=>$eng_p11,'Wholeseller'=>1); */
			 if($insert)
			 {
				 /***********************check if engineer is add by wholesheller app************************/
					 $Eng_permi_data=array('engineer_id'=>$insert_id,'Supervisor'=>$eng_p1,'Operative'=>$eng_p2,'All_orders'=>$eng_p3,'Orders_to_Approve'=>$eng_p4,
					 'See_costs'=>$eng_p5,'limit_order_per_day'=>$opd,'single_order_limit'=>$sopd,'status_meterial_cost'=>$met_co,'Categories'=>$eng_p6,
					 'Orders'=>$eng_p7,'Project_details'=>$eng_p8,'Catalogues'=>$eng_p10,'AddProduct'=>$eng_p11,'Wholeseller'=>$Wholeseller,'atradeya_trade'=>$trade,'atradeya_retail'=>$retail,'is_basic_user'=>$basic_user);
				 /***************************************Close***********************************************/
               $insert_permi=$this->DataModel->insert($Enginner_permi_table,$Eng_permi_data);
			      if($insert_permi)
			       {
					       $select_data_object=$this->db->query("select * from dev_users where id='$Insert_Status_id'");
			$select_data=	$select_data_object->result_array();	       
	if($select_data_object)
		    {
		      
			    $role = $select_data[0]['role'];
				$userid = $select_data[0]['id'];
				 // mail('rohitkumar.scorpsoft@gmail.com',$devicestatus.' Device is Login'.$userid,$device_id);
				if($devicestatus=='Android')
					{
						$olddeviceid= $select_data[0]['deviceid'];
						
					}
					if($devicestatus=='ios')
					{
						 $olddeviceid= $select_data[0]['iosdeviceid'];
					}
			   
			    
			    if($olddeviceid!='')
			    {
				    $device_id=$olddeviceid.$device_id;
				    
			    }
				
			        $bussiness_id = $select_data[0]['business_id'];
			        $username = $select_data[0]['user_name'];
		            $userimage = $select_data[0]['image'];
		            
					
			/***************get numbers of awating orders*******************/
			        if($bussiness_id!='')
			        {
			            $Get_awating_orders = $this->db->query("select id from dev_orders where status=1 && business_id=$bussiness_id");
			            $numberofawating=$Get_awating_orders->num_rows();
						    
			        }
			            $Categorie='1';/*set by default permissions for engineer*/
				        $Orders='1';
				        $Project_Details='0';
				        $Catalogues='0';
				        $All_Orders='1';
				        $See_Cost='1';
				        $Orders_To_approve='0';
						$Addproduct='0';
			            
			    if($role=='3')
				{
					$selected_engineer = $this->db->query('select * from dev_engineer where user_id="'.$userid.'"'); 
					// Get user id of a engineer from dev_users table
			        $selected_engineer = $selected_engineer->result_array();
			        $engineer_id=$selected_engineer[0]['id'];
				    $business_id=$selected_engineer[0]['business_id'];
					$firstname=$selected_engineer[0]['name'];
					$lastname=$selected_engineer[0]['newlastname'];
			        $permis_engineer = $this->db->query('select *from dev_engineer_permissions where engineer_id="'.$engineer_id.'"');
			        $selected_permission = $permis_engineer->result_array();
			/****************NUMBER OF AWATING IF ENGINEER*******************/
			        $Get_awating_orders = $this->db->query("select id from dev_orders where status=1&& business_id=$business_id");
			        $numberofawating=$Get_awating_orders->num_rows();
			/*************************close**********************/
					//Chek whollseller is not
					 $permission_wholeseller=$selected_permission[0]['Wholeseller'];
					
					 if($permission_wholeseller) //change 19-02-2020
					 {
						 $main_id="$engineer_id";
						 $busi_name=$selected_engineer[0]['newbussiname'];
						 /*****************get publised key*****************/
					$get_bussiness_details=$this->db->query("select * from dev_business where id='$business_id'");
						$get_bussiness_details1=$get_bussiness_details->result_array();
						$key=$get_bussiness_details1[0]['stripe_publishkey'];
					   
					 }
					 else
					 {
						 $main_id=0;
						 $busi_name='';
						 $key=0;
					 }
					if($selected_permission[0]['Operative']=='1')
					{
						$role='4';
						$Categorie=$selected_permission[0]['Categories'];   //set permissions for engineer if have oprative role
						$Orders=$selected_permission[0]['Orders'];
						$Project_Details=$selected_permission[0]['Project_details'];
						$Catalogues=$selected_permission[0]['Catalogues'];
						$All_Orders=$selected_permission[0]['All_orders'];
						$Orders_To_approve=$selected_permission[0]['Orders_to_Approve'] ;
						$See_Cost=$selected_permission[0]['See_costs'] ;
						$Addproduct=$selected_permission[0]['AddProduct'];
		/****************NUMBER OF AWATING IF ENGINEER*******************/
						$Get_awating_orders = $this->db->query("select id from dev_orders where status=1&& business_id=$business_id&&engineer_id=$userid");
						$numberofawating=$Get_awating_orders->num_rows();
			/*************************close**********************/
					}
				//if atradeya users 
				if($selected_permission[0]['atradeya_trade']=='1' || $selected_permission[0]['atradeya_retail']=='1')
					{
					    $Categorie='1';
				        $Orders='1';
				        $Project_Details='1';
				        $Catalogues='1';
				        $All_Orders='1';
				        $See_Cost='1';
				        $Orders_To_approve='0';
						$Addproduct='0';
					    
					}
				//close
				
				}
					if($role=='3' || $role=='4')
					{ 
						$bussiness_id=$business_id;
					}
					
/*******************************Check A bussiness user can view Wholsealer tab or tab***********************************/
					$ViewPageOrNot=$this->db->query("select iswholpageview from dev_business where id='$business_id'");
					$confirm=$ViewPageOrNot->result_array();
					$Haveornot=$confirm[0]['iswholpageview'];
					if($role=='2') //if admin then
					{
						$Haveornot='0';
						$permission_wholeseller='0';
						$main_id='0';
						$busi_name='0';
						$key='0';
					}}
/***********************************************************************************************************************/
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
							/***************************************************************/
						echo json_encode(array("statusCode"=>200,"valid"=>true,"Message"=>"register successfully",'role'=>$role,'id'=>$userid,'user name'=>$username,'image'=>$userimage,"Categorie"=>$Categorie,"Orders"=>$Orders,"Project_Details"=>$Project_Details,"Catalogues"=>$Catalogues,"All_Orders"=>$All_Orders,'Orders_To_approve'=>$Orders_To_approve,'Seecost'=>$See_Cost,'numberofawating'=>$numberofawating,$device_id,"Business_id"=>$bussiness_id,'Addproduct'=>$Addproduct,'permission_wholeseller'=>$permission_wholeseller,'Wholeseller_engineer_id'=>$main_id,'BussinessName'=>$busi_name,'ViewWholesellerPage'=>$Haveornot,'first_name'=>$firstname,'last_name'=>$lastname,'publishKey'=>$key,'Quotes'=>'0','vanstock'=>'0','basic_user'=>$basic_user));
					}
					 else
					 {
						 echo json_encode(array("statusCode"=>500,"valid"=>false,'Message'=>"Internel server error"),JSON_FORCE_OBJECT);
					 }
                }
			  else
				{
				 echo json_encode(array("statusCode"=>500,"valid"=>false,'Message'=>"Internel server error"),JSON_FORCE_OBJECT);
				}
			}else
			{
				 echo json_encode(array("statusCode"=>401,"valid"=>false,'Message'=>"User Already Exsist"),JSON_FORCE_OBJECT);
			}
				
}
else
{
   echo json_encode(array("statusCode"=>401,"valid"=>false,'Message'=>"All Field iS Required"),JSON_FORCE_OBJECT);
}
    ?>