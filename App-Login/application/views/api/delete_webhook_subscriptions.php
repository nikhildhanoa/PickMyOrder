<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.servicem8.com/webhook_subscriptions',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('object' => 'company'),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer 64334-euw2-e81e9162708fc857f58302ac26c90dd87d451f88'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;