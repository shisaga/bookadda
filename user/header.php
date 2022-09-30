<?php
session_start();
 date_default_timezone_set("Asia/Calcutta");

?>
<script type="text/javascript">
    (function(d, m){
        var kommunicateSettings = 
            {"appId":"13128d045617e3456fd2dba4a134e608b","popupWidget":true,"automaticChatOpenOnNavigation":true};
        var s = document.createElement("script"); s.type = "text/javascript"; s.async = true;
        s.src = "https://widget.kommunicate.io/v2/kommunicate.app";
        var h = document.getElementsByTagName("head")[0]; h.appendChild(s);
        window.kommunicate = m; m._globals = kommunicateSettings;
    })(document, window.kommunicate || {});
/* NOTE : Use web server to view HTML files as real-time update will not work if you directly open the HTML file in the browser. */
</script>

    <!DOCTYPE html>
    <html lang="en" dir="ltr">
      <head>
        <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta http-equiv="refresh" content="900;url=logout.php" />
        <title>online book store</title>
        <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css">


    
    <style>
          .details li {
      list-style: none;
    }
    li {
        margin-bottom:10px;
        
    }
    .info
    {
      text-align: right;
      margin-bottom: 20px;
    }

    .hov:hover {
      background-color : #ffbb33;
    }

    .sidebar tr td
    {
      width: 200px;
      height: 39px;
      text-align: center;
      border-collapse: collapse;
    
    }
    
    .sidebar tr:nth-child(even)
    {
      background-color: dimgray;
     
    }
    .sidebar tr:nth-child(odd)
    {
      background-color: dimgray;

    }
     .sidebar tr:nth-child(1)
    {
      background-color: crimson;
      color: white;

    }
    .sidebar tr td a
    {
      color: white;
      text-decoration: none;
    }
    .tag{
      width: 100%;
      display: inline-table;
      height: 30px;
      background-color: dimgray;
      text-align: center;
      font-weight: bold;
      color: white;
    }
    #product
    {
      padding: 15px;
    }
        .fade-scale {
  transform: scale(0);
  opacity: 0;
  -webkit-transition: all .25s linear;
  -o-transition: all .25s linear;
  transition: all .25s linear;
}

.fade-scale.in {
  opacity: 1;
  transform: scale(1);
}
      
      #otp_div{
        display: none;
      }

      #confirm_div{
        display: none;
      }

      #confirm_otp{

        display: none;
      }

      .modal {
  text-align: center;
  padding: 0!important;
}

.modal:before {
  content: '';
  display: inline-block;
  height: 100%;
  vertical-align: middle;
  margin-right: -4px;
}

.modal-dialog {
  width: 100%;
  display: inline-block;
  text-align: left;
  vertical-align: top;
}
.no-js #loader { display: none;  }
    .js #loader { display: block; position: absolute; left: 100px; top: 0; }


.no-js #loader { display: none;  }
    .js #loader { display: block; position: absolute; left: 100px; top: 0; }


    .active{
      background-color: #4285F4;
      color: white;
    }
    .center 
    {
      margin: auto;
width: 100%;
align:center;
    }
    .self{
      text-align: center;
    }
    @media (max-width:600px){



    }
        </style>
      </head>
      <body>
      
        <nav class="navbar navbar-expand-lg navbar-light  scrolled" style="background-color:white;">
          <div class="container" >
          <a class="navbar-brand" href="index.php"> <img src="images/logo.png" alt="" href="80" width="150"> </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto self">

            <?php

                if (isset($_SESSION['loggedin'])) {
                 echo ' 
                 <a class="nav-link" href="../rent/index.php" style="background:#EC840F;border-radius:10px;color:white;font-size:18px;padding-top:13px;">Rent</a>
                 
                 <a class="nav-link" href="cart.php" style="padding-left:20px;font-size:18px">Bag<i class="fas fa-shopping-cart"></i> <span class="badge badge-warning" style="border-radius:50%;height:20px;" id="countcart"></span></a>
                  

                 <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size:18px">
         My Account
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <h5 class="dropdown-header">Hello, '.$_SESSION['name'].'</h5>
          <a class="dropdown-item" href="profile.php" ><i class="fas fa-user"></i>
            My Profile</a>
            <a class="dropdown-item" href="change_password.php"><i class="fas fa-key"></i>
            Change Password</a>
          <a class="dropdown-item" href="orders_history.php"><i class="fas fa-cube"></i> 
            Orders</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
      </li>';
                }else
                {
                   echo '
                   <li class="nav-item">
                <a class="nav-link" id="self3" href="../rent/index.php" style="background:#EC840F;border-radius:10px;color:white;font-size:18px;padding-top:7px;margin-right:20px;">Rent</a>
              </li>
                   <li class="nav-item">
                <a class="nav-link self2" href="login.php" style="font-size:18px;"><b>Login</b></a>
              </li>
              
              <li class="nav-item">
                <a class="nav-link" href="email_for_otp.php" style="font-size:18px">Signup</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.php" style="font-size:18px">Contact</a>
              </li>   ';
                }
             

           ?>
            </ul>
          </div>
        </div>
        
        </nav>
        
        <div class="container"></div>
        
      

