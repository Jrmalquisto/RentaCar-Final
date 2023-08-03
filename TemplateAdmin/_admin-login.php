<?php
session_start();
$error = null;

$servername = "localhost";
$dbname = "rentacar";
$user_name = "root";
$pass_word = "";



if (isset($_POST['submit'])) {
    function validate($data)
    {
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
    try {


        $conn = new PDO("mysql:host=localhost;dbname=$dbname", $user_name, $pass_word);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //getting form data

        if (empty($username)) {
        } else if (empty($password)) {
            header('Location:_admin-login.php?error=Password');
        }
        //query
        $resultSet = $conn->prepare("select * from admin where user_name = :username and admin_pass = :password limit 1");
        $resultSet->bindParam(':username', $username);
        $resultSet->bindParam(':password', $password);
        $resultSet->execute();


        $_SESSION["user_name"] = $username;


        //Process Login
        $row = $resultSet->fetch(PDO::FETCH_ASSOC);


        $verified = $row['verified'];
        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $email = $row['email'];
        $date = $row['register_date'];
        $contact = $row['contact_num'];
        $date = strtotime($date);
        $date = date('M d Y', $date);

        $_SESSION["user_id"] = $user_id;
        $_SESSION["cont_num"] = $contact;
        $_SESSION["user_name"] = $user_name;

        if ($row['user_name'] === $username && $row['admin_pass'] === $password) {
            header('Location:.dashboardAdmin.php');
        } else {
            header('Location:_admin-login.php?error=Incorrect Username or Password');
            exit();
        }
        if ($verified == 1) {

            // header('Location:index.php');
            // echo "<center>Account Has been Verified, Login Successfull</center>";
        } else {
            // $error = "<center>Please Verify Your Account First. To verify, please click the verification that was sent to $email on $date</center>";
            // echo "<script> alert('$error')</script";

            // header('Location:index.php');
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}


?>

<?php
$error = null;

if (isset($_POST['seller-submit'])) {

    //database connection
    $mysqli = new mysqli('localhost', 'root', '', 'rentacar');

    //getting form data
    $username1 = $mysqli->real_escape_string($_POST['username1']);
    $password1 = $mysqli->real_escape_string($_POST['password1']);
    $password = md5($password);

    //query
    $resultSet = $mysqli->query("select * from seller where username = '$username1' and password = '$password1' limit 1");

    if ($resultSet->num_rows != 0) {
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="admin_style_log.css" />
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <title>Login Account</title>
</head>

<body>
    <div class="loader">
        <div></div>
    </div>
    <section class="container-fluid background-radial-gradient overflow-hidden">

        <div class="container">

            <div class="forms-container">
                <div class="signin-signup p-4">

                    <form action="#" class="sign-in-form" method="post">


                        <h2 class="title mb-3">Administrator Login</h2>
                        <p class="text-grey-20 text-center mb-5">Please enter your username and password</p>

                        <div class="input-field">
                            <i class="fas fa-user"></i>
                            <input type="text" placeholder="Username" class="form-control" name="username" autocomplete="off" required />
                        </div>
                        <div class="input-field mb-4">
                            <i class="fas fa-lock"></i>
                            <input type="password" placeholder="Password" class="form-control" name="password" autocomplete="off" required />
                        </div>
                        <?php if (isset($_GET['error'])) {             ?>
                            <p class="error"> <?php echo $_GET['error']; ?> </p>

                        <?php } ?>
                        <button id="user-login account" type="submit" class="btn btn-primary btn-block" name="submit" style="background-color: #3b5998; border-radius:30px">Login</button>
                        <!-- <input type="submit" value="Login" class="btn solid" name="submit">-->
                        <!-- <button type="submit" class="btn solid" name="submit">Login</button> -->


                        <p class="social-text">Don`t have an account? <a href="_admin_create_acc.php?signup=free">Register Here!</p>
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
    </section>

    <!-- <script src="app.js"></script> -->

    <script>
        $(window).on('load', function() {
            $(".loader").hide();

        })
    </script>


</body>

</html>