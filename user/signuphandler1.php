<?php
require_once '../config.php';
session_start();
$_SESSION['email'] = $_POST['email'];
$email = $_POST['email'];

$output="";
if(empty($email))
{
  $output = '<div class="alert alert-danger">Error Occured Try Again</div>';
}else {

    $otp = rand(100000,999999);


        $sql = "INSERT INTO login VALUES ('','$email','','','','',$otp,0) ON DUPLICATE KEY UPDATE 
        username = '$email',
        otp = $otp";
        $stmt = mysqli_prepare($link,$sql);


    if(mysqli_stmt_execute($stmt))
    {
        $to_email = "$email";
        $subject = "OTP For Books Adda";
        $body = "Hello,\nFor Successful Registration To Books Adda Your One Time Password is $otp\nThank You";
        $headers = "From: bookadda.dev@gmail.com";
        mail($to_email, $subject, $body, $headers);

        $output = '<div class="alert alert-success">
        <div class="alert-header">OTP Successfully Sent</div>
        Taking you to OTP verification page. Please Wait .. <img src="images/ap.gif" width="100" height="100"></div>';


    }else{
            $output = '<div class="alert alert-danger">Error Occured</div>';
    }

}

echo $output;


?>
