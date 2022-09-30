<?php 

include_once 'header.php';
require_once 'logincheck.php';
include_once '../config.php';

$sql = "SELECT * FROM cart WHERE user_id = '$_SESSION[id]'";

if(mysqli_num_rows(mysqli_query($link,$sql)) === 0)
{
	echo "<script> window.location.href = 'index.php'; </script>";
	exit();
}
	if (isset($_POST['checkout'])) {
		
		$user_id = $_SESSION['id'];

		$name = $_POST['fullname'];
		$address = $_POST['address'].', '.$_POST['city'].' ,'.$_POST['pincode'].','.$_POST['state'];
		$mob = $_POST['mobile'];

		$sql = "INSERT INTO address(address_id,user_id,name,address,mobile,checkout_id) VALUES(?,?,?,?,?,?)";

		if ($stmt = mysqli_prepare($link,$sql)) {
			
			mysqli_stmt_bind_param($stmt,'iissss',$param_id,$param_user_id,$param_name,$param_address,$param_mob,$param_checkout_id);

			$param_id = '';
			$param_user_id = $user_id;
			$param_name = $name;
			$param_address = $address;
			$param_mob = $mob;
			$param_checkout_id = uniqid();
			$_SESSION['checkout_id'] = $param_checkout_id;

			if(mysqli_stmt_execute($stmt))
			{
				echo "<script> window.location.href = 'order_review.php';</script>";
			}else
			{
				echo "Error Occured";
			}
		}
	}
	
 ?>
<div class="container">
	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
			<span class="text-info" id="cmsg"> <?php if (isset($_SESSION['checkout_msg'])) {
				 echo $_SESSION['checkout_msg'];
				 unset($_SESSION['checkout_msg']);
			} ?> 
					<script type="text/javascript">
						$(function(){

							$('#cmsg').fadeOut(2000);
						});
					</script>
		</span>
			<h4 class="text-success"><strong>Checkout Page</strong></h4>
			<form method="post" id="checkoutform" style="position: relative;" >
				<div class="form-group">
					<label>Full Name</label>
					<input type="text" name="fullname" class="form-control" placeholder="Enter full name" required>
					<div class="invalid-feedback">please enter name</div>
					

				</div>
				<div class="form-group">
					<label>Address</label>
					<input type="text" name="address" class="form-control" placeholder="Enter Address" required>
					<div class="invalid-feedback">please enter address</div>

				</div>
				<div class="form-group">
					<label>City</label>
					<input type="text" name="city" class="form-control" placeholder="Enter City" required>
					<div class="invalid-feedback">please enter city</div>
				</div>
				<div class="form-group">
					<label>State</label>
					<input type="text" name="state" class="form-control" placeholder="Enter State" required>
					<div class="invalid-feedback">please enter state</div>
				</div>
				<div class="form-group">	
					<label>Pin Code</label>
					<input type="text" name="pincode" class="form-control" placeholder="Enter Pin Code" required>
					<div class="invalid-feedback">please enter pincode</div>
				</div>
				<div class="form-group">
					<label>Mobile Number</label>
					<input type="text" name="mobile" class="form-control" placeholder="Enter Mobile Number" required pattern="^[6-9]\d{9}$">
					<div class="invalid-feedback">please enter mobile number</div>

				</div>
				<div class="form-group">
					<button class="btn btn-success" id="checkout" type="submit" name="checkout">Continue to Payment</button>
				</div>
			</form>
		</div>
	
		<div class="col-sm-4"></div>
	</div>
</div>

<?php include_once 'footer.php'; ?>