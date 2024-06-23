<?php

require_once("connect.php");
require_once("average_persistence.php");

$user_id = null;

if(isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
} else {
    header("Location: login.php");
    exit();
}

$avg_bpm = getBpms($user_id, $conn);
$moods = getMoods($user_id, $conn);
$times = getTimes($user_id, $conn);

$avg_bpm = null;
$moods = null;
$times = null;

$number = 0;

?>