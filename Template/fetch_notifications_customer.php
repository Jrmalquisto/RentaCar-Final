<?php
session_start();
$mysqli = new mysqli('localhost', 'root', '', 'rentacar');

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$notifications = [];
$id=$_SESSION["user_id"];
// Fetch notifications from the database (including their status)
$query = "SELECT * FROM notifications WHERE status = 'unread' AND notif_for='customer' AND user_id='$id'";
$result = $mysqli->query($query);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $notifications[] = $row;
    }

    // Close the database connection
    $mysqli->close();
}

// Return notifications as JSON
header('Content-Type: application/json');
echo json_encode($notifications);
?>
