<?php

require_once("adminrepository.php");
require_once("connect.php");

$admin_id = null;

if(isset($_GET['admin_id'])) {
    $admin_id = $_GET['admin_id'];
} else {
    header("location: admin_login.php");
    exit();
}

//HANDLE REMOVAL OF USER

$user_id;

if(isset($_GET['user_id'])) {

    $user_id = $_GET['user_id'];

    removeUser($user_id, $conn);

    $message = "User removed succesfully!";
}

?>