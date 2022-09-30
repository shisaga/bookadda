<?php 
    require_once 'header.php'; 
    require_once 'categories.php';
    require_once 'search.php';
?>
<div class="container">
	<div class="row">
		<div class="col-sm-3">
			<table class="sidebar">
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
			<div class="tag">Result</div>
			<div class="row">

            <?php
                require_once '../config.php';
                if(isset($_POST['submit_result']))
                {
                    if(!empty($_POST['submit_name']))
                    {
                        $name = $_POST['submit_name'];
                        $count=0;
                        $sql = "Select book_name from books";
                        $row="";
                        $id = "";
                        $num = 0;

                        $result =  mysqli_query($link,$sql);
                        while ($row = mysqli_fetch_array($result)) 
                            {
                            $var = $row['book_name'];
                            if(preg_match("/{$name}/i",$var))
                            {
                                $count = 1;
                                if($num == 0)
                                {
                                    $sql1 = "Select * From books";
                                    $result1 = $link->query($sql1);
                                    if ($result1->num_rows > 0) {
                                        while($row1 = $result1->fetch_assoc()) {
                                            $abcd = "" . $row1['book_name'];
                                        if($var == $abcd){
                                            $id = $row1["book_id"];
                                        }
                                        }
                                    }
                                }
                                $output = '';
                                $sql = "SELECT * FROM books where book_id = $id";
                                $result = mysqli_query($link,$sql);

                                while ($row = mysqli_fetch_array($result)) {
                                    
                                    $output .='<div class="col-sm-4" id="product">
                                        <img src="'.$row['img'].'" width="80%" height="200">
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
                                                $output .= '<button type="submit" class="btn btn-primary" style="width:80%;background-color:crimson" formaction="login.php">ADD TO CART </button>';;
                                            }
                                }
                                echo $output;
                            }   
                        }
                        if($count == 0)
                        {
                            echo "<img src='images/no_result.gif' alt=''>";
                        }
                    }
                    else
                    {
                        echo "<img src='images/no_result.gif' alt=''>";
                    }
                }
            ?>
			</div>

			
			
			

		</div>

		</div>
	</div>
<?php require_once 'footer.php'; ?>