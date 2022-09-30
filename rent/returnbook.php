<?php

 include_once 'header_rent.php';
 include_once '../user/logincheck.php';
 include_once '../config.php';
 require '../sendMail.php';

 $sql = "SELECT * FROM login WHERE user_id = $_SESSION[id]";

 $res = mysqli_query($link,$sql);
 
 while ($row = mysqli_fetch_array($res)) {
     
     $name = $row['name'];
     $mobile = $row['mobile'];
     $email = $row['username'];
 }

 	$output = '';
	$out = '';
	$days="";
	$day="";
	$day_l="";
	$sql = "SELECT * FROM rent_orders WHERE user_id = $_SESSION[id]";
	$result = mysqli_query($link,$sql);

	$total_orders = mysqli_num_rows($result);

	$sql = "SELECT * FROM rent_orders WHERE user_id = $_SESSION[id] ORDER BY sno DESC LIMIT 0,5";

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
					   if($status !== 'cancelled' && $status !== 'returned'){

					   	$out.='<button type="submit" name="view" class="btn btn-sm btn-outline-primary float-right" style="margin-left:10px;">View Details</button>
					<button type="submit" name="cancel" class="btn btn-sm btn-outline-danger float-right" style="margin-left:10px;">Cancel Order</button>
					&nbsp;&nbsp; <button type="submit" name="RB" class="btn btn-sm btn-outline-danger float-right" >Return Book</button>';
					   }else{

					   		$out.= '<button type="submit" name="view" class="btn btn-sm btn-outline-primary float-right" style="margin-left:10px;">View Details</button>';
					   }




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

		if (isset($_POST['view'])) {

			$_SESSION['orderid'] = $_POST['order_id'];

			echo "<script> window.location.href = 'order_details.php'; </script>";
		}

		if (isset($_POST['cancel'])) {

			$_SESSION['orderid'] = $_POST['order_id'];
			$order_id = $_POST['order_id'];;

			$sql ="UPDATE rent_orders SET status= 'cancelled' WHERE order_id= $_SESSION[orderid]";
			mysqli_query($link,$sql);

      		$q = "SELECT order_id,book_id,quantity FROM rent_orders WHERE order_id = $_SESSION[orderid]";
      		$res = mysqli_query($link,$q);
      		while ($row = mysqli_fetch_array($res)) {
        	$qty = $row['quantity'];
        	$sql = "UPDATE rent_books SET quantity = quantity+$qty WHERE book_id = $row[id]";
        	mysqli_query($link,$sql);

        $to_email = $email;
        $subject = "Order Successfully Cancelled!";
        $body = "Hi, ". $name. "\nYour Order Has been successfully Cancelled!"."\n"."With Order Id : ".$order_id;
		sendMail($to_email,$subject,$body);
        // $headers = "From: bookadda.dev@gmail.com";
        
        
        // mail($to_email, $subject, $body);

		if ($res) {
			echo "<script> alert('order cancelled');</script>";
			$res1 = mysqli_query($link,"SELECT * FROM rent_payment WHERE order_id='$order_id'");
			while($row1 = mysqli_fetch_array($res1))
			{
				if($row1['payment_status'] == "complete")
				{
					mysqli_query($link,"UPDATE rent_orders SET refund_status=1 WHERE order_id=$order_id");
				}
			}
			echo "<script> window.location.href = 'orders_history.php'; </script>";
			}else{
				echo "<script> alert('error occured! try again');</script>";

			}


      }
			if ($res) {
			echo "<script> alert('order cancelled');</script>";
			$res1 = mysqli_query($link,"SELECT * FROM payment WHERE order_id='$order_id'");
			while($row1 = mysqli_fetch_array($res1))
			{
				if($row1['payment_status'] == "complete")
				{
					mysqli_query($link,"UPDATE rent_orders SET refund_status=1 WHERE order_id=$order_id");
				}
			}
			echo "<script> window.location.href = 'orders_history.php'; </script>";
			}else{
				echo "<script> alert('error occured! try again');</script>";

			}
            


		}



		if (isset($_POST['RB'])) {
			$_SESSION['orderid'] = $_POST['order_id'];
			$orderId = $_POST['order_id'];
			$userId = $_SESSION['id'];
			$latePaymentCheckQuery = "SELECT * FROM rent_orders WHERE user_id='$userId' AND order_id='$orderId'";
			$execQuery = mysqli_query($link,$latePaymentCheckQuery);
			

			while($row = mysqli_fetch_array($execQuery)) {
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
					$order_id1 = $_POST['order_id'];
					$check_if_exist = "SELECT * FROM penalty_payment WHERE order_id= $order_id1";
					$check = mysqli_query($link,$check_if_exist);
					
					if(mysqli_num_rows($check) > 0) {
						echo "<script> window.location.href = 'bankdetail.php'; </script>";
						
					}
					else {
						echo "<script> window.location.href = 'rentit.php'; </script>";
						
					}
					// echo "<script> window.location.href = 'bankdetail.php'; </script>";
							
					// echo "<script> window.location.href = 'rentit.php'; </script>";
   
					}
					   else {
						
						// $check_if_exist = "SELECT order_id FROM penalty_payment WHERE order_id= '$order_id'";
						// 		$check = mysqli_query($link,$sql);
						// 		if(mysqli_num_rows($check) > 0) {
						// 			echo "<script> window.location.href = 'bankdetail.php'; </script>";
						// 		}
						// 		else {
						// 	 		echo "<script> window.location.href = 'rentit.php'; </script>";
						// 		}
					   	echo "<script> window.location.href = 'bankdetail.php'; </script>";
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
								$order_id1 = $_POST['order_id'];
								// echo "<script> window.location.href = 'bankdetail.php'; </script>";
								$check_if_exist = "SELECT * FROM penalty_payment WHERE order_id= $order_id1";
									$check = mysqli_query($link,$check_if_exist);
									if(mysqli_num_rows($check) > 0) {
										echo "<script> window.location.href = 'bankdetail.php'; </script>";
										
									}
									else {
										echo "<script> window.location.href = 'rentit.php'; </script>";
										
									}
								// echo "<script> window.location.href = 'bankdetail.php'; </script>";
								// echo "<script> window.location.href = 'rentit.php'; </script>";
							}
							else
							{
								echo "<script> window.location.href = 'bankdetail.php'; </script>";
							}
							
						}
						elseif($d == 30){
							
							$number = cal_days_in_month(CAL_GREGORIAN, $purchase_month, $purchase_year);
							$month_passed = $current_month - $purchase_month;
							$day_l = ($number * $month_passed) - $purchase_date;
							$day_l = $day_l + $current_date;
							$day_l = $time_duration - $day_l;
							$order_id = $_POST['order_id'];
						
							if ($day_l <= 0 )
							{
								$order_id1 = $_POST['order_id'];
								// echo $day_l . "if". " d = 30";
									$check_if_exist = "SELECT * FROM penalty_payment WHERE order_id= $order_id1";
									$check = mysqli_query($link,$check_if_exist);
									if(mysqli_num_rows($check) > 0) {
										echo "<script> window.location.href = 'bankdetail.php'; </script>";
									}
									else {
										echo "<script> window.location.href = 'rentit.php'; </script>";
									}
								
								// echo "<script> window.location.href = 'bankdetail.php'; </script>";
							}
							else
							{
								echo "<script> window.location.href = 'bankdetail.php'; </script>";
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