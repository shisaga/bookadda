<?php

include_once '../config.php';
$result = mysqli_query($link,"SELECT * FROM rent_security_deposit where status='received'");
$book_returned_count = mysqli_num_rows($result);

?>