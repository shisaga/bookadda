<?php
require_once '../config.php';
function fetch($link,$sql)
{
  $result=$link->query($sql);

  return $result;

}
 ?>
