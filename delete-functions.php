<?php
session_start();
$con = mysqli_connect("localhost","root","","rentacar");


if(isset($_POST['remove'])){
    $product = $_POST['remove'];

    $query = "DELETE FROM reservation WHERE id='$product' ";
    $query = mysqli_query($con, $query);

    if($query_run){
        header("location: userreservation.php");
    }
    else {
        header("location: userreservation.php");
    }
}

if(isset($_POST['removeRes'])){
    $product = $_POST['removeRes'];

    $query = "DELETE FROM reservation WHERE id='$product' ";
    $query = mysqli_query($con, $query);

    if($query_run){
        header("location: /TemplateShop/_manage-reservations2.php");
    }
    else {
        header("location: /TemplateShop/_manage-reservations2.php");
    }
}

if(isset($_POST['removeUser'])){
    $product = $_POST['removeUser'];

    $query = "DELETE FROM user WHERE user_id='$product'";
    $query = mysqli_query($con, $query);

    if($query_run){
        header("location: _manage-users2.php");
    }
    else {
        header("location: _manage-users2.php");
    }
}

if(isset($_POST['removeChau'])){
    $product = $_POST['removeChau'];

    $query = "DELETE FROM chauffeur WHERE res_id='$product' ";
    $query = mysqli_query($con, $query);

    if($query_run){
        header("location: _manage-reservations-chauffeur.php");
    }
    else {
        header("location: _manage-reservations-chauffeur.php");
    }
}

if(isset($_POST['removeCar'])){
    $id = $_POST['item_id2'];

    $query = "DELETE FROM product WHERE item_id='$id' ";
    $query = mysqli_query($con, $query);

    if($query_run){
        header("location:/TemplateShop/ _manage-cars2.php");
    }
    else {
        header("location: /TemplateShop/_manage-cars2.php");
    }
}

if(isset($_POST['removeDriver'])){
    $id = $_POST['driver_id2'];

    $query = "DELETE FROM drivers WHERE driver_id='$id' ";
    $query = mysqli_query($con, $query);

    if($query_run){
        header("location: /TemplateShop/_manage-drivers2.php");
    }
    else {
        header("location: /TemplateShop/_manage-drivers2.php");
    }
}

?>


