<?php
	 include_once 'header_rent.php';
	 require_once '../user/logincheck.php';
	 include_once '../config.php';
	 $address_id = "";
 $day_l="";

	 $sql = "SELECT * FROM rent_orders WHERE order_id = $_SESSION[orderid]";

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

	 $q = "SELECT * FROM rent_order_address WHERE order_id = $_SESSION[orderid]";

	 $result = mysqli_query($link,$q);


	 while ($row = mysqli_fetch_array($result)) {
	 	
	 	$address_id = $row['address_id'];
	 }

	 $query = "SELECT * FROM rent_address WHERE address_id = $address_id";


	 $result = mysqli_query($link,$query);

	 while ($row = mysqli_fetch_array($result)) {
	 	
	 	$name = $row['name'];
	 	$address = $row['address'];
	 	$mobile = $row['mobile'];
	 }
	 $sql3 = "SELECT * FROM rent_orders WHERE order_id = $_SESSION[orderid] ";

	 $res3 = mysqli_query($link,$sql3);
 
	 while ($row = mysqli_fetch_array($res3)) {
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
					 else
					 $day_l= "Days left  to return book is " . $day_l . ' days';
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
							<td>TIME LEFT</td>
							<td>QUANTITY</td>
							<td>ISSUE TIME</td>
							<td>TOTAL</td>
							
						</tr>
						<tr>
							<td><?php echo '<img src="'.$book_img.'" height="100" width="100"><br> '.$book_name; ?></td>
							<td><?php echo $day_l; ?></td>
							<td><?php echo $quantity;   ?></td>
							<td><?php echo $time . " days";  ?></td>
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