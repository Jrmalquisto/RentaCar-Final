<?php
session_start();
$servername = "localhost";
$user = "root";
$password = "";
$database = "rentacar";

$connection = new mysqli($servername, $user, $password, $database);

$id=$_GET['updateCompany'];

$sql="SELECT * FROM seller WHERE seller_id=$id";
$result=mysqli_query($connection,$sql);
$row=mysqli_fetch_assoc($result);
$id=$row['seller_id'];
$name=$row['shopname'];
$address=$row['address'];
$verify=$row['verified'];
$date=$row['register_date'];

if(isset($_POST['update'])){
    $name=$_POST['shopname'];
    $address=$_POST['address'];
    $verify=$_POST['verified'];



    $sql = "UPDATE seller SET shopname='$name', address='$address', verified='$verify' WHERE seller_id=$id";
        $result=$connection->query($sql);
        
        if($result){
             echo "updated successfully";
             header('location:../TemplateAdmin/_manage-companies.php');
        }else{
             die("Invalid Query: " . $connection->error);

}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentaCar</title>
    
    <!--Bootstrap CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    

    <!-- CSS File -->
    <link rel="stylesheet" href="admin_style.css">

</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 text-dark fs-4 fw-bold text-uppercase border-bottom"><i
                    class="fas me-2"></i>RentaCar</div>
            <div class="list-group list-group-flush my-3">
                <a href="_header_admin.php" class="list-group-item list-group-item-action bg-transparent text-dark active"><i class="fas me-2"></i>Dashboard</a>
                <a href="_manage-companies.php" class="list-group-item list-group-item-action bg-transparent text-dark fw-bold"><i class="fas me-2"></i>Company Management</a>
                <a href="_manage-users.php" class="list-group-item list-group-item-action bg-transparent text-dark fw-bold"><i class="fas me-2"></i>Users List</a>

            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left text-white fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0 text-white">Car Management</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i><?php echo $_SESSION['shopname'] ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li><a class="dropdown-item" href="_admin-login.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluidx px-4 py-5">
            <h3 class="fs-4 mb-0 text-white">Update Car Information</h3>

            <section class="container my-5 bg-dark w-60 text-light" id="ReserveContainer">
                <form method="post" class="row">

            <div class="row">
                <div class="col-md-6" id="label2">
                        <label for="validationDefault02" class="form-label">Shop Name</label>
                            <input type="text" class="form-control" name="shopname" value="<?php echo $name;?>">
                    </div>

                    <div class="col-md-6" id="label2">
                        <label for="validationDefault01" class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" value="<?php echo $address;?>">
                    </div>

                    <!-- <div class="row">
                    <div class="form-group mb-5 border-bottom-0 col-6 mt-5">
                        <label for="pic_ID" style="font-size:20px; font-weight:bold;">Upload Photo of DTI Registration</label><br>
                        <input type="file" class="form-control-file mt-3" id="pic_ID" name="pic_ID">
                    </div>
                    
                    
                    <div class="form-group mb-5 border-bottom-0 col-6 mt-5">
                        <label for="pic_ID" style="font-size:20px; font-weight:bold;">Upload Photo of Business Permit</label><br>
                        <input type="file" class="form-control-file mt-3" id="pic_ID" name="pic_PROFILE">
                    </div>
                    </div> -->

                    <div class="col-md-6" id="label2">
                        <label for="validationDefault02" class="form-label">Access Control</label>
                            <input type="text" class="form-control" name="verified" value="<?php echo $verify;?>">
                    </div>

                    <div class="col-md-6" id="label2">
                        <label for="validationDefault02" class="form-label">Register Date</label>
                            <input type="text" class="form-control" name="register_date" value="<?php echo $date;?>" readonly>
                    </div>
                    
                    

                    
      
                    <div class="col-12">
                        <a type="submit" name="update" class="btn6 btn-primary font-size-20 px-4">Update</a>
                        <a type="submit" class="btn5 btn-danger font-size-20 px-4" href="_manage-companies.php">Cancel</a>
                    </div>
        </div>     
    </form>
</section>

            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
</body>

</html>