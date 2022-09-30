<?php
session_start();
include_once ('../config.php');


$user_id = $_POST['userid'];
$order_id = $_POST['orderid'];
$payment_id = $_POST['payment_id'];
$date_of_purchase = $_POST['date_of_purchase'];
$penalty_amount = $_POST['amt'];
$sql = "SELECT * FROM login WHERE user_id = $user_id

$res = mysqli_query($link,$sql);

while ($row = mysqli_fetch_array($res)) {
	
	
	$mobile = $row['mobile'];
	
}

$sql = "INSERT INTO penalty_payment(penalty_id,user_id,order_id,date_of_payment,payment_id,penalty_amount) VALUES('','$user_id','$order_id','$date_of_purchase','$payment_id','$penalty_amount')";
$insert_data = mysqli_query($link,$sql);

if($insert_data) {
    $to_email = $email;
	$subject = "Penalty Payment Recieved";
	$body = "Hi, ". $name. "\nYou Have Successfully Paid the Penalty"."\n"."With Order Id : ".$param_orderid."\nPayment Id : ".$payment_id;
	$headers = "From: bookadda.dev@gmail.com";				 
	mail($to_email, $subject, $body, $headers);



	$fields = array(
		"sender_id" => "TXTIND",
		"message" => $body,
		"route" => "v3",
		"numbers" => $mobile,
	);
	
	$curl = curl_init();
	
	curl_setopt_array($curl, array(
	CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_SSL_VERIFYHOST => 0,
	CURLOPT_SSL_VERIFYPEER => 0,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => json_encode($fields),
	CURLOPT_HTTPHEADER => array(
		"authorization: WKzcJltoR14EmyHhnsBpk6QMvPaZb2dONXGgS859Yx3UAITir79KygV5mEP4OBpLuacneHCNRZIs3zD6",
		"accept: */*",
		"cache-control: no-cache",
		"content-type: application/json"
	),
	));
	
	$response = curl_exec($curl);
	$err = curl_error($curl);
	
	curl_close($curl);
	
	
}



            
?>




