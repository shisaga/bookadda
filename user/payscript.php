<?php


 $apiKey = "rzp_test_5tJY1Bs0f565X1";

?>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>



<form action="order_success.php" method="POST">
<script
    src="https://checkout.razorpay.com/v1/checkout.js"
    data-key="<?php echo $apiKey; ?>" // Enter the Test API Key ID generated from Dashboard → Settings → API Keys
    data-amount="<?php $sum=$total_price*100; echo $sum; ?>" // Amount is in currency subunits. Hence, 29935 refers to 29935 paise or ₹299.35.
    data-currency="INR"//You can accept international payments by changing the currency code. Contact our Support Team to enable International for your account
    data-id="<?php echo $order_id;?>"//Replace with the order_id generated by you in the backend.
    data-buttontext="Pay with Razorpay"
    data-name="Book Adda"
    data-description="Training & Development!"
    data-image="logo.png"
    data-prefill.name="<?php echo $name;?>"
    data-prefill.email="<?php echo $email;?>"
    data-prefill.contact="<?php echo $mobile;?>"
    data-theme.color="#F37254"
></script>
<input type="hidden" custom="Hidden Element" name="hidden">
</form>

