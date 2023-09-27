<?php
session_start();
$servername = "localhost";
$user = "root";
$password = "";
$database = "rentacar";

$con = new mysqli($servername, $user, $password, $database);

$admin_id=$_SESSION["admin_id"];

include ('../connection.php');

$findresult = mysqli_query($con, "SELECT * FROM admin WHERE admin_id= '$admin_id'");

if($res = mysqli_fetch_array($findresult)){
$id = $res['admin_id'];
$username = $res['user_name'];
$adminname = $res['admin_name'];
$pass = $res['admin_pass']; 
$img = $res['admin_image'];
}

if(isset($_POST['update'])){
	$id = $_POST['user_id1'];
    $namef=$_POST['namef1'];
	$namel=$_POST['namel1'];
    $username=$_POST['username1'];
	$passwords=$_POST['password1'];
	$email=$_POST['email1'];
    $contact=$_POST['contact1'];
    $verified=$_POST['verified1'];
	$regdate=$_POST['regdate1'];

	// $folder='images/drivers/';
	// $file = $_FILES['pic_ID']['tmp_name'];
    // $file_name = $_FILES['pic_ID']['name'];
    // $file_name_array = explode(".", $file_name); 
	// 	$extension = end($file_name_array);

	// 	$new_image_name ='license_'.rand() . '.' . $extension;
	// 	if ($_FILES["pic_ID"]["size"] >10000000) {
	// 	$error[] = 'Sorry, your image is too large. Upload less than 10 MB in size .';
	// 	}

	// $file1 = $_FILES['pic_PROFILE']['tmp_name'];
    // $file_name1 = $_FILES['pic_PROFILE']['name'];
    // $file_name_array1 = explode(".", $file_name1); 
	// 	$extension1 = end($file_name_array1);

	// 	$new_image_name1 ='profile_'.rand() . '.' . $extension1;
	// 	if ($_FILES["pic_PROFILE"]["size"] >10000000) {
	// 	$error1[] = 'Sorry, your image is too large. Upload less than 10 MB in size .';
	// 	}

	// 	if($file != ""){
	// 		if($extension!= "jpg" && $extension!= "png" && $extension!= "jpeg"
	// 		&& $extension!= "gif" && $extension!= "PNG" && $extension!= "JPG" && $extension!= "GIF" && $extension!= "JPEG"){
	// 			$error[] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed';   
	// 		}
	// 	}

	// 	if($file1 != ""){
	// 		if($extension1!= "jpg" && $extension1!= "png" && $extension1!= "jpeg"
	// 		&& $extension1!= "gif" && $extension1!= "PNG" && $extension1!= "JPG" && $extension1!= "GIF" && $extension1!= "JPEG"){
	// 			$error1[] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed';   
	// 		}
	// 	}

	// 	if(!isset($error)){ 
	// 		if($file!= ""){
	// 		  	$stmt = mysqli_query($con,"SELECT driver_license FROM drivers WHERE driver_id='$id'");
	// 		  	$row = mysqli_fetch_array($stmt); 
	// 		  	$deleteimage=$row['driver_license'];
	// 			unlink($folder.$deleteimage);
	// 			move_uploaded_file($file, $folder . $new_image_name); 
	// 			mysqli_query($con,"UPDATE drivers SET driver_license='$new_image_name' WHERE driver_id='$id'");
	// 		}

	// 	if($file1!= ""){
	// 			$stmt1 = mysqli_query($con,"SELECT driver_image FROM drivers WHERE driver_id='$id'");
	// 			$row1 = mysqli_fetch_array($stmt1); 
	// 			$deleteimage=$row1['driver_image'];
	// 		  	unlink($folder.$deleteimage);
	// 		  	move_uploaded_file($file1, $folder . $new_image_name1); 
	// 		  	mysqli_query($con,"UPDATE drivers SET driver_image='$new_image_name1' WHERE driver_id='$id'");
	// 	  	}
		  
		$result = mysqli_query($con,"UPDATE user SET first_name='$namef', last_name='$namel', user_name='$username', pass_word='$passwords', email='$email', contact_num='$contact', verified='$verified' WHERE user_id='$id'");
		
		if($result){
		//$_SESSION['status'] = "Your profile has been updated";
			header("location:_manage-users2.php");
		} else {
			header("location:_manage-users2.php?error");
		}
  
	  }


?>

<?php
if(isset($_POST['removeUser'])){
    $product = $_POST['user_id2'];

    $query = "DELETE FROM user WHERE user_id='$product'";
    $query = mysqli_query($con, $query);

    if($query_run){
        header("location: /TemplateAdmin/_manage-users2.php");
    }
    else {
        header("location: /TemplateAdmin/_manage-users2.php");
    }   
}?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <title>Users</title>
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
		<h3><img style="width:40px; height:auto;" src="../images/admin/<?php echo $res['admin_image']; ?>"
                        class="img-fluid"><span>Admin</span></h3>
		</div>
		<ul class="list-unstyled component m-0">
		  <li class="dash">
		  <a href=".dashboardAdmin.php" class="dashboard"><i class="material-icons">dashboard</i>Dashboard </a>
		  </li>
		  
		  <li class="shop">
		  <a  href="_manage-shops2.php">
		  <i class="material-icons">store</i>Manage Shops
		  </a>
		  </li>

		  <li class="active">
		  <a  href="#">
		  <i class="material-icons">person_outline</i>Manage Users
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
				     <div class="col-2 col-md-1 col-lg-1 order-2 order-md-1 align-self-center">
					    <div class="xp-menubar">
						    <span class="material-icons text-white">signal_cellular_alt</span>
						</div>
					 </div>
					 
					 <div class="col-md-5 col-lg-3 order-3 order-md-2">
					     <!-- <div class="xp-searchbar">
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
						 </div> -->
					 </div>
					 
					 
					 <div class="col-10 col-md-6 col-lg-8 order-1 order-md-3">
					     <div class="xp-profilebar text-right">
						    <nav class="navbar p-0">
							   <ul class="nav navbar-nav flex-row ml-auto">
							   <li class="dropdown nav-item">
							     <a class="nav-link" href="#" data-toggle="dropdown">
								  <span class="material-icons">notifications</span>
								  <span class="notification">0</span>
								 </a>
								  <ul class="dropdown-menu dropdown-notif">
								     <li><a href="#">You Have 4 New Messages</a></li>
									 <li><a href="#">You Have 4 New Messages</a></li>
									 <li><a href="#">You Have 4 New Messages</a></li>
									 <li><a href="#">You Have 4 New Messages</a></li>
								  </ul>
							   </li>
							   
							   <!-- <li class="nav-item">
							     <a class="nav-link" href="#">
								   <span class="material-icons">question_answer</span>
								 </a>
							   </li> -->

							   <i class="fas"></i><?php echo "<p>" . $_SESSION['user_name'] . "</p>"; ?>
							   <li class="dropdown nav-item">
							     <a class="nav-link" href="#" data-toggle="dropdown">
								 <img style="width:40px; height:auto;" src="../images/admin/<?php echo $res['admin_image']; ?>">
								  <span class="xp-user-live"></span>
								 </a>
								  <ul class="dropdown-menu small-menu">
								     <li><a href="_admin-profile.php">
									 <span class="material-icons">person_outline</span>
									 Profile
									 </a></li>
									 <!-- <li><a href="#">
									 <span class="material-icons">settings</span>
									 Settings
									 </a></li> -->
									 <li><a href="_admin-login.php">
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
				    <h4 class="page-title">Drivers</h4>
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
							    <h2 class="ml-lg-2">Manage  Users</h2>
							 </div>
					     </div>
					   </div>
					   
					<table class="table table-striped table-hover" id="myTable">
					    <thead>
						    <tr>
							<!--<th><span class="custom-checkbox">
							<input type="checkbox" id="selectAll">
							<label for="selectAll"></label></th>-->
							<th scope="col">ID</th></th>
                            <th scope="col">Name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Password</th>
                            <th scope="col">Email</th>
                            <th scope="col">Contact Number</th>
                            <th scope="col">Register Date</th>
                            <th scope="col">Picture</th>
							<th scope="col">Legal ID</th>
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
                            
                            $sql = "SELECT * FROM user";
                            $result =$connection->query($sql);

                            if (!$result){
                                die("Invalid Query: " . $connection->error);
                            }

                            while($row = $result->fetch_assoc()) {
                                $id=$row["user_id"];
                                $fullname=$row["fullname"];
                                $username=$row["user_name"];
                                $passwords=$row["pass_word"];
                                $email=$row["email"];
                                $contact=$row["contact_num"];
                                $regdate=$row["register_date"];
                                $pic=$row["pic_ID"];
								$legalid=$row["legal_id"];
                            ?>

                            <tr>     
                                <td><?php echo $id?></td>
                                <td><?php echo $fullname?></td>
                                <td><?php echo $username?></td>
                                <td class="content_td"><?php echo $passwords?></td>
                                <td><?php echo $email?></td>
                                <td><?php echo $contact?></td>
                                <td><?php echo $regdate?></td>
								<?php echo "<td><img height='150' width='150' id='image1' src='/images/user/{$row['pic_ID']}' onclick='imageClicked(\"/images/user/{$row['pic_ID']}\")'></td>";?>
								<?php echo "<td><img height='150' width='250' id='image2' src='/images/legal_id/{$row['legal_id']}' onclick='imageClicked(\"/images/legal_id/{$row['legal_id']}\")'></td>";?>
								
                                <td>

								<!-- <div class="row">
								<form action="_manage-users2.php" class="d-inline" >
                                	<button type="button" name="conf_button" id="conf_button" class="btn btn-success conf_button mr-2" data-bs-toggle="modal" data-bs-target="#editEmployeeModal" >
										<i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
									</button>
                                </form> -->

								<form action="_manage-users2.php" class="d-inline">
                                    <button type="button" name="del_button" id="del_button" class="btn btn-danger del_button btn-sm" data-bs-toggle="modal" data-bs-target="#deleteEmployeeModal">
									<i class="material-icons" data-toggle="tooltip" title="Edit">&#xE872;</i>
									</button>
                                </form>

								

                                </td>
                            </tr>
                        <?php
                        ;}
                               
                        ?>
							 
						  </tbody>		      
					   </table> 
					</div>
				</div>
									   
				   <!----edit-modal start--------->


<div class="modal fade" tabindex="-1" id="editEmployeeModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Driver Information</h5>
        <button type="button" class="close mr-3 my-2" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

		<form method="POST" enctype="multipart/form-data">
			<input type="hidden" id="user_id1" name="user_id1"  />

			<div class="form-group">
				<label>First Name</label>
				<input type="text" class="form-control" autocomplete="off" name="fullname1" id="fullname1" <?php echo $fullname; ?>" readonly>
			</div>

			<div class="form-group">
				<label>Username</label>
				<input type="text" class="form-control" autocomplete="off" name="username1" id="username1" <?php echo $username; ?>" readonly>
			</div>

			<div class="form-group">
				<label>Password</label>
				<input type="text" class="form-control" autocomplete="off" name="password1" id="password1" <?php echo $passwords; ?>" readonly>
			</div>

			<div class="form-group">
				<label>Email</label>
				<input type="text" class="form-control" autocomplete="off" name="email1" id="email1" <?php echo $email; ?>" readonly>
			</div>

			<div class="form-group">
				<label>Contact Number</label>
				<input type="text" class="form-control" autocomplete="off" name="contact1" id="contact1" <?php echo $contact; ?>" readonly>
			</div>

			<div class="form-group">
				<label>Register Date</label>
				<input type="text" class="form-control" autocomplete="off" name="regdate1" id="regdate1" <?php echo $regdate; ?>" readonly>
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
        <h5 class="modal-title">Delete User</h5>
        <button type="button" class="close mr-3 mt-2" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

	<form method="POST" class="d-inline">
		
    	<div class="modal-body">

			<input type="hidden" id="user_id2" name="user_id2"/>

        	<p>Are you sure you want to delete this Record</p>
			<p class="text-danger"><medium>this action Cannot be Undone</medium></p>
    	</div>

    	<div class="modal-footer">
	  		<button type="submit" name="removeUser" id="removeUser" class="btn btn-success">Delete</button>
        	<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
		</div>

	</form>

    </div>
  </div>
</div>

					   <!----edit-modal end--------->   
					   <div id="myModal" class="modal">
                        <div class="modal-content modals">
                            <span class="close" onclick="closeModal()">&times;</span>
                            <!-- <p id="modalContent"></p> -->
                            <img id="modalImage" src="" alt="Image">
                        </div>
                    </div>

					<div id="myModal1" class="modal">
                        <div class="modal-content modals">
                            <span class="close" onclick="closeModal()">&times;</span>
                            <!-- <p id="modalContent"></p> -->
                            <img id="modalImage1" src="" alt="Image">
                        </div>
                    </div>


					
					
				 
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


<script>
	$(document).ready(function() {
		$.noConflict();
		$('#myTable').dataTable();
	});
</script>



<script>
		$(document).ready(function(){

			$('.del_button').click(function(e){
					
				$('#deleteEmployeeModal').modal('show');

					$tr=$(this).closest('tr');

					var data = $tr.children("td").map(function(){
						return $(this).text();
					}).get();

					console.log(data);

					$('#user_id2').val(data[0]);
				
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

			$('.del_button').click(function(e){
					// $('#editEmployeeModal').modal('show');

					$tr=$(this).closest('tr');

					var data = $tr.children("td").map(function(){
						return $(this).text();
					}).get();

					console.log(data);

					$('#user_id1').val(data[0]);
					$('#fullname1').val(data[1]);
					$('#username1').val(data[2]);
					$('#password1').val(data[3]);
					$('#email1').val(data[4]);
					$('#contact1').val(data[5]);
					$('#regdate1').val(data[6]);
				
			});
		});
  </script>
  
  <script>
        function checkDelete(){
            return confirm('Are you sure you want to delete this record?');
        }
	</script>


<script>
    function imageClicked(imageUrl) {
        var modal = document.getElementById("myModal");
        var modalImage = document.getElementById("modalImage");

        modalImage.src = imageUrl;
     

        modalImage.style.width = "600px";
        modalImage.style.height = "500px";
        // Display the modal
        modal.style.display = "block";
    }

    function closeModal() {
        // Get a reference to the modal
        var modal = document.getElementById("myModal");

        // Close the modal by hiding it
        modal.style.display = "none";

        modalImage.src = "";
        modalImage.style.width = "auto";
        modalImage.style.height = "auto";
    }
    </script>


<!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
// Function to fetch and display notifications
function fetchNotifications() {
    $.ajax({
        url: 'fetch_notifications.php', // Create a new PHP file to handle fetching notifications
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            var notificationDropdown = $('.dropdown-notif'); // Replace with the appropriate selector for your dropdown

            // Clear existing notifications
            notificationDropdown.empty();

            // Loop through the fetched notifications and add them to the dropdown
			if (data.length === 0) {
                var noNotificationsItem = '<li><a href="#">No notifications</a></li>';
                notificationDropdown.append(noNotificationsItem);
            } else {
            $.each(data, function (index, notification) {
                var notificationItem = '<li><a href="#" class="notification-link" data-notification-id="' + notification.notification_id + '" data-account-type="' +notification.account_type + '">' + notification.message + '</a></li>';
                notificationDropdown.append(notificationItem);
            });
		}

		$('.notification').text(data.length);

			$('.notification-link').click(function (event) {
                    event.preventDefault();
                    var notificationId = $(this).data('notification-id');
                    var accountType = $(this).data('account-type');

                    // Determine the URL to redirect to based on the account type
                    var redirectUrl = accountType === 'customer' ? '_manage-users2.php' : '_manage-shops2.php';

                    // Redirect to the appropriate page
                    window.location.href = redirectUrl;

                // Send an AJAX request to mark the notification as read
                $.ajax({
                        url: 'delete_notification.php',
                        type: 'POST',
                        data: { notification_id: notificationId },
                        success: function (response) {
                            if (response === 'success') {
                                console.log('Notification deleted successfully.');
                            } else {
                                console.error('Error deleting notification.');
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('AJAX request failed:', error);
                        }
                });
            });
        }
    });
}

// Call the fetchNotifications function when the page loads
$(document).ready(function () {
    fetchNotifications();

    // Set an interval to periodically fetch notifications (e.g., every 5 seconds)
    setInterval(fetchNotifications, 5000);
});

</script>

  </body>
  
  </html>


