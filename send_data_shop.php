<?php

// sleep(1.5);
$con = new mysqli('localhost', 'root','','rentacar');

if(!$con){
    die(mysqli_error($con));
}

$response = array( 
    'status' => 0, 
    'message' => 'Form submission failed, please try again.' 
); 

$messages = $_POST['messages1'];
$email = $_POST["email"];
$to_email = $_POST["to_email"];
$from_id = $_POST["seller_id"];
$to_id = $_POST["cust_id"];

$sqlQ = "INSERT INTO messages (message, email, to_email, from_id, to_id) VALUES ('$messages', '$email', '$to_email', '$from_id', '$to_id')"; 
$stmt = $con->prepare($sqlQ); 

$insert = $stmt->execute(); 
if($insert){ 
    $response['status'] = 1; 
    $response['message'] = 'Form data submitted successfully!'; 
} 
echo json_encode("Totally SENT");
echo json_encode($response);
// if(isset($_POST['cust_id']) || isset($_POST['seller_id']) || isset($_FILES['attachment'])){ 
//     if (!empty($attachment['tmp_name'])) {
//         if (!in_array($attachmentType, $allowedTypes)) {
//         $response['message'] = 'Invalid file type. Only JPEG, PNG, GIF, MP4, MPEG, and QuickTime files are allowed.';
//         } else {
//         $attachmentPath = '';
//         if ($attachment['error'] === UPLOAD_ERR_OK) {
//             $attachmentName = $attachment['name'];
//             $attachmentTmpName = $attachment['tmp_name'];
//             $attachmentPath = '../attachments/' . $attachmentName; // Specify the directory to save attachments

//             // Move the uploaded attachment to the desired location
//             move_uploaded_file($attachmentTmpName, $attachmentPath);
//             $addMessage = "INSERT INTO messages ( message, from_id, to_id, attachment) VALUES ('$messages', '$id1', '$id2', '$attachmentPath')";
//             $response['message'] = 'Message successfully sent!';
//             mysqli_query($con, $addMessage);
//         } else {
//             $response['message'] = 'An error occured, please try again.';
//         }
//         }
//     } else {
//         $addMessage = "INSERT INTO messages (message, from_id, to_id) VALUES ('$messages', '$id1', '$id2')";
//         $response['message'] = 'Message successfully sent!';
//         mysqli_query($con, $addMessage);
//     }
// }
// echo json_encode("Totally SENT");
// echo json_encode($response);
?>