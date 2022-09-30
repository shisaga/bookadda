<?php
 require_once 'header.php';
 require_once 'logincheck.php';
 require '../config.php';
$output='';
$sql = "SELECT * FROM orders ORDER BY order_id DESC";

$res = mysqli_query($link,$sql);

$total = mysqli_num_rows($res);

 $output.= '<table class="table table-hover table-primary ">
    <thead class ="bg-dark text-white text-strong">
    <tr>
      <td>USER ID</td>
      <td>Username</td>
      <td>Orders</td>
      <td>Quantity</td>
      <td>Total Price</td>
      <td>Payment Status</td>
      <td>Order Status</td>
      <td>Payment Method</td>
      <td>Date (y-m-d h:i:s)</td>
      <td>Action</td>
    </tr></thead>';

while ($row = mysqli_fetch_array($res)) {
  
    $user_id = $row['user_id'];
    $sql = "SELECT user_id,username FROM login WHERE user_id = '$user_id' ";
    $r = mysqli_query($link,$sql);
    while($u = mysqli_fetch_array($r)){

      $username = $u['username'];
    }
  
  $output.= '<tr>
      <td>'.$row['user_id'].'</td>
      <td>'.$username.'</td>
      <td>'.$row['book_name'].'</td>
      <td>'.$row['quantity'].'</td>
      <td>'.$row['total_price'].'</td>
      <td>'.$row['paid'].'</td>
      <td>'.$row['status'].'
        <form method="post" class="form">
        <div class="form-group">
        <select name="status" class="form-control">
        <option value="Order Processing by Seller">Order Processing by Seller</option>
        <option value="Item Packed">Item Packed</option>
        <option value="Dispatched">Dispatched</option>
        <option value="Out For Delivery">Out For Delivery</option>
        <option value="Delivered">Item Delivered</option>
        </select>

        
        </div>
       
      </td>
      <td>'.$row['payment_method'].'</td>
      <td>'.$row['date_of_purchase'].'</td>
      <td>
      <input type="hidden" value="'.$row['order_id'].'" name="order_id">
      <button class="btn btn-sm btn-success mt-1" name="update" type="submit"> update</button>
       </form>
      </td>
    </tr>';


}

$output.='</table>';

if (isset($_POST['update'])) {
  
  $status = $_POST['status'];
  $order_id = $_POST['order_id'];

  $sql = "UPDATE orders SET status = '$status' WHERE order_id = '$order_id' ";

  $res = mysqli_query($link,$sql);

  if($res){

    $status_info = "<div class='alert alert-success'>Order Updated Successfully</div>";
  }else{
    $status_info = "<div class='alert alert-danger'>Problem in updating status</div>";
  }
}
 ?>
 <div class="container">
   <div class="row">
     
     <div class="col-lg-12">
      <?php  if (isset($status)) {
         echo $status_info;
         echo '<script> window.setTimeout(function(){
                window.location.href = window.location.href;
         },1000);</script>';  
      } ?>
      <span class="text-success float-right mb-3"><h5 style="font-weight: bolder;">TOTAL ORDERS : <?php echo $total; ?></h5></span>
      <?php echo $output;?>
     </div>
   </div>
 </div>
<?php require_once 'footer.php'; ?>
