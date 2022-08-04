<?php $buss_id=$this->db->query("select business_id from dev_service_m8 where access_token !=''");
$buss_id=$buss_id->result_array();
   
   foreach($buss_id as $buss_data)
   {
	 
	$business_project_uuid=array();  
	$business_project_array=array(); 
	$business_project_id=array();
	$business_project_engineer_array=array();
	
	$business_id=$buss_data['business_id'];

	   // get uuid from dev_projects 
    $uuid=$this->db->query("select uuid,id,engineer_array from  dev_projects where business_id='$business_id' and uuid !='' ");
    $uuid_array=$uuid->result_array();
   
   for($i=0;$i<count($uuid_array);$i++)
   {	   
     
	$business_project_uuid[]=$uuid_array[$i]['uuid'];
	$business_project_id[]=$uuid_array[$i]['id'];
	$business_project_engineer_array[]=$uuid_array[$i]['engineer_array'];
	
   }
  
   
		
	
	

      //get-job-allocation-all
       
				   $curl = curl_init();

			  curl_setopt_array($curl, [
			  CURLOPT_URL => "https://api.servicem8.com/api_1.0/joballocation.json",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "GET",
			  CURLOPT_HTTPHEADER => [
				"Accept: application/json",
				"Authorization: Basic c2NvdHRAcGlja215b3JkZXIuY28udWs6YmY2YWFlNTUtZTE5Yi00MDNlLThiZGEtMWM4ZjRlMmMwYzFi"
			  ],
			]);

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
			  echo "cURL Error #:" . $err;
			} else {
			
			  $jobs= json_decode($response); 
			  
			  
			    
			  for($i=0;$i<count($jobs);$i++)
			  {	  
		         	
				 	$jobs[$i]->job_uuid;
					
					if(in_array($jobs[$i]->job_uuid,$business_project_uuid))
					{
						   
						
						
						
						$position=array_search($jobs[$i]->job_uuid,$business_project_uuid);
						
						$project_id=$business_project_id[$position];
						
						$engineer_array=$business_project_engineer_array[$position]; // comma seperated engineer ids in project
						
						$staff_uuid=$jobs[$i]->staff_uuid;
						
						$user_uuid=$this->db->query("select user_uuid,enginnerproject,dev_engineer.id id from  dev_users,dev_engineer where dev_users.id=user_id and user_uuid='$staff_uuid'");
						if($user_uuid->num_rows() && $staff_uuid!='')
						{	
							$engineerproject='';
							$user_uuid_array=$user_uuid->result_array();	
							$engineer_id=$user_uuid_array[0]['id'];
							
							$engineerproject=$user_uuid_array[0]['enginnerproject'];
							
							
							$check_engineer_array=explode(',',$engineer_array);
							
							
							
							
							if(!in_array($engineer_id,$check_engineer_array))
							{
								$check_engineer_array[]=$engineer_id;
								
								
								
								if($engineer_array!='')
								{	$engineer_array=$engineer_array.','.$engineer_id;
								}
								else
								{	$engineer_array=$engineer_id;
								}
									
							 	$this->db->query("update dev_projects set engineer_array='$engineer_array' where id='$project_id'");
								
							$engineerproject=$engineerproject.$project_id.',';
								
                                $this->db->query("update dev_engineer set enginnerproject='$engineerproject' where id='$engineer_id'");								
								
							}
							

							
							
							
							
						}
						
						
						
					}
						
			  }
			 
			 
			  
			}
			
		
			
		
			
   }	
   	


?>