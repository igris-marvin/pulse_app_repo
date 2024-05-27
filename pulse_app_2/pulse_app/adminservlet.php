<?php

require_once("adminrepository.php");

//HANDLE REMOVAL OF USER

$user_id;

if(isset($_GET['user_id'])) {

    $user_id = $_GET['user_id'];

    removeUser($user_id, $conn);

    $message = "User removed succesfully!";
}

?>