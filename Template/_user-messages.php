<?php

$servername = "localhost";
$user = "root";
$password = "";
$database = "rentacar";

$con = new mysqli($servername, $user, $password, $database);

   

$com_id = $_SESSION["user_id"];
$email = $_SESSION["email"];

$u_email = $_GET['email'];
$seller_id = $_GET["seller_id"];

//   function dd($data) {
// 	echo "<pre>";
// 	print_r(var_dump($data));
// 	die;
// }

$result = mysqli_query($con, "SELECT * FROM user WHERE user_id = '$com_id'");
if ($res = mysqli_fetch_array($result)) {
	
	$username = $res['user_name']  ?? '';
    $email = $res['email'] ?? '';
}

// $users = mysqli_query($con, "SELECT user.user_id FROM user 
//  								INNER JOIN messages ON user.user_id = messages.to_id
//  								WHERE to_id='$com_id' 
								 
// 								ORDER BY to_id DESC");

//Get data from recepients 
// $seller_mess = mysqli_query($con, "SELECT  * FROM messages 
//                                 INNER JOIN seller ON seller.email = messages.from_email
//                                 WHERE from_email='$email' 

//                                 ORDER BY to_email DESC");

// if ($res1 = mysqli_fetch_array($seller_mess)) {
	
// 	$username = $res1['user_name']  ?? '';
//     $shop_email = $res1['email'] ?? '';
// }
// $get = mysql_fetch_array($users);

// while ($res1 = mysqli_fetch_array($users)) {
// 	$shop_id[] = $res1['from_id'] ?? '';
// }
// $users = mysqli_query($con, "SELECT  * FROM messages 
//                                 INNER JOIN user ON user.email = messages.to_email
//                                 WHERE to_email='$email' 

//                                 ORDER BY to_email DESC");
// // $get = mysql_fetch_array($users);
// while ($res1 = mysqli_fetch_array($users)) {
// 	$shop_id[] = $res1['from_id'] ?? '';
// }

// $i = 0;

// // Get Unique Array
// $a = array_unique($shop_id);

// // $b = $a;



// while ($i < count($a)) {
// 	$b[$i] = array_values($a)[$i];
//     $i++;
// }




// $seller = mysqli_query($con, "SELECT * FROM seller WHERE seller_id = '$a'");

// $users = mysqli_query($con, "SELECT * FROM user 
//                                 JOIN messages ON user.user_id = messages.to_id
//                                 WHERE to_id='$com_id' 

//                                 ORDER BY to_id DESC");


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

<?php


include ('connection.php');

$id=$_SESSION["user_id"];

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
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="style1.css">
    <!-- <link rel="stylesheet" href="/css/custom.css"> -->
    <!-- <link rel="stylesheet" href="../TemplateShop/assets/css/style.css"> -->




    <!--google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">



    <!--google material icon-->
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <style>
         .meta .name {
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
         .meta .preview {
            margin: 5px 0 0 0;
            padding: 0 0 1px;
            font-weight: 400;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            -moz-transition: 1s all ease;
            -o-transition: 1s all ease;
            -webkit-transition: 1s all ease;
            transition: 1s all ease;
        }
    </style>
</head>

<body>


<!-- <div class="body-overlay"></div> -->
    <div class="wrapper">
        <!-- <div class="row"> -->

            <!-------sidebar--design- close----------->
            <div class=" color_left " id="color_left">
                <?php include ('Template/_user-side-contact.php'); ?>
            </div>

            <div class="color_right" id="color_right">
                <!-- <div class="p-5 py-5">
                <div class="d-flex justify-content-between align-items-center mt-3">
							<h4 class="text-right">Messages</h4>
						</div>
                    <div id="content"> -->


                        <!------main-content-start----------->
                        <!-- <div class="main-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-wrapper">

                                        <div class="table-title">
                                            <div class="row">
                                                <div
                                                    class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">

                                                </div>
                                                <div
                                                    class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
                                                    <a class="btn btn-success" data-toggle="modal"
                                                        data-target="#messageModal">
                                                        <i class="material-icons">&#xE147;</i>
                                                        <span>New Message</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div> -->
                        <div class="container-fluid py-4 main-container">
                            <div class=" mb-6">
                               

                                <div class="row">
                                    <div class="row col-14 border-right pr-0">
                                        
                                        <div class="xp-menubar ps-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                                            </svg>
                                        </div>

                                        <!-- //If statement if no display -->

                                        <?php 
                                        
                                        if ($u_email == 0 && $seller_id == 0){

                                        ?>
                                         <div class="cover-container p-5 d-flex flex-column">

                                            <div class="container justify-content-between align-items-center">
                                                    <p class="text-muted " style=" color:black; font-family:'Poppins',sans-serif; text-align:center;">Select chat to start messaging</p>
                                                    <!-- <small style="font-size:18px; color:white; font-family:'Poppins',sans-serif;">You have no messages</small> -->
                                            </div>
                                        </div>

                                        <?php 
                                        } else {

                                        ?>
                                        <!-- //Here starts the display of messages -->
                                        <div class="p-5 pb-0">

                                        
                                            <div class="d-flex justify-content-between align-items-center mt-3 mb-3">
                                                    <!-- <h4 style="font-size:30px; color:white; font-family:'Poppins',sans-serif;">Subject: <?= $convo['subject'] ?></h4>
                                                    <small style="font-size:18px; color:white; font-family:'Poppins',sans-serif;">Conversation with <?= $convo['email'] ?></small> -->
                                            </div>
                                            
                                            <div class="mt-2 pt-3 border-top">

                                             
                                                <div class="messages" id="messages">
                                                    
                                                </div>

                                                <div class="mt-3">
                                                <div class="statusMsg"id="statusMsg"></div>
                                                    <form action="" id="form12" method="POST" enctype="multipart/form-data">
                                                        <div class="textarea-container">
                                                        <input hidden id="cust_email" type="text" name="cust_email" value="<?= $email ?>">
                                                        <input hidden id="seller_email" type="text" name="seller_email" value="<?= $u_email ?>">
                                                        <input hidden id="cust_id" type="text" name="cust_id" value="<?= $com_id ?>">
                                                        <input hidden id="seller_id" type="text" name="seller_id" value="<?= $seller_id ?>">
                                                        <div class="submit-field">
                                                            
                                                            <div class="d-flex flex-row  ">
                                                               
                                                                
                                                                <div class="w-100" style="position:relative;">
                                                                    <label for="fimage" class="attach">    
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-paperclip" style="cursor: pointer;" viewBox="0 0 16 16">
                                                                            <path d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0V3z"/>
                                                                        </svg>
                                                                    </label>

                                                                    

                                                                    <textarea textarea id="mytext" class="form-control mt-2" rows="1" name="mytext"  placeholder="Enter reply.." ></textarea>
                                                                    <input  type="file" id="fimage" name="attachment" id="attachment" class="btn mt-2" accept="image/*,video/*" style="display:none; visibility: none;">

                                                                </div>

                                                           
                                                                <div class="flex-shrink-1">
                                                                    <button type="button" value="Send Reply" class="btn button-update" id="send3"  >
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-send" viewBox="0 0 16 16">
                                                                            <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
                                                                        </svg>
                                                                    </button>
                                                                </div>

                                                            </div>


                                                        </div>
                                                        <!-- <input type="submit" value="Send Reply" class="btn button-update" name="send1" id="send1" > -->
                                                        <!-- SEND REPLY //index.js/ -->
                                                        <label for="fimage"><i class="bi bi-paperclip"></i></label>
                                                        
                                                        <!-- <iconify-icon icon="entypo:attachment" class="attachment-icon"></iconify-icon> -->
                                                        <input type="file" id="fimage" name="attachment" id="attachment" class="btn mt-2" accept="image/*,video/*" style="display:none;">
                                                        </div>
                                                    </form>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    <?php 
                                     }
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                <!-- </div> -->
            </div>


                <!-------page-content start----------->


                <!------main-content-end----------->

                <!-- <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageLabel"
                    aria-hidden="true">
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
                                        <input type="file" name="attachment" accept="image/*,video/*"
                                            class="form-control">
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
                </div> -->


                <!----footer-design------------->

                <!--<footer class="footer">
		    <div class="container-fluid">
			   <div class="footer-in">
			      <p class="mb-0">© RentaCar 2023 . All Rights Reserved.</p>
			   </div>
			</div>	 
	  </div> 
</div>

-----complete html----------->






                <!-- Optional JavaScript -->
                <!-- jQuery first, then Popper.js, then Bootstrap JS -->
                <script src="/js/jquery-3.3.1.slim.min.js"></script>
                <script src="/js/popper.min.js"></script>
                <script src="/js/bootstrap.min.js"></script>
                <script src="/js/jquery-3.3.1.min.js"></script>
                <script src="../index.js"></script>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
                    crossorigin="anonymous">
                </script>
                <script type="text/javascript">
                $(document).ready(function() {
                    

                    
                    if (window.matchMedia("(min-width: 601px)").matches) {

                        $(".xp-menubar").on('click', function() {
                            $("#color_left").toggleClass('active');
                            $("#color_right").toggleClass('active');
                        });                    
                    } else {
                        // $('#color_left').addClass('d-none');
                        // document.getElementById("color_right").style.width = "100%";
                        $('.xp-menubar').on('click', function() {
                            $("#color_left,.body-overlay").toggleClass('show-nav');
                            // $("#color_right").toggleClass('active');
                            // document.getElementById("color_right").style.width = "calc(100% - 260px)";

                            // $('#color_left').removeClass('d-none');
                        }); 

                                     
                     }
                    
                var divElement = document.getElementById("messages");

                divElement.onmouseover = ()=>{
                    divElement.classList.add("active");
                }
                divElement.onmouseout = ()=>{
                    divElement.classList.remove("active");;
                }
                divElement.touchmove = ()=>{
                    divElement.classList.add("active");;
                }
                function fetchMessages() {
        
                    if(!divElement.classList.contains("active")){
                        scrollDiv();
                    }
                    var cust_email = document.getElementById("cust_email");
                    var seller_email = document.getElementById("seller_email");
                    $.ajax({
                        url: "../Template/chat_user.php",
                        method: "POST",
                        
                        data: { action: "fetch",
                            email:$(cust_email).val(),
                            to_email:$(seller_email).val(),

                        },
                        success: function(data) {
                            $("#messages").html(data);
                        }
                    });
                }

                setInterval(fetchMessages, 500);
                fetchMessages();
                
                setInterval(function(){
                        $("#color_left").load(" #color_left > *");
                }, 3000);

                var input = document.getElementById("mytext");

                input.addEventListener("keypress", function(event) {
                    // $("#form12").on("submit",(function(e) {   
                    if (event.key === "Enter") {
                        event.preventDefault();
                        
                    var messages = document.getElementById("mytext");
                    // var message = messages.value;        
                    var cust_email = document.getElementById("cust_email");
                    var cust_id = document.getElementById("cust_id");

                    var seller_email = document.getElementById("seller_email");
                    var seller_id = document.getElementById("seller_id");

                    // var attachment = document.getElementById("attachment");
                    
                    $.ajax({
                        type:'POST',
                        url:'../send_data_user.php',
                        data:{
                            messages:$(messages).val(),
                            email:$(cust_email).val(),
                            to_email:$(seller_email).val(),
                            cust_id:$(cust_id).val(),
                            seller_id:$(seller_id).val(),
                            // attachment:$(attachment).val(),
                        },beforeSend:function(){
                                $("#loading").show();
                                // $("#send1").hide();
                        },
                        success: function(data){
                            $(messages).val("");
                            // $('#title').html(data);
                            // $("#convo").load(location.href + " #convo");
                            $("#loading").hide();
                            $("#send1").show(); 
                            $(".side-nav").load(window.location.href + " .side-nav" );

                        },
                    });
                    }
                });
                
                function scrollDiv(){
                    divElement.scrollTop = divElement.scrollHeight;
                }
                });
                </script>
                <script>
                
                </script>
</body>

</html>

<?php 
// include ('../footer.php');

?>