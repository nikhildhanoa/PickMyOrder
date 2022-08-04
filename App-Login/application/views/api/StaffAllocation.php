<?php $buss_id=$this->db->query("select business_id,username,password from dev_service_m8 where access_token !=''");
$buss_id=$buss_id->result_array();
   
   foreach($buss_id as $buss_data)
   {
	 
		$business_project_uuid=array();  
		$business_project_array=array(); 
		$business_project_id=array();
		$business_project_engineer_array=array();
		
		 $business_id=$buss_data['business_id'];
	    $username=$buss_data['username'];
		$password=$buss_data['password'];
		$token=base64_encode($username.":".$password); 

        


		   // get uuid from dev_projects 
		$uuid=$this->db->query("select uuid,id,engineer_array from  dev_projects where business_id='$business_id' and uuid !='' ");
		$uuid_array=$uuid->result_array();
	   
	   for($i=0;$i<count($uuid_array);$i++)
	   {	   
		$check_engineer_array=array(); 
		$business_project_uuid=$uuid_array[$i]['uuid'];
		$business_project_id=$uuid_array[$i]['id'];
		$business_project_engineer_array=$uuid_array[$i]['engineer_array'];
		$engineer_array=$business_project_engineer_array;
		$check_engineer_array=explode(',',$engineer_array);
		
		
		
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.servicem8.com/api_1.0/jobactivity.json?%24filter=job_uuid%20eq%20'".$business_project_uuid."'", 

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

		$response = curl_exec($curl);

		curl_close($curl);
		
		$data= json_decode($response);
		

	  
							
							for($j=0;$j<count($data);$j++)
							{
								$staff_uuid=$data[$j]->staff_uuid;
							
							//print_r($staff_uuid);die;
							
							
							$user_uuid=$this->db->query("select user_uuid,enginnerproject,dev_engineer.id id from  dev_users,dev_engineer where dev_users.id=user_id and user_uuid='$staff_uuid'");
							if($user_uuid->num_rows() && $staff_uuid!='')
							{	
								$engineerproject='';
								$user_uuid_array=$user_uuid->result_array();	
								echo $engineer_id=$user_uuid_array[0]['id'];
								echo $business_project_id;
								
								$engineerproject=$user_uuid_array[0]['enginnerproject'];
								
								
								
								
								
								
								if(!in_array($engineer_id,$check_engineer_array))
								{
									
									$check_engineer_array[]=$engineer_id; // adding engineer to avoid duplicacy
									
									
									if($engineer_array!='')
									{	$engineer_array=$engineer_array.','.$engineer_id;
									}
									else
									{	$engineer_array=$engineer_id;
									}
										
									$this->db->query("update dev_projects set engineer_array='$engineer_array' where id='$business_project_id'");
									
								$engineerproject=$engineerproject.$business_project_id.',';
									
									$this->db->query("update dev_engineer set enginnerproject='$engineerproject' where id='$engineer_id'");								
									
								}
								

								
								
								
								
							} 
							
							}
							
							
						
	   }
   
 }
?>