<?php 
class DataModel extends CI_Model
{
	
	function Check_permision($userid){
	
		  $getuserid=$this->db->query("select * from dev_users where id=$userid ");
		  $result = $getuserid->result_array();
		  
			foreach($result as $admindetails)
			{
				$useradmin_permision=$admindetails['permission_super_Admin'];
				
				return($useradmin_permision);
			}
		
	}
	function Add_business($data){


		   $insert_business_query="insert into dev_business(  business_name,address,city,post_code,email,contact_name,contact_number,supplier_email,app_status,bussiness_logo,iswholeapp,iswholpageview,isdedicate,stripe_secretkey,stripe_publishkey,van_stock,Luckins,brandpage,invoice_management_premission) values('$data[0]','$data[1]','$data[14]','$data[2]','$data[3]','$data[4]','$data[5]','$data[12]','$data[13]','$data[16]','$data[17]','$data[18]','$data[19]','$data[20]','$data[21]','$data[22]','$data[23]','$data[24]','$data[25]')"; 
			$this->db->query($insert_business_query); 
		
		
		
		$select_business_id="select id from dev_business where email='$data[3]'";
		$business_id=$this->db->query($select_business_id);
		$business=$business_id->result_array();
		$bu_id=$business[0];
		$b_id=$bu_id["id"];
		$insert_account_query="insert into dev_account(business_id,contact_name,address,	post_code,email,contact_number,vat_number,acc_city)values('$b_id','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]','$data[11]','$data[15]')";
		return $this->db->query($insert_account_query);
	}
	function Select_All_business($business_id){
		if($business_id!=0)
		{
		 $Select_All_business_Query=$this->db->query("select *from dev_business where id=$business_id");
		}
		else
		{
			$Select_All_business_Query=$this->db->query('SELECT * FROM `dev_business`');
		}
		$All_business=$Select_All_business_Query->result_array();
		return($All_business);
		
	}
	function Select_All_dlcost($business_id){
		if($business_id!=0)
		{
		 $Select_All_dl_Query=$this->db->query("select *from dev_delevery where bussiness=$business_id");
		}
		else
		{
			$Select_All_dl_Query=$this->db->query('select *from dev_delevery');
		}
		$All_dl=$Select_All_dl_Query->result_array();
		return($All_dl);
		
	}
	
	function Select_All_users($business_id){
		if($business_id!=0)
		{
		$Select_All_users=$this->db->query("select *from dev_users where business_id='$business_id'");
		}
		else
		{
			$Select_All_users=$this->db->query('select *from dev_users where role="2"');
		}
		$All_users=$Select_All_users->result_array();
		return($All_users);
	}
   public function insert($table,$insert){
		$results = $this->db->insert($table, $insert);
		
	    $insertId = $this->db->insert_id();
		if($results){
		return $insertId;}
		else{
		return false;}
}
public function update($table,$arr,$where)
{
			$this->db->where($where);
			$update=$this->db->update($table, $arr);
			if($update)
			{
			return $update;
			}
			else
			{
			return false;
			}
}
public function delete($table,$id){
	   $this->db->where('id', $id);
	   $deleted = $this->db->delete($table); 
	   if($deleted){
		   return true;
	   }
		else{
			return false;
		}
}


public function permissionsForBusiness($bid){
	
	  
		$que=$this->db->query("select * from dev_Business_Plans where business_id=$bid ");
		 $result = $que->result_array();
			
			 foreach($result as $userdata)
			 {
			    $permission_store=$userdata['permission_store'];  
				$permission_deleverycost=$userdata['permission_deleverycost'];
				$permission_notifications=$userdata['permission_notifications'];
				$permission_categories=$userdata['permission_categories'];
				$permission_catologes=$userdata['permission_catologes'];
				$permission_projects=$userdata['permission_projects'];
				$permission_engineers=$userdata['permission_engineers'];
				$permission_suppliers=$userdata['permission_suppliers'];
				$permission_quotes=$userdata['permission_quotes'];
				$permission_orders=$userdata['permission_orders'];
				$permission_products=$userdata['permission_products'];
				$permission_vanstock=$userdata['permission_vanstock'];
				$permission_super_Admin=$userdata['permission_super_Admin'];
				$permission_ElectricalCatalogue=$userdata['permission_ElectricalCatalogue'];
				$permission_invoice=$userdata['permission_invoice'];


				$permission_array=array('permission_notifications'=>$permission_notifications,'permission_categories'=>$permission_categories,'permission_catologes'=>$permission_catologes,'permission_projects'=>$permission_projects,'permission_engineers'=>$permission_engineers,'permission_suppliers'=>$permission_suppliers,'permission_quotes'=>$permission_quotes,'permission_orders'=>$permission_orders,'permission_products'=>$permission_products,'permission_super_Admin'=>$permission_super_Admin,'permission_deleverycost'=>$permission_deleverycost,'permission_store'=>$permission_store,'permission_vanstock'=>$permission_vanstock,'permission_ElectricalCatalogue'=>$permission_ElectricalCatalogue,'permission_invoice'=>$permission_invoice);
				
				return($permission_array);
			 }
	}

public function CheckPermission($userid){
	
		$que=$this->db->query("select * from dev_users where id=$userid ");
		 $result = $que->result_array();
								
			 foreach($result as $userdata)
			 {
			     $permission_store=$userdata['permission_store'];  
				$permission_deleverycost=$userdata['permission_deleverycost'];
				$permission_notifications=$userdata['permission_notifications'];
				$permission_categories=$userdata['permission_categories'];
				$permission_catologes=$userdata['permission_catologes'];
				$permission_projects=$userdata['permission_projects'];
				$permission_engineers=$userdata['permission_engineers'];
				$permission_suppliers=$userdata['permission_suppliers'];
				$permission_quotes=$userdata['permission_quotes'];
				$permission_orders=$userdata['permission_orders'];
				$permission_products=$userdata['permission_products'];
				$permission_vanstock=$userdata['permission_vanstock'];
				$permission_super_Admin=$userdata['permission_super_Admin'];
				$permission_ElectricalCatalogue=$userdata['permission_ElectricalCatalogue'];
				$permission_invoice=$userdata['permission_invoice'];


				$permission_array=array('permission_notifications'=>$permission_notifications,'permission_categories'=>$permission_categories,'permission_catologes'=>$permission_catologes,'permission_projects'=>$permission_projects,'permission_engineers'=>$permission_engineers,'permission_suppliers'=>$permission_suppliers,'permission_quotes'=>$permission_quotes,'permission_orders'=>$permission_orders,'permission_products'=>$permission_products,'permission_super_Admin'=>$permission_super_Admin,'permission_deleverycost'=>$permission_deleverycost,'permission_store'=>$permission_store,'permission_vanstock'=>$permission_vanstock,'permission_ElectricalCatalogue'=>$permission_ElectricalCatalogue,'permission_invoice'=>$permission_invoice);
				
				return($permission_array);
			 }
	}
	function Get_Business_id($Business_name){
		$Select_Business_id=$this->db->query("select id from dev_business where business_name='$Business_name'");
		$Select_Business_id=$Select_Business_id->result_array();
		return($Select_Business_id[0]['id']);
	}

/***************** To send the notification to mobile **********/
public function send_notification($devices,$body,$compny)
{
	$myarr=array();
	 $mydeviceswithoutcomma=array();
	 $finalarray=array();
	$number_of_device=count($devices);
	 for($i=0;$i<$number_of_device;$i++)
	{
	$mydeviceswithoutcomma= explode(',',$devices[$i]['deviceid']);
	 $numsingleuseerdevicearray=count($mydeviceswithoutcomma);
	 for($j=0;$j<=$numsingleuseerdevicearray;$j++)
	 {
		 array_push( $finalarray,$mydeviceswithoutcomma[$j]);
	 }
	} 
    $finalarraykeys=array_keys(array_filter($finalarray));
	/*****************send notiication*********************/
	if($compny=='led')
	{
		//$API_ACCESS_KEY='AIzaSyBxJpvMY0jvTKZth6PahsTzYxHIvT0B9Bs';
		//$API_ACCESS_KEY='AIzaSyAe5GlVrlOdr3UYm29KrcRWl1PVGNOCXM4'; comment all id till scott says
	 $API_ACCESS_KEY='AAAAAO9ukG8:APA91bEmoA-YLlalWxeRbD431aasQWjB0CF6S4unYSIJKphJ6epck1Xj4iCYYPtC3gHSdHlKrwktSOGgK52dmNagj7sMMul2bjloOOXOftudZivj3J_9iSVzmObMMj0VthiIzIaZtg69';
	}
	if($compny=='pick')
	{
		//$API_ACCESS_KEY='AIzaSyBxJpvMY0jvTKZth6PahsTzYxHIvT0B9Bs';
		$API_ACCESS_KEY='AAAAAO9ukG8:APA91bEmoA-YLlalWxeRbD431aasQWjB0CF6S4unYSIJKphJ6epck1Xj4iCYYPtC3gHSdHlKrwktSOGgK52dmNagj7sMMul2bjloOOXOftudZivj3J_9iSVzmObMMj0VthiIzIaZtg69';
	}
	if($compny=='spark')
	{
		//$API_ACCESS_KEY='AIzaSyBxJpvMY0jvTKZth6PahsTzYxHIvT0B9Bs';
		//$API_ACCESS_KEY='AIzaSyDNhY_ANTkYax7sBiRrZNd0XlVNMGc-Fh8';comment all id till scott says
		$API_ACCESS_KEY='AAAAAO9ukG8:APA91bEmoA-YLlalWxeRbD431aasQWjB0CF6S4unYSIJKphJ6epck1Xj4iCYYPtC3gHSdHlKrwktSOGgK52dmNagj7sMMul2bjloOOXOftudZivj3J_9iSVzmObMMj0VthiIzIaZtg69';
	}
	
	//define( 'API_ACCESS_KEY', 'AIzaSyBxJpvMY0jvTKZth6PahsTzYxHIvT0B9Bs');
	 for($i=0;$i<count($finalarraykeys);$i++)
	 {
		 $value=$finalarraykeys[$i];
		 $msg = array
          (
		'body' 	=> $body,
		'title'	=> 'PickMyOrder',
		'sound' => 'default',
		'extra'=> '2'
		   );
	$fields = array
			(
				'to'=> $finalarray[$value],
				'notification'=> $msg,
				'data' =>$msg
			);
	
	$headers = array
			(
				"Authorization: key=$API_ACCESS_KEY",
				"Content-Type: application/json"
			);
			
		#Send Reponse To FireBase Server	
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
		 array_push($myarr,$result);
		curl_close( $ch );
	 } 
	 
     return $myarr;
}
/**********************************************check app is whole or not****************************/
public function CheckBussinessStatus()
{
		if(isset($_SESSION['Current_Business']))
		{
			$isWholeAppId=$_SESSION['Current_Business'];
			$resultData=$this->db->query("select *from dev_business where id='$isWholeAppId'");
			$Finaldata=$resultData->result_array();
			$checkappstatus=$Finaldata[0]['iswholeapp'];
			if($checkappstatus)
			{
				return 1;
			}	
			else{
				return 0;
			}	
		}

}
/***********************ios notifictaion*************************/
public function send_ios_notification($devices,$message)
{	
			$myarr=array();     
			$mydeviceswithoutcomma=array();
			$finalarray=array();
			$number_of_device=count($devices);
			
			for($i=0;$i<$number_of_device;$i++)
				{
					$mydeviceswithoutcomma= explode(',',$devices[$i]['iosdeviceid']);
					 $numsingleuseerdevicearray=count($mydeviceswithoutcomma);
					
					 for($j=0;$j<=$numsingleuseerdevicearray;$j++)
					 {
						 array_push( $finalarray,$mydeviceswithoutcomma[$j]);
					 }
				} 
			$finalarraykeys=array_keys(array_filter($finalarray));
			    
			 for($i=0;$i<count($finalarraykeys);$i++)
			 {
				 $value=$finalarraykeys[$i];
				 $passphrase = 'PushChat'; 
		 
					$ctx = stream_context_create();
					stream_context_set_option($ctx, 'ssl', 'local_cert','./assets/ForDevlopement.pem');
					stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
					 
					// Open a connection to the APNS server
					$fp = stream_socket_client(
					'ssl://gateway.sandbox.push.apple.com:2195', $err,  // For development
					// 'ssl://gateway.push.apple.com:2195', $err, // for production 
					$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx); 
					 
					if (!$fp)
					exit("Failed to connect ios: $err $errstr" . PHP_EOL);
					 
					//echo 'Connected to APNS' . PHP_EOL;
					 
					// Create the payload body
					$body['aps'] = array(
					'alert' => trim($message),
					'sound' => 'default'
					);
					 
					// Encode the payload as JSON
					$payload = json_encode($body);
					 
					// Build the binary notification
					$msg = chr(0) . pack('n', 32) . pack('H*',  trim( $finalarray[$value])) . pack('n', strlen($payload)) . $payload;
					 
					// Send it to the server
					$result = fwrite($fp, $msg, strlen($msg));
				     
					  array_push($myarr,$result);
				

					   
					// Close the connection to the server
					fclose($fp);
			 }
              return $myarr;
}
   /**********************************************/
   
   
   public function Insertservicem8($insert_array,$tablename)
   {
	  $this->db->insert($tablename,$insert_array); 
	  return $this->db->insert_id();
   }
   
   /**********************/
   public function UpdateTokenServiceM8($data_array,$tablename,$bid)
   {
	    $this->db->set($data_array);
        $this->db->where('business_id',$bid);
        $this->db->update($tablename);
   }
   /***************************/
   public function CheckTrileBusiness($Table,$business_id)
   {
	  $check_business=$this->db->query("select * from dev_business where id='$business_id'");
      $check_business=$check_business->result_array();
      $expire_date=$check_business[0]['expire_trial_time'];
      return $expire_date;	  
   }
   
   public function fetchLukinscategory($businees_id)
   {
	   //  'COM_TransCode' => 'A'
	 $array = array('COM_MajorCodeFlag' => '1');
	 $this->db->select('*');
     $this->db->from('dev_sql_CommodityCode');
     $this->db->where($array);
	 $this->db->like('COM_Code', '00000');
	 $this->db->order_by("COM_Description");
	 $result = $this->db->get();
	 $result =$result->result_array();
	 return $result;
   }
   
    public function fetchLukinssubcategory($Getcode)
   { 
      if($Getcode!='')
	  { 
       
	    $this->db->select('COM_Description ,COM_Code');
	    $this->db->from('dev_sql_CommodityCode');
		$this->db->where('COM_MajorCodeFlag', '1');
		$this->db->like('COM_Code',$Getcode,'after' );
		$this->db->not_like('COM_Code','00000','before');
		$this->db->order_by('COM_Description');
	     $result = $this->db->get();
	     $result = $result->result_array();
	     return $result;
	  }
   } 
   
   /// 
   
   public function FetchLukinsSubSubCategory($Getcode,$Getcode2)
   {    
	    $this->db->select('COM_Description ,COM_Code');
	    $this->db->from('dev_sql_CommodityCode');
		$this->db->where('COM_Code !=',$Getcode2 );
		$this->db->like('COM_Code',$Getcode,'after');
		$this->db->order_by('COM_Description');
	    $data = $this->db->get()->result_array();
	    return $data; 
   }
   /////////
   
   public function FetchLukinsManufacture($Getcode)
   {   
      $queee = $this->db->query=("select dev_sql_Manufacturer.MAN_Code, MAN_SupplierName  from dev_sql_ItemDetails, dev_sql_Manufacturer where  COM_Code=$Getcode and dev_sql_Manufacturer.MAN_Code=dev_sql_ItemDetails.MAN_Code group by dev_sql_Manufacturer.MAN_Code");
	
	   /*     $this->db->select('dev_sql_Manufacturer.MAN_Code, dev_sql_Manufacturer.MAN_SupplierName ');
         $this->db->from('dev_sql_ItemDetails');
		 $this->db->where('COM_Code',$Getcode);
		 
         $this->db->join('dev_sql_ItemPrice','dev_sql_ItemDetails.ITM_ItemCode = dev_sql_ItemPrice.ITM_ItemCode'); 
         $this->db->where($where_array);
		 $data = $this->db->get()->result_array();
	      
		  */
	
	
	  $result = $queee->result_array(); 
	  return $result;
	
   }
   
   /* 
			     $data = array('SubSubcategory_Com_code'=>$SubSubcategory_Com_code,'Manufacture_Man_Code'=>$Manufacture_Man_Code);
	  $curl = curl_init();
	  curl_setopt_array($curl, array(
	  CURLOPT_URL => "http://www.pickmyorder.uk/Sqlproducts.php",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => json_encode($data),
	  CURLOPT_HTTPHEADER => array(
		"cache-control: no-cache",
		"content-type: application/json",
		"postman-token: 2c70ac29-9dd9-4f02-08af-c0f0f3da3a1b"
	  ),
	));

	$response = curl_exec($curl);
	
	$err = curl_error($curl);

	curl_close($curl);
	return $response; */
   
    public function FetchLukinsProducts($SubSubcategory_Com_code,$Manufacture_Man_Code)
   {  
          if($Manufacture_Man_Code!='0')
		    {
				$where_array= array('COM_Code'=>$SubSubcategory_Com_code,'MAN_Code'=>$Manufacture_Man_Code);
			}
            else
			{
				$where_array= array('COM_Code'=>$SubSubcategory_Com_code);
			}	
		   
       $this->db->select('dev_sql_ItemDetails.ITM_Status,dev_sql_ItemDetails.ITM_ShortDesc,dev_sql_ItemDetails.ITM_ItemCode,dev_sql_ItemPrice.ITP_T1_Price');
         $this->db->from('dev_sql_ItemDetails');
         $this->db->join('dev_sql_ItemPrice','dev_sql_ItemDetails.ITM_ItemCode = dev_sql_ItemPrice.ITM_ItemCode'); 
         $this->db->where($where_array);
		 $data = $this->db->get()->result_array();
		 //print_r($this->db->last_query());die;
	      return $data;
		 
   }
   
  
	 
	 public function GetProductInfo($ID)
	 {
		 $this->db->select('dev_sql_ItemDetails.ITM_ShortDesc,dev_sql_ItemDetails.BNI_BrandName,dev_sql_ItemDetails.ITM_Dimensions,dev_sql_ItemDetails.TSI_InstallTime,dev_sql_Manufacturer.MAN_NameKey');
		 $this->db->from('dev_sql_ItemDetails');
		 $this->db->join('dev_sql_Manufacturer','dev_sql_ItemDetails.MAN_Code = dev_sql_Manufacturer.MAN_Code');
		 $this->db->where('dev_sql_ItemDetails.ITM_ItemCode',$ID);
		 $data = $this->db->get()->result_array();
		 
		 return $data;
		 
	 }
    
	  public function selectsqlproducts($val,$businees_id)
	  {
		
         
		$ids = implode(",",$val);
 
		 $this->db->select('Tsicode');
         $this->db->from('dev_products');
         $this->db->where('business_id',$businees_id);
         $this->db->where_in('Tsicode',$ids,FALSE);
		 $exist_products_array = $this->db->get()->result_array();
		foreach($exist_products_array as $duplicate_products)
		{
			$tsicode=$duplicate_products['Tsicode'];
			$val=array_diff($val, array($tsicode));


		}
		
		$ids = implode(",",$val);
      
		if(!empty($ids))
		{
                 
			$this->db->select('dev_sql_ItemDetails.ITM_ItemCode,dev_sql_ItemDetails.ITM_ShortDesc,dev_sql_ItemDetails.ITM_EAN1_Code,dev_sql_ItemDetails.ITM_Sortkey,dev_sql_ItemDetails.BNI_BrandName,dev_sql_ItemPrice.ITP_T1_Price,dev_sql_ItemDetails.COM_Code');
			$this->db->from('dev_sql_ItemDetails');
			$this->db->where_in('dev_sql_ItemDetails.ITM_ItemCode',$ids,FALSE);
			$this->db->join('dev_sql_ItemPrice','dev_sql_ItemPrice.ITM_ItemCode = dev_sql_ItemDetails.ITM_ItemCode'); 
			$data= $this->db->get()->result_array();
		}
		else
		{
			$data = "noproducts";
		}
		 
		
		//print_r($this->db->last_query());die;
		return $data;
		
	  }
	  
	  public function GetsupervisorOroperaiveIds($business_id)
	  {
		   ///  Operative ids  
		        $this->db->select('dev_engineer.id'); 
				$this->db->from('dev_engineer'); 
				$this->db->join('dev_engineer_permissions','dev_engineer.id = dev_engineer_permissions.engineer_id','INNER'); 
				$this->db->where('dev_engineer.business_id',$business_id);
                $this->db->where('dev_engineer_permissions.Operative',1);				
				$res = $this->db->get();
		        $res=$res->result_array();
		
		           $operativeids=""; 
				foreach( $res as $ress)
				{
					$operativeids .=$ress['id'].',';
				}
				$operativeids=rtrim($operativeids, ",");
			    

				/* update dev_engineer,`dev_engineer_permissions` set permissions=0 where dev_engineer.id=engineer_id and business_id=$business_id
				
				
				update dev_engineer,`dev_engineer_permissions` set permissions=0 where dev_engineer.id=engineer_id and businees_id=$business_id and Operative=1 */
				
				
				
                ///  Operative ids  
		        $this->db->select('dev_engineer.id'); 
				$this->db->from('dev_engineer'); 
				$this->db->join('dev_engineer_permissions','dev_engineer.id = dev_engineer_permissions.engineer_id','INNER'); 
				$this->db->where('dev_engineer.business_id',$business_id);
                $this->db->where('dev_engineer_permissions.Supervisor',1);				
				$ress = $this->db->get();
		        $ress=$ress->result_array();
		
		           $operativeids=""; 
				foreach( $ress as $resss)
				{
					$Supervisorids .=$resss['id'].',';
				}
				$Supervisorids=rtrim($Supervisorids, ",");
			    print_r($Supervisorids);die; 


				
		  
	  }
	  
	  
	  
	  
	  
}

?>


		