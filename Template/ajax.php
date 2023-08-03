<?php
//require MySQL Connection
require ('../database/DBController.php');

//require Product Class
require ('../database/Product.php');

//DBController Object
$db = new DBController();

//Product Object
$product = new Product($db);

if (isset($_POST['item_id'])){
    $result = $product->getProduct($_POST['item_id']);
    echo json_encode($result);
}