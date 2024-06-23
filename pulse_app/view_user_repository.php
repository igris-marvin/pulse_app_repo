<?php

function getUserPulse($member_id, $conn) {
    $bpm = 0;

    $sql = "SELECT average 
            FROM reading r, emotion_regulator_app app 
            WHERE app.member_id = $member_id AND r.pulse_app_id = app.pulse_app_id 
            ORDER BY reading_id DESC 
            LIMIT 1";

    $result = $conn->query($sql);

    if($row = $result->fetch_assoc()) {
        $bpm = $row['average'];
    }

    return $bpm;
}

?>