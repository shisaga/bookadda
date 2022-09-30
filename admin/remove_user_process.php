
<?php
require '../config.php';
if (isset($_POST['action'])) {
  $action = $_POST['action'];
}


if($action =='remove_book'){
  $user_id = $_POST['book_id'];
  $sql = "DELETE FROM login WHERE user_id = $user_id";
  $res = mysqli_query($link,$sql);
  if($res){
    echo "Deleted Successfully";
    // $to_email = $email;
	// $subject = "Order Successfully Cancelled And Refunded!";
	// $body = "Hello, ". $name. "\nYour Order Has been successfully cancelled"."\n"."and Your Amount Will be Refunded within next 4-5 business days.\nOrder Id : ".$order_id_update."\n";
    // sendMail($to_email,$subject,$body);

  }
}


 ?>
