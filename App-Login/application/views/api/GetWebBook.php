<?php if ($_REQUEST['mode'] == 'subscribe' && $_REQUEST['challenge']) {
    echo $_REQUEST['challenge'];
}else{

 $json = file_get_contents('php://input');

 $data = json_decode($json);

$bid= $this->uri->segment(2);

$object=$data->object;
   /*******************************/

                $buss_id=$this->db->query("select username,password from dev_service_m8 where business_id='$bid'");
                  $buss_id=$buss_id->result_array();

                 $username=$buss_id[0]['username'];
	               $password=$buss_id[0]['password'];
	             $token=base64_encode($username.":".$password);
				 
				

	/******************************/		  
 if($object=='JOB')
{	
   $entry=$data->entry;
   $uuid=$entry[0]->uuid;
   $changed_fields=$entry[0]->changed_fields;
   $allfields=implode(',',$changed_fields);
   
          $to = "nikhil.scorpsoft@gmail.com";
				$headers = "From: webmaster@example.com" . "\r\n" .
				"CC: somebodyelse@example.com";
			  
 
   if(in_array('uuid',$changed_fields))
   {
	  
			$curl = curl_init();

			curl_setopt_array($curl, [
			  CURLOPT_URL => "https://api.servicem8.com/api_1.0/job/".$uuid.".json",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "GET",
			  CURLOPT_HTTPHEADER => [
				"Accept: application/json",
				"Authorization: Basic $token"
			  ],
			]);

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
			  echo "cURL Error #:" . $err;
			} else {
			   
			  $data2 = json_decode($response);
			   
			 $uuid=$data2->uuid;  
			 $company_uuid=$data2->company_uuid;  
			 $job_address=$data2->job_address;
			 $status=$data2->status;
			 
			 /* $billing_address=$data2->billing_address;  // scott ask to remove billing address */
			 
			 $billing_address=$data2->job_address;
			 
			 
			 $geo_city=$data2->geo_city;
			 $job_id=$data2->generated_job_id;
			 
			
			$customer_name='NA';
			//$contact_number='NA';
			$city='NA';
			$postcode='NA';
			
			 if($company_uuid!='')  
			{
				
					$curl = curl_init();

					curl_setopt_array($curl, array(
					  CURLOPT_URL => 'https://api.servicem8.com/api_1.0/companycontact.json',
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => '',
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 0,
					  CURLOPT_FOLLOWLOCATION => true,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => 'GET',
					  CURLOPT_HTTPHEADER => array(
						"Authorization: Basic $token"
					  ),
					));

					$responseee = curl_exec($curl);

					curl_close($curl);
					 $responseee;
					 
					$responseee= json_decode($responseee);
                     //print_r($responseee);die;
                     for($i=0;$i<count($responseee);$i++)
						{
                      $company_uuidd=$responseee[$i]->company_uuid;
					  $type=$responseee[$i]->type;
					  
					  if($type=="Tenant" || $company_uuid == $company_uuidd)
					  {
						  $mobile=$responseee[$i]->mobile;
						  $email=$responseee[$i]->email;
						  break;
					  }
					 else
					 {
						$mobile='NA';
						$email='NA';
						
					 }	 
						  
					  
					}
					  
					  /**********************/
					  
					
					
					
					$curl = curl_init();

					curl_setopt_array($curl, [
		    CURLOPT_URL => "https://api.servicem8.com/api_1.0/company/".$company_uuid.".json",
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => "",
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 30,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => "GET",
					  CURLOPT_HTTPHEADER => [
						"Accept: application/json",
						"Authorization: Basic $token"
					  ],
					]);

					$response = curl_exec($curl);
					$err = curl_error($curl);

					curl_close($curl);

					if ($err) {
					  echo "cURL Error #:" . $err;
					} else {
					  $response;
					 
					  $data3 = json_decode($response);
					 
					  $name=$data3->name;	  
					  $address_postcode='NA';
					  $address_city='NA';
					  
					 /* $address_postcode=$data3->address_postcode;
					  if($address_postcode=='') $address_postcode='n/a'; 
					   $address_city=$data3->address_city;
					   if($address_city=='') $address_city='n/a';*/
				 
					}	
								
							
				
			}
			  
			  
			  
			 
				
		  
			}
			$name=$name.' '.'#'.$job_id;
			
			$project_array=array('business_id'=>$bid,'project_name'=>$name,'customer_name'=>$name,'address'=>$job_address,'Delivery_Address'=>$billing_address,'delivery_postcode'=>$address_postcode,'city'=>$city,'delivery_city'=>$address_city ,'contact_number'=>$mobile,'email_address'=>$email,'uuid'=>$uuid,'post_code'=>$postcode,'m8_status'=>$status);
    $job_project_insert=$this->db->insert('dev_projects',$project_array); 

	   
   }
   if(in_array('status',$changed_fields))
   {   
		$curl = curl_init();

			curl_setopt_array($curl, [
			  CURLOPT_URL => "https://api.servicem8.com/api_1.0/job/".$uuid.".json",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "GET",
			  CURLOPT_HTTPHEADER => [
				"Accept: application/json",
				"Authorization: Basic $token"
			  ],
			]);

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
			  echo "cURL Error #:" . $err;
			} else {
			   
				  $data2 = json_decode($response);
				   
				 $uuid=$data2->uuid;  
				 
				 $status=$data2->status;
				  $res=$this->db->query("select * from dev_projects where uuid='$uuid'");
				  if($res->num_rows())
				  {	  
								 $data=array('m8_status'=>$status);
								$this->db->where('uuid',$uuid);
								$this->db->update('dev_projects',$data);
				  }
				 
				 
				 
				 
			}
   }
  
   	
   

	
	
}


	
}
?>