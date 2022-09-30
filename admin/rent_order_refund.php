<?php

include_once '../config.php';

$sql="SELECT * FROM rent_orders WHERE refund_status=1";
$result = mysqli_query($link,$sql);
$rent_cancel_count = mysqli_num_rows($result);

?>