
    <!DOCTYPE html>
    <html lang="en" dir="ltr">
      <head>
        <meta charset="utf-8">
        <title>online book store</title>
        
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
    .info
    {
      text-align: right;
      margin-bottom: 20px;
    }
    </style>
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
      </head>
      <body>
      <div class="container">
        
        <nav class="navbar navbar-expand-lg navbar-light" >
          <a class="navbar-brand" href="index.php"> <img src="images/logo.png" alt="" href="80" width="150"> </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">

            <?php

              echo '<li class="nav-item">
                <a class="nav-link" href="login.php" style="font-size:18px"><b>Login</b></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="email_for_otp.php" style="font-size:18px">Signup</a>
              </li>  
              <li class="nav-item">
                <a class="nav-link" href="contact.php" style="font-size:18px">Contact</a>
              </li>';

           ?>
            </ul>
          </div>
        </nav>
        <hr>
      </div>

