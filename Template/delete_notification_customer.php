<?php
session_start();
$mysqli = new mysqli('localhost', 'root', '', 'rentacar');
$id=$_SESSION["user_id"];

if (isset($_POST['notification_id'])) {
    $notificationId = $_POST['notification_id'];
    
    // Perform the deletion in your database (modify table and column names as needed)
    $sql = "DELETE FROM notifications WHERE user_id='$id' AND notification_id = ?";
    $stmt = $mysqli->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param('i', $notificationId);
        if ($stmt->execute()) {
            echo 'success'; // Signal success to the AJAX request
        } else {
            echo 'error';
        }
        $stmt->close();
    } else {
        echo 'error';
    }
} else {
    echo 'error';
}

// Close your database connection if needed
$mysqli->close();
?>