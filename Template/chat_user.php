<?php
$con = new mysqli('localhost', 'root','','rentacar');
if ($_POST["action"] === "fetch") {
$email = $_POST["email"];
$u_email = $_POST["to_email"];
$messages_query = "SELECT * FROM messages WHERE (messages.to_email='$email' AND messages.email = '$u_email') OR  (messages.email = '$email' AND messages.to_email='$u_email')ORDER by message_id";
$messages = mysqli_query($con, $messages_query);
?>
<!-- <div class="convo" id="convo"> -->
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
    <?php } 
    
    }?>
<!-- </div> -->