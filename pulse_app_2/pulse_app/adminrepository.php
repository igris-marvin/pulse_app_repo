<?php

function removeUser($member_id, $conn) {

    $device_id = null;
    
    //get user device id
    $sql = "SELECT pulse_device_id FROM emotion_regulator_app WHERE member_id = $member_id";

    $result = $conn->query($sql);

    if( ($row = $result->fetch_assoc()) ) {
        $device_id = $row['pulse_device_id'];
    }

    //remove user pulse data
    $sql = "DELETE FROM readings WHERE device_id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i",
        $device_id
    );

    $stmt->execute();

    //remove user app
    $sql = "DELETE FROM emotion_regulator_app WHERE member_id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i",
        $member_id
    );

    $stmt->execute();

    //remove user device
    $sql = "DELETE FROM pulse_detector_device WHERE device_id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i",
        $device_id
    );

    $stmt->execute();

    //remove user account
    $sql = "DELETE FROM member WHERE member_id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i",
        $member_id
    );

    $stmt->execute();

}

?>