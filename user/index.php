<?php  
require_once 'header.php';
require_once '../config.php';

require_once 'search.php';
$output=""; 

if(!$link){

	echo "<script> window.location.href = 'error.php' </script>";
}   ?>
<style>
		@media (max-width:600px){
			.mit{
				
				
				width:100%;
				margin-bottom: 10px;
			}
			#product
			{
			padding-right: 0%;
			

			}
		 .img2{
			width:140px;
			background-size: 100%;
		 }	
		 .btnself{
		  width:100%;
		  font-size: 10px;
		
		 }
		 .tag{
			background-color: darkgray;
		 }

		
		}
		#image_hover:hover {
			opacity:0.5;
	
		}

	</style>

<div class="container colo">
	
	<div class="row">
		<div class="col-sm-3">
			
			<table class="sidebar mit">
			<tr><td>CATEGORIES</td></tr>
				<tr><td class="hov"><a href="best_sellers.php">Best Sellers</a></td></tr>
				<tr><td class="hov"><a href="action_adventures.php">Action & Adventures</a></td></tr>
				<tr><td class="hov"><a href="business_management.php">Business & Management</a></td></tr>
				<tr><td class="hov"><a href="novels.php">Novels</a></td></tr>
				<tr><td class="hov"><a href="comics.php">Comics</a></td></tr>
				<tr><td class="hov"><a href="indian_writing.php">Indian Writings</a></td></tr>
			</table>
		</div>
		<div class="col-sm-9">
			<span id="status"></span>
			<div class="tag">BEST SELLERS</div>
			<div class="row">

				<?php 


					$sql = "SELECT * FROM books WHERE category = 'Best Sellers' ORDER BY book_id ASC";
					$result = mysqli_query($link,$sql);
					 $_SESSION['sorter'] ='id';
					 $_SESSION['order'] = "DESC";
					$_SESSION['text'] = "most helpful";
					while ($row = mysqli_fetch_array($result)) {
						
						$output .='<div class="col-lg-4 col-sm-6  col-6" id="product">
							<a href="book_details.php?id='.$row['book_id'].'"><img class ="img2" src="'.$row['img'].'" width="80%" height="200" id="image_hover" ></a>
							<h5 style="font-size:medium">'.$row['book_name'].'</h5>
							<h5 style="font-size:x-small">'.$row['author'].'</h5>
							<h5 style="font-size:larger;color:red">&#x20b9 '.$row['price'].'</h5>
							<form name="form" method="post">
							<input type="hidden" name="book_id" id="book_id'.$row['book_id'].'" value="'.$row['book_id'].'">
							<input type="hidden" name="book_name" id="book_name'.$row['book_id'].'" value="'.$row['book_name'].'">
							<input type="hidden" name="img" id="img'.$row['book_id'].'" value="'.$row['img'].'">
							<input type="hidden" name="price" id="price'.$row['book_id'].'" value="'.$row['price'].'">';
							if (isset($_SESSION['loggedin'])) {
								$output .= '<button type="button" name="add_to_cart" id="'.$row['book_id'].'" class="btn btn-primary" style="width:80%;background-color:crimson">ADD TO CART </button>';
							}else
							{
								$output .= '<input type="submit" name="submit" value="ADD TO CART" class="btn btn-primary login btnself" style="width:80%;background-color:crimson">';;
							}
						$output.='</form> </div>';
						
					}

					echo $output;

				?>
				<div class="more"> <a href="best_sellers.php">View more of bestsellers</a> </div>
			</div>
			<br>
			<div class="tag">Action & Adventures</div>
			<div class="row">

				<?php 

					$output = '';
					$sql = "SELECT * FROM books WHERE category = 'Action & Adventures' ORDER BY book_id ASC LIMIT 6";
					$result = mysqli_query($link,$sql);

					while ($row = mysqli_fetch_array($result)) {
						
						$output .='<div class="col-sm-4" id="product">
							<a href="book_details.php?id='.$row['book_id'].'"><img src="'.$row['img'].'" width="80%" height="200" id="image_hover"></a>
							<h5 style="font-size:medium">'.$row['book_name'].'</h5>
							<h5 style="font-size:x-small">'.$row['author'].'</h5>
							<h5 style="font-size:larger;color:red">&#x20b9 '.$row['price'].'</h5>
							<form name="form" method="post">
							<input type="hidden" name="book_id" id="book_id'.$row['book_id'].'" value="'.$row['book_id'].'">
							<input type="hidden" name="book_name" id="book_name'.$row['book_id'].'" value="'.$row['book_name'].'">
							<input type="hidden" name="img" id="img'.$row['book_id'].'" value="'.$row['img'].'">
							<input type="hidden" name="price" id="price'.$row['book_id'].'" value="'.$row['price'].'">';
							if (isset($_SESSION['loggedin'])) {
								$output .= '<button type="button" name="add_to_cart" id="'.$row['book_id'].'" class="btn btn-primary" style="width:80%;background-color:crimson">ADD TO CART </button>';
							}else
							{
								$output .= '<input type="submit" name="submit" value="ADD TO CART" class="btn btn-primary login" style="width:80%;background-color:crimson">';;
							}
						$output.='</form> </div>';
						
					}

					echo $output;

				?>
				<div class="more"> <a href="best_sellers.php">View more of Action & Adventures</a> </div>
			</div>
			<br>
			<div class="tag">Business & Management</div>
			<div class="row">

				<?php 

					$output = '';
					$sql = "SELECT * FROM books WHERE category = 'Business & Management' ORDER BY book_id ASC LIMIT 6";
					$result = mysqli_query($link,$sql);

					while ($row = mysqli_fetch_array($result)) {
						
						$output .='<div class="col-sm-4" id="product">
							<a href="book_details.php?id='.$row['book_id'].'"><img src="'.$row['img'].'" width="80%" height="200" id="image_hover"></a>
							<h5 style="font-size:medium">'.$row['book_name'].'</h5>
							<h5 style="font-size:x-small">'.$row['author'].'</h5>
							<h5 style="font-size:larger;color:red">&#x20b9 '.$row['price'].'</h5>
							<form name="form" method="post">
							<input type="hidden" name="book_id" id="book_id'.$row['book_id'].'" value="'.$row['book_id'].'">
							<input type="hidden" name="book_name" id="book_name'.$row['book_id'].'" value="'.$row['book_name'].'">
							<input type="hidden" name="img" id="img'.$row['book_id'].'" value="'.$row['img'].'">
							<input type="hidden" name="price" id="price'.$row['book_id'].'" value="'.$row['price'].'">';
							if (isset($_SESSION['loggedin'])) {
									$output .= '<button type="button" name="add_to_cart" id="'.$row['book_id'].'" class="btn btn-primary" style="width:80%;background-color:crimson">ADD TO CART </button>';
								}else
								{
									$output .= '<input type="submit" name="submit" value="ADD TO CART" class="btn btn-primary login" style="width:80%;background-color:crimson">';;
								}
							$output.='</form> </div>';
						
					}

					echo $output;

				?>
				<div class="more"> <a href="best_sellers.php">View more of Business & Management</a> </div>
			</div>

		</div>

		</div>
	</div>
<?php  require_once 'footer.php'; ?>