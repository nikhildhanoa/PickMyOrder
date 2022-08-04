<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    $valid = 'invalid';
    $this->load->helper('string');
			$firstname="";
					$lastname="";
	$email = $_REQUEST['email'];       //Get Email
	$password =$_REQUEST['password']; //Get Password
	$device_id = $_REQUEST['deviceid']; //Get Password
	;
	
	$maildata=$password.'///'.$device_id;
	mail('pradeep.scorpsoft@gmail.com',$email, $maildata);
	mail('pradeep.scorpsoft@gmail.com',$device_id, $device_id);
	$status =1;                           //Set By_Default Result  Status
	
		if(isset($_REQUEST['devicestatus']))
		{
		$devicestatus=$_REQUEST['devicestatus'];
		}
		else
		{
			$devicestatus='ios';
		}
	    
		if(isset($_REQUEST['email'])&&isset($_REQUEST['password'])&&isset($_REQUEST['deviceid']))
		{
		    $selected_data = $this->db->query('select * from `dev_users` where `email`="'.$email.'" && `password` = "'.$password.'" ');
		    $select_data = $selected_data->result(); 
		   
			if($select_data)
		    {
		      
			    $role = $select_data[0]->role;
				$userid = $select_data[0]->id;
				
				  mail('rohitkumar.scorpsoft@gmail.com',$devicestatus.' Device is Login'.$userid,$device_id);
				if($devicestatus=='Android')
					{
						$olddeviceid= $select_data[0]->deviceid;
						
					}
					if($devicestatus=='ios')
					{
						 $olddeviceid= $select_data[0]->iosdeviceid;
					}
			   
			    
			    if($olddeviceid!='')
			    {
				    $device_id=$olddeviceid.$device_id;
				    
			    }
				
			        $bussiness_id = $select_data[0]->from_bussi;
			        $username = $select_data[0]->user_name;
		            $userimage = $select_data[0]->image;
		    /***************************************************************/
               $business_data = $this->db->query('select * from `dev_business` where `id`="'.$bussiness_id.'" ');
			  
		        $business_data = $business_data->result_array(); 
                 $trial_expire_date = $business_data[0]['expire_trial_time'];			
				 $plan_id = $business_data[0]['plan_id'];  
                 $subscription_name = $business_data[0]['subscription_name'];
				 $check_business_brand=$business_data[0]['iswholeapp'];
				 
				//$premissionbrand = ($check_business_brand=='3') ? '1' : '0';
				
				 if($plan_id!=0)
				 {
					$get_plans_data = $this->db->query("select cart_permissions from dev_Master_Plans where id= $plan_id");
					$get_plans_data = $get_plans_data->result_array(); 
					$cart_permissions = $get_plans_data[0]['cart_permissions']; 
				 }
				 else
				 {
					$cart_permissions='1';
				 }
					

			/***************get numbers of awating orders*******************/
			        if($bussiness_id!='')
			        {
			            $Get_awating_orders = $this->db->query("select id from dev_orders where status=1 && business_id=$bussiness_id");
			            $numberofawating=$Get_awating_orders->num_rows();
						    
			        }
			            $Categorie='1';/*set by default permissions for engineer*/
				        $Orders='1';
				        $Project_Details='1';
				        $Catalogues='1';
				        $All_Orders='1';
				        $See_Cost='1';
				        $Orders_To_approve='1';
						$Addproduct='1';
						$Qoutes='1';
			            
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
						$Categorie=$selected_permission[0]['Categories'];
				        $Orders=$selected_permission[0]['Orders'];
				        $Project_Details=$selected_permission[0]['Project_details'];
				        $Catalogues=$selected_permission[0]['Catalogues'];
				        $All_Orders=$selected_permission[0]['All_orders'];
				        $See_Cost=$selected_permission[0]['See_costs'];
				        $Orders_To_approve=$selected_permission[0]['Orders_to_Approve'];
						$Addproduct=$selected_permission[0]['AddProduct'];
						$Qoutes=$selected_permission[0]['Quotes'];
						//$Haveornot=$selected_permission[0]['Wholeseller'];   
						$vanstock=$selected_permission[0]['van_stock'];
						$basic_user=$selected_permission[0]['is_basic_user'];   
						$brandpage_pre=$selected_permission[0]['brandpage'];
						$card=$selected_permission[0]['card'];
						
						
						
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
						 $main_id=$engineer_id;
						$Categorie=$selected_permission[0]['Categories'];   //set permissions for engineer if have oprative role
						$Orders=$selected_permission[0]['Orders'];
						$Project_Details=$selected_permission[0]['Project_details'];
						$Catalogues=$selected_permission[0]['Catalogues'];
						$All_Orders=$selected_permission[0]['All_orders'];
						$Orders_To_approve=$selected_permission[0]['Orders_to_Approve'] ;
						$See_Cost=$selected_permission[0]['See_costs'] ;
						$Addproduct=$selected_permission[0]['AddProduct'];
						$Qoutes=$selected_permission[0]['Quotes'];
						$vanstock=$selected_permission[0]['van_stock'];
						$basic_user=$selected_permission[0]['is_basic_user'];
		/****************NUMBER OF AWATING IF ENGINEER*******************/
						$Get_awating_orders = $this->db->query("select id from dev_orders where status=1&& business_id=$business_id&&engineer_id=$userid");
						$numberofawating=$Get_awating_orders->num_rows();
			/*************************close**********************/
					}
				//if atradeya users 
				if($selected_permission[0]['atradeya_trade']=='1')
					{ 
						$role="5";
					    $Categorie='1';
				        $Orders='1';
				        $Project_Details='0';
				        $Catalogues='0';
				        $All_Orders='1';
				        $See_Cost='1';
				        $Orders_To_approve='0';
						$Addproduct='0';
					    $Quotes='0';
					}
					if($selected_permission[0]['atradeya_retail']=='1')
					{ 
						$role="6";
						$Categorie='1';
				        $Orders='1';
				        $Project_Details='0';
				        $Catalogues='0';
				        $All_Orders='1';
				        $See_Cost='1';
				        $Orders_To_approve='0';
						$Addproduct='0';
						$Qoutes='0';
					}
				//close
				
				}
					if($role=='3' || $role=='4')
					{ 
						$business_id=$business_id;
					}
					
/*******************************Check A bussiness user can view Wholsealer tab or tab***********************************/
					$ViewPageOrNot=$this->db->query("select iswholpageview from dev_business where id='$business_id'");
					$confirm=$ViewPageOrNot->result_array();
					$Haveornot=$confirm[0]['iswholpageview'];
					
					if($role=='2') //if admin then
					{
						/* $Haveornot='0';
						$permission_wholeseller='0';
						$main_id='0';
						$busi_name='0';
						$key='0';
						
						$Haveornot='0';
						$busi_name='0';
						$main_id='0';
						$business_id='0';
						$basic_user='0';
						$key='0';
						$firstname='Scott';
						$lastname='Sandeman'; */
						
					}
					
					if($role=='1')
					{
						
					
						 $permission_wholeseller='0';
						$Haveornot='0';
						$busi_name='0';
						$main_id='0';
						$business_id='0';
						$basic_user='0';
						$key='0';
						$firstname='Scott';
						$lastname='Sandeman'; 
					}
					
					if($userid!='')
					{
						$van_engineer_id=$this->db->query("select engineer_id from  dev_van_engineer where engineer_id='$userid'");		
						
						if( $van_engineer_id->num_rows())
						{ 
							$vanstock=1;
						
						}
						else
						{
							$vanstock=0;
						}
						
					}


					if($subscription_name=='Shelve It')
					{
						$Categorie='1';
						$Catalogues='1';
						$Orders='0';
                        $cart_permissions='0';
						/* $permission_wholeseller='0'; */
						$vanstock='0';
						$All_Orders='0';
						$Project_Details='0';
					}
					
/***********************************************************************************************************************/
					if($devicestatus=='Android')
					{
						$this->db->query("UPDATE dev_users SET deviceid='$device_id,' WHERE id='$userid'");
						
					}
					if($devicestatus=='ios')
					{
						$this->db->query("UPDATE dev_users SET iosdeviceid='$device_id,' WHERE id='$userid'");
						 
					}
					
					
				
				if($this->db->affected_rows())
				{
					echo json_encode(array("statusCode"=>200,"valid"=>true,"Message"=>"Login Success",'role'=>$role,'id'=>$userid,'user name'=>$username,'image'=>$userimage,"Categorie"=>$Categorie,"Orders"=>$Orders,"Project_Details"=>$Project_Details,"Catalogues"=>$Catalogues,"All_Orders"=>$All_Orders,'Orders_To_approve'=>$Orders_To_approve,'Quotes'=>$Qoutes,'vanstock'=>$vanstock,'Seecost'=>$See_Cost,'numberofawating'=>$numberofawating,$device_id,"Business_id"=>$business_id,'Addproduct'=>$Addproduct,'permission_wholeseller'=>$permission_wholeseller,'Wholeseller_engineer_id'=>$main_id,'BussinessName'=>$busi_name,'first_name'=>$firstname,'last_name'=>$lastname,'ViewWholesellerPage'=>$Haveornot,'publishKey'=>$key,'basic_user'=>$basic_user,'business_validity'=>$trial_expire_date,'Addtocart'=>$cart_permissions,'premissionbrand'=>$brandpage_pre,'premissioncard'=>$card));
				}
				else	
				{
					echo json_encode(array("statusCode"=>401,"Message"=>"Device Not Register","valid"=>false)); 
				}
			}
			
			else
			{
				$selected_data_again = $this->db->query('select * from `dev_users` where `email`="'.$email.'" ');
				$select_data_again = $selected_data_again->result();
				if($select_data_again)
				{
					echo json_encode(array("statusCode"=>401,"Message"=>"Password Is Wrong","valid"=>false)); 	
				}
				
				else
				{ 
					echo json_encode(array("statusCode"=>401,"Message"=>"User Not Found ","valid"=>false)); 
				} 
			}
		}
		else
		{
			echo json_encode(array("statusCode"=>401,"Message"=>"Please Fill All Fields","valid"=>false));
		}
?>