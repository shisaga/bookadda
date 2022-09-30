<?php

  require_once 'header.php';
  require_once 'logincheck.php';
  require_once '../config.php';
  //include 'noti_fetch.php';
  require_once 'order_refund.php';
  require_once 'rent_order_refund.php';
  require_once 'book_returned_count.php';
  require_once 'rented_books_count.php';

  $total_orders =0;
  $total_users=0;
  $sql = "SELECT * FROM orders";
  $res = mysqli_query($link,$sql);
  
  if($res){
    $total_orders = mysqli_num_rows($res);
  }
  $sql = "SELECT * FROM login";
  $res = mysqli_query($link,$sql);
  
  if($res){
    $total_users = mysqli_num_rows($res);
  }


 
 ?>
<div class="container">
  <div class="row">
    <div class="col-lg-3 col-sm-3">
      <div id="dashboard" class="w-100 bg-info p-2">
      <h5 class="text-white bg-danger" style="display: table;width: 100%;height: 40px;text-align: center;line-height: 40px;" ><strong> DASHBOARD</strong></h5>
      <hr>
      
      <a href="orders.php" class="text-white" style="height: 25px; width: 100%;display: table;"><b>TOTAL ORDERS</b> <span class="badge badge-warning float-right "><?php echo $total_orders; ?></span></a>  
      <hr>  
      <a href="registered_users.php" class="text-white" style="height: 25px; width: 100%;display: table;"><b>TOTAL USERS</b> <span class="badge badge-warning float-right " id="notif"><?php echo $total_users;  ?></span></a>
	    <hr>  
      <a href="cancel_orders.php" class="text-white" style="height: 25px; width: 100%;display: table;"><b>ORDERS CANCELLED</b> <span class="badge badge-warning float-right " id="notif"><?php echo $cancel_count;  ?></span></a>
      <hr>
      <a href="rent_cancel_orders.php" class="text-white" style="height: 25px; width: 100%;display: table;"><b>RENT ORDERS CANCELLED</b> <span class="badge badge-warning float-right " id="notif"><?php echo $rent_cancel_count;  ?></span></a>
      <hr>  
      <a href="book_returned.php" class="text-white" style="height: 25px; width: 100%;display: table;"><b>BOOKS RETURNED</b> <span class="badge badge-warning float-right " id="notif"><?php echo $book_returned_count;  ?></span></a>
      <hr>
      <a href="rented_books.php" class="text-white" style="height: 25px; width: 100%;display: table;"><b>BOOKS RENTED</b> <span class="badge badge-warning float-right " id="notif"><?php echo $rented_books;  ?></span></a>
      </div>

    </div>
    <div class="col-lg-9">
      <div class="alert alert-success" style="background-color:#34ce57; color:white; text-align:center;">
          <h5>Welcome to Admin Panel</h5>

      </div>
      <div class="card-deck">
    <div class="card" style="width: 18rem;">
  <img class="card-img-top" src="images/users.png" alt="Card image cap" height="200">
  <div class="card-body">
    <h3 class="card-title text-primary">Manage Users</h3>

    <a href="manage_user.php" class="btn btn-success" style="width:100%;">Manage Users</a>
  </div>
</div>

<div class="card" style="width: 18rem;">
<img class="card-img-top" src="images/books.jpg" alt="Card image cap" height="200">
<div class="card-body">
<h3 class="card-title text-primary">Manage Store</h3>

<a href="manage_store.php" class="btn btn-success" style="width:100%;">View & Manage Store</a>
</div>
</div>
<div class="card" style="width: 18rem;">
<img class="card-img-top" src="images/order.png" alt="Card image cap" height="200">
<div class="card-body">
<h3 class="card-title text-primary">Orders History</h3>

<a href="manage_orders.php" class="btn btn-success" style="width:100%;">View & Manage Orders</a>
</div>
</div>
</div>
    </div>
  </div>
</div>
<?php require_once 'footer.php'; ?>
