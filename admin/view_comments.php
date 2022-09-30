<?php
require_once '../config.php';
 require_once 'header.php';
 require_once 'logincheck.php';
$output ="";
$users="";




   $sql = "SELECT * FROM contact";

   $result = mysqli_query($link,$sql);

   $users = mysqli_num_rows($result);

   if(mysqli_num_rows($result)>0)
   {
     $output .= '
    <h4 class="text-success"> Total Comments: '.$users.'</h4>
     <table class="table">
       <tr>
         <th>Id</th>
         <th>Email</th>
         <th>Name</th>
         <th>Message</th>
       </tr>';
      while ($row = mysqli_fetch_array($result)) {

        $output .= '
          <tr>
            <td>'.$row['contact_id'].'</td>
            <td>'.$row['email'].'</td>
            <td>'.$row['name'].'</td>
            <td>'.$row['msg'].'</td>
          </tr>';
      }
      $output .= '</table>';
   }else {
     $output = '<div class="alert alert-danger">No record found</div>';
   }


 function test_input($data){
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
 }
  ?>
 <div class="container">
   <div class="row">
     <div class="col-lg-2">
     </div>
     <div class="col-lg-10">
       <form class="form-inline" method="post">

   </form>
      <br><br>

        <?php echo $output; ?>

     </div>
   </div>
 </div>

<?php require_once 'footer.php'; ?>
