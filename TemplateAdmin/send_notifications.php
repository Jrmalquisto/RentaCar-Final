<?php
header("Content-Type: text/event-stream");
header("Cache-Control: no-cache");

$mysqli = new mysqli('localhost', 'root', '', 'rentacar');

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch unread notifications from the database
$query = "SELECT * FROM notifications WHERE status = 'unread'";
$result = $mysqli->query($query);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        echo "data: " . $row['message'] . "\n\n";
    }

    // Mark fetched notifications as read
    $mysqli->query("UPDATE notifications SET status = 'read' WHERE status = 'unread'");
}

// Close the database connection
$mysqli->close();
flush();
?>
