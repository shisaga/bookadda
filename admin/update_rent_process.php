
<?php
require '../config.php';
if (isset($_POST['action'])) {
  $action = $_POST['action'];
}
if($action =='update_book'){
  $book_id = $_POST['book_id'];
  $sql = "SELECT id,quantity FROM rent_books WHERE id = $book_id";
  $res = mysqli_query($link,$sql);
  if($res){
    while ($row = mysqli_fetch_array($res)) {
       echo $row['quantity'];
    }
  }
}

if($action =='update_book_qty'){
  $book_id = $_POST['book_id'];
  $quantity = $_POST['quantity'];
  $sql = "UPDATE rent_books SET quantity = $quantity WHERE id = $book_id";
  $res = mysqli_query($link,$sql);
  if($res){
    echo "Updated Successfully";
  }
}

if($action =='remove_book'){
  $book_id = $_POST['book_id'];
  $sql = "DELETE FROM rent_books WHERE id = $book_id";
  $res = mysqli_query($link,$sql);
  if($res){
    echo "Deleted Successfully";
  }
}


 ?>
