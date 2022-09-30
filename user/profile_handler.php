<?php
//Starting the session to fetch and store session values
session_start();

//files Require to run below commands
require_once '../config.php';

//Fetching old name and mobile number of the user
$sql = "SELECT * FROM login WHERE  user_id = $_SESSION[id]";
$res = mysqli_query($link,$sql);

while ($row = mysqli_fetch_array($res)) {
    
    $old_name = $row['name'];
    $old_mobile = $row['mobile'];

}

//fetching new name and mobile number from passed values from previous page
$name = $_POST['name'];
$mobile = $_POST['mobile'];
$output="";

//Updating name and mobile number of the user
if(empty($name) || empty($mobile))
{
    $output = '<div class="alert alert-danger">Error Occured Try Again</div>';
}
else 
{
  
    $sql = "Update login set mobile=$mobile Where mobile=$old_mobile;";
    $sql .= "Update login set name='$name' Where name='$old_name';";
    //$stmt = mysqli_multi_query($link,$sql);

    if(mysqli_multi_query($link,$sql))
    { 
        $output = '<div class="alert alert-success">
        <div class="alert-header">Profile Updated Successful</div>
        Taking you to Profile page. Please Wait .. <img src="images/ap.gif" width="100" height="100"></div>';
    }
    else
    {
        $output = '<div class="alert alert-danger">Error Occured</div>';
    }

}

//Printing the result/output on the screen
echo $output;

?>
