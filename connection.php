<?php

$con = new mysqli('localhost', 'root','','rentacar');

if(!$con){
    die(mysqli_error($con));
}
?>