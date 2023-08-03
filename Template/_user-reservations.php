<?php
    $item_id = $_GET['item_id'] ??1;
    $_SESSION["item_id"] = $item_id;
    $userid = $_SESSION["user_id"];
    $dated = date("Y-m-d");
    $con = mysqli_connect("localhost","root","","rentacar");
   
        if(!isset($_SESSION["dateFrom"],$_SESSION["dateTo"])){
            
            if(isset($_POST['submit'])){
                
                    $dF = date('Y m d', strtotime($_POST['dateFrom']));
                    $dF = strtolower($dF);
                    $dF = str_replace(" ", "-", $dF);
                
                    $dT = date('Y m d', strtotime($_POST['dateTo']));
                    $dT = strtolower($dT);
                    $dT = str_replace(" ", "-", $dT);
                
                    $_SESSION["dateFrom"]=$dF;
                    $_SESSION["dateTo"]=$dT;
            
                    $dateFrom = strtotime($dF);
                    $dateTo= strtotime($dT);
                    $datedDiff =  $dateTo - $dateFrom ;
                    
                    $days = floor($datedDiff/(60*60*24));
        
                    $_SESSION["days_rent"] = $days;
            }
            
            
        } else {
            $dF = $_SESSION["dateFrom"];
            $dT = $_SESSION["dateTo"];

           
            $dateFrom = strtotime($dF);
            $dateTo= strtotime($dT);
            $datedDiff =  $dateTo - $dateFrom ;
            
            $days = floor($datedDiff/(60*60*24));

            $_SESSION["days_rent"] = $days;
            
        }
    
        if(isset($_POST['removeRes'])){
            $product = $_POST['removeRes'];
        
            $query = "DELETE FROM reservation WHERE item_id='$product' ";
            $query = mysqli_query($con, $query);

            $queryupdate = "UPDATE product SET status = 0 WHERE item_id = $product";
            $query_run1 = mysqli_query($con, $queryupdate);

        
            if($query_run){
                header("location: userreservation.php");
            }
            else {
                header("location: userreservation.php");
            }
        }
        if(isset($_POST['pay'])){
            
            try{
                
                $product = $_POST['pay'];
                $pending = "Pending";
                $sql = "SELECT * from reservation where item_id = $product AND status ='Pending' AND user_id = $userid";
               
                $result =$con->query($sql);
                $row = $result->fetch_assoc();

              
                
                $item_id=$row["item_id"];
                
                if(!$product==$item_id){
                    $query = "UPDATE reservation SET status='In Use' WHERE item_id='$product' ";
                    $query = mysqli_query($con, $query);
                    $query1 = "UPDATE product SET status= 1 WHERE item_id='$product'";
                    $query1 = mysqli_query($con, $query1);

                    header("location: in_use.php");
                } else {
                    header('Location: ../userreservation.php?&&error=Your reservation has not been approved yet');
                    exit();
                }
            
                // if($query){
                //     header("location: in_use.php");
                // }
                // else {
                //     header("location: in_use.php");
                // }
                
            } catch(PDOException $e){
                echo "Connection failed: " . $e->getMessage();
            }
        }
    
    // $datet = strtolower($datet);
    // $datet = str_replace(" ", "-", $datet);
    
?>
<section class="reserve_sect" class="py-3">
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="font-size-25 mt-5 fw-bold">Your Reservations</h1>
        </div>
        <div class="col-1">
        <a class="btn btn-danger font-size-20 px-4 mt-5" href="profile.php">Back</a>
        </div>
    </div>
</div>
    
   

        <?php
            $countedReserve = $product->getReserveCount();
            foreach ($countedReserve as $value):
                
                foreach ($product->getOnProduct($value['item_id']) as $item):
                    // $in_display = $product->getOnProduct($value['item_id']);
                    foreach ($product->getSeller($item['seller_id']) as $shop ):
                        
                    
                    
        ?>
        <div class="container py-5 my-5 border rounded-4 shadow-lg">
        <div class="row">

            <!-- <h5 class="font-baloo font-size-25"><?php echo $dF?? "Unknown"; ?></h5> -->
            <!-- <h5 class="font-baloo font-size-25"><?php echo $_SESSION["days_rent"] ?? "Unknown"; ?></h5> -->
            <!-- <h5 class="font-baloo font-size-25"><?php echo $_SESSION["item_b"] ?? "Unknown"; ?></h5> -->
            <div class="col-sm-8 d-flex align-items-center justify-content-center">
                <img style="width:500px; height:auto;" src="../images/cars/<?php echo $item['item_image']; ?>" alt="product" class="img-fluid">
                
            </div>
            
            <div class="col-sm-4 pb-5 pt-3 border border-end-0">
                <h5 class="font-baloo font-size-25"><?php echo $item['item_name'] ?? "Unknown"; ?></h5>
                <!-- <a class="font-baloo font-size-20 " href="vehicles.php"> <?php echo $shop['shopname']  ?? "Shop"; ?></a> -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCompany">
                    <?php echo $shop['shopname']  ?? "Shop"; ?>
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
                    </tr>
                    <!-- <tr class="font-rale font-size-16">
                        <td>Units Available:</td>
                        <td><span class="font-size-16 text-danger"><?php echo $item['item_stock'] ?? 0; ?></span></td>
                    </tr> -->
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
                
                
                <form action="#" method="POST" class="row g-3 "> 
                   
                    <!-- <div class="input-box">
                        <span>Pick-up Date</span>
                        <input type="date" name="dateFrom" id="dateFrom" value="<?php echo $dF ?? $dated;?>">
                    </div> -->
                    <div class="input-box">
                        <span>Pickup Date</span>
                        <input type="datetime-local" name="dateFrom" id="dateFrom" value="<?php echo $dF ?? $dated;?>" readonly>
                    </div>

                    <div class="input-box">
                        <span>Return Date</span>
                        <input type="datetime-local" name="dateTo" id="dateTo" value="<?php echo $dT ?? $dated;?>" readonly>
                    </div>
                    
                    <div class="form-group mt-4 align-self-start">
                        <p class = "fw-bold  ml-3"> With Driver: <?php echo $value['driver_stat'] ?? 0; ?></p>

                        <p class = "text-muted"> Note: You can only cancel a reservation within 24 hours. Further cancellation above timeframe will ensue a cancellation fee per vehicle/s. </p>
                        
                        <p class = "fw-bold fs-5" style="display: inline;"> Status:</p>
                        <p class = "status fw-bold text-success text-decoration-underline fs-5" style="display: inline;" name="status">  <?php echo $value['status'] ?? 0; ?></p>
                    </div>
                    <hr>
                    
                    <div class="total">
                        <h5 class = "fw-bold ml-3"> Total: </h5>

                        <h5 class=" text-danger fw-bold inline"> ₱ <?php echo $value['overall_price'] ?? 0; ?>.00</h5>
                         
                       
                        <form action="#" method="POST" class="d-inline">
                            <button type="submit" name="pay"  class="pay btn btn-danger btn-sm mb-2" value="<?=$value['item_id'];?>">Pay</button>
                            <button type="submit" name="removeRes"  class="btn btn-danger btn-sm mb-2" onclick='return checkReserve()' value="<?=$value['item_id'];?>">Cancel</button>
                        </form>
                        <?php 
                            if ($value['driver_stat'] == "Yes" && $value['driver_id'] != 0) {
                            echo '<button type="button" class="btn userinfo btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Driver details
                                </button>';
                            } 
                        ?>
                    </div>
                    

                    <?php if (isset($_GET['error'])) {             ?>
                            <p class="error"> <?php echo $_GET['error']; ?> </p>

                    <?php }?>
                    <!-- <?php 
                    $signupCheck = $_GET['error'];
                    if ($signupCheck == 'fnameerr') {             ?>
                            <p class="error"> <?php echo $_GET['error']; ?> </p>

                    <?php }?> -->

                    
                
                
                <!-- !size -->

            </div>

            
        </div>
        </div>
    <?php
        // }, $product->getProdCount($value['item_id']));
                    
                endforeach;
            endforeach;
        endforeach;

        foreach ($product->getDriver($value['driver_id']??0) as $driver):
            $driverid = $value['driver_id'];
        ?>
        
    
    <!-- Button trigger modal -->
        

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Driver Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container ">
                    <div class = "d-flex align-items-center justify-content-center">
                        
                    <?php
                        $sql1 = "SELECT driver_image from drivers where driver_id='$driverid'";
                        $result1 = mysqli_query($con,$sql1);
                        $row1 = mysqli_fetch_array($result1);

                        $image = $row1['driver_image'];
                        $image_src = "/images/drivers/".$image;
                    ?>

                        <img height="170" width="250" src='<?php echo $image_src;?>'>

                    </div>
                    <hr>
                    <table class="my-3 d-flex align-items-center justify-content-center">
                        <tr class="font-rale font-size-16">
                                <td>Name: </td>
                                <td class="font-size-20 text-dark"><span><?php echo $driver['driver_name'] ?? 0; ?></span><small class="text-dark font-size-12">&nbsp;&nbsp;</small></td>
                            </tr>
                            <tr class="font-rale font-size-16">
                                <td>Age: </td>
                                <td class="font-size-20 text-dark"><span><?php echo $driver['driver_age'] ?? 0; ?></span><small class="text-dark font-size-12">&nbsp;&nbsp;</small></td>
                            </tr>
                            <tr class="font-rale font-size-16">
                                <td>Address: </td>
                                <td class="font-size-20 text-dark"><span><?php echo $driver['driver_address'] ?? 0; ?></span><small class="text-dark font-size-12">&nbsp;&nbsp;</small></td>
                            </tr>
                            <tr class="font-rale font-size-16">
                                <td>Contact Number:</td>
                                <td class="font-size-20 text-dark"><span><?php echo $driver['driver_contact'] ?? 0; ?></span></td>
                            </tr>
                            
                    </table>
                    <div class="d-flex me-auto">
                        <div class="me-auto">
                            <button type="button" class="btn btn-primary">Download</button>
                        </div>
                        
                    </div>
                    
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
        </div>
        
        <!-- Shop Details Modal -->

        <div class="modal fade" id="modalCompany" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
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
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
        </div>
        <script>
        function checkReserve(){
            return confirm('Confirm Deletion');
        }
    </script>
</section>
<script>

    $(document).ready(function(){
           
            $('.conf_button').click(function(e){
                        // $('#editEmployeeModal').modal('show');

                        $tr=$(this).closest('tr');

                        var data = $tr.children("td").map(function(){
                            return $(this).text();
                        }).get();

                        console.log(data);

                        $('#id1').val(data[0]);
                        $('#name1').val(data[1]);
                        $('#number1').val(data[2]);
                        $('#vehicle1').val(data[3]);
                        $('#license1').val(data[4]);
                        $('#pickup1').val(data[5]);
                        $('#return1').val(data[6]);
                        $('#price1').val(data[7]);
                    
                });

            let button= document.querySelector('pay');
            let input= document.querySelector('status');
            if (input==="Pending"){
                button.disabled= true;
            }
        });
</script>
<!----------------------------------------------PRODUCTS-------------------------------------------------------->

<?php
    
endforeach;
    ?>

