
<?php
    $error = null;
    session_start();

    if(isset($_POST['submit'])){

        //get form data
        $username=$_POST['username'];
        $firstname=$_POST['firstname'];
        $lastname=$_POST['lastname'];
        $password=$_POST['password'];
        $password2=$_POST['password2'];
        $email_user=$_POST['email'];
        $contact=$_POST['cont_num'];
        $address=$_POST['address'];
        $validID=$_POST['pic_ID'];
        $dob=date('Y-m-d', strtotime($_POST['birthday']));
       
        $img_name = $_FILES['pic_ID']['name'];
        $img_size = $_FILES['pic_ID']['size'];
        $tmp_name = $_FILES['pic_ID']['tmp_name'];
        $error = $_FILES['pic_ID']['error'];

        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);

        $allowed_exs = array("jpg", "jpeg", "png"); 

        
        
        //Check if input characters are empty
        if (empty($firstname) || empty($lastname)  || empty($email_user) || empty($password) || empty($email_user)) {
            header ("Location: ../_user-create-account.php?signup=empty");
            exit();

        }  else {
            //Check if input characters are valid
            if (!preg_match("/^[a-zA-Z]*$/", $firstname)) {
                header("Location: ../_user-create-account.php?signup=fnameerr&email=$email_user&&lastname=$lastname&username=$username");
                exit();
            } elseif (!preg_match("/^[a-zA-Z]*$/", $lastname)) {
                header("Location: ../_user-create-account.php?signup=lnameerr&email=$email_user&firstname=$firstname&username=$username");
                exit();
            }else{
                //Check if email is valid
                if ($password!=$password2){
                    //echo '<script> alert("Password not matched")</script>';
                    header ("Location: ../_user-create-account.php?signup=pwerror&email=$email_user&firstname=$firstname&lastname=$lastname&username=$username");
                    exit();
                }  else {
                    $mysqli = new mysqli('localhost', 'root','','rentacar');

                     //sanitize form data
                    $username = $mysqli ->real_escape_string($username);
                    $firstname = $mysqli ->real_escape_string($firstname);
                    $lastname = $mysqli ->real_escape_string($lastname);
                    $password = $mysqli ->real_escape_string($password);
                    $password2 = $mysqli ->real_escape_string($password2);
                    $email_user = $mysqli ->real_escape_string($email_user);
                    $contact = $mysqli ->real_escape_string($contact);
                    $dob = $mysqli ->real_escape_string($dob);
                    $address = $mysqli ->real_escape_string($address);
                    //generating vkey
                    $vkey = md5(time().$username);
                    $verified = 0;

                    //password encryption
                    $password = md5($password);
                    
                    if (in_array($img_ex_lc, $allowed_exs)) {
                        $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                        // $new_img_name = "assets/SampleProd/".$img_name;
                        $img_upload_path = 'assets/legal_id/'.$new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);

                        // Insert into Database
                        
                        $insert = $mysqli->query("insert into user(user_name,first_name,last_name,pass_word,email,contact_num,vkey,birthday,pic_ID,address)
                        values ('$username','$firstname','$lastname','$password','$email_user','$contact','$vkey','$dob','$new_img_name','$address')");
                        // $insert1 = $mysqli->query("insert into cart (user_id,item_id)
                        // values (0,0)");

                        if ($insert){
                            
                                header("Location: ../_user-login.php");
                            
                            
                        } else {
                        
                            $em = "Sorry, yours.";
                            header("Location: ../_user-create-account.php?error=$em");
            
                            echo "<script> alert('$error');window.location=index.php</script>";
                                
                        }

                    } else {
                        
                        $em = $validID;
                        $errrr = $tmp_name;
                        header("Location: ../_user-create-account.php?error=$em, aasd=$errrr");
        
                        echo "<script> alert('$error');window.location= _user-create-account.php</script>";
                        
                    }
                }
            }
        
            // Form Validation

            //database connection
            
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
    <link rel="stylesheet" href="style.css">

</head>

<body>

<section class="container-fluid background-radial-gradient overflow-hidden " id = "background"> 
    
        <div class="forms-container">
        <div class="signupform container-sm p-4">
            <h2 id="createaccount-title" class="font-weight-bold" style="color: #444">Create User Account</h2>
            <p class="text-grey-20 font-weight-light text-left mb-4">Fill up the form with correct values</p>
            
            <form id="create-account" method="post" action="" enctype="multipart/form-data">

                <div class="row" id = "rowcol">
                    <!-- First name -->
                    <div class="input-field col-6 mb-3">
                        
                        <?php
                            if (isset($_GET['firstname'])) {
                                $first = $_GET['firstname'];
                                echo '<input type="text" name="firstname" style="border-radius:30px" class="form-control" placeholder="First name" value="'.$first.'">';
                            } else {
                                echo '<input type="text" class="form-control" style="border-radius:30px" name="firstname" placeholder="First name" autocomplete="off"required/>';
                            }

                            $signupCheck = $_GET['signup'];
                            
                                if ($signupCheck == 'fnameerr') {
                                
                                    echo "<p class='error mt-2 mb-1 ml-2 text-danger'><small> Please only use letters (a-z, A-Z).</small></p>";
                                    
                                }
                            
                           
                            
                            
                        ?>
                        
                    </div>
                    <!-- Last name -->
                    <div class="input-field col-6 mb-3">
                        
                        <?php
                            if (isset($_GET['lastname'])) {
                                $last = $_GET['lastname'];
                                echo '<input type="text" name="lastname" style="border-radius:30px" class="form-control" placeholder="Last name" value="'.$last.'">';
                            }
                            else {
                                echo '<input type="text" class="form-control" style="border-radius:30px" name="lastname" placeholder="Last name" autocomplete="off"required/>';
                                
                            }
                            if ($_GET['signup'] == 'lnameerr') {
                                
                                echo "<p class='error mt-2 mb-1 ml-2 text-danger '> <small> Please only use letters (a-z, A-Z).</small></p>";
                            }
                            else{
                                
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
                    <?php 
                        if ($_GET['signup'] == 'pwerror') {
                                
                            echo "<p class='error mt-2 mb-1 ml-2 text-danger'> <small> Password not matched</small></p>";
                        }
                    ?>
                    
                </div>

              
                <div class="row" id = "rowcol">
                    <!-- Birthday-->
                    <div class="input-field col-6 mb-3">
                        
                       
                        <input type="date" name="birthday" style="border-radius:30px" class="form-control" placeholder="Birthday" onfocus="(this.type='date')" >
                                
                        
                    </div>
                    <!-- Contact Number -->
                    <div class="input-field col-6 mb-3">
                        
                        <input type="text" name="cont_num" style="border-radius:30px" class="form-control" placeholder="Contact Number" value="">

                        
                    </div>
                </div>
                <!-- Address -->
                <div class="input-field mb-3">
                        
                    <input type="text" name="address" style="border-radius:30px" class="form-control" placeholder="Address" value="">

                        
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
                
                
                <div class="form-group mb-5 border-bottom-0">
                    <label for="pic_ID">Please upload Valid ID.</label>
                    <input type="file" class="form-control-file" id="pic_ID" name="pic_ID">
                </div>
               
                
                
                
                <div class="d-grid col-md-12 text-center mt-4">
                    <button id="user-create account" type="submit" class="btn btn-primary mb-3 btn-block" style="background-color: #3b5998; border-radius:30px" name="submit">Create Account</button>
                </div>
                <p class="social-text text-center pt-2">Already have an account? <a href="_user-login.php">Login Here!</p>
            </form>
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