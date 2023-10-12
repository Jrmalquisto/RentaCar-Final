<?php
$servername = "localhost";
$user = "root";
$password = "";
$database = "rentacar";

$con = new mysqli($servername, $user, $password, $database);

include ('../connection.php');

$com_id=$_SESSION["com_id"];

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="wrapper">
     
     <div class="body-overlay"></div>
    
    <div class="top-navbar">
		<div class="xd-topbar">
			<div class="row">
				<div class="col-2 col-md-1 col-lg-4 order-2 order-md-1 align-self-center">
				<div class="xp-menubar">
					<span class="material-icons text-white">signal_cellular_alt</span>
				</div>
				</div>
				
				<!-- <div class="col-md-5 col-lg-3 order-3 order-md-2">
					<div class="xp-searchbar">
						<form>
						<div class="input-group">
							<input type="search" class="form-control"
							placeholder="Search">
							<div class="input-group-append">
								<button class="btn" type="submit" id="button-addon2">Go
								</button>
							</div>
						</div>
						</form>
					</div>
				</div> -->
				
				<div class="col-10 col-md-6 col-lg-8 order-1 order-md-3">
					<div class="xp-profilebar text-right">
					<nav class="navbar p-0">
						<ul class="nav navbar-nav flex-row ml-auto">
						<li class="dropdown nav-item">
							<a class="nav-link" href="#" data-toggle="dropdown">
							<span class="material-icons">notifications</span>
							<span class="notification">0</span>
							</a>
							<ul class="dropdown-menu dropdown-notif">
								
							</ul>
						</li>
						
						<li class="nav-item">
						<a class="nav-link" href="/TemplateShop/_company-messages.php">
							<span class="material-icons">question_answer</span>
							</a>
						</li>

						<i class="fas ml-3 me-2"></i><?php echo "<p>" . $_SESSION['shopname'] . "</p>"; ?>
						<li class="dropdown nav-item">
							<a class="nav-link" href="#" data-toggle="dropdown">
							<img style="width:40px; height:auto;"  src="../images/shop/<?php echo $res['shop_logo']; ?>">
							<span class="xp-user-live"></span>
							</a>
							<ul class="dropdown-menu small-menu">
								<li><a href="_company-profile.php">
								<span class="material-icons">person_outline</span>
								Profile
								</a></li>
								<li><a href="_company-login.php">
								<span class="material-icons">logout</span>
								Logout
								</a></li>
								
							</ul>
						</li>
						
						
						</ul>
					</nav>
					</div>
				</div>
				
			</div>
			
			<div class="xp-breadcrumbbar text-center">
			<h4 class="page-title">Cars</h4>
			<!--<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">Vishweb</a></li>
				<li class="breadcrumb-item active" aria-curent="page">Dashboard</li>
			</ol>-->
			</div>
			
			
		</div>
	</div>

	<script src="/js/jquery-3.3.1.slim.min.js"></script>
   <script src="/js/popper.min.js"></script>
   <script src="/js/bootstrap.min.js"></script>
   <script src="/js/jquery-3.3.1.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
// Function to fetch and display notifications
function fetchNotifications() {
    $.ajax({
        url: 'fetch_notifications_shop.php', // Create a new PHP file to handle fetching notifications
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
                    var redirectUrl = '_pending-reservations2.php';

                    // Redirect to the appropriate page
                    window.location.href = redirectUrl;

                // Send an AJAX request to mark the notification as read
                $.ajax({
                        url: 'delete_notification_shop.php',
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
});
</script>
