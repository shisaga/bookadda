<?php 

include_once 'header.php';
require_once 'logincheck.php';
include_once '../config.php';


$user_id = $_GET['user_id'];
$sql = "SELECT * FROM rent_bank_detail WHERE user_id=$user_id";
$result = mysqli_query($link,$sql);
if(mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_array($result))
    {
        $output= '
        
        <div class="container py-5">
        
        <div class="row mb-4">
        
            <div class="col-lg-8 mx-auto text-center">
            <div>
            <form class="form-inline" method="post">
        <input class="form-control mr-sm-2" name="user_id" type="text" placeholder="Enter USER ID" aria-label="Search" size="80">
        <input class="btn btn-outline-success my-2 my-sm-0" name="q" type="submit" value="Search"> &nbsp;&nbsp;
      </form><br>
      </div>
                <h1 class="display-6">BANK DETAILS</h1>
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
                                                ACCOUNT HOLDER NAME
                                            </h6>
                                        </label> <input type="text" value="'.$row['acc_holder_name'].'" class="form-control" disabled> </div>
                                    <div class="form-group"> <label for="cardNumber">
                                    <h6> &nbsp;  &nbsp;  &nbsp;ACCOUNT NUMBER</h6>
                                        </label>
                                        <div class="input-group"> <input type="text" class="form-control" value="'.$row['acc_no'].'" disabled>
                                            <div class="input-group-append"> </div>
                                        </div>
                                    </div>
                                 
                                            <div class="form-group"> <label><span class="hidden-xs">
                                              <h6> &nbsp;  &nbsp;  &nbsp;IFSC CODE
                                              </h6>
                                                    </span></label>
                                                <div class="input-group"> <input type="text" class="form-control" value="'.$row['IFSC'].'" disabled>  </div>
                                            </div>
                                        
                                        <br>
                                            <div class="form-group mb-4"> 
                                            
                                            <label data-toggle="tooltip" title="ENTER THE BANK NAME">
                                                    <h6> &nbsp;  &nbsp;  &nbsp;BANK NAME
                                              </h6>
                                                </label> <input type="text" class="form-control" value="'.$row['Bank_name'].'" disabled> </div>
                                       
                                  
                                    <div class="card-footer"style="background-color:#F5F5F5; ">
                                
                            </div>
                        </div>
                        </form>
                        <div id="upi" class="tab-pane fade pt-3" style="background-color:#F5F5F5; color:black; ">
                            <h6 class="pb-2">UPI ID</h6>
                            <div class="form-group "> 
                                <form method="post">
                                <input class = "form-control" type="text" value="'.$row['UPI'].'" disabled>   </div>
                            
                            </form>
                            
                        </div>
    
                        <div id="" class="tab-pane fade pt-3">
                    </div>
                    </div>
                
                </div>
            </div>
        </div>
      </div>
    
    
     <br><br>
    </div>';
    }
}
else
{
    $output= '<div class="container py-5">
  
    <div class="row mb-4">
        <div class="col-lg-8 mx-auto text-center">
            
        </div>
    </div> 
    <div class="row">
        <div class="col-lg-8 mx-auto" style="">
            <div class="card ">
                <div class="card-header">
                    <div class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2">
                       
                        <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3" >
                        <div>
            <form class="form-inline" method="post">
        <input class="form-control mr-sm-2" name="user_id" type="text" placeholder="Enter USER ID" aria-label="Search" size="72">
        <input class="btn btn-outline-success my-2 my-sm-0" name="q" type="submit" value="Search"> &nbsp;&nbsp;
      </form><br>
      </div>
                           <li><h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DATA NOT FOUND!!<h1></li>
                            
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
                                    </label> <input type="text" value="" class="form-control" disabled> </div>
                                <div class="form-group"> <label for="cardNumber">
                                <h6> &nbsp;  &nbsp;  &nbsp;ACCOUNT NUMBER</h6>
                                    </label>
                                    <div class="input-group"> <input type="text" class="form-control" value="" disabled>
                                        <div class="input-group-append"> </div>
                                    </div>
                                </div>
                             
                                        <div class="form-group"> <label><span class="hidden-xs">
                                          <h6> &nbsp;  &nbsp;  &nbsp;IFSC CODE
                                          </h6>
                                                </span></label>
                                            <div class="input-group"> <input type="text" class="form-control" value="" disabled>  </div>
                                        </div>
                                    
                                    <br>
                                        <div class="form-group mb-4"> 
                                        
                                        <label data-toggle="tooltip" title="ENTER THE BANK NAME">
                                                <h6> &nbsp;  &nbsp;  &nbsp;BANK NAME
                                          </h6>
                                            </label> <input type="text" class="form-control" value="" disabled> </div>
                                   
                              
                                <div class="card-footer"style="background-color:#F5F5F5; ">
                            
                        </div>
                    </div>
                    </form>
                    <div id="upi" class="tab-pane fade pt-3" style="background-color:#F5F5F5; color:black; ">
                        <h6 class="pb-2">UPI ID</h6>
                        <div class="form-group "> 
                            <form method="post">
                            <input class = "form-control" type="text" value="" disabled>   </div>
                        
                        </form>
                        
                    </div>

                    <div id="" class="tab-pane fade pt-3">
                </div>
                </div>
            
            </div>
        </div>
    </div>
  </div>


 <br><br>
</div>';
}

if(isset($_POST['q']))
{
    $userid=$_POST['user_id'];
    $sql = "SELECT * FROM rent_bank_detail WHERE user_id=$userid";
    $result = mysqli_query($link,$sql);

    if(mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_array($result))
    {
        $output= '
        
        <div class="container py-5">
        
        <div class="row mb-4">
        
            <div class="col-lg-8 mx-auto text-center">
            <div>
            <form class="form-inline" method="post">
        <input class="form-control mr-sm-2" name="user_id" type="text" placeholder="Enter USER ID" aria-label="Search" size="80">
        <input class="btn btn-outline-success my-2 my-sm-0" name="q" type="submit" value="Search"> &nbsp;&nbsp;
      </form><br>
      </div>
                <h1 class="display-6">BANK DETAILS</h1>
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
                                            ACCOUNT HOLDER NAME
                                            </h6>
                                        </label> <input type="text" value="'.$row['acc_holder_name'].'" class="form-control" disabled> </div>
                                    <div class="form-group"> <label for="cardNumber">
                                    <h6> &nbsp;  &nbsp;  &nbsp;ACCOUNT NUMBER</h6>
                                        </label>
                                        <div class="input-group"> <input type="text" class="form-control" value="'.$row['acc_no'].'" disabled>
                                            <div class="input-group-append"> </div>
                                        </div>
                                    </div>
                                 
                                            <div class="form-group"> <label><span class="hidden-xs">
                                              <h6> &nbsp;  &nbsp;  &nbsp;IFSC CODE
                                              </h6>
                                                    </span></label>
                                                <div class="input-group"> <input type="text" class="form-control" value="'.$row['IFSC'].'" disabled>  </div>
                                            </div>
                                        
                                        <br>
                                            <div class="form-group mb-4"> 
                                            
                                            <label data-toggle="tooltip" title="ENTER THE BANK NAME">
                                                    <h6> &nbsp;  &nbsp;  &nbsp;BANK NAME
                                              </h6>
                                                </label> <input type="text" class="form-control" value="'.$row['Bank_name'].'" disabled> </div>
                                       
                                  
                                    <div class="card-footer"style="background-color:#F5F5F5; ">
                                
                            </div>
                        </div>
                        </form>
                        <div id="upi" class="tab-pane fade pt-3" style="background-color:#F5F5F5; color:black; ">
                            <h6 class="pb-2">UPI ID</h6>
                            <div class="form-group "> 
                                <form method="post">
                                <input class = "form-control" type="text" value="'.$row['UPI'].'" disabled>   </div>
                            
                            </form>
                            
                        </div>
    
                        <div id="" class="tab-pane fade pt-3">
                    </div>
                    </div>
                
                </div>
            </div>
        </div>
      </div>
    
    
     <br><br>
    </div>';
    }
}
else
{
    $output= '<div class="container py-5">
  
    <div class="row mb-4">
        <div class="col-lg-8 mx-auto text-center">
            
        </div>
    </div> 
    <div class="row">
        <div class="col-lg-8 mx-auto" style="">
            <div class="card ">
                <div class="card-header">
                    <div class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2">
                       
                        <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3" >
                        <div>
            <form class="form-inline" method="post">
        <input class="form-control mr-sm-2" name="user_id" type="text" placeholder="Enter USER ID" aria-label="Search" size="72">
        <input class="btn btn-outline-success my-2 my-sm-0" name="q" type="submit" value="Search"> &nbsp;&nbsp;
      </form><br>
      </div>
                           <li><h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DATA NOT FOUND!!<h1></li>
                            
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
                                    </label> <input type="text" value="" class="form-control" disabled> </div>
                                <div class="form-group"> <label for="cardNumber">
                                <h6> &nbsp;  &nbsp;  &nbsp;ACCOUNT NUMBER</h6>
                                    </label>
                                    <div class="input-group"> <input type="text" class="form-control" value="" disabled>
                                        <div class="input-group-append"> </div>
                                    </div>
                                </div>
                             
                                        <div class="form-group"> <label><span class="hidden-xs">
                                          <h6> &nbsp;  &nbsp;  &nbsp;IFSC CODE
                                          </h6>
                                                </span></label>
                                            <div class="input-group"> <input type="text" class="form-control" value="" disabled>  </div>
                                        </div>
                                    
                                    <br>
                                        <div class="form-group mb-4"> 
                                        
                                        <label data-toggle="tooltip" title="ENTER THE BANK NAME">
                                                <h6> &nbsp;  &nbsp;  &nbsp;BANK NAME
                                          </h6>
                                            </label> <input type="text" class="form-control" value="" disabled> </div>
                                   
                              
                                <div class="card-footer"style="background-color:#F5F5F5; ">
                            
                        </div>
                    </div>
                    </form>
                    <div id="upi" class="tab-pane fade pt-3" style="background-color:#F5F5F5; color:black; ">
                        <h6 class="pb-2">UPI ID</h6>
                        <div class="form-group "> 
                            <form method="post">
                            <input class = "form-control" type="text" value="" disabled>   </div>
                        
                        </form>
                        
                    </div>

                    <div id="" class="tab-pane fade pt-3">
                </div>
                </div>
            
            </div>
        </div>
    </div>
  </div>


 <br><br>
</div>';
}
}
echo $output;

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
 



<?php include_once 'footer.php'; ?>