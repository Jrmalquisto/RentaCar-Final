<?php
    ob_start();
    session_start();
    require ('functions.php');
    if (ini_get('register_globals'))
    {
        foreach ($_SESSION as $key=>$value)
        {
            if (isset($GLOBALS[$key]))
                unset($GLOBALS[$key]);
        }
    }
    // $link_address1="index.php";
    // $link_address2="specialoffers.php";
    // $link_address3="vehicles.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentaCar</title>

    
    <!-- <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>     -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> -->
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
    <!-- Owl-carousel CDN -->
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />

    <!-- font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
        integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <!-- Jquery -->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- CSS File -->
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
    
    <!--Bootstrap CDN-->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
    
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script> -->



</head>

<body>
    <?php $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'],"/")+1)?>
    <nav class="navbar navbar-expand-md navbar-dark  sticky-top ps-5 pe-1  justify-content-between"
        >
        <div class="justify-content-start">
            <a class="navbar-brand" href="index.php">RentaCar</a>
            <button class="navbar-toggler me-auto" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon me-auto "></span>
            </button>
        </div>
        <div class="collapse navbar-collapse pe-1 justify-content-end" id="navbarSupportedContent">

            <ul class="navbar-nav justify-content-center col-sm-8">
                <li class="nav-item px-3">
                    <a class="nav-link <?= $page == '../index.php'?'active':'' ?>" href="../index.php">Reservations
                    <span  class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link <?= $page == '../specialoffers.php'?'active':'' ?>" href="../specialoffers.php">Special Offers</a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link <?= $page == '../vehicles.php'?'active':'' ?>" href="../vehicles.php">Shops</a>
                </li>
            </ul>
            <ul class="navbar-nav align-items-center col-sm-3 ">
                <!-- <li class="pe-3">
                    <button type="button" class="btn btn-dark border position-relative fa fa-bell" style="background-color: transparent;">
                         <span class="position-absolute top-0 start-75 translate-middle badge   rounded-circle bg-danger p-2"><span class="visually-hidden">unread messages</span></span>
                    </button>
                </li> -->
                <li class="dropdown nav-item">
                <button type="button" class="btn btn-dark border position-relative fa fa-bell" style="background-color: transparent;">
                         <span class="position-absolute top-0 start-75 translate-middle badge   rounded-circle bg-danger p-2"><span class="visually-hidden">unread messages</span></span>
                    </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">You Have 4 New Messages</a></li>
                                                <li><a class="dropdown-item" href="#">You Have 4 New Messages</a></li>
                                                <li><a class="dropdown-item" href="#">You Have 4 New Messages</a></li>
                                                <li><a class="dropdown-item" href="#">You Have 4 New Messages</a></li>
                                            </ul>
                                        </li>
                <li>

                <li class="nav-item">
                    <a class="nav-link" href="../messages.php?seller_id=0&email=0">
                        <i class="btn btn-dark border fa-regular fa-message"></i>
                    </a>
                </li>


                    <input type="search" id="form1" class="form-control w-100" placeholder="Search" />
                    <!-- <label class="form-label" for="form1">Search</label> -->

                </li>
                <li>
                    <button type="button" class="btn btn-dark" style="color:#E0B25B;">
                        <i class="fas fa-search "></i>
                    </button>
                </li>
                
                <li class="nav-item dropdown px-3 ps-4">

                    <div class="dropdown">
                        <!-- <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user"></i> 
                        </a>  -->
                        <button type="button" class="btn btn-light dropdown-toggle fa fa-user" data-bs-toggle="dropdown"
                            aria-expanded="false">

                        </button>
                        <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="navbarDropdown">
                            <!--<li><a class="dropdown-item" href="_user-login.php"><i class="fa fa-sign-in"></i> Sign In</a></li>-->
                            <li><a class="dropdown-item" href="profile.php"><i class="fa fa-user"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out"></i> Log out</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- <div class="main-navbar shadow-sm sticky-top">
            <div class="top-navbar">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-2 my-auto d-none d-sm-none d-md-block d-lg-block mx-5">
                            <p class="brand-name pt-2">RentaCar</p>
                        </div>
                        <div class="container col-md-5 justify-content-center">
                        <nav class="navbar navbar-expand-lg">
                            <div class="container-fluid">
                    
                                <button class="navbar-toggler navbar-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                        
                                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 " >
                                        <li class="nav-item">
                                            <a class="nav-link" href="index.php">Reservations</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="specialoffers.php">Special Offers</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="vehicles.php">Vehicles</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="chauffeur.php">Chauffeur Drive</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </div>
                            </div>
                        </nav>
                        <div class="col-md-2 my-auto justify-content-end mx-5">
                            <ul class="nav justify-content-end">
                                
                                <li class="nav-item">
                                    <a class="nav-link" href="reservation.php">
                                        <i class="fa fa-heart fa-fw"></i> Wishlist (<?php echo count($product->getData('cart'));?>)
                                    </a>
                                </li>
                                
                                
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-user"></i> 
                                    </a> 
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="_user-login.php"><i class="fa fa-sign-in"></i>Sign In</a></li>    
                                    <li><a class="dropdown-item" href="#"><i class="fa fa-user"></i> Profile</a></li>
                                    <li><a class="dropdown-item" href="userreservation.php"><i class="fa fa-user"></i> My Reservations</a></li>
                                    <li><a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out"></i> Log out</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
        </div> -->
<script src='index.js' defer></script>
<script>
    // $(window).scroll(function() {
    //     // var computedStyle = $boxTwo.css('margin-top');
       
    //     if ($(this).scrollTop() < 300) {
    //         // $('nav').addClass('horizTranslate');
    //         $('nav').stop().fadeIn(500); 
    //     } else {
    //         // $('nav').addClass('backTranslate');
    //         $('nav').stop().fadeOut(250);
    //     };
    // });   
</script>

    
    <main id="main-site px-md-0">