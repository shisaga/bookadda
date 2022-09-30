<?php 

include_once 'header_rent.php';
require_once '../user/logincheck.php';
include_once '../config.php';

//Getting user credentials
$user_id = $_SESSION['id'];

     $sql = "SELECT * FROM login WHERE user_id = $_SESSION[id]";

     $res = mysqli_query($link,$sql);
     
     while ($row = mysqli_fetch_array($res)) {
         
         $name = $row['name'];
         $mobile = $row['mobile'];
         $email = $row['username'];
     }




$orderId = $_SESSION['orderid'];

$sql = "SELECT * FROM rent_orders WHERE order_id = $orderId";
$res = mysqli_query($link, $sql);

while($row = mysqli_fetch_array($res)) {
  $imageLocation = $row['img'];
  $purchaseDate = $row['date_of_purchase'];
  $purchaseDateTemp = $row['date_of_purchase'];
  $timeDuration = $row['days'] + 2;

  


        //Calculation
				$time =$row['days'];
		 		$date= $row['date_of_purchase'];

				 $current_date=(int) date('d');
				 $purchase_year = (int) substr($date,0,4);
				 $purchase_date= ((int) substr($date, 8,2)) + 2;
				 $purchase_month = (int) substr($date,5,2);
				 $current_month= (int) date('m');
				 $time_duration= (int) $row['days'];
		   
   
			   if($purchase_month == $current_month){
				   
			 
				   $day_l= $current_date - $purchase_date;
				   $day_l = $time_duration - $day_l;
				   
	
				  }
			   else{
				   if($purchase_month != $current_month){
					   
					   $d=$no_of_days_in_month = (int) date('t');
					   
						if($d == 31){
						  $number = cal_days_in_month(CAL_GREGORIAN, $purchase_month, $purchase_year);
						  $month_passed = $current_month - $purchase_month;
						  $day_l = ($number * $month_passed) - $purchase_date;
						  $day_l = $day_l + $current_date;
						  $day_l = $time_duration - $day_l;
							
						}
						elseif($d == 30){
  
						  $number = cal_days_in_month(CAL_GREGORIAN, $purchase_month, $purchase_year);
						  $month_passed = $current_month - $purchase_month;
						  $day_l = ($number * $month_passed) - $purchase_date;
						  $day_l = $day_l + $current_date;
						  $day_l = $time_duration - $day_l;
  
						  /* $day_l =  
						   if($current_month == ($purchase_month + 1) ){
						   $day_l = $day_l + 31;
						   $day_l= "Days left  to return book " . $day_l. ' days';
						   }
						   if($current_month == ($purchase_month + 2)){
							   $day_l =$day_l + 31;
							   $day_l= "Days left  to return book " . $day_l;
						   }*/
   
   
   
						}
   
				   }
				   
   
				  }
			}
			

		
//Calculating Return Date

$duration = abs($timeDuration) . " days";
$dateObject = date_create("$purchaseDateTemp");
date_add($dateObject, date_interval_create_from_date_string($duration));
?>
<style>
.tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;
  position: absolute;
  z-index: 1;
  top: -5px;
  left: 110%;
}

.tooltip .tooltiptext::after {
  content: "";
  position: absolute;
  top: 50%;
  right: 100%;
  margin-top: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: transparent black transparent transparent;
}
.tooltip:hover .tooltiptext {
  visibility: visible;
}
</style>
<br>
<br>
<div class="container">
<div class="card mb-3" style="max-width:  100%">
  <div class="row g-0">
    <div class="col-md-4">
      <div id="demo" class="carousel slide" data-ride="carousel">



  <!-- The slideshow -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="<?php echo $imageLocation ?>" alt="Los Angeles" width="100%" height="100%">
    </div>
  </div>


</div>
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><font color="#FD0000">Payment For Extra Days To Return Book</font></h5>
        <p class="card-text">You used the book for extra days for which you will have to pay a certain amount before returning a book.</p>
        

		<label for="start">Purchase Date : </label>

     <input type="text"  class ="from-group" id="start" name="trip-start" value="<?php echo strftime('%Y-%m-%d',
  strtotime($purchaseDate)); ?>" disabled>
	  &nbsp; &nbsp; &nbsp;<label for="start"> Return Date : </label>
     <input type="text"  class ="from-group" id="end" name="trip-start" value=<?php echo date_format($dateObject,"Y-m-d"); ?> disabled>
     <p><small>Grace Days :- 2</small></p><br>
      <p >Duration :- <?php echo $timeDuration ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Extra Days :- <?php echo abs($day_l) ?>&nbsp;&nbsp;<div class="tooltip">hover over me<span class="tooltiptext">Hello My Name is</span></div><p>
        <p></p>
	 <label for="start" style="color:green;font-weight:bold;font-size:20px;">Total Price:&nbsp;<?php echo "₹ ".abs($day_l) ?></label>  <label for="start" id ="price" value= ""></label><br>
	 <br>

	
   <input type="button" class="btn btn-success"  id="btn" value="Pay Now" onclick="pay_now()"/>
      </div>
    </div>
  </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>


<script>
        var name='<?php echo "$name"?>';
		    var email='<?php echo "$email" ?>';
		    var mobile='<?php echo "$mobile"?>';
        var amt = '<?php echo abs($day_l) ?>';
        var userid ='<?php echo "$user_id"?>';
        var orderid ='<?php echo "$orderId"?>';
		    var date_of_purchase='<?php echo date("Y/m/d") ?>';
		    var penalty_amount = '<?php echo "₹ ".abs($day_l) ?>';

		var options = {
			"key": "rzp_test_5tJY1Bs0f565X1", // Enter the Key ID generated from the Dashboard
			"amount": amt*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
			"currency": "INR",
			"name": "Book Adda",
			"description": "No. 1",
			"image": "../user/logo.png",
			//"order_id": "order_9A33XWu170gUtm", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1

			"prefill": {
				"name": name,
				"email": email,
				"contact": mobile
			},
			"theme": {
				"color": "#3399cc"
			},
			"handler": function (response){
                           jQuery.ajax({
                               type:'post',
                               url:'penalty_payment_process.php',
                               data:"payment_id="+response.razorpay_payment_id+"&amt="+amt+"&userid="+userid+"&orderid="+orderid+"&date_of_purchase="+date_of_purchase,
                               success:function(result){
                                   window.location.href="bankdetail.php";
                               }
                               
                           });
                        }
		};
		var rzp1 = new Razorpay(options);
		document.getElementById('btn').onclick = function(e){
		rzp1.open();
}
</script>


<?php include_once 'footer.php'; ?>


