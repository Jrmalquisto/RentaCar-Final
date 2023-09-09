<?php
    session_start();
    $error = null;

    if(isset($_POST['submit'])){

         //database connection
         $mysqli = new mysqli('localhost', 'root','','rentacar');

         //getting form data
         $username = $mysqli ->real_escape_string($_POST['username']);
         $password = $mysqli ->real_escape_string($_POST['password']);
         $password = md5($password);

         //query
         $resultSet = $mysqli->query("select * from seller where username = '$username' and password = '$password' limit 1");

         if($resultSet->num_rows !=0){

            $_SESSION['username'] = $username;
            //Process Login
            $row = $resultSet->fetch_assoc();
            $verified = $row['verified'];
            $com_id = $row['seller_id'];
            $email = $row['email'];
            $date = $row['register_date'];
            $shop = $row['shopname'];
            $date = strtotime($date);
            $date = date('M d Y', $date);

            $_SESSION['shopname'] = $shop;
            $_SESSION['com_id'] = $com_id;
            if($verified == 1){
                
                header('Location:.dashboardCompany.php');
               // echo "<center>Account Has been Verified, Login Successfull</center>";
            }else{
                
                header('Location:.dashboardCompany.php');
            }

         }else{
            //Invalid Credentials
            //$error = "<center>Error! Invalid Credentials</center>";
            
            
            echo '<script> alert("Error! Invalid Credentials");window.location=index.php</script>';
            //echo '<script type="javascript">alert("JavaScript Alert Box by PHP")</script>';
         }

         
    
    }


?>

<?php
    $error = null;

    if(isset($_POST['seller-submit'])){

         //database connection
         $mysqli = new mysqli('localhost', 'root','','rentacar');

         //getting form data
         $username1 = $mysqli ->real_escape_string($_POST['username1']);
         $password1 = $mysqli ->real_escape_string($_POST['password1']);
         $password = md5($password);

         //query
         $resultSet = $mysqli->query("select * from seller where username = '$username1' and password = '$password1' limit 1");

         if($resultSet->num_rows !=0){
            //Process Login
            $row = $resultSet->fetch_assoc();

            header('Location:sellerdetails.php');

         }
        }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/login-style.css" />
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
    <title>Login Account</title>
</head>

<body>
<section class="container-fluid background-radial-gradient overflow-hidden"> 
    <div class="container">

        <div class="forms-container">
        <button onclick="window.location='../_user-login.php';" id="seller-login account" type="submit" class="btn1 btn-primary" name="submit">User Login</button>
        

                <div class="signin-signup p-4">
                    
                    <form action="#" class="sign-in-form" method="post">
                        <h2 class="title mb-3">Company Login</h2>
                        <p class="text-grey-20 text-center mb-4">Please enter your username and password</p>

                        <div class="input-field">
                            <i class="fas fa-user"></i>
                            <input type="text" placeholder="Username" class="form-control" name="username" autocomplete="off"required/>
                        </div>
                        <div class="input-field mb-4">
                            <i class="fas fa-lock"></i>
                            <input type="password" placeholder="Password" class="form-control" name="password" autocomplete="off"required/>
                        </div>

                        <button id="company-login account" type="submit" class="btn btn-primary btn-block" name="submit" style ="background-color: #3b5998; border-radius:30px">Login</button>
                        <!-- <input type="submit" value="Login" class="btn solid" name="submit">-->
                        <!-- <button type="submit" class="btn solid" name="submit">Login</button> -->
                    

                        <p class="social-text">Don`t have an account? <a href="_company-create-account.php?signup=free">Register Here!</p>
                        
                    </form>

                    <form action="#" class="sign-up-form" method="post">
                        <h2 class="title">Seller Login</h2>
                        <div class="input-field">
                            <i class="fas fa-user"></i>
                            <input type="text" placeholder="Username" class="form-control" name="username1" autocomplete="off">
                        </div>
                        <!-- <div class="input-field">
                <i class="fas fa-envelope"></i>
                <input type="email" placeholder="Email" />
                </div> -->
                        <div class="input-field">
                            <i class="fas fa-lock"></i>
                            <input type="password" placeholder="Password" class="form-control" name="password1"autocomplete="off">
                        </div>

                        <input type="submit" class="btn" value="Login" name="seller-submit">

                        <p class="social-text">Don`t have an account? <a href="_company-create-account.php?signup=free">Register Here!</p>
                        <div class="social-media">
                            <a href="#" class="social-icon">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            
                            <a href="#" class="social-icon">
                                <i class="fab fa-google"></i>
                            </a>
                            
                    </div>
                </form>
            </div>
        </div>
        <!--
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Seller Login</h3>
                    <p>
                        Got something to sell? It's time to share and earn!
                        Login now to setup your shop.
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        Seller
                    </button>
                </div>
                <img src="" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>User Login</h3>
                    <p>
                        Looking for something without any hassle? Shop your favorite Leyte products
                        online! Click the button now.
                    </p>
                    <button class="btn transparent" id="sign-in-btn">
                        User
                    </button>
                </div>
                <img src="" class="image" alt="" />
            </div>
        </div>
    -->
    </div>
    </section>
    <script src="app.js"></script>
    
</body>

</html>

<?php
    echo $error; 
?>