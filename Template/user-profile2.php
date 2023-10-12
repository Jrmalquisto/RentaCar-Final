<?php

ob_start();

include ('connection.php');

$id=$_SESSION["user_id"];

$findresult = mysqli_query($con, "SELECT * FROM user WHERE user_id= '$id'");
if($res = mysqli_fetch_array($findresult)) {
	
$id = $res['user_id'];
$fullname = $res['fullname'];
$username =$res['user_name'];
$oldusername =$res['user_name'];
$email = $res['email'];   
$phonenumber = $res['contact_num'];  
$image= $res['pic_ID'];
}

?>

	
<?php
	if(isset($_POST['update_prof'])){
		$fullname=$_POST['fullname'];
		$username=$_POST['user_name'];  
		$email=$_POST['email'];
		$phonenumber=$_POST['contact_num'];


		$folder='images/user/';

		$file = $_FILES['image']['tmp_name'];  
		$file_name = $_FILES['image']['name']; 
		$file_name_array = explode(".", $file_name); 
		$extension = end($file_name_array);

		$new_image_name ='profile_'.rand() . '.' . $extension;
		if ($_FILES["image"]["size"] >10000000) {
		$error[] = 'Sorry, your image is too large. Upload less than 10 MB in size .';
		}

		if($file != ""){
			if($extension!= "jpg" && $extension!= "png" && $extension!= "jpeg"
			&& $extension!= "gif" && $extension!= "PNG" && $extension!= "JPG" && $extension!= "GIF" && $extension!= "JPEG"){
				$error[] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed';   
			}
		}

		$sql="SELECT * from user where user_id='$id'";
			$res=mysqli_query($con,$sql);
		if (mysqli_num_rows($res) > 0) {
			$row = mysqli_fetch_assoc($res);

			if($oldusername!=$username){
				if($username==$row['user_name']){
					$error[] ='User_name alredy Exists. Create Unique user_name';
				} 
			}
		}

		if(!isset($error)){ 
			if($file!= ""){
			  	$stmt = mysqli_query($con,"SELECT pic_ID FROM  user WHERE user_id='$id'");
			  	$row = mysqli_fetch_array($stmt); 
			  	$deleteimage=$row['pic_ID'];
				unlink($folder.$deleteimage);
				move_uploaded_file($file, $folder . $new_image_name); 
				mysqli_query($con,"UPDATE user SET pic_ID='$new_image_name' WHERE user_id='$id'");
			}
			 $result = mysqli_query($con,"UPDATE user SET fullname='$fullname', user_name='$username', email='$email', contact_num='$phonenumber' WHERE user_id='$id'");
			 if($result){
		 		header("location: profile.php?status=Your profile has been updated");
			 } else {
			  	$error[]='Something went wrong';
			 }
  
	  }
	}
	if(isset($error)){ 

		foreach($error as $error){ 
		  echo '<p class="errmsg">'.$error.'</p>'; 
		}
	}
	?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">


    <title>Profile settings - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="Template/user-profile2.css">


</head>

<body>
<form action="" method="post" enctype='multipart/form-data'>
    <div class="container">

        <!-- <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
            </ol>
        </nav> -->

        <div class="row gutters-sm">
            <div class="col-md-4 d-none d-md-block">
                <div class="card">
                    <div class="card-body">
                        <nav class="nav flex-column nav-pills nav-gap-y-1">
                            <div class="profile">
                                <div class="text-center">

                                <?php if($image==NULL){
                                        echo '<img src="assets/user_profile/profile.png" style="width: 200px; height:auto;" class="rounded-circle mt-5">';
                                    } else { 
                                        echo '<img src="images/user/'.$image.'" style=" width: 200px; height:auto;" class="avatar img-circle img-thumbnail mb-2">';
                                    }
                                ?>
                                    <div class="div d-flex justify-content-center">
                                        <div class="row">
                                            <h5><?php echo $fullname?></h5>
                                            <h6 style="color:#0096FF"><?php echo $email?></h6>
                                        </div>
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #000">
                            
                            </div>
                            <a href="#" class="nav-item nav-link has-icon nav-link-faded active">
                                <i class="fa-solid fa-user mr-2" style="font-size: 25px;"></i>Profile Information
                            </a>
                            <a href="../userreservation.php" class="nav-item nav-link has-icon nav-link-faded">
                                <i class="fa-solid fa-calendar-check mr-2" style="font-size: 25px;"></i>My Reservations
                            </a>
                            <a href="../in_use.php" class="nav-item nav-link has-icon nav-link-faded">
                                <i class="fa-solid fa-key mr-2" style="font-size: 25px;"></i>My Rented Cars
                            </a>
                            <a href="../completed_trans.php" class="nav-item nav-link has-icon nav-link-faded">
                                <i class="fa-solid fa-file-invoice-dollar mr-2" style="font-size: 25px;"></i>Completed
                                Transactions
                            </a>
                            <a href="../password.php" class="nav-item nav-link has-icon nav-link-faded">
                                <i class="fa-solid fa-lock mr-2" style="font-size: 25px;"></i>Security
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header border-bottom mb-3 d-flex d-md-none">
                        <ul class="nav nav-tabs card-header-tabs nav-gap-x-1" role="tablist">
                            <li class="nav-item">
                                <a href="../profile.php" class="nav-item nav-link has-icon nav-link-faded active">
                                    <i class="fa-solid fa-user" style="font-size: 25px;"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../userreservation.php" class="nav-item nav-link has-icon nav-link-faded">
                                    <i class="fa-solid fa-calendar-check" style="font-size: 25px;"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../in_use.php" class="nav-item nav-link has-icon nav-link-faded">
                                    <i class="fa-solid fa-key" style="font-size: 25px;"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../completed_trans.php" class="nav-item nav-link has-icon nav-link-faded">
                                    <i class="fa-solid fa-file-invoice-dollar" style="font-size: 25px;"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../password.php" class="nav-item nav-link has-icon nav-link-faded">
                                    <i class="fa-solid fa-lock mr-2" style="font-size: 25px;"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body tab-content">
                        <div class="tab-pane active" id="profile">
                            <h6 style="font-size:25px;">PROFILE INFORMATION</h6>
                            <hr style="border-top: 1px solid #000">
                            

                                <?php if(isset($_GET['status'])) { ?>
                                <div class="alert alert-warning alert-dismissible fade show center-block" role="alert">
                                    <strong>Success!</strong> <?php echo $_GET['status']; ?>
                                    <a href="../profile.php">
                                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"
                                        id="closebtn"> <span aria-hidden="true">&times;</span>
                                    </button>
                                    </a>
                                </div>
                                <?php 
                                    unset($_GET['status']);
                                    } 
                                ?>
                                    <div class="text-center mb-4">

                                    <?php if($image==NULL){
                                            echo '<img src="assets/user_profile/profile.png" style="width: 200px; height:auto;" class="rounded-circle mt-5">';
                                        } else { 
                                            echo '<img src="images/user/'.$image.'" style=" width: 200px; height:auto;" class="avatar img-circle img-thumbnail mb-2">';
                                        }
                                    ?>
                                        
                                        <h6>Upload a different photo...</h6>
                                        <div class="div d-flex justify-content-center">
                                        <input type="file" name="image" class="form-control" style="width: 300px;">
                                        </div>
                                    </div>

                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="fullname">Full Name</label>
                                        <input type="text" class="form-control" name="fullname" id="fullname"
                                            aria-describedby="fullNameHelp" autocomplete="off"
                                            placeholder="Enter your fullname" value="<?php echo $fullname;?>">

                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label for="user_name">Username</label>
                                        <input type="text" class="form-control" name="user_name" id="user_name"
                                            aria-describedby="fullNameHelp" autocomplete="off"
                                            placeholder="Enter your fullname" value="<?php echo $username;?>">
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" name="email" id="email"
                                            aria-describedby="fullNameHelp" autocomplete="off"
                                            placeholder="Enter your fullname" value="<?php echo $email;?>">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="contact_num">Contact Number</label>
                                        <input type="text" class="form-control" name="contact_num" id="contact_num"
                                            aria-describedby="fullNameHelp" autocomplete="off"
                                            placeholder="Enter your fullname" value="<?php echo $phonenumber;?>">
                                    </div>
                                </div>

                                <hr style="border-top: 1px solid #000">
                                <label class="float-right" for="update">
                                    <div class="btn text-center btn-success float-right">
                                        <input style="font-size:17px; color: #fff;" id="update" type="submit"
                                            value="Update Profile" name="update_prof">
                                    </div>
                                </label>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">

    </script>

    <script>
    $(document).ready(function() {
        // $("#shop_btn").click(function() {
        //         $("#shopModal").modal();
        // });

        // const myModal = document.getElementById('shop_btn');
        // const myInput = document.getElementById('shopModal');

        // myModal.addEventListener('shown.bs.modal', () => {
        //     myInput.focus()
        // });
        // import { Modal } from 'bootstrap';
        // export default {
        //     name: 'MyModal',
        //     mounted() { <-- Just right
        //         const myModal = new Modal(document.getElementById('shop_btn'), {})
        //         myModal.show()
        //     }
        // };
        let modal = null;

        function getModal() {
            if (!modal) {
                modal = new $bootstrap.Modal('#shopModal');
            }
            return modal
        }

        function toggleModal() {
            // modal.toggle();
            getModal().show()
        }

        $('.conf_button').click(function(e) {
            // $('#editEmployeeModal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);

            $('#id1').val(data[0]);
            $('#name1').val(data[1]);
            $('#number1').val(data[2]);
            $('#vehicle1').val(data[3]);
            $('#license1').val(data[4]);
            $('#pickup1').val(data[5]);
            $('#return1').val(data[6]);
            $('#price1').val(data[7]);

        });

        let button = document.querySelector('pay');
        let input = document.querySelector('status');
        if (input === "Pending") {
            button.disabled = true;
        }
    });
    </script>
    <!----------------------------------------------PRODUCTS-------------------------------------------------------->


</body>

</html>