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

$times = [];
$dates = [];

for($i = 0; $i < count($timestamps); $i++) {

    $dates[] = ( new DateTime($timestamps[$i]) )->format('d M y');
    $times[] = ( new DateTime($timestamps[$i]) )->format('H:i:s');

}

?>