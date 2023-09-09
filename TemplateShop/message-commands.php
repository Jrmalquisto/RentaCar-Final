<?php

session_start();
include('../connection.php');
$com_id=$_SESSION["com_id"];

if (isset($_POST['send'])) {
    $convo_id = $_GET['convo_id'];
    $body = $_POST['message'];
    $attachment = $_FILES['attachment'];
  
    // Validate file type
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'video/mp4', 'video/mpeg', 'video/quicktime'];
    $attachmentType = $attachment['type'];
  
    $convo_query = "SELECT * FROM convo 
                                  JOIN seller ON seller.seller_id = convo.recipient
                                  WHERE convo_id='$convo_id'";
    $convo_query = mysqli_query($con, $convo_query);
    $convo = mysqli_fetch_assoc($convo_query);
  
    $recipient = $convo['recipient'] == $com_id ? $convo['user_id'] : $convo['recipient'];
  
    if (!empty($attachment['tmp_name'])) {
      if (!in_array($attachmentType, $allowedTypes)) {
        $message[] = 'Invalid file type. Only JPEG, PNG, GIF, MP4, MPEG, and QuickTime files are allowed.';
      } else {
        $attachmentPath = '';
        if ($attachment['error'] === UPLOAD_ERR_OK) {
          $attachmentName = $attachment['name'];
          $attachmentTmpName = $attachment['tmp_name'];
          $attachmentPath = '../attachments/' . $attachmentName; // Specify the directory to save attachments
  
          // Move the uploaded attachment to the desired location
          move_uploaded_file($attachmentTmpName, $attachmentPath);
          $addMessage = "INSERT INTO messages (convo_id, message, from_id, to_id, attachment) VALUES ('$convo_id', '$body', '$com_id', '$recipient', '$attachmentPath')";
          $message[] = 'Message successfully sent!';
          mysqli_query($con, $addMessage);
        } else {
          $message[] = 'An error occured, please try again.';
        }
      }
    } else {
      $addMessage = "INSERT INTO messages (convo_id, message, from_id, to_id) VALUES ('$convo_id', '$body', '$com_id', '$recipient')";
      $message[] = 'Message successfully sent!';
      mysqli_query($con, $addMessage);
    }
  }


if (isset($_POST['compose'])) {
    $recipient = $_POST['recipient'];
    $subject = $_POST['subject'];
    $body = $_POST['message'];
    $attachment = $_FILES['attachment'];
  
    // Validate file type
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'video/mp4', 'video/mpeg', 'video/quicktime'];
    $attachmentType = $attachment['type'];
  
    if (!empty($attachment['tmp_name'])) {
      if (!in_array($attachmentType, $allowedTypes)) {
        $message[] = 'Invalid file type. Only JPEG, PNG, GIF, MP4, MPEG, and QuickTime files are allowed.';
      } else {
        $attachmentPath = '';
        if ($attachment['error'] === UPLOAD_ERR_OK) {
          $attachmentName = $attachment['name'];
          $attachmentTmpName = $attachment['tmp_name'];
          $attachmentPath = '../attachments/' . $attachmentName; // Specify the directory to save attachments
  
          // Move the uploaded attachment to the desired location
          move_uploaded_file($attachmentTmpName, $attachmentPath);
          $addConvo = "INSERT INTO `convo` (user_id, recipient, subject) VALUES ('$com_id', '$recipient', '$subject')";
  
          if (mysqli_query($con, $addConvo)) {
            $convo_id = mysqli_insert_id($con);
            $addMessage = "INSERT INTO messages (convo_id, message, from_id, to_id, attachment) VALUES ('$convo_id', '$body', '$com_id', '$recipient', '$attachmentPath')";
            mysqli_query($con, $addMessage);
            $message[] = 'Message successfully sent!';
          }
        } else {
          $message[] = 'An error occured, please try again.';
        }
      }
    } else {
      $addConvo = "INSERT INTO `convo` (user_id, recipient, subject) VALUES ('$com_id', '$recipient', '$subject')";
  
      if (mysqli_query($con, $addConvo)) {
        $convo_id = mysqli_insert_id($con);
        $addMessage = "INSERT INTO messages (convo_id, message, from_id, to_id) VALUES ('$convo_id', '$body', '$com_id', '$recipient')";
        mysqli_query($con, $addMessage);
      }
  
      $message[] = 'Message successfully sent!';
      mysqli_query($con, $addMessage);
    }
  }

?>