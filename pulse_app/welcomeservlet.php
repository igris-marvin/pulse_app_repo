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

//read data from the file
$file_path = 'C:\Users\Public\Documents\bpm.txt';

// Check if the file exists
if (file_exists($file_path)) {
    // Read the entire file into a string
    $file_content = file_get_contents($file_path);

    $array = explode("\n", $file_content);

    foreach($array as &$pulse_rate) {
        $bpm = (int) $pulse_rate;

        if($bpm === 0) {

        } else {
            saveBpm($bpm, $user_id, $conn);
        }

        // Open the file for writing ('w' mode), which will truncate the file to zero length
        $file_handle = fopen($file_path, 'w');
    }
}

$member_object = new Member($user_id, 0, null, null, null, null, null, null, null, null, null, null);

$member_object = getMemberObject($user_id, $member_object, $conn);

$name = $member_object->getName();
$surname = $member_object->getSurname();
$username = $member_object->getUsername();
$image = $member_object->getImage();

$image_data = null;

if($image === null) {
    $image_data = "avatar.jpg";
} else {
    $image_data = "data:image/jpeg;base64," . base64_encode($image);
}

$bpm = determineBpm($user_id, $conn); //this process determines and saves the average bpm, and saves the mood
$mood = getMood($user_id, $conn);

?>