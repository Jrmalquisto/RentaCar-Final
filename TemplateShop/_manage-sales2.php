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
$verified = $res['verified'];
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
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> 
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
                <th width="200">Return Date and Time</th>
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
                    <td>₱<?php echo $price?></td>
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
        <button type="button" class="close mr-3 mt-2" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

	  <form method="POST" class="d-inline">
      	<div class="modal-body">

			<input type="hidden" id="id2" name="id2"/>
			<p>Are you sure you want to delete this Record</p>
			<p class="text-warning"><medium>this action Cannot be Undone</medium></p>
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
	    //   $(".xp-menubar").on('click',function(){
		//     $("#sidebar").toggleClass('active');
		// 	$("#content").toggleClass('active');
		//   });
		  
		//   $('.xp-menubar,.body-overlay').on('click',function(){
		//      $("#sidebar,.body-overlay").toggleClass('show-nav');
		//   });

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
<?php 
			}
	include ('../TemplateShop/_company-footer.php');
?>
