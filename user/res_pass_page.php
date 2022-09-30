<?php  require_once 'header1.php';

session_start();

include_once '../config.php';

if($_SESSION['otp_session_pass'] != "otp_pass_verify")
{
  header("Location: email_for_res_pass.php");
}



?>
      <div class="container">
        <div class="row">
          <div class="col-sm-4">  </div>
          <div class="col-sm-4 shadow-lg py-2">
            <span id="help"></span>
            <h4>Reset Your Password</h4>
            <br>


            <form class=""  method="post">
              
              <div class="form-group">
                <i class="fa fa-key"></i><label for="">&nbsp;&nbsp;Password</label>
                <div class="input-group">
                
                <input type="password" name="password" id="password" value=""  class="form-control"  placeholder="Enter password" >
                <div class="input-group-append">  <button type="button" class="btn btn-sm btn-default input-group-text " id="view_password" style="outline:none;box-shadow:none;"><i class="fas fa-eye" ></i></button> </div>
                
              </div>
              <span id="pass-help"></span>
              </div>
              
              
              
              <div class="form-group">
                <i class="fa fa-key"></i><label for="">&nbsp;&nbsp;Confirm Password</label>
                <input type="password" name="cpassword" id="cpassword" value=""  class="form-control"  placeholder="Confirm password" >
                <span id="cpass-help"></span>
              </div>
              <div class="form-group">
              <button type="button" id="submit" name="submit"  class="btn btn-success" style="width:100%">Change Password</button>
              </div>
            </form>
           </div>
          <div class="col-sm-4">  </div>

        </div>
      </div>
    <script type="text/javascript">
      $(document).ready(function(){
          //$('#help').hide();
          var validname = false;
          var validpass = false;
          var validcnfpass = false;
          var validemail = false;
          var validmob = false;
          var email ="";
          var password="";
          var cpassword="";
          var name = "";
          var mobile="";



             $('#password').blur(function(){

                 password = $(this).val();

                if(password=="" || password==null)
                {
                  $('#pass-help').html('<img src="images/check.gif" height="50" width="50">');
                  window.setTimeout(function(){
                    $('#pass-help').css("color","red");
                    $('#pass-help').html('&#10005; please enter password');
                  },500);
                  match_password();
                  validpass = false;

                }else if (password.length<5) {
                  $('#pass-help').html('<img src="images/check.gif" height="50" width="50">');
                  window.setTimeout(function(){
                    $('#pass-help').css("color","red");
                    $('#pass-help').html('&#10005; password must be of 5 characters');
                  },500);
                  match_password();
                  validpass = false;
                }else {
                  $('#pass-help').html('<img src="images/check.gif" height="50" width="50">');
                  window.setTimeout(function(){
                    $('#pass-help').css("color","green");
                    $('#pass-help').html('&#10003; valid password');
                  },500);
                   match_password();
                  validpass = true;
                }

          });

             function match_password(){

             var pass =  $('#password').val();
             var cnfpass = $('#cpassword').val();

             if(pass !== cnfpass)
             {
                window.setTimeout(function(){
                 $('#cpass-help').css("color","red");
                 $('#cpass-help').html('&#10005; confirm password did not match');
               },500);
                validpass = false;
               validcnfpass = false; 
             }else{
                window.setTimeout(function(){
                 $('#cpass-help').css("color","green");
                 $('#cpass-help').html('&#10003; password matched');
               },500);
                validpass = true;
                validcnfpass = true;
             }
             }

          $('#cpassword').blur(function(){

              cpassword = $(this).val();


             if(cpassword=="" || cpassword==null)
             {
               $('#cpass-help').html('<img src="images/check.gif" height="50" width="50">');
               window.setTimeout(function(){
                 $('#cpass-help').css("color","red");
                 $('#cpass-help').html('&#10005; Please Enter Confirm Password');
               },500);
               validcnfpass = false;
             }else if ((password != cpassword) || (cpassword.length<5)) {
               $('#cpass-help').html('<img src="images/check.gif" height="50" width="50">');
               window.setTimeout(function(){
                 $('#cpass-help').css("color","red");
                 $('#cpass-help').html('&#10005; confirm password did not match');
               },500);
               validcnfpass = false;
             }else {
               $('#cpass-help').html('<img src="images/check.gif" height="50" width="50">');
               window.setTimeout(function(){
                 $('#cpass-help').css("color","green");
                 $('#cpass-help').html('&#10003; password matched');
               },500);
               validcnfpass = true;
             }
       });

       $('#submit').click(function(){

        if(validpass==false || validcnfpass == false)
        {
          $('#help').html('<div class="alert alert-danger">Fill All Fields Correctly</div>');

            window.setTimeout(function(){
              $('.alert').fadeTo(500,0).slideUp(500,function(){
                $(this).remove();
              });
            },1000);

        }else {

          $.ajax({

              url: 'res_pass_handler.php',
              method: 'post',
              data:{password:password},
              dataType: "text",
              success:function(data){
                $('#help').html(data);
                window.setTimeout(function(){
                  window.location.href = "login.php";
                },2000);
              }
          });
        }

        });


        $('#view_password').click(function(){

            var type = $('#password').attr('type');

            if (type == 'password') {
              $('#password').attr('type','text');
              $('#view_password').html('<i class="fas fa-eye-slash"></i>');
            }else{
               $('#password').attr('type','password'); 
               $('#view_password').html('<i class="fas fa-eye"></i>');
            }
        });



      });
    </script>
    </body>
    </html>
