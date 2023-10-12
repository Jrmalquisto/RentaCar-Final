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
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>   <script src="/js/popper.min.js"></script>
   	  <script src="/js/bootstrap.min.js"></script>
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
					<form action="" method="post" enctype="multipart/form-data">

					<div class="image mt-2 border-top text-center ">
					<?php if($image==NULL){
							echo '<img src="images/default/default.png" style="width: 200px; height:auto;" class="rounded-circle mt-5">';
						} else { 
							echo '<img src="../images/shop/'.$image.'" style=" width: 200px; height:auto;" class="avatar img-circle img-thumbnail mb-2 mt-4">';
						}
                    ?>
						<div class="div d-flex justify-content-center">
						<label for="logo_SHOP" style="font-size:17px; font-weight:400;">Please upload Shop logo</label>

						</div>
						<div class="div d-flex justify-content-center">
						<input class="form-control" type="file" name="logo_SHOP" id="logo_SHOP" style="width:300px;" >

						</div>
					</div>

					<div class="row mt-2">

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

  
   
  
  <script type="text/javascript">
       $(document).ready(function(){
	    //   $(".xp-menubar").on('click',function(){
		//     $("#sidebar").toggleClass('active');
		// 	$("#content").toggleClass('active');
		//   });
		  
		//   $('.xp-menubar,.body-overlay').on('click',function(){
		//      $("#sidebar,.body-overlay").toggleClass('show-nav');
		//   });
		  
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

  
<?php 
	include ('../TemplateShop/_company-footer.php');
?>

