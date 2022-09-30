<?php




?>

<!DOCTYPE html>
<html>
<head>
	<title>landing page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/css/mdb.min.css" rel="stylesheet">

<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/js/mdb.min.js"></script>
<style type="text/css">
		body{
		 background-color: #CC0000;
   
		}
    .text-p
    {
      font-size: 32px;
      font-weight: bolder;
      color: white;
      font-family: cursive;

    }

    .navbar{
      border:none;
      box-shadow: none;
    }
    .s-n-link{

      display: table;
      width: 100%;
      height: 20px;
      color: white;
      padding:10px 5px 2px 5px;
      margin-top: 3px;
      font-family: sans-serif;
      outline: none;
      line-height: 25px;

    }
    .s-n-link:hover{

      background-color:#ffbb33;
    }

    .sticky-top.scrolled{

      background-color: #ffca28 ;
    }

    #sidenav{
     top: 120px;
    }

    @media only screen and (max-width: 600px) {
  body {
   

  }

  .card-wrapper.card{
    width: 100%;
  }
}

</style>
</head>
<body>
<div class="top  w-100" style="height: 30px; display: table;text-align: right;width: 100%;padding: 5px;">
  <h6>Mob:<i class="fas fa-phone-square-alt"></i> 7979968593 &nbsp;&nbsp;
  Email:<i class="fas fa-envelope"></i> awesomebooks@gmail.com</h6>
</div>
<nav class=" navbar navbar-expand-lg sticky-top navbar-light" >
	 	<div class="container">
  <a class="navbar-brand" href="#"><img src="images/logo.png" height="80" width="190"> </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
    aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
 
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home
          <span class="sr-only">(current)</span>
        </a>
      </li>
    
      <li class="nav-item">
        <a class="nav-link" href="#">Category</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><i class="fas fa-shopping-cart"></i></a>
      </li>

     
    
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
         My Account <i class="fas fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-default rounded-0"
          aria-labelledby="navbarDropdownMenuLink-333">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
    </ul>

  </div>
</div>
</nav>

<!--/.Navbar -->
<hr>

<div class="row mt-1 p-2">
  <div class="col-2" style="height: 500px auto;">
    <div id="sidenav" class=" p-2 sticky-top" style="display: table;text-align:center;width: 100%;box-shadow: 1px 1px 2px;background-color: #4B515D;">
      <span class="s-n-header text-white bg-warning mt-2 p-1" style="height: 30px;width: 100%;display: table;text-align: center;font-weight: bolder;">CATEGORY</span>
      
       <a class="s-n-link" href="bests.php">Best Seller</a>
        <a class="s-n-link" href="bests.php">Anatomy</a>
         <a class="s-n-link" href="bests.php">Medical Books</a>
          <a class="s-n-link" href="bests.php">Best Seller</a>
           <a class="s-n-link" href="bests.php">Best Seller</a>
            <a class="s-n-link" href="bests.php">Best Seller</a>
               <a class="s-n-link" href="bests.php">Best Seller</a>
        <a class="s-n-link" href="bests.php">Anatomy</a>
         <a class="s-n-link" href="bests.php">Medical Books</a>
          <a class="s-n-link" href="bests.php">Best Seller</a>
           <a class="s-n-link" href="bests.php">Best Seller</a>
            <a class="s-n-link" href="bests.php">Best Seller</a>
     
    
    </div>
   
  </div>
  <div class="col">
    
    <section>
     <div class="jumbotron py-3" style="">
  <h2 class="display-5 text-success">Quote of the day</h2>
  <p class="lead" style="font-family: cursive;">“I find television very educating. Every time somebody turns on the set, I go into the other room and read a book.”
― Groucho Marx </p>
  <hr class="my-1">



</div>
    </section>

    <h5 style="font-family: cursive;">Explore Books</h5>
    <span class="badge badge-danger mb-1" style="height: 30px;width: 200px;font-size: 12px;line-height: 30px;">Top Peaks of the Day</span>
    <section>
      
<?php
    
    $conn = mysqli_connect("localhost","root","","book_store");
    $sql = "SELECT * FROM books WHERE category='bs'";
    $res = mysqli_query($conn,$sql);

    echo "<div class='row'>";

    while ($row = mysqli_fetch_array($res)) {
      
      echo '<div class="col-lg-3 p-3 col-md-4 col-sm-6 col-12">
              <!-- Rotating card -->
<div class="card-wrapper">
  <div class="card text-center">

    <!-- Front Side -->
    <div class="face front">

      <!-- Content -->
      <div class="card-body">
       <div class="card-up">
       <img src="'.$row['img'].'" height="250" width="95%">
      </div>
        
        <p class="font-weight-bold blue-text">'.$row['book_name'].'</p>
        <p class="muted-text">By '.$row['author'].'</p>
       <button class="btn btn-success"><i class="fas fa-cart-plus"></i>&nbsp;ADD TO CART</button>
      </div>
    </div>
    <!-- Front Side -->

  </div>
</div>
<!-- Rotating card -->
      </div>';
    }

?>
    </section>
   <hr>
   <section>
          <h5 style="font-family: cursive;">Books in Demand</h5>
    <span class="badge badge-danger mb-1" style="height: 30px;width: 200px;font-size: 12px;line-height: 30px;">Most sold books</span>
    <section>
      
<?php
    
    $conn = mysqli_connect("localhost","root","","book_store");
    $sql = "SELECT * FROM books WHERE category='aa'";
    $res = mysqli_query($conn,$sql);

    echo "<div class='row'>";

    while ($row = mysqli_fetch_array($res)) {
      
      echo '<div class="col-3 p-3 ">
              <!-- Rotating card -->
<div class="card-wrapper">
  <div class="card card-rotating text-center">

    <!-- Front Side -->
    <div class="face front">

      <!-- Content -->
      <div class="card-body">
       <div class="card-up">
       <img src="'.$row['img'].'" height="250" width="95%">
      </div>
        
        <p class="font-weight-bold blue-text">'.$row['book_name'].'</p>
        <p class="muted-text">By '.$row['author'].'</p>
       <button class="btn btn-success"><i class="fas fa-cart-plus"></i>&nbsp;ADD TO CART</button>
      </div>
    </div>
    <!-- Front Side -->

  </div>
</div>
<!-- Rotating card -->
      </div>';
    }

?>
   </section>
  </div>
  
</div>



<script type="text/javascript">
$(document).scroll(function () {
    var $nav = $(".sticky-top");
    $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
  });

</script>
</body>
</html>