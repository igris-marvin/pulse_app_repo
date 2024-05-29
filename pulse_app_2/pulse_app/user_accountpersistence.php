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

function getDefaultImage($conn) {
    $image;

    $sql = "SELECT image 
            FROM member 
            WHERE member_id = 1";

    $result = $conn->query($sql);

    if($row = $result->fetch_assoc()) {
        $image = $row['image'];
    }

    return $image;
}

function deleteUser($member_id, $conn) {
    // Define the variable to hold device_id
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