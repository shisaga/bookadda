<?php
require_once '../config.php';
require '../sendMail.php'
session_start();
$_SESSION['email'] = $_POST['email'];
$email = $_POST['email'];

$output="";
if(empty($email))
{
  $output = '<div class="alert alert-danger">Error Occured Try Again</div>';
}else {

    $otp = rand(100000,999999);


        $sql = "UPDATE login SET otp=$otp WHERE username='$email'";
        $stmt = mysqli_prepare($link,$sql);


    if(mysqli_stmt_execute($stmt))
    {
        $to_email = "$email";
        $subject = "OTP From Books Adda To Reset Your Password";
        $body = "Hello,\nTo Reset Your Password Your OTP is $otp\nThank You";
        sendMail($to_email,$subject,$body);
        // $headers = "From: bookadda.dev@gmail.com";
        // mail($to_email, $subject, $body, $headers);

        $output = '<div class="alert alert-success">
        <div class="alert-header">OTP Successfully Sent</div>
        Taking you to OTP verification page. Please Wait .. <img src="images/ap.gif" width="100" height="100"></div>';


    }else{
            $output = '<div class="alert alert-danger">Error Occured</div>';
    }

}

echo $output;


?>
