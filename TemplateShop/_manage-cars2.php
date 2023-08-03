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

$brand2 = "";
$name2 = "";
$price2 = "";
$transmission2 = "";
$color2 = "";
$capacity2 = "";
$license2 = "";

if(isset($_POST['update_car'])){
	$id=$_POST['item_id1'];
    $name=$_POST['item_name1'];
    $brand=$_POST['item_brand1'];
    $capacity=$_POST['item_capacity1'];
    $transmission=$_POST['item_transmission1'];
    $color=$_POST['item_color1'];
    $license=$_POST['item_license_plate1'];
    $price=$_POST['item_price1'];

	$folder='../images/cars/';
	$file = $_FILES['pic_CAR']['tmp_name'];
    $file_name = $_FILES['pic_CAR']['name'];
    $file_name_array = explode(".", $file_name); 
		$extension = end($file_name_array);

		$new_image_name ='Car_'.rand() . '.' . $extension;
		if ($_FILES["pic_CAR"]["size"] >10000000) {
		$error[] = 'Sorry, your image is too large. Upload less than 10 MB in size .';
		}

		if($file != ""){
			if($extension!= "jpg" && $extension!= "png" && $extension!= "jpeg"
			&& $extension!= "gif" && $extension!= "PNG" && $extension!= "JPG" && $extension!= "GIF" && $extension!= "JPEG"){
				$error[] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed';   
			}
		}

		if(!isset($error)){ 
			if($file!= ""){
			  	$stmt = mysqli_query($con,"SELECT item_image FROM product WHERE item_id='$id'");
			  	$row = mysqli_fetch_array($stmt); 
			  	$deleteimage=$row['item_image'];
				unlink($folder.$deleteimage);
				move_uploaded_file($file, $folder . $new_image_name); 
				mysqli_query($con,"UPDATE product SET item_image='$new_image_name' WHERE item_id='$id'");
			}
		  
			 $result = mysqli_query($con,"UPDATE product SET item_name='$name', item_brand='$brand', item_capacity='$capacity', item_transmission='$transmission', item_color='$color', item_license_plate='$license', item_price='$price' WHERE item_id='$id'");
			 
			 if($result){
				//$_SESSION['status'] = "Your profile has been updated";
		 		header("location:/TemplateShop/_manage-cars2.php");
			 } else {
			  	$error[]='Something went wrong';
			 }
  
	  }
	}
?>

<?php
	if(isset($_POST['removeCar'])){
    	$id = $_POST['item_id2'];

    	$query = "DELETE FROM product WHERE item_id='$id' ";
    	$query = mysqli_query($con, $query);

    if($query_run){
        header("location: /TemplateShop/_manage-cars2.php");
    }
    else {
        header("location: /TemplateShop/_manage-cars2.php");
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
        <title>Cars</title>
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
		  <a href=".dashboardCompany.php" class="dashboard"><i class="material-icons">dashboard</i>Dashboard</a>
		  </li>

		  <li class="approval">
		  <a  href="_pending-reservations2.php">
		  <i class="material-icons">summarize</i>Pending Reservations
		  </a>
		  </li>
		  
		  <li class="active">
		  <a  href="#">
		  <i class="material-icons">directions_car</i>Car Management
		  </a>
		  </li>

		  <li class="reserve">
		  <a  href="_manage-reservations2.php">
		  <i class="material-icons">book_online</i>Car Reservation
		  </a>
		  </li>

		  <li class="drivers">
		  <a  href="_manage-to-be-returned2.php">
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
			<h4 class="page-title">Cars</h4>
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
					<h2 class="ml-lg-2">Manage  Cars</h2>
					</div>
					<div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
					<a href="#addCarModal" class="btn btn-success" data-toggle="modal">
					<i class="material-icons">&#xE147;</i>
					<span>Register New Car</span>
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
				<tr>
				<!--<th><span class="custom-checkbox">
				<input type="checkbox" id="selectAll">
				<label for="selectAll"></label></th>-->
				<th width="50">ID</th>
				<th>Model</th>
				<th>Brand</th>
				<th width="50">Transimission Type</th>
				<th width="90">Seating Capacity</th>
				<th>Color</th>
				<th>License Plate</th>
				<th>Price</th>
				<th>Car Picture</th>
				<th>Action</th>
				
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
				$sql = "SELECT * FROM product WHERE seller_id={$com_id}";
				$result =$connection->query($sql);

				if (!$result){
					die("Invalid Query: " . $connection->error);
				}

				while($row = $result->fetch_assoc()) {
					$id=$row["item_id"];
					$name=$row["item_name"];
					$brand=$row["item_brand"];
					$transmission=$row["item_transmission"];
					$capacity=$row["item_capacity"];
					$color=$row["item_color"];
					$license=$row["item_license_plate"];
					$price=$row["item_price"];
					$car_pic=$row["item_image"];
				?>

						<tr>
						<td><?php echo $id?></td>
						<td><?php echo $name?></td>
						<td><?php echo $brand?></td>
						<td><?php echo $transmission?></td>
						<td><?php echo $capacity?></td>
						<td><?php echo $color?></td>
						<td><?php echo $license?></td>
						<td><?php echo $price?></td>
						<td><img height="75" width="105" <?php echo '<img src="/images/cars/'.$car_pic.'" ' ?>> </td>
						<td>
							

						<div class="row">
						<form action="_manage-cars2.php" class="d-inline" >
							<button type="button" name="conf_button" id="conf_button" class="btn btn-success conf_button mr-2" data-bs-toggle="modal" data-bs-target="#editCarModal" >
								<i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
							</button>
						</form>

						<form action="_manage-cars2.php" class="d-inline">
							<button type="button" name="del_button" id="del_button" class="btn btn-danger del_button btn-sm" data-bs-toggle="modal" data-bs-target="#deleteCarModal">
							<i class="material-icons" data-toggle="tooltip" title="Edit">&#xE872;</i>
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
			
		<!-- <div class="clearfix">
			<div class="hint-text">showing <b>3</b> out of <b>3</b></div>
			<ul class="pagination">
			<li class="page-item disabled"><a href="#">Previous</a></li>
			<li class="page-item active"><a href="#"class="page-link">1</a></li>
			<li class="page-item "><a href="#"class="page-link">2</a></li>
			<li class="page-item "><a href="#"class="page-link">3</a></li>
			<li class="page-item "><a href="#"class="page-link">4</a></li>
			<li class="page-item "><a href="#"class="page-link">5</a></li>
			<li class="page-item "><a href="#" class="page-link">Next</a></li>
			</ul>
		</div>   -->
	</div>
</div>
				

									   <!----add-modal start--------->
<div class="modal fade" tabindex="-1" id="addCarModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Employees</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

	  <form action="../insert-functions.php" method="POST" enctype="multipart/form-data">

	  <div class="row">
	  <div class="form-group">
		    <label>Name</label>
			<input type="text" class="form-control" autocomplete="off" name="item_name2" id="item_name2" value="<?php echo $name2; ?>" required>
		</div>
		
		<div class="form-group ml-5">
		    <label>Brand</label>
			<input type="text" class="form-control" autocomplete="off" name="item_brand2" id="item_brand2" value="<?php echo $brand2; ?>" required>
		</div>

		<div class="form-group">
		    <label>Transmission Type</label>
			<input type="text" class="form-control" autocomplete="off" name="item_transmission2" id="item_transmission2" value="<?php echo $transmission2; ?>" required>
		</div>
		
		<div class="form-group ml-5">
		    <label>Capacity</label>
			<input type="text" class="form-control" autocomplete="off" name="item_capacity2" id="item_capacity2" value="<?php echo $capacity2; ?>" required>
		</div>

		<div class="form-group">
		    <label>Color</label>
			<input type="text" class="form-control" autocomplete="off" name="item_color2" id="item_color2"  value="<?php echo $color2; ?>" required>
		</div>

		<div class="form-group ml-5">
		    <label>License Plate</label>
			<input type="text" class="form-control" autocomplete="off" name="item_license_plate2" id="item_license_plate2" value="<?php echo $license2; ?>" required>
		</div>

		<div class="form-group mb-5">
		    <label>Price</label>
			<input type="text" class="form-control" autocomplete="off" name="item_price2" id="item_price2" value="<?php echo $price2; ?>" required>
		</div>

		<div class="form-group col-10">
            <label for="pic_CAR" style="font-size:20px; font-weight:bold;">Please upload Car's photo</label><br>
				<input class="form-control" type="file" name="pic_CAR" id="pic_CAR" style="width:100%;" required>
				<br>
				<label>File size: maximum 10 MB</label>
				<label>File extension: .JPEG, .PNG, .JPG</label>
        </div>
		
		</div>
      </div>
	  
      <div class="modal-footer">
	  	<button type="submit" name="addCar" class="btn btn-success">Add</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
	  </form>
    </div>
  </div>
</div>

					   <!----edit-modal end--------->
					   
					   
					   
					   
					   
				   <!----edit-modal start--------->
				   
<div class="modal fade" tabindex="-1" id="editCarModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Car Information</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

	  <form method="POST" enctype="multipart/form-data">
			<input type="hidden" id="item_id1" name="item_id1"  <?php echo $id; ?>/>

	  <div class="row">
        <div class="form-group">
		    <label>Name</label>
			<input type="text" class="form-control" autocomplete="off" name="item_name1" id="item_name1" value="<?php echo $name; ?>">
		</div>
		
		<div class="form-group ml-5">
		    <label>Brand</label>
			<input type="text" class="form-control" autocomplete="off" name="item_brand1" id="item_brand1" value="<?php echo $brand; ?>">
		</div>

		<div class="form-group">
		    <label>Transmission Type</label>
			<input type="text" class="form-control" autocomplete="off" name="item_transmission1" id="item_transmission1" value="<?php echo $transmission; ?>">
		</div>
		
		<div class="form-group ml-5">
		    <label>Capacity</label>
			<input type="text" class="form-control" autocomplete="off" name="item_capacity1" id="item_capacity1" value="<?php echo $capacity; ?>">
		</div>

		<div class="form-group">
		    <label>Color</label>
			<input type="text" class="form-control" autocomplete="off" name="item_color1" id="item_color1"  value="<?php echo $color; ?>">
		</div>

		<div class="form-group ml-5">
		    <label>License Plate</label>
			<input type="text" class="form-control" autocomplete="off" name="item_license_plate1" id="item_license_plate1" value="<?php echo $license; ?>">
		</div>

		<div class="form-group mb-5">
		    <label>Price</label>
			<input type="text" class="form-control" autocomplete="off" name="item_price1" id="item_price1" value="<?php echo $price; ?>">
		</div>

		<div class="form-group ml-5 mb-5">
		    
		</div>

		<div class="form-group col-10">
            <label for="pic_CAR" style="font-size:20px; font-weight:bold;">Please upload Car's photo</label><br>
				<input class="form-control" type="file" name="pic_CAR" id="pic_CAR" style="width:100%;" >
				<br>
				<label>File size: maximum 10 MB</label>
				<label>File extension: .JPEG, .PNG, .JPG</label>
        </div>
		</div>
    </div>

      <div class="modal-footer">
	  	<button type="submit" name="update_car" id="update_car" class="btn btn-success">Save</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
	  </form>
    </div>
  </div>
</div>

					   <!----edit-modal end--------->	   
					   
					   
					 <!----delete-modal start--------->
					 <div class="modal fade" tabindex="-1" id="deleteCarModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Employees</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

	<form method="POST" class="d-inline">
		
    	<div class="modal-body">

			<input type="hidden" id="item_id2" name="item_id2"/>

        	<p>Are you sure you want to delete this Record</p>
			<p class="text-warning"><medium>this action Cannot be Undone</medium></p>
    	</div>

    	<div class="modal-footer">
	  		<button type="submit" name="removeCar" id="removeCar" class="btn btn-success">Delete</button>
        	<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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
  
  <script>
		$(document).ready(function(){

			$('.del_button').click(function(e){
					
				$('#deleteCarModal').modal('show');

					$tr=$(this).closest('tr');

					var data = $tr.children("td").map(function(){
						return $(this).text();
					}).get();

					console.log(data);

					$('#item_id2').val(data[0]);
				
			});
		});
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
					// $('#editCarModal').modal('show');

					$tr=$(this).closest('tr');

					var data = $tr.children("td").map(function(){
						return $(this).text();
					}).get();

					console.log(data);

					$('#item_id1').val(data[0]);
					$('#item_name1').val(data[1]);
					$('#item_brand1').val(data[2]);
					$('#item_transmission1').val(data[3]);
					$('#item_capacity1').val(data[4]);
					$('#item_color1').val(data[5]);
					$('#item_license_plate1').val(data[6]);
					$('#item_price1').val(data[7]);
				
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


