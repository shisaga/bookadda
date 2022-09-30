<?php  require_once 'header1.php';


?>

      <div class="container">
        <div class="row">
          <div class="col-sm-4">  </div>
          <div class="col-sm-4 shadow-lg py-2">
            <span id="help"></span>
            <h4>Enter Your Email To Reset Your Password</h4>
            <br>


            <form class=""  method="post">
              <div class="form-group">
                <i class="fa fa-envelope"></i><label for="">&nbsp;&nbsp;Email</label>
                <input type="email" name="email" id="email"  value="" class="form-control" placeholder="Enter Email">
                <span id="email-help"></span>
              </div>

              <div class="form-group">
              <button type="button" id="submit" name="submit"  class="btn btn-success" style="width:100%">Send OTP</button>
              </div>
            </form>
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


          $('#email').blur(function(){

              email = $(this).val();
             var regex = /^\w+[\w\.]*\@\w+((-\w+)|(\w*))\.[a-z]{2,3}$/;

             if (email == "" || email == null) {
                  
                   window.setTimeout(function(){
                     $('#email-help').css("color","red");
                     $('#email-help').html('&#10005; Please Enter Email');
                   },500);
                   validemail = false;

             }else {

                if(!regex.test(email))
                {
                  
                  window.setTimeout(function(){
                    $('#email-help').css("color","red");
                    $('#email-help').html('&#10005; Please Enter Valid Email');
                  },500);
                    validemail = false;
                }else {

                  $.ajax({

                      url: 'email_check.php',
                      method: 'post',
                      data:{email:email},
                      dataType: "text",
                      success:function(data){

                        if(data == 1){
                          
                          window.setTimeout(function(){
                            $('#email-help').css("color","green");
                            $('#email-help').html('&#10003; Valid Registered Email');
                          },500);
                            validemail = true;

                        }
                        else {
                          
                          window.setTimeout(function(){
                            $('#email-help').css("color","red");
                            $('#email-help').html('&#10005; Email Not Registered');
                          },500);
                            validemail = false;
                        }
                      }
                  });



                }
             }
           });

             

      $('#submit').click(function(){

        if(validemail==false)
        {
          $('#help').html('<div class="alert alert-danger">Fill All Fields Correctly</div>');

            window.setTimeout(function(){
              $('.alert').fadeTo(500,0).slideUp(500,function(){
                $(this).remove();
              });
            },1000);

        }else {

          $.ajax({

              url: 'signuphandler_for_pass.php',
              method: 'post',
              data:{email:email},
              dataType: "text",
              success:function(data){
                $('#help').html(data);
                window.setTimeout(function(){
                  window.location.href = "otp_verify_pass.php";
                },2000);
              }
          });
        }

     });



      });
    </script>
    </body>
    </html>
