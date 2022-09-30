

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<footer class="site-footer" style="
  background-color:#26272b;
  padding:45px 0 20px;
  font-size:15px;
  line-height:24px;
  color:#737373;">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <h6>About</h6>
            <p class="text-justify">BookAdda.com <i> WANTS TO BE SIMPLE. </i>It aims to simplify buying books online for the upcoming generation. Bookadda focuses on facilitating the most efficient and easy buying process for students. We assist students build up their concepts across different subjects without any hassle. This will give access to all bookfreaks wherever they are, who want to buy book and create his/her own library.</p>
          </div>

          <div class="col-xs-6 col-md-3">
            <h6>Email</h6>

           <p><a href="mailto:bookadda.dev@gmail.com">Bookadda.dev@gmail.com</a></p>
         <h6> Contact</h6>
           <p><a href="tel:8494090499">8494090499</a><br/><a href="tel:9643940203">9643940203</a></p>
           
          </div>

          <div class="col-xs-6 col-md-3">
            <h6>Quick Links</h6>
            <ul class="footer-links">
              <!--<li><a href="#">About Us</a></li>-->
              <li><a href="../index.php">Home</a></li>
              <li><a href="../user/contact.php">Contact Us</a></li>
              <!--<li><a href="#">Contribute</a></li>-->
           
            </ul>
          </div>
        </div>
        <hr>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-sm-6 col-xs-12">
            <p class="copyright-text">Copyright &copy; 2022 All Rights Reserved by 
         <a href="../index.php">BookADDA</a>.
            </p>
          </div>

        
        </div>
      </div>
</footer>

<script type="text/javascript">
	$(document).ready(function(){

    order_check();
                function order_check(){
                    var total_orders = $('#total_orders').val();
                    if (total_orders == 0) {
                      $('#load_more').hide().fadeTo(500);
                      $('#order_info').html("No orders to show");

                   }
                }

                var last_id = 5;
                check();
                function check(){

                     var total_orders = $('#total_orders').val();
                     if(total_orders<=5 && total_orders >0) {

                                   $('#load_more').remove();
                                    $('#order_info').css("display","block");
                                    window.setTimeout(function(){
                                         $('#order_info').html("That's all of your orders.");
                                    },200);

                            }
                }

                window.setTimeout(function(){

                    $('.error').fadeOut(500);
                    $('.status').fadeOut(500);
                },1000);

            

                $('#load_more').click(function(){

                    var total_orders = $('#total_orders').val();

                    $.ajax({

                        url: "getmoredata.php",
                        method : "post",
                        data: {last_id:last_id},
                        dataType: "text",
                        success: function(data){

                            $('#load_more').hide();
                            $('#loading').html("Loading..<img src='images/tenor.gif' height='30' width='30'>");
                            window.setTimeout(function(){

                                $(data).appendTo('#data').hide().fadeIn(500);
                                $('#loading').html('');
                                $('#load_more').show();

                            },500);

                            last_id += 5;

                            if (last_id > total_orders) {

                                 $('#load_more').css("visibility","hidden");
                                 $('#order_info').css("display","block");
                                    window.setTimeout(function(){
                                    $('#order_info').html("That's all of your orders.");
                                    },1200);
                            }
                            

                        }
                    });

                });

	});

  
</script>
</body>
</html>
