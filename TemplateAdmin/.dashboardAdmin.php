<?php
session_start();
$servername = "localhost";
$user = "root";
$password = "";
$database = "rentacar";

$con = new mysqli($servername, $user, $password, $database);

$admin_id=$_SESSION["admin_id"];

include ('../connection.php');

$findresult = mysqli_query($con, "SELECT * FROM admin WHERE admin_id= '$admin_id'");

if($res = mysqli_fetch_array($findresult)){
$id = $res['admin_id'];
$username = $res['user_name'];
$adminname = $res['admin_name'];
$pass = $res['admin_pass']; 
$img = $res['admin_image'];
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <title>Dashboard</title>
	    <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="/css/bootstrap.min.css">
	    <!----css3---->
        <link rel="stylesheet" href="/css/custom.css">
		
		
		<!--google fonts -->
	    <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
	
	
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


	   <!--google material icon-->
      <link href="https://fonts.googleapis.com/css2?family=Material+Icons"rel="stylesheet">

  </head>
  <body>
  


<div class="wrapper1">
     
	  <div class="body-overlay"></div>
	 
	 <!-------sidebar--design------------>
	 
	 <div id="sidebar">
	    <div class="sidebar-header">
		<h3><img style="width:40px; height:auto;" src="../images/admin/<?php echo $res['admin_image']; ?>"
                        class="img-fluid"><span><?php echo $_SESSION['user_name']; ?></span></h3>
		
		</div>
		<ul class="list-unstyled component m-0">
		  <li class="active">
		  <a href="#" class="dashboard"><i class="material-icons">dashboard</i>Dashboard </a>
		  </li>
		  
		  <li class="dropdown">
		  <a  href="_manage-shops2.php">
		  <i class="material-icons">store</i>Manage Shops
		  </a>
		  </li>

		  <li class="reserve">
		  <a  href="_manage-users2.php">
		  <i class="material-icons">person_outline</i>Manage Users
		  </a>
		  </li>
		
		</ul>
	 </div>
	 
   <!-------sidebar--design- close----------->
   
   
   
      <!-------page-content start----------->
   
      <div id="content">
	     
		  <!------top-navbar-start-----------> 
		     
		  <div class="top-navbar">
		     <div class="xd-topbar">
			     <div class="row">
				     <div class="col-2 col-md-1 col-lg-1 order-2 order-md-1 align-self-center">
					    <div class="xp-menubar">
						    <span class="material-icons text-white">signal_cellular_alt</span>
						</div>
					 </div>
					 
					 <div class="col-md-5 col-lg-3 order-3 order-md-2">
					     <!-- <div class="xp-searchbar">
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
						 </div> -->
					 </div>
					 
					 
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
								     <li><a href="#">You Have 4 New Messages</a></li>
									 <li><a href="#">You Have 4 New Messages</a></li>
									 <li><a href="#">You Have 4 New Messages</a></li>
									 <li><a href="#">You Have 4 New Messages</a></li>
								  </ul>
							   </li>
							   
							   <!-- <li class="nav-item">
							     <a class="nav-link" href="#">
								   <span class="material-icons">question_answer</span>
								 </a>
							   </li> -->

							   <i class="fas"></i><?php echo "<p>" . $_SESSION['user_name'] . "</p>"; ?>
							   <li class="dropdown nav-item">
							     <a class="nav-link" href="#" data-toggle="dropdown">
								 <img style="width:40px; height:auto;" src="../images/admin/<?php echo $res['admin_image']; ?>">
								  <!-- <img src="/img/admin.png" style="width:40px; border-radius:50%;"/> -->
								  <span class="xp-user-live"></span>
								 </a>
								  <ul class="dropdown-menu small-menu">
								     <li><a href="_admin-profile.php">
									 <span class="material-icons">person_outline</span>
									 Profile
									 </a></li>
									 <li><a href="#">
									 <span class="material-icons">settings</span>
									 Settings
									 </a></li>
									 <li><a href="_admin-login.php">
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
				    <h4 class="page-title">Dashboard</h4>
					<!--<ol class="breadcrumb">
					  <li class="breadcrumb-item"><a href="#">Vishweb</a></li>
					  <li class="breadcrumb-item active" aria-curent="page">Dashboard</li>
					</ol>-->
				 </div>
				 
				 
			 </div>
		  </div>
		  <!------top-navbar-end-----------> 

		  <!------boxes-start-----------> 
		<div class="boxes">
			
		<a href="/TemplateAdmin/_manage-shops2.php">
		<div class="col-div-6">
		<div class="box1">
        <p><?php
            $con = new mysqli("localhost", "root", "", "rentacar");
            $query = "SELECT seller_id FROM seller";
            $result = mysqli_query($con, $query);
            $row = mysqli_num_rows($result);echo '' .$row. '';
            ?><br/>
			<i class="fa fa-shop box-icon px-3" id="boxIcon2"></i>
			</p>
            <span>Total Shops Registered</span>
			
		</div>
		</div>
		</a>

		<a href="/TemplateAdmin/_manage-users2.php">
		<div class="col-div-6">
		<div class="box1">
		<p>
			<?php
            $con = new mysqli("localhost", "root", "", "rentacar");
            $query = "SELECT user_id FROM user";
            $result = mysqli_query($con, $query);
            $row = mysqli_num_rows($result);echo '' .$row. '';
            ?><br/>
			<i class="fa fa-users box-icon px-3" id="boxIcon1"></i>
			</p>
            <span>Total Users Registered</span>
			
		</div>
		</div>
		</a>

		

		</div>
	<!------boxes-end-----------> 

		 <!----footer-design------------->
		 
		 <!--<footer class="footer">
		    <div class="container-fluid">
			   <div class="footer-in">
			      <p class="mb-0">© RentaCar 2023 . All Rights Reserved.</p>
			   </div>
			</div>
		 </footer>-->
		 
		 
		 
		 
	  </div>
   
</div>



<!-------complete html----------->





  
     <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="/js/jquery-3.3.1.slim.min.js"></script>
   <script src="/js/popper.min.js"></script>
   <script src="/js/bootstrap.min.js"></script>
   <script src="/js/jquery-3.3.1.min.js"></script>
  
  
  <script type="text/javascript">
       $(document).ready(function(){
	      $(".xp-menubar").on('click',function(){
		    $("#sidebar").toggleClass('active');
			$("#content").toggleClass('active');
		  });
		  
		  $('.xp-menubar,.body-overlay').on('click',function(){
		     $("#sidebar,.body-overlay").toggleClass('show-nav');
		  });
		  
	   });
  </script>
  
  
<!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
// Function to fetch and display notifications
function fetchNotifications() {
    $.ajax({
        url: 'fetch_notifications.php', // Create a new PHP file to handle fetching notifications
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
                var notificationItem = '<li><a href="#" class="notification-link" data-notification-id="' + notification.notification_id + '" data-account-type="' +notification.account_type + '">' + notification.message + '</a></li>';
                notificationDropdown.append(notificationItem);
            });
		}

		$('.notification').text(data.length);

			$('.notification-link').click(function (event) {
                    event.preventDefault();
                    var notificationId = $(this).data('notification-id');
                    var accountType = $(this).data('account-type');

                    // Determine the URL to redirect to based on the account type
                    var redirectUrl = accountType === 'customer' ? '_manage-users2.php' : '_manage-shops2.php';

                    // Redirect to the appropriate page
                    window.location.href = redirectUrl;

                // Send an AJAX request to mark the notification as read
                $.ajax({
                        url: 'delete_notification.php',
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


  </body>
  
  </html>


