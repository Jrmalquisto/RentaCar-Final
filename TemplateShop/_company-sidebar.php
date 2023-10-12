<?php
// Define an array to map page filenames to their corresponding sidebar list item class
$page_to_class = [
    'dashboardCompany.php' => 'dash',
    '_pending-reservations2.php' => 'approval',
    '_manage-cars2.php' => 'car_management',
    '_manage-reservations2.php' => 'reserve',
    '_manage-to-be-returned2.php' => 'drivers',
    '_manage-drivers2.php' => 'reserve',
    '_manage-sales2.php' => 'reserve',
    // Add more mappings as needed
];
?>
<div id="content">
	
    <div id="sidebar">
	    <div class="sidebar-header">
		   <h3><img style="width:40px; height:auto;"  src="../images/shop/<?php echo $res['shop_logo']; ?>"><span>RentaCar</span></h3>
		</div>
		<ul class="list-unstyled component m-0">
		  <li class="dash">
		  <a href=".dashboardCompany.php" class="dashboard"><i class="material-icons">dashboard</i>Dashboard</a>
		  </li>

		  <li class="approval">
		  <a  href="_pending-reservations2.php">
		  <i class="material-icons">summarize</i>Pending Reservations
		  </a>
		  </li>
		  
		  <li class="car_management">
		  <a  href="_manage-cars2.php">
		  <i class="material-icons">directions_car</i>Car Management
		  </a>
		  </li>

		  <li class="reserve">
		  <a  href="_manage-reservations2.php">
		  <i class="material-icons">book_online</i>Car Reservation
		  </a>
		  </li>

		  <li class="drivers">
		  <a  href="_manage-to-be-returned2.php">
		  <i class="material-icons">fact_check</i>Cars to be Returned
		  </a>
		  </li>

		  <li class="reserve">
		  <a  href="_manage-drivers2.php">
		  <i class="material-icons">person</i>Drivers
		  </a>
		  </li>

		  <br>

          <li class="reserve">
		  <a  href="_manage-sales2.php">
		  <i class="material-icons">summarize</i>Sales Report
		  </a>
		  </li>
		
		</ul>
	 </div>
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
  <script>
// JavaScript to mark the active page in the sidebar
document.addEventListener("DOMContentLoaded", function () {
    var currentUrl = window.location.href;
    var sidebarLinks = document.querySelectorAll("#sidebar a");

    sidebarLinks.forEach(function (link) {
        if (currentUrl.includes(link.getAttribute("href"))) {
            link.parentElement.classList.add("active");
        }
    });
});
</script>