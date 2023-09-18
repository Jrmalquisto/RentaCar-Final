<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['notification_id'])) {
        $mysqli = new mysqli('localhost', 'root', '', 'rentacar'); // Replace with your database credentials

        // Check connection
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        // Sanitize the notification ID from the POST data
        $notificationId = $mysqli->real_escape_string($_POST['notification_id']);

        // Update the status of the notification to "read" based on the notification ID
        $updateQuery = "UPDATE notifications SET status = 'read' WHERE notification_id = '$notificationId'";
        $mysqli->query($updateQuery);

        // Close the database connection
        $mysqli->close();
    }
}
?>
