<?php

  $('#load_more').click(function(){

                   var total_orders = $('#total_orders').val();
                    

                  
                    
                    //alert(last_id);
                    $.ajax({

                        url: "getdata.php",
                        method: "post",
                        data: {last_id:last_id},
                        dataType: "text",
                        success: function(data){
                            $('#load_more').hide();
                             $('#show_more').html("Loading..<img src='images/tenor.gif' height='30' width='30'>");
                            window.setTimeout(function(){
                                  $(data).appendTo('#data').hide().fadeIn(500);
                                   $('#show_more').html('');
                                   $('#load_more').show();
                            },500);

                           
                             last_id = last_id+5;

                              
                                if(last_id > total_orders ){

                                    $('#load_more').css("visibility","hidden");
                                    $('#order_info').css("display","block");
                                    window.setTimeout(function(){
                                         $('#order_info').html("That's all of your orders.");
                                    },1200);
                                   

                                }

                            
                           

                            

                            //alert(last_id);

                        }
                    
                    });

                });


?>



<!DOCTYPE html>
<html>
<head>
	<title>Profile pic upload</title>
	 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css">

<style type="text/css">
	#icon{
		position: absolute;
		top:250px;
		left: 170px;
		border: 1px solid crimson;
		border-radius: 50%;
		padding: 3px;
	}
</style>
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<br><br><br><br>
				<div class="rounded-circle border border-danger" style="height: 200px;width: 200px;" id="img">
					
				</div>
				<br>
				<form name="files"  method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>
						<i class="fas fa-camera" style="font-size: 30px;" id="icon">
							<input type="file" name="pic" class="form-control" id="pic" style="display: none;" >
						</i>
						</label>
						
						
						<br><br><br>
						<button type="button" name="upload" class="btn btn-success mt-5" id="upload" >upload</button>
					</div>
				</form>
			</div>
			<div class="col-sm-4"></div>
		</div>
	</div>

	<script type="text/javascript">

		$(document).ready(function(){

			$(document).on('click',function(){

			
				var fd = new FormData(files);
       				 

     
				$.ajax({

					url: "pichandler.php",
					method: "post",
					data: fd,
					dataType: "text",
					contentType: false,
					cache: false,
					processData: false,
					success:function(data){

						$('#img').html(data);
					}
				});
			});

	

		});
	</script>
</body>
</html>