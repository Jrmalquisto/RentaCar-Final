<?php
session_start();
$con = mysqli_connect("localhost","root","","rentacar");

if(isset($_POST['removeUser'])){
    $product = $_POST['removeUser'];

    $query = "DELETE FROM user WHERE user_id='$product'";
    $query = mysqli_query($con, $query);

    if($query_run){
        header("location: _manage-users.php");
    }
    else {
        header("location: _manage-users.php");
    }
}

if(isset($_POST['removeComp'])){
    $product = $_POST['removeComp'];

    $query = "DELETE FROM seller WHERE user_id='$product'";
    $query = mysqli_query($con, $query);

    if($query_run){
        header("location: _manage-users.php");
    }
    else {
        header("location: _manage-users.php");
    }
}