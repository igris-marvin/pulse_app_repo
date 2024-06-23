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

$avg_bpms = getBpms($user_id, $conn);
$moods = getMoods($user_id, $conn);
$timestamps = getTimes($user_id, $conn);

$number = 0;

///////////////////////

// Given datetime string
$datetime_string = "2024-06-22 14:34:10";

$datetime = new DateTime($datetime_string);

// Extract the date and time separately
$formatted_date = $datetime->format('d M y');
$time = $datetime->format('H:i:s');

////////////////////

$times = [];
$dates = [];

for($i = 0; $i < count($timestamps); $i++) {

    $dates[] = ( new DateTime($timestamps[$i]) )->format('d M y');
    $times[] = ( new DateTime($timestamps[$i]) )->format('H:i:s');

}

?>