<?php

?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="custom_style.css">

   <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> 
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css">
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>

<style type="text/css">
  body{
    
    background-image: url('images/6.jpg'),  url('images/1.jpg');
    height: 100%;
     background-position: top;
  background-repeat: no-repeat,repeat;
  background-size:contain;
    
     
  }
</style>
</head>
<body>

  <div class="container-fluid" style="height: 100%" >
    <div id="info" class=" alert alert-danger"><b>24/7 Support *** Call or Whatsapp us to order:&nbsp;<i class="fab fa-whatsapp"></i> <strong>8863939456</strong> ***  Free Home delivery on all orders above &#x20B9; 200</b></div>

    
       <!-- start of navigation bar -->
       <nav class="navbar navbar-expand-sm  navbar-dark sticky-top ">
  <!-- Brand -->
  <div class="container"> <!-- start of navrbar div -->
  <a class="navbar-brand" href=""><h3 style="color: white;font-family: futura;font-weight: bolder;border:1px solid white;padding: 10px;">food&food</h3> </a>

  <!-- Links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link" href="user_controller/menu" style="color: white;font-size: 18px;">Menu </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#about" style="color: white;font-size: 18px;">About</a>
    </li>
     <li class="nav-item">
      <a class="nav-link" href="#restaurants" style="color: white;font-size: 18px;">Restaurants</a>
    </li>
     <li class="nav-item">
      <a class="nav-link" href="#contact" style="color: white;font-size: 18px;">Contact</a>
    </li>
    <?php if(isset($_SESSION['id'])){  ?>
    <!-- Dropdown -->
    <li class="nav-item dropdown rounded-0">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown" style="color: white;">
       My Account
      </a>
      <div class="dropdown-menu rounded-0">
       <a class="dropdown-item" href="user_controller/orders_history">Orders</a>
        <a class="dropdown-item" href="#">Link 2</a>
        <a class="dropdown-item" href="user_controller/logout"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>
      </div>
    </li> <?php  } ?>
  </ul>
  </div> <!-- end of navrbar div -->
</nav> <!-- end of navbar -->
    
     <br>
     
    <div class="container" id="content"> <!-- start of content div -->
        
        <?php 
        //displaying error message if user is not logged in
         if(isset($_SESSION['msg']))
         {
          echo '<div class="alert alert-primary w-25 mx-auto msg" style="font-size:20px;position:fixed;left:600px;background-color:gray;color:white">'.$_SESSION['msg'].'</div>';
         }
        ?>
        <br>
        Get your food delivered at home, You are one step away from your delicious food<br>
        <form>
          <?php  if(!isset($_SESSION['id'])){   ?>
          <button type="button" class="btn btn-outline-success" style="height: 50px; width: 150px; font-size: 20px;color: white;font-weight: bolder;" id="login" onclick="$('#loginModal').modal();">Login</button>
          <button type="button" id="signup" class="btn btn-outline-danger" style="height: 50px; width: 180px; font-size: 20px;color: white;font-weight: bolder;">Create Account</button>
        </form><?php  }?>

    </div><!-- end of content div --><br>
  
<!-- start of gallery div -->
    <div class="container" id="gallery">
      
    
        <div style="color:white;"><i>Food Gallery</i></div>
        
        <div class="row">
        </div>

       

    </div> <!-- end of gallery div -->

     <!-- ============================================================== -->
    <!-- start of about us div -->
    <div class="container mt-5" id="about">
      <br><br><br><br><br>
        <h1 id="about-head">About Us</h1>
        <h3>Food&food is a team of more than 30 members and counting. We love to deliver delicious foods to our customers so that they can enjoy our delicious foods with their loved ones. We have provied various flavour of foods to our customer so that they can choose their favorite one. We have designed our website with love and in such a way so that customers can order foods within just few clicks.</h3>

        <p><h3>We are working here so that we can provide hasslefree experience to our customers.We are committed to deliver food at given time span. We would love to tell you that we love our customers and we are working our best to provide best offers to them. </h3></p><br>

        <p><h1 style="display: inline-table;width: 100%;text-align: center;font-size: 30px">Meet Our Awesome Team Members</h1></p>

         <div id="demo" class="carousel slide" data-ride="carousel">
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  <div class="carousel-inner">
   <div class="carousel-item active mb-5">
     <center> <img src="" class="rounded-circle" width="150" height="150">
       <h5>Lalit Rana, CEO & Lead developer</h5> 
     </center>
       
    </div>
    <div class="carousel-item mb-5">
     <center> <img src="" class="rounded-circle" width="150" height="150">
       <h5>Lalit Rana, CEO & Lead developer</h5> 
     </center>
       
    </div>
    <div class="carousel-item mb-5">
     <center> <img src="" class="rounded-circle" width="150" height="150">
       <h5>Lalit Rana, CEO & Lead developer</h5> 
     </center>
       
    </div>
  </div>
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
        

    </div> <!-- end of about div -->
    <!-- ======================================================== -->

    <!-- start of restaurants div -->
    <div class="container mt-5" id="restaurants">
      <br><br><br><br><br>
      <h3>Our Restaurants</h3>
      <div class="row">
      </div>
    </div> <!-- end of restaurants div -->

    <!-- start of contact div -->
    <div class="container mt-5" id="contact">
      <br><br>
      <h3>Contact Us</h3><br>
      <div class="row">
        <div class="col-sm-4">
          <h5><i class="fas fa-map-marker-alt"></i>&nbsp;&nbsp;&nbsp;Address</h5>
           <p>New Nagar Bandh Gari Dipatoli Ranchi,<br> Near Shiv Mandir, 834009, Jharkhand</p><br>
        </div>
      
         <div class="col-sm-4" >
           

           <p><h5><i class="fas fa-phone"></i>&nbsp;&nbsp;&nbsp;Let's talk</h5></p>
           <p class="text-success"> 8863939456</p><br>

      
         </div>
         <div class="col-sm-4" style="">
                <p><h5><i class="fas fa-envelope"></i>&nbsp;&nbsp;&nbsp;Email us</h5></p>
           <p class="text-success"> foodandfood@gmail.com</p>
         </div>
        </div>
    </div> <!-- end of contact div -->
      <br><br><br><br><br><br>
  </div> <!-- end of container fluid -->

  <!-- login modal start -->
  <div id="loginModal" class="modal fade rounded-0" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog rounded-0">
        <div class="modal-content rounded-0">
            <div class="modal-header text-center rounded-0 bg-primary">
                <h3 style="display: inline-table;width: 100%;color: white;">Sign in</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
           
            <div class="modal-body">
                <form class="loginform" role="form" autocomplete="off" id="formLogin" novalidate="" method="POST" >
                    <div class="input-group">
                       
                        <input type="email" class="form-control form-control" name="uname" id="uname" required="" placeholder="Username">
                        <i class="fas fa-envelope"></i>
                          <span id="error"></span>
                    </div>
                
                    <div class="input-group mt-4">
                       <!--  <label>Password</label> --> 
                        <input type="password" class="form-control form-control " id="pwd" name="pwd" required="" autocomplete="new-password" placeholder="Password">
                        <i class="fas fa-key"></i><br>
                    </div>
                      
                    <div class="form-group py-4 mt-2">
                        <button type="submit" class="btn btn-primary w-100 rounded-0" id="btnLogin">Login</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div><!--  login modal ends -->

<!-- signup modal start -->
  <div id="signupModal" class="modal fade rounded-0 w-25" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog rounded-0">
        <div class="modal-content rounded-0" id="modcon">
            <div class="modal-header text-center bg-danger rounded-0">
                <h3 style="display: inline-table;width: 100%;color: white;">Create Account</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="signupform" role="form" autocomplete="off" id="formSignup" novalidate="" method="POST">
                    <div class="input-group mb-4">
                        <input type="email" class="form-control" name="email" id="email" required="" placeholder="Email" >
                        <i class="fas fa-envelope"></i>
                    </div>

                    <div class="input-group mb-4">
      
                        <input type="text" class="form-control" name="mobile" id="mobile" required="" placeholder="Mobile" minlength="10" maxlength="10" autocomplete="off">
                        <i class="fas fa-mobile"></i>
                
                    </div>
                    <div class="input-group mb-4">
                        <input type="text" class="form-control" name="name" id="name" required="" placeholder="Name" >
                         <i class="fas fa-user-tie"></i>
                        
                    </div>
                    <div class="input-group mb-4">
                      
                        <input type="password" name="password" class="form-control form-control " id="pwd1" required="" autocomplete="new-password" placeholder="Password">
                      <i class="fas fa-key"></i>
                    </div>
                    <div class="form-group py-4">
                        <button type="submit" class="btn btn-danger w-100 rounded-0" id="btnSignup">Signup</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div><!--  signup modal ends -->
   

<script type="text/javascript">
  $(function () {
  $(document).scroll(function () {
    var $nav = $(".sticky-top");
    $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
  });


    $("#signup").on('click', function(event){
                event.stopPropagation();
                event.stopImmediatePropagation();
                $('#signupModal').modal('show');
                return false;
            });




        
});//end of documnet


</script>
</body>
</html>