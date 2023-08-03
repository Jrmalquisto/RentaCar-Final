<?php
session_start();

include ('../connection.php');

$com_id=$_SESSION["com_id"];

$findresult = mysqli_query($con, "SELECT * FROM seller WHERE seller_id= '$com_id'");
		  if($res = mysqli_fetch_array($findresult))
  {
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
<form action="" method="post">


<div class="wrapper">



<?php
if(isset($_POST['change_pass'])){

	$current_password = $_POST['current_password'];
	$new_password = $_POST['new_password'];
	$confirm_password = $_POST['confirm_password'];


if ($new_password != $confirm_password) {
	header("location: /TemplateShop/_company-change-pass.php?error=New password and confirm password do not match");
	exit;
	}
	
$sql = "SELECT password FROM seller WHERE seller_id = '$com_id'";
$result = mysqli_query($con, $sql);
				
if (mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$current_password_hash = $row["password"];
} else {
	header("location: /TemplateShop/_company-change-pass.php?error=User not found");
	exit;
}

if (md5($current_password) != $current_password_hash) {
	header("location: /TemplateShop/_company-change-pass.php?error=Current password is incorrect");
	exit;
	}
	

	$new_password_hash = md5($new_password);

	$sql = "UPDATE seller SET password = '$new_password_hash' WHERE seller_id = '$com_id'";

	if (mysqli_query($con, $sql)) {
		header("location: /TemplateShop/_company-change-pass.php?status=Your password has been updated");
	} else {
	echo "Error updating password: " . mysqli_error($con);
	}

	mysqli_close($con);

}
?>

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
								 <img style="width:40px; height:auto;"  src="../images/shop/<?php echo $res['shop_logo']; ?>">
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

		<?php if(isset($_GET['error'])) { ?>
			<div class="alert alert-warning alert-dismissible fade show center-block d-block text-center erralert" role="alert">
					<strong>Error!</strong> <?php echo $_GET['error']; ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close" onClick="alertclose()"> <span aria-hidden="true">&times;</span>
					</button>
				</div>
		<?php } ?>

		<?php if(isset($_GET['status'])) { ?>
			<div class="alert alert-warning alert-dismissible fade show center-block d-block text-center erralert" role="alert">
					<strong>Success!</strong> <?php echo $_GET['status']; ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close" onClick="alertclose()"> <span aria-hidden="true">&times;</span>
					</button>
				</div>
		<?php } ?>

          <div class="col-6 color_right mx-auto">
				<div class="p-5 py-5">
					<div class="d-flex justify-content-between align-items-center mt-3 mb-3">
						<h4 class="text-right">Change Password</h4>
					</div>	

					<div class="row mt-2 border-top">
						<input type="hidden" name="shops" value="<?php echo $_SESSION['shopname'];?>">

						<div class="mt-3 col-md-6"><label class="labels" style="font-size: 17px;">Current Password</label>
							<input type="password" class="form-control"  name = "current_password" placeholder="Enter Old Password">
						</div>
						 
						<div class="mt-3 col-md-6"><label class="labels" style="font-size: 17px;">New Password</label>
							<input type="password" class="form-control" name = "new_password" placeholder="Enter New Password">
						</div>
						
						<div class="mt-3 col-md-6 mb-4"><label class="labels" style="font-size: 17px;">Confirm New Password</label>
							<input type="password" class="form-control" name = "confirm_password" placeholder="Confirm New Password">
						</div>
						
					</div>

					<div class="row">
						<div class="col-6 border-top d-flex justify-content-start btn1">
							<br>
							<label for="change">
								<div class="btn mt-4 col-md-2 text-center password-button">
									<input id="change" type="submit" value="Change Password" name="change_pass">
								</div>
							</label>
						</div>

						<div class="col-6 border-top d-flex justify-content-end btn1">
							<label for="back">
								<div class="btn  mt-4 col-md-2 text-center backbtn">
									<input id="back" type="button" value="Back" onClick="backbtn()" />
								</div>
							</label>
						</div>
					</div>

					
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
	function backbtn(){
		window.location.href="_company-profile.php";
	}
</script>

<script>
	function alertclose(){
		window.location.href="_company-change-pass.php";
	}
</script>

  </form>
  </body>
  
  </html>


