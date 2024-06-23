<?php

function getMemberObject($user_id, $member_object, $conn) {
    $sql = "SELECT member_id, name, surname, username, image, dob, gender 
            FROM member 
            WHERE member_id = $user_id";

    $result = $conn->query($sql);

    if($row = $result->fetch_assoc()) {
        $member_object->setMember_id($row['member_id']);
        $member_object->setName($row['name']);
        $member_object->setSurname($row['surname']);
        $member_object->setUsername($row['username']);
        $member_object->setImage($row['image']);
        $member_object->setDob($row['dob']);
        $member_object->setGender($row['gender']);
    }

    return $member_object;
}

function deleteUser($member_id, $conn) {
    // Define the variable to hold device_id
    $device_id = null;
    $app_id = null;
    
    //get user device id
    $sql = "SELECT pulse_device_id FROM emotion_regulator_app WHERE member_id = $member_id";

    $result = $conn->query($sql);

    if( ($row = $result->fetch_assoc()) ) {
        $device_id = $row['pulse_device_id'];
    }

    //get app id
    $sql = "SELECT pulse_app_id FROM emotion_regulator_app WHERE member_id = $member_id";

    $result = $conn->query($sql);

    if($row = $result->fetch_assoc()) {
        $app_id = $row['pulse_app_id'];
    }

    //REMOVE USER PULSE DATA
    $sql = "DELETE FROM pulse_data WHERE device_id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i",
        $device_id
    );

    $stmt->execute();

    //REMOVE USER READINGS
    $sql = "DELETE FROM reading WHERE pulse_app_id = $app_id";

    $result = $conn->query($sql);

    //REMOVE USER APP
    $sql = "DELETE FROM emotion_regulator_app WHERE member_id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i",
        $member_id
    );

    $stmt->execute();

    //REMOVE USER DEVICE
    $sql = "DELETE FROM pulse_detector_device WHERE device_id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i",
        $device_id
    );

    $stmt->execute();

    //REMOVE USER ACCOUNT
    $sql = "DELETE FROM member WHERE member_id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i",
        $member_id
    );

    $stmt->execute();
}

?>