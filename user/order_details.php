<?php
	 include_once 'header.php';
	 require_once 'logincheck.php';
	 include_once '../config.php';


	 $sql = "SELECT * FROM orders WHERE order_id = $_SESSION[orderid]";

	 $res = mysqli_query($link,$sql);

	  while ($row = mysqli_fetch_array($res)) {

	 	$order_id = $row['order_id'];
	 	$book_name = $row['book_name'];
	 	$book_img = $row['img'];
	 	$quantity = $row['quantity'];
	 	$price = $row['price'];
	 	$total_price = $row['total_price'];
	 	$dop = $row['date_of_purchase'];
	 	$status = $row['status'];
	 	$payment_method = $row['payment_method'];
	 }

	 $q = "SELECT * FROM order_address WHERE order_id = $_SESSION[orderid]";

	 $result = mysqli_query($link,$q);


	 while ($row = mysqli_fetch_array($result)) {
	 	
	 	$address_id = $row['address_id'];
	 }

	 $query = "SELECT * FROM address WHERE address_id = $address_id";


	 $result = mysqli_query($link,$query);

	 while ($row = mysqli_fetch_array($result)) {
	 	
	 	$name = $row['name'];
	 	$address = $row['address'];
	 	$mobile = $row['mobile'];
	 }


 ?>


<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h5 class="text-success">ORDER DETAILS</h5>
					<br>
					<div class=" alert-secondary p-2 rounded-top"><strong><?php echo "ORDER ID: ".$order_id; ?></strong> </div>

					<table class="table table-dark">
						<tr>
							<td>PRODUCT</td>
							<td>PRICE</td>
							<td>QUANTITY</td>
							<td>TOTAL</td>
						</tr>
						<tr>
							<td><?php echo '<img src="'.$book_img.'" height="100" width="100"><br> '.$book_name; ?></td>
							<td><?php echo $price; ?></td>
							<td><?php echo $quantity;  ?></td>
							<td><?php  echo $total_price; ?></td>
						</tr>
					</table>
					
			
						<br>
						<div class="details  p-3" >

							<table class="table w-75 table-info rounded">
								
								<tr>
									<td><b>DELIVERY ADDRESS:</b></td>
									<td><?php echo $name .', '.$address;  ?></td>
								</tr>
								<tr>
									<td><b>MOBILE: </b></td>
									<td><?php echo $mobile;  ?></td>
								</tr>
								<tr>
									<td><b>DATE : </b></td>
									<td><?php echo $dop;  ?></td>
								</tr>
								<tr>
									<td><b>PAYMENT METHOD: </b></td>
									<td><?php echo $payment_method;  ?></td>
								</tr>
								<tr>
									<td><b>STATUS: </b></td>
									<td><?php echo $status;  ?></td>
								</tr>
								 
							</table>
								
							
						</div>
							
				</div>
			</div>
</div>


<?php  include_once 'footer.php'; ?>