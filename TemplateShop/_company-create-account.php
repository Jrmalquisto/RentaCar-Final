
<?php
    $error = null;
    session_start();

    if(isset($_POST['submit'])){

        //get form data
        $username=$_POST['username'];
        $shopname=$_POST['shopname'];
        
        $password=$_POST['password'];
        $password2=$_POST['password2'];
        $email_user=$_POST['email'];
        $contact=$_POST['cont_num'];
        $address=$_POST['address'];


        $img_name = $_FILES['pic_DTI']['name'];
        $img_size = $_FILES['pic_DTI']['size'];
        $tmp_name = $_FILES['pic_DTI']['tmp_name'];
        $error = $_FILES['pic_DTI']['error'];

        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);

        print_r($img_ex_lc);

        $img_name1 = $_FILES['pic_BP']['name'];
        $img_size1 = $_FILES['pic_BP']['size'];
        $tmp_name1 = $_FILES['pic_BP']['tmp_name'];
        $error1 = $_FILES['pic_BP']['error'];

        $img_ex1 = pathinfo($img_name1, PATHINFO_EXTENSION);
        $img_ex_lc1 = strtolower($img_ex1);

        print_r($img_ex_lc1);
        $allowed_exs = array("jpg", "jpeg", "png"); 

        //Check if input characters are empty
        if (empty($shopname) || empty($username) || empty($password) || empty($email_user)) {
            header ("Location: ../TemplateShop/_company-create-account.php?error=empty");
            exit();
        } else {
            if (!preg_match("/^[a-zA-Z]*$/", $shopname)) {
                header("Location: ../TemplateShop/_company-create-account.php?error=nerror&email=$email_user&username=$username&contact=$contact&address=$address");
                exit();
            } else {

            //Check if input characters are valid
            
                //Check if email is valid
                if ($password!=$password2){
                    //echo '<script> alert("Password not matched")</script>';
                    header ("Location: ../TemplateShop/_company-create-account.php?error=pwerror&email=$email_user&shopname=$shopname&username=$username&contact=$contact&address=$address");
                    exit();
                } else {
                    $mysqli = new mysqli('localhost', 'root','','rentacar');

                     //sanitize form data
                    $username = $mysqli ->real_escape_string($username);
                    $password = $mysqli ->real_escape_string($password);
                    $password2 = $mysqli ->real_escape_string($password2);
                    $email_user = $mysqli ->real_escape_string($email_user);
                    $contact = $mysqli ->real_escape_string($contact);
                    $address = $mysqli ->real_escape_string($address);


                    
                    //generating vkey
                    $vkey = md5(time().$username);

                    //password encryption
                    $password = md5($password);
                

                //data insertion to database
                    if ($error==4){
                        header ("Location: ../TemplateShop/_company-create-account.php?error=noid&email=$email_user&shopname=$shopname&username=$username&contact=$contact&address=$address");
                        exit();
                    }else if ($error1==4) {
                        header ("Location: ../TemplateShop/_company-create-account.php?error=noid&email=$email_user&shopname=$shopname&username=$username&contact=$contact&address=$address");
                        exit();
                    }else{

                    
                    if (in_array($img_ex_lc, $allowed_exs)) {
                        $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                        $img_upload_path = '../images/dti_pic/'.$new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);

                        if (in_array($img_ex_lc1, $allowed_exs)) {
                            $new_img_name1 = uniqid("IMG-", true).'.'.$img_ex_lc1;
                            $img_upload_path1 = '../images/bp_pic/'.$new_img_name1;
                            move_uploaded_file($tmp_name1, $img_upload_path1);
    

                        // Insert into Database
                        
                            $insert = $mysqli->query("insert into seller(username,shopname,password,email,address,contact_num,vkey,dti_pic,bp_pic)
                                values ('$username','$shopname','$password','$email_user','$address','$contact','$vkey','$new_img_name','$new_img_name1')");

                            // $insert1 = $mysqli->query("insert into cart (user_id,item_id)
                            // values (0,0)");
    
                            if ($insert){

                                $notificationMessage = "New <b>seller</b> account created: " . $shopname;
                                $insertNotification = $mysqli->query("INSERT INTO notifications (message, timestamp, status, account_type) VALUES ('$notificationMessage', NOW(), 'unread', 'seller')");
                                
                                    header("Location: ../TemplateShop/_company-login.php");
                                
                                
                            } else {
                            
                                $em = "Please upload an image of the shop's DTI Registration.";
                                header("Location: ../_company-create-account.php?error=$img_name");
                
                                echo "<script> alert('$img_name');window.location=_company-create-account.php</script>";
                                    
                            }

                        } else {
                            $em = "Please upload an image of the shop's Business Permit.";
                            header("Location: ../_company-create-account.php?error=$img_name");
            
                            echo "<script> alert('$error');window.location=_company-create-account.php</script>";
                                
                        }

                    } else {
                        
                        $em = $validID;
                        $errrr = $img_name;
                        header("Location: ../_company-create-account.php?error=$username&aasd=$password");
        
                        echo "<script> alert('$error');window.location= _company-create-account.php</script>";
                        
                    }
                }
            }
            
        
            // Form Validation

            //database connection
            
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
    <link rel="stylesheet" href="../style.css">

</head>

<body>

<section class="container-fluid background-radial-gradient overflow-hidden " id = "background"> 
    <div class="container my-4">
        <div class="forms-container">
        <div class="signupform1 p-4">
            <h2 id="createaccount-title" class="font-weight-bold" style="color: #444">Start your business</h2>
            <p class="text-grey-20 font-weight-light text-left mb-4">Fill up the form with correct information about your shop</p>
            
            <form id="create-account" method="post" action="" enctype="multipart/form-data">

                <div class="input-field mb-3">
                        

                        <?php
                            if (isset($_GET['shopname'])) {
                                $first = $_GET['shopname'];
                                echo '<input type="text" name="shopname" style="border-radius:30px" class="form-control" placeholder="What is your shop name?" value="'.$first.'">';
                            } else {
                                echo '<input type="text" class="form-control" style="border-radius:30px" name="shopname" placeholder="What is your shop name?" autocomplete="off" required/>';
                            }

                            $signupCheck = $_GET['error'];
                            
                                if ($signupCheck == 'nerror') {
                                
                                    echo "<p class='error mt-2 mb-1 ml-2 text-danger'><small>Invalid input. Please only use letters (a-z, A-Z).</small></p>";
                                    
                                }
                        ?>
                        
                        
                    </div>
                    <!-- Last name -->
                    
                
                <!-- Username -->            
                <div class="input-field mb-3">
                        <?php
                            if (isset($_GET['username'])) {
                                $username = $_GET['username'];
                                echo '<input type="text" style="border-radius:30px"style="border-radius:30px" name="username" class="form-control" placeholder="Please choose a Username" value="'.$username.'">';
                            }
                            else {
                                echo '<input type="text" style="border-radius:30px"class="form-control" name="username" placeholder="Please choose a Username" autocomplete="off"required/>';
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
                    <?php 
                        if ($_GET['error'] == 'pwerror') {
                                
                            echo "<p class='error mt-2 mb-1 ml-2 text-danger'> <small> Password not matched</small></p>";
                        }
                    ?>
                    
                </div>

                <!-- Email -->
                <div class="input-field mb-3">
                    <?php
                            if (isset($_GET['email'])) {
                                $email = $_GET['email'];
                                echo '<input type="email" name="email" style="border-radius:30px" class="form-control" placeholder="Email" value="'.$email.'">';
                                
                            }
                            else {
                                echo '<input type="email" class="form-control" style="border-radius:30px" placeholder="Email" name="email" autocomplete="off" required/>';
                            }
                    ?>   
                </div>

                <div class="input-field mb-3">
                    
                            <!-- <input type="text" name="cont_num" style="border-radius:30px" class="form-control" placeholder="Contact Number" value=""> -->
                            <?php
                            if (isset($_GET['contact'])) {
                                $cont_num = $_GET['contact'];
                                echo '<input type="text" name="cont_num" style="border-radius:30px" class="form-control" placeholder="Contact Number" value="'.$cont_num.'">';
                                
                            }
                            else {
                                echo '<input type="text" class="form-control" style="border-radius:30px" placeholder="Contact Number" name="cont_num" autocomplete="off" required/>';
                            }
                    ?>  
                </div>

                <div class="input-field mb-3">
                    
                            <!-- <input type="text" name="address" style="border-radius:30px" class="form-control" placeholder="Address" value=""> -->
                            <?php
                            if (isset($_GET['address'])) {
                                $address = $_GET['address'];
                                echo '<input type="text" name="address" style="border-radius:30px" class="form-control" placeholder="Address" value="'.$address.'">';
                                
                            }
                            else {
                                echo '<input type="text" class="form-control" style="border-radius:30px" placeholder="Address" name="address" autocomplete="off" required/>';
                            }
                    ?>  
                </div>
                
                
                <div class="row">
                    <div class="form-group mb-3 border-bottom-0 col-6">
                        <label for="pic_DTI">Please upload DTI Registration.</label>
                        <input type="file" class="form-control-file" id="pic_DTI" name="pic_DTI">
                    </div>

                    <?php
                           
                            $signupCheck = $_GET['error'];
                            
                                if ($signupCheck == 'noid') {
                                
                                    echo "<p class='error mt-2 mb-1 ml-2 text-danger'><small> Please submit a photo of your DTI Registration. </small></p>";
                                    
                                }
                            
                    ?>
                        
                    <div class="form-group mb-3 border-bottom-0 col-6">
                        <label for="pic_BP">Please upload Business Permit.</label>
                        <input type="file" class="form-control-file" id="pic_BP" name="pic_BP">
                    </div>

                    <?php
                            // if (isset($_GET['shopname'])) {
                            //     $first = $_GET['shopname'];
                            //     echo '<input type="text" name="shopname" style="border-radius:30px" class="form-control" placeholder="What is your shop name?" value="'.$first.'">';
                            // } else {
                            //     echo '<input type="text" class="form-control" style="border-radius:30px" name="shopname" placeholder="What is your shop name?" autocomplete="off"required/>';
                            // }

                            $signupCheck = $_GET['error'];
                            
                                if ($signupCheck == 'noid') {
                                
                                    echo "<p class='error mt-2 mb-1 ml-2 text-danger'><small> Please submit a photo of Business Permit.</small></p>";
                                    
                                }
                            
                    ?>
                        
                </div>
                
                <!--
                <form>
                    <div class="form-group mb-5">
                        <label for="exampleFormControlFile1">Example file input</label>
                        <input type="file" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                </form>
                -->
                
                <div class="d-grid col-md-12 text-center mt-4">
                    <button id="company-create account" type="submit" class="btn btn-primary mb-3 btn-block" style="background-color: #3b5998; border-radius:30px" name="submit">Create Account</button>
                </div>
                <p class="social-text text-center pt-2">Already have an account? <a href="_company-login.php">Login Here!</p>
            </form>
            </div>
        </div>
    </div>
</section>
</body>

</html>



<?php
    echo $error;
    //include footer.php file
    //include ('footer.php');
?>