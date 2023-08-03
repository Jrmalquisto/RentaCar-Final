<?php
    $item_id = $_GET['item_id']??1;
    $_SESSION["item_id"] = $item_id;
    $userid = $_SESSION["user_id"];
    $dated = date("Y-m-d H:m");
    $con = mysqli_connect("localhost","root","","rentacar");
   
    if(!isset($_SESSION["dateFrom"],$_SESSION["dateTo"])){
        $date = date("Y-m-d H:m");
        $date= strtotime($date);
        $dateFro = isset($_SESSION["dateFrom"]) ? $_SESSION["dateFrom"]: $date;
        $dateT = isset($_SESSION["dateTo"]) ? $_SESSION["dateTo"]: $date;
        if(isset($_POST['submit'])){
            
                
                $dF = date('Y-m-d H:m', strtotime($_POST['dateFrom']));
                
                $dT = date('Y-m-d H:m', strtotime($_POST['dateTo']));
                
                $_SESSION["dateFrom"]=$dF;
                $_SESSION["dateTo"]=$dT;
                $dateFro = strtotime($dF);
                $dateT= strtotime($dT);
                $dateFro = isset($_SESSION["dateFrom"]) ? $_SESSION["dateFrom"]: $dated;
                $dateT = isset($_SESSION["dateTo"]) ? $_SESSION["dateTo"]: $dated;
                $dateFrom = strtotime($dF);
                $dateTo= strtotime($dT);
                
                $datedDiff =  $dateFrom-$dateTo;
                
                $days = floor($datedDiff/(60*60*24));
    
                $_SESSION["days_rent"] = $days;
        }
        
        
    } else {
        
        $dated = date("Y-m-d H:m");
        $dF = isset($_SESSION["dateFrom"]) ? $_SESSION["dateFrom"]: $dated;
        $dT = isset($_SESSION["dateTo"]) ? $_SESSION["dateTo"]: $dated;

        
        $dateFro = strtotime($dF);
        $dateT= strtotime($dT);
        $_SESSION["dateFro"] = $dateFro;
        $_SESSION["dateT"] = $dateT;

        
        if(isset($_POST['submit'])){
            $dateFrom = date('Y-m-d H:m', strtotime($_POST['dateFrom']));
            
            $dateTo = date('Y-m-d H:m', strtotime($_POST['dateTo']));
            
            if(!(trim($dateFrom) == trim($dF))){
                
                
                $_SESSION["dateFrom"]=$dateFrom;
                
        
            } else if(!($dateTo == $dT)){
                
                $_SESSION["dateTo"]=$dateTo;
            }
        }
        
        // $datedDiff =  $dateTo - $dateFrom ;
        
        // $days = floor($datedDiff/(60*60*24));

        // $_SESSION["days_rent"] = $days;
        
    }

    
    // $datet = strtolower($datet);
    // $datet = str_replace(" ", "-", $datet);


    //----------------GET VALUE OF ITEM
    $countedSeller = $product->getSellerCount();
    $stateRefresh = 0;
    //$_SESSION['state'] = $stateRefresh;

   //----------------GET DETAILS OF ITEM (calling functions.php>>database>>Product)
    foreach ($countedSeller as $value):
        foreach ($product->getProdCount($value['seller_id']) as $item):
            if ($item['item_id'] == $item_id):
                $_SESSION["item_n"] = $item['item_name'];
                $_SESSION["item_p"] = $item['item_price'];
                $_SESSION["item_l"] = $item['item_license_plate'];
                $dF = isset($_SESSION["dateFrom"]) ? $_SESSION["dateFrom"]: $dated;
                $dT = isset($_SESSION["dateTo"]) ? $_SESSION["dateTo"]: $dated;
 
                $dateFro = strtotime($dF);
                $dateT= strtotime($dT);

                $price = $_SESSION["item_p"] ?? 0;
                $datedDiff =  $dateFro - $dateT;
                $days = floor($datedDiff/(60*60*24));
                $_SESSION["days_rent"] = $days;
                $total = ($price * $days)*-1;

                
                
                
                

                // request method post
                
                    if (isset($_POST['_products_submit'])){
                        // call method addToCart
                        $Cart->addToCart($userid, $_POST['item_id']);
                    }

                    // if (isset($_POST['refresh'])){
                        
                    //     $dF = date('Y-m-d H:m', strtotime($_POST['dateFrom']));
                        
                    
                    //     $dT = date('Y-m-d H:m', strtotime($_POST['dateTo']));
                        
                    //     $_SESSION["dateFrom"]=$dF;
                    //     $_SESSION["dateTo"]=$dT;
                    //     header("Refresh:0");
                    //     $stateRefresh = 1;
                    //     $_SESSION['state'] = $stateRefresh; 
                    // }

                    
                    if (isset($_POST['confirmreserve'])){
                        $item_id= $_SESSION["item_id"];

                        // if($_SESSION['state'] == 0 && $stateRefresh == 0){
                        //     header('Location: ../product.php?item_id=' .$item_id. '&&error=Please press the refresh button before proceeding.');
                        //     // $stateRefresh = 1;
                        //     // $_SESSION['state'] = $stateRefresh; 
                        // } else {

                        

                        $dated = date("Y-m-d H:m");
                        $user_id = $_SESSION["user_id"];
                        $user_n = $_SESSION["user_name"];
                        // $car = $_SESSION["car_id"];
                        $contact = $_SESSION["cont_num"];
                        
                        $vehicle = $_SESSION["item_n"];
                        $license = $_SESSION["item_l"];
                        $seller = $value["seller_id"];
                        $event = $_POST['dateFrom'];
                        $events = $_POST["dateTo"];
                        $overall = $_SESSION["total_amount"];
                        $driver_stat = $_POST["driver_stat"];
                        // $event = $_SESSION["dateFrom"];
                        // $events = $_SESSION["dateTo"];
                        // $datedDiff =  $dateTo - $dateFrom ;
                        // $days = floor($datedDiff/(60*60*24));
                        // $_SESSION["days_rent"] = $days;
                        // $total = $price * $_SESSION["days_rent"];
                        
                        // $overall = $total;

                       
                        $sql = "SELECT * from reservation where item_id = $item_id AND status ='Pending' AND user_id = $user_id";
                        $result =$con->query($sql);

                        
                       
                        $row = $result->fetch_assoc();
                        $product=$row["item_id"];
                        
                            if(!$product==$item_id){
                                echo $product;
                                $query = "INSERT INTO reservation (user_id,item_id,seller_id,user_name,number,brand,license_plate,pickupdate,returndate,driver_stat,overall_price,status) VALUES ('$user_id','$item_id','$seller','$user_n','$contact','$vehicle','$license','$event','$events','$driver_stat','$overall','Pending')";
                        
                        
                                if (trim($_POST['dateTo'] ) == $dated){
                                    header('Location: ../product.php?item_id=' .$item_id. '&&error=Pick-up Date and Return Date not yet set.1');
                                    exit();
        
                                }  else if(trim($_POST['dateTo'] ) == "0000-00-00" && trim($_POST['dateFrom'] ) == "0000-00-00"){
                                    header('Location: ../product.php?item_id=' .$item_id. '&&error=Pick-up Date and Return Date not yet set.2');
                                    exit();
                                } else if(trim($_POST['dateTo'] ) ==  trim($_POST['dateFrom'])){
                                    header('Location: ../product.php?item_id=' .$item_id. '&&error=Pick-up Date and Return Date not yet set.3');
                                    exit();
                                } else if(empty($_POST["driver_stat"])){
                                    header('Location: ../product.php?item_id=' .$item_id. '&&error=Please pick your driver status.');
                                    exit();
        
                                } else {
        
                                    $queryupdate = "UPDATE product SET status = 0 WHERE item_id = $item_id";
                                    // $queryupdate = "UPDATE product SET status = 1 WHERE item_id = $item_id";
                                    $query_run1 = mysqli_query($con, $queryupdate);
        
                                    $query_run = mysqli_query($con, $query);
                                    header("location: userreservation.php");
                                    $stateRefresh = 0;
                                    $_SESSION['state'] = $stateRefresh;
                                
                                    // if($query){
                                    //     header("location: in_use.php");
                                    // }
                                    // else {
                                    //     header("location: in_use.php");
                                    // }
                                } 

                            } else {
                                    // echo "<script>alert(\"You cannot reserve this Item\");";
                                    header('Location: ../product.php?item_id=' .$item_id. '&&error=You have already made a reservation.');
                                    exit();
                            }
                            
                        
                
            }
    
?>
<section id="product" class="py-3" onload="disableSubmit()">
    <div class="container ">
        <div class="row">

            <!-- <h5 class="font-baloo font-size-25"><?php echo $_SESSION["dateFrom"]?? "Unknown"; ?></h5>
            <h5 class="font-baloo font-size-25"><?php echo $_SESSION["dateTo"]?? "Unknown"; ?></h5> -->
            <!-- <h5 class="font-baloo font-size-25"><?php echo $datedDiff ?? "Unknown"; ?></h5> -->
            <!-- <h5 class="font-baloo font-size-25"><?php echo $_SESSION["item_b"] ?? "Unknown"; ?></h5> -->
            <div class="col-sm-8 d-flex align-items-center justify-content-center">
                <img style="width:500px; height:auto;" src="../images/cars/<?php echo $item['item_image']; ?>" alt="product" class="img-fluid">
                
            </div>
            
            <div class="col-sm-4 pb-5 pt-4 px-3 border rounded-4 shadow">
                <h2 class="font-baloo-bold  "><?php echo $item['item_name'] ?? "Unknown"; ?></h2>
                <!-- <a class="font-baloo font-size-20 " href="vehicles.php"> <?php echo $value['shopname']  ?? "Brand"; ?></a> -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <?php echo $value['shopname']  ?? "Brand"; ?>
                </button>
                
                
                <hr class="m-0 my-2">
                <p class="font-baloo font-size-20">Brand: <?php echo $item['item_brand'] ?? "Brand"; ?></p>
                
                <!-- Product price-->
                <table class="my-3">
                <tr class="font-rale font-size-16">
                        <td>Seating Capacity: </td>
                        <td class="font-size-20 text-danger"><span><?php echo $item['item_capacity'] ?? 0; ?></span><small class="text-dark font-size-12">&nbsp;&nbsp;</small></td>
                    </tr>
                    <tr class="font-rale font-size-16">
                        <td>Transmission Type: </td>
                        <td class="font-size-20 text-danger"><span><?php echo $item['item_transmission'] ?? 0; ?></span><small class="text-dark font-size-12">&nbsp;&nbsp;</small></td>
                    </tr>
                    <tr class="font-rale font-size-16">
                        <td>Deal Price: </td>
                        <td class="font-size-20 text-danger">₱<span><?php echo $item['item_price'] ?? 0; ?></span><small class="text-dark font-size-12">&nbsp;&nbsp;/day</small></td>
                        <input type="hidden" name="price" id="price" value="<?php echo $item['item_price'] ?? 0;?>">
                    </tr>
                    <tr class="font-rale font-size-16">
                        <td>Units Available:</td>
                        <td><span class="font-size-16 text-danger"><?php echo $item['item_stock'] ?? 0; ?></span></td>
                    </tr>
                    <tr class="font-rale font-size-16">
                        <td>License Plate:</td>
                        <td><span class="font-size-16 text-danger"><?php echo $item['item_license_plate'] ?? 0; ?></span></td>
                    </tr>
                    <tr class="font-rale font-size-16">
                        <td>Color:</td>
                        <td><span class="font-size-16 text-danger"><?php echo $item['item_color'] ?? 0; ?></span></td>
                    </tr>
                </table>
                <!-- !Product price-->

                <!-- #Policy-->
                
                <!-- !#Policy-->
                <hr>

                <!-- Order Details -->
                <!--<div id="order-details" class="font-rale d-flex flex-column text-dark">
                    
                    <small><i class="fas fa-map-marker-alt color-primary"></i>&nbsp;&nbsp;Deliver to Customer - 424201</small>
                </div>
                -->
               
                <!-- FORM DIV -->
                <form action="#" method="POST" class="row g-3 "> 
                   
                    <!-- <div class="input-box">
                        <span>Pick-up Date</span>
                        <input type="date" name="dateFrom" id="dateFrom" value="<?php echo $dF ?? $dated;?>">
                    </div> -->
                    <!-- <input type="hidden" name="item_n" id="item_n" value="<?php echo $item['item_id'] ?? 0;?>"> -->
                    <!-- <?php echo $item['item_id'] ?? 0;?> -->
                    <div class="input-box col-md-4">
                        <span>Pick-up Date</span>
                        <input type="datetime-local" name="dateFrom" id="dateFrom" min="<?php echo $dated;?>" value="<?php echo $dF ?? $dated;?>">
                    </div>

                    <div class="input-box col-md-4">
                        <span>Return Date</span>
                        <input type="datetime-local" name="dateTo" id="dateTo"  min="<?php echo $dated;?>" value="<?php echo $dT ?? $dated;?>">
                    </div>

                    <div class="form-group mt-4 align-self-start">
                        <label for=>With driver?</label>
                        <input type="radio" name="driver_stat" id="driver_stat" value="Yes" /> Yes
                        <input type="radio" name="driver_stat" id="driver_stat" value="No" /> No
                    </div>
                    <p class = "text-muted"> Note: Choosing without a driver will require an image of your Driver's License for confirmation. </p>
              
                    <hr>
                <!-- </form> -->
                    <!-- REFRESH DIV -->
                    <div class="total">
                        <div class="row">
                            <div class="col-9 " style="padding-right:0px;">
                                <h5 class="font-baloo font-size-25">Total:</h5> 
                                <h5 class="font-baloo font-size-25" style="display: inline;">₱</h5>
                                <h5 class="font-baloo font-size-25" name="total_num" id="total_num" style="display: inline;"><?php echo $total?? "Unknown"; ?></h5>
                                    <input type="hidden" name="overall" id="overall" value="<?php echo $total ?? "Unknown";?> .00">
                                <h5 class="font-baloo font-size-25" style="display: inline;">.00</h5>
                                <img src="images/loader.gif" id="loading" style="display: none;">
                                <div class="container ps-2 "  style="display: inline;">
                                    <button type="button" id="addBtn" class="btn btn-dark ">
                                        <i class="fa-solid fa-rotate" id="rota_im"></i>    
                                    </button>

                                </div>
                               
                            </div>
                            <!-- REFRESH BUTTON -->
                            <div class="col-6 " style="padding-left:0px;">
                                <!-- <button  class="btn btn-success" type="button" name="output" id="output">
                                    
                                    <i class="fa-solid fa-rotate"></i>
                                    
                                </button> -->
                              
                            </div>
                            
                        </div>
                    </div>
                    

                    <?php if (isset($_GET['error'])) {             ?>
                            <p class="error"> <?php echo $_GET['error']; ?> </p>

                    <?php }?>
                    <!-- <?php 
                    $signupCheck = $_GET['error'];
                    if ($signupCheck == 'fnameerr') {             ?>
                            <p class="error"> <?php echo $_GET['error']; ?> </p>

                    <?php }?> -->
                <!-- <form action="#" method="POST" > -->
                    <!-- TERMS AND RESERVE DIV -->
                    <div class="container pt-3 font-size-16 font-baloo">
                        <div class="row">
                            <p><input type="checkbox"  id="terms"  autocomplete="off" onchange="activateButton(this)"> I accept the <a class = "text-warning" data-bs-toggle="modal" data-bs-target="#TermsModal" style="cursor: pointer">Terms and Conditions</a></p>
                           
                            <!-- RESERVE BUTTON -->
                            <div class="col-6">
                                <!-- <button type="button" name="conf_button" class="btn btn-danger " data-toggle="modal" data-target="#confirm_modal">Reserve</button> -->
                                <button type="button" name="conf_button" id="reservebutton" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirm_modal" >Reserve</button>
                            </div>
                            
                
                <!-- <button  type="button" name="conf_button" id="reservebutton" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirm_modal" >Reserve</button> -->
                            <!-- For Wishlist -->
                            <!-- <div class="col-6">
                                <form method="post">
                                    <input type="hidden" name="item_id" value="<?php echo $item['item_id'] ?? '2'; ?>">
                                    <input type="hidden" name="user_id" value="<?php echo $userid ?? '2'; ?>">
                                    <?php
                                    if (in_array($item['item_id'], $Cart->getCartId($product->getData('cart')) ?? [])){
                                        echo '<button type="submit" disabled class="btn btn-success">Added to Wishlist</button>';
                                    }else{
                                        echo '<button type="submit" name="_products_submit" class="btn btn-warning ">Add to Wishlist</button>';
                                    }
                                    ?>
                                </form>
                        </div> -->
                        </div>
                    </div>
                
                <div class="modal fade" id="confirm_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h5>Confirm Reservation</h5>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="confirmreserve" id="confirmreserve" class="btn btn-danger" >Reserve</button>
                                </div>
                            </div>
                        
                    </div>
                </div>

                <!-- Disable Submit Button -->
                                  
                </form>
                <!-- !size -->

            </div>
            <div class="col-12">
                <h6 class="font-rubik font-size-20">Vehicle Description</h6>
                <hr>
                <!--<p class="font-rale font-size-16">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellat inventore vero numquam error est ipsa, consequuntur temporibus debitis nobis sit, delectus officia ducimus dolorum sed corrupti. Sapiente optio sunt provident, accusantium eligendi eius reiciendis animi? Laboriosam, optio qui? Numquam, quo fuga. Maiores minus, accusantium velit numquam a aliquam vitae vel?</p>
                <p class="font-rale font-size-16">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellat inventore vero numquam error est ipsa, consequuntur temporibus debitis nobis sit, delectus officia ducimus dolorum sed corrupti. Sapiente optio sunt provident, accusantium eligendi eius reiciendis animi? Laboriosam, optio qui? Numquam, quo fuga. Maiores minus, accusantium velit numquam a aliquam vitae vel?</p>-->
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Shop Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container ">
                    
                    
                    <table class="my-3 d-flex align-items-center justify-content-center">
                        <tr class="font-rale font-size-16">
                                <td>Shop Name: </td>
                                <td class="font-size-20 text-dark"><span><?php echo $value['shopname'] ?? 0; ?></span><small class="text-dark font-size-12">&nbsp;&nbsp;</small></td>
                            </tr>
                            <tr class="font-rale font-size-16">
                                <td>Email: </td>
                                <td class="font-size-20 text-dark"><span><?php echo $value['email'] ?? 0; ?></span><small class="text-dark font-size-12">&nbsp;&nbsp;</small></td>
                            </tr>
                            <tr class="font-rale font-size-16">
                                <td>Contact Number: </td>
                                <td class="font-size-20 text-dark"><span><?php echo $value['contact_num'] ?? 0; ?></span><small class="text-dark font-size-12">&nbsp;&nbsp;</small></td>
                            </tr>
                            <tr class="font-rale font-size-16">
                                <td>Address:</td>
                                <td class="font-size-20 text-dark"><span><?php echo $value['address'] ?? 0; ?></span></td>
                            </tr>
                            
                    </table>
                    
                    
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                
            </div>
            </div>
        </div>
        </div>

        <div class="modal fade" id="TermsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Terms and Condition</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container ">
                        <div class="multiline" style="white-space:pre-wrap;">
1. Reservation of vehicle is not confirmed until shop authorizes the reservation.

2. Vehicle must be picked up at the shop if the reservation is without a driver.

3. Choosing without a driver will require Driver's License for confirmation.

4. Vehicle must not be returned after business hours.

5. Upon reservation, we will require a deposit of P2,500.00. This will be given back to the customer upon returning the car and found with no damages or deductions from other fees.

6. Vehicles not canceled before 24-hours will be charged (P100) per day per vehicle/s.


                        </div>
                        
                        
                       
                        
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    
                </div>
                </div>
            </div>
        </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script type="text/javascript">
        
            // $(document).ready(function(){
            //     $("#dateTo,#dateFrom").keyup(function()){
            //         $price = $_SESSION["item_p"] ?? 0;
            //         $datedDiff =  $dateFro - $dateT;
            //         $days = floor($datedDiff/(60*60*24));
            //         $_SESSION["days_rent"] = $days;
            //         $total = ($price * $days)*-1;
                    
            //         var tot_price = ($price * $days)*-1;
            //         $("#overall").val(total);
            //         var divobj= document.getElementByID('overall');
            //         divobj.value=tot_price;
            //     }
            // });
            
            // $(document).ready(function(){
            //     $('#terms').click(function(event) {
            //     if(this.checked) {
            //         $('.invoiceOption').each(function() {
            //             this.checked = true;
            //         });
            //     } else {
            //         $('.invoiceOption').each(function() {
            //             this.checked = false;
            //         });
            //     }
            // })
            // });
            $(document).ready(function(){
                // alert("hi");
                $('.conf_button').click(function(e){
                    $('#confirm_modal').modal('show');
                });
                // // var data1="<?php echo $_SESSION["item_n"];?>";
                // var data1=document.getElementById("item_n");
                // // document.getElementById("price");
                // var price= document.getElementById("price");
            
                // // var date1 = document.getElementById("driver_stat");
                // // var date2 = document.getElementById("dateTo");
                // // var datee1 = "<?php echo $_SESSION["dateFrom"];?>";
                // // var datee2 = "<?php echo $_SESSION["dateTo"];?>";
                // // var dates = new Date(document.getElementById("dateFrom"));
                // // var getda = dates.getDate();
                // var datee1 = document.getElementById("dateFrom");
                // var date2 = document.getElementById("dateTo");
                // $('#addBtn').click(function(){
                //     $.ajax({
                //         type:'POST',
                //         url:'total.php',
                //         data:{
                //             num1:$(datee1).val(),
                //             num2:$(date2).val(),
                //             // prod_id:$(data1).val(),
                //             price:$(price).val(),
                //         },
                //         success:function(data){
                //             $('#total_num').html(data);
                //         }
                //     })
                // });
            });
            

                       
    </script>
    <script src="index.js"></script>

</section>
<?php
        endif;
        endforeach;
    endforeach;

    
?>