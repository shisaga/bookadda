<?php
require_once '../config.php';
 require_once 'header.php';
 require_once 'logincheck.php';
$output ="";
$users="";
$count=0;
 if (isset($_POST['q'])) {
   $bookname= $_POST['book_id'];
   $sql = "SELECT * FROM login";

   $result = mysqli_query($link,$sql);
   $output .= '
   <table class="table">
    <tr>
        <th>User Id</th>
        <th>Username</th>
        <th>Name</th>
        <th>Mobile</th>
        <th>Action</th>
    </tr>';
      while ($row = mysqli_fetch_array($result)) 
      {
        
        $var = $row['username'];
        if($var == $bookname)
        {
          $count=1;
            $output .= '
                <tr>
                <td>'.$row['user_id'].'</td>
                <td>'.$row['username'].'</td>
                <td>'.$row['name'].'</td>
                <td>'.$row['mobile'].'</td>
                <td>
                <!--<button type="button" id="'.$row['user_id'].'" class="btn btn-info btn-sm update_book" data-toggle="modal" data-target="#UpdateBookModal">Update</button>-->
                <button type="button" book_id="'.$row['user_id'].'" class="btn btn-danger btn-sm remove_book">Remove</button>
                </td>
                </tr>';
        }
        
      }
      $output .= '</table>';
      if($count==0)
      {
        $output = '<div class="alert alert-danger">No record found</div>';
      }
}


 

   $sql = "SELECT * FROM login";

   $result = mysqli_query($link,$sql);

   $books = mysqli_num_rows($result);

   if(mysqli_num_rows($result)>0)
   {
     $output .= '
    <h4 class="text-success"> Total Users: '.$books.'</h4>
     <table class="table">
       <tr>
       <th>User Id</th>
       <th>Username</th>
       <th>Name</th>
       <th>Mobile</th>
       <th>Action</th>
       </tr>';
      while ($row = mysqli_fetch_array($result)) {

        $output .= '
          <tr>
          <td>'.$row['user_id'].'</td>
          <td>'.$row['username'].'</td>
          <td>'.$row['name'].'</td>
          <td>'.$row['mobile'].'</td>
          <td>
            <!--<button type="button" id="'.$row['user_id'].'" class="btn btn-info btn-sm update_book" data-toggle="modal" data-target="#UpdateBookModal">Update</button>-->
            <button type="button" book_id="'.$row['user_id'].'" class="btn btn-danger btn-sm remove_book">Remove</button>
          </td>
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
     <input class="form-control mr-sm-2" name="book_id" type="text" placeholder="Enter Book Name" aria-label="Search">
     <input class="btn btn-outline-success my-2 my-sm-0" name="q" type="submit" value="Search"> &nbsp;&nbsp;
     <!--<button class="btn btn-outline-success my-2 my-sm-0" name="all" type="submit">View All</button>-->
     <input type=submit value="View All" class="btn btn-outline-success my-2 my-sm-0">
   </form>
      <br><br>
      <div class="" id="msg">

      </div>

        <?php echo $output; ?>

     </div>
   </div>
 </div>

 <div class="modal fade" tabindex="-1" role="dialog" style="display: none;" id="UpdateBookModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Book Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <span id="book_update_msg"></span>
      <div class="modal-body">
        <form class=""  method="post">
            <div class="form-group">
              <label for="">Enter Stock (Current Stock)</label>
              <input type="text" name="quantity" value="" placeholder="Enter Quantity" class="form-control quantity">
            </div>
            <div class="form-group">
              <button type="submit" name="button" class="btn btn-success update_book_qty">Submit</button>
            </div>
        </form>

      </div>

    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    var book_id;
    $('.update_book').click(function(){
       book_id = $(this).attr("id");
      var action = 'update_book';
      console.log(book_id);
      $.ajax({

         url: "update_process.php",
         method: "post",
         data: {book_id:book_id,action:action},
         dataType: "text",
         success: function(data){
          console.log(data);
           $('.quantity').val(data);

         }
     });
    });

    $('.update_book_qty').click(function(){
      var action = 'update_book_qty';
      var quantity = $('.quantity').val();
      console.log(book_id);
      $.ajax({

         url: "update_process.php",
         method: "post",
         data: {book_id:book_id,action:action,quantity:quantity},
         dataType: "text",
         success: function(data){
          console.log(data);
           $('#book_update_msg').html('<div class="alert alert-success" >'+data+'</div>');
           window.setTimeout(function(){
             $('#book_update_msg').html('');
             $('#UpdateBookModal').modal('hide');
           },1000);
         }
     });
    });

    $('.remove_book').click(function(){
      var book_id = $(this).attr('book_id');
      var action = 'remove_book';
      if(confirm("Are You Sure You Want To Remove This User?")){
        console.log(book_id);
        $.ajax({
           url: "remove_user_process.php",
           method: "post",
           data: {book_id:book_id,action:action},
           dataType: "text",
           success: function(data){
            console.log(data);
            $('html,body').animate({scrollTop:0},0);
             $('#msg').html('<div class="alert alert-success" >'+data+'</div>');
             window.setTimeout(function(){
               window.location.href = "remove_users.php";
             },2000);
           }
       });
      }

    });


  });
</script>
<?php require_once 'footer.php'; ?>
