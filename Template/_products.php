<?php
    $item_id = $_GET['item_id']??1;
    $_SESSION["item_id"] = $item_id;
    $userid = $_SESSION["user_id"];

    $dated = date("Y-m-d H:m");
    $con = mysqli_connect("localhost","root","","rentacar");

    $findresult1 = mysqli_query($con, "SELECT * FROM user WHERE user_id= '$userid'");

    if($res = mysqli_fetch_array($findresult1)){
        $id1 = $res['user_id'];
        $fullname = $res['fullname'];
        $email = $res['email'];
    }
    
    $findresult2 = mysqli_query($con, "SELECT * FROM product WHERE item_id= '$item_id'");
    
    if($res = mysqli_fetch_array($findresult2)){
        $id2 = $res['item_id'];
        $seller_id = $res['seller_id'];
        $item_name = $res['item_name'];
        $item_image = $res['item_image'];   
    }
    
    $get_rating = mysqli_query($con, "SELECT * FROM rating WHERE item_id= '$item_id'");
    $rating = mysqli_num_rows($get_rating);
    
    $rate5 = mysqli_query($con, "SELECT * FROM rating WHERE item_id= '$item_id' AND user_rating = 5");
    $r5 = mysqli_num_rows($rate5);
    
    $rate4 = mysqli_query($con, "SELECT * FROM rating WHERE item_id= '$item_id' AND user_rating = 4");
    $r4 = mysqli_num_rows($rate4);
    
    $rate3 = mysqli_query($con, "SELECT * FROM rating WHERE item_id= '$item_id' AND user_rating = 3");
    $r3 = mysqli_num_rows($rate3);
    
    $rate2 = mysqli_query($con, "SELECT * FROM rating WHERE item_id= '$item_id' AND user_rating = 2");
    $r2 = mysqli_num_rows($rate2);
    
    $rate1 = mysqli_query($con, "SELECT * FROM rating WHERE item_id= '$item_id' AND user_rating = 1");
    $r1 = mysqli_num_rows($rate1);
    
    if($rating!=0){
        $total=( $r5 + $r4 + $r3 + $r2 + $r1);
        $ave = round((5* $r5 + 4*$r4 + 3*$r3 + 2*$r2 + 1*$r1) / ($total)); 
    } else{
        $ave = 0;
    }
    
    
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
                        $overall = $_POST["overall"];
                        $driver_stat = $_POST["driver_stat"];
                        // $event = $_SESSION["dateFrom"];
                        // $events = $_SESSION["dateTo"];
                        // $datedDiff =  $dateTo - $dateFrom ;
                        // $days = floor($datedDiff/(60*60*24));
                        // $_SESSION["days_rent"] = $days;
                        // $total = $price * $_SESSION["days_rent"];
                        
                        // $overall = $total;

                       
                        $sql = "SELECT * from reservation where item_id = $item_id AND status ='Pending' AND user_id = $user_id";
                        $sql1 = "SELECT verified from user where user_id = $user_id";
                        $result =$con->query($sql);
                        $result1 =$con->query($sql1);
                        
                       
                        $row = $result->fetch_assoc();
                        $row1 = $result1->fetch_assoc();
                        $verify =  $row1["verified"];
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

<?php
if(isset($_POST['uploadLicense'])){
$folder='../images/shop/';

$file = $_FILES['Front_Photo']['tmp_name'];
$file_name = $_FILES['Front_Photo']['name'];
$file_name_array = explode(".", $file_name); 
    $extension = end($file_name_array);

    $new_image_name ='Front_'.rand() . '.' . $extension;
		if ($_FILES["pic_ID"]["size"] >10000000) {
		$error[] = 'Sorry, your image is too large. Upload less than 10 MB in size .';
		}

        if($file != ""){
			if($extension!= "jpg" && $extension!= "png" && $extension!= "jpeg"
			&& $extension!= "gif" && $extension!= "PNG" && $extension!= "JPG" && $extension!= "GIF" && $extension!= "JPEG"){
				$error[] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed';   
			}
		}

$file1 = $_FILES['Back_Photo']['tmp_name'];
$file_name1 = $_FILES['Back_Photo']['name'];
$file_name_array1 = explode(".", $file_name1); 
    $extension1 = end($file_name_array1);

    $new_image_name1 ='Back_'.rand() . '.' . $extension1;
		if ($_FILES["pic_ID"]["size"] >10000000) {
		$error1[] = 'Sorry, your image is too large. Upload less than 10 MB in size .';
		}

		if($file1 != ""){
			if($extension1!= "jpg" && $extension1!= "png" && $extension1!= "jpeg"
			&& $extension1!= "gif" && $extension1!= "PNG" && $extension1!= "JPG" && $extension1!= "GIF" && $extension1!= "JPEG"){
				$error1[] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed';   
			}
		}

        if(!isset($error)){ 
			if($file!= ""){
			  	$stmt = mysqli_query($con,"SELECT license_front FROM user WHERE user_id='$userid'");
			  	$row = mysqli_fetch_array($stmt); 
			  	$deleteimage=$row['license_front'];
				unlink($folder.$deleteimage);
				move_uploaded_file($file, $folder . $new_image_name); 
				mysqli_query($con,"UPDATE user SET license_front='$new_image_name' WHERE user_id='$userid'");
			}

		if($file1!= ""){
				$stmt1 = mysqli_query($con,"SELECT license_back FROM user WHERE user_id='$userid'");
				$row1 = mysqli_fetch_array($stmt1); 
				$deleteimage=$row1['license_back'];
			  	unlink($folder.$deleteimage);
			  	move_uploaded_file($file1, $folder . $new_image_name1); 
			  	mysqli_query($con,"UPDATE user SET license_back='$new_image_name1' WHERE user_id='$userid'");
		  	}
		  
		
		if(!$error){
			header('Location:../product.php');
		} else {
			header('Location:../product.php?error=Upload Failed');
		}
  
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
                <img style="width:500px; height:auto;" src="../images/cars/<?php echo $item['item_image']; ?>"
                    alt="product" class="img-fluid">

            </div>

            <div class="col-sm-4 pb-5 pt-4 px-3 border rounded-4 shadow">
                <h2 class="font-baloo-bold"><?php echo $item['item_name'] ?? "Unknown"; ?></h2>
                
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <?php echo $value['shopname']  ?? "Brand"; ?>
                </button>

                <a href="Template/_car-rating.php?user_id=<?php echo $userid;?> &item_id=<?php echo $item_id;?>">
                    <!-- <button type="button" class="btn btn-danger" style="float:right;">Rate This Vehicle</button> -->
                    <!-- <button type="button" name="add_review" id="add_reviews" class="btn btn-danger" style="float:right;">Rate</button> -->

                </a>
                <!-- <?php echo $item_id?> -->
                
                <hr class="m-0 my-2">
                <p class="font-baloo font-size-20">Brand: <?php echo $item['item_brand'] ?? "Brand"; ?></p>

                <!-- Product price-->
                <table class="my-3">
                    <tr class="font-rale font-size-16">
                        <td>Seating Capacity: </td>
                        <td class="font-size-20 text-danger">
                            <span><?php echo $item['item_capacity'] ?? 0; ?></span><small
                                class="text-dark font-size-12">&nbsp;&nbsp;</small>
                        </td>
                    </tr>
                    <tr class="font-rale font-size-16">
                        <td>Transmission Type: </td>
                        <td class="font-size-20 text-danger">
                            <span><?php echo $item['item_transmission'] ?? 0; ?></span><small
                                class="text-dark font-size-12">&nbsp;&nbsp;</small>
                        </td>
                    </tr>
                    <tr class="font-rale font-size-16">
                        <td>Deal Price: </td>
                        <td class="font-size-20 text-danger">₱<span><?php echo $item['item_price'] ?? 0; ?></span><small
                                class="text-dark font-size-12">&nbsp;&nbsp;/day</small></td>
                        <input type="hidden" name="price" id="price" value="<?php echo $item['item_price'] ?? 0;?>">
                    </tr>
                    <tr class="font-rale font-size-16">
                        <td>License Plate:</td>
                        <td><span
                                class="font-size-16 text-danger"><?php echo $item['item_license_plate'] ?? 0; ?></span>
                        </td>
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
                        <input type="datetime-local" name="dateFrom" id="dateFrom" min="<?php echo $dated;?>"
                            value="<?php echo $dF ?? $dated;?>">
                    </div>

                    <div class="input-box col-md-4">
                        <span>Return Date</span>
                        <input type="datetime-local" name="dateTo" id="dateTo" min="<?php echo $dated;?>"
                            value="<?php echo $dT ?? $dated;?>">
                    </div>

                    <div class="form-group mt-4 align-self-start">
                        <label for=>With driver?</label>
                        <input type="radio" name="driver_stat" id="driver_stat_yes" value="Yes" /> Yes
                        <input type="radio" name="driver_stat" id="driver_stat_no" value="No" /> No
                    </div>

                    <button id="uploadText"  style="display: none; margin-top: 15px;" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#UploadModal">
                        Upload Photo of Driver's License
                    </button>

                    <p class="text-muted"> Note: Choosing without a driver will require an image of your Driver's
                        License for confirmation. </p>

                    <hr>
                    <!-- </form> -->
                    <!-- REFRESH DIV -->
                    <div class="total">
                        <div class="row">
                            <div class="col-9 " style="padding-right:0px;">
                                <h5 class="font-baloo font-size-25">Total:</h5>
                                <h5 class="font-baloo font-size-25" style="display: inline;">₱</h5>
                                <h5 class="font-baloo font-size-25" name="total_num" id="total_num"
                                    style="display: inline;"><?php echo $total?? 0; ?>.00</h5>
                                
                                <input type="hidden" name="overall" id="overall" value="0" />
                                <!-- <h5 class="font-baloo font-size-25" style="display: inline;">.00</h5> -->
                                <img src="images/loader.gif" id="loading" style="display: none;">
                                <!-- <div class="container ps-2 " style="display: inline;">
                                    <button type="button" id="addBtn" class="btn btn-dark ">
                                        <i class="fa-solid fa-rotate" id="rota_im"></i>
                                    </button>

                                </div> -->

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
                            <p><input type="checkbox" id="terms" autocomplete="off" onchange="activateButton(this)"> I
                                accept the <a class="text-warning" data-bs-toggle="modal" data-bs-target="#TermsModal"
                                    style="cursor: pointer">Terms and Conditions</a></p>

                            <!-- RESERVE BUTTON -->
                            <div class="col-6">
                                <!-- <button type="button" name="conf_button" class="btn btn-danger " data-toggle="modal" data-target="#confirm_modal">Reserve</button> -->
                                <button type="button" name="conf_button" id="reservebutton" class="btn btn-danger"
                                    data-bs-toggle="modal" data-bs-target="#confirm_modal">Reserve</button>
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

                    <div class="modal fade" id="confirm_modal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

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
                                    <button type="submit" name="confirmreserve" id="confirmreserve" class="btn btn-danger">Reserve</button>
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
            <div class="card">
            <!-- <div class="card-header">Sample Product</div> -->
            <div class="card-body">
                <div class="row">

                    <!-- <div class="col-sm-3 mt-2 d-flex align-items-center justify-content-center">
                        <figure style="margin:auto;">
                            <img style="width:150px; height:auto; margin-bottom:10px;" src="../images/cars/<?php echo $item_image; ?>"
                                alt="product" class="img-fluid">
                                
                            <figcaption><p style="text-align:center;font-size:25px;font-weight:bold;"><?php echo $item_name;?><p></figcaption>
                        </figure>
                    </div> -->

                    <div class="col-sm-4 text-center">
                        <h1 class="text-warning mt-4 mb-4">
                            <b id="average_rate"><?php echo $ave;?></b> <b> / 5</b>
                        </h1>
                        <div class="mb-3">
                                <input type = "hidden"name="average_rates" id="average_rates" class="form-control"
                                value="<?php echo $ave;?>">
                            <i class="fas fa-star star-light mr-1 main_star" id = "main_star_1"></i>
                            <i class="fas fa-star star-light mr-1 main_star" id = "main_star_2"></i>
                            <i class="fas fa-star star-light mr-1 main_star" id = "main_star_3"></i>
                            <i class="fas fa-star star-light mr-1 main_star" id = "main_star_4"></i>
                            <i class="fas fa-star star-light mr-1 main_star" id = "main_star_5"></i>
                        </div>
                        <h3><span id="total_review"></h3><h3><?php echo $rating;?></span> Review</h3>
                    </div>
                    <div class="col-sm-4">
                        <p>
                        <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_five_star_review"><?php echo $r5;?></span>)</div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style = "width:<?php echo $r5;?>%" aria-valuenow="0" aria-valuemin="0"
                                aria-valuemax="100" id="five_star_progress"></div>
                        </div>
                        </p>
                        <p>
                        <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_four_star_review"><?php echo $r4;?></span>)</div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style = "width:<?php echo $r4;?>%" aria-valuenow="0" aria-valuemin="0"
                                aria-valuemax="100" id="four_star_progress"></div>
                        </div>
                        </p>
                        <p>
                        <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_three_star_review"><?php echo $r3;?></span>)</div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style = "width:<?php echo $r3;?>%" aria-valuenow="0" aria-valuemin="0"
                                aria-valuemax="100" id="three_star_progress"></div>
                        </div>
                        </p>
                        <p>
                        <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_two_star_review"><?php echo $r2;?></span>)</div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style = "width:<?php echo $r2;?>%" aria-valuenow="0" aria-valuemin="0"
                                aria-valuemax="100" id="two_star_progress"></div>
                        </div>
                        </p>
                        <p>
                        <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>

                        <div class="progress-label-right">(<span id="total_one_star_review"><?php echo $r1;?></span>)</div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style = "width:<?php echo $r1;?>%" aria-valuenow="0" aria-valuemin="0"
                                aria-valuemax="100" id="one_star_progress"></div>
                        </div>
                        </p>
                    </div>
                    <div class="col-sm-4 text-center">
                        <h3 class="mt-4 mb-3">Write Review Here</h3>
                        <button type="button" name="add_review" id="add_review" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#review_modal">Review</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

<div id="review_modal" class="modal fade" tabindex="-1" role="dialog">      
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-titles">Submit Review</h5>
                <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
            </div>
            <form action="#" method="POST" class="row g-3 ">
                <div class="modal-body">
                    <h4 class="text-center mt-2 mb-4">
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                    </h4>

                    <div class="form-group">a
                        <input name="user_id" id="user_id" class="form-control" value="<?php echo $userid; ?>"
                            readonly>
                    </div>

                    <div class="form-group">b
                        <input  name="item_id" id="item_id" class="form-control" value="<?php echo $item_id; ?>"
                            readonly>
                    </div>

                    <div class="form-group">c
                        <input  name="seller_id" id="seller_id" class="form-control"
                            value="<?php echo $seller_id; ?>" readonly>
                    </div>

                    <div class="form-group">d
                        <input type="text" name="user_name" id="user_name" class="form-control"
                            value="<?php echo $fullname; ?>" readonly>
                    </div>

                    <div class="form-group">e
                        <input type="text" name="car_name" id="car_name" class="form-control"
                            value="<?php echo $item_name; ?>" readonly>
                    </div>

                    <div class="form-group">
                        <textarea name="user_review" id="user_review" class="form-control"
                            placeholder="Type Review Here"></textarea>
                    </div>

                    <div class="form-group text-center mt-4">
                        <button type="button" class="btn btn-primary" id="save_review">Submit</button>
                    </div>
                </div>
            </form>
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
                                <td class="font-size-20 text-dark">
                                    <span><?php echo $value['shopname'] ?? 0; ?></span><small
                                        class="text-dark font-size-12">&nbsp;&nbsp;</small>
                                </td>
                            </tr>
                            <tr class="font-rale font-size-16">
                                <td>Email: </td>
                                <td class="font-size-20 text-dark">
                                    <span><?php echo $value['email'] ?? 0; ?></span><small
                                        class="text-dark font-size-12">&nbsp;&nbsp;</small>
                                </td>
                            </tr>
                            <tr class="font-rale font-size-16">
                                <td>Contact Number: </td>
                                <td class="font-size-20 text-dark">
                                    <span><?php echo $value['contact_num'] ?? 0; ?></span><small
                                        class="text-dark font-size-12">&nbsp;&nbsp;</small>
                                </td>
                            </tr>
                            <tr class="font-rale font-size-16">
                                <td>Address:</td>
                                <td class="font-size-20 text-dark"><span><?php echo $value['address'] ?? 0; ?></span>
                                </td>
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

    <div class="modal mt-5 fade" id="UploadModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Front and Back Photo of Your Driver's License</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    <div class="container ">
                        
                    <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group col-6 mt-3">
                        <label for="Front_Photo" style="font-size:17px; font-weight:400; width:200%;">Front Photo of Driver's License</label><br>
                        <input class="form-control" type="file" name="Front_Photo" id="Front_Photo" style="width:200%;" >
        			</div>
						
                    <div class="form-group col-6 mt-3">
                        <label for="Back_Photo" style="font-size:17px; font-weight:400; width:200%;">Back Photo of Driver's License</label><br>
                        <input class="form-control" type="file" name="Back_Photo" id="Back_Photo" style="width:200%;" >
                    </div>
						
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="uploadLicense" class="btn btn-success">Upload</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
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

                            5. Upon reservation, we will require a deposit of P2,500.00. This will be given back to the
                            customer upon returning the car and found with no damages or deductions from other fees.

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
    <style>
    .progress-label-left {
        float: left;
        margin-right: 0.5em;
        line-height: 1em;
    }

    .progress-label-right {
        float: right;
        margin-left: 0.3em;
        line-height: 1em;
    }

    .star-light {
        color: #e9ecef;
    }
    </style>

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
    $(document).ready(function() {

        // alert("hi");
        

        var average_rate = parseInt(document.getElementById("average_rates").value)  ;
        var average = Number(average_rate);
        document.getElementById("average_rate").innerHTML = average_rate;
        average_rating();
        function average_rating() {
            for (var count = 1; count <= average_rate; count++) {

                $('#main_star_' + count).addClass('text-warning');
                $('#main_star_' + count).removeClass('star-light');
            }
        }
       
        document.getElementById("dateFrom").addEventListener("change", calculatePrice);
        document.getElementById("dateTo").addEventListener("change", calculatePrice);


        function calculatePrice() {
            const pickupDate = new Date(document.getElementById("dateFrom").value);
            const returnDate = new Date(document.getElementById("dateTo").value);
            
            if (pickupDate < returnDate) {
                const price = calculatePriceBasedOnDates(pickupDate, returnDate);
                document.getElementById("total_num").innerHTML = `${price.toFixed(2)}`;
                document.getElementById("overall").value = `${price.toFixed(2)}`;
            } else {
                alert("Return date must be after pick-up date.");
            }
        }

        function calculatePriceBasedOnDates(pickupDate, returnDate) {
            // Calculate price based on your business logic here
            // For example, you can calculate the price based on the number of days
            // or hours between pickupDate and returnDate.
            var price = parseInt(document.getElementById("price").value);
            const timeDiff = returnDate - pickupDate; // Difference in milliseconds
            const hoursDiff = timeDiff / (1000 * 60 * 60); // Difference in hours
            const pricePerHour = price / 24; // Change this to your pricing per hour
            return hoursDiff * pricePerHour;
        }

        $('.conf_button').click(function(e) {
            $('#confirm_modal').modal('show');
        });
        
        $('#add_review').click(function() {
            $('#review_modal').modal('show');
        });
        
        $('#save_review').click(function() {

            var user_id1= document.getElementById("user_id");
            var item_id1= document.getElementById("item_id");
            var seller_id1= document.getElementById("seller_id");
            var car_name1= document.getElementById("car_name");
            var user_name1= document.getElementById("user_name");
            var user_review1= document.getElementById("user_review");

            // var user_id1 = $('#user_id').val();

            // var item_id1 = $('#item_id').val();

            // var seller_id1 = $('#seller_id').val();

            // var car_name1 = $('#car_name').val();

            // var user_name1 = $('#user_name').val();

            // var user_review1 = $('#user_review').val();

            if (user_review == '') {
                alert("Please Write Your Review");
                myGeeks();
                return false;
            } else {
                $.ajax({
                    type: 'POST',
                    url: '../Template/submit_rating.php',
                    data: {
                        rating_data: rating_data,
                        user_id:$(user_id1).val(),
                        item_id:$(item_id1).val(),
                        seller_id:$(seller_id1).val(),
                        car_name:$(car_name1).val(),
                        user_name:$(user_name1).val(),
                        user_review:$(user_review1).val(),
                        
                        
                        // item_id: item_id,
                        // seller_id: seller_id,
                        // car_name: car_name,
                        // user_name: user_name,
                        // user_review: user_review,
                    },
                    success: function(data) {
                        $('#review_modal').modal('hide');

                        location.reload();
                        load_rating_data();

                        alert(data);
                    }
                })
            }

            });

        

        $(document).on('mouseenter', '.submit_star', function() {

            var rating = $(this).data('rating');

            reset_background();

            for (var count = 1; count <= rating; count++) {

                $('#submit_star_' + count).addClass('text-warning');

            }

        });

        
           

        function reset_background() {
            for (var count = 1; count <= 5; count++) {

                $('#submit_star_' + count).addClass('star-light');

                $('#submit_star_' + count).removeClass('text-warning');

            }
        }

        $(document).on('mouseleave', '.submit_star', function() {

            reset_background();

            for (var count = 1; count <= rating_data; count++) {

                $('#submit_star_' + count).removeClass('star-light');

                $('#submit_star_' + count).addClass('text-warning');
            }
            $( "modal-titles", this ).text( rating_data );
        });

        $(document).on('click', '.submit_star', function() {

            rating_data = $(this).data('rating');

        });

        
        // load_rating_data();

        // function load_rating_data() {
        //     $.ajax({
        //         url: "../submit_rating.php",
        //         method: "POST",
        //         data: {
        //             action: 'load_data'
        //         },
        //         dataType: "JSON",
        //         success: function(data) {
        //             $('#average_rating').text(data.average_rating);
        //             $('#total_review').text(data.total_review);

        //             var count_star = 0;

        //             $('.main_star').each(function() {
        //                 count_star++;
        //                 if (Math.ceil(data.average_rating) >= count_star) {
        //                     $(this).addClass('text-warning');
        //                     $(this).addClass('star-light');
        //                 }
        //             });

        //             $('#total_five_star_review').text(data.five_star_review);

        //             $('#total_four_star_review').text(data.four_star_review);

        //             $('#total_three_star_review').text(data.three_star_review);

        //             $('#total_two_star_review').text(data.two_star_review);

        //             $('#total_one_star_review').text(data.one_star_review);

        //             $('#five_star_progress').css('width', (data.five_star_review / data.total_review) *
        //                 100 + '%');

        //             $('#four_star_progress').css('width', (data.four_star_review / data.total_review) *
        //                 100 + '%');

        //             $('#three_star_progress').css('width', (data.three_star_review / data
        //                 .total_review) * 100 + '%');

        //             $('#two_star_progress').css('width', (data.two_star_review / data.total_review) *
        //                 100 + '%');

        //             $('#one_star_progress').css('width', (data.one_star_review / data.total_review) *
        //                 100 + '%');

        //             if (data.review_data.length > 0) {
        //                 var html = '';

        //                 for (var count = 0; count < data.review_data.length; count++) {
        //                     html += '<div class="row mb-3">';

        //                     html +=
        //                         '<div class="col-sm-1"><div class="rounded-circle bg-danger text-white pt-2 pb-2"><h3 class="text-center">' +
        //                         data.review_data[count].user_name.charAt(0) + '</h3></div></div>';

        //                     html += '<div class="col-sm-11">';

        //                     html += '<div class="card">';

        //                     html += '<div class="card-header"><b>' + data.review_data[count].user_name +
        //                         '</b></div>';

        //                     html += '<div class="card-body">';

        //                     for (var star = 1; star <= 5; star++) {
        //                         var class_name = '';

        //                         if (data.review_data[count].rating >= star) {
        //                             class_name = 'text-warning';
        //                         } else {
        //                             class_name = 'star-light';
        //                         }

        //                         html += '<i class="fas fa-star ' + class_name + ' mr-1"></i>';
        //                     }

        //                     html += '<br />';

        //                     html += data.review_data[count].user_review;

        //                     html += '</div>';

        //                     html += '<div class="card-footer text-right">On ' + data.review_data[count]
        //                         .datetime + '</div>';

        //                     html += '</div>';

        //                     html += '</div>';

        //                     html += '</div>';
        //                 }

        //                 $('#review_content').html(html);
        //             }
        //         }
        //     })
        // }
    });
    </script>

<script>
    var uploadText = document.getElementById("uploadText");
    var yesRadioButton = document.getElementById("driver_stat_yes");
    var noRadioButton = document.getElementById("driver_stat_no");

    function toggleUploadText() {
        if (noRadioButton.checked) {
            uploadText.style.display = "block";
        } else {
            uploadText.style.display = "none";
        }
    }

    yesRadioButton.addEventListener("change", toggleUploadText);
    noRadioButton.addEventListener("change", toggleUploadText);

    // Check the initial state when the page loads
    toggleUploadText();
</script>

<script>
    document.getElementById("Front_Photo").value = fileName;
    document.getElementById("Back_Photo").value = fileName;
</script>

    <script src="index.js"></script>

</section>
<?php
        endif;
        endforeach;
    endforeach;

    
?>