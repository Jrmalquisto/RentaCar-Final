<?php
session_start();
sleep(1.5);

$dateFro = $_POST["num1"];
$dateT = $_POST["num2"];

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