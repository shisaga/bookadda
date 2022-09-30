<?php
require_once '../config.php';


if (isset($_POST['email'])) {
	
	$email = $_POST['email'];
	$name = $_POST['name'];
	$msg = $_POST['msg'];

	$sql = "INSERT INTO contact VALUES ('','$email','$name','$msg')";

	$res = mysqli_query($link,$sql);

	if($res)
	{
		$output = '<div class="alert alert-success alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Your message has been sent successfully</div>';
	}else{
		$output = '<div class="alert alert-danger alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Your message could not be sent</div>';
	}

	echo $output;
}