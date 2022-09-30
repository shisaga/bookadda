<?php
session_start();
require_once '../config.php';
if(!empty($_SESSION["loggedin"])) {
    $id = $_SESSION["id"];
    $sql = "select * from cart where user_id ='$id'";
    $result = mysqli_query($link,$sql);
    echo mysqli_num_rows($result);

} else {
 echo "error";    
}

?>