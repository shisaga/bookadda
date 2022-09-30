<?php
session_start();
require_once '../config.php';
$name = $_POST['name'];
$email = $_SESSION['email'];
$mobile = $_POST['mobile'];
$password = $_POST['password'];
$output="";
if(empty($name) || empty($email) || empty($mobile) || empty($password))
{
  $output = '<div class="alert alert-danger">error occured try again</div>';
}else {

  
  
  $new_password = password_hash($password,PASSWORD_DEFAULT);
   //$param_password = $password;   //-----for normal password---
  
  
  $sql = "UPDATE login set username='$email',password='$new_password',name='$name',mobile=$mobile,flag=1 WHERE username= '$email'";
  $stmt = mysqli_prepare($link,$sql);

  if(mysqli_stmt_execute($stmt))
  {
    
    $to_email = "$email";
    $subject = "Successfully Registered!";
    $body = "Hello, \t".$name."\nYou Have Successfully Registered To Books Adda\nThank You";
    $headers = "From: bookadda.dev@gmail.com";
    mail($to_email, $subject, $body, $headers);

    $output = '<div class="alert alert-success">
    <div class="alert-header">Signup Successful</div>
    Taking you to login page. please wait .. <img src="images/ap.gif" width="100" height="100"></div>';

    unset($_SESSION['otp_session']);
    unset($_SESSION['email']);
  }else{
        $output = '<div class="alert alert-danger">Error Occured</div>';
  }

}

echo $output;


?>
