<?php
// Assuming you have a database connection established already
$mysqli = new mysqli('localhost', 'root', '', 'rentacar');

if (isset($_POST['notification_id'])) {
    $notificationId = $_POST['notification_id'];
    
    // Perform the deletion in your database (modify table and column names as needed)
    $sql = "DELETE FROM notifications WHERE notification_id = ?";
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