<?php

function getBpms($member_id, $conn) {
    $array = [];

    $sql = "SELECT average
            FROM reading a, emotion_regulator_app b
            WHERE a.pulse_app_id = b.pulse_app_id 
            AND  b.member_id = $member_id";

    $result = $conn->query($sql);

    while($row = $result->fetch_assoc()) {
        $array[] = $row['average'];
    }

    return $array;
}

function getMoods($member_id, $conn) {
    $array = [];

    $sql = "SELECT mood
            FROM reading a, emotion_regulator_app b
            WHERE a.pulse_app_id = b.pulse_app_id 
            AND  b.member_id = $member_id";

    $result = $conn->query($sql);

    while($row = $result->fetch_assoc()) {
        $array[] = $row['mood'];
    }

    return $array;

}

function getTimes($member_id, $conn) {
    $array = [];

    $sql = "SELECT timestamp
            FROM reading a, emotion_regulator_app b
            WHERE a.pulse_app_id = b.pulse_app_id 
            AND  b.member_id = $member_id";

    $result = $conn->query($sql);

    while($row = $result->fetch_assoc()) {
        $array[] = $row['timestamp'];
    }

    return $array;

}

?>