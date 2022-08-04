<?php



        //check Current_Business
				
				if(isset($_SESSION['Current_Business']))
			   {
				   $bid=$_SESSION['Current_Business'];
				 
				 
			   }
			  else
			  { 
				   $bid=$_SESSION['status']['business_id'];
				 
			  }

                 $buss_id=$this->db->query("select username,password from dev_service_m8 where business_id='$bid'");
                  $buss_id=$buss_id->result_array();

                 $username=$buss_id[0]['username'];
	               $password=$buss_id[0]['password'];
	             $token=base64_encode($username.":".$password); 
  
  
	            
         ///////////////////////////////////////
			$curl = curl_init();

			curl_setopt_array($curl, [
			  CURLOPT_URL => "https://api.servicem8.com/api_1.0/staff.json",
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
			}
			
			$m8Staff= json_decode($response);
			
		
			
			for ($i = 0; $i < count($m8Staff); $i++) {  
			
                $uuid= $m8Staff[$i]->uuid;
				$first= $m8Staff[$i]->first;
				$last= $m8Staff[$i]->last;
				$email= $m8Staff[$i]->email;
				$mobile= $m8Staff[$i]->mobile;
				$user_name=$first.' '.$last;
				
				$Generatepassword= uniqid();
				
				
				//send password to all users
				
				$to = $email;
				$headers = 'From: noreply@pickmyorder.co.uk';
			 	mail($to,"Auto Generate password",$Generatepassword,$headers);  
				
				
				//**********closed***********
				
				
			
			//**************closed****************	
			
			$user_array=array('user_name'=>$user_name,'email'=>$email,'phn_numer'=>$mobile,'role'=>3,'user_uuid'=>$uuid,'password'=>$Generatepassword,'business_id'=>$bid,'person_name'=>$user_name,'from_bussi'=>$bid,'is_supervisor'=>0);
			
				
				$query=$this->db->query("select * from  dev_users where user_uuid ='$uuid' ");
				 $data=$query->result_array();
				 
				if(empty($data))
				{
					$this->db->insert('dev_users',$user_array);
					$last_insert_id=$this->db->insert_id();
					
					$eng_array=array('user_id'=>$last_insert_id,'user_name'=>$user_name,'name'=>$user_name,'email'=>$email,'password'=>$Generatepassword,'business_id'=>$bid);
					$success=$this->db->insert('dev_engineer',$eng_array);
					$engineer_id=$this->db->insert_id();
					
					$eng_ids_array=array('engineer_id'=>$engineer_id,'Supervisor'=>0,'Operative'=>1,'All_orders'=>1,'Orders_to_Approve'=>0,'See_costs'=>1,'limit_order_per_day'=>100000,'single_order_limit'=>100000,'status_meterial_cost'=>0,'Categories'=>1,'Orders'=>1,'Project_details'=>1,'Quotes'=>0,'Catalogues'=>1,'AddProduct'=>0,'Wholeseller'=>0,'atradeya_trade'=>'','atradeya_retail'=>'');
					$success=$this->db->insert('dev_engineer_permissions',$eng_ids_array);	
					
				}
				
			
              }
			  
			   print_r(' Import Staff Successfully');
                echo "<a href='integrateServiceM8'>BACK</a>";
			  
?>