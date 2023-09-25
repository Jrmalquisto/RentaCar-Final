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
  $email = $_POST['email'];


  $sql = "SELECT * FROM user WHERE email='$email'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
  
    $error = "Email already used";
    echo $error; 

  } else {

    $error = "Email available";
    echo $error;

  }
}

$conn->close();
?>