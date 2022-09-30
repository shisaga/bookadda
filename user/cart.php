<?php

include_once 'header.php';
include_once 'logincheck.php';
include_once '../config.php';
$user_id = $_SESSION['id'];
$status = '';
if (isset($_POST['remove'])) {
	
	$book_id = $_POST['book_id'];

	$sql = "DELETE FROM cart WHERE user_id = $user_id AND book_id= $book_id";
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
	$quantity = $_POST['quantity'];
	$price = $_POST['price'];
	$total = (float)$quantity*(float)$price;
	$q = "SELECT * FROM books WHERE book_id = $book_id";
	$res = mysqli_query($link,$q);
	if($res){
		while($row = mysqli_fetch_array($res)){
			$available_quantity  = $row['quantity'];
		}

		if($available_quantity < $quantity){
			$status = '<div class="alert alert-warning">Quantity is not availabe to add. Try to add less quantity</div>';

		}else{
			$sql = "UPDATE cart SET quantity = $quantity,total_price = $total WHERE user_id = $user_id AND book_id = $book_id";
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
<div class="container">
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<span><?php echo $status; ?></span>
			<?php
			$sql = "SELECT * FROM cart WHERE user_id = $user_id";
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
							<td><?php echo "&#8377; ".$row['price']; ?></td>
							<td>
								<form method="post">
									<div class="form-group">
									<input type="hidden" name="book_id" value="<?php echo $row['book_id']; ?>">
										<input type="hidden" name="price" value="<?php echo $row['price']; ?>">
										<span class="badge badge-info"><?php echo $row['quantity']; ?></span>
									<select name="quantity">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
									</select>
									<button type="submit" name="update" class="btn btn-sm btn-primary">Update</button>
									</div>
								
								</form>
							</td>
							<td><?php echo "&#8377; ".(float)$row['price']*(float)$row['quantity']; ?></td>
						</tr>

			<?php	}


				?>
			</table>

			<div class="total">
				<?php
				$total_price = 0;
					$sql = "SELECT * FROM cart WHERE user_id = $user_id";
					$result = mysqli_query($link,$sql);
					while ($row = mysqli_fetch_array($result)) {
						
						$total_price = $total_price + $row['total_price'];
					}
				?>

				<span class="text-primary float-right">
					<h5> <?php  echo "Total Price: &#8377; ".$total_price;?></h5>
				</span>
				<br><br>
				<a href="checkout.php"><button type="submit" class="btn btn-success float-right"><i class="fa fa-shopping-cart" aria-hidden="true"></i> &nbsp;Checkout</button></a>
			</div>

				<?php
			}

			?>
			
		</div>
		<div class="col-sm-2"></div>
	</div>
</div>


<?php include_once 'footer.php'; ?>