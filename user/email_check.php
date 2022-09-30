<?php
require_once '../config.php';

$email = $_POST['email'];

$output="";
if(empty($email))
{
  $output = '<div class="alert alert-danger">error occured try again</div>';
}else {

  $sql = "SELECT * FROM login WHERE username = '$email' AND flag = 1";

$result = mysqli_query($link,$sql);
  if(mysqli_num_rows($result)>0)
  {
    $output = 1;
  }else{
      $output = 0;
  }

}

echo $output;


?>
