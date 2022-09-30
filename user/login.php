<?php
 session_start();
  require_once 'header1.php';
  require_once '../config.php';
 
  if(isset($_SESSION['id'])){
    header('location: index.php')
;  }
$username =$password = "";
$username_err =$password_err = $error="";
 
  if (isset($_POST['submit'])) {
  	
  		if (empty($_POST['username'])) {
  			
  			$username_err ="please enter username";
  		}else
  		{
  			$username = mysqli_real_escape_string($link,$_POST['username']);
  		}

  		if (empty($_POST['password'])) {
  			
  			$password_err ="please enter password";
  		}else
  		{
  			$password = mysqli_real_escape_string($link,$_POST['password']);
  		}

  		if (empty($username_err) && empty($password_err)) {
  			
  			$sql = "SELECT * FROM login WHERE username = '$username'";

  			$result = mysqli_query($link,$sql);

  			if (mysqli_num_rows($result)>0) {
  				while ($row = mysqli_fetch_array($result)) {
  					if (password_verify($password,$row['password'] )) {
               
  						$_SESSION['loggedin'] = true;
  						$_SESSION['id'] = $row['user_id']; 
              $_SESSION['username'] = $row['username'];
              $_SESSION['name'] = $row['name']; 
  						header('location: index.php');
  					}else{
  						$error = "invalid username or password";
  					}
  				}
  			}else
  			{
  				$error = "invalid username or password";
  			}
  		}

  }
?>
   <div class="container">
        <div class="row">
          <div class="col-sm-4 col-lg-4 col-1">  </div>
          <div class="col-sm-4 col-10  p-3 shadow-lg">
            <span id="help"></span>
            <h4> Login Into Books Adda</h4>
            <br>
            <span class="text-danger"><?php  echo $error; ?></span>

            <form class=""  method="post">
              <div class="form-group">
                <i class="fa fa-envelope"></i><label for="">&nbsp;&nbsp;Email</label>
                <input type="text" name="username" id="email" value="" class="form-control rounded-0 bg-light" placeholder="Enter username">
                <span class="text-danger"><?php echo $username_err ?></span>
              </div>
              <div class="form-group">
                <i class="fa fa-key"></i><label for="">&nbsp;&nbsp;Password</label>
                <input type="password" name="password" id="password" value=""  class="form-control rounded-0 bg-light"  placeholder="Enter password" >
                <span class="text-danger"><?php echo $password_err ?></span>
              </div>
              
           
              <div class="form-group">
              <input type="submit" id="submit" name="submit"  class="btn btn-success" style="width:100%" value="Login">
              </div>
            </form>
            <a href="email_for_res_pass.php"><span class="text-danger float-left"><u>Forget Password</u></span></a>
            <a href="../admin/login.php"><span class="text-danger float-right"><u>Login As Admin</u></span></a>
           </div>
          <div class="col-sm-4 col-1">  </div>

        </div>
      </div>

<?php include_once 'footer1.php'?>
