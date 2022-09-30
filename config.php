<?php

//$link = mysqli_connect("sql208.epizy.com","epiz_32087284","","epiz_32087284_bookstore");
$link = mysqli_connect("localhost","root","","bookstore");

if(!$link){

	echo "Error occured. Unable to connect to database. Try to refresh page";
}

?>