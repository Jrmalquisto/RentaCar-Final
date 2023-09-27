<?php

  include ('connection.php');

$id=$_SESSION["user_id"];
  $findresult = mysqli_query($con, "SELECT * FROM user WHERE user_id= '$id'");
	  if($res = mysqli_fetch_array($findresult))
{
$id = $res['user_id'];
$fullname = $res['fullname'];
$username =$res['user_name'];
$oldusername =$res['user_name'];
$email = $res['email'];   
$phonenumber = $res['contact_num'];  
$image= $res['pic_ID'];
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>User Profile</title>
	<link rel="stylesheet" type="text/css" href="style1.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js" rel="stylesheet">
   -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="style1.css">

</head>
<body>
<form action="" method="post" enctype='multipart/form-data'>
	
<?php if(isset($_GET['error'])) { ?>
	<div class="alert alert-warning alert-dismissible fade show center-block text-center" role="alert">
  			<strong>Error!</strong> <?php echo $_GET['error']; ?>
  				<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close" id="closebtn"> <span aria-hidden="true">&times;</span>
  			</button>
		</div>
	<?php } ?>

	<?php if(isset($_GET['status'])) { ?>
	<div class="alert alert-warning alert-dismissible fade show center-block" role="alert">
  			<strong>Success!</strong> <?php echo $_GET['status']; ?>
  				<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close" id="closebtn"> <span aria-hidden="true">&times;</span>
  			</button>
		</div>
	<?php } ?>
	
		<div class="row">
			<div class="col-3 color_left">

			<?php
  				if(isset($_POST['change_pass'])){
				
					$current_password = $_POST['current_password'];
					$new_password = $_POST['new_password'];
					$confirm_password = $_POST['confirm_password'];


				if ($new_password != $confirm_password) {
					header("location: password.php?error=New password and confirm password do not match");
					exit;
				  }
				  
				$sql = "SELECT pass_word FROM user WHERE user_id = '$id'";
				$result = mysqli_query($con, $sql);
								
				if (mysqli_num_rows($result) > 0) {
					$row = mysqli_fetch_assoc($result);
					$current_password_hash = $row["pass_word"];
				} else {
					header("location: password.php?error=User not found");
					exit;
				}
    			
				if (md5($current_password) != $current_password_hash) {
					header("location: password.php?error=Current password is incorrect");
					exit;
				  }
				  

				  $new_password_hash = md5($new_password);

					$sql = "UPDATE user SET pass_word = '$new_password_hash' WHERE user_id = '$id'";

					if (mysqli_query($con, $sql)) {
						header("location: password.php?status=Your password has been updated");
					} else {
					echo "Error updating password: " . mysqli_error($con);
					}

					mysqli_close($con);

				}
				?>
				
				<div class="d-flex flex-column align-items-center text-center p-3 py-1">
						<?php if($image==NULL){
							echo '<img src="assets/user_profile/profile.png" style="height:150px; width: 150px;" class="rounded-circle mt-5">';
						} else { 
							echo '<img src="images/'.$image.'" style="height:150px; width: 150px;" class="rounded-circle mt-5">';
						}
						?>
					<div class="row mt-1"></div>
				<div class="row mt-2"></div>	
					<span class="font-weight-bold"><?php echo $fullname;?></span><span class=><?php echo $email;?></span><span> </span></div>
					<nav class="side-nav navbar">
						<ul style="list-style: none;">
						  <li><a href="index.php" class="nav-link scrollto ml-4"><i class="fa-solid fa-house"></i> <span>Home</span></a></li>
						  <li><a href="profile.php" class="nav-link scrollto ml-4"><i class="fa-solid fa-user"></i> <span>Profile</span></a></li>
						  <li><a href="message.php" class="nav-link scrollto ml-4"><i class="fa-solid fa-message"></i> <span>Message</span></a></li>
						  <li><a href="userreservation.php" class="nav-link scrollto ml-4"><i class="fa-solid fa-calendar-check"></i> <span>My Reservation</span></a></li>
						  <li><a href="in_use.php" class="nav-link scrollto ml-4"><i class="fa-solid fa-key"></i> <span style="padding-left:5px">My Rented Cars</span></a></li>
						  <li><a href="password.php" class="nav-link scrollto ml-4"><i class="fa-solid fa-lock"></i> <span>Change Password</span></a></li>
						</ul>
					</nav>
				</div>
			
				<div class="row col-6 color_right">
					<div class="p-5 py-5">
						<div class="d-flex justify-content-between align-items-center mt-3 mb-3">
							<h4 class="text-right">Change Password</h4>
						</div>

						<div class="row mt-2 border-top">
							<input type="hidden" name="user_id" value="<?php echo $fetch_cart['user_id'];?>">

						<div class="mt-3 col-md-6"><label class="labels" style="font-size: 17px;">Current Password</label>
							<input type="password" class="form-control"  name = "current_password" placeholder="Enter Old Password">
						</div>
						 
						<div class="mt-3 col-md-6"><label class="labels" style="font-size: 17px;">New Password</label>
							<input type="password" class="form-control" name = "new_password" placeholder="Enter New Password">
						</div>
						
						<div class="mt-3 mb-4 col-md-6"><label class="labels" style="font-size: 17px;">Confirm New Password</label>
							<input type="password" class="form-control" name = "confirm_password" placeholder="Confirm New Password">
						</div>

						
						<div class="container border-top" id="buttonUp">
						<br>
						<label for="change">
							<div class="btn col-md-2 text-center password-button">
								<input id="change" type="submit" value="Change Password" name="change_pass">
							</div>
						</label>
						</div>
						
						
						
							</div>
						</div>
					
				</div>
			</div>
		</div>
		</form>
</body>
</html>

