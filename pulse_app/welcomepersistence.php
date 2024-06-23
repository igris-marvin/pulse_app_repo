<?php

function getMemberObject($member_id, $member_object, $conn) {

    $sql = "SELECT name, surname, username, image  
            FROM member
            WHERE member_id = $member_id";

    $result = $conn->query($sql);

    if($row = $result->fetch_assoc()) {
        $member_object->setName($row['name']);
        $member_object->setSurname($row['surname']);
        $member_object->setUsername($row['username']);
        $member_object->setImage($row['image']);
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

function determineBpm($member_id, $conn) {
    $bpm = 0;
    
    $sql = "SELECT pulse_rate 
            FROM pulse_data 
            WHERE device_id = (SELECT pulse_device_id FROM emotion_regulator_app WHERE member_id = $member_id) 
            ORDER BY pulse_id DESC 
            LIMIT 10";

    $result = $conn->query($sql);

    if($result->num_rows > 0) {

        $count = 0;
        $total = 0;

        while($row = $result->fetch_assoc()) {
            $total = $total + $row['pulse_rate'];
            $count = $count + 1;
        }

        $bpm = round($total / $count);
        $mood = determineMood($bpm);
        $app_id = getAppId($member_id, $conn);

        $sql = "INSERT INTO reading (average, mood, pulse_app_id) 
                VALUES ($bpm, '$mood', $app_id)";

        $result = $conn->query($sql);

    }

    return $bpm;
}

function getAppId($member_id, $conn) {
    $device_id = 0;

    $sql = "SELECT pulse_app_id 
            FROM emotion_regulator_app 
            WHERE member_id = $member_id";

    $result = $conn->query($sql);

    if($row = $result->fetch_assoc()) {
        $device_id = $row['pulse_app_id'];
    }

    return $device_id;
}

function determineMood($bpm) {
    
    if ($bpm >= 80) {
        return "Happy";
    } elseif ($bpm >= 60 && $bpm < 80) {
        return "Moderate";
    } else {
        return "Sad";
    }
}

function saveBpm($bpm, $member_id, $conn) {
    $sql = "INSERT pulse_data (pulse_rate, device_id) VALUES ($bpm, (SELECT pulse_device_id FROM emotion_regulator_app WHERE $member_id = member_id))";

    $conn->query($sql);
}

?>