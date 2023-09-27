
<?php
    $error = null;
    session_start();

    if(isset($_POST['submit'])){

        //get form data
        $username=$_POST['username'];
        $name=$_POST['name'];
        $password=$_POST['password'];
        $password2=$_POST['password2'];

        //Check if input characters are empty
        if (empty($name) || empty($username) || empty($password) || empty($password2)) {
            header ("Location: ../_user-create-account.php?signup=empty");
            exit();
            
                }  else {
                    $mysqli = new mysqli('localhost', 'root','','rentacar');

                     //sanitize form data
                    $username = $mysqli ->real_escape_string($username);
                    $name = $mysqli ->real_escape_string($name);
                    $password = $mysqli ->real_escape_string($password);
                    $password2 = $mysqli ->real_escape_string($password2);

                    
                    //generating vkey
                    $vkey = md5(time().$username);
                    $verified = 0;

                    //password encryption
                    $password = md5($password);
                    
                        // Insert into Database
                        
                        $insert = $mysqli->query("insert into admin(user_name,admin_name,admin_pass,vkey)
                        values ('$username','$name','$password','$vkey')");

                        if ($insert){
                            
                                header("Location:../TemplateAdmin/_admin-login.php");
                            
                            
                        } else {
                        
                            $em = "Sorry, yours.";
                            header("Location: ../_user-create-account.php?error=$em");
            
                            echo "<script> alert('$error');window.location=index.php</script>";
                                
                    }                  
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Owl-carousel CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />

    <!-- font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
        integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />

    <!-- CSS File -->
    <link rel="stylesheet" href="admin_style_reg.css">

</head>

<body>

<section class="container-fluid background-radial-gradient overflow-hidden " id = "background"> 
    
        <div class="forms-container">
        <div class="signupform container-sm p-4">
            <h2 id="createaccount-title" class="font-weight-bold" style="color: #444">Create Account</h2>
            <p class="text-grey-20 font-weight-light text-left mb-4">Fill up the form with correct values</p>
            
            <form id="create-account" method="post" action="" enctype="multipart/form-data">

                <div class="row" id = "rowcol">

                    <!-- Name -->
                    <div class="input-field col-12 mb-3">
                        
                        <?php
                            if (isset($_GET['name'])) {
                                $first = $_GET['name'];
                                echo '<input type="text" name="firstname" style="border-radius:30px" class="form-control" placeholder="First name" value="'.$first.'">';
                            } else {
                                echo '<input type="text" class="form-control" style="border-radius:30px" name="name" placeholder="Name" autocomplete="off"required/>';
                            }
                        ?>
                    
                    </div>
                </div>

                <!-- Username -->            
                <div class="input-field mb-3">
                        <?php
                            if (isset($_GET['username'])) {
                                $username = $_GET['username'];
                                echo '<input type="text" style="border-radius:30px"style="border-radius:30px" name="username" class="form-control" placeholder="Username" value="'.$username.'">';
                            }
                            else {
                                echo '<input type="text" style="border-radius:30px"class="form-control" name="username" placeholder="Username" autocomplete="off"required/>';
                            }
                        ?>

                </div>

                <!-- Password -->           
                <div class="input-field mb-3">
                    
                    <input type="password" class="form-control" style="border-radius:30px" placeholder="Password" name="password"
                        autocomplete="off"required/>
                </div>

                <!-- Reenter password -->
                <div class="input-field mb-3">
                <input type="password" class="form-control" style="border-radius:30px" placeholder="Re-enter Password" name="password2"
                        autocomplete="off"required/>
                    <!-- <?php 
                        if ($_GET['signup'] == 'pwerror') {
                                
                            echo "<p class='error mt-2 mb-1 ml-2 text-danger'> <small> Password not matched</small></p>";
                        }
                    ?> -->
                    
                </div>


                <div class="d-grid col-md-12 text-center mt-4">
                    <button id="user-create account" type="submit" class="btn btn-primary mb-3 btn-block" style="background-color: #3b5998; border-radius:30px" name="submit">Create Account</button>
                </div>
                <p class="social-text text-center pt-2">Already have an account? <a href="_admin-login.php">Login Here!</p>
            </form>
        </div>
    </div>
    
</section>
</body>

</html>



<?php
    echo $error;
?>