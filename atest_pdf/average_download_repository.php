<?php

function getAverageData($member_id, $conn) {
    $count = 0;

    $data = [];

    $sql = "SELECT * 
            FROM reading r, emotion_regulator_app app
            WHERE app.pulse_app_id = r.pulse_app_id 
            AND app.member_id = $member_id";

    $result = $conn->query($sql);

    while($row = $result->fetch_assoc()) {
        $count++;

        echo "$count";

        $data[] = new Average($count, $row['average'], $row['mood'], (new DateTime($row['timestamp']))->format('d M y'), (new DateTime($row['timestamp']))->format('H:i'));
    }

    return $data;
}

?>