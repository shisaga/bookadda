


<?php

	 include_once 'header.php';
	 require_once 'logincheck.php';
	 include_once '../config.php';
	 require '../sendMail.php';
	 $user_id = $_SESSION['id'];

     $sql = "SELECT * FROM login WHERE user_id = $_SESSION[id]";

     $res = mysqli_query($link,$sql);
     
     while ($row = mysqli_fetch_array($res)) {
         
         $name = $row['name'];
         $mobile = $row['mobile'];
         $email = $row['username'];
     }

	 if (!isset($_SESSION['checkout_id'])) {

	 	echo "<script> window.location.href = 'index.php'; </script>";
	 }
	 $checkout_id = $_SESSION['checkout_id'];
	 $output = '';
	 $sql = "SELECT * FROM address WHERE user_id = $user_id AND checkout_id = '$checkout_id'";

	 $result = mysqli_query($link,$sql);

	 if($result)
	 {
	 	while ($row = mysqli_fetch_array($result)) {

	 		$output .= '<h5>'.$row['name'].'</h5>
	 					<br>
	 					<h5>'.$row['address'].'</h5>
	 					<br>
	 					<h5>Mobile Num:- '.$row['mobile'].'';
	 	}
	 }


 		if (isset($_POST['pay'])) {

 			$sql = "SELECT * FROM cart WHERE user_id = $user_id";

 			 $result= mysqli_query($link,$sql);


 			if (!$result) {

 				echo "Error occured";
 			}else{

 				$q = "SELECT * FROM address WHERE checkout_id = '$checkout_id'";
 				$res = mysqli_query($link,$q);

 				while ($row = mysqli_fetch_array($res)) {

 					$address_id = $row['address_id'];
 				}

 				$_SESSION['address_id'] = $address_id;

 				$i = 0;

 				while ($row = mysqli_fetch_array($result)) {
					$book_id_array[] = array(
						'book_id' =>$row['book_id'],
						'quantity'=>$row['quantity']
					);
				//	var_dump($book_id_array);

 					$q1 = "INSERT INTO orders(`sno`, `order_id`, `book_id`, `book_name`, `img`, `price`, `quantity`, `total_price`, `user_id`, `date_of_purchase`, `status`, `payment_method`, `paid`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";

 					$q2 = "INSERT INTO order_address(`id`, `address_id`, `order_id`) VALUES(?,?,?)";

 					$q3 = "DELETE FROM cart WHERE user_id = ?";




 					$stmt1 = mysqli_prepare($link,$q1);
 					$stmt2 = mysqli_prepare($link,$q2);
 					$stmt3 = mysqli_prepare($link,$q3);


 					mysqli_stmt_bind_param($stmt1,'isssssissssss',$param_sno,$param_orderid,$param_book_id,$param_bookname,$param_img,$param_price,$param_quantity,$param_total_price,$param_user_id,$param_dop,$param_status,$param_payment_method,$param_paid);
 					mysqli_stmt_bind_param($stmt2,'iis',$param_id,$param_address_id,$param_orderid);
 					mysqli_stmt_bind_param($stmt3,'i',$param_user_id);


 					$param_sno = '';
 					$param_orderid = rand().$user_id;
 					$_SESSION['order_id'][$i] = $param_orderid;
 					$param_bookname = $row['book_name'];
 					$param_book_id = $row['book_id'];
 					$param_img = $row['img'];
 					$param_price = $row['price'];
 					$param_quantity = $row['quantity'];
 					$param_total_price = $row['total_price'];
 					$param_user_id = $user_id;
 					$param_dop = date('Y-m-d h:i:s');
 					$param_status = "order placed";
 					$param_payment_method = "POD";
 					$param_paid = 'no';
 					$param_id = '';
 					$param_address_id = $address_id;
 					$param_nstatus = 0;

 					if (mysqli_stmt_execute($stmt1) && mysqli_stmt_execute($stmt2) && mysqli_stmt_execute($stmt3)) {

						$_SESSION['bill'] = $_SESSION['checkout_id'];
 						unset($_SESSION['checkout_id']);


 					}

 					$i++;

					


 				}
				 $to_email = $email;
				 $subject = "Order Successfully Placed!";
				 $body = "Hi, ". $name. "\nYour Order Has been successfully placed"."\n"."With Order Id : ".$param_orderid;
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
				
				
				//  $headers = "From: bookadda.dev@gmail.com";
				 
				 
				//  mail($to_email, $subject, $body, $headers);
 			}
			foreach ($book_id_array as  $value) {
				$q4 = "SELECT book_id,quantity FROM books WHERE book_id = $value[book_id]";
				$res = mysqli_query($link,$q4);
				$quantity = 0;
				if($res){
					while($row = mysqli_fetch_array($res)){
						$quantity = $row['quantity'];
					}
					$quantity = $quantity - 	$value['quantity'];
					$sql = "UPDATE books SET quantity = $quantity WHERE book_id = $value[book_id]";
					mysqli_query($link,$sql);
				}
			}

			echo "<script>
				window.location.href = 'order_success.php';
			</script>";
 		}


?>
<div class="container">
	<div class="row">
		<div class="col-sm-5 p-4 mr-5" style="height: 300px;box-shadow: 5px 5px 10px;">
			<h4 class="text-success">Delivery Address</h4>
			<hr>
			<?php echo $output; ?>
		</div>
		<div class="col-sm-6 p-3" style="height: 300px;box-shadow: 5px 5px 10px;overflow-y: scroll;">
				<?php
			$sql = "SELECT * FROM cart WHERE user_id = $user_id";
			$result = mysqli_query($link,$sql);

			if (mysqli_num_rows($result)<1) {

				echo "<h3 class='text-success'>Your Cart is empty </h3>";
				echo "<img src='images/empty.png'>";
			}else
			{
				?>

				<h3 class="text-success">Items in Bag</h3>
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



							</td>
							<td><?php echo "&#8377; ".$row['price']; ?></td>
							<td>
							<?php echo $row['quantity']; ?>
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

			</div>

				<?php
			}

			?>
		</div>
	 </div>

	 <div class="row mt-5">
	 	<div class="col-sm-5 p-3" style="height: 200px;box-shadow: 5px 5px 10px;">

	 		<h4 class="text-success">Payment method</h4>
	 		<hr>
	 		<h5>Pay On Delivery</h5>
	 		<form method="post">
	 			<button type="submit" class="btn btn-success" name="pay">Place Order</button>
				 
				<input type="button" class="btn btn-success" name="pay" id="btn" value="Pay Now" onclick="pay_now()"/>
				<input type="hidden" name="amt" id="amt" value=<?php echo $total_price?>>
	 		</form>

	 	</div>
	 </div>



</div>
<!-- My razorpay links-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>


<script>
        var name='<?php echo "$name"?>';
        var amt='<?php echo "$total_price" ?>';
		var email='<?php echo "$email" ?>';
		var mobile='<?php echo "$mobile"?>';
		var user_id = '<?php echo "$user_id"?>';
		var checkout_id = '<?php echo "$checkout_id"?>';

		var options = {
			"key": "rzp_test_5tJY1Bs0f565X1", // Enter the Key ID generated from the Dashboard
			"amount": amt*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
			"currency": "INR",
			"name": "Book Adda",
			"description": "No. 1",
			"image": "logo.png",
			//"order_id": "order_9A33XWu170gUtm", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1

			"prefill": {
				"name": name,
				"email": email,
				"contact": mobile
			},
			"theme": {
				"color": "#3399cc"
			},
			"handler": function (response){
                           jQuery.ajax({
                               type:'post',
                               url:'payment_process.php',
                               data:"payment_id="+response.razorpay_payment_id+"&amt="+amt+"&name="+name+"&email="+email+"&user_id="+user_id+"&checkout_id="+checkout_id,
                               success:function(result){
                                   window.location.href="order_success.php";
                               }
                           });
                        }
		};
		var rzp1 = new Razorpay(options);
		document.getElementById('btn').onclick = function(e){
		rzp1.open();
}
    /*function pay_now(){
		
        var name='<?php echo $name; ?>';
		var amt = "100";

         jQuery.ajax({
               type:'post',
               url:'payment_process.php',
               data:"amt="+amt+"&name="+name,
               success:function(result){
                   var options = {
                        "key": "rzp_test_5tJY1Bs0f565X1", 
                        "amount": amt*100, 
                        "currency": "INR",
                        "name": "Book Adda",
                        "description": "Online Payment",
                        "image": "logo.png",
                        "handler": function (response){
                           jQuery.ajax({
                               type:'post',
                               url:'payment_process.php',
                               data:"payment_id="+response.razorpay_payment_id,
                               success:function(result){
                                   window.location.href="thank_you.php";
                               }
                           });
                        }
                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.open();
               }
           });
        
        
    }*/
</script>

<!--h-100 d-flex flex-column justify-content-center my-0-->
<?php  include_once 'footer.php'; ?>

