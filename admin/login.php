<?php
require_once '../config.php';
require_once 'header.php';

if(isset($_SESSION['aloggedin'])){

  echo "<script>  window.location.href = 'profile.php'; </script>";
}

$username = $password = "";
$username_err=$password_err = $error = "";

if (isset($_POST['submit'])) {

if (empty($_POST['username'])) {
  $username_err = "please enter username";
}else {

$username = test_input($_POST['username']);
}

if (empty($_POST['password'])) {
  $password_err = "please enter password";
}else {

$password = test_input($_POST['password']);
}

if(empty($username_err) && empty($password_err))
{
  $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";

  $result = mysqli_query($link,$sql);

  if (mysqli_num_rows($result)>0) {
      session_start();
     $_SESSION['aloggedin'] = true;
     header('location: profile.php');
  }else {
    $error = "invalid login credentials";
  }
}
}
function test_input($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

 ?>
<div class="container">
<div class="row">
  <div class="col-sm-4"></div>
  <div class="col-sm-4">
      <h3>Admin Login Panel</h2>
        <span class="text-danger"> <?php echo $error; ?></span>
        <form  method="post">
          <div class="form-group">
            <label for="">Username</label>
            <input type="text" name="username" value="" class="form-control">
            <span class="text-danger"><?php echo $username_err; ?> </span>
          </div>
          <div class="form-group">
            <label for="">Password</label>
            <input type="password" name="password" value="" class="form-control">
            <span class="text-danger"> <?php echo $password_err; ?></span>
          </div>
          <div class="form-group">
          <input type="submit" name="submit" value="Login" class="btn btn-success" style="width:100%">
          </div>
          <a href="../user/login.php"><span class="text-danger float-right"><u>Login As User</u></span></a>
        </form>
        
  </div>
  <div class="col-sm-4"></div>
</div>
</div>

<?php require_once 'footer.php'; ?>
