<?php
// if ($_SESSION['ucode'])
// session_start();

if(!isset($_SESSION['ucode']) && empty($_SESSION['ucode'])&& !isset($_SESSION["user_id"])){
    if(strstr($_SERVER['PHP_SELF'], '_user-login.php') === false)
    header('location:_user-login.php');
}else if(isset($_SESSION["user_id"])){
    if(strstr($_SERVER['PHP_SELF'], 'index.php') === false)
    header('location:index.php');
}else{
    if(strstr($_SERVER['PHP_SELF'], 'index.php') === false)
    header('location:index.php');
}
