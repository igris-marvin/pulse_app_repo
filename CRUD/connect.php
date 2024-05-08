<?php

$con = new mysqli('localhost','root','','userdetails');

if(!$con){

    die(mysqli_error($con));
}


?>