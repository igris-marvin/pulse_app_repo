<?php

function getMoodCount($member_id, $mood, $conn) {
    $count = 0;

    $sql = "SELECT COUNT(mood) AS mood_count 
            FROM reading r, emotion_regulator_app a 
            WHERE mood IN ('$mood') 
            AND a.pulse_app_id = r.pulse_app_id AND a.member_id = $member_id";

    $result = $conn->query($sql);

    if($row = $result->fetch_assoc()) {
        $count = $row['mood_count'];
    }

    return $count;
}

?>