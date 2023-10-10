<?php


$servername = "localhost";
$user = "root";
$password = "";
$database = "rentacar";

$con = new mysqli($servername, $user, $password, $database);

include ('message-commands.php');   

$com_id = $_SESSION["com_id"];

//   function dd($data) {
// 	echo "<pre>";
// 	print_r(var_dump($data));
// 	die;
// }

$result = mysqli_query($con, "SELECT * FROM seller WHERE seller_id = '$com_id'");
if ($res = mysqli_fetch_array($result)) {
	$shopname = $res['shopname'] ?? '';
	$username = $res['username']  ?? '';
    $address = $res['address']  ?? '';
	$email = $res['email']  ?? '';
	$contact = $res['contact_num']  ?? '';
	$logo = $res['shop_logo']  ?? '';
}

// $users = mysqli_query($con, "SELECT * FROM user");

// echo print_r($b);

// $convo_query = "SELECT * FROM messages 
// 								JOIN seller ON seller.seller_id = messages.to_id
// 								WHERE to_id='$com_id' 
								 
// 								ORDER BY to_id DESC";
// $convo_query = mysqli_query($con, $convo_query);
// $convos = array();

// while ($convo_row = mysqli_fetch_assoc($convo_query)) {
// 	$convo_id = $convo_row['convo_id'];
// 	$sql = "SELECT *
// 	        FROM messages
// 					WHERE convo_id = '$convo_id'";

// 	$message_query = mysqli_query($con, $sql);

// 	$messages = [];

// 	while ($message_row = mysqli_fetch_assoc($message_query)) {
// 		array_push($messages, $message_row);
// 	}

// 	$convo_row['messages'] = $messages;
// 	$convos[] = $convo_row;
// }
  ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Message</title>
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
                        
                            <?php 
                            $users1 = mysqli_query($con, "SELECT  * FROM messages 
                                                        WHERE messages.to_email='$email' OR messages.email='$email'

                                                        ORDER BY messages.message_id DESC");


                            if ($users1->num_rows === 0){
                                    echo '<div class="no_message container-fluid side-nav">
                                    <ul class = "d-flex flex-column"style="list-style: none;">
                                        <li class="text-s font-weight-bold mb-1 rounded">
                                            <small class="preview text-muted text-truncate">No Messages</small>
                                        </li>
                                    </ul>
                                </div>'; 

                            }else{

                                while ($res1 = mysqli_fetch_array($users1)) {
                                    $shop_id[] = $res1['email'] ?? $array;
                                    $shop_arr[] = $res1['to_email'] ?? $array;
                                }
                            
                                $i = 0;
                                    
                                $a = array_unique($shop_id)??$array;
                            
                                while ($i < count($a)) {
                                    $b[$i] = array_values($a)[$i];
                                    $i++;
                                }
                            
                                if (($key = array_search($email, $b)) !== false) {
                                    unset($b[$key]);
                                }
                                $m=0;
                            
                                while ($m < count($b)) {
                                    $c[$m] = array_values($b)[$m];
                                    $m++;
                                }
                            
                            
                            ?>                         
                            <div class="container-fluid">
                                <ul class = "d-flex flex-column"style="list-style: none;">
                    
                                    <?php
                                    // foreach ($c as $row) {
                                        $n=0;
                                        // echo print_r($c);
                                    while ($n < count($c)) {
                                        $user1 = mysqli_query($con, "SELECT * FROM user WHERE email = '$c[$n]'");
                                        // echo print_r($c);

                                        foreach ($user1 as $rows1){
                                            // echo print_r($rows1["user_name"]);
                                            // echo print_r($c);
                                    ?>
                                            
                                                <!-- <option value="<?= $row['seller_id'] ?>"> <?= $row['shopname'] ?></option> -->
                                                <li class="text-s font-weight-bold mb-0"> 
                                                    <a href="_company-message.php?user_id=<?= $rows1['user_id'] ?>&email=<?=$rows1['email']?>" style="color:#333;text-decoration: none;">
                                                        <?php echo $rows1["user_name"] ?>

                                                    </a>

                                                </li>

                                    <?php 
                                        }
                                        $n++;
                                    } 
                                    
                                
                                    
                                }?>
                                </ul>
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