<?php

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "userdetails";

    $connection = mysqli_connect($host,$username,$password,$database);

    if(!$connection){

        die("connection failed");

    }
?>