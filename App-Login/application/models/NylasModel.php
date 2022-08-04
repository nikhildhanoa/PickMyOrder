<?php 
class NylasModel extends CI_Model
{
	
	function GetTokenFroNylas($data){
		
	  $curl = curl_init();
	  curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://api.nylas.com/oauth/token',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS =>$data,
	  CURLOPT_HTTPHEADER => array('Authorization: Basic 99hxybm4oikuox0ncalmrpqhc ','Content-Type: application/json'),
	  
		));
		
	 $response = curl_exec($curl);
	/*  $dataq=curl_getinfo($ch, CURLINFO_HTTP_CODE);
	 var_dump($dataq);die; */
	 curl_close($curl);
	 
	return $response=json_decode($response);
		
	}
	
	function GetFileIdFromNylas($autharray)
	{
		$curl = curl_init();
	 curl_setopt_array($curl, array(
	 CURLOPT_URL => 'https://api.nylas.com/messages',
	 CURLOPT_RETURNTRANSFER => true,
	 CURLOPT_ENCODING => '',
	 CURLOPT_MAXREDIRS => 10,
	 CURLOPT_TIMEOUT => 0,
	 CURLOPT_FOLLOWLOCATION => true,
	 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	 CURLOPT_CUSTOMREQUEST => 'GET',
	 CURLOPT_HTTPHEADER =>$autharray,));
     $response = curl_exec($curl);
     curl_close($curl);
    return $response=json_decode($response);
	
	}
	
	function GetNylasAccountStatus($autharray)
	{
	  $curl = curl_init();
	  curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://api.nylas.com/account',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'GET',
	  CURLOPT_HTTPHEADER => $autharray,
     ));
    

   $response = curl_exec($curl);

    curl_close($curl);
   return $response=json_decode($response);
	
	}
	
	public function TrigerEmailFileAttachment($autharray,$message_id)
	{
		
	  $curl = curl_init();
	  curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://api.nylas.com/messages/'.$message_id.'',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  curl_setopt($curl,CURLOPT_RETURNTRANSFER, TRUE),
	  CURLOPT_CUSTOMREQUEST => 'GET',
	  CURLOPT_HTTPHEADER =>$autharray,
	));

	   $response = curl_exec($curl);
	   $check= curl_getinfo($curl);
	   curl_close($curl);

	$key=array('response'=>$response,'check'=>$check);	
	 return $key;	
		
	}	
	
	public function DeleteNyalsUser($NylasccountId)
	{
		$curl = curl_init();

    curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.nylas.com/a/9hsegpgpitl900z3u1zqsawhn/accounts/'.$NylasccountId.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'DELETE',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Basic OTloeHlibTRvaWt1b3gwbmNhbG1ycHFoYzo='
  ),
));

$response = curl_exec($curl);
$check= curl_getinfo($curl);
curl_close($curl);
$key=array('response'=>$response,'check'=>$check);	
	 return $key;	
	}
	
	
}

?>


		