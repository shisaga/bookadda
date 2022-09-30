<?php
session_start();
require_once '../config.php';
$action = $_POST['action'];

switch ($action) {
	case 'otp_match':
		
			if ($_SESSION['otp'] == $_POST['otp']) {
				
				echo 1;
			}
		break;

		case 'reset_pass':

			$new_pass = $_POST['new_password'];

			$enc_password = password_hash($new_pass,PASSWORD_DEFAULT);

			$sql = "UPDATE login SET password ='$enc_password' WHERE username='$_SESSION[user]'";

			$res = mysqli_query($link,$sql);

			if ($res) {
			
					echo "<span class='alert alert-success w-100'>Password Reset Successful.</span>";
			}else{

				echo "<span class='alert alert-danger'>Error Occured. Try Again</span>";
			}



		break;
	
	default:
		# code...
		break;
}


?>