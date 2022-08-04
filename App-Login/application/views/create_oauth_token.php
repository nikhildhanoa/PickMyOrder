<?php 
$bid= $this->uri->segment(2);
//print_r($bid);die;
if(isset($_REQUEST['code']))
	{	

   
	
	
	$code=$_REQUEST['code'];
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://go.servicem8.com/oauth/access_token',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	   CURLOPT_POSTFIELDS => array('client_id' => '862838','client_secret' => 'd857b45aca7d4e228e371d45be5b1a0b','grant_type' => 'authorization_code','code' => $code,'redirect_uri' => 'https%3A%2F%2Fapp.pickmyorder.co.uk%2FCreateOauthToken/'.$bid), 
	  
	    //?business_id='.$bid
	  
	  /* CURLOPT_POSTFIELDS => array('client_id' => '862838','client_secret' => 'd857b45aca7d4e228e371d45be5b1a0b','grant_type' => 'authorization_code','code' => $code,'redirect_uri' => 'https%3A%2F%2Fpickmyorder.co.uk%2FTest%2Fcreate_oauth_token.php'),  */
	));

	$response = curl_exec($curl);

	curl_close($curl);
	 $response;
   
   $data=json_decode($response);
   // print_r($data);die; 
   
        $access_token=$data->access_token;
        $refresh_token=$data->refresh_token;
           $tablename='dev_service_m8';
       $data_array=array('access_token'=>$access_token,'refresh_token'=>$refresh_token);  
         $this->DataModel->UpdateTokenServiceM8($data_array,$tablename,$bid);
   
}
else
{ 

   header('location:https://go.servicem8.com/oauth/authorize?response_type=code&client_id=862838&scope=staff_locations%20staff_activity%20publish_sms%20publish_email%20vendor%20vendor_logo%20vendor_email%20read_locations%20manage_locations%20read_staff%20manage_staff%20read_customers%20manage_customers%20read_customer_contacts%20manage_customer_contacts%20read_jobs%20manage_jobs%20create_jobs%20read_job_contacts%20manage_job_contacts%20read_job_materials%20manage_job_materials%20read_job_categories%20manage_job_categories%20read_job_queues%20manage_job_queues%20read_tasks%20manage_tasks%20read_schedule%20manage_schedule%20read_inventory%20manage_inventory%20read_job_notes%20publish_job_notes%20read_job_photos%20publish_job_photos%20read_job_attachments%20publish_job_attachments%20read_inbox%20read_messages%20manage_notifications%20manage_templates%20manage_badges%20read_assets%20manage_assets&redirect_uri=https%3A%2F%2Fapp.pickmyorder.co.uk%2FCreateOauthToken/'.$bid ); 


/* 	
header('location:https://go.servicem8.com/oauth/authorize?response_type=code&client_id=862838&scope=staff_locations%20staff_activity%20publish_sms%20publish_email%20vendor%20vendor_logo%20vendor_email%20read_locations%20manage_locations%20read_staff%20manage_staff%20read_customers%20manage_customers%20read_customer_contacts%20manage_customer_contacts%20read_jobs%20manage_jobs%20create_jobs%20read_job_contacts%20manage_job_contacts%20read_job_materials%20manage_job_materials%20read_job_categories%20manage_job_categories%20read_job_queues%20manage_job_queues%20read_tasks%20manage_tasks%20read_schedule%20manage_schedule%20read_inventory%20manage_inventory%20read_job_notes%20publish_job_notes%20read_job_photos%20publish_job_photos%20read_job_attachments%20publish_job_attachments%20read_inbox%20read_messages%20manage_notifications%20manage_templates%20manage_badges%20read_assets%20manage_assets&redirect_uri=https%3A%2F%2Fpickmyorder.co.uk%2FTest%2Fcreate_oauth_token.php');  */
  
}	
?>