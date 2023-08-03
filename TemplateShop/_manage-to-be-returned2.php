<?php
session_start();
$servername = "localhost";
$user = "root";
$password = "";
$database = "rentacar";

$con = new mysqli($servername, $user, $password, $database);

$com_id=$_SESSION['com_id'];

include ('../connection.php');

$findresult = mysqli_query($con, "SELECT * FROM seller WHERE seller_id= '$com_id'");

if($res = mysqli_fetch_array($findresult)){
$image = $res['shop_logo'];
}

if(isset($_POST['update_res'])){
	$id = $_POST['item_id1'];
    $name=$_POST['name1'];
    $number=$_POST['number1'];
    $vehicle=$_POST['vehicle1'];
	$license=$_POST['license1'];
    $pickup=$_POST['pickup1'];
	$return=$_POST['return1'];
	$fee=$_POST['fee1'];
	$price=$_POST['price1'];

	$result = mysqli_query($con,"INSERT INTO salesreport(id, seller_id, brand, license_plate, pickupdate, returndate, additional_fee, overall_price) 
	SELECT id, seller_id, brand, license_plate, pickupdate, returndate, additional_fee, overall_price FROM reservation WHERE item_id='$id'");
	
	if($result){
		//$_SESSION['status'] = "Your profile has been updated";
				mysqli_query($con,"UPDATE product SET status='0' WHERE item_id='$id'");
				mysqli_query($con,"DELETE FROM reservation WHERE item_id='$id'");
			header("location:/TemplateShop/_manage-to-be-returned2.php");
		} else {
			$error[]='Something went wrong';
		}
}

if(isset($_POST['update_res2'])){
	$id = $_POST['item_id2'];
    $fee = $_POST['fee2'];

	$result = mysqli_query($con,"UPDATE reservation SET additional_fee='$fee' WHERE item_id='$id'");
	
	if($result){
		//$_SESSION['status'] = "Your profile has been updated";
			header("location:/TemplateShop/_manage-to-be-returned2.php");
		} else {
			$error[]='Something went wrong';
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
      <link href="https://fonts.googleapis.com/css2?family=Material+Icons"rel="stylesheet">

  </head>
  <body>
  


<div class="wrapper">
     
	  <div class="body-overlay"></div>
	 
	 <!-------sidebar--design------------>
	 
	 <div id="sidebar">
	    <div class="sidebar-header">
		   <h3><img style="width:40px; height:auto;"  src="../images/shop/<?php echo $res['shop_logo']; ?>"><span>RentaCar</span></h3>
		</div>
		<ul class="list-unstyled component m-0">
		  <li class="dash">
		  <a href=".dashboardCompany.php" class="dashboard"><i class="material-icons">dashboard</i>Dashboard </a>
		  </li>

		  <li class="approval">
		  <a  href="_pending-reservations2.php">
		  <i class="material-icons">summarize</i>Pending Reservations
		  </a>
		  </li>
		  
		  <li class="cars">
		  <a  href="_manage-cars2.php">
		  <i class="material-icons">directions_car</i>Car Management
		  </a>
		  </li>

		  <li class="reserve">
		  <a  href="_manage-reservations2.php">
		  <i class="material-icons">book_online</i>Car Reservation
		  </a>
		  </li>

          <li class="active">
		  <a  href="#">
		  <i class="material-icons">fact_check</i>Cars to be Returned
		  </a>
		  </li>

		  <li class="reserve">
		  <a  href="_manage-drivers2.php">
		  <i class="material-icons">person</i>Drivers
		  </a>
		  </li>
          
          <br>

          <li class="reserve">
		  <a  href="_manage-sales2.php">
		  <i class="material-icons">summarize</i>Sales Report
		  </a>
		  </li>
		
		</ul>
	 </div>
	 
   <!-------sidebar--design- close----------->
   
   
   
      <!-------page-content start----------->
   
      <div id="content">
	     
		  <!------top-navbar-start-----------> 
		     
		  <div class="top-navbar">
		     <div class="xd-topbar">
			     <div class="row">
				     <div class="col-2 col-md-1 col-lg-4 order-2 order-md-1 align-self-center">
					    <div class="xp-menubar">
						    <span class="material-icons text-white">signal_cellular_alt</span>
						</div>
					 </div>
					 
					 <!-- <div class="col-md-5 col-lg-3 order-3 order-md-2">
					     <div class="xp-searchbar">
						     <form>
							    <div class="input-group">
								  <input type="search" class="form-control"
								  placeholder="Search">
								  <div class="input-group-append">
								     <button class="btn" type="submit" id="button-addon2">Go
									 </button>
								  </div>
								</div>
							 </form>
						 </div>
					 </div> -->
					 
					 
					 <div class="col-10 col-md-6 col-lg-8 order-1 order-md-3">
					     <div class="xp-profilebar text-right">
						    <nav class="navbar p-0">
							   <ul class="nav navbar-nav flex-row ml-auto">
							   <li class="dropdown nav-item">
							     <a class="nav-link" href="#" data-toggle="dropdown">
								  <span class="material-icons">notifications</span>
								  <span class="notification">4</span>
								 </a>
								  <ul class="dropdown-menu">
								     <li><a href="#">You Have 4 New Messages</a></li>
									 <li><a href="#">You Have 4 New Messages</a></li>
									 <li><a href="#">You Have 4 New Messages</a></li>
									 <li><a href="#">You Have 4 New Messages</a></li>
								  </ul>
							   </li>
							   
							   <li class="nav-item">
							   <a class="nav-link" href="/TemplateShop/_company-messages.php">
								   <span class="material-icons">question_answer</span>
								 </a>
							   </li>

							   <i class="fas ml-3 me-2"></i><?php echo "<p>" . $_SESSION['shopname'] . "</p>"; ?>
							   <li class="dropdown nav-item">
							     <a class="nav-link" href="#" data-toggle="dropdown">
								 <img style="width:40px; height:auto;"  src="../images/shop/<?php echo $res['shop_logo']; ?>">
								  <span class="xp-user-live"></span>
								 </a>
								  <ul class="dropdown-menu small-menu">
								     <li><a href="_company-profile.php">
									 <span class="material-icons">person_outline</span>
									 Profile
									 </a></li>
									 <li><a href="#">
									 <span class="material-icons">settings</span>
									 Settings
									 </a></li>
									 <li><a href="_company-login.php">
									 <span class="material-icons">logout</span>
									 Logout
									 </a></li>
									 
								  </ul>
							   </li>
							   
							   
							   </ul>
							</nav>
						 </div>
					 </div>
					 
				 </div>
				 
				 <div class="xp-breadcrumbbar text-center">
				    <h4 class="page-title">Reservations</h4>
					<!--<ol class="breadcrumb">
					  <li class="breadcrumb-item"><a href="#">Vishweb</a></li>
					  <li class="breadcrumb-item active" aria-curent="page">Dashboard</li>
					</ol>-->
				 </div>
				 
				 
			 </div>
		  </div>
		  <!------top-navbar-end-----------> 

		  

		   <!------main-content-start-----------> 
		      <div class="main-content">
			     <div class="row">
				    <div class="col-md-12">
					   <div class="table-wrapper">
					     
					   <div class="table-title">
					     <div class="row">
						     <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
							    <h2 class="ml-lg-2">Manage  Transactions</h2>
							 </div>
							 
					     </div>
					   </div>
					   
					<table class="table table-striped table-hover" id="myTable">
					    <thead>
						    <tr>
							<!--<th><span class="custom-checkbox">
							<input type="checkbox" id="selectAll">
							<label for="selectAll"></label></th>-->
							<th scope="col" width="50">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Contact Number</th>
                            <th scope="col">Vehicle</th>
							<th scope="col">license Plate</th>
                            <th scope="col">Pick-up Date</th>
                            <th scope="col">Reutrn Date</th>
							<th scope="col">Excess Fee</th>
                            <th scope="col">Total Amount</th>
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
                            $sql = "SELECT * FROM reservation WHERE status='In Use' AND seller_id = {$com_id}";
                            $result =$connection->query($sql);

                            if (!$result){
                                die("Invalid Query: " . $connection->error);
                            }

                            while($row = $result->fetch_assoc()) {
                                $id = $row["item_id"];
                                $name = $row["user_name"];
                                $number = $row["number"];
                                $vehicle = $row["brand"];
								$license = $row["license_plate"];
                                $pickup = $row["pickupdate"];
                                $return = $row["returndate"];
								$fee = $row["additional_fee"];
                                $price = $row["overall_price"];
                                $status = $row["status"];
                            ?>

                            <tr>
                                    
                                <td><?php echo $id?></td>
                                <td><?php echo $name?></td>
                                <td><?php echo $number?></td>
                                <td><?php echo $vehicle?></td>
								<td><?php echo $license?></td>
                                <td><?php echo $pickup?></td>
                                <td><?php echo $return?></td>
								<td><?php echo $fee?></td>
                                <td><?php echo $price?></td>
                                <td><?php echo $status?></td>
                                <td>
									<div class="row">

									<form action="_manage-reservations2.php" class="d-inline" >
                                	<button type="button" name="edit_button" id="edit_button" class="btn btn-success edit_button mr-2" data-bs-toggle="modal" data-bs-target="#editReservationModal" >
										<i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
									</button>
                                	</form>

									<form action="_manage-reservations2.php" class="d-inline" >
										<button type="button" name="conf_button" id="conf_button" class="btn btn-primary conf_button mr-2" data-bs-toggle="modal" data-bs-target="#completeModal" >
										<i class="material-icons" data-toggle="tooltip" title="Edit">&#xe86c;</i>
										</button>
									</form>

									</div>
                                </td>
                            </tr>
                        <?php
                        ;}
                               
                        ?>
							 <!--<th>
							    <a href="#editEmployeeModal" class="edit" data-toggle="modal">
							   <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
							   </a>
							   <a href="#deleteEmployeeModal" class="delete" data-toggle="modal">
							   <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
							   </a>
							 </th>
							 </tr>-->
							 
							 
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
<div class="modal fade" tabindex="-1" id="completeModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Rented Car</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      	<div class="modal-body">

			<form method="POST" enctype="multipart/form-data">
				<input  id="item_id1" name="item_id1"  />

			<div class="form-group">
				<label>Name</label>
				<input type="text" class="form-control" autocomplete="off" name="name1" id="name1" <?php echo $name; ?>" readonly>
			</div>

			<div class="form-group">
				<label>Contact Number</label>
				<input type="text" class="form-control" autocomplete="off" name="number1" id="number1" <?php echo $number; ?>" readonly>
			</div>

			<div class="form-group">
				<label>Vehicle</label>
				<input type="text" class="form-control" autocomplete="off" name="vehicle1" id="vehicle1" <?php echo $vehicle; ?>" readonly>
			</div>

			<div class="form-group">
				<label>License Plate</label>
				<input type="text" class="form-control" autocomplete="off" name="license1" id="license1" <?php echo $license; ?>" readonly>
			</div>

			<div class="form-group">
				<label>Pick-up Date</label>
				<input type="text" class="form-control" autocomplete="off" name="pickup1" id="pickup1" <?php echo $pickup; ?>" readonly>
			</div>

			<div class="form-group">
				<label>Return Date</label>
				<input type="text" class="form-control" autocomplete="off" name="return1" id="return1" <?php echo $return; ?>" readonly>
			</div>

			<div class="form-group">
				<label>Excess Fee</label>
				<input type="text" class="form-control" autocomplete="off" name="fee1" id="fee1" <?php echo $fee; ?>" readonly>
			</div>

			<div class="form-group">
				<label>Total Amount</label>
				<input type="text" class="form-control" autocomplete="off" name="price1" id="price1" <?php echo $price; ?>" readonly>
			</div>

      	</div>
      <div class="modal-footer">
	  	<button type="submit" name="update_res" id="update_res" class="btn btn-success">Complete</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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
        <h5 class="modal-title">Rented Car</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      	<div class="modal-body">

			<form method="POST" enctype="multipart/form-data">
				<input  id="item_id2" name="item_id2"  />

			<div class="form-group">
				<label>Name</label>
				<input type="text" class="form-control" autocomplete="off" name="name2" id="name2" <?php echo $name; ?>" readonly>
			</div>

			<div class="form-group">
				<label>Contact Number</label>
				<input type="text" class="form-control" autocomplete="off" name="number2" id="number2" <?php echo $number; ?>" readonly>
			</div>

			<div class="form-group">
				<label>Vehicle</label>
				<input type="text" class="form-control" autocomplete="off" name="vehicle2" id="vehicle2" <?php echo $vehicle; ?>" readonly>
			</div>

			<div class="form-group">
				<label>License Plate</label>
				<input type="text" class="form-control" autocomplete="off" name="license2" id="license2" <?php echo $license; ?>" readonly>
			</div>

			<div class="form-group">
				<label>Pick-up Date</label>
				<input type="text" class="form-control" autocomplete="off" name="pickup2" id="pickup2" <?php echo $pickup; ?>" readonly>
			</div>

			<div class="form-group">
				<label>Return Date</label>
				<input type="text" class="form-control" autocomplete="off" name="return2" id="return2" <?php echo $return; ?>" readonly>
			</div>

			<div class="form-group">
				<label>Excess Fee</label>
				<input type="text" class="form-control" autocomplete="off" name="fee2" id="fee2" <?php echo $fee; ?>">
			</div>

			<div class="form-group">
				<label>Total Amount</label>
				<input type="text" class="form-control" autocomplete="off" name="price2" id="price2" <?php echo $price; ?>" readonly>
			</div>

      	</div>
      <div class="modal-footer">
	  	<button type="submit" name="update_res2" id="update_res2" class="btn btn-success">Save</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
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
  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="/js/jquery-3.3.1.slim.min.js"></script>
   <script src="/js/popper.min.js"></script>
   <script src="/js/bootstrap.min.js"></script>
   <script src="/js/jquery-3.3.1.min.js"></script>
   <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
	</script>
  
  
<script type="text/javascript">
	$(document).ready(function(){
		$(".xp-menubar").on('click',function(){
		$("#sidebar").toggleClass('active');
		$("#content").toggleClass('active');
		});
		
		$('.xp-menubar,.body-overlay').on('click',function(){
			$("#sidebar,.body-overlay").toggleClass('show-nav');
		});

		$('.conf_button').click(function(e){
				// $('#editEmployeeModal').modal('show');

				$tr=$(this).closest('tr');

				var data = $tr.children("td").map(function(){
					return $(this).text();
				}).get();

				console.log(data);

				$('#item_id1').val(data[0]);
				$('#name1').val(data[1]);
				$('#number1').val(data[2]);
				$('#vehicle1').val(data[3]);
				$('#license1').val(data[4]);
				$('#pickup1').val(data[5]);
				$('#return1').val(data[6]);
				$('#fee1').val(data[7]);
				$('#price1').val(data[8]);
			
		});

		$('.edit_button').click(function(e){
				// $('#editEmployeeModal').modal('show');

				$tr=$(this).closest('tr');

				var data = $tr.children("td").map(function(){
					return $(this).text();
				}).get();

				console.log(data);

				$('#item_id2').val(data[0]);
				$('#name2').val(data[1]);
				$('#number2').val(data[2]);
				$('#vehicle2').val(data[3]);
				$('#license2').val(data[4]);
				$('#pickup2').val(data[5]);
				$('#return2').val(data[6]);
				$('#fee2').val(data[7]);
				$('#price2').val(data[8]);
			
		});
		
	});
</script>
  
<script>
        function checkDelete(){
            return confirm('Are you sure you want to delete this record?');
        }
</script>

<script>
        $(document).ready(function(){
			$('#myTable').dataTable();
        });
</script>

  </body>
  
  </html>