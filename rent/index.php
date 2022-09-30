<?php
require_once 'header_rent.php';
require_once '../config.php';

require_once 'search.php';

if(!$link){

echo "<script> window.location.href = 'error.php' </script>";
} 
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
    <table class="sidebar">
				<tr><td>CATEGORIES</td></tr>
				<tr><td class="hov"><a href="best_sellers.php">Best Sellers</a></td></tr>
				<tr><td class="hov"><a href="Action&Adventure.php">Action & Adventures</a></td></tr>
				<tr><td class="hov"><a href="Business & Management.php">Business & Management</a></td></tr>
				<tr><td class="hov"><a href="Novels.php">Novels</a></td></tr>
				<tr><td class="hov"><a href="comics.php">Comics</a></td></tr>
				<tr><td class="hov"><a href="indian_writing.php">Indian Writings</a></td></tr>
			</table>
    </div>
    <div class="col-sm-9">
        <span id="status"></span>
       
        <div class="row">
             <div class="tag">BEST SELLERS</div>
               <br><br>
            <?php 
                $count =0;
               $output="";
                $sql = "SELECT * FROM rent_books WHERE category = 'Best Sellers' ORDER BY id ASC ";
                $result = mysqli_query($link,$sql);
                 $_SESSION['sorter'] ='id';
                 $_SESSION['order'] = "DESC";
                $_SESSION['text'] = "most helpful";
                while ($row = mysqli_fetch_array($result)) {
                  
                    
                    $output .='<div class="card mb-3" style="max-width:100%  border-radius:10px">
                    <div class="row g-0">
                       <div class="col-md-3" >
                           &nbsp; &nbsp;&nbsp; &nbsp; 
                           <div id="demo" class="carousel slide" data-ride="carousel">

                           <!-- Indicators -->
                           
                         
                           <!-- The slideshow -->
                           <div class="carousel-inner" id="image_hover">
                             <div class="carousel-item active" >
                             <a href="book_details.php?id='.$row['id'].'"><img src="'.$row['img'].'" width="100%" height="200"></a>
                             </div>
                             <div class="carousel-item " >
                             <a href="book_details.php?id='.$row['id'].'"><img src="'.$row['img2'].'" width="100%" height="200"></a>
                             </div>
                             <div class="carousel-item " >
                             <a href="book_details.php?id='.$row['id'].'"><img src="'.$row['img3'].'" width="100%" height="200"></a>
                             </div>
                           </div>
                         
                           <!-- Left and right controls -->
                           
                         
                         </div>
                         
                       </div>
                      <div class="col-md-8">
                        <div class="card-body">
                         <h5 class="card-title">'.$row['book_name'].'</h5>
                          <p class="card-text" style="text-align:justify">'.$row['description'].'</p>
                          <p class="card-text">by <b>'.$row['author'].'</b></p>
                          <p class="card-text">₹ '.$row['price'].'/day</p>
                          
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
                    $count =$count +1;
                }

                echo $output;
              //if(isset($_POST[]))

            ?>
      <div class="more"> <a href="best_sellers.php">View more of Best Sellers</a> </div>

    </div>
    <!-- <div class="row">
             <div class="tag">Action & Adventures</div>
               <br><br>
            <?php /*

               $output="";
                $sql = "SELECT * FROM rent_books WHERE category = 'Action & Adventures' ORDER BY id ASC ";
                $result = mysqli_query($link,$sql);
                 $_SESSION['sorter'] ='id';
                 $_SESSION['order'] = "DESC";
                $_SESSION['text'] = "most helpful";
                while ($row = mysqli_fetch_array($result)) {
                    
                    $output .='<div class="card mb-3" style="max-width:100%  border-radius:10px">
                    <div class="row g-0">
                       <div class="col-md-3" >
                           &nbsp; &nbsp;&nbsp; &nbsp; 
                           <div id="demo" class="carousel slide" data-ride="carousel">

                           <!-- Indicators -->
                           <ul class="carousel-indicators">
                             <li data-target="" data-slide-to="0" class="active"></li>
                             <li data-target="" data-slide-to="1" ></li>
                             <li data-target="" data-slide-to="2" ></li>
                           </ul>
                         
                           <!-- The slideshow -->
                           <div class="carousel-inner">
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
                         
                           <!-- Left and right controls -->
                           <a class="carousel-control-prev" href="#demo" data-slide="prev" >
                             <span class="carousel-control-prev-icon"></span>
                           </a>
                           <a class="carousel-control-next" href="#demo" data-slide="next">
                             <span class="carousel-control-next-icon"></span>
                           </a>
                         
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
                          
                            $output .= '<a href="rentit.php" class="btn btn-danger" target="_blank">Rent it</a> <button type="button" name="add_to_cart" id="'.$row['id'].'" class="btn btn-primary" style="width:30%;background-color:crimson">ADD TO CART </button>';
                        }else
                        {
                            $output .= ' <a href=cm_rent.php><button class="btn btn-danger">Rent It</button></a>  <input type="submit" name="submit" value="ADD TO CART" class="btn btn-primary login" style="width:30%;background-color:crimson">';;
                        }
                    $output.='</form>  </div>
                      </div>
                   </div>
                  </div>';
                    
                }

                echo $output;
              //if(isset($_POST[]))

            ?>
      <div class="more"> <a href="Action&Adventure.php">View more of Action & Adventures</a> </div>

    </div>
    <div class="row">
             <div class="tag">Business & Management</div>
               <br><br>
            <?php 

               $output="";
                $sql = "SELECT * FROM rent_books WHERE category = 'Business & Management' ORDER BY id ASC ";
                $result = mysqli_query($link,$sql);
                 $_SESSION['sorter'] ='id';
                 $_SESSION['order'] = "DESC";
                $_SESSION['text'] = "most helpful";
                while ($row = mysqli_fetch_array($result)) {
                    
                    $output .='<div class="card mb-3" style="max-width:100%  border-radius:10px">
                    <div class="row g-0">
                       <div class="col-md-3" >
                           &nbsp; &nbsp;&nbsp; &nbsp; 
                           <div id="demo" class="carousel slide" data-ride="carousel">

                           <!-- Indicators -->
                           <ul class="carousel-indicators">
                             <li data-target="" data-slide-to="0" class="active"></li>
                             <li data-target="" data-slide-to="1" ></li>
                             <li data-target="" data-slide-to="2" ></li>
                           </ul>
                         
                           <!-- The slideshow -->
                           <div class="carousel-inner">
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
                         
                           <!-- Left and right controls -->
                           <a class="carousel-control-prev" href="#demo" data-slide="prev" >
                             <span class="carousel-control-prev-icon"></span>
                           </a>
                           <a class="carousel-control-next" href="#demo" data-slide="next">
                             <span class="carousel-control-next-icon"></span>
                           </a>
                         
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
                          
                            $output .= '<a href="rentit.php" class="btn btn-danger" target="_blank">Rent it</a> <button type="button" name="add_to_cart" id="'.$row['id'].'" class="btn btn-primary" style="width:30%;background-color:crimson">ADD TO CART </button>';
                        }else
                        {
                            $output .= ' <a href=cm_rent.php><button class="btn btn-danger">Rent It</button></a>  <input type="submit" name="submit" value="ADD TO CART" class="btn btn-primary login" style="width:30%;background-color:crimson">';;
                        }
                    $output.='</form>  </div>
                      </div>
                   </div>
                  </div>';
                    
                }

                echo $output;
              //if(isset($_POST[]))

            ?>
      <div class="more"> <a href="Business & Management.php">View more of Business & Management</a> </div>

    </div>

    <div class="row">
             <div class="tag">Novels</div>
               <br><br>
            <?php 

               $output="";
                $sql = "SELECT * FROM rent_books WHERE category = 'Novels' ORDER BY id ASC ";
                $result = mysqli_query($link,$sql);
                 $_SESSION['sorter'] ='id';
                 $_SESSION['order'] = "DESC";
                $_SESSION['text'] = "most helpful";
                while ($row = mysqli_fetch_array($result)) {
                    
                    $output .='<div class="card mb-3" style="max-width:100%  border-radius:10px">
                    <div class="row g-0">
                       <div class="col-md-3" >
                           &nbsp; &nbsp;&nbsp; &nbsp; 
                           <div id="demo" class="carousel slide" data-ride="carousel">

                           <!-- Indicators -->
                           <ul class="carousel-indicators">
                             <li data-target="" data-slide-to="0" class="active"></li>
                             <li data-target="" data-slide-to="1" ></li>
                             <li data-target="" data-slide-to="2" ></li>
                           </ul>
                         
                           <!-- The slideshow -->
                           <div class="carousel-inner">
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
                         
                           <!-- Left and right controls -->
                           <a class="carousel-control-prev" href="#demo" data-slide="prev" >
                             <span class="carousel-control-prev-icon"></span>
                           </a>
                           <a class="carousel-control-next" href="#demo" data-slide="next">
                             <span class="carousel-control-next-icon"></span>
                           </a>
                         
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
                          
                            $output .= '<a href="rentit.php" class="btn btn-danger" target="_blank">Rent it</a> <button type="button" name="add_to_cart" id="'.$row['id'].'" class="btn btn-primary" style="width:30%;background-color:crimson">ADD TO CART </button>';
                        }else
                        {
                            $output .= ' <a href=cm_rent.php><button class="btn btn-danger">Rent It</button></a>  <input type="submit" name="submit" value="ADD TO CART" class="btn btn-primary login" style="width:30%;background-color:crimson">';;
                        }
                    $output.='</form>  </div>
                      </div>
                   </div>
                  </div>';
                    
                }

                echo $output;
              //if(isset($_POST[]))

            ?>
      
      <div class="more"> <a href="Novels.php">View more of Novels</a> </div>
    </div>

    <div class="row">
             <div class="tag">Comics</div>
               <br><br>
            <?php 

               $output="";
                $sql = "SELECT * FROM rent_books WHERE category = 'Comics' ORDER BY id ASC ";
                $result = mysqli_query($link,$sql);
                 $_SESSION['sorter'] ='id';
                 $_SESSION['order'] = "DESC";
                $_SESSION['text'] = "most helpful";
                while ($row = mysqli_fetch_array($result)) {
                    
                    $output .='<div class="card mb-3" style="max-width:100%  border-radius:10px">
                    <div class="row g-0">
                       <div class="col-md-3" >
                           &nbsp; &nbsp;&nbsp; &nbsp; 
                           <div id="demo" class="carousel slide" data-ride="carousel">

                           <!-- Indicators -->
                           <ul class="carousel-indicators">
                             <li data-target="" data-slide-to="0" class="active"></li>
                             <li data-target="" data-slide-to="1" ></li>
                             <li data-target="" data-slide-to="2" ></li>
                           </ul>
                         
                           <!-- The slideshow -->
                           <div class="carousel-inner">
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
                         
                           <!-- Left and right controls -->
                           <a class="carousel-control-prev" href="#demo" data-slide="prev" >
                             <span class="carousel-control-prev-icon"></span>
                           </a>
                           <a class="carousel-control-next" href="#demo" data-slide="next">
                             <span class="carousel-control-next-icon"></span>
                           </a>
                         
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
                          
                            $output .= '<a href="rentit.php" class="btn btn-danger" target="_blank">Rent it</a> <button type="button" name="add_to_cart" id="'.$row['id'].'" class="btn btn-primary" style="width:30%;background-color:crimson">ADD TO CART </button>';
                        }else
                        {
                            $output .= ' <a href=cm_rent.php><button class="btn btn-danger">Rent It</button></a>  <input type="submit" name="submit" value="ADD TO CART" class="btn btn-primary login" style="width:30%;background-color:crimson">';;
                        }
                    $output.='</form>  </div>
                      </div>
                   </div>
                  </div>';
                    
                }

                echo $output;
              //if(isset($_POST[]))

            */?>
      <div class="more"> <a href="Action&Adventure.php">View more of Comics</a> </div>

    </div> -->
    </div>
    </div>
</div>
<?php  require_once 'footer.php'; ?>