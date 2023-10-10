<?php
$con = new mysqli('localhost', 'root','','rentacar');
if ($_POST["action"] === "fetch") {
    $email = $_POST["email"];
    $u_email = $_POST["to_email"];
    $messages_query = "SELECT * FROM messages WHERE (messages.to_email='$email' AND messages.email = '$u_email') 
                                OR  (messages.email = '$email' AND messages.to_email='$u_email') ORDER by message_id ASC";
    $messages = mysqli_query($con, $messages_query);

    // $get_user = "SELECT * FROM user WHERE (messages.to_email='$email' AND messages.email = '$u_email') OR  (messages.email = '$email' AND messages.to_email='$u_email')ORDER by message_id";
   
    $get_seller =  mysqli_query($con,"SELECT * FROM seller WHERE email='$u_email'");
	$res2 = mysqli_fetch_array($get_seller);
	
    

    ?>
        <?php 
        // foreach ($messages as $row) { 
        ?>
         <!--    <div class="img1" style="display:inline-block;">
              
            </div>
            
            
            <div class="<?=$row['to_email'] != $u_email ? 'sender' : 'receiver' ?> " style="display:inline-block;" >
                <?php if($logo==NULL){
                        echo '<img src="assets/user_profile/profile.png" style="height:20px; width: 20px; display:inline;" class="rounded-circle logo">';
                    } else { 
                        echo '<img src="images/shop/'.$logo.'" style="height:20px; width: 20px; display:inline;" class="rounded-circle logo">';
                    }
                ?>
                <span class="convomess" ><?= $row['message'] ?> </span>
                <?php if (!empty($row['attachment'])) { ?>
                    <?php if (strpos($row['attachment'], '.mp4') !== false || strpos($row['attachment'], '.mpeg') !== false || strpos($row['attachment'], '.mov') !== false) { ?>
                        <video src="<?= $row['attachment'] ?>" controls class="attachment"></video>
                    <?php } elseif (strpos($row['attachment'], '.jpg') !== false || strpos($row['attachment'], '.jpeg') !== false || strpos($row['attachment'], '.png') !== false || strpos($row['attachment'], '.gif') !== false) { ?>
                        <img src="<?= $row['attachment'] ?>" alt="Attachment" class="attachment">
                    <?php } ?>
                <?php } ?>
                <br>
                <small><span>
                    
                <?php 
                    $date = $row['message_added'];
                    $dateTime = new DateTime($date);

                    // Format the date-time as you desire
                    $formattedDateTime = $dateTime->format('h:i a');

                    echo $formattedDateTime;
                ?></span></small>
            </div> -->
        <?php 
        
    // } 
    
    if (mysqli_num_rows($messages) > 0) {
        while ($row = mysqli_fetch_array($messages)){
            $date = $row['message_added'];
            $dateTime = new DateTime($date);

            // Format the date-time as you desire
            $formattedDateTime = $dateTime->format('h:i a');
            $logo = mysqli_real_escape_string($con, $res2['shop_logo']);

            if($row['email'] === $email){
                $output='<div class="chat-outgoing">';

                    
                    $output .='<div class = "receiver">
                                <span class="convomess" >'.$row['message'].'</span>
                                <br>
                                <small><span>
                                    '.$formattedDateTime.'
                                </span></small>
                            </div>';
                        
                    // if ($logo == NULL) {
                    //     $output .= '<img src="assets/user_profile/profile.png" style="height:20px; width: 20px; " class=" logo">';
                    // } else { 
                    //     $output .= '<img src="images/shop/'.$logo.'" style="height:20px; width: 20px; " class=" logo">';
                    // }

                $output .= '</div>';

            } else {
               

                        $output='<div class="chat-incoming">';
                        if ($logo == NULL) {
                            $output .= '<img src="assets/user_profile/profile.png" style="height:20px; width: 20px; " class=" ">';
                        } else { 
                            $output .= '<img src="images/shop/'.$logo.'" style="height:20px; width: 20px; " class=" ">';
                        }
                       

                        $output .= '<div class = "sender">
                                    <span class="convomess" >'.$row['message'].'</span>
                                    <br>

                                    <small><span>
                                        '.$formattedDateTime.'
                                    </span></small>
                                </div>';
                        $output .= '</div>';
                               
            }

            echo $output;
        }

    } else {

    }
        
}

?>
