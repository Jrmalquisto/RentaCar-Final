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


  // $sql = "SELECT * FROM user WHERE user_name='$username'";
  // $result = $conn->query($sql);
 
  $findresult1 = mysqli_query($conn, "SELECT * FROM user WHERE user_name='$username'");
  $row_cnt = mysqli_num_rows($findresult1);
  if($res = mysqli_fetch_array($findresult1)){
      $user = $res['user_name'];
  }

  if ($row_cnt > 0) {
    if ($user === $username){
    $error = "Username already used";
    echo $error; 
    } else {

      $error = "Username available";
      echo $error;
    }
  } else {

    $error = "Username available";
    echo $error;
  }
}

$conn->close();
?>