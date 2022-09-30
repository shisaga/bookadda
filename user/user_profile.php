<?php


	 include_once 'header.php';
	 require_once 'logincheck.php';
	 include_once '../config.php';

	 $sql = "SELECT * FROM login WHERE user_id = $_SESSION[id]";
	 $res = mysqli_query($link,$sql);

	 while($row = mysqli_fetch_array($res)){

	 	$name = $row['name'];
	 	$mobile = $row['mobile'];
	 	$email = $row['username'];
	 	$city = $row['city'];
	 }




	 	$status=$error='';
	 if (isset($_POST['upload'])) {
	 	
	 	$filename = $_FILES['img']['name'];
	 	$tmp_name = $_FILES['img']['tmp_name'];
	 	$ext = pathinfo($filename,PATHINFO_EXTENSION);
	 	$allowed  = array('jpg','jpeg','JPG','JPEG');
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
	 		
	 	
	 		$sql = "UPDATE login SET image = '$target' WHERE user_id = $_SESSION[id]";
	 		$result = mysqli_query($link,$sql);

	 		if (move_uploaded_file($tmp_name, $target) && $result) {
	 			
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



?>


<div class="container">
	<span class="update_msg w-25"></span>
	<div class=""><?php 
							if (isset($_SESSION['update_profile_msg'])) {
								
								echo $_SESSION['update_profile_msg'];
								
							}unset($_SESSION['update_profile_msg']);
				 ?></div>
	<div class="jumbotron alert-info">
		      	<div><?php echo $error; ?></div>
				<div class="mb-4"><?php echo $status; ?></div>
				
                  <div class="row">

                      <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4">
                          <img src="<?php echo $image; ?>" style="width: 70%;height: 300px" class="img-thumbnail rounded img-fluid">
                            <form method="post" enctype="multipart/form-data">
                           		<div class="form-group">
                           			<label class="text-center" style="font-size: 25px;margin-left: 120px;"><i class="fas fa-camera"></i>
							     	<input type="file" name="img" style="display: none;">
							     	</label>
                           		</div>
                           		<div class="form-group">
						    	 <button type="submit" class="btn btn-sm btn-success " name="upload" style="margin-left: 100px;margin-top: -20px;"><i class="fas fa-upload"></i>&nbsp;Upload</button>
						        </div>
						   </form>
                      </div>
                      <div class="col-md-8 col-xs-12 col-sm-6 col-lg-8"  id="user_info">
                          <div class="container mt-3" style="border-bottom:1px solid gray">
                            <h2><?php echo $name; ?></h2>
                          </div>
                            
                          <ul class="container details mt-4">
                            <li><p><i class="fas fa-mobile-alt"></i>&nbsp;&nbsp;<?php echo $mobile; ?></p></li>
                            <li><p><i class="far fa-user"></i>&nbsp;&nbsp;<?php echo $email; ?></p></li>
                            <li><p><i class="fas fa-map-marker-alt"></i>&nbsp;&nbsp;<?php echo $city; ?></p></li>
                         
                          </ul>
                          <button type="submit" class="btn btn-primary btn-sm" id="up_profile"><i class="fas fa-edit"></i>&nbsp;Edit Details</button>
                          
                      </div>

                      	<!--update info-->
                       <div class="col-md-8 col-xs-12 col-sm-6 col-lg-8 d-none" id="user_info_update" style="display: none;">
                          <div class="container mt-3">
                          	<form method="post">
                          		<div class="form-group">
                          			<label>Name</label>
                          			<input type="text" name="up_name" id="up_name" class="form-control w-50" value="<?php echo $name; ?>" >
                          		</div>
                          		<div class="form-group">
                          			<label>Mobile</label>
                          			<input type="text" name="up_mob" id="up_mob" class="form-control w-50" value="<?php echo $mobile; ?>">
                          			
                          		</div>
                          		<div class="form-group">
                          			<label>Enter City</label>
                          			<input type="text" name="up_city" id="up_city" class="form-control w-50" value="<?php  if(isset($city)){ echo $city; } ?>">
                          		</div>
                          		
                         
                          </div>
                            <hr>
                          
                          <button type="button" name="update_profile" class="btn btn-primary btn-sm" id="up_profile_done"><i class="fas fa-wrench"></i>&nbsp;Update Profile</button>
                          </form>
                      </div>
                  </div>

			
        
</div> 
<script type="text/javascript">
	$(document).ready(function(){

			$('#up_profile').click(function(){

					$('#user_info').removeClass('d-block');
					$('#user_info').addClass('d-none');
					$('#user_info_update').removeClass('d-none');
					$('#user_info_update').addClass('d-block').fadeIn('1000');
					
			});

			$('#up_profile_done').click(function(){

					var action='update_profile';
					var mobile = $('#up_mob').val();
					var city  = $('#up_city').val();
					var name = $('#up_name').val();

				$.ajax({

					url: 'update_profile_process.php',
					method: 'post',
					data: {action:action,mobile:mobile,city:city,name:name},
					dataType: 'text',
					success: function(data){

						if (data == 'true') {

							$('.update_msg').html('<div class="alert alert-danger">Mobile is already registered</div>').fadeIn();

						}else{

							window.location.href = window.location.href;
						}

							
					}


				});

			});	
			
	});
</script>
<?php  require_once 'footer.php';?>