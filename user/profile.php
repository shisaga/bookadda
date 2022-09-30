<?php

	 include_once 'header.php';
	 require_once 'logincheck.php';
	 include_once '../config.php';

	
	 $sql = "SELECT * FROM login WHERE  user_id = $_SESSION[id]";
	 $res = mysqli_query($link,$sql);

	 while ($row = mysqli_fetch_array($res)) {
	 	
	 	$name = $row['name'];
	 	$mobile = $row['mobile'];
	 	$username = $row['username'];

	 }

	 	$status=$error='';
	 if (isset($_POST['upload'])) {
	 	
	 	$filename = $_FILES['img']['name'];
	 	$tmp_name = $_FILES['img']['tmp_name'];
	 	$ext = pathinfo($filename,PATHINFO_EXTENSION);
	 	$allowed  = array('jpg','jpeg' );
	 	$file_size = $_FILES['img']['size'];
	 	$size = $file_size/(1024);
	 	$target = "images/".rand(1000,9999).".".$ext;
	 	if(empty($filename)){

	 		$error = "<span class='alert-danger p-2 error rounded'>Please select file to upload</span>";
	 	}else if(!in_array($ext,$allowed))
	 	{
	 		$error = "<span class='alert-danger p-2 error rounded'>Invalid file. please upload jpg/jpeg file only</span>";
	 	}else if($size > 1024)
	 	{
	 		$error = "<span class='alert-danger error p-2 rounded'>file size is greater than 1 MB</span>";
	 	}else{

	 		$new_width = 200;
	 		$new_height=200;
	 		$uploadDir= $tmp_name;
	 		$moveToDir = 'images/';
	 		

	 		$img = createThumbnail($filename,$new_width,$new_height,$uploadDir,$moveToDir);

	 		$sql = "UPDATE login SET image = '$img' WHERE user_id = $_SESSION[id]";
	 		$result = mysqli_query($link,$sql);

	 		if (move_uploaded_file($tmp_name, $img) && $result) {
	 			
	 			$status =  "<span class='alert-success p-2 rounded status'>Profile pic updated successfully</span>";


	 		}else{

	 			$error = "<span class='alert-danger errror p-2'>Error Occured</span>";;
	 		}
	 	}
	 	

	 }

	 $sql = "SELECT user_id,image FROM login WHERE user_id = $_SESSION[id]";
	 $res = mysqli_query($link,$sql);
	 while ($row = mysqli_fetch_array($res)) {
	 	
	 	$image = $row['image'];
	 }


	 function createThumbnail($image_name,$new_width,$new_height,$uploadDir,$moveToDir){
       
       $path = $uploadDir;

       $mime = getimagesize($path);

		   
		    if($mime['mime']=='image/jpg' || $mime['mime']=='image/jpeg' || $mime['mime']=='image/pjpeg') {
		        $src_img = imagecreatefromjpeg($path);
		    }   

		    $old_x          =   imageSX($src_img);
		    $old_y          =   imageSY($src_img);

			    if($old_x > $old_y) 
			    {
			        $thumb_w    =   $new_width;
			        $thumb_h    =   $old_y*($new_height/$old_x);
			    }

			    if($old_x < $old_y) 
			    {
			        $thumb_w    =   $old_x*($new_width/$old_y);
			        $thumb_h    =   $new_height;
			    }

			    if($old_x == $old_y) 
			    {
			        $thumb_w    =   $new_width;
			        $thumb_h    =   $new_height;
			    }
 
           $dst_img = ImageCreateTrueColor($thumb_w,$thumb_h);

        imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 


       // New save location
      $new_thumb_loc = $moveToDir . $image_name;

      if($mime['mime']=='image/jpg' || $mime['mime']=='image/jpeg' || $mime['mime']=='image/pjpeg') {
        $result = imagejpeg($dst_img,$new_thumb_loc,90);

    }

    imagedestroy($dst_img); 
    imagedestroy($src_img);

    return $new_thumb_loc;
}
 ?>
<div class="container">
	<div class="row">
		<div class="col-sm-4 col-md-4  col-lg-4 col-1"></div>
		<div class="col-sm-4 col-12 col-md-4 col-lg-4">
		<div><?php echo $error; ?></div>
		<div><?php echo $status; ?></div>
			
	 <div class="card mt-3 shadow-lg" style="width:300px; box-shadow: none;">
	 	<div class="card-header"><strong style="width: 100%;display: table;text-align: center;">YOUR PROFILE</strong></div>
    	
    <div class="card-body">
    	<div class="" id="pic" style="border:3px solid green ;width:150px;height:150px;border-radius: 50%;margin-left: 4rem;"><img src="<?php echo $image; ?>"  style="border-radius: 50%;width:145px;height:145px;"></div>
    <form method="post" enctype="multipart/form-data" class="">
    	<div class="form-group">
         <label class="text-center" style="font-size: 25px;margin-left: 120px;"><i class="fas fa-camera"></i>
     	<input type="file" name="img" style="display: none;">
     	</label>
    	</div>
   		 <div class="form-group">
    	 <button type="submit" class="btn btn-sm btn-success " name="upload" style="margin-left: 100px;margin-top: -20px;">Upload</button>
    </div>
    
    </form>
	<form action="profile_update.php" method="POST">
      <h4 class="card-title"><?php echo $name; ?></h4>
	  <?php
		//	if(isset($_POST['edit']))
		//	{
		//		echo'<input type="text" name="text1" class="form-control">';
//
		//	}
			
	  ?>

    </div>
      <div class="card-footer">
      <p class="card-text"><?php echo $username; ?></p>
      <p class="card-text"><?php echo $mobile; ?></p>
	  <input type="submit" value="Edit" class="btn btn-sm btn-success " name="edit" style="width:100%">
	  <?php
		//	if(isset($_POST['edit']))
		//	{
		//		echo'<input type="number" name="number1" class="form-control" maxlength="10">';
//
		//	}
			
	  ?>
	  
	  
	  <?php 
	// 	if(isset($_POST['edit']))
	//	  {
	//		  echo '<br/><br/><input type="submit" value="Submit" class="btn btn-sm btn-success " name="submit" style="width:100%">';
	//		  
	//	  }
	//	if(!isset($_POST['edit']))
	//	{
	//		echo '<input type="submit" value="Edit" class="btn btn-sm btn-success " name="edit" style="width:100%">';
	//		
	//	}
	  ?>
	  
	</form>
      
    </div>
   
  </div>
		</div>

		<div class="col-sm-4 col-md-4 col-lg-4 col-0"></div>
	</div>
</div>
<?php
//	 if(isset($_POST['submit']))
//			{
//				if(!empty($_POST['number1']) && !empty($_POST['text1']))
//				{
//					if(preg_match("/[a-zA-Z ]/",$_POST['text1']))
//					{
//						$error = 
//					}
//					else
//					{
//						$mob = $_POST['number1'];
//						$name_user = $_POST['text1'];
//						$sql = "Update login set mobile='$mob' Where mobile='$mobile'";
//						$sql1 = "Update login set name='$name_user' Where name='$name'";
//						//echo '<script type="text/JavaScript">  location.reload(); </script>';
//						mysqli_query($link,$sql);
//						mysqli_query($link,$sql1);
//					}
//				}
//				else if(!empty($_POST['text1']))
//				{
//					$name_user = $_POST['text1'];
//					$sql1 = "Update login set name='$name_user' Where name='$name'";
//					mysqli_query($link,$sql1);
//				}
//				else if(!empty($_POST['number1']))
//				{
//					$mob = $_POST['number1'];
//					$sql = "Update login set mobile='$mob' Where mobile='$mobile'";
//					mysqli_query($link,$sql);
//				}
//				else
//				{
//
//				}
//			}
//?>

 <?php include_once 'footer.php';  ?>