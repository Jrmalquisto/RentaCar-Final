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
                            <a href="../profile.php" class="nav-item nav-link has-icon nav-link-faded">
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
                            <a href="#" class="nav-item nav-link has-icon nav-link-faded active">
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
                                <a href="../profile.php" class="nav-item nav-link has-icon nav-link-faded">
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
                                <a href="#" class="nav-item nav-link has-icon nav-link-faded active">
                                    <i class="fa-solid fa-lock" style="font-size: 25px;"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body tab-content">
                        <div class="tab-pane active" id="profile">
                            <h6 style="font-size:25px;">SECURITY SETTINGS</h6>
                            <hr style="border-top: 1px solid #000">
                            <form action="" method="post" enctype='multipart/form-data'>

                                <?php if(isset($_GET['error'])) { ?>
                                <div class="alert alert-warning alert-dismissible fade show center-block text-center"
                                    role="alert">
                                    <strong>Error!</strong> <?php echo $_GET['error']; ?>
                                    <a href="../password.php">
                                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"
                                        id="closebtn"> <span aria-hidden="true">&times;</span>
                                    </button>
                                    </a>
                                </div>
                                <?php 
                                    unset($_GET['status']);
                                    } 
                                ?>

                                <?php if(isset($_GET['status'])) { ?>
                                <div class="alert alert-warning alert-dismissible fade show center-block" role="alert">
                                    <strong>Success!</strong> <?php echo $_GET['status']; ?>
                                    <a href="../password.php">
                                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"
                                        id="closebtn"> <span aria-hidden="true">&times;</span>
                                    </button>
                                    </a>
                                </div>
                                <?php 
                                    unset($_GET['status']);
                                    } 
                                ?>

                                <div class="row">
                                    <div class="form-group">
                                        <label class="d-block">Change Password</label>
                                        <input type="hidden" name="user_id" value="<?php echo $id;?>">
                                        <input type="text" name="current_password" class="form-control" autocomplete="off" placeholder="Enter old password">
                                        <input type="text" name="new_password" class="form-control mt-1" autocomplete="off" placeholder="Enter new password">
                                        <input type="text" name="confirm_password" class="form-control mt-1" autocomplete="off" placeholder="Confirm new password">

                                        <hr style="border-top: 1px solid #000">
                                        <label class="float-right" for="update">
                                            <div class="btn text-center btn-success ">
                                                <input style="font-size:17px; color: #fff;" id="change" type="submit" value="Change Password" name="change_pass">
                                            </div>
                                        </label>
                                        <!-- <button type="reset" class="btn btn-light">Reset Changes</button> -->

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">

    </script>
</body>

</html>