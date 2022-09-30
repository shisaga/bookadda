
<?php
require_once '../config.php';

if(isset($_POST['submit']))
{
  if(!isset($_FILES['image']))
  {

    echo '<div class="alert alert-danger alert-dismissable">Error: please select file</div>';

  }else{
      $target = "";

      $file_name= $_FILES['image']['name'];
      $file_type = $_FILES['image']['type'];
      $file_size=  $_FILES['image']['size'];
      $tmp_name =  $_FILES['image']['tmp_name'];

      $allowed  = array('jpg' => 'image/jpg','jpeg'=>'image/jpeg' );

      if(!in_array($file_type,$allowed))
      {
          echo '<div class="alert alert-danger alert-dismissable">Error: Select jpg/jpeg file</div>';
      }

      $maxsize = 1*1024*1024;

      if($file_size>$maxsize)
      {
          echo '<div class="alert alert-danger alert-dismissable">Error: file should be less than 1 mb</div>';
      }

      if (($_FILES['image']['error'] === 0) && in_array($file_type,$allowed) && $file_size<$maxsize) {

          $newname =rand().$file_name;
          $image = $target.$newname;
          $target = "images/".$newname;
      if( move_uploaded_file($tmp_name,$target))
      {
        $sql = "insert into image values ('','$image')";

        if(mysqli_query($link,$sql))
        {
          echo '<div class="alert alert-success alert-dismissable">Success: file is successfully uploaded</div>';
        }else {
          echo '<div class="alert alert-danger alert-dismissable">Error: occured</div>';
        }
      }

    }



  }


}
 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>upload image</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
   </head>
   <body>
     <form class=""  method="post" enctype="multipart/form-data">
        <input type="file" name="image" value="" class="form-contorl">
        <input type="submit" name="submit" value="Upload" class="btn btn-primary">
        <span class="text-danger">

        </span>
     </form>
   </body>
 </html>
