<?php

function getPulseRate($member_id, $conn) {
    $bpm = 0;

    $sql = "SELECT pulse_rate 
            FROM pulse_detector_device p, emotion_regulator_app e 
            WHERE p.device_id = e.pulse_device_id AND e.member_id = $member_id";

    $result = $conn->query($sql);

    if($row = $result->fetch_assoc()) {
        $bpm = $row['pulse_rate'];
    }

    return $bpm;
}

function getMemberObject($member_id, $member_object, $conn) {

    $sql = "SELECT name, surname, username  
            FROM member
            WHERE member_id = $member_id";

    $result = $conn->query($sql);

    if($row = $result->fetch_assoc()) {
        $member_object->setName($row['name']);
        $member_object->setSurname($row['surname']);
        $member_object->setUsername($row['username']);
    }

    return $member_object;
}

function getMood($member_id, $conn) {
    $mood = "---";

    $sql = "SELECT mood 
            FROM emotion_regulator_app 
            WHERE member_id = $member_id";

    $result = $conn->query($sql);

    if($row = $result->fetch_assoc()) {
        $mood = $row['mood'];
    }

    return $mood;
}

?>