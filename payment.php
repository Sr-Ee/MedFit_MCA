<?php
session_start();
$patientid = $_SESSION['patient_id'];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.instamojo.com/v2/payment_requests/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER,array('Authorization: Bearer test_beac3b253a35d1c6fd08d77a294'));

$payload = Array(
  'purpose' => 'FIFA 16',
  'amount' => '2500',
  'buyer_name' => 'John Doe',
  'email' => 'foo@example.com',
  'phone' => '9999999999',
  'redirect_url' => 'http://www.example.com/redirect/',
  'send_email' => 'True',
  'webhook' => 'http://www.example.com/webhook/',
  'allow_repeated_payments' => 'False',
);

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);
curl_close($ch); 
$response = json_decode($response);
echo '<pre>';
print_r($response);




?>