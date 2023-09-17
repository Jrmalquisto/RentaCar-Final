<?php 
// session_start();
$servername = "localhost";
$user = "root";
$password = "";
$database = "rentacar";
$con = new mysqli($servername, $user, $password, $database);

$com_id=$_SESSION["com_id"];

// include ('../connection.php');

// $findresult = mysqli_query($con, "SELECT * FROM seller WHERE seller_id= '$com_id'");
// // if($res = mysqli_fetch_array($findresult)){
// 	$image = $res['shop_logo'];
// // 	$verified = $res['verified'];
// // }
// ?>

<!-- <!DOCTYPE html>
<html lang="en">
<head> -->
    <!-- Required meta tags -->
    <!-- <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <title>Cars</title> -->
	    <!-- Bootstrap CSS -->
        <!-- <link rel="stylesheet" href="/css/bootstrap.min.css"> -->
	    <!----css3---->
        <!-- <link rel="stylesheet" href="/css/custom.css"> -->
		
		
		<!--google fonts -->
	    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
	 -->
<!-- 	
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
		<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" /> -->


	   <!--google material icon-->
      <!-- <link href="https://fonts.googleapis.com/css2?family=Material+Icons"rel="stylesheet">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> 
	  <script src="/js/bootstrap.min.js"></script> -->
  <!-- </head>
  <body> -->
  



	<!-------page-content start----------->
	
	

	<!-- <div class="alert alert-warning alert-dismissible fade show center-block d-block text-center erralert" role="alert">
				<strong>Error!</strong> <?php echo $_GET['error']; ?>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close" onClick="alertclose()"> <span aria-hidden="true">&times;</span>
				</button>
	</div> -->

	<div class= "container my-5">
		<div class="card text-center">
			<div class="card-header">
				Verification in Progress
			</div>
			<div class="card-body">
				<h5 class="card-title">Your account is being verified</h5>
				<p class="card-text p-5" style="text-transform:none;">The process may take a few days. We will notify you the results. If we're unable
					to verify your account, you'll need to resubmit your documents again. Thank you.
				</p>
				<a href="../TemplateShop/.dashboardCompany.php" class="btn btn-primary" style="text-transform:uppercase;">Got it</a>
			</div>
			<div class="card-footer text-body-secondary">
				2 days ago
			</div>
		</div>
	</div>

