<?php

require_once 'header.php';
require '../config.php';

  $sql = "SELECT * FROM notification WHERE status = 0";
  $res = mysqli_query($link,$sql);
  $noti = mysqli_num_rows($res);

  echo $noti;

?>