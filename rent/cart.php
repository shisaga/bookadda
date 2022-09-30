<?php

include_once 'header_rent.php';
include_once '../user/logincheck.php';
include_once '../config.php';
$user_id = $_SESSION['id'];
$status = '';
if (isset($_POST['remove'])) {
	
	$book_id = $_POST['book_id'];

	$sql = "DELETE FROM rent_cart WHERE user_id = $user_id AND book_id= $book_id";
	$result = mysqli_query($link,$sql);
	if($result){
		$status = '<div class="alert alert-success">Item removed from cart</div>';
	}else{
		$status = '<div class="alert alert-danger">Cannot  remove item from cart</div>';
	}
}

	if (isset($_POST['update'])) {
	$available_quantity=0;
	$book_id = $_POST['book_id'];
	$days = $_POST['days'];
	$quantity = $_POST['quantity'];
	$price = $_POST['price'];
	$total = (float)$days*(float)$price;
	$q = "SELECT * FROM rent_books WHERE id = $book_id";
	$res = mysqli_query($link,$q);
	if($res){
		while($row = mysqli_fetch_array($res)){
			$available_quantity  = $row['quantity'];
		}

		if($available_quantity < $quantity){
			$status = '<div class="alert alert-warning">Quantity is not availabe to add. Try to add less quantity</div>';

		}else{
			$sql = "UPDATE rent_cart SET days = $days,total_price = $total WHERE user_id = $user_id AND book_id = $book_id";
			$result = mysqli_query($link,$sql);
			if($result){
				$status = '<div class="alert alert-success">Cart updated</div>';
			}else{
				$status = '<div class="alert alert-danger">Cannot upadte cart</div>';
			}
		}
	}

	
}
?>
<style>
.security_box {
  position: relative;
  display: inline-block;

}

.security_box .security_message {
opacity:0.5;
  visibility: hidden;
  width: 200px;
  background-color: blue;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;
  position: absolute;
  z-index: 1;
  top: -5px;
  right: 105%;
  margin-left: -60px;
}

.security_box .security_message::after {
  content: "";
  position: absolute;
  top: 12%;
  left: 100%;
  margin-top: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: transparent transparent transparent blue;
}
.security_box:hover .security_message {
  visibility: visible;
}
</style>
<div class="container">
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<span><?php echo $status; ?></span>
			<?php
			$sql = "SELECT * FROM rent_cart WHERE user_id = $user_id";
			$result = mysqli_query($link,$sql);

			if (mysqli_num_rows($result)<1) {
				
				echo "<h3 class='text-success'>Your Cart is empty </h3>";
				echo "<img src='images/empty.png'>";
			}else
			{
				?>

				<h3 class="text-success">My Shopping Cart</h3>
			<table class="table">
				<tr>
					<td>PRODUCT</td>
					<td>PRICE</td>
					<td>QUANTITY</td>
					<td>TIME DURATION</td>
					<td>TOTAL</td>
				</tr>

				<?php

				

				while($row = mysqli_fetch_array($result)){

					?>

						<tr>
							<td><?php echo '<img src="'.$row['img'].'" height="100" width="100">';
								echo "<br>".$row['book_name']; ?>
								<br>
								<form method="post">
								<input type="hidden" name="book_id" value="<?php echo $row['book_id']; ?>">
								<button type="submit" name="remove" class="btn btn-sm btn-danger">Remove</button>
								</form>
								
								
							</td>
							<td><?php echo "&#8377; ".$row['price']."/Day"; ?></td>
							<td style="text-align:center"><?php echo "".$row['quantity'] ?></td>
							<td>
								<form method="post">
									<div class="form-group">
									<input type="hidden" name="book_id" value="<?php echo $row['book_id']; ?>">
										<input type="hidden" name="price" value="<?php echo $row['price']; ?>">
										<span class="badge badge-info"><?php echo $row['days']; ?> Days</span>
										<input type="hidden" value="<?php echo "".$row['quantity'] ?>" name="quantity">
										<input type="number" value="10" name="days" min="10" max="365"  >
									<button type="submit" name="update" class="btn btn-sm btn-primary" size="5">Update</button>
									</div>
								
								</form>
							</td>
							<td><?php echo "&#8377; ".(float)$row['price']*(float)$row['days']; ?></td>
						</tr>

			<?php	}


				?>
			</table>
<div class=" float-right" style="text-align;">
			<div class="security_box text-primary">
				
					
					<h5> Security Deposit : ₹
						<?php 
							$sql = "SELECT * FROM rent_cart WHERE user_id='$user_id'";
							$result = mysqli_query($link,$sql);
							if(mysqli_num_rows($result) > 0)
							{
								$count_for_deposit = mysqli_num_rows($result);
								$security_deposit = $count_for_deposit*500;
								echo "$security_deposit";
							}
							else
							{
								$security_deposity = 0*500;
								echo "$security_deposit";
							}
						
						?> </h5>
				<span class="security_message">This Security Deposit is <u>REFUNDABLE</u>, and you will receive a refund after you return our book in the same condition as when it was given to you. Security Deposit for each book is 500₹.
				</span>
			</div>
			<div class="total">
				<?php
				$total_price = 0;
					$sql = "SELECT * FROM rent_cart WHERE user_id = $user_id";
					$result = mysqli_query($link,$sql);
					while ($row = mysqli_fetch_array($result)) {
						
						$total_price = $total_price + $row['total_price'] + $security_deposit;
					}
				?>

				<span class="text-primary float">
					
					<h5> <?php  echo "Total Price: &#8377; ".$total_price;?></h5>
				</span>
				<br><br>
				<a href="checkout.php"><button type="submit" class="btn btn-success float-right"><i class="fa fa-shopping-cart" aria-hidden="true"></i> &nbsp;Checkout</button></a>
			</div>
						</div>
				<?php
			}

			?>
			
		</div>
		<div class="col-sm-2"></div>
	</div>
</div>


<?php include_once 'footer.php'; ?>