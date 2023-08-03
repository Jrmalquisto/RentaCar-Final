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
  


<div class="wrapper">

<form action="" method="post" enctype='multipart/form-data'/>

	  <div class="body-overlay"></div>
	 
	 <!-------sidebar--design------------>
	 
	 <div id="sidebar">
	    <div class="sidebar-header">
		   <h3><img style="width:40px; height:auto;"  src="../images/shop/<?php echo $res['shop_logo']; ?>"><span>RentaCar</span></h3>
		</div>
		<ul class="list-unstyled component m-0">
		  <li class="active">
		  <a href="#" class="dashboard"><i class="material-icons">dashboard</i>Dashboard </a>
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
							   <li class="dropdown nav-item" >
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
				    <h4 class="page-title">Dashboard</h4>
					<!--<ol class="breadcrumb">
					  <li class="breadcrumb-item"><a href="#">Vishweb</a></li>
					  <li class="breadcrumb-item active" aria-curent="page">Dashboard</li>
					</ol>-->
				 </div>
				 
				 
			 </div>
		  </div>
		  <!------top-navbar-end-----------> 

		  <!------boxes-start-----------> 
		  <div class="boxes">

		<a href="/TemplateShop/_manage-cars2.php">
		<div class="col-div-4">
		<div class="box">
		<p>
			<?php
            $con = new mysqli("localhost", "root", "", "rentacar");
            $query = "SELECT item_id FROM product WHERE seller_id=$com_id";
            $result = mysqli_query($con, $query);
            $row = mysqli_num_rows($result);echo '' .$row. '';
            ?><br/>
			<i class="fa fa-car box-icon px-3" id="boxIcon1"></i>
			</p>
            <span>Registered Vehicles</span>
		</div>
		</div>
		</a>

		<a href="/TemplateShop/_pending-reservations2.php">
		<div class="col-div-4">
		<div class="box">
        <p><?php
            $con = new mysqli("localhost", "root", "", "rentacar");
            $query = "SELECT id FROM reservation WHERE status='Pending'";
            $result = mysqli_query($con, $query);
            $row = mysqli_num_rows($result);echo '' .$row. '';
            ?><br/>
			<i class="fa fa-list box-icon px-3" id="boxIcon2"></i>
			</p>
            <span>Pending Reservations</span>
		</div>
		</div>
		</a>

		<a href="/TemplateShop/_manage-reservations2.php">
		<div class="col-div-4">
		<div class="box">
        <p><?php
            $con = new mysqli("localhost", "root", "", "rentacar");
            $query = "SELECT id FROM reservation WHERE status='Reserved'";
            $result = mysqli_query($con, $query);
            $row = mysqli_num_rows($result);echo '' .$row. '';
            ?><br/>
			<i class="fa fa-list box-icon px-3" id="boxIcon2"></i>
			</p>
            <span>Approved Reservations</span>
		</div>
		</div>
		</a>
	
		<a href="/TemplateShop/_manage-to-be-returned2.php">
		<div class="col-div-4">
		<div class="box">
        <p><?php
            $con = new mysqli("localhost", "root", "", "rentacar");
            $query = "SELECT id FROM reservation WHERE status='In Use'";
            $result = mysqli_query($con, $query);
            $row = mysqli_num_rows($result);echo '' .$row. '';
            ?><br/>
			<i class="fa fa-rotate-left box-icon px-3" id="boxIcon3"></i>
			</p>
            <span>Cars to be Returned</span>
		</div>
		</div>
		</a>

		<a href="/TemplateShop/_manage-drivers2.php">
		<div class="col-div-4">
		<div class="box">
    	<p><?php
            $con = new mysqli("localhost", "root", "", "rentacar");
            $query = "SELECT driver_id FROM drivers WHERE seller_id=$com_id";
            $result = mysqli_query($con, $query);
            $row = mysqli_num_rows($result);echo '' .$row. '';
            ?><br/>
			<i class="fa fa-user box-icon px-3" id="boxIcon"></i>
			</p>
            <span>Registered Drivers</span>
		</div>
		</div>
		</a>

		<a href="/TemplateShop/_manage-sales2.php">
		<div class="col-div-4">
		<div class="box">
    	<p><?php
            $con = new mysqli("localhost", "root", "", "rentacar");
            $query = "SELECT id FROM salesreport WHERE seller_id=$com_id";
            $result = mysqli_query($con, $query);
            $row = mysqli_num_rows($result);echo '' .$row. '';
            ?><br/>
			<i class="fa fa-user box-icon px-3" id="boxIcon"></i>
			</p>
            <span>Completed Transactions</span>
		</div>
		</div>
		</a>

		</div>
	<!------boxes-end-----------> 

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
  
  


  </form>
  </body>
  
  </html>


