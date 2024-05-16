<?php

function login($username, $password, $conn) {
    $flag = false;
    $member_id = null;
    $device_id = null;

    
    $sql = "SELECT member_id FROM member WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        if ($row = $result->fetch_assoc()) {
            $member_id = $row['member_id'];
        }
    
        //generate pulse_rate
        $pulse_rate = rand(60, 100);

        //get id of user pulse_device
        $sql = "SELECT pulse_device_id FROM emotion_regulator_app WHERE member_id = $member_id";
        $result = $conn->query($sql);

        if($row = $result->fetch_assoc()) {
            $device_id = $row['pulse_device_id'];
        }

        //store generated pulse rate of user into the database
        $sql = "UPDATE pulse_detector_device SET pulse_rate = ? WHERE device_id = ?";
        $stmt = $conn->prepare($sql);

        $stmt->bind_param("ii", 
            $pulse_rate,
            $device_id
        );

        $stmt->execute();
        $stmt->close();

        //store mood into pulse app
        $mood = getMood($pulse_rate);

        $sql = "UPDATE emotion_regulator_app SET mood = ? WHERE member_id = ?";
        $stmt = $conn->prepare($sql);

        $stmt->bind_param("si", 
            $mood,
            $member_id
        );

        $stmt->execute();
        $stmt->close();

        $flag = true;
    }

    return $flag;
}

function getMemberId($username, $conn) {
    $sql = "SELECT member_id FROM member WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($row = $result->fetch_assoc()) {

        $member_id = $row['member_id'];

        return $member_id;
    }

    return null;
}

function getMood($bpm) {
    if ($bpm >= 80) {
        return "Happy";
    } elseif ($bpm >= 60 && $bpm < 80) {
        return "Moderate";
    } else {
        return "Sad";
    }
}

?>