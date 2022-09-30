<?php
 require_once 'header.php';
 require_once 'logincheck.php';
 require_once '../config.php';

 $bookname_error=$author_error=$price_error=$category_error=$image_err=$image_err2=$image_err3=$Desc_error ="";
 $bookname = $author = $price = $category = $image=$status=$Description= "";

 if (isset($_POST['submit'])) {

      //validate book name
      if (empty($_POST['book_name'])) {
         $bookname_error = "Please Enter Book Name";
      }else {
        $bookname = test_input($_POST['book_name']);
        $name_pattern = '/^[a-zA-Z0-9 ]+$/';
        if (!preg_match($name_pattern,$bookname)) {
           $bookname_error ="please enter valid book name";
        }
      }
        //validate Author
        if (empty($_POST['author'])) {
           $author_error = "Please Enter Author Name";
        }else {
          $author = test_input($_POST['author']);
          $author_pattern = '/^[a-zA-Z ]+$/';
          if (!preg_match($author_pattern,$author)) {
             $author_error ="Please Enter Valid Name";
          }
        }

          //validate $price_error
          if (empty($_POST['price'])) {
             $price_error = "Please Enter Price";
          }else {
            $price = test_input($_POST['price']);
            $price_pattern = '/^[0-9]+$/';
            if (!preg_match($price_pattern,$price)) {
               $price_error ="Please Enter Valid Price";
            }
          }

          //validate category
          if ($_POST['category'] == "--Select--") {
             $category_error = "Please Select Category";
          }
		  else {
			  $category = $_POST['category'];
		  }

          //validate book image

          if (!isset($_FILES['book_img'])) {
            $image_err = "Please Select a Image";
          }
          else {
                $target = "../rent/book_img/";
                $file_name = $_FILES['book_img']['name'];
                $file_type = $_FILES['book_img']['type'];
                $file_size = $_FILES['book_img']['size'];
                $tmp_name = $_FILES['book_img']['tmp_name'];
                $allowed  = array('jpg' =>'image/jpg' ,'jpeg'=>'image/jpeg' );

                if (!in_array($file_type,$allowed)) {
                  $image_err = "Please Select jpg/jpeg File";
                }

                $maxsize = 1*1024*1024;
                if ($file_size> $maxsize) {
                  $image_err ="File Size Is Greater Than 1 MB";
                }

                if (in_array($file_type,$allowed) && $file_size<$maxsize && $_FILES['book_img']['error']===0) {

                    $newname = rand().$file_name;
                    $target = $target.$newname;
                    $image = $target;
                  move_uploaded_file($tmp_name,$target);
                }

          }

          if (!isset($_FILES['book_img2'])) {
            $image_err = "Please Select a Image";
          }
          else {
                $target = "../rent/book_img/";
                $file_name = $_FILES['book_img2']['name'];
                $file_type = $_FILES['book_img2']['type'];
                $file_size = $_FILES['book_img2']['size'];
                $tmp_name = $_FILES['book_img2']['tmp_name'];
                $allowed  = array('jpg' =>'image/jpg' ,'jpeg'=>'image/jpeg' );

                if (!in_array($file_type,$allowed)) {
                  $image_err2 = "Please Select jpg/jpeg File";
                }

                $maxsize = 1*1024*1024;
                if ($file_size> $maxsize) {
                  $image_err2 ="File Size Is Greater Than 1 MB";
                }

                if (in_array($file_type,$allowed) && $file_size<$maxsize && $_FILES['book_img2']['error']===0) {

                    $newname = rand().$file_name;
                    $target = $target.$newname;
                    $image2 = $target;
                  move_uploaded_file($tmp_name,$target);
                }

          }

          if (!isset($_FILES['book_img3'])) {
            $image_err = "Please Select a Image";
          }
          else {
                $target = "../rent/book_img/";
                $file_name = $_FILES['book_img3']['name'];
                $file_type = $_FILES['book_img3']['type'];
                $file_size = $_FILES['book_img3']['size'];
                $tmp_name = $_FILES['book_img3']['tmp_name'];
                $allowed  = array('jpg' =>'image/jpg' ,'jpeg'=>'image/jpeg' );

                if (!in_array($file_type,$allowed)) {
                  $image_err3 = "Please Select jpg/jpeg File";
                }

                $maxsize = 1*1024*1024;
                if ($file_size> $maxsize) {
                  $image_err3 ="File Size Is Greater Than 1 MB";
                }

                if (in_array($file_type,$allowed) && $file_size<$maxsize && $_FILES['book_img3']['error']===0) {

                    $newname = rand().$file_name;
                    $target = $target.$newname;
                    $image3 = $target;
                  move_uploaded_file($tmp_name,$target);
                }

          }



          if (empty($_POST['Desc'])) {
            $Desc_error = "Please Enter Book Description";
         }else {
            $Description= test_input($_POST['Desc']);
         }
         
		  

          if(empty($bookname_error) && empty($author_error) && empty($price_error) && empty($category_error) && empty($image_err) && empty($Desc_error))
          {
              
             
            $sql = "INSERT INTO rent_books values('','$bookname','$price','$Description','$image','$image2','$image3','$author','$category',1)";

            if (mysqli_query($link,$sql)) {
               $status = '<div class="alert alert-success">Book Added Successfully!!</div>';
            }else {
             $status = '<div class="alert alert-danger">Error Adding Books</div>';
            }
          }

 }





 function test_input($data){
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
 }
 ?>
 <div class="container">
   <div class="row">

     <div class="col-lg-12">
       <div class="row">
         <div class="col-sm-3"> </div>
            <div class="col-sm-5">
              <h4 class="text-warning">Provide Below Details To Add Book</h4><br>
              <span><?php echo $status; ?></span>
              <form class="form" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for=""  style="font-weight:bold;font-size:18px">Name of Book</label>
                <input type="text" name="book_name" value="" class="form-control">
                <span class="text-danger"><?php echo $bookname_error;  ?></span>
              </div>
              <div class="form-group">
                <label for="" style="font-weight:bold;font-size:18px">Author</label>
                <input type="text" name="author" value="" class="form-control">
                <span class="text-danger"><?php echo $author_error;  ?></span>
              </div>
              <div class="form-group">
                <label for="" style="font-weight:bold;font-size:18px">Price</label>
                <input type="text" name="price" value="" class="form-control">
                <span class="text-danger"><?php echo $price_error;  ?></span>
              </div>
           
              <div class="form-group">
                <label for="" style="font-weight:bold;font-size:18px">Category</label>
				<select name="category" value="" class="form-control">
					<option>--Select--</option>
					<option>Action & Adventures</option>
					<option>Best Sellers</option>
					<option>Novels</option>
					<option>Comics</option>
					<option>Indian Writings</option>
					<option>Business & Management</option>
					
				</select >
                <!--<input type="text" name="category" value="" class="form-control">-->
                <span class="text-danger"><?php echo $category_error;  ?></span>
              </div>
              <div class="form-group">
                <label for="" style="padding-botton:10px;font-weight:bold;font-size:18px;">Upload Book 3 Image of book</label><br>
                <font color="#FEA100"> *Upload Front Side of The Book</font>
                <input type="file" name="book_img" value="" class="form-control" placeholder="Select image-1"> 
                <span class="text-danger"><?php echo $image_err;  ?></span>
                <br>
                <input type="file" name="book_img2" value="" class="form-control">
                <span class="text-danger"><?php echo $image_err2;  ?></span>
                <br>
                <input type="file" name="book_img3" value="" class="form-control">
                <span class="text-danger"><?php echo $image_err3;  ?></span>
              </div> 
              <div class="form-floating">
                  <label for="floatingTextarea2" style="font-weight:bold;font-size:18px">Description</label>
              <textarea class="form-control" placeholder="Write description of book" id="floatingTextarea2"  name = "Desc" style="height: 100px"></textarea>
              <span class="text-danger"><?php echo $Desc_error;  ?></span>
             </div>
             <br>
              <div class="form-group">
               <input type="submit" name="submit" value="Add Book" style="width:100%" class="btn btn-success">
              </div>
          </form>
            </div>
               <div class="col-sm-"4> </div>
       </div>

     </div>
   </div>
 </div>
<?php require_once 'footer.php'; ?>