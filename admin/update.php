<?php 
    require_once '../config.php';
    require_once 'header.php';
    

    $output='';
    $sql = "SELECT * FROM books";

   $result = mysqli_query($link,$sql);

   $books = mysqli_num_rows($result);

   if(mysqli_num_rows($result)>0)
   {
     $output .= '
    <h4 class="text-success"> Total Books: '.$books.'</h4>
     <table class="table" border="1px">
       <tr>
       <th>book_id</th>
       <th>Book Name</th>
       <th>author</th>
       <th>Price</th>
       <th>Image</th>
       <th colspan="2" style="text-align:center">Quantity</font></th>
       </tr>';
      while ($row = mysqli_fetch_array($result)) {

        $output .= '
          <tr>
          <td>'.$row['book_id'].'</td>
          <td>'.$row['book_name'].'</td>
          <td>'.$row['author'].'</td>
          <td>'.$row['price'].'</td>
          <td><img src="'.$row["img"].'" height="100" width="100"></td>
          <td>'.$row['quantity'].'</td>
          <form method="post" action="update.php">
          <td>
    
          <input type="number" style="width:80px; border-style: groove; border-radius: 15px; text-align:center;" class="" name="quantity">
          &nbsp;
          <button type="button" name="quantity_update" id="'.$row['book_id'].'" class="btn btn-info my-2 my-sm-0" role="alert">Update</button>
          </td>
          <form>
          </tr>';
      }
      $output .= '</table>';
   }else {
     $output = '<div class="alert alert-danger">No record found</div>';
   }
   if(isset($_POST))
   {
    $status = '<div class="alert alert-success" role="alert">Item added to cart</div>';
    echo $status;
   }




?>

<div class="container">
</div>
   
<div class="container">
<form class="form-inline" method="post">
     <input class="form-control mr-sm-2" style="width:100%;" name="book_id" type="text" placeholder="Enter Book id" aria-label="Search">
     <input class="btn btn-outline-success my-2 my-sm-0" name="q" type="submit" value="Search"> &nbsp;&nbsp;
     <button class="btn btn-outline-success my-2 my-sm-0" name="all" type="submit">View All</button>
   </form>
   <br><br>
   <?php echo $output; ?>
</div>


<?php require_once 'footer.php'; 
include_once 'update_process.php';
?>