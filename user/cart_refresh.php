<?php
session_start();
 include_once '../config.php';
 $total_price = 0;
 $user_id = $_SESSION['id'];
?>

			<span id="cstat"></span>
			<?php

				$sql = "SELECT * FROM cart WHERE user_id = $user_id";
				$result = mysqli_query($link,$sql);
				if(mysqli_num_rows($result)<1)
				{
					echo "<h3 class='text-success'>Your cart is empty</h3>";
				}else{
						?>
				

			
			<h3 class="text-success">Items in Shopping Bag</h3>
			<table class="table table-active">
				<tr>
					<th>PRODUCT</th>
					<th>PRICE</th>
					<th>QUANTITY</th>
					<th>TOTAL</th>
				</tr>
				<?php

					
					$sql = "SELECT * FROM CART WHERE user_id = $user_id";

					$result = mysqli_query($link,$sql);

					while ($row = mysqli_fetch_array($result)) {
						
						?>
							<tr class="<?php echo 'i'.$row['book_id'] ?>">
								<td><?php echo '<img src="'.$row['img'].'" height="100" width="100">';  ?>&nbsp;&nbsp;<br> <?php echo $row['book_name']; ?><br>
									
									<form method="post">
										<input type="hidden" id="<?php echo 'book_id'.$row['book_id']; ?>" value="<?php echo $row['book_id'] ?>">
										<button type="button" name="remove" class="btn btn-sm btn-danger" id="<?php echo $row['book_id']; ?>">Remove</button>
									</form>
									
									
									</td>
								<td><?php echo '&#8377; '.$row['price'];  ?></td>
								<td>
								<form method="post">
									<input type="hidden" name="price" value="<?php echo $row['price']; ?>">
									<input type="hidden" name="book_id" value="<?php echo $row['book_id'] ?>">
									<div class="form-group">
									<span class="badge badge-warning"><?php echo  $row['quantity'];?></span> &nbsp;	
										<select class="" name="quantity">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
									</select>&nbsp;
									<button type="submit" class="btn btn-sm btn-info" name="update">update</button>
									</div>
									
								</form>
									
								</td>
								<td><?php echo '&#8377; '.(float)$row['price']*(float)$row['quantity'];  ?></td>
							</tr>
						<?php
					}

				?>
			</table>
			<div class="checkout">
				<?php 
					$total_price = 0;
					$sql = "SELECT * FROM cart WHERE user_id = $user_id";
					$result = mysqli_query($link,$sql);
					while ($row = mysqli_fetch_array($result)) {
						
						$total_price += $row['total_price'];
					}
				 ?>
				 <h4 class="text-info float-right"><?php echo 'Total Price: &#8377; '.$total_price;  ?></h4>
				 <br><br>
				<form method="post">
					<button type="button" class="btn btn-success float-right"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;checkout</button>
				</form>
			</div>
				<?php } ?>
			
		