<?php

session_start();
include_once '../config.php';

if (isset($_POST['last_id'])) {
	
	$last_id = $_POST['last_id'];
	$out = '';


	$sql = "SELECT * FROM orders WHERE user_id = $_SESSION[id] ORDER BY sno DESC LIMIT $last_id,5";

	$res = mysqli_query($link,$sql);

	
	while ($row = mysqli_fetch_array($res)) {		
			$output = '';
			$order_id = $row['order_id'];
			$output.= '<tr><td>'.$row['book_name'].'</td>';
			$output.= '<td>'.$row['quantity'].'</td>';
			$output.= '<td>'.$row['price'].'</td>';
			$output.= '<td>'.$row['total_price'].'</td></tr>';

			$out.= '<div class="alert-secondary p-2 rounded-top">
					<form method="post">
					<strong> ORDER ID: '.$order_id.'</strong>
					<input type="hidden" name="order_id" value="'.$row['order_id'].'">
					<button type="submit" name="view" class="btn btn-sm btn-outline-primary float-right">View Details</button>
					</form>
			</div>
		   <table class="table table-dark">
								<tr>
									<td class="w-25">Book Name</td>
									<td>Quantity</td>
									<td>Price</td>
									<td>Total</td>	
								</tr>
								 
								 '.$output.'

							</table>';

			

		}

		echo $out;


}



?>