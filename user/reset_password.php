<?php

 include_once 'header.php';
 include_once '../config.php';


    if(isset($_POST["send"]))      
    {
    	if (empty($_POST['email'])) {

    		$status = "<span class='alert alert-danger'>Please Enter Email</span>";
    	}else{


    	 $mailto = trim($_POST['email']);
    	
    	$sql = "SELECT * FROM login WHERE username = '$mailto'";

    	$res = mysqli_query($link,$sql);

    	if (mysqli_num_rows($res) == 0) {
    		
    		$status = "<span class='alert alert-danger'>Email is not registered with us</span>";
    	}else{


    			 require 'PHPMailerAutoload.php';



        $mailto = trim($_POST['email']);
        $_SESSION['user'] = $mailto;
        $otp = rand(10000,999999);
        $_SESSION['otp'] = $otp;
       
        $mail = new PHPMailer;

                    //$mail->SMTPDebug = 3;                               // Enable verbose debug output

                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host ='smtp.gmail.com';                 // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = '';                // SMTP username
                    $mail->Password = '';                          // SMTP password
                    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 587;                                    // TCP port to connect to

                    $mail->setFrom('booksadda12@gmail.com', 'noreply@nomadic.com');
                    $mail->addAddress($mailto);     // Add a recipient
                    //$mail->addAddress('ellen@example.com');               // Name is optional
                    //$mail->addReplyTo('info@example.com', 'Information');
                    //$mail->addCC('cc@example.com');
                    //$mail->addBCC('bcc@example.com');

                   // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                    $mail->isHTML(true);                                  // Set email format to HTML

                    $mail->Subject = "password reset";
                    $mail->Body    = "your OTP to reset password is: ".$otp;
                    $mail->AltBody ="your OTP to reset password is: ".$otp;

                    if(!$mail->send()) {
                        $status = 'Message could not be sent.';
                        $status.= 'Mailer Error: ' . $mail->ErrorInfo;
                    } else {
                        $status= '<span class="alert alert-success ">OTP sent to your email</span><br><br>';

                        ?>

                        <script type="text/javascript">
                        	$(document).ready(function(){

                        			//$("#reset_pas_div").remove();
                        			$('#email_div').hide();
                        			$('#sendotp').hide();
                        			$('#otp_div').hide().fadeIn(500);
                        			$('#confirm_otp').hide().fadeIn(500);
                        	});
                        </script>

                        <?php
                    }

    	}
    }
       
    }



 ?>

<div class="container">
	<div class="row">
		<div class="col-4"></div>
		<div class="col-4" >
			<div id="otpstatus" style="position: absolute;"><?php if (isset($status)) {
				
				echo $status;
			} ?></div>
			<h5 class="text-success">Reset Password</h5>
			<br>
			<div class="shadow-lg p-3" id="reset_pas_div">
					<span id="status"></span>
			<form method="post">
				<div class="form-group" id="email_div">
					<label>Enter Your Email</label>
					<input type="text" name="email" class="form-control">
				</div>
				<div class="form-group">
					<input type="submit" name="send" id="sendotp" class="btn btn-success" value="Send OTP">
				</div>
				<div class="form-group" id="otp_div">
					<label>Enter OTP sent to your email</label>
					<input type="text" name="otp" class="form-control" id="otp_val">
				</div>
				<div class="form-group">
					<button type="button" name="confirm_otp" id="confirm_otp" class="btn btn-success" >Confirm OTP</button>
				</div>
			</form>
			</div>
			<div id="confirm_div" class="w-100">
				<span id="reset_pass_msg"></span>
				<form method="post">
				<div class="form-group">
					<label>Enter new Password</label>
					<input type="password" name="new_password" id="new_password" class="form-control">
				</div>
				<div class="form-group">
					<button type="button" name="reset_pass" class="btn btn-success">Reset Password</button>
			</form>
			</div>
		
		</div>
		<div class="col-4"></div>
	</div>
</div>
  <?php  include_once 'footer.php'; ?>