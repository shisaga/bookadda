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
      $_SESSION['otp_session_pass'] = "otp_pass_verify";
      header("Location: res_pass_page.php");
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

      });
    </script>
    </body>
    </html>