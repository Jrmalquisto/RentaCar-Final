<?php


$servername = "localhost";
$user = "root";
$password = "";
$database = "rentacar";

$con = new mysqli($servername, $user, $password, $database);

include ('message-commands.php');   

$com_id=$_SESSION["com_id"];

  function dd($data) {
	echo "<pre>";
	print_r(var_dump($data));
	die;
}

$result = mysqli_query($con, "SELECT * FROM seller WHERE seller_id = '$com_id'");
if ($res = mysqli_fetch_array($result)) {
	$shopname = $res['shopname'] ?? '';
	$username = $res['username']  ?? '';
    $address = $res['address']  ?? '';
	$email = $res['email']  ?? '';
	$contact = $res['contact_num']  ?? '';
	$logo = $res['shop_logo']  ?? '';
}

$users = mysqli_query($con, "SELECT * FROM seller");

$convo_query = "SELECT * FROM convo 
								JOIN seller ON seller.seller_id = convo.recipient
								WHERE seller_id='$com_id' 
								OR recipient='$com_id' 
								ORDER BY convo_id DESC";
$convo_query = mysqli_query($con, $convo_query);
$convos = array();

while ($convo_row = mysqli_fetch_assoc($convo_query)) {
	$convo_id = $convo_row['convo_id'];
	$sql = "SELECT *
	        FROM messages
					WHERE convo_id = '$convo_id'";

	$message_query = mysqli_query($con, $sql);

	$messages = [];

	while ($message_row = mysqli_fetch_assoc($message_query)) {
		array_push($messages, $message_row);
	}

	$convo_row['messages'] = $messages;
	$convos[] = $convo_row;
}
  ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Cars</title>
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
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
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
                               
                                    </div>
                                    <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
                                        <a class="btn btn-success" data-toggle="modal" data-target="#messageModal">
                                            <i class="material-icons">&#xE147;</i>
                                            <span>New Message</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>

                                        <th width="100">Recipient</th>
                                        <th width="100">Subject</th>
                                        <th width="100">Message</th>
                                        <th width="100">Date</th>


                                    </tr>
                                </thead>

                                <tbody>
                  <?php foreach ($convos as $row) { ?>
                    <tr>
                    <?php if ($row['seller_id'] == $com_id) { ?>

                      <td>
                      <div class="d-flex px-2 py-1">
                          <div>
                            
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><a href="_company-message.php?convo_id=<?= $row['convo_id'] ?>" style="color:#333;text-decoration: none;"><?= $row['email'] ?></a> </h6>
                          </div>
                        </div>            
                      </td>
                      
                      <?php } else { ?>

                      <td>
                        <p class="text-s font-weight-bold mb-0"> <a href="_company-message.php?convo_id=<?= $row['convo_id'] ?>" style="color:#333;text-decoration: none;"><?= $email ?></a> </p>
                      </td>

                      <?php } ?>
                      <td>
                      <p class="text-s font-weight-bold mb-0"> <a href="_company-message.php?convo_id=<?= $row['convo_id'] ?>" style="color:#333;text-decoration: none;"><?= $row['subject'] ?></a>  </p>
                      </td>

                      <td>
                      <p class="text-s font-weight-bold mb-0"> <a href="_company-message.php?convo_id=<?= $row['convo_id'] ?>" style="color:#333;text-decoration: none;"><?= $row['messages'][count($row['messages']) - 1]['message'] ?></a>  </p>
                      </td>
                    
                      <td>
                      <p class="text-s font-weight-bold mb-0"> <a href="_company-message.php?convo_id=<?= $row['convo_id'] ?>" style="color:#333;text-decoration: none;"><?= $row['convo_added'] ?></a>  </p>
                      </td>
                      
                    <?php } ?>
                    <?php if (!$convos) { ?>   
                        
                    <?php } ?>
                  </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!------main-content-end----------->

<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageLabel">Compose Message</h5>
                
            </div>
            <div class="modal-body">
					<form action="" method="POST" id="frmMessage" enctype="multipart/form-data">
						<input type="hidden" value="compose" name="compose">
						<div class="form-group">
							<label>Recepient</label>
							<select class="form-control" name="recipient" required>
								<option value="">- select recipient -</option>
								<?php foreach ($users as $row) { ?>
									<?php if ($row['seller_id'] != $com_id) { ?>
										<option value="<?= $row['seller_id'] ?>"> <?= $row['shopname'] ?></option>
									<?php } ?>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label>Subject</label>
							<input type="text" class="form-control" name="subject" required>
						</div>
						<div class="form-group">
							<label>Message</label>
							<textarea name="message" rows="4" class="form-control" required></textarea>
						</div>
						<div class="form-group">
                            <label>Attachment</label>
							<input type="file" name="attachment" accept="image/*,video/*" class="form-control">
						</div>
					</form>
				</div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" form="frmMessage">Send Message</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>       
            </div>
        </div>
    </div>
</div>


            <!----footer-design------------->

            <!--<footer class="footer">
		    <div class="container-fluid">
			   <div class="footer-in">
			      <p class="mb-0">© RentaCar 2023 . All Rights Reserved.</p>
			   </div>
			</div>	 
	  </div> 
</div>

<!-------complete html----------->






            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
           
            <script type="text/javascript">
            $(document).ready(function() {
                // $(".xp-menubar").on('click', function() {
                //     $("#sidebar").toggleClass('active');
                //     $("#content").toggleClass('active');
                // });

                // $('.xp-menubar,.body-overlay').on('click', function() {
                //     $("#sidebar,.body-overlay").toggleClass('show-nav');
                // });
   

            });
            </script>
<script>
	$(document).ready(function() {
		var convo_div = document.getElementById("convo");
		convo_div.scrollTop = convo_div.scrollHeight;
	});
</script>
<?php 
    include ('../TemplateShop/_company-footer.php');
?>
