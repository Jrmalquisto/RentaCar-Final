<?php
session_start();
$servername = "localhost";
$user = "root";
$password = "";
$database = "rentacar";

$con = new mysqli($servername, $user, $password, $database);

$com_id=$_SESSION["com_id"];

include ('../connection.php');

$findresult = mysqli_query($con, "SELECT * FROM seller WHERE seller_id= '$com_id'");

if($res = mysqli_fetch_array($findresult)){
$image = $res['shop_logo'];
}

$findresult1 = mysqli_query($con, "SELECT * FROM reservation WHERE seller_id= '$com_id'");

if($res1 = mysqli_fetch_array($findresult1)){
$item_id = $res1['item_id'];

}

if(isset($_POST['update_res'])){
	$id = $_POST['id1'];
    $pickup=$_POST['pickup1'];
	$return=$_POST['return1'];
	$price=$_POST['price1'];
	$driver=$_POST['driver1'];

	$result = mysqli_query($con,"UPDATE reservation SET pickupdate='$pickup', returndate='$return', overall_price='$price', driver_id='$driver' WHERE id='$id'");
	
	if($result){
		//$_SESSION['status'] = "Your profile has been updated";
			header("location:/TemplateShop/_manage-reservations-chauffeur2.php?error");
		} else {
			$error[]='Something went wrong';
		}
  
		

}
?>

<?php
if(isset($_POST['removeRes'])){
    $product = $_POST['id2'];

    $query = "DELETE FROM reservation WHERE id='$product' ";
    $query = mysqli_query($con, $query);

	$queryupdate = "UPDATE product SET status = 0 WHERE item_id = $item_id";
	$query_run = mysqli_query($con, $queryupdate);

    if($query_run){
        header("location: _manage-reservations2.php");
    }
    else {
        header("location: _manage-reservations2.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Reservations</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <!----css3---->
    <link rel="stylesheet" href="/css/custom.css">


    <!--google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />


    <!--google material icon-->
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</head>

<body>



<div class="wrapper">
     
	  <div class="body-overlay"></div>
	 
	 <!-------sidebar--design------------>
	 
	 <?php 
	 	include ('../TemplateShop/_company-sidebar.php');
	 ?>
	 
   <!-------sidebar--design- close----------->
   
   
   
      <!-------page-content start----------->
   
    
	     
		  <!------top-navbar-start-----------> 
		     
		<?php 
			include ('../TemplateShop/_company-header.php');
		?>
		  <!------top-navbar-end-----------> 



        <!------main-content-start----------->
        <div class="main-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-wrapper">

                        <div class="table-title">
                            <div class="row">
                                <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
                                    <h2 class="ml-lg-2">Manage Reservations</h2>
                                </div>
                                <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
                                    <a href="_manage-reservations2.php" class="btn btn-success">
                                        <i class="material-icons">&#xF217;</i>
                                        <span>Reservations without Driver</span>
                                    </a>
                                    <!--<a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal">
					<i class="material-icons">&#xE15C;</i>
					<span>Delete</span>
					</a>-->
                                </div>
                            </div>
                        </div>

                        <table class="table table-striped table-hover" id="myTable">
                            <thead>

                                <!--<th><span class="custom-checkbox">
						<input type="checkbox" id="selectAll">
						<label for="selectAll"></label></th>-->
                                <th scope="col" width="50">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Contact Number</th>
                                <th scope="col">Vehicle</th>
                                <th scope="col">License Plate</th>
                                <th scope="col">Pick-up Date</th>
                                <th scope="col">Reutrn Date</th>
								<th scope="col">Daily Rate</th>
                                <th scope="col">Total Amount</th>
                                <th scope="col">Driver</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                <!--<th><span class="custom-checkbox">
							 <input type="checkbox" id="checkbox1" name="option[]" value="1">
							 <label for="checkbox1"></label></th>-->

                                <?php
                            $servername = "localhost";
                            $user = "root";
                            $password = "";
                            $database = "rentacar";

                            $connection = new mysqli($servername, $user, $password, $database);

                            if ($connection->connect_error){
                                die("Connection Failed: " . $connection->connect_error);
                            }
                            $com_id = $_SESSION['com_id'];
                            // echo $com_id;
                            $sql = "SELECT * FROM reservation WHERE driver_stat='YES' AND status='Reserved' AND seller_id = {$com_id}";
                            $result =$connection->query($sql);

                            if (!$result){
                                die("Invalid Query: " . $connection->error);
                            }

                            while($row = $result->fetch_assoc()) {
                                $id = $row["id"];
                                $name = $row["user_name"];
                                $number = $row["number"];
                                $vehicle = $row["brand"];
								$license = $row["license_plate"];
                                $pickup = $row["pickupdate"];
                                $return = $row["returndate"];
								$driver = $row["driver_id"];
                                $price = $row["overall_price"];
                                $status = $row["status"];

							$sql1 = "SELECT * FROM product WHERE seller_id = {$com_id}";
							$result1 =$connection->query($sql1);

								if (!$result1){
									die("Invalid Query: " . $connection->error);
								}
	
								while($row1 = $result1->fetch_assoc()) {
									$price1 = $row1["item_price"];
								}
							?>
                            ?>

                                <tr>

                                    <td><?php echo $id?></td>
                                    <td><?php echo $name?></td>
                                    <td><?php echo $number?></td>
                                    <td><?php echo $vehicle?></td>
                                    <td><?php echo $license?></td>
                                    <td><?php echo $pickup?></td>
                                    <td><?php echo $return?></td>
									<td><?php echo $price1?></td>
                                    <td><?php echo $price?>.00</td>
                                    <td><?php echo $driver?></td>
                                    <td><?php echo $status?></td>
                                    <td>
                                        <div class="row justify-content-center">
                                            <form action="_manage-reservations2.php" class="d-inline">
                                                <button type="button" name="conf_button" id="conf_button"
                                                    class="btn btn-success conf_button mr-2" data-toggle="modal"
                                                    data-target="#editReservationModal">
                                                    <i class="material-icons" data-toggle="tooltip"
                                                        title="Edit">&#xE254;</i>
                                                </button>
                                            </form>

                                            <form action="_manage-reservations2.php" class="d-inline">
                                                <button type="button" name="del_button" id="del_button"
                                                    class="btn btn-danger del_button btn-sm" data-toggle="modal"
                                                    data-target="#deleteReservationModal">
                                                    <i class="material-icons" data-toggle="tooltip"
                                                        title="Edit">&#xE872;</i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                        ;}
                               
                        ?>

                            </tbody>
                        </table>
                    </div>
                </div>


                <!----add-modal start--------->
                <div class="modal fade" tabindex="-1" id="addEmployeeModal" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Employees</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">

                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="emil" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-success">Add</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!----edit-modal end--------->





                <!----edit-modal start--------->
                <div class="modal fade" tabindex="-1" id="editReservationModal" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Update Reservation</h5>
                                <button type="button" class="close mr-3 mt-2" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">

                                <form method="POST" enctype="multipart/form-data">
                                    <input type="hidden" id="id1" name="id1" />
                                    <input type="hidden" id="price2" name="price2" />

									<div class="form-group">
                                        <label>Driver</label>
                                        <br>
                                        <select style="width:100%;" name="driver1" id="driver1">
                                            <option value="">Select Driver</option>
                                            <?php
											include ('../connection.php');

											$categories= mysqli_query($con, "SELECT * FROM drivers WHERE seller_id=$com_id");
											while($categoriesres = mysqli_fetch_array($categories)){
											?>
                                            <option value="<?php echo $categoriesres['driver_id']?>">
                                                <?php echo $categoriesres['driver_name']?> </option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="row justify-content-between mt-4 ml-1">
                                        <div class="input-box">
                                            <span>Pick-up Date</span>
                                            <br>
                                            <input type="datetime-local" name="pickup1" id="pickup1" value="<?php echo $pickup;?>">
                                        </div>
                                    </div>

									<div class="row justify-content-between mt-2 ml-1">
									<div class="input-box">
                                            <span>Return Date</span>
                                            <br>
                                            <input type="datetime-local" name="return1" id="return1" value="<?php echo $return;?>">
                                        </div>
									</div>

			<div class="form-group">
				<label>Driver</label>
				<br>
				<select style="width:100%;" name="driver1" id="driver1">
					<option value="">Select Driver</option>		
					<?php
					include ('../connection.php');

					$categories= mysqli_query($con, "SELECT * FROM drivers WHERE seller_id=$com_id");
					while($categoriesres = mysqli_fetch_array($categories)){
					?>
						<option value="<?php echo $categoriesres['driver_id']?>"><?php echo $categoriesres['driver_name']?> </option>
						<?php } ?>
				</select>
			</div>

			<div class="form-group">
				<label>Total Amount</label>
				<input type="text" class="form-control" autocomplete="off" name="price1" id="price1" <?php echo $price; ?>" readonly>
			</div>

      	</div>
      <div class="modal-footer">
	  	<button type="submit" name="update_res" id="update_res" class="btn btn-success">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

                <!----edit-modal end--------->


                <!----delete-modal start--------->
                <div class="modal fade" tabindex="-1" id="deleteReservationModal" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Remove Reservation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form method="POST" class="d-inline">

                                <div class="modal-body">

                                    <input type="hidden" id="id2" name="id2" />

                                    <p>Are you sure you want to remove this reservation?</p>
                                    <p class="text-warning">
                                        <medium>this action Cannot be Undone</medium>
                                    </p>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" name="removeRes" id="removeRes"
                                        class="btn btn-success">Delete</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <!----edit-modal end--------->

            </div>
        </div>

        <!------main-content-end----------->



        <!----footer-design------------->

        <!--<footer class="footer">
		    <div class="container-fluid">
			   <div class="footer-in">
			      <p class="mb-0">© RentaCar 2023 . All Rights Reserved.</p>
			   </div>
			</div>
		 </footer>-->

    </div>
    </div>

    <!-------complete html----------->
    <?php 
	    include ('../TemplateShop/_company-footer.php');
    ?>

    <script>
    $(document).ready(function() {

        $('.del_button').click(function(e) {

            $('#deleteReservationModal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);

            $('#id2').val(data[0]);

        });
    });
    </script>


    <script type="text/javascript">
    $(document).ready(function() {
        //   $(".xp-menubar").on('click',function(){
        //     $("#sidebar").toggleClass('active');
        // 	$("#content").toggleClass('active');
        //   });

        //   $('.xp-menubar,.body-overlay').on('click',function(){
        //      $("#sidebar,.body-overlay").toggleClass('show-nav');
        //   });

        $('.conf_button').click(function(e) {
            // $('#editEmployeeModal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);

            $('#id1').val(data[0]);
            $('#pickup1').val(data[5]);
            $('#return1').val(data[6]);
			$('#price2').val(data[7]);
            $('#price1').val(data[8]);
            $('#driver1').val(data[9]);
			

        });

		document.getElementById("pickup1").addEventListener("change", calculatePrice);
        document.getElementById("return1").addEventListener("change", calculatePrice);

        function calculatePrice() {
            const pickupDate = new Date(document.getElementById("pickup1").value);
            const returnDate = new Date(document.getElementById("return1").value);
            
            if (pickupDate < returnDate) {
                const price = calculatePriceBasedOnDates(pickupDate, returnDate);
                document.getElementById("price1").value = `${price.toFixed(2)}`;
            } else {
                alert("Return date must be after pick-up date.");
            }
        }

        function calculatePriceBasedOnDates(pickupDate, returnDate) {
            // Calculate price based on your business logic here
            // For example, you can calculate the price based on the number of days
            // or hours between pickupDate and returnDate.
            var price = parseInt(document.getElementById("price2").value);
            const timeDiff = returnDate - pickupDate; // Difference in milliseconds
            const hoursDiff = timeDiff / (1000 * 60 * 60); // Difference in hours
            const pricePerHour = price / 24; // Change this to your pricing per hour
            return hoursDiff * pricePerHour;
        }

    });
    </script>

    <script>
    function checkDelete() {
        return confirm('Are you sure you want to delete this record?');
    }
    </script>

    <script>
    $(document).ready(function() {
        $('#myTable').dataTable();
    });
    </script>
