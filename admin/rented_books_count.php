<?php

include_once '../config.php';
$result = mysqli_query($link,"SELECT * FROM rent_orders WHERE status != 'returned' AND status != 'cancelled'");
$rented_books = mysqli_num_rows($result);

?>