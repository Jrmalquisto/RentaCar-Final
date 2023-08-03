<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentaCar</title>
    
    <!--Bootstrap CDN-->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
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
                <a href="#" class="list-group-item list-group-item-action bg-transparent text-dark fw-bold"><i class="fas me-2"></i>Company Management</a>
                <a href="_manage-users.php" class="list-group-item list-group-item-action bg-transparent text-dark fw-bold"><i class="fas me-2"></i>Users List</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left text-white fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0 text-white">Dashboard</h2>
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
                                <i class="fas fa-user me-2"></i>John Doe
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

            <div class="container-fluid px-4">
            <button onclick="window.location='_manage-reservations-chauffeur.php';" id="seller-login account" type="submit" class="btnadd btn-primary" name="submit">Chauffer Drive</button>
                <div class="row my-5">
                    <h3 class="fs-4 mb-3 text-white">Customers</h3>
                    <div class="col">
                        <table class="table bg-white rounded shadow-sm table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="50">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Contact Number</th>
                                    <th scope="col">Vehicle</th>
                                    <th scope="col">Pick-up Date</th>
                                    <th scope="col">Reutrn Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php
                            $servername = "localhost";
                            $user = "root";
                            $password = "";
                            $database = "rentacar";

                            $connection = new mysqli($servername, $user, $password, $database);

                            if ($connection->connect_error){
                                die("Connection Failed: " . $connection->connect_error);
                            }
                            // $com_id = $_SESSION['com_id'];
                            $sql = "SELECT * FROM reservation ";
                            $result =$connection->query($sql);

                            if (!$result){
                                die("Invalid Query: " . $connection->error);
                            }

                            while($row = $result->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td> <?php echo $row["id"] ?> </td>
                                    <td> <?php echo $row["user_name"] ?> </td>
                                    <td> <?php echo $row["number"] ?> </td>
                                    <td> <?php echo $row["brand"] ?> </td>
                                    <td> <?php echo $row["pickupdate"] ?> </td>
                                    <td> <?php echo $row["returndate"] ?> </td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="">Update</a>
                                        <form action="insert.php" method="POST" class="d-inline">
                                            <button type="submit" name="removeRes" value="<?=$row['id'];?>" class="btn btn-danger btn-sm">Cancel</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                            ;}
                               
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

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