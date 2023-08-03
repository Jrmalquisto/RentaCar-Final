<?php
session_start();
$servername = "localhost";
$user = "root";
$password = "";
$database = "rentacar";

$con = new mysqli($servername, $user, $password, $database);

$com_id=$_SESSION['com_id'];

include ('../connection.php');

$findresult = mysqli_query($con, "SELECT * FROM seller WHERE seller_id= '$com_id'");

if($res = mysqli_fetch_array($findresult)){
$image = $res['shop_logo'];
}

?>

<?php
	if(isset($_POST['removeRecord'])){
    	$id = $_POST['id2'];

    	$query = "DELETE FROM salesreport WHERE id='$id' ";
    	$query = mysqli_query($con, $query);

    if($query_run){
        header("location: _manage-sales2.php");
    }
    else {
        header("location: _manage-sales2.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <title>Reservations</title>
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
		<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
		<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />

	   <!--google material icon-->
      <link href="https://fonts.googleapis.com/css2?family=Material+Icons"rel="stylesheet">

  </head>
  <body>
  


<div class="wrapper">
     
	  <div class="body-overlay"></div>
	 
	 <!-------sidebar--design------------>
	 
	 <div id="sidebar">
	    <div class="sidebar-header">
		   <h3><img style="width:40px; height:auto;"  src="../images/shop/<?php echo $res['shop_logo']; ?>"><span>RentaCar</span></h3>
		</div>
		<ul class="list-unstyled component m-0">
		  <li class="dash">
		  <a href=".dashboardCompany.php" class="dashboard"><i class="material-icons">dashboard</i>Dashboard </a>
		  </li>

		  <li class="approval">
		  <a  href="_pending-reservations2.php">
		  <i class="material-icons">summarize</i>Pending Reservations
		  </a>
		  </li>
		  
		  <li class="cars">
		  <a  href="_manage-cars2.php">
		  <i class="material-icons">directions_car</i>Car Management
		  </a>
		  </li>

		  <li class="reserve">
		  <a  href="_manage-reservations2.php">
		  <i class="material-icons">book_online</i>Car Reservation
		  </a>
		  </li>

          <li class="return">
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

          <li class="active">
		  <a  href="#">
		  <i class="material-icons">summarize</i>Sales Report
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
								  <span class="notification">4</span>
								 </a>
								  <ul class="dropdown-menu">
								     <li><a href="#">You Have 4 New Messages</a></li>
									 <li><a href="#">You Have 4 New Messages</a></li>
									 <li><a href="#">You Have 4 New Messages</a></li>
									 <li><a href="#">You Have 4 New Messages</a></li>
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
									 <li><a href="#">
									 <span class="material-icons">settings</span>
									 Settings
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
				    <h4 class="page-title">Sales Report</h4>
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

<div class="col-div-3">
<div class="box">
<p class="total" style="text-align: center;">
	<?php
	$con = new mysqli("localhost", "root", "", "rentacar");
	$query = "SELECT id FROM salesreport WHERE seller_id=$com_id";
	$result = mysqli_query($con, $query);
	$row = mysqli_num_rows($result);echo '' .$row. '';
	?><br/>
	
	<span class="txt" style="text-align: center;">Total Transactions</span>
	</p>
</div>
</div>

<div class="col-div-3">
<div class="box">
<p class="total" style="text-align: center;"><?php
	$con = new mysqli("localhost", "root", "", "rentacar");
	$query2 = "SELECT SUM(additional_fee) AS sum FROM salesreport WHERE seller_id=$com_id";
			$query2_result = mysqli_query($con, $query2);
			while($row1 = mysqli_fetch_assoc($query2_result)){
				$output1 = "₱ ".$row1['sum'];
				echo  $output1;
			}
	?><br/>

	<span class="txt" style="text-align: center;">Damage Fees</span>
	</p>
</div>
</div>

<div class="col-div-3">
<div class="box">
<p class="total" style="text-align: center;"><?php
	$con = new mysqli("localhost", "root", "", "rentacar");
	$query2 = "SELECT SUM(overall_price) AS sum FROM salesreport WHERE seller_id=$com_id";
			$query2_result = mysqli_query($con, $query2);
			while($row1 = mysqli_fetch_assoc($query2_result)){
				$output1 = "₱ ".$row1['sum'];
				echo  $output1;
			}
	?><br/>
	
	<span class="txt" style="text-align: center;">Total Income</span>
	</p>
</div>
</div>

</div>
<!------boxes-end-----------> 
		  

<!------main-content-start-----------> 
<div class="main-content">
	<div class="row">
	<div class="col-md-12">
		<div class="table-wrapper">
			
		<div class="table-title">
			<div class="row">
				<div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
				<h2 class="ml-lg-2">Sales  Report</h2>
				</div>
			
			</div>
		</div>
            
        <table class="table table-striped table-hover" id="myTable">
            <thead>
                <tr>
                <!--<th><span class="custom-checkbox">
                <input type="checkbox" id="selectAll">
                <label for="selectAll"></label></th>-->
                <th width="150">ID</th>
                <th width="200">Vehicle Model</th>
				<th width="100">Plate No.</th>
                <th width="200">Pick-up Date and Time</th>
                <th width="200">Reutrn Date and Time</th>
				<th width="150">No. of Days Rented</th>
				<th width="150">Additional Fee</th>
                <th width="150">Total Amount</th>
				<th width="100">Action</th>
                </tr>
            </thead>
                
                <tbody>
                
                    <!--<th><span class="custom-checkbox">
                    <input type="checkbox" id="checkbox1" name="option[]" value="1">
                    <label for="checkbox1"></label></th>-->
                    
                    <?php
                $servername = "localhost";
                $user = "root";
                $password = "";
                $database = "rentacar";

                $connection = new mysqli($servername, $user, $password, $database);

                if ($connection->connect_error){
                    die("Connection Failed: " . $connection->connect_error);
                }
                $com_id = $_SESSION['com_id'];
                // echo $com_id;
                $sql = "SELECT id,brand,license_plate,pickupdate,returndate,DATEDIFF(returndate,pickupdate) AS date_difference,additional_fee,overall_price FROM salesreport WHERE seller_id=$com_id";
                $result =$connection->query($sql);

				$query1 = "SELECT SUM(overall_price) AS sum FROM salesreport WHERE seller_id=$com_id";
				$query1_result = mysqli_query($connection, $query1);
				while($row = mysqli_fetch_assoc($query1_result)){
					$output = "Total Income:"." "."₱".$row['sum'];
				}

                if (!$result){
                    die("Invalid Query: " . $connection->error);
                }

                while($row = $result->fetch_assoc()) {
                    $id = $row["id"];
                    $vehicle = $row["brand"];
					$license = $row["license_plate"];
                    $pickup = $row["pickupdate"];
                    $return = $row["returndate"];
					$days = $row["date_difference"];
					$fee = $row["additional_fee"];
                    $price = $row["overall_price"];
                ?>

				
                <tr>
                        
                    <td><?php echo $id?></td>
                    <td><?php echo $vehicle?></td>
					<td><?php echo $license?></td>
                    <td><?php echo $pickup?></td>
                    <td><?php echo $return?></td>
					<td><?php echo $days?></td>
					<td><?php echo $fee?></td>
                    <td><?php echo $price?></td>
					<td>
					<form action="_manage-sales2.php" class="d-inline">
							<button type="button" name="del_button" id="del_button" class="btn btn-danger del_button btn-sm" data-bs-toggle="modal" data-bs-target="#deleteSalesModal">
							<i class="material-icons" data-toggle="tooltip" title="Edit">&#xE872;</i>
							</button>
						</form>
					</td>
                   
					
                </tr>
				
				
            <?php
            ;}
                    
            ?>
                    
            </tbody>         
        </table>
	</div>
</div>
					

					   
					 <!----delete-modal start--------->
<div class="modal fade" tabindex="-1" id="deleteSalesModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Record</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

	  <form method="POST" class="d-inline">
      	<div class="modal-body">

			<input type="hidden" id="id2" name="id2"/>
			<p>Are you sure you want to delete this Record</p>
			<p class="text-warning"><small>this action Cannot be Undone,</small></p>
		</div>

      <div class="modal-footer">
		<button type="submit" name="removeRecord" id="removeRecord" class="btn btn-success">Delete</button>
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
		</form>
      </div>
    </div>
  </div>
</div>

					   <!----edit-modal end--------->   

			     </div>
			  </div>
		  
		    <!------main-content-end-----------> 
		  
		 
		 
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
   <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
	</script>
  
  <script>
		$(document).ready(function(){

			$('.del_button').click(function(e){
					
				$('#deleteSalesModal').modal('show');

					$tr=$(this).closest('tr');

					var data = $tr.children("td").map(function(){
						return $(this).text();
					}).get();

					console.log(data);

					$('#id2').val(data[0]);
				
			});
		});
</script>

  <script type="text/javascript">
       $(document).ready(function(){
	      $(".xp-menubar").on('click',function(){
		    $("#sidebar").toggleClass('active');
			$("#content").toggleClass('active');
		  });
		  
		  $('.xp-menubar,.body-overlay').on('click',function(){
		     $("#sidebar,.body-overlay").toggleClass('show-nav');
		  });

		  $('.conf_button').click(function(e){
					// $('#editEmployeeModal').modal('show');

					$tr=$(this).closest('tr');

					var data = $tr.children("td").map(function(){
						return $(this).text();
					}).get();

					console.log(data);

					$('#id1').val(data[0]);
					$('#name1').val(data[1]);
					$('#number1').val(data[2]);
					$('#vehicle1').val(data[3]);
					$('#pickup1').val(data[4]);
					$('#return1').val(data[5]);
					$('#price1').val(data[6]);
				
			});
		  
	   });
  </script>
  
  <script>
        function checkDelete(){
            return confirm('Are you sure you want to delete this record?');
        }
</script>

<script>
        $(document).ready(function(){
			$('#myTable').dataTable();
        });
</script>

  </body>
  
  </html>