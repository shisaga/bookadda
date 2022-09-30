<?php
session_start();
include '../config.php';

$status ='';
$username = $_SESSION['username'];
$book_id = $_SESSION['book_id'];

$sql = "SELECT * FROM rating WHERE email = '$username' AND book_id = $book_id";
$result = mysqli_query($link,$sql);

if(mysqli_num_rows($result)>0){

    $status = 0;

}

echo $status;


?>