<?php 

include_once 'header_rent.php';
require_once '../user/logincheck.php';
include_once '../config.php';
require '../sendMail.php';

$sql = "SELECT * FROM login WHERE user_id = $_SESSION[id]";
$res = mysqli_query($link,$sql);
 
while ($row = mysqli_fetch_array($res)) {
    
    $name = $row['name'];
    $mobile = $row['mobile'];
    $email = $row['username'];
}

if(mysqli_num_rows(mysqli_query($link,$sql)) === 0)
{
	echo "<script> window.location.href = 'index.php'; </script>";
	exit();
}
if(isset($_POST['SKIP']) == "SKIP")
{



			$order_id = $_SESSION['orderid'];

			$sql ="UPDATE rent_orders SET status= 'returned' WHERE order_id= $_SESSION[orderid]";
			mysqli_query($link,$sql);

      		$q = "SELECT order_id,book_id,quantity FROM rent_orders WHERE order_id = $_SESSION[orderid]";
      		$res = mysqli_query($link,$q);
      		while ($row = mysqli_fetch_array($res)) {
        	$qty = $row['quantity'] +1;
            $id = $row['book_id'];
        	$sql = "UPDATE rent_books SET quantity = $qty WHERE id = '$id'";
        	mysqli_query($link,$sql);

        $to_email = $email;
        $subject = "Order Successfully Cancelled!";
        $body = "Hi, ". $name. "\nYour Order Has been successfully  requested to return!"."\n"."With Order Id : ".$order_id;
        $headers = "From: bookadda.dev@gmail.com";
        
        
        mail($to_email, $subject, $body);


      }
			if ($res) {
			//echo "<script> alert('order cancelled');</script>";
			$res1 = mysqli_query($link,"SELECT * FROM payment WHERE order_id='$order_id'");
			while($row1 = mysqli_fetch_array($res1))
			{
				if($row1['payment_status'] == "")
				{
					mysqli_query($link,"UPDATE rent_orders SET refund_status=1 WHERE order_id=$order_id");
				}
			}
			echo "<script> window.location.href = 'returnbook.php'; </script>";
			}/*else{
				echo "<script> alert('error occured! try again');</script>";

			}*/
}
if (isset($_POST['bnsubmit']) == "SUBMIT BANK DETAILS") {
		
		$user_id = $_SESSION['id'];
        $acc_holder_name = $_POST['acc_name'];
        $acc_no= $_POST['Acc_Number'];
        $IFSC= $_POST['IFSC'];
        $bank_name= $_POST['bN'];
        $upi= "N/A";
        $sql2="INSERT INTO rent_bank_detail values('','$acc_holder_name','$acc_no','$IFSC','$bank_name','$upi','$user_id')";
       
        
        mysqli_query($link,$sql2);
        if (mysqli_query($link,$sql2)) {

           // $status = "<script> window.location.href = returnbook.php'; </script>";
           $order_id = $_SESSION['orderid'];

           $sql ="UPDATE rent_orders SET status= 'returned' WHERE order_id= $_SESSION[orderid]";
           mysqli_query($link,$sql);

             $q = "SELECT order_id,book_id,quantity FROM rent_orders WHERE order_id = $_SESSION[orderid]";
             $res = mysqli_query($link,$q);
             while ($row = mysqli_fetch_array($res)) {
           $qty = $row['quantity'] + 1;
           $id = $row['book_id'];
           $sql = "UPDATE rent_books SET quantity = $qty WHERE id = $id";
           mysqli_query($link,$sql);

       $to_email = $email;
       $subject = "Order Successfully Cancelled!";
       $body = "Hi, ". $name. "\nYour Order Has been successfully  requested to return!"."\n"."With Order Id : ".$order_id;
       $headers = "From: bookadda.dev@gmail.com";
       
       
       mail($to_email, $subject, $body);


     }
           if ($res) {
           //echo "<script> alert('order cancelled');</script>";
           $res1 = mysqli_query($link,"SELECT * FROM payment WHERE order_id='$order_id'");
           while($row1 = mysqli_fetch_array($res1))
           {
               if($row1['payment_status'] == "")
               {
                   mysqli_query($link,"UPDATE rent_orders SET refund_status=1 WHERE order_id=$order_id");
               }
           }
           //echo "<script> window.location.href = 'bankdetail.php'; </script>";
           }/*else{
               echo "<script> alert('error occured! try again');</script>";

           }*/
           echo "<div class='container'><div class='alert alert-success'style =' text-align: center;'>Bank detail saved Successfully!!</div></div>";
         }else {
          $status = "";
         }

}
if (isset($_POST['bsubmit']) == "SUBMIT UPI ID") {
		
    $user_id = $_SESSION['id'];
    $acc_holder_name = "N/A";
    $acc_no= "";
    $IFSC= "N/A";
    $bank_name= "N/A";
    $upi= $_POST["upi"];
    $sql2="INSERT INTO rent_bank_detail values('','$acc_holder_name','$acc_no','$IFSC','$bank_name','$upi','$user_id')";
   
    

    if (mysqli_query($link,$sql2)) {

       // $status = "<script> window.location.href = returnbook.php'; </script>";
       $order_id = $_SESSION['orderid'];

       $sql ="UPDATE rent_orders SET status= 'returned' WHERE order_id= $_SESSION[orderid]";
       mysqli_query($link,$sql);

         $q = "SELECT order_id,book_id,quantity FROM rent_orders WHERE order_id = $_SESSION[orderid]";
         $res = mysqli_query($link,$q);
         while ($row = mysqli_fetch_array($res)) {
       $qty = $row['quantity'] + 1;
       $id = $row['book_id'];
       $sql = "UPDATE rent_books SET quantity = $qty WHERE id = $id";
       mysqli_query($link,$sql);

   $to_email = $email;
   $subject = "Order Successfully Cancelled!";
   $body = "Hi, ". $name. "\nYour Order Has been successfully  requested to return!"."\n"."With Order Id : ".$order_id;
   sendMail($to_email,$subject,$body);
//    $headers = "From: bookadda.dev@gmail.com";
   
   
//    mail($to_email, $subject, $body);


 }
       if ($res) {
       //echo "<script> alert('order cancelled');</script>";
       $res1 = mysqli_query($link,"SELECT * FROM payment WHERE order_id='$order_id'");
       while($row1 = mysqli_fetch_array($res1))
       {
           if($row1['payment_status'] == "")
           {
               mysqli_query($link,"UPDATE rent_orders SET refund_status=1 WHERE order_id=$order_id");
           }
       }
       //echo "<script> window.location.href = 'bankdetail.php'; </script>";
       }/*else{
           echo "<script> alert('error occured! try again');</script>";

       }*/
       echo "<div class='container'><div class='alert alert-success'style =' text-align: center;'>Bank detail saved Successfully!!</div></div>";
     }else {
      $status = "";
     }
}	

 ?>
 <style>
     body {
    background:white;
}

.rounded {
    border-radius: 1rem;
}

.nav-pills .nav-link {
    color: #555
}

.nav-pills .nav-link.active {
    color: white
}

input[type="radio"] {
    margin-right: 5px
}

.bold {
    font-weight: bold
}
 </style>
 <br>
 <br><br>
 
<div class="container py-5">
  
    <div class="row mb-4">
        <div class="col-lg-8 mx-auto text-center">
            <h1 class="display-6"> Submit Your Payment Information</h1>
        </div>
    </div> 
    <div class="row">
        <div class="col-lg-8 mx-auto" style="">
            <div class="card ">
                <div class="card-header">
                    <div class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2">
                       
                        <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">
                            <li class="nav-item"> <a data-toggle="pill" href="#credit-card" class="nav-link  "> <i class="fas fa-credit-card mr-2"></i>Bank detail</a> </li>
                            <li class="nav-item"> <a data-toggle="pill" href="#upi" class="nav-link "><img src="images/upi.png" style="width:10%;hight:10%;"></img> </a> </li>
                            
                        </ul>
                    </div>
                    <form class="form" method="post">
                    <div class="tab-content" style="background-color:white">
                        <!-- credit card info-->
                        <div id="credit-card" class="tab-pane fade show pt-2" style="background-color:#F5F5F5; color:black;">
                           
                                <div class="form-group"> <label for="username">
                                        <h6>&nbsp;  &nbsp;  &nbsp;
                                            Account holder name
                                        </h6>
                                    </label> <input type="text" name="acc_name" placeholder="Account holder name" required class="form-control "> </div>
                                <div class="form-group"> <label for="cardNumber">
                                <h6> &nbsp;  &nbsp;  &nbsp;Account number</h6>
                                    </label>
                                    <div class="input-group"> <input type="text" name="Acc_Number" placeholder="Account number" class="form-control " required>
                                        <div class="input-group-append"> </div>
                                    </div>
                                </div>
                             
                                        <div class="form-group"> <label><span class="hidden-xs">
                                          <h6> &nbsp;  &nbsp;  &nbsp;IFSC Code
                                          </h6>
                                                </span></label>
                                            <div class="input-group"> <input type="text" placeholder="IFSC" name="IFSC" class="form-control" required>  </div>
                                        </div>
                                    
                                    <br>
                                        <div class="form-group mb-4"> 
                                        
                                        <label data-toggle="tooltip" title="ENTER THE BANK NAME">
                                                <h6> &nbsp;  &nbsp;  &nbsp;Bank Name
                                          </h6>
                                            </label> <input type="text" required name="bN"  class="form-control" > </div>
                                   
                              
                                <div class="card-footer"style="background-color:#F5F5F5; "> <input type="submit" name="bnsubmit"  value="SUBMIT BANK DETAILS"  class="subscribe btn btn-primary btn-block shadow-sm"></input>
                            
                        </div>
                    </div>
                    </form>
                    <div id="upi" class="tab-pane fade pt-3" style="background-color:#F5F5F5; color:black; ">
                        <h6 class="pb-2">Enter your UPI Id for Refund</h6>
                        <div class="form-group "> 
                            <form method="post">
                            <label class="radio-inline">UPI ID </label><input class = "form-control" type="text" name="upi" required>   </div>
                        <input type="submit"style="width:100%"   name="bsubmit" value="SUBMIT UPI ID" class="btn btn-primary"></input> 
                        </form>
                        <p class="text-muted"> Note: After clicking on the button, your paymet will be process after  reciving book and inspecting book succescfully. </p>
                    </div>

                    <div id="" class="tab-pane fade pt-3">
                </div>
                </div>
            
            </div>
        </div>
    </div>
  </div>


 <br><br>
 <form method="POST">
  <center><button type="submit"style="width:10%" class="btn btn-primary " name="SKIP"><i class="fab fa-payment mr-2"></i>SKIP</button> 
  <p class="text-muted"> Note:If bank detail already submited pleas press skip to  proceed. </p>

</center>
</form>
</div>


<?php include_once 'footer.php'; ?>