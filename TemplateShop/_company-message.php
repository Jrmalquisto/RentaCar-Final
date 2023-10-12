<?php

include ('message-commands.php');
// include ('../send_data.php');


  function dd($data) {
	echo "<pre>";
	print_r(var_dump($data));
	die;
}

$com_id = $_SESSION["com_id"];
$email = $_SESSION["email"];

$user_id = $_GET['user_id'];
$u_email = $_GET['email'];

$result = mysqli_query($con, "SELECT * FROM seller WHERE seller_id = '$com_id'");
if ($res = mysqli_fetch_array($result)) {
	$shopname = $res['shopname'] ?? '';
	$username = $res['username']  ?? '';
    $address = $res['address']  ?? '';
	$s_email = $res['email']  ?? '';
	$contact = $res['contact_num']  ?? '';
	$logo = $res['shop_logo']  ?? '';
}


// $convo_query = "SELECT * FROM convo 
// 								JOIN seller ON seller.seller_id = convo.recipient
// 								WHERE convo_id='$seller_id'";
// $convo_query = mysqli_query($con, $convo_query);
// $convo = mysqli_fetch_assoc($convo_query);

// $messages_query = "SELECT * FROM seller INNER JOIN messages ON  messages.from_id = seller.seller_id 
// 															WHERE (messages.email = '$email' AND seller.email = '$s_email' ) 
															
// 															AND (from_id='$com_id' AND to_id = '$user_id') OR (from_id='$user_id' AND to_id = '$com_id')
// 															AND messages.to_email = '$u_email'";
															
// $messages_query = "SELECT * FROM messages INNER JOIN seller ON  messages.email = seller.email 
// 															-- WHERE  seller.email = '$s_email' AND(messages.email = '$email' AND messages.to_email = '$u_email') OR (messages.email = '$u_email' AND messages.to_email = '$email')
// 															-- WHERE (messages.email = '$email' AND messages.to_email='$u_email') OR (messages.email = '$u_email' AND messages.to_email = '$email')
// 															WHERE messages.to_email='$email' AND messages.email = '$u_email'
// 															-- WHERE (from_id='$com_id' AND to_id = '$user_id') OR (from_id='$user_id' AND to_id = '$com_id')
// 															";
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
        <!-- <link rel="stylesheet" href="/css/custom.css"> -->
		
		
		<!--google fonts -->
	    <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
	
	
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


	   <!--google material icon-->
      <link href="https://fonts.googleapis.com/css2?family=Material+Icons"rel="stylesheet">

      <!-- <link rel="stylesheet" href="../css/bootstrap.min.css"> -->
      <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">

      <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
     -->

	    <!----css3---->
      <link rel="stylesheet" href="../css/custom.css">
      <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
      <link href="../TemplateShop/assets/css/nucleo-icons.css" rel="stylesheet" />
      <link href="../TemplateShop/assets/css/nucleo-svg.css" rel="stylesheet" />
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
      <link id="pagestyle" href="../TemplateShop/assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
      <link rel="stylesheet" href="../TemplateShop/assets/css/style.css">
      <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

      <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>   -->
      <!-- <script src="/js/popper.min.js"></script> -->
    <script src="/js/jquery-3.3.1.min.js"></script>

      <script src="/js/bootstrap.min.js"></script>

  </head>
  <body>
  


<div class="wrapper">

<form action="" method="post" enctype='multipart/form-data'>

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
                                <!-- <p class="text-s font-weight-bold mb-0"> <?php echo print_r($messages)."\n" ?> </p>
                                <p class="text-s font-weight-bold mb-0"> <?php echo $u_email ?> </p> -->

                        <!-- <div class="convo" id="convo">
                            <?php foreach ($messages as $row) { ?>
                                <div class="<?= $row['to_email'] != $u_email ? 'sender' : 'receiver' ?>">
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
						<div class="statusMsg"></div>
                            <form action="" id="form12" method="POST" enctype="multipart/form-data">
                                <div class="textarea-container">
								<input  id="seller_email1" type="hidden" name="seller_email1" value="<?= $email ?>">
								<input  id="cust_email1" type="hidden" name="cust_email1" value="<?= $u_email ?>">
                                <input  id="seller_id1" type="hidden" name="seller_id1" value="<?= $com_id ?>">
								<input  id="cust_id1" type="hidden" name="cust_id1" value="<?= $user_id ?>">

                                <textarea id="mytext1" class="form-control mt-2" rows="1" name="mytext1"  placeholder="Enter reply.."></textarea>
                                <!-- <input type="submit" value="Send Reply" class="btn button-update" name="send1" id="send1" > -->
                                <button type="button" value="Send Reply" class="btn button-update" id="send2" >Send</button>
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
   <!-- <script src="/js/jquery-3.3.1.slim.min.js"></script> -->
   <!-- <script src="/js/popper.min.js"></script>
   <script src="/js/bootstrap.min.js"></script> -->
   <!-- <script src="/js/jquery-3.3.1.min.js"></script> -->
   <script src="../index.js"></script>
   <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
   <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>   -->
   <script src="/js/popper.min.js"></script>
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
			var cust_email = document.getElementById("cust_email1");
        	var seller_email = document.getElementById("seller_email1");
			$.ajax({
				url: "chat_shop.php",
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
				
	    //   $(".xp-menubar").on('click',function(){
		//     $("#sidebar").toggleClass('active');
		// 	$("#content").toggleClass('active');
		//   });
		  
		//   $('.xp-menubar,.body-overlay').on('click',function(){
		//      $("#sidebar,.body-overlay").toggleClass('show-nav');
		//   });
		  
	   });
  </script>
  
  
  

  </form>
  <?php 
	include ('../TemplateShop/_company-footer.php');
  ?>

