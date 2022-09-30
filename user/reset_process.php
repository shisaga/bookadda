<?php

if(isset($_POST['submit']))
{
    $password = $_POST['password'];
    $email = $_SESSION['email'];
    $validcnfpass = $_POST['validcnfpass'];
    $validpass = $_POST['validpass'];
    if($validpass == true  && $validcnfpass == true)
    {
        $new_password = password_hash($password,PASSWORD_DEFAULT);
        $sql = "UPDATE login SET password='$new_password' WHERE username='$email'";
        mysqli_query($link,$sql);

        $to_email = $email;
		 $subject = "Password Successfully Changed!";
		 $body = "Hi,\nYour Password is Successfully Changed.\nThank You";
		 $headers = "From: bookadda.dev@gmail.com";
		 
		 
		 if(mail($to_email, $subject, $body))
         {
             unset($_SESSION['email']);
             unset($_SESSION['otp_session_pass']);
             header("Location: login.php");
         }
    }
}

?>

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


        $sql = "UPDATE login SET otp=$otp WHERE username='$email'";
        $stmt = mysqli_prepare($link,$sql);


    if(mysqli_stmt_execute($stmt))
    {
        $to_email = "$email";
        $subject = "OTP From Books Adda To Reset Your Password";
        $body = "Hello,\nTo Reset Your Password Your OTP is $otp\nThank You";
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
