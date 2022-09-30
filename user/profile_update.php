<?php  require_once 'header2.php';
        require_once '../config.php';

$sql = "SELECT * FROM login WHERE  user_id = $_SESSION[id]";
$res = mysqli_query($link,$sql);

while ($row = mysqli_fetch_array($res)) {
    
    $name = $row['name'];
    $mobile = $row['mobile'];
    $username = $row['username'];

}
 $error = "";
 $error1 = "hello";

?>
      <div class="container">
        <div class="row">
          <div class="col-sm-4">  </div>
          <div class="col-sm-4 shadow-lg py-2">
            <span id="help"></span>
            <h4>Update Details</h4>
            <br>


            <form class="" action="profile_update.php"  method="post" >
              <div class="form-group">
                <i class="fa fa-user"></i><label for="">&nbsp;&nbsp;Name</label>
                <input id="name" type="text" name="text1" class="form-control" placeholder="Enter Name" >
                <span id="name-help" style="color:red"></span>
              </div>
              
             
             
              
              <div class="form-group">
              <i class="fas fa-mobile-alt"></i>  <label for="">&nbsp;&nbsp;Mobile</label>
                <input id="mobile" type="number" name="number1" class="form-control"  placeholder="Enter Mobile Number" >
                <span id="mob-help" style="color:red"><?php if(isset($_POST['submit']))
                {
                    $mob = $_POST['number1'];
                    if ( !preg_match ("/^[6-9][0-9]{9}$/",$mob)) {
                      $error1 = "Only 10 Digits Mobile Numbers are Allowed!";
                      echo $error1;
                   }
                   else {
                     $error1 = "";
                   }
                }?></span>
              </div>
              <div class="form-group">
              <button type="button" id="submit" name="submit"  class="btn btn-success" style="width:100%">Update</button>
                  
              
              </div>
            </form>
           </div>
          <div class="col-sm-4">  </div>

        </div>
      </div>
      <?php 
                  if($error == "Name must only contain letters!" || $error1 == "Only 10 Digits Mobile Numbers are Allowed!")
                  {
                    echo '<input type="text" class="label label-success" placeholder="Profile Not Updated!" style="width:100% ; text-align:center;" disabled>';
                    /*if(!empty($_POST['number1']) && !empty($_POST['text1']))
                            		{
                            				$mob = $_POST['number1'];
                            				$name_user = $_POST['text1'];
                            				$sql = "Update login set mobile='$mob' Where mobile='$mobile'";
                            				$sql1 = "Update login set name='$name_user' Where name='$name'";
                            				//echo '<script type="text/JavaScript">  location.reload(); </script>';
                            				mysqli_query($link,$sql);
                            				mysqli_query($link,$sql1);
                                            echo '<input type="text" class="label label-success" placeholder="Profile Updated" style="width:100% ; text-align:center;" disabled>';
                            		}
                            	//	else if(!empty($_POST['text1']))
                            	//	{
                            	//		$name_user = $_POST['text1'];
                            	//		$sql1 = "Update login set name='$name_user' Where name='$name'";
                            	//		mysqli_query($link,$sql1);
                            	//	}
                            	//	else if(!empty($_POST['number1']))
                            	//	{
                            	//		$mob = $_POST['number1'];
                            	//		$sql = "Update login set mobile='$mob' Where mobile='$mobile'";
                            	//		mysqli_query($link,$sql);
                            	//	}
                            		else
                            		{
                            		}*/
                    }
                    else{
                      if(!empty($_POST['number1']) && !empty($_POST['text1']))
                      {
                          $mob = $_POST['number1'];
                          $name_user = $_POST['text1'];
                          
                          $sql1 = "Update login set name='$name_user' Where name='$name'";
                          $sql = "Update login set mobile=$mob Where mobile=$mobile";
                          mysqli_query($link,$sql);
                          mysqli_query($link,$sql1);
                          
                          echo '<input type="text" class="label label-success" placeholder="Profile Updated!" style="width:100% ; text-align:center;" disabled>';
                          echo "<script> window.location.href = 'profile.php'; </script>";
                      }
                    //	else if(!empty($_POST['text1']))
                    //	{
                    //		$name_user = $_POST['text1'];
                    //		$sql1 = "Update login set name='$name_user' Where name='$name'";
                    //		mysqli_query($link,$sql1);
                    //	}
                    //	else if(!empty($_POST['number1']))
                    //	{
                    //		$mob = $_POST['number1'];
                    //		$sql = "Update login set mobile='$mob' Where mobile='$mobile'";
                    //		mysqli_query($link,$sql);
                    //	}
                      else
                      {

                        
                      }

                    }
                  ?>
    <script type="text/javascript">
      $(document).ready(function(){
          //$('#help').hide();
          var validname = false;
          var validmob = false;
        


        

       $('#name').blur(function(){

           name = $(this).val();
          var regex = /^[a-zA-Z ]+$/;

          if(name=="" || name==null)
          {
            $('#name-help').html('<img src="images/check.gif" height="50" width="50">');
            window.setTimeout(function(){
              $('#name-help').css("color","red");
              $('#name-help').html('&#10005; Please Enter Name');
            },500);
            validname = false;
          }else if (!regex.test(name)) {
            $('#name-help').html('<img src="images/check.gif" height="50" width="50">');
            window.setTimeout(function(){
              $('#name-help').css("color","red");
              $('#name-help').html('&#10005; Only Characters and Spaces allowed');
            },500);
            validname = false;
          }else {
            $('#name-help').html('<img src="images/check.gif" height="50" width="50">');
            window.setTimeout(function(){
              $('#name-help').css("color","green");
              $('#name-help').html('&#10003; Valid Name');
            },500);
            validname = true;
          }
    });

    $('#mobile').blur(function(){

        mobile = $(this).val();
       var regex = /^[0-9]\d{9}$/;

       if(mobile=="" || mobile==null)
       {
         $('#mob-help').html('<img src="images/check.gif" height="50" width="50">');
         window.setTimeout(function(){
           $('#mob-help').css("color","red");
           $('#mob-help').html('&#10005; Please Enter Mobile Number');
         },500);
         validmob = false;
       }else if (!regex.test(mobile)) {
         $('#mob-help').html('<img src="images/check.gif" height="50" width="50">');
         window.setTimeout(function(){
           $('#mob-help').css("color","red");
           $('#mob-help').html('&#10005; Invalid Mobile Number');
         },500);
         validmob = false;
       }else {

                           $.ajax({

                               url: 'mobile_check.php',
                               method: 'post',
                               data:{mobile:mobile},
                               dataType: "text",
                               success:function(data){

                                 if(data == 1){
                                   $('#mob-help').html('<img src="images/check.gif" height="50" width="50">');
                                   window.setTimeout(function(){
                                     $('#mob-help').css("color","red");
                                     $('#mob-help').html('&#10005; Mobile already registered');
                                   },500);
                                     validmob = false;

                                 }else {
                                   $('#mob-help').html('<img src="images/check.gif" height="50" width="50">');
                                   window.setTimeout(function(){
                                     $('#mob-help').css("color","green");
                                     $('#mob-help').html('&#10003; Valid Mobile Number');
                                   },500);
                                     validmob = true;
                                 }

                               }
                           });
       }
    });

      $('#submit').click(function(){

        if(validmob==false || validname==false)
        {
          $('#help').html('<div class="alert alert-danger">Fill All Fields Correctly</div>');

            window.setTimeout(function(){
              $('.alert').fadeTo(500,0).slideUp(500,function(){
                $(this).remove();
              });
            },1000);

        }else {

          $.ajax({

              url: 'profile_handler.php',
              method: 'post',
              data:{name:name,mobile:mobile},
              dataType: "text",
              success:function(data){
                $('#help').html(data);
                window.setTimeout(function(){
                  window.location.href = "profile.php";
                },2000);
              }
          });
        }

     });

       


      });
    </script>
    </body>
    </html>
