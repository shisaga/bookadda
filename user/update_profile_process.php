<?php
session_start();
require_once '../config.php';
$status='';
	 if (isset($_POST['action'])) {

	 	
	 	$name = $_POST['name'];
	 	$mobile = $_POST['mobile'];
	 	$city = $_POST['city'];

	 	$q = "SELECT user_id,mobile FROM login WHERE mobile = '$mobile'";

	 	$r = mysqli_query($link,$q);

	 	if (mysqli_num_rows($r)>0) {
	 		
	 		$mob_error = 'true';

	 	}else{

	 	$sql = "UPDATE login SET name ='$name',mobile = '$mobile',city = '$city' WHERE user_id = $_SESSION[id]";
	 	$res = mysqli_query($link,$sql);

	 	if ($res) {
	 		
	 	$_SESSION['update_profile_msg'] ='<div class="alert alert-success">profile updated successfully</div>';
	 	}else{
	 		$_SESSION['update_profile_msg'] ='Error occured';
	 	}
	 	}
	 	
	 	
	 }

	echo $mob_error;

?>
