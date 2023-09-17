<?php
session_start();
$servername = "localhost";
$user = "root";
$password = "";
$database = "rentacar";

$con = new mysqli($servername, $user, $password, $database);

$com_id=$_SESSION["com_id"];

include ('../connection.php');

$findresult = mysqli_query($con, "SELECT * FROM seller WHERE seller_id= '$com_id'");

if($res = mysqli_fetch_array($findresult)){
$image = $res['shop_logo'];
$verified = $res['verified'];

}


if(isset($_POST['update_res'])){
	$id = $_POST['id1'];
	$item_id = $_POST['item_id1'];

	$result = mysqli_query($con,"UPDATE reservation SET status='Reserved' WHERE id='$id'");
	$query =  mysqli_query($con,"UPDATE product SET status=1 WHERE item_id='$item_id'");

	if($result){
		//$_SESSION['status'] = "Your profile has been updated";
		header("location:/TemplateShop/_pending-reservations2.php");
	} else {
		$error[]='Something went wrong';
	}
	if($query){
		//$_SESSION['status'] = "Your profile has been updated";
		header("location:/TemplateShop/_pending-reservations2.php");
	} else {
		$error[]='Something went wrong';
	}
		

}
?>

<?php
	if(isset($_POST['removePending'])){
    	$id = $_POST['id2'];

    	$query = "DELETE FROM reservation WHERE id='$id' AND status='Pending' ";
    	$query = mysqli_query($con, $query);

    if($query_run){
        header("location: /TemplateShop/_pending-reservations2.php");
    }
    else {
        header("location: /TemplateShop/_pending-reservations2.php");
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>   <script src="/js/popper.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
  </head>
  <body>
  


<div class="wrapper">
     
	  <div class="body-overlay"></div>
	 
	 <!-------sidebar--design------------>
	 
	 <?php 
	 	include ('../TemplateShop/_company-sidebar.php');
	 ?>
	
	 
   <!-------sidebar--design- close----------->
   
   
   
      <!-------page-content start----------->
   
 
	     
		  <!------top-navbar-start-----------> 
		     
		<?php 
			include ('../TemplateShop/_company-header.php');
			if($verified==0){
				include ('../TemplateShop/_not-verified.php');

			} else {
		?>
		  <!------top-navbar-end-----------> 

		  

		   <!------main-content-start-----------> 
		      <div class="main-content">
			     <div class="row">
				    <div class="col-md-12">
					   <div class="table-wrapper">
					     
					   <div class="table-title">
					     <div class="row">
						     <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
							    <h2 class="ml-lg-2">Pending  Reservations</h2>
							 </div>
							 <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
							   <a href="_manage-reservations-chauffeur2.php" class="btn btn-success">
							   <i class="material-icons">&#xF217;</i>
							   <span>Reservations with Driver</span>
							   </a>
							   <!--<a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal">
							   <i class="material-icons">&#xE15C;</i>
							   <span>Delete</span>
							   </a>-->
							 </div>
					     </div>
					   </div>
					   
					<table class="table table-striped table-hover" id="myTable">
					    <thead>
						    <tr>
							<!--<th><span class="custom-checkbox">
							<input type="checkbox" id="selectAll">
							<label for="selectAll"></label></th>-->
							<th scope="col" width="50">#</th>
							<th scope="col">Item ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Contact Number</th>
                            <th scope="col">Vehicle</th>
							<th scope="col">License Plate</th>
                            <th scope="col">Pick-up Date</th>
                            <th scope="col">Return Date</th>
                            <th scope="col">Total Amount</th>
							<th scope="col">With Driver</th>
                            <th scope="col">Status</th>
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
                            $sql = "SELECT * FROM reservation WHERE seller_id = $com_id AND status = 'Pending'";
                            $result =$connection->query($sql);

                            if (!$result){
                                die("Invalid Query: " . $connection->error);
                            }

                            while($row = $result->fetch_assoc()) {
                                $id = $row["id"];
								$item_id = $row["item_id"];
                                $name = $row["user_name"];
                                $number = $row["number"];
                                $vehicle = $row["brand"];
								$license = $row["license_plate"];
                                $pickup = $row["pickupdate"];
                                $return = $row["returndate"];
                                $price = $row["overall_price"];
								$driver = $row["driver_stat"];
                                $status = $row["status"];
                            ?>

                            <tr>
                                    
                                <td><?php echo $id?></td>
								<td><?php echo $item_id?></td>
                                <td><?php echo $name?></td>
                                <td><?php echo $number?></td>
                                <td><?php echo $vehicle?></td>
								<td><?php echo $license?></td>
                                <td><?php echo $pickup?></td>
                                <td><?php echo $return?></td>
                                <td><?php echo $price?></td>
								<td><?php echo $driver?></td>
                                <td><?php echo $status?></td>
                                <td>
									<div class="row">
										<form action="#" method="POST" class="d-inline" >
										<!-- <button type="submit" name="conf_button" id="conf_button" class="btn btn-success conf_button mr-2" > -->
										<button type="button" name="conf_button" id="conf_button" class="btn btn-success conf_button mr-2" data-bs-toggle="modal" data-bs-target="#confirm_modal" >
										<i class="material-icons" data-toggle="tooltip" title="Edit">&#xe876;</i>
										</button>
									</form>

									<form action="_pending-reservations2.php" class="d-inline">
										<button type="button" name="del_button" id="del_button" class="btn btn-danger del_button btn-sm" data-bs-toggle="modal" data-bs-target="#deleteReservationModal">
										<i class="material-icons" data-toggle="tooltip" title="Edit">&#xE872;</i>
										</button>
									</form>
									</div>
                                </td>
                            </tr>
                        <?php
                        ;}
                               
                        ?>

							 
					</tbody>     
				</table>
	</div>
</div>
					


					   <!----edit-modal end--------->	   

<div class="modal fade" id="confirm_modal" tabindex="-1" role="dialog">

	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">

	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<form method="POST" enctype="multipart/form-data">
						<input type="hidden" id="id1" name="id1"  />
						<input type="hidden" id="item_id1" name="item_id1"  />

					<h5>Confirm Reservation</h5>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" name="update_res" id="update_res" class="btn btn-danger" >Reserve</button>
				</div>
			</form>
	</div>

	</div>
</div>
					   
					 <!----delete-modal start--------->
<div class="modal fade" tabindex="-1" id="deleteReservationModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Reservation</h5>
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
	  	<button type="submit" name="removePending" id="removePending" class="btn btn-success">Delete</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>

	  </form>

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
   <!-- <script src="/js/jquery-3.3.1.slim.min.js"></script>
   <script src="/js/popper.min.js"></script>
   <script src="/js/bootstrap.min.js"></script>
   <script src="/js/jquery-3.3.1.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
	</script>
   -->

  <script>
		$(document).ready(function(){
			// $('.conf_button').click(function(e){
					
	
			// 			$tr=$(this).closest('tr');
	
			// 			var data = $tr.children("td").map(function(){
			// 				return $(this).text();
			// 			}).get();
	
			// 			console.log(data);
	
			// 			$('#id2').val(data[0]);
					
			// 	});
			$('.del_button').click(function(e){
					
				$('#deleteReservationModal').modal('show');

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
					$('#confirm_modal').modal('show');

					$tr=$(this).closest('tr');

					var data = $tr.children("td").map(function(){
						return $(this).text();
					}).get();

					console.log(data);

					$('#id1').val(data[0]);
					$('#item_id1').val(data[1]);
					$('#name1').val(data[2]);
					$('#number1').val(data[3]);
					$('#vehicle1').val(data[4]);
					$('#license1').val(data[5]);
					$('#pickup1').val(data[6]);
					$('#return1').val(data[7]);
					$('#price1').val(data[8]);
				
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

<?php 
			}
	include ('../TemplateShop/_company-footer.php');
?>
