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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>   <script src="/js/popper.min.js"></script>
  	<script src="/js/bootstrap.min.js"></script>
  </head>
  <body>
  


<div class="wrapper">

<form action="" method="post" enctype='multipart/form-data'>

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
            $query = "SELECT id FROM reservation WHERE status='Pending' AND seller_id=$com_id";
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
            $query = "SELECT id FROM reservation WHERE status='Reserved' AND seller_id=$com_id";
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
            $query = "SELECT id FROM reservation WHERE status='In Use' AND seller_id='$com_id'";
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
   <!-- <script src="/js/jquery-3.3.1.slim.min.js"></script>
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
  </script> -->
  
  


  </form>

<?php 
	include ('../TemplateShop/_company-footer.php');
?>



