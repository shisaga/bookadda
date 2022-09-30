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
        <?php
          foreach ($em as $key) {
            ?>

            
              <?php
            echo '<div class="col-sm-4 items" style="font-size: 20px;">
            <img src="'.$key['item_image'].'" height="250" width="80%">
            <h3>'.$key['item_name'].'</h3>
            </div>';
          }
            ?></div><?php

        ?>

    </div> <!-- end of gallery div -->

     <!-- ============================================================== -->
    <!-- start of about us div -->
    <div class="container mt-5" id="about">
      <br><br><br><br><br>
        <h1 id="about-head">About Us</h1>
        <h3>Food&food is a team of more than 30 members and counting. We love to deliver delicious foods to our customers so that they can enjoy our delicious foods with their loved ones. We have provied various flavour of foods to our customer so that they can choose their favorite one. We have designed our website with love and in such a way so that customers can order foods within just few clicks.</h3>

        <p><h3>We are working here so that we can provide hasslefree experience to our customers.We are committed to deliver food at given time span. We would love to tell you that we love our customers and we are working our best to provide best offers to them. </h3></p><br>

       


    </div> <!-- end of about div -->
    <!-- ======================================================== -->

    <!-- start of restaurants div -->
    <div class="container mt-5" id="restaurants">
      <br><br><br><br><br>
      <h3>Best Sellers</h3>
      <div class="row">
        <?php
        $conn = mysqli_connect("localhost","root","","book_store");
        $sql = "SELECT * FROM books WHERE category='bs'";
        $res = mysqli_query($conn,$sql);
       
          while ($row = mysqli_fetch_array($res)) {
            ?>

            
              <?php
            echo '<div class="col-sm-4 items">
            <img src="'.$row['img'].'" height="250" width="80%">
            <h4>'.$row['book_name'].'</h4>
            </div>';
          }
            ?></div><?php

        ?>
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

 


   

<script type="text/javascript">
  $(function () {
  $(document).scroll(function () {
    var $nav = $(".sticky-top");
    $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
  });



			  
});//end of documnet





  



  



</script>
<?php
include_once 'footer.php';
?>