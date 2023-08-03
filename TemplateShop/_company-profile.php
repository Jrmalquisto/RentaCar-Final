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
$id = $res['seller_id'];
$shopname = $res['shopname'];
$username = $res['username'];
$address = $res['address'];   
$email = $res['email'];  
$contact= $res['contact_num'];
$image = $res['shop_logo'];
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <title>Dashboard</title>
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


	   <!--google material icon-->
      <link href="https://fonts.googleapis.com/css2?family=Material+Icons"rel="stylesheet">

  </head>
  <body>

<form action="" method="post" enctype='multipart/form-data'>

	<div class="mt-6 mb-6">

	<?php
	if(isset($_POST['update_shop'])){
		$shopname=$_POST['shopname'];
		$username=$_POST['username'];  
		$address=$_POST['address'];
		$email=$_POST['email'];
		$contact=$_POST['contact_num'];

		$folder='../images/shop/';

		$file = $_FILES['logo_SHOP']['tmp_name'];
		$file_name = $_FILES['logo_SHOP']['name'];
		$file_name_array = explode(".", $file_name); 
			$extension = end($file_name_array);
	
		$new_image_name ='Logo_'.rand() . '.' . $extension;
		if ($_FILES["logo_SHOP"]["size"] >10000000) {
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
			  	$stmt = mysqli_query($con,"SELECT shop_logo FROM seller WHERE seller_id='$com_id'");
			  	$row = mysqli_fetch_array($stmt); 
			  	$deleteimage=$row['shop_logo'];
				unlink($folder.$deleteimage);
				move_uploaded_file($file, $folder . $new_image_name); 
				mysqli_query($con,"UPDATE seller SET shop_logo='$new_image_name' WHERE seller_id='$com_id'");
			}
		  
			 $result = mysqli_query($con,"UPDATE seller SET shopname='$shopname', username='$username', address='$address', email='$email', contact_num='$contact' WHERE seller_id='$com_id'");
			 
			 if($result){
				//$_SESSION['status'] = "Your profile has been updated";
		 		header("location:/TemplateShop/_company-profile.php?status=Your profile has been updated");
			 } else {
			  	$error[]='Something went wrong';
			 }
  
	  }
	}
	?>

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

		  <li class="dropdown">
		  <a  href="_manage-cars2.php">
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

		  <li class="drivers">
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
								  <img style="width:40px; height:auto;" src="../images/shop/<?php echo $res['shop_logo']; ?>">
								  <span class="xp-user-live"></span>
								 </a>
								  <ul class="dropdown-menu small-menu">
								     <li><a href="#">
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
				    <h4 class="page-title">Profile</h4>
					
					<!--<ol class="breadcrumb">
					  <li class="breadcrumb-item"><a href="#">Vishweb</a></li>
					  <li class="breadcrumb-item active" aria-curent="page">Dashboard</li>
					</ol>-->
				 </div>
				 
				 
			 </div>
		  </div>
		  <!------top-navbar-end-----------> 

		<?php if(isset($_GET['status'])) { ?>
			<div class="alert alert-warning alert-dismissible fade show center-block d-block text-center erralert" role="alert">
					<strong>Success!</strong> <?php echo $_GET['status']; ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close" onClick="alertclose()"> <span aria-hidden="true">&times;</span>
					</button>
				</div>
		<?php }  ?>


          <div class="col-10 color_right mx-auto">
				<div class="p-5 py-5">
				
					<div class="row">
					<div class="col-6 d-flex justify-content-between align-items-center mt-3 mb-3">
						<h4 class="text-left d-flex justify-content-start">Shop Profile</h4>
					</div>	

					<div class="col-6 d-flex justify-content-end align-items-center btnchange">
					<label for="update">
							<div class="btn text-center passbtn">
								<input id="update" type="button" value="Change Password" onClick="changepass()"/>
							</div>
						</label>
						</div>
					</div>


					<div class="row mt-2 border-top">
					<form action="" method="post" enctype="multipart/form-data">
						<input type="hidden"  name="shops" value="<?php echo $com_id;?>">

						<div class="mt-3 col-md-6"><label class="labels" style="font-size: 17px;">Shop Name</label>
							<input type="text" class="form-control" autocomplete="off" name="shopname" id="shopname" value="<?php echo $shopname;?>">
						</div>
						 
						<div class="mt-3 col-md-6"><label class="labels" style="font-size: 17px;">Username</label>
							<input type="text" class="form-control" autocomplete="off" name="username" id="username" value="<?php echo $username;?>">
						</div>
						
						<div class="mt-3 col-md-6"><label class="labels" style="font-size: 17px;">Address</label>
							<input type="text" class="form-control" autocomplete="off" name="address" id="address" value="<?php echo $address;?>">
						</div>

						<div class="mt-3 col-md-6"><label class="labels" style="font-size: 17px;">Email</label>
							<input type="text" class="form-control" autocomplete="off" name="email" id="email" value="<?php echo $email;?>">
						</div>

						<div class="mt-3 col-md-6 mb-4"><label class="labels" style="font-size: 17px;">Contact Number</label>
							<input type="text" class="form-control" autocomplete="off" name="contact_num" id="contact_num" value="<?php echo $contact;?>">
						</div>

						<div class="form-group col-6 mt-3">
							<label for="logo_SHOP" style="font-size:17px; font-weight:400;">Please upload Shop logo</label><br>
							<input class="form-control" type="file" name="logo_SHOP" id="logo_SHOP" style="width:100%;" >
							<br>
							<label>File size: maximum 10 MB</label>
							<label>File extension: .JPEG, .PNG, .JPG</label>
        				</div>
						
						
					</div>
					
					<div class="border-top d-flex justify-content-start btn1" id="buttonUp">
						<br>
						<label for="update_shop">
							<div class="btn mt-4 col-md-2 text-center profile-button">
							<button type="submit" name="update_shop" id="update_shop" class="btn btn-success">Update</button>
							</div>
						</label>
					</div>
				</form>
			</div>
		</div>
					

<!----edit-modal end--------->   

    </div>
</div>
		  
<!------main-content-end-----------> 
		  
		 
		 
<!----footer-design------------->	 
	  </div>
   
</div>
<!-------complete html----------->

  
     <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="/js/jquery-3.3.1.slim.min.js"></script>
   <script src="/js/popper.min.js"></script>
   <script src="/js/bootstrap.min.js"></script>
   <script src="/js/jquery-3.3.1.min.js"></script>
  
  
  <script type="text/javascript">
       $(document).ready(function(){
	      $(".xp-menubar").on('click',function(){
		    $("#sidebar").toggleClass('active');
			$("#content").toggleClass('active');
		  });
		  
		  $('.xp-menubar,.body-overlay').on('click',function(){
		     $("#sidebar,.body-overlay").toggleClass('show-nav');
		  });
		  
	   });
  </script>

<script>
	function changepass(){
		window.location.href="_company-change-pass.php";
	}
</script>

<script>
	function alertclose(){
		window.location.href="_company-profile.php";
	}
</script>


  </form>

  
  </body>
  
  </html>


