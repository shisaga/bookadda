<?php

include_once '../config.php';

$sql="SELECT * FROM orders WHERE refund_status=1";
$result = mysqli_query($link,$sql);
$cancel_count = mysqli_num_rows($result);

?>