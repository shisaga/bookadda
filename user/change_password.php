<?php

	 include_once 'header.php';
	 require_once 'logincheck.php';
	 include_once '../config.php';

	 $old_password_error = $new_password_error = $cnfpass_error = $status ='';
	 $oldpassword = $newpassword = $cnfnewpassword = '';

 if (isset($_POST['submit'])) {
	 	
	 	
	 	if (empty($_POST['oldpassword'])) {
	 		
	 		$old_password_error = "<p class='text-danger'>please Enter old password</p>";
	 	}else{

	 		$oldpassword = test_input($_POST['oldpassword']);
	 	}


	 	if (empty($_POST['newpassword'])) {
	 		
	 		$new_password_error = "<p class='text-danger'>Please Enter new Password</p>";
	 	}else{

	 		$newpassword = test_input($_POST['newpassword']);
	 	}

	 	if (empty($_POST['cnfnewpassword'])) {
	 		
	 		$cnfpass_error = "<p class='text-danger'>Please confirm new Password</p>";
	 	}else{

	 		$cnfnewpassword = test_input($_POST['cnfnewpassword']);
	 	}

	 	if (empty($old_password_error) && empty($new_password_error) && empty($cnfpass_error)) {
	 		
	 		$sql = "SELECT user_id,username,password FROM login WHERE user_id = $_SESSION[id]";

	 		$res = mysqli_query($link,$sql);

	 		while ($row = mysqli_fetch_array($res)) {
	 			
	 			$pass = $row['password'];
	 		}

	 		if(!password_verify($oldpassword, $pass))
	 		{
	 			$status = "<p class='text-danger'>You entered wrong old password</p>";
	 		}else
	 		{
	 			if($newpassword !== $cnfnewpassword){

	 				$status = "<p class='text-danger'>Password did not match</p>";
	 			}else{

	 					
	 				$password = password_hash($newpassword, PASSWORD_DEFAULT);
	 				$sql = "UPDATE login SET password = '$password' WHERE user_id = $_SESSION[id]";

	 				$res = mysqli_query($link,$sql);

	 				if ($res) {
	 					
	 					$status = "<p class='text-success'>Password changed successfully</p>";
	 				}else
	 				{
	 					$status = "<p class='text-danegr'>Error occured</p>";
	 				}
	 			}
	 		}
	 	}
	 }

	function test_input($data)    
	{
    $data = trim($data);
    $data = stripslashes($data);
     return $data;
   }
?>

<div class="container">
	<div class="row">
		<div class="col-sm-4">	</div>
		<div class="col-sm-4 shadow-lg py-2">
			<span><?php echo $status;  ?></span>
			<span class="text-success"><strong>Change Password</strong></span>
			<br><br>
			<form method="post">
				<div class="form-group">
					<label>Enter old password</label>
					<input type="password" name="oldpassword" class="form-control">
					<span><?php echo $old_password_error; ?></span>
				</div>
				<div class="form-group">
					<label>Enter new password</label>
					<input type="password" name="newpassword" class="form-control">
					<span><?php echo $new_password_error; ?></span>
				</div>
				<div class="form-group">
					<label>Confirm new password</label>
					<input type="password" name="cnfnewpassword" class="form-control">
					<span><?php echo $cnfpass_error; ?></span>
				</div>
				<div class="form-group">
					<input type="submit" name="submit" class="btn btn-success" value="Change password">
				</div>
			</form>
		</div>
		<div class="col-sm-4">	</div>
	</div>
</div>


<?php require_once 'footer.php'; ?>