<?php
require_once '../config.php';

$mobile = $_POST['mobile'];

$output="";
if(empty($mobile))
{
  $output = '<div class="alert alert-danger">error occured try again</div>';
}else {

  $sql = "SELECT * FROM login WHERE mobile = '$mobile'";

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
