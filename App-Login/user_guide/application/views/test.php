<?php


function fun(){
define( 'API_ACCESS_KEY', 'AIzaSyCyb6qIGVTnmP9MmSKXklBlBKcsBPFEAgE');
 //   $registrationIds = ;
#prep the bundle
     $msg = array
          (
		'body' 	=> 'Firebase Push Notification',
		'title'	=> 'Vishal Thakkar',
             	
          );
	$fields = array
			(
				'to'		=> 'fuUYeipWXiU:APA91bGtRLltDOuRaGQT8xhRCHYY9uHzchTHl31Efr9Rnicu5PqzQeSWjCLZWY4JGocqul_ViiP8lNLkG7HjI6Ya7sjicuTFIDFC1-J5ePw-cOBY3OOCYQjSjTpcJ0_pwV3qkjRzdg10',
				'notification'	=> $msg
			);
	
	
	$headers = array
			(
				'Authorization: key=' . API_ACCESS_KEY,
				'Content-Type: application/json'
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
		echo $result;
		curl_close( $ch );
}
fun();
?>
