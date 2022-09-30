<?php
session_start();
require_once '../config.php';
$rating = $_POST['rating'];
$review_title = $_POST['review_title'];
$user_email = $_POST['email'];
$review = $_POST['user_review'];
$book_id = $_SESSION['book_id'];
$date = date('d-m-y');
$time =  date('h:i:sa');



$sql = "INSERT INTO `rating`(`id`, `email`, `rating_title`, `rating`, `review`, `book_id`,`date`,`time`) VALUES ('','$user_email','$review_title',$rating,'$review',$book_id,'$date','$time')";
$res = mysqli_query($link,$sql);
if($res == true)
{
    $out = 'true';
}else{
    $out = 'false';
}

echo $out;
?>