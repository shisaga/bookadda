<?php

 include_once 'header.php';
 include_once 'logincheck.php';
 include_once '../config.php';



 	$output = '';
	$out = '';
	$days="";
	$day="";
	$day_l="";
	$sql = "SELECT * FROM rent_orders WHERE status != 'returned' AND status != 'cancelled' ";
	$result = mysqli_query($link,$sql);

	$total_orders = mysqli_num_rows($result);

	$sql = "SELECT * FROM rent_orders WHERE status != 'returned' AND status != 'cancelled'  ORDER BY sno DESC LIMIT 0,5";

	$res = mysqli_query($link,$sql);

	while ($row = mysqli_fetch_array($res)) {
		     
		
		
		if($row['status'] == "returned")
		 {
			 $day_l = "N/A";
		 }
		 else if($row['status'] == "cancelled")
		 {
			 $day_l = "N/A";
		 }
			  
		 else{
			$time =$row['days'];
		 $date= $row['date_of_purchase'];
		 		
			   $current_date=(int) date('d');
			   $purchase_year = (int) substr($date,0,4);
			   $purchase_date= ((int) substr($date, 8,2)) + 2;
			   $purchase_month = (int) substr($date,5,2);
			   $current_month= (int) date('m');
			   $time_duration= (int) $row['days'];
		 
 
			 if($purchase_month == $current_month){
				 
		   
				 $day_l= $current_date - $purchase_date;
				 $day_l = $time_duration - $day_l;
				 
			   if( $day_l <=0 ){
					 $day_l ="Date of return already passed";
 
					 }
					 else {
					 $day_l= "Days left  to return book is " . $day_l . ' days';
					 }
				}
			 else{
				 if($purchase_month != $current_month){
					 
					 $d=$no_of_days_in_month = (int) date('t');
					 
					  if($d == 31){
						$number = cal_days_in_month(CAL_GREGORIAN, $purchase_month, $purchase_year);
						$month_passed = $current_month - $purchase_month;
						$day_l = ($number * $month_passed) - $purchase_date;
						$day_l = $day_l + $current_date;
						$day_l = $time_duration - $day_l;
						if ($day_l <= 0 )
						{
							$day_l = "Date of return already passed";
						}
						else
						{
							$day_1 = "Date left to return book is " .$day_l. 'days';
						}
						  
					  }
					  elseif($d == 30){

						$number = cal_days_in_month(CAL_GREGORIAN, $purchase_month, $purchase_year);
						$month_passed = $current_month - $purchase_month;
						$day_l = ($number * $month_passed) - $purchase_date;
						$day_l = $day_l + $current_date;
						$day_l = $time_duration - $day_l;
						if ($day_l <= 0 )
						{
							$day_l = "Date of return already passed";
						}
						else
						{
							$day_l = "Date left to return book is " .$day_l. ' days.';
						}

						/* $day_l =  
						 if($current_month == ($purchase_month + 1) ){
						 $day_l = $day_l + 31;
						 $day_l= "Days left  to return book " . $day_l. ' days';
						 }
						 if($current_month == ($purchase_month + 2)){
							 $day_l =$day_l + 31;
							 $day_l= "Days left  to return book " . $day_l;
						 }*/
 
 
 
					  }
 
				 }
				 
 
				}
			}


		 


			$output = '';
			$order_id = $row['order_id'];
			$status = $row['status'];


			$output.= '<tr><td>'.$row['book_name'].'</td>';
			$output.= '<td>'.$row['quantity'].'</td>';
			$output .= '<td>'.$row['price'].'₹/Day</td>';
			$output.= '<td>'.$day_l.'</td>';
			$output.= '<td>'.$row['total_price'].'</td></tr>';


			$out.= '<div class="alert-secondary p-2 rounded-top">
					<form method="post">
					<strong> ORDER ID: '.$order_id.'</strong>
					<input type="hidden" name="order_id" value="'.$row['order_id'].'">';
					   




				$out.=	'</form>
			</div>
		   <table class="table table-dark">
								<tr>
									<td class="w-25">Book Name</td>
									<td>Quantity</td>
									<td>Price</td>
									<td>Time left</td>
									<td>Total</td>
								</tr>

								 '.$output.'

			</table>';



		}




?>

		
 <div class="container">
			<div class="row">
				<div class="col-sm-12">
					<span class="text-success p-3"><strong>ORDER HISTORY</strong><strong class="float-right">TOTAL ORDERS: <?php echo $total_orders; ?></strong></span>
						<br>
						<div class="details  p-3" >

							<?php

								echo $out;
							 ?>

							 <div id="data"></div>
							 <div id="loading"></div>
							 <div id="order_info" class="text-primary"></div>
							<form method="post">
								<button type="button" name="load_more" id="load_more" class="btn btn-sm btn-primary">Load more..</button>
								<input type="hidden" name="" id="total_orders" value="<?php echo $total_orders; ?>">

							</form>
						</div>



				</div>
			</div>
</div>

<?php require_once 'footer.php' ?>