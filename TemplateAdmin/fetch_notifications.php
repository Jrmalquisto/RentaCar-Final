<?php
$mysqli = new mysqli('localhost', 'root', '', 'rentacar');

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$notifications = [];

// Fetch notifications from the database (including their status)
$query = "SELECT * FROM notifications WHERE status = 'unread'";
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
