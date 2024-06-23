<?php

require_once("connect.php");
require_once("loginpersistence.php");

$errMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get username and password from form
    $username = $_POST["username"];
    $password = $_POST["password"];

    $flag = login($username, $password, $conn);

    if($flag === true) {

        $member_id = getMemberId($username, $conn);

        //TRIGGER NODE JS SERVER
        $memberId = $member_id;

        //-------------------------------------------------------------

        header("Location: welcome.php?user_id=$member_id");
        $conn->close();
        exit();

    } else {
        $errMsg = "Invalid username or password!";
    }
}

// Close conn
$conn->close();

?>