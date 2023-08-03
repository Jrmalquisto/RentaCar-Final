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
								WHERE user_id='$com_id' 
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

</head>

<body>



    <div class="wrapper">

        <div class="body-overlay"></div>

        <!-------sidebar--design------------>

        <div id="sidebar">
            <div class="sidebar-header">
                <h3><img style="width:40px; height:auto;"
                        src="../images/shop/<?php echo $res['shop_logo']; ?>"><span>RentaCar</span></h3>
            </div>
            <ul class="list-unstyled component m-0">
                <li class="dash">
                    <a href=".dashboardCompany.php" class="dashboard"><i
                            class="material-icons">dashboard</i>Dashboard</a>
                </li>

                <li class="approval">
                    <a href="_pending-reservations2.php">
                        <i class="material-icons">summarize</i>Pending Reservations
                    </a>
                </li>

                <li class="cars">
                    <a href="_manage-cars2.php">
                        <i class="material-icons">directions_car</i>Car Management
                    </a>
                </li>

                <li class="reserve">
                    <a href="_manage-reservations2.php">
                        <i class="material-icons">book_online</i>Car Reservation
                    </a>
                </li>

                <li class="drivers">
                    <a href="_manage-to-be-returned2.php">
                        <i class="material-icons">fact_check</i>Cars to be Returned
                    </a>
                </li>

                <li class="reserve">
                    <a href="_manage-drivers2.php">
                        <i class="material-icons">person</i>Drivers
                    </a>
                </li>

                <br>

                <li class="reserve">
                    <a href="_manage-sales2.php">
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
                                            <a class="nav-link" href="#">
                                                <span class="material-icons">question_answer</span>
                                            </a>
                                        </li>

                                        <i
                                            class="fas ml-3 me-2"></i><?php echo "<p>" . $_SESSION['shopname'] . "</p>"; ?>
                                        <li class="dropdown nav-item">
                                            <a class="nav-link" href="#" data-toggle="dropdown">
                                                <img style="width:40px; height:auto;"
                                                    src="../images/shop/<?php echo $res['shop_logo']; ?>">
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

                        <h4 class="page-title">Messages</h4>
                        <!--<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">Vishweb</a></li>
				<li class="breadcrumb-item active" aria-curent="page">Dashboard</li>
			</ol>-->
                    </div>


                </div>
            </div>
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
            <script src="/js/jquery-3.3.1.slim.min.js"></script>
            <script src="/js/popper.min.js"></script>
            <script src="/js/bootstrap.min.js"></script>
            <script src="/js/jquery-3.3.1.min.js"></script>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
                crossorigin="anonymous">
            </script>
            <script type="text/javascript">
            $(document).ready(function() {
                $(".xp-menubar").on('click', function() {
                    $("#sidebar").toggleClass('active');
                    $("#content").toggleClass('active');
                });

                $('.xp-menubar,.body-overlay').on('click', function() {
                    $("#sidebar,.body-overlay").toggleClass('show-nav');
                });
   

            });
            </script>
<script>
	$(document).ready(function() {
		var convo_div = document.getElementById("convo");
		convo_div.scrollTop = convo_div.scrollHeight;
	});
</script>
</body>

</html>