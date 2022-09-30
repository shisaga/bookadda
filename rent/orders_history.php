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


	$sql = "SELECT * FROM rent_orders WHERE user_id = $_SESSION[id]";
	$result = mysqli_query($link,$sql);

	$total_orders = mysqli_num_rows($result);

	$sql = "SELECT * FROM rent_orders WHERE user_id = $_SESSION[id] ORDER BY sno DESC LIMIT 0,5";

	$res = mysqli_query($link,$sql);

	while ($row = mysqli_fetch_array($res)) {

			$output = '';
			$order_id = $row['order_id'];
			$status = $row['status'];
			$output.= '<tr><td>'.$row['book_name'].'</td>';
			$output.= '<td>'.$row['quantity'].'</td>';
			$output.= '<td>'.$row['price'].'</td>';
			$output.= '<td>'.$row['total_price'].'</td></tr>';


			$out.= '<div class="alert-secondary p-2 rounded-top">
					<form method="post">
					<strong> ORDER ID: '.$order_id.'</strong>
					<input type="hidden" name="order_id" value="'.$row['order_id'].'">';
					   if($status !== 'cancelled'){

					   	$out.='<button type="submit" name="view" class="btn btn-sm btn-outline-primary float-right" style="margin-left:10px;">View Details</button>
					<button type="submit" name="cancel" class="btn btn-sm btn-outline-danger float-right" >Cancel Order</button>';
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
        	$sql = "UPDATE rent_books SET quantity = quantity+$qty WHERE id = $row[book_id]";
        	mysqli_query($link,$sql);

        $to_email = $email;
        $subject = "Order Successfully Cancelled!";
        $body = "Hi, ". $name. "\nYour Order Has been successfully Cancelled!"."\n"."With Order Id : ".$order_id;
		sendMail($to_email,$subject,$body);
		$fields = array(
			"sender_id" => "TXTIND",
			"message" => $body,
			"route" => "v3",
			"numbers" => $mobile,
		);
		
		$curl = curl_init();
		
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_SSL_VERIFYHOST => 0,
		  CURLOPT_SSL_VERIFYPEER => 0,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => json_encode($fields),
		  CURLOPT_HTTPHEADER => array(
			"authorization: WKzcJltoR14EmyHhnsBpk6QMvPaZb2dONXGgS859Yx3UAITir79KygV5mEP4OBpLuacneHCNRZIs3zD6",
			"accept: */*",
			"cache-control: no-cache",
			"content-type: application/json"
		  ),
		));
		
		$response = curl_exec($curl);
		
		curl_close($curl);
        // $headers = "From: bookadda.dev@gmail.com";
        
        
        // mail($to_email, $subject, $body);


      }
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

 <?php  include_once 'footer.php'; ?>
