<?php

	 include_once 'header.php';
	 require_once 'logincheck.php';
	 include_once '../config.php';

	 if (!isset($_SESSION['order_id'])) {
	 	
	 	echo "<script> window.location.href = 'index.php'; </script>";
	 }


$sql = "SELECT * FROM address WHERE user_id = $_SESSION[id] AND address_id = $_SESSION[address_id]";

$res = mysqli_query($link,$sql);

while ($row = mysqli_fetch_array($res)) {
	
	$name = $row['name'];
	$address = $row['address'];
	$mobile = $row['mobile'];
}
$total_price = 0;
$output = '';
$out = '';

foreach ($_SESSION['order_id'] as $key => $value) {
	
	$sql = "SELECT * FROM orders WHERE user_id= $_SESSION[id] AND order_id = '$value'";
	$_SESSION['value'] = $value;	$result = mysqli_query($link,$sql);

	while ($row = mysqli_fetch_array($result)) {
		
	   $order_id = $row['order_id'];
	   $output = '';
	   $output.= '<tr><td>'.$row['book_name'].'</td>';
	   $output.= '<td> &#8377; '.$row['price'].'</td>';
	   $output.= '<td>'.$row['quantity'].'</td>';
	   $output.= '<td>&#8377; '.$row['total_price'].'</td></tr>';
	   $total_price += $row['total_price'];
	   $dop = $row['date_of_purchase'];
	   $status = $row['status'];
	   $payment_method = $row['payment_method'];


	   $out .= '<div class="alert-secondary rounded-top p-2"><strong>ORDER ID: '.$row['order_id'].'</strong></div>
	   		<table class="table table-dark">

	   		<tr><td>BOOK NAME</td>
	   		<td>PRICE</td>
	   		<td>QUANTITY</td>
	   		<td>TOTAL</td></tr>

	   		'.$output.'
	   		</table>
	   ';

	}
}

unset($_SESSION['order_id']);

?>


<div class="container" id="invoice">
	<div class="row">
		<div class="col-sm-12">

			
				<div class="alert-header text-success"> <strong>Thank you <?php echo $name ?> for shopping with us
				</strong>
				<h6>Your order has been successfully placed. Your order details are as follows:</h6>
				<br></div>

				<table class="table table-striped">
					<tr>
						<td>DELIVERY ADDRESS</td>
						<td><?php echo $name.', '.$address; ?></td>
					</tr>
					<tr>
						<td>MOBILE NUMBER</td>
							<td><?php echo $mobile; ?></td>
					</tr>
					<tr>
						<td>DATE OF PURCHASE</td>
						<td><?php echo $dop; ?></td>
					</tr>	
						
					<tr>
						<td>STATUS</td>
						<td><?php  echo $status; ?></td>
					</tr>
					<tr>
						<td>PAYMENT METHOD</td>
						<td><?php echo $payment_method; ?></td>
					</tr>
						
		
				</table>

				<br>

				<?php  echo $out; ?>
			
			    <br>
				<p style="text-align:right;" id="erase"><button class="btn btn-success " id="download" onclick=printDiv()>Generate Bill</button></p>

			    <h6><strong>TOTAL AMOUNT: <?php echo '&#8377; '.$total_price; ?> </strong> </h6>
			
			    <span class="badge badge-info">KEEP THIS ORDER ID SAVED FOR THE FUTURE REFERENCE OF YOUR ORDER.</span>
		 </div>
	</div>
</div>
<script src="print.js"></script>

<?php  include_once 'footer.php'; ?>