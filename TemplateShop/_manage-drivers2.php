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

$name2 = "";
$age2 = "";
$contact2 = "";
$address2 = "";

if(isset($_POST['update'])){
	$id = $_POST['driver_id1'];
    $name=$_POST['driver_name1'];
    $age=$_POST['driver_age1'];
    $contact=$_POST['driver_contact1'];
    $address=$_POST['driver_address1'];


	/*$img_name = $_FILES['pic_ID']['name'];
    $img_size = $_FILES['pic_ID']['size'];
    $tmp_name = $_FILES['pic_ID']['tmp_name'];
    $error = $_FILES['pic_ID']['error'];
	
	$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_ex_lc = strtolower($img_ex);*/

	$folder='../images/drivers/';
	$file = $_FILES['pic_ID']['tmp_name'];
    $file_name = $_FILES['pic_ID']['name'];
    //$error = $_FILES['pic_ID']['error'];
    //$img_size = $_FILES['pic_ID']['size'];
    $file_name_array = explode(".", $file_name); 
		$extension = end($file_name_array);

		$new_image_name ='license_'.rand() . '.' . $extension;
		if ($_FILES["pic_ID"]["size"] >10000000) {
		$error[] = 'Sorry, your image is too large. Upload less than 10 MB in size .';
		}

	$file1 = $_FILES['pic_PROFILE']['tmp_name'];
    $file_name1 = $_FILES['pic_PROFILE']['name'];
    //$img_size1 = $_FILES['pic_PROFILE']['size'];
    $file_name_array1 = explode(".", $file_name1); 
		$extension1 = end($file_name_array1);

		$new_image_name1 ='profile_'.rand() . '.' . $extension1;
		if ($_FILES["pic_PROFILE"]["size"] >10000000) {
		$error1[] = 'Sorry, your image is too large. Upload less than 10 MB in size .';
		}
    
	/*$img_name1 = $_FILES['pic_PROFILE']['name'];
    $img_size1 = $_FILES['pic_PROFILE']['size'];
    $tmp_name1 = $_FILES['pic_PROFILE']['tmp_name'];
    $error1 = $_FILES['pic_PROFILE']['error'];

    $img_ex1 = pathinfo($img_name1, PATHINFO_EXTENSION);
    $img_ex_lc1 = strtolower($img_ex1);*/

    //$allowed_exs = array("jpg", "jpeg", "png"); 


		if($file != ""){
			if($extension!= "jpg" && $extension!= "png" && $extension!= "jpeg"
			&& $extension!= "gif" && $extension!= "PNG" && $extension!= "JPG" && $extension!= "GIF" && $extension!= "JPEG"){
				$error[] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed';   
			}
		}

		if($file1 != ""){
			if($extension1!= "jpg" && $extension1!= "png" && $extension1!= "jpeg"
			&& $extension1!= "gif" && $extension1!= "PNG" && $extension1!= "JPG" && $extension1!= "GIF" && $extension1!= "JPEG"){
				$error1[] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed';   
			}
		}

		/*if (in_array($img_ex_lc, $allowed_exs)) {
			$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
			$img_upload_path = 'assets/driver_pic/'.$new_img_name;
			move_uploaded_file($tmp_name, $img_upload_path);
	
			if (in_array($img_ex_lc1, $allowed_exs)) {
				$new_img_name1 = uniqid("IMG-", true).'.'.$img_ex_lc1;
				$img_upload_path1 = 'assets/driver_pic/'.$new_img_name1;
				move_uploaded_file($tmp_name1, $img_upload_path1);*/

		if(!isset($error)){ 
			if($file!= ""){
			  	$stmt = mysqli_query($con,"SELECT driver_license FROM drivers WHERE driver_id='$id'");
			  	$row = mysqli_fetch_array($stmt); 
			  	$deleteimage=$row['driver_license'];
				unlink($folder.$deleteimage);
				move_uploaded_file($file, $folder . $new_image_name); 
				mysqli_query($con,"UPDATE drivers SET driver_license='$new_image_name' WHERE driver_id='$id'");
			}

		if($file1!= ""){
				$stmt1 = mysqli_query($con,"SELECT driver_image FROM drivers WHERE driver_id='$id'");
				$row1 = mysqli_fetch_array($stmt1); 
				$deleteimage=$row1['driver_image'];
			  	unlink($folder.$deleteimage);
			  	move_uploaded_file($file1, $folder . $new_image_name1); 
			  	mysqli_query($con,"UPDATE drivers SET driver_image='$new_image_name1' WHERE driver_id='$id'");
		  	}
		  
		$result = mysqli_query($con,"UPDATE drivers SET driver_name='$name', driver_age='$age', driver_contact='$contact', driver_address='$address' WHERE driver_id='$id'");
		
		if($result){
		//$_SESSION['status'] = "Your profile has been updated";
			header("location:/TemplateShop/_manage-drivers2.php");
		} else {
			$error[]='Something went wrong';
		}
  
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
        <title>Drivers</title>
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
	  <script src="/js/popper.min.js"></script>
   	  <script src="/js/bootstrap.min.js"></script>	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>   <script src="/js/popper.min.js"></script>
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
					<h2 class="ml-lg-2">Manage  Drivers</h2>
					</div>
					<div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
					<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal">
					<i class="material-icons">&#xE147;</i>
					<span>Register New Driver</span>
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
							<th scope="col">ID</th></th>
                            <th scope="col">Name</th>
                            <th scope="col">Age</th>
                            <th scope="col">Contact Number</th>
                            <th scope="col">Address</th>
                            <th scope="col">License</th>
                            <th scope="col">Profile Picture</th>
                            <th scope="col">Action</th>
							</tr>
						</thead>
						  
						  <tbody>
                            <?php
                            $servername = "localhost";
                            $user = "root";
                            $password = "";
                            $database = "rentacar";

                            $connection = new mysqli($servername, $user, $password, $database);

                            if ($connection->connect_error){
                                die("Connection Failed: " . $connection->connect_error);
                            }
                            
                            $sql = "SELECT * FROM drivers WHERE seller_id='$com_id'";
                            $result =$connection->query($sql);

                            if (!$result){
                                die("Invalid Query: " . $connection->error);
                            }

                            while($row = $result->fetch_assoc()) {
                                $id=$row["driver_id"];
                                $name=$row["driver_name"];
                                $age=$row["driver_age"];
                                $contact=$row["driver_contact"];
                                $address=$row["driver_address"];
                                $license=$row["driver_license"];
                                $profile=$row["driver_image"];
                            ?>

                            <tr>     
                                <td><?php echo $id?></td>
                                <td><?php echo $name?></td>
                                <td><?php echo $age?></td>
                                <td><?php echo $contact?></td>
                                <td><?php echo $address?></td>
                                <td><img height="150" width="200" <?php echo '<img src="/images/drivers/'.$license.'" ' ?>></td>
                                <td><img height="150" width="220" <?php echo '<img src="/images/drivers/'.$profile.'" ' ?>></td>
                                <td>

								<div class="row justify-content-center">
								<form action="_manage-drivers2.php" class="d-inline" >
                                	<button type="button" name="conf_button" id="conf_button" class="btn btn-success conf_button mr-2" data-bs-toggle="modal" data-bs-target="#editEmployeeModal" >
										<i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
									</button>
                                </form>

								<form action="_manage-drivers2.php" class="d-inline">
                                    <button type="button" name="del_button" id="del_button" class="btn btn-danger del_button btn-sm" data-bs-toggle="modal" data-bs-target="#deleteEmployeeModal">
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
					</div>
				</div>
					

									   <!----add-modal start--------->
<div class="modal fade" tabindex="-1" id="addEmployeeModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add a Driver</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

	  <form action="../insert-functions.php" method="POST" enctype="multipart/form-data">

	  		<div class="form-group">
				<label>Name</label>
				<input type="text" class="form-control" autocomplete="off" name="driver_name2" id="driver_name2" value="<?php echo $name2; ?>" required>
			</div>

			<div class="form-group">
				<label>Age</label>
				<input type="text" class="form-control" autocomplete="off" name="driver_age2" id="driver_age2" value="<?php echo $age2; ?>" required>
			</div>

			<div class="form-group">
				<label>Contact Number</label>
				<input type="text" class="form-control" autocomplete="off" name="driver_contact2" id="driver_contact2" value="<?php echo $contact2; ?>" required>
			</div>

			<div class="form-group">
				<label>Address</label>
				<input type="text" class="form-control" autocomplete="off" name="driver_address2" id="driver_address2" value="<?php echo $address2; ?>" required>
			</div>
		
		<div class="row">
			<div class="form-group mb-5 border-bottom-0 col-6 mt-5">
				<label for="pic_ID" style="font-size:20px; font-weight:bold;">Upload Picture of Driver's License</label><br>
				<input type="file" class="form-control-file mt-3" id="pic_ID" name="pic_ID" required>
			</div>

			<div class="form-group mb-5 border-bottom-0 col-6 mt-5">
				<label for="pic_PROFILE" style="font-size:20px; font-weight:bold;">Upload Picture of Driver</label><br>
				<input type="file" class="form-control-file mt-3" id="pic_PROFILE" name="pic_PROFILE" required>
		</div>
	</div>
</div>

			<div class="modal-footer">
				<button type="submit" name="addDriver" class="btn btn-success">Add</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
			</div>

	  </form>
    </div>
  </div>
</div>
					   <!----add-modal end--------->
				   
				   <!----edit-modal start--------->


<div class="modal fade" tabindex="-1" id="editEmployeeModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Driver Information</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

		<form method="POST" enctype="multipart/form-data">
			<input type="hidden" id="driver_id1" name="driver_id1"  />

			<div class="form-group">
				<label>Name</label>
				<input type="text" class="form-control" autocomplete="off" name="driver_name1" id="driver_name1" <?php echo $name; ?>">
			</div>
			
			<div class="form-group">
				<label>Age</label>
				<input type="text" class="form-control" autocomplete="off" name="driver_age1" id="driver_age1">
				<!-- <input type="text" class="form-control" name="driver_age" value="<?php echo $age; ?>"> -->
			</div>

			<div class="form-group">
				<label>Contact Number</label>
				<input type="text" class="form-control" autocomplete="off" name="driver_contact1" id="driver_contact1">
				<!-- <input type="text" class="form-control" name="driver_contact" value="<?php echo $contact; ?>"> -->
			</div>
			
			<div class="form-group">
				<label>Address</label>
				<input type="text" class="form-control" autocomplete="off" name="driver_address1" id="driver_address1">
				<!-- <input type="text" class="form-control" name="driver_address" value="<?php echo $address; ?>"> -->
			</div>

			<div class="row">
				<div class="form-group mb-5 border-bottom-0 col-6 mt-5">
					<label for="pic_ID" style="font-size:20px; font-weight:bold;">Upload Picture of Driver's License</label><br>
					<input type="file" class="form-control-file mt-3" id="pic_ID" name="pic_ID">
				</div>
						
						
				<div class="form-group mb-5 border-bottom-0 col-6 mt-5">
					<label for="pic_PROFILE" style="font-size:20px; font-weight:bold;">Upload Picture of Driver</label><br>
					<input type="file" class="form-control-file mt-3" id="pic_PROFILE" name="pic_PROFILE">
				</div>
			</div>
		</div>
		
			<div class="modal-footer">
				<button type="submit" name="update"  id="update" class="btn btn-success">Save</button>
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" href="_manage-drivers2.php">Cancel</button>			
			</div>
	  	</form>
    </div>
  </div>
</div>

					   <!----edit-modal end--------->	   
					   
					   
					 <!----delete-modal start--------->
<div class="modal fade" tabindex="-1" id="deleteEmployeeModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Employees</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

	<form action="../delete-functions.php" method="POST" class="d-inline">
		
    	<div class="modal-body">

			<input type="hidden" id="driver_id2" name="driver_id2"/>

        	<p>Are you sure you want to delete this Record</p>
			<p class="text-warning"><medium>this action Cannot be Undone</medium></p>
    	</div>

    	<div class="modal-footer">
	  		<button type="submit" name="removeDriver" class="btn btn-success">Delete</button>
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
		 </footer>-->
	 
		 
	  </div>
</div>


<!-------complete html----------->

  
     <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   
  


<script>
		$(document).ready(function(){

			$('.del_button').click(function(e){
					
				$('#deleteEmployeeModal').modal('show');

					$tr=$(this).closest('tr');

					var data = $tr.children("td").map(function(){
						return $(this).text();
					}).get();

					console.log(data);

					$('#driver_id2').val(data[0]);
				
			});
		});
</script>
  
  <script type="text/javascript">
        	// $(document).ready(function(){
			// $(".xp-menubar").on('click',function(){
			// 	$("#sidebar").toggleClass('active');
			// 	$("#content").toggleClass('active');
			// });
			
			// $('.xp-menubar,.body-overlay').on('click',function(){
			// 	$("#sidebar,.body-overlay").toggleClass('show-nav');
			// });

			$('.conf_button').click(function(e){
					// $('#editEmployeeModal').modal('show');

					$tr=$(this).closest('tr');

					var data = $tr.children("td").map(function(){
						return $(this).text();
					}).get();

					console.log(data);

					$('#driver_id1').val(data[0]);
					$('#driver_name1').val(data[1]);
					$('#driver_age1').val(data[2]);
					$('#driver_contact1').val(data[3]);
					$('#driver_address1').val(data[4]);
				
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
<?php 
			}
	include ('../TemplateShop/_company-footer.php');
?>


