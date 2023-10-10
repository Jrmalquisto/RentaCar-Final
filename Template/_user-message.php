<?php

include ('_user_message-commands.php');
// include ('../send_data.php');


  function dd($data) {
	echo "<pre>";
	print_r(var_dump($data));
	die;
}

$com_id = $_SESSION["user_id"];
$seller_id = $_GET['seller_id'];

$email = $_SESSION["email"];
$u_email = $_GET['email'];


// $result = mysqli_query($con, "SELECT * FROM seller WHERE seller_id = '$com_id'");
// if ($res = mysqli_fetch_array($result)) {
// 	$shopname = $res['shopname'] ?? '';
// 	$username = $res['username']  ?? '';
//     $address = $res['address']  ?? '';
// 	$email = $res['email']  ?? '';
// 	$contact = $res['contact_num']  ?? '';
// 	$logo = $res['shop_logo']  ?? '';
// }

$users = mysqli_query($con, "SELECT * FROM seller");

// $convo_query = "SELECT * FROM convo 
// 								JOIN seller ON seller.seller_id = convo.recipient
// 								WHERE convo_id='$seller_id'";
// $convo_query = mysqli_query($con, $convo_query);
// $convo = mysqli_fetch_assoc($convo_query);

$messages_query = "SELECT * FROM messages WHERE (messages.to_email='$email' AND messages.email = '$u_email') OR  (messages.email = '$email' AND messages.to_email='$u_email')";
$messages = mysqli_query($con, $messages_query);
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

      <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
      <!-- <link rel="stylesheet" href="../css/bootstrap.min.css"> -->
	    <!----css3---->
        <!-- <link rel="stylesheet" href="../css/custom.css"> -->
      <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
      <link href="../TemplateShop/assets/css/nucleo-icons.css" rel="stylesheet" />
      <link href="../TemplateShop/assets/css/nucleo-svg.css" rel="stylesheet" />
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
      <link id="pagestyle" href="../TemplateShop/assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
      <link rel="stylesheet" href="../TemplateShop/assets/css/style.css">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>


  </head>
  <body>
  


<div class="wrapper">

<form action="" method="post" enctype='multipart/form-data'>

	  <div class="body-overlay"></div>
	 
	 <!-------sidebar--design------------>
	 
	
	 
   <!-------sidebar--design- close----------->
   
   
   
      <!-------page-content start----------->
   
      <div id="content2">
	     
		  <!------top-navbar-start-----------> 
		   
		  <div class="top-navbar">
		<div class="xd-topbar">
			<div class="row">
				<div class="col-2 col-md-1 col-lg-4 order-2 order-md-1 align-self-center">
				<div class="xp-menubar">
					<span class="material-icons text-white">signal_cellular_alt</span>
				</div>
				</div>
					 
					 <div class="col-10 col-md-6 col-lg-8 order-1 order-md-3">
					<div class="xp-profilebar text-right">
					<nav class="navbars p-0">
						<ul class="nav navbar-nav flex-row ml-auto">
						<li class="dropdown nav-item">
							<a class="nav-link" href="#" data-toggle="dropdown">
							<span class="material-icons">notifications</span>
							<span class="notifications">4</span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="#">You Have 4 New Messages</a></li>
								<li><a href="#">You Have 4 New Messages</a></li>
								<li><a href="#">You Have 4 New Messages</a></li>
								<li><a href="#">You Have 4 New Messages</a></li>
							</ul>
						</li>
							   
							   <li class="nav-item">
							     <a class="nav-link" href="">
								   <span class="material-icons">question_answer</span>
								 </a>
							   </li>
							   <!-- <i class="fas ml-3 me-2"></i><?php echo "<p>" . $_SESSION['shopname'] . "</p>"; ?> -->
							   <li class="dropdown nav-item" >
							     <a class="nav-link" href="#" data-toggle="dropdown">.
								 <!-- <img style="width:40px; height:auto;"  src="../images/shop/<?php echo $res['shop_logo']; ?>"> -->

								  <span class="xp-user-live"></span>
								 </a>
								 
								  <ul class="dropdown-menu small-menu dropmenu">
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
				    <h4 class="page-title" id="title">Dashboard</h4>
					<!--<ol class="breadcrumb">
					  <li class="breadcrumb-item"><a href="#">Vishweb</a></li>
					  <li class="breadcrumb-item active" aria-curent="page">Dashboard</li>
					</ol>-->
				 </div>
				 
				 
			 </div>
		  </div>
		  <!------top-navbar-end-----------> 

		   <!------main-content-start-----------> 
<div class="container-fluid py-4 main-container">
    <div class=" mb-6">
        <div class="row">
            <div class="row col-14 border-right pr-0">
                <div class="p-5 pb-0">
                    <div class="d-flex justify-content-between align-items-center mt-3 mb-3">
                            <!-- <h4 style="font-size:30px; color:white; font-family:'Poppins',sans-serif;">Subject: <?= $convo['subject'] ?></h4>
                            <small style="font-size:18px; color:white; font-family:'Poppins',sans-serif;">Conversation with <?= $convo['email'] ?></small> -->
                    </div>
                    
                    <div class="mt-2 pt-3 border-top">

                        <!-- <div class="convo" id="convo">
                            <?php foreach ($messages as $row) { ?>
                                <div class="<?=$row['to_email'] != $u_email ? 'sender' : 'receiver' ?>">
                                    <span class="convomess"><?= $row['message'] ?></span>
                                    <?php if (!empty($row['attachment'])) { ?>
                                        <?php if (strpos($row['attachment'], '.mp4') !== false || strpos($row['attachment'], '.mpeg') !== false || strpos($row['attachment'], '.mov') !== false) { ?>
                                            <video src="<?= $row['attachment'] ?>" controls class="attachment"></video>
                                        <?php } elseif (strpos($row['attachment'], '.jpg') !== false || strpos($row['attachment'], '.jpeg') !== false || strpos($row['attachment'], '.png') !== false || strpos($row['attachment'], '.gif') !== false) { ?>
                                            <img src="<?= $row['attachment'] ?>" alt="Attachment" class="attachment">
                                        <?php } ?>
                                    <?php } ?>
                                    <br>
                                    <small><span><?= $row['message_added'] ?></span></small>
                                </div>
                            <?php } ?>
                        </div> -->
						<div class="messages" id="messages">
							
						</div>

                        <div class="mt-3">
						<div class="statusMsg"id="statusMsg"></div>
                            <form action="" id="form12" method="POST" enctype="multipart/form-data">
                                <div class="textarea-container">
								<input  id="cust_email" type="hidden" name="cust_email" value="<?= $email ?>">
								<input  id="seller_email" type="hidden" name="seller_email" value="<?= $u_email ?>">
								<input  id="cust_id" type="hidden" name="cust_id" value="<?= $com_id ?>">
								<input  id="seller_id" type="hidden" name="seller_id" value="<?= $seller_id ?>">

                                <textarea id="mytext" class="form-control mt-2" rows="1" name="mytext"  placeholder="Enter reply.."></textarea>
                                <!-- <input type="submit" value="Send Reply" class="btn button-update" name="send1" id="send1" > -->
								<!-- SEND REPLY //index.js/ -->
                                <button type="button" value="Send Reply" class="btn button-update" id="send1" >Send</button>
                                <label for="fimage"><iconify-icon icon="entypo:attachment" class="attachment-icon"></iconify-icon></label>
                                <input type="file" id="fimage" name="attachment" id="attachment" class="btn mt-2" accept="image/*,video/*" style="display:none; visibility: none;">
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>

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
   <script src="../index.js"></script>

  <script type="text/javascript">
       $(document).ready(function(){
		
		var divElement = document.getElementById("messages");
		

		divElement.onmouseenter = ()=>{
			divElement.classList.add("active");
		}
		divElement.onmouseleave = ()=>{
			divElement.classList.remove("active");;
		}
		function fetchMessages() {
			
			if(!divElement.classList.contains("active")){
				scrollDiv();
			}
			var cust_email = document.getElementById("cust_email");
        	var seller_email = document.getElementById("seller_email");
			$.ajax({
				url: "chat_user.php",
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
		function scrollDiv(){
            divElement.scrollTop = divElement.scrollHeight;
		}
		setInterval(fetchMessages, 500);
		fetchMessages();

		$("html, body").animate({
				scrollTop: $(
					'html, body').get(0).scrollHeight
		}, 2000);
			
	      $(".xp-menubar").on('click',function(){
		    $("#sidebar").toggleClass('active');
			$("#content").toggleClass('active');
		  });
		  
		  $('.xp-menubar,.body-overlay').on('click',function(){
		     $("#sidebar,.body-overlay").toggleClass('show-nav');
		  });
		  
	   });
	   
  </script>
  
  
  <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

  </form>
  </body>
  
  </html>


