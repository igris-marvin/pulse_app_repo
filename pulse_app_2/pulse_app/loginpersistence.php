<?php

function login($username, $password, $conn) {
    $flag = false;

    //get user with specified username and password
    $sql = "SELECT member_id FROM member WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    //if found, get user last 10 pulse rates and store in the database
    if ($result->num_rows > 0) {
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

?>