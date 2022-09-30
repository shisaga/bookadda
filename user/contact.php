<?php

require 'header.php';
require_once '../config.php';



?>

<!DOCTYPE html>
<html>
<head>
	<title>contact form</title>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-sm-3"></div>
			<div class="col-sm-5">

				<span id="status"></span>

				<span style="display: table;width: 100%;font-size: 24px;font-weight: bolder;">Contact Form</span>
				<br>
			<form method="post" id="contact_form">
			  <div class="form-group">
			    <label for="exampleInputEmail1">Email address</label>
			    <input type="email" class="form-control" id="Email" aria-describedby="emailHelp" required="required">
			    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
			  </div>
			  <div class="form-group">
			    <label for="">Name</label>
			    <input type="text" name="name" class="form-control" id="name" required="required">
			  </div>
			  
			  <div class="form-group ">
			    <label>Your message</label>
			    <textarea cols="5" rows="5" class="form-control" style="resize: none;" id="message" required="required"></textarea>
			  </div>
			  <button type="button" id="submit_msg" class="btn btn-primary">Send</button>
			</form>
			</div>
				<div class="col-sm-4"></div>
	</div>
</div>
<?php
require_once 'footer.php';
?>