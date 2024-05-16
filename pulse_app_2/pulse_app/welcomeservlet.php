<?php

require_once("connect.php");
require_once("welcomepersistence.php");
require_once("member.php");


$user_id;

// Retrieve user information from database
if(isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

} else {
    header("Location: login.php");
    exit();
}

if (isset($_POST['logout'])) {

    header('Location: index.php');
    exit();
}

$member_object = new Member($user_id, 0, null, null, null, null, null, null, null, null, null, null);

$member_object = getMemberObject($user_id, $member_object, $conn);

$name = $member_object->getName();
$surname = $member_object->getSurname();
$username = $member_object->getUsername();

$bpm = getPulseRate($user_id, $conn);
$mood = getMood($user_id, $conn);

?>