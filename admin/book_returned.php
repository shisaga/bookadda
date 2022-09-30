<?php
 require_once 'header.php';
 require_once 'logincheck.php';
 require '../config.php';
 require '../sendMail.php';
 
$output='';
$user_id='';
$total=0;

$count_deposit = mysqli_query($link,"SELECT * FROM rent_security_deposit where status='received'");
$output.= '<table class="table table-hover table-primary ">
<thead class ="bg-dark text-white text-strong">
<tr>
  <td>User Id</td>
  <td>Order Id</td>
  <td>Username</td>
  <td>Total Amount</td>
  <td>Payment Status</td>
  <td>Payment Id</td>
  <td>Date (y-m-d h:i:s)</td>
  <td>Bank Details</td>
  <td>Action</td>
</tr></thead>';
while($result=mysqli_fetch_array($count_deposit))
{
    
$order_id = $result['order_id'];
$sql = "SELECT * FROM rent_orders WHERE order_id=$order_id ORDER BY date_of_purchase ASC";

$res = mysqli_query($link,$sql);

$total = mysqli_num_rows($count_deposit);



while ($row = mysqli_fetch_array($res)) {
  
    $user_id = $row['user_id'];
    $sql = "SELECT user_id,username FROM login WHERE user_id = '$user_id' ";
    $r = mysqli_query($link,$sql);
    while($u = mysqli_fetch_array($r)){

      $username = $u['username'];
    }
    $order_id= $row['order_id'];
    $sql1 = "SELECT payment_id FROM rent_payment WHERE user_id = '$user_id' AND order_id='$order_id' ";
    $r1 = mysqli_query($link,$sql1);
    if(mysqli_num_rows($r1) > 0) {
        while($u = mysqli_fetch_array($r1)){


            $payment_id = $u['payment_id'];
          }
    }
    else
    {
        $payment_id='N/A';
    }
    
  
  $output.= '<tr>
      <td>'.$row['user_id'].'</td>
      <td>'.$row['order_id'].'</td>
      <td>'.$username.'</td>
      <td>'.$row['total_price'].'</td>
      <td>'.$row['paid'].'</td>
      <td>'.$payment_id.'</td>
      <td>'.$row['date_of_purchase'].'</td>
      <td><form method="post" class="form">
      <input type="hidden" value="'.$row['order_id'].'" name="order_id">
      <input type="hidden" value="'.$row['user_id'].'" name="user_id">
      <a href=check_bank_details.php?user_id="'.$row['user_id'].'"><input type="button" class="btn btn-sm btn-info mt-1" value="Check"></a>
       </form></td>
      <td>
      <form method="post" class="form">
      <input type="hidden" value="'.$row['order_id'].'" name="order_id">
      <input type="hidden" value="'.$row['user_id'].'" name="user_id">
      <button class="btn btn-sm btn-success mt-1" name="update" type="submit"> update</button>
       </form>
      </td>
    </tr>';


}


}
$output.='</table>';

if (isset($_POST['update'])) {
  
  $order_id_update = $_POST['order_id'];
  if(isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $sql = "SELECT * FROM login WHERE user_id = '$user_id'";

    $res = mysqli_query($link,$sql);

    while ($row = mysqli_fetch_array($res)) {

        $name = $row['name'];
        $mobile = $row['mobile'];
        $email = $row['username'];
    }
  }
  
  

  $res = mysqli_query($link,"UPDATE rent_security_deposit SET status='returned' WHERE order_id = '$order_id_update' AND user_id='$user_id'");

  
  if($res){

    $status_info = "<div class='alert alert-success'>Order Updated Successfully</div>";

    $to_email = $email;
		$subject = "Book Returned Request Accepted";
		$body = "Hello, ". $name. "\nYour Request for returning the book has been accepted."."\n"."Person for collecting the book will come within next 4-5 business days.\nOrder Id : ".$order_id_update."\n";
    sendMail($to_email,$subject,$body);
		// $headers = "From: bookadda.dev@gmail.com";
		// 		 mail($to_email, $subject, $body, $headers);
  }else{
    $status_info = "<div class='alert alert-danger'>Problem in updating status</div>";
  }
}
 ?>
 <div class="container">
   <div class="row">
     
     <div class="col-lg-12">
      <?php  if (isset($order_id_update)) {
         echo $status_info;
         echo '<script> window.setTimeout(function(){
                window.location.href = window.location.href;
         },1000);</script>';  
      } ?>
      <span class="text-success float-right mb-3"><h5 style="font-weight: bolder;">TOTAL BOOKS RETURNED : <?php echo $total; ?></h5></span>
      <?php echo $output;?>
     </div>
   </div>
 </div>
<?php require_once 'footer.php'; ?>
