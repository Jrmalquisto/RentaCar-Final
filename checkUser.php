<?php
$servername = "localhost";
$dbname = "rentacar";
$user_name = "root";
$password = "";


$conn = new mysqli($servername, $user_name, $password, $dbname);

if ($conn->connect_error) {
  echo "Connection Failed";
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];

  $sql = "SELECT * FROM user WHERE user_name='$username'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $error =  "Username already used";
    echo json_encode($error);
  
  } else {
    $avail = "Username available";
    echo json_encode($avail);

  }
}

$conn->close();
?>