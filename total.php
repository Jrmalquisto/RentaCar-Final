<?php
session_start();
sleep(1.5);
//  $_SESSION["item_n"] = $item['item_name'];
//  $_SESSION["item_p"] = $item['item_price'];



// $price = $_POST["price1"] ?? 0;
// echo json_encode($price);

// echo $_POST["price1"];

// $dated = date("Y-m-d H:m");
// $date = date("2023-05-01 02:10");
// $dateFro=$dated;
// $dateT=$date; 

$dateFro = $_POST["num1"];
$dateT = $_POST["num2"];
// echo $_POST["price1"];
// echo $dateFro;
// echo $dateT;
// echo ($dateFrom);
// echo ($dateTo);
// $dateFrom = $_SESSION["price1"];
// $dateTo = $_POST["price2"];
$dateFrom= strtotime($dateFro);
$dateTo= strtotime($dateT);

$datedDiff =  $dateFrom - $dateTo;
$days = floor($datedDiff/(60*60*24));

$price = isset($_POST["price"]) ? $_POST["price"]: 0;

// echo $price;
$_SESSION["days_rent"] = $days;
$total = ($price * $days)*-1;
// echo ($dateFrom);
// echo ($dateTo);
$_SESSION["dateFrom"] = $dateFro;
$_SESSION["dateTo"] =  $dateT;
echo json_encode($total);
$_SESSION["total_amount"] =  $total;
?>