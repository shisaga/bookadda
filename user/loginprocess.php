<?php

session_start();
include_once '../config.php';

$username = $_POST['username'];
$password = $_POST['password'];

if(isset($username) && isset($password))
{
	$sql = "SELECT * FROM login WHERE username = '$username'";

    $result = mysqli_query($link,$sql);

    if (mysqli_num_rows($result)>0) {
  				
  				while ($row = mysqli_fetch_array($result)) {

  					if (password_verify($password,$row['password'] )) {
                    
  						$_SESSION['loggedin'] = true;
  						$_SESSION['id'] = $row['user_id']; 
  						$_SESSION['username'] = $row['username'];
                        $_SESSION['name'] = $row['name']; 
  						echo 1;

  					
  					}else{

  						echo 0;
  					}
  				}
  				
  			}else
  			{
  				echo 0;
  			}
}


?>