<?php
session_start();
include_once ('../config.php');
require '../sendMail.php';
$email = $_POST['email'];
$user_id = $_POST['user_id'];
$checkout_id = $_POST['checkout_id'];
$payment_id=$_POST['payment_id'];

$sql_2 = "SELECT * FROM login WHERE user_id = $user_id";

$res = mysqli_query($link,$sql_2);

while ($row = mysqli_fetch_array($res)) {
	
	$name = $row['name'];
	$mobile = $row['mobile'];
	$email = $row['username'];
}
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
					$_SESSION['orderid'] = $param_orderid;
 					$param_bookname = $row['book_name'];
 					$param_book_id = $row['book_id'];
 					$param_img = $row['img'];
 					$param_price = $row['price'];
 					$param_quantity = $row['quantity'];
 					$param_total_price = $row['total_price'];
 					$param_user_id = $user_id;
 					$param_dop = date('Y-m-d h:i:s');
 					$param_status = "order placed";
 					$param_payment_method = "Razorpay";
 					$param_paid = 'Yes';
 					$param_id = '';
 					$param_address_id = $address_id;
 					$param_nstatus = 0;

					 if(isset($_POST['amt']) && isset($_POST['name'])){
						$amt=$_POST['amt'];
						$name=$_POST['name'];
						$payment_status_1="pending";
						$added_on_1=date('Y-m-d h:i:s');
						mysqli_query($link,"insert into payment(user_id,username,amount,payment_status,added_on) values('$user_id','$email','$param_total_price','$payment_status_1','$added_on_1')");
						$_SESSION['OID']=mysqli_insert_id($link);
					}
					
					
					if(isset($_POST['payment_id']) && isset($_SESSION['OID'])){
						$payment_id=$_POST['payment_id'];
						mysqli_query($link,"update payment set payment_status='complete',payment_id='$payment_id',order_id=$param_orderid where id='".$_SESSION['OID']."'");
						
					}

 					if (mysqli_stmt_execute($stmt1) && mysqli_stmt_execute($stmt2) && mysqli_stmt_execute($stmt3)) {


 						unset($_SESSION['checkout_id']);


 					}

 					$i++;
                }
                $to_email = $email;
					 $subject = "Order Successfully Placed!";
					 $body = "Hi, ". $name. "\nYour Order Has been successfully placed"."\n"."With Order Id : ".$param_orderid."\nPayment Id : ".$payment_id;
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
				$err = curl_error($curl);

				curl_close($curl);


					//  $headers = "From: bookadda.dev@gmail.com";
					 
					 
  $fields = array(
    "sender_id" => "TXTIND",
    "message" => "This is a test message",
    "route" => "v3",
    "numbers" => ,
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
$err = curl_error($curl);

curl_close($curl);
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


            
?>
