<?php

require '../config.php';

  $sql = "SELECT * FROM notification WHERE status = 0";
  $res = mysqli_query($link,$sql);
  $noti = mysqli_num_rows($res);
  if($res){
    $noti = mysqli_num_rows($res);
  }

  return $noti;

?>