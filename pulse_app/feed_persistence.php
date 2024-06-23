<?php

function getBpm($member_id, $conn) {
    $bpm = "---";

    $sql = "SELECT average 
            FROM reading r, emotion_regulator_app e 
            WHERE member_id = $member_id AND e.pulse_app_id = r.pulse_app_id 
            ORDER BY reading_id DESC 
            LIMIT 1";

    $result = $conn->query($sql);

    if($row = $result->fetch_assoc()) {
        $bpm = $row['average'];
    }

    return $bpm;
}

?>