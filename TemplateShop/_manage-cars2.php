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
	$verified = $res['verified'];
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
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	  <script src="/js/bootstrap.min.js"></script>

  </head>
  <body >
  <!-- class="d-flex flex-column min-vh-100" -->


	 <!-------sidebar--design------------>
	 <?php 
	 	include ('../TemplateShop/_company-sidebar.php');
	 ?>
	
   <!-------sidebar--design- close----------->
   
   
   
<!-------page-content start----------->


	<!------top-navbar-start-----------> 
		<?php 
			include ('../TemplateShop/_company-header.php');

			if($verified==0){
				include ('../TemplateShop/_not-verified.php');

			} else {

			
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
							

						<div class="row justify-content-center">
						<form action="_manage-cars2.php" class="d-inline" >
							<button type="button" name="conf_button" id="conf_button" class="btn btn-success conf_button mr-2" data-toggle="modal" data-target="#editCarModal" >
								<i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
							</button>
						</form>

						<form action="_manage-cars2.php" class="d-inline">
							<button type="button" name="del_button" id="del_button" class="btn btn-danger del_button btn-sm" data-toggle="modal" data-target="#deleteCarModal">
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
				

									   <!--------add-car-modal start--------->
<div class="modal fade" tabindex="-1" id="addCarModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Car</h5>
        <button type="button" class="close mr-3 mt-2" data-dismiss="modal" aria-label="Close">
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
        <button type="button" class="close mr-3 mt-2" data-dismiss="modal" aria-label="Close">
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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
        <h5 class="modal-title">Remove Car</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

	<form method="POST" class="d-inline">
		
    	<div class="modal-body">

			<input type="hidden" id="item_id2" name="item_id2"/>

        	<p>Are you sure you want to remove this car?</p>
			<p class="text-warning"><medium>this action Cannot be Undone</medium></p>
    	</div>

    	<div class="modal-footer">
	  		<button type="submit" name="removeCar" id="removeCar" class="btn btn-success">Delete</button>
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
	  </div> 
</div>

<!-------complete html----------->



<?php 
}
	include ('../TemplateShop/_company-footer.php');
?>

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


