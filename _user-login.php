<?php
    // ob_start();
    session_start();

    require_once('auth.php');

    require_once('vendor/autoload.php');
    $con = new mysqli('localhost', 'root','','rentacar');

    $error = null;
    
    $servername = "localhost";
    $dbname = "rentacar";
    $user_name = "root";
    $pass_word = "";

    // $user11 = $_SESSION['ucode']??0;
    $clientID = "452882927978-javaoiqef3natfq7505crgh8e166967r.apps.googleusercontent.com";
    $secret = "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";
    
    // Google API Client
    $gclient = new Google_Client();
    
    $gclient->setClientId($clientID);
    $gclient->setClientSecret($secret);
    $gclient->setRedirectUri('http://localhost:3000/_user-login.php');
    
    
    $gclient->addScope('email');
    $gclient->addScope('profile');
    
    if(isset($_GET['code'])){
        // Get Token
        $token = $gclient->fetchAccessTokenWithAuthCode($_GET['code']);
    
        // Check if fetching token did not return any errors
        if(!isset($token['error'])){
            // Setting Access token
            $gclient->setAccessToken($token['access_token']);
    
            // store access token
            $_SESSION['access_token'] = $token['access_token'];
    
            // Get Account Profile using Google Service
            $gservice = new Google_Service_Oauth2($gclient);
    
            // Get User Data
            $udata = $gservice->userinfo->get();
            foreach($udata as $k => $v){
                $_SESSION['login_'.$k] = $v;
            }
            // $verified = $row['verified'];
            // $user_id= $row['user_id'];
            // $user_name= $row['user_name'];
            // $email = $row['email'];
            // $date = $row['register_date'];
            // $contact = $row['contact_num'];
           
            $s_username = $_SESSION['login_givenName'];
            $s_fullname = $_SESSION['login_name'];
            $s_email = $_SESSION['login_email'];
            $_SESSION['email'] = $_SESSION['login_email'];

            $s_verified = $_SESSION['login_verifiedEmail'];

            $_SESSION['whole'] = $udata;
            $_SESSION['ucode'] = $_GET['code'];
            // $_SESSION['user_id'] = $_GET['code'];

            $checkQuery = "SELECT * FROM user WHERE email = '". $s_email ."'"; 
            $checkResult = mysqli_query($con,$checkQuery); 
             
            // Add modified time to the data array 
             
            if($checkResult->num_rows > 0){ 
                // Prepare column and value format 
                header('Location:index.php');
                exit;


            } else { 
                $insert = mysqli_query($con,"insert into user(user_name,fullname,email,verified)
                values ('$s_username','$s_fullname','$s_email','$s_verified')");
                if ($insert){
                    header('Location:index.php');
                    exit;

                }
            }
        }
    }
    
    
    if(isset($_POST['submit'])){
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }


        
        $username = validate($_POST['username']);
        $password = validate($_POST['password']);
        $password = md5($password);
         //database connection
         //$mysqli = new mysqli('localhost', 'root','','rentacar');
         try{

            
            $conn = new PDO("mysql:host=localhost;dbname=$dbname", $user_name, $pass_word);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //getting form data

            if (empty($username)){

            } else if (empty($password)){
                exit(header('Location:_user-login.php?error=Password'));
            }
            //query
            $resultSet = $conn->prepare("select * from user where user_name = :username and pass_word = :password limit 1");
            $resultSet->bindParam(':username', $username);
            $resultSet->bindParam(':password', $password);
            $resultSet->execute();
            

                $_SESSION["user_name"] = $username;
                

                //  Process Login
                $row = $resultSet->fetch(PDO::FETCH_ASSOC);

                
                $verified = $row['verified'];
                $user_id= $row['user_id'];
                $user_name= $row['user_name'];
                $email = $row['email'];
                $date = $row['register_date'];
                $contact = $row['contact_num'];
                $date = strtotime($date);
                $date = date('M d Y', $date);

                $_SESSION["user_id"]=$user_id;
                $_SESSION["cont_num"]=$contact;
                $_SESSION["user_name"]=$user_name;
                $_SESSION["email"]=$email;

                
                if($row['user_name'] === $username && $row['pass_word'] === $password){

                    exit(header("Location:index.php"));
                    
                } else {

                    exit(header("Location:_user-login.php?error=Incorrect Username or Password"));
                    
                }
                // if($verified == 1){
                    
                //     header('Location:index.php');
                //     echo "<center>Account Has been Verified, Login Successfull</center>";
                // }else{
                //     $error = "<center>Please Verify Your Account First. To verify, please click the verification that was sent to $email on $date</center>";
                //     echo "<script> alert('$error')</script";
                    
                //     header('Location:index.php');
                // }

                function checkUser($data = array()){ 
                    if(!empty($data)){ 
                        // Check whether the user already exists in the database 
                        $checkQuery = "SELECT * FROM ".$dbname." WHERE user_id = '".$data['oauth_uid']."'"; 
                        $checkResult = $this->db->query($checkQuery); 
                         
                        // Add modified time to the data array 
                        if(!array_key_exists('modified',$data)){ 
                            $data['modified'] = date("Y-m-d H:i:s"); 
                        } 
                         
                        if($checkResult->num_rows > 0){ 
                            // Prepare column and value format 
                            $colvalSet = ''; 
                            $i = 0; 
                            foreach($data as $key=>$val){ 
                                $pre = ($i > 0)?', ':''; 
                                $colvalSet .= $pre.$key."='".$this->db->real_escape_string($val)."'"; 
                                $i++; 
                            } 
                            $whereSql = " WHERE  user_id = '".$data['oauth_uid']."'"; 
                             
                            // Update user data in the database 
                            $query = "UPDATE ".$dbname." SET ".$colvalSet.$whereSql; 
                            $update = $this->db->query($query); 
                        }else{ 
                            // Add created time to the data array 
                            if(!array_key_exists('created',$data)){ 
                                $data['created'] = date("Y-m-d H:i:s"); 
                            } 
                             
                            // Prepare column and value format 
                            $columns = $values = ''; 
                            $i = 0; 
                            foreach($data as $key=>$val){ 
                                $pre = ($i > 0)?', ':''; 
                                $columns .= $pre.$key; 
                                $values  .= $pre."'".$this->db->real_escape_string($val)."'"; 
                                $i++; 
                            } 
                             
                            // Insert user data in the database 
                            $query = "INSERT INTO ".$dbname." (".$columns.") VALUES (".$values.")"; 
                            $insert = $this->db->query($query); 
                        } 
                         
                        // Get user data from the database 
                        $result = $this->db->query($checkQuery); 
                        $userData = $result->fetch_assoc(); 
                    } 
                     
                    // Return user data 
                    return !empty($userData)?$userData:false; 
                } 
        } catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
    
    }


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  
    <link rel="stylesheet" href="login-style.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">

    
    <title>Login Account</title>
   

</head>

<body>
<div class="loader">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
</div>
    
<section class="container-fluid background-radial-gradient overflow-hidden"> 

    <div class="container">

        <div class="forms-container">
        <button onclick="window.location='/TemplateShop/_company-login.php';" id="seller-login account" type="submit" class="btn1 btn-primary" name="submit">Company Login</button>

                <div class="signin-signup  p-4">
                    
                    <form action="" class="sign-in-form" method="post">

                        
                        <h2 class="title mb-3">User Login</h2>
                      
                        <p class="text-grey-20 text-center mb-4">Please enter your username and password</p>

                        <div class="input-field">
                            <i class="fas fa-user"></i>
                            <input type="text" placeholder="Username" class="form-control" name="username" autocomplete="off"required/>
                        </div>
                        <div class="input-field mb-4">
                            <i class="fas fa-lock"></i>
                            <input type="password" placeholder="Password" class="form-control" name="password" autocomplete="off"required/>
                        </div>
                        <?php if (isset($_GET['error'])) {             ?>
                            <p class="error"> <?php echo $_GET['error']; ?> </p>

                        <?php }?>

                        <button id="user-login account" type="submit" class="btn btn-primary btn-block" name="submit" style ="background-color: #3b5998; border-radius:30px">Login</button>
                        <!-- <input type="submit" value="Login" class="btn solid" name="submit">-->
                        <!-- <button type="submit" class="btn solid" name="submit">Login</button> -->
                    

                        <p class="social-text">Don`t have an account? <a href="_user-create-account.php?signup=free">Register Here!</p>
                        <div class="social-media">
                            <a href="#" class="social-icon">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            
                            <a href="<?= $gclient->createAuthUrl() ?>" class="social-icon">
                                <i class="fab fa-google"></i>
                            </a>
                            
                        </div>
                    </form>
                    
                    <form action="" class="sign-up-form" method="post">
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

                        <input type="submit" class="btn" value="Login" name="seller-submit" style ="background-color: #3b5998; border-radius:30px">
                        

                        <p class="social-text">Don`t have an account? <a href="_user-create-account.php?signup=free">Register Here!</p>
                        <div class="social-media">
                            <a href="#" class="social-icon">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <!-- <a href="<?= $gclient->createAuthUrl() ?>" class="social-icon"> -->
                                <i class="fab fa-google"></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class="fab fa-linkedin-in"></i>
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
    
    <!-- <script src="app.js"></script> -->
    

    <script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script defer src="app.js"></script>
</body>

</html>
