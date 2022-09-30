<?php 
    require_once 'header_rent.php'; 
     require_once '../user/categories.php';
    require_once 'search.php';
   
    
?>
<style>
#image_hover:hover{
      z-index:1;
        transform: scale(2.0);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }
</style>
<div class="container">
	<div class="row">
		<div class="col-sm-3">
		
		</div>
		<div class="col-sm-9">
			<span id="status"></span>
			<div class="tag" width:100%>Result</div>
            <br><br>
			<div class="row">

            <?php
                require_once '../config.php';
                if(isset($_POST['submit_result']))
                {
                    if(!empty($_POST['submit_name']))
                    {
                        $name = $_POST['submit_name'];
                        $count=0;
                        $sql = "Select * from rent_books";
                        $row="";
                        $id = "";
                        $num = 0;
                        $output = '';

                        $result =  mysqli_query($link,$sql);
                        while ($row = mysqli_fetch_array($result)) 
                            {
                            $var = $row['book_name'];
                            if(preg_match("/{$name}/i",$var))
                            {
                                $count = 1;
                                /*if($num == 0)
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
                                }*/
                                

                                
                                    
                                $output .='<div class="card mb-3" style="max-width:100%  border-radius:10px">
                                <div class="row g-0">
                                   <div class="col-md-3" >
                                       &nbsp; &nbsp;&nbsp; &nbsp; 
                                       <div id="demo" class="carousel slide" data-ride="carousel">
            
                                       
                                     
                                       <!-- The slideshow -->
                                       <div class="carousel-inner" id="image_hover">
                                         <div class="carousel-item active">
                                           <img src="'.$row['img'].'" alt=""width="100%" height="200">
                                         </div>
                                         <div class="carousel-item ">
                                           <img src="'.$row['img2'].'" alt="" width="100%" height="200">
                                         </div>
                                         <div class="carousel-item ">
                                           <img src="'.$row['img3'].'" alt="" width="100%" height="200">
                                         </div>
                                       </div>
                                     
                                    
                                     
                                     </div>
                                     
                                   </div>
                                  <div class="col-md-8">
                                    <div class="card-body">
                                     <h5 class="card-title">'.$row['book_name'].'</h5>
                                      <p class="card-text">'.$row['description'].'</p>
                                      <p class="card-text"><small class="text-muted">₹ '.$row['price'].'/day </small></p>
                                      
                                   '
                                    .'
                                    <form name="form" method="post">
                                    <input type="hidden" name="book_id" id="book_id'.$row['id'].'" value="'.$row['id'].'">
                                    <input type="hidden" name="book_name" id="book_name'.$row['id'].'" value="'.$row['book_name'].'">
                                    <input type="hidden" name="img" id="img'.$row['id'].'" value="'.$row['img'].'">
                                    <input type="hidden" name="price" id="price'.$row['id'].'" value="'.$row['price'].'">';
                                    if (isset($_SESSION['loggedin'])) {
                                      
                                        $output .= '<button type="button" name="add_to_cart" id="'.$row['id'].'" class="btn btn-primary" style="width:30%;background-color:crimson">ADD TO CART </button>';
                                    }else
                                    {
                                        $output .= '<input type="submit" name="submit" value="ADD TO CART" class="btn btn-primary login" style="width:30%;background-color:crimson">';;
                                    }
                                $output.='</form>  </div>
                                  </div>
                               </div>
                              </div>';
                                
                            }  
                        }
                        echo $output;
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