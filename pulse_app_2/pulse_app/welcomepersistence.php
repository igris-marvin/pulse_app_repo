<?php

function getPulseRate($member_id, $conn) {
    $bpm = 0;

    $sql = "SELECT average 
            FROM reading r, emotion_regulator_app e 
            WHERE member_id = $member_id AND e.pulse_app_id = r.pulse_app_id 
            ORDER BY reading_id DESC 
            LIMIT 1";

    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        
        if($row = $result->fetch_assoc()) {
            $bpm = $row['average'];
        }

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
            FROM reading r, emotion_regulator_app e 
            WHERE member_id = $member_id AND e.pulse_app_id = r.pulse_app_id 
            ORDER BY reading_id DESC 
            LIMIT 1";

    $result = $conn->query($sql);

    if($row = $result->fetch_assoc()) {
        $mood = $row['mood'];
    }

    return $mood;
}

?>