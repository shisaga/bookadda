<?php

session_start();
include_once '../config.php';
$var = $_POST['action'];

if (!isset($_SESSION['loggedin'])==true) {
	
	echo "<div class='alert alert-danger' >Login to Continue</div>";
}else{

	switch ($var) {

	case 'add_to_cart':

		$book_id = $_POST['book_id'];
		$book_name = $_POST['book_name'];
        $image = $_POST['image'];
        $price = $_POST['price'];
        $user_id = $_SESSION['id'];
        $quantity = $_POST['quantity'];

        $sql = "select * from rent_cart where user_id=$user_id and book_id=$book_id";

        $result = mysqli_query($link,$sql);

        if(mysqli_num_rows($result)==1)
        {

            $status = '<div class="alert alert-danger" role="alert">Item is already added to cart</div>';
        }else{
			$quantity_available =0;
			$sql = "select * from rent_books where  id=$book_id";
			$result = mysqli_query($link,$sql);
			while($row= mysqli_fetch_array($result)){
				$quantity_available = $row['quantity'];
			}
        	//var_dump($quantity);
			if($quantity_available <1){
				$status = '<div class="alert alert-info" role="alert">Item is currently out of stock</div>';
			}else{
				$total_price = $price * 10;
				$sql = "INSERT INTO rent_cart(cart_id,book_id,book_name,img,price,total_price,quantity,days,user_id) VALUES ('','$book_id','$book_name','$image','$price','$total_price','$quantity',10,$user_id)";

				if(mysqli_query($link,$sql))
				{
					$status = '<div class="alert alert-success" role="alert">Item added to cart</div>';
	
				}else{
					
					$status = '<div class="alert alert-danger" role="alert" data-auto-dismiss="2000">Cannot add to cart</div>';
	
				}
			}
           
        }
		
		echo $status;
		break;

		case 'remove':

				$book_id = $_POST['book_id'];
				$user_id = $_SESSION['id'];

				$sql = "DELETE FROM rent_cart WHERE book_id = $book_id AND user_id = $user_id";

				$result = mysqli_query($link,$sql);

				if($result)
				{
					$status = "<div class='alert alert-success'>Item deleted</div>";
				}else{
					$status = "<div class='alert alert-danger'>Item not deleted</div>";
				}
			echo $status;
		break;
	
	default:
		# code...
		break;
}

}



?>