<?php
include '../config.php';
include 'header.php';
$id = $_GET['id'];
$_SESSION['book_id'] = $id;
$output ='';
$sql = "SELECT * FROM books WHERE book_id= $id";
$result = mysqli_query($link,$sql);

					while ($row = mysqli_fetch_array($result)) {
						
						$output .='<div  id="product">
							<a href="book_details.php?id='.$row['book_id'].'"><img src="'.$row['img'].'" width="80%" height="200"></a>
							<h5 style="font-size:medium">'.$row['book_name'].'</h5>
							<h5 style="font-size:x-small">'.$row['author'].'</h5>
							<h5 style="font-size:larger;color:red">&#x20b9 '.$row['price'].'</h5>
							<form name="form" method="post">
							<input type="hidden" name="book_id" id="book_id'.$row['book_id'].'" value="'.$row['book_id'].'">
							<input type="hidden" name="book_name" id="book_name'.$row['book_id'].'" value="'.$row['book_name'].'">
							<input type="hidden" name="img" id="img'.$row['book_id'].'" value="'.$row['img'].'">
							<input type="hidden" name="price" id="price'.$row['book_id'].'" value="'.$row['price'].'">
							<button type="button" name="add_to_cart" id="'.$row['book_id'].'" class="btn btn-primary" style="width:80%;background-color:crimson">ADD TO CART </button>';
							$output.='</form> </div>';
						
					}

//     function reviews(){
//         include '../config.php';
//         $id = $_SESSION['book_id'];
//         $review ='';
//         $sql = "SELECT * FROM rating WHERE book_id = $id  ORDER BY id DESC LIMIT 7";
//         $result = mysqli_query($link,$sql);
//         while($row = mysqli_fetch_array($result)){

//         $review  .= '<div class="alert alert-info" role="alert">
//                     <h5 class="alert-heading">'.$row['rating'].'<i class="fas fa-star" style="color:orange"></i>&nbsp;&nbsp;'.$row['rating_title'].'</h5>
//                     <p>'.$row['review'].'</p>
//                     <hr>
//                     <p class="mb-0">'.obfuscate_email($row['email']).'&nbsp;&nbsp; <i class="float-right">'.$row['date'].'</i></p>
//                 </div>';
// }


//     return $review;
//     }

    
// to get current page
    if(isset($_GET['page'])){

        $page = $_GET['page'];
    }else{
        $page =1;
    }

//function to paginate reviews
    function paginate_reviews($page,$sorter,$order){

        include '../config.php';
        $limit =7;
        $offset = ($page -1)*$limit;
        $id = $_SESSION['book_id'];
        $review ='';
        $sql = "SELECT * FROM rating WHERE book_id = $id  ORDER BY $sorter $order LIMIT $offset,$limit";
        $result = mysqli_query($link,$sql);
        while($row = mysqli_fetch_array($result)){

        $review  .= '<div class="alert alert-light border border-default" role="alert">
                    <h6 class="alert-heading"><span class="badge badge-success">'.$row['rating'].'&nbsp;<i class="fas fa-star" style="color:white"></i></span>&nbsp;&nbsp;'.$row['rating_title'].'</h6>
                    <p>'.$row['review'].'</p>
                    <hr>
                    <p class="mb-0">'.obfuscate_email($row['email']).'&nbsp;&nbsp; <span class="float-right">'.$row['date'].'</span></p>
                </div>';
        }
        
        $sql = "SELECT * FROM rating WHERE book_id = $id";
        $result = mysqli_query($link,$sql);
        $total_results = mysqli_num_rows($result);
            if($total_results > 0 && $total_results > $limit){
            $pages = ceil($total_results/$limit);
            $review.= '<ul class="pagination">';
            if ($page >= 2) {

						$review.= '<li class="page-item"><a class="page-link" href="book_details.php?page='.($page-1).'&id='.$id.'">Previous</a></li>';

					}
            for($i =1; $i<=$pages; $i++){

                $review .='<li class="page-item"><a class="page-link" href="book_details.php?page='.$i.'&id='.$id.'">'.$i.'</a></li>';
            }

            
			if ($page<$pages) {

			    $review .='<li class="page-item"><a class="page-link" href="book_details.php?page='.($page+1).'&id='.$id.'">Next</a></li>';
			}
            $review .='</ul>';
        }
    return $review;


    }



//to hide email characters
function obfuscate_email($email)
{
    $em   = explode("@",$email);
    $name = implode('@', array_slice($em, 0, count($em)-1));
    $len  = floor(strlen($name)/2);

    return substr($name,0, $len) . str_repeat('*', $len) . "@" . end($em);   
}

//function to fetch rating
function rating($rating){
    include '../config.php';
    $book_id = $_SESSION['book_id'];
    $sql = "SELECT * FROM rating WHERE book_id = $book_id AND rating = $rating";
    $result = mysqli_query($link,$sql);
    $rating = mysqli_num_rows($result);

    return $rating;
}


// function to calculate average rating
function avg_rating(){
    include '../config.php';
    $rating =0;
    $book_id = $_SESSION['book_id'];
    $sql = "SELECT rating FROM rating WHERE book_id = $book_id ";
    $result = mysqli_query($link,$sql);
     $d = mysqli_num_rows($result);
     if($d >0){
    while($row = mysqli_fetch_array($result)){

        $rating += $row['rating'];
    }

    $avg= round(($rating/(float)$d),1);

    return $avg.'&nbsp;<i class="fas fa-star"></i>';
}
}


//to count rating and reviews
function rating_review_counter(){

    include '../config.php';
    $book_id = $_SESSION['book_id'];
    $sql1 = "SELECT rating FROM rating WHERE book_id = $book_id ";
    $result1 = mysqli_query($link,$sql1);
    $total_rating = mysqli_num_rows($result1);
    $sql2 = "SELECT review FROM rating WHERE book_id = $book_id ";
    $result2 = mysqli_query($link,$sql2);
    $total_review =0;
    while($row = mysqli_fetch_array($result2)){

        if($row['review'] !== '')
        {
            $total_review += 1;
        }

    }
    return '<div class="text-muted">'.$total_rating.' rating and '.$total_review.' review</div>';

}

//function to calculate rate bar width percentage
function rate_bar($key){
    include '../config.php';
    $num =0;
    $book_id = $_SESSION['book_id'];
    $sql = "SELECT count(rating) FROM rating WHERE book_id = $book_id ";
    $result = mysqli_query($link,$sql);
    $rating = mysqli_num_rows($result);
    $sql = "SELECT rating FROM rating WHERE book_id = $book_id ";
    $result = mysqli_query($link,$sql);
    $rating = mysqli_num_rows($result);
    
    while($row = mysqli_fetch_array($result)){

        if($row['rating'] == $key)
        {
            $num +=1;
        }

        
    }
    if($rating!==0)
    $width = ceil(($num/$rating)*100);

        return $width ?? '';
    
}

?>



<div class="container">
<div class="row">
    <div class="col-xs-12 col-sm-12 col-lg-3">
        <?= $output ?>
        
    </div>
    <div class="col-sm-12 col-lg-9 col-9 ">
                    <hr>
        <h5>Book Rating and Reviews</h5>
     <table class="">
        <tr>
        <td class="w-25" rowspan="5" style="text-align: center;vertical-align:middle;"> 
                 <h4><?= avg_rating()?></h4>   
                 <h6><?= rating_review_counter() ?></h6>
        </td>
      <?php 
      $out ='';
      for($i=5;$i>=1;$i--)
       {
           $out.='<td>
        <div class="float-left ml-3" style="line-height: 20px;">&nbsp;'.$i.' <i class="fas fa-star"></i>&nbsp;&nbsp;</div>&nbsp; <div class="progress w-50 float-left">
        <div class="progress-bar '.$i.'-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
        </div><div class="float-left" style="line-height: 15px;margin-left:10px">'.rating($i).'</div>
        </td>
        </tr>

         <tr>';
       }

       echo $out;
       ?>
    </table>

    <hr>
    <h4>Write a Review</h4>
    <?php
    if(isset($_SESSION['id']))
    {
            echo '<button class="btn btn-primary" type="button" name="RateBtn">Add Review &nbsp; <i class="fas fa-pen"></i></button>';
    }else{
        echo '<input type="submit" name="submit" value="Login to Review" 
								class="btn btn-primary login" >';
    }  
    ?>

    <!-- form for getting sorter values  -->
    <form action="" method="post" class="float-right form-inline">
        <label for="">Sort reviews  &nbsp;&nbsp;</label>
        <select name="review_sort" id="review_sort" class="form-control ">
            <option value="" disabled selected>Select</option>
            <option value="0">newest first</option>
            <option value="1">positive first </option>
            <option value="2">negative first </option>

        </select>
    </form>
                    
                    <hr>
                   <?php if(!isset($_SESSION['text'])){ $_SESSION['text'] = 'most helpful';}  ?>
    <div><span class="h4">User Reviews</span> &nbsp;&nbsp; <span class="review_msg"><?= '(Showing: &nbsp;'.$_SESSION['text'].')' ?? ''; ?></span></div>
        <div class="reviews mt-3">

            <?php 

        if(isset($_SESSION['sorter']))
        {
            $sorter = $_SESSION['sorter'];
            $order = $_SESSION['order'];

        }else{

            $sorter = 'id';
            $order =  'DESC';
        }
            
            echo paginate_reviews($page,$sorter,$order); 
                
            ?>
        </div>
    

    </div>

    
</div>
</div>

<script type="text/javascript">

    $(document).ready(

        function(){

            ratebar();
        function ratebar(){

          $('.5-bar').addClass("bg-success");
          $('.5-bar').css("width","<?php echo rate_bar(5).'%'; ?>");

          $('.4-bar').addClass("bg-primary");
          $('.4-bar').css("width","<?php echo rate_bar(4).'%'; ?>");

          $('.3-bar').addClass("bg-info");
          $('.3-bar').css("width","<?php echo rate_bar(3).'%'; ?>");

          $('.2-bar').addClass("bg-warning");
          $('.2-bar').css("width","<?php echo rate_bar(2).'%'; ?>");

          $('.1-bar').addClass("bg-danger");
          $('.1-bar').css("width","<?php echo rate_bar(1).'%'; ?>");
        }


        $('#review_sort').change(function(){

            var sort = $(this).val();
            var text = $("#review_sort option:selected").text();
           
            $.ajax({
                
                url: "review_sorter.php",
                method: "POST",
                data: {sort:sort,text:text},
                dataType: 'text',
                success: function(){
                
                window.location.href = window.location.href;

                }

            });
            
        });
        }


    );

    jQuery(function() {
         var path = window.location.href;
         $('ul li a').each(function() {
          if (this.href === path) {
           $(this).addClass('active');
          }
         });
        });
     

</script>
<?php  include 'footer.php'; ?>