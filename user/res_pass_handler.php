<?php
session_start();
require_once '../config.php';
require '../sendMail.php';

$email = $_SESSION['email'];
$password = $_POST['password'];
$output="";

if(empty($password))
{
    $output = '<div class="alert alert-danger">Error Occured Try Again</div>';
}
else 
{
    $new_password = password_hash($password,PASSWORD_DEFAULT);
    //$param_password = $password;   //-----for normal password---
  
  
    $sql = "UPDATE login SET password='$new_password' WHERE username='$email'";
    $stmt = mysqli_prepare($link,$sql);

    if(mysqli_stmt_execute($stmt))
    {
        
        $to_email = $email;
        $subject = "Password Successfully Changed!";
        $body = "Hi,\nYour Password is Successfully Changed.\nThank You";
        sendMail($to_email,$subject,$body);
        // $headers = "From: bookadda.dev@gmail.com";
        
        // mail($to_email, $subject, $body);
        
        $output = '<div class="alert alert-success">
        <div class="alert-header">Signup Successful</div>
        Taking you to login page. please wait .. <img src="images/ap.gif" width="100" height="100"></div>';
        unset($_SESSION['email']);
        unset($_SESSION['otp_session_pass']);

    }
    else
    {
            $output = '<div class="alert alert-danger">Error Occured</div>';
    }

}

echo $output;


?>
