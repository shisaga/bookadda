<?php
 session_start();
  require_once 'header1.php';
  require_once '../config.php';
 
  $error="";
  $otp=$new_otp=$email_given="";








 
  if (isset($_POST['submit'])) {
  	$new_otp = $_POST['otp'];
    $email_given = $_SESSION['email'];
    $sql = "SELECT otp FROM login WHERE username='$email_given'";
    $result = mysqli_query($link,$sql);
    while($row = mysqli_fetch_array($result)) {
      $otp = $row['otp'];
    }
    if($new_otp == $otp) {
      $_SESSION['otp_session'] = "set";
      header("Location: signup.php");
    }
    else {
    $error = "Enter Correct OTP";
  }
}
?>
   <div class="container">
        <div class="row">
          <div class="col-sm-4 col-lg-4 col-1">  </div>
          <div class="col-sm-4 col-10  p-3 shadow-lg">
            <span id="help"></span>
            <h4>Verify Your Otp</h4>
            <br>

            <form action="" class=""  method="post">
              <div class="form-group">
                <i class="fa fa-key"></i><label for="">&nbsp;&nbsp;OTP</label>
                <input type="password" name="otp" id="password" value=""  class="form-control rounded-0 bg-light"  placeholder="Enter Your OTP" >
                <span class="text-danger"><?php echo $error ?></span>
              </div>
              
           
              <div class="form-group">
              <input type="submit" id="submit" name="submit"  class="btn btn-success" style="width:100%" value="Verify OTP">
              </div>
            </form>
            
           </div>
          <div class="col-sm-4 col-1">  </div>

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
                            $('#email-help').css("color","red");
                            $('#email-help').html('&#10005; Email Already Registered');
                          },500);
                            validemail = false;

                        }else {
                          
                          window.setTimeout(function(){
                            $('#email-help').css("color","green");
                            $('#email-help').html('&#10003; Valid Email');
                          },500);
                            validemail = true;
                        }

                      }
                  });



                }
             }
           });

             

      



      });
    </script>
    </body>
    </html>