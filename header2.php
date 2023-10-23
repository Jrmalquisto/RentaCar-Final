<?php
    ob_start();
    session_start();


include ('connection.php');

$id=$_SESSION["user_id"]??0;
$s_email=$_SESSION["login_email"]??0;


$findID = mysqli_query($con, "SELECT * FROM user WHERE email= '$s_email'");
if($res1 = mysqli_fetch_array($findID)) {
    $id = $res1['user_id'];
    $_SESSION['user_id']=$id;

}

$findresult = mysqli_query($con, "SELECT * FROM user WHERE user_id= '$id'");
if($res = mysqli_fetch_array($findresult)) {
	
$id = $res['user_id'];
$fullname = $res['fullname'];
$username =$res['user_name'];
$oldusername =$res['user_name'];
$email = $res['email'];   
$phonenumber = $res['contact_num'];  
$image= $res['pic_ID'];
}

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
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="style.css" />

    <title>RentaCar</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" >
        <div class="container p-0" >
            <!--logo-->
            <a class="navbar-brand fs-4" href="#">RentaCar</a>
            <!--toggle button-->
            <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!--sidebar-->
            <div class="sidebar offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <!--sidebar header-->
                <div class="offcanvas-header text-white border-bottom">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">RentaCar</h5>
                    <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <!--sidebar body-->
                <div class="offcanvas-body">

               
                    <ul class="navbar-nav justify-content-center align-items-center fs-5 flex-grow-1">
                        <li class="nav-item image">
                        <?php if($image==NULL){
							echo '<img src="assets/user_profile/profile.png" style="height:150px; width: 150px;" class="rounded-circle mt-5 ">';
						} else { 
							echo '<img src="images/user/'.$image.'" style="height:150px; width: 150px;" class="rounded-circle mt-5">';
                            echo '<br>';
                            echo '<h4 class="fs-4 text-white justify-content-center mt-3" >' . $fullname;
						}
						?>
                        </li>
                        
                        <li class="nav-item mx-3">
                            <a class="nav-link <?= $page == '../index.php'?'active':'' ?>" href="../index.php">Home
                                <span class="sr-only">(current)</span></a>
                        </li>
                         
                        <li class="vert-ruler">
                                <span class="vr align-middle" style="color:white;height: 20px;"></span>
                        </li>

                        <li class="nav-item mx-3">
                            <a class="nav-link <?= $page == '../specialoffers.php'?'active':'' ?>" href="../specialoffers.php">Special Offers</a>
                        </li>
                        <li class="vert-ruler">
                                <span class="vr align-middle" style="color:white; height: 20px;"></span>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link <?= $page == '../vehicles.php'?'active':'' ?>" href="../vehicles.php">Shops</a>
                        </li>
                    </ul>

                    <div class="d-flex justify-content-center align-items-center gap-2">

                        <div class="dropdown drop-notification">

                            <button type="button" class="btn btn-dark border fa fa-bell" data-bs-toggle="dropdown" aria-expanded="false"></button>
                            <span class="notification">0</span>
                            <ul class="dropdown-menu dropdown-menu-lg-end dropdown-notif" aria-labelledby="navbarDropdown">
                               
                                
                            </ul>
                        </div>

                        <li class="nav-item d-flex justify-content-center align-items-center">
                            <a class="nav-links" href="../messages.php?seller_id=0&email=0">
                                <i class="btn btn-dark border fa-regular fa-message"></i>
                            </a>
                        </li>

                        <div class="dropdown">

                            <button type="button" class="btn btn-light dropdown-toggle fa fa-user"
                                data-bs-toggle="dropdown" aria-expanded="false">

                            </button>
                            <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="navbarDropdown">
                                <!--<li><a class="dropdown-item" href="_user-login.php"><i class="fa fa-sign-in"></i> Sign In</a></li>-->
                                <li><a class="dropdown-item" href="profile.php"><i class="fa fa-user"></i> Profile</a>
                                </li>
                                <li><a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out"></i> Log
                                        out</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <script src="/js/jquery-3.3.1.slim.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/jquery-3.3.1.min.js"></script>
    
<!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
<script>
// Function to fetch and display notifications
function fetchNotifications() {
    $.ajax({
        url: 'Template/fetch_notifications_customer.php', // Create a new PHP file to handle fetching notifications
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            var notificationDropdown = $('.dropdown-notif'); // Replace with the appropriate selector for your dropdown

            // Clear existing notifications
            notificationDropdown.empty();

            // Loop through the fetched notifications and add them to the dropdown
			if (data.length === 0) {
                var noNotificationsItem = '<li><a href="#">No notifications</a></li>';
                notificationDropdown.append(noNotificationsItem);
            } else {
            $.each(data, function (index, notification) {
                var notificationItem = '<li><a href="#" class="notification-link" data-notification-id="' + notification.notification_id + '">' + notification.message + '</a></li>';
                notificationDropdown.append(notificationItem);
            });
		}

		$('.notification').text(data.length);

			$('.notification-link').click(function (event) {
                    event.preventDefault();
                    var notificationId = $(this).data('notification-id');

                    // Determine the URL to redirect to based on the account type
                    var redirectUrl = 'userreservation.php';

                    // Redirect to the appropriate page
                    window.location.href = redirectUrl;

                // Send an AJAX request to mark the notification as read
                $.ajax({
                        url: 'Template/delete_notification_customer.php',
                        type: 'POST',
                        data: { notification_id: notificationId },
                        success: function (response) {
                            if (response === 'success') {
                                console.log('Notification deleted successfully.');
                            } else {
                                console.error('Error deleting notification.');
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('AJAX request failed:', error);
                        }
                });
            });
        }
    });
}

// Call the fetchNotifications function when the page loads
$(document).ready(function () {
    fetchNotifications();

    // Set an interval to periodically fetch notifications (e.g., every 5 seconds)
    setInterval(fetchNotifications, 5000);


    // const navOptions = {};
    // const navObs = new IntersectionObserver(navCallback, navOptions);
    // navObs.observe(document.querySelector('header'));
    // function navCallback(entries){
    //     console.log(entries[0].isIntersecting);
    // }
});
</script>

</body>

</html>