<?php

require_once("connect.php");
require_once("view_user_repository.php");

if(isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

} else {
    // Handle the case where 'id' parameter is not set
    echo "User ID is not provided in the URL.";

    header("location: admin_login.php");
}

$pulse = getUserPulse($user_id, $conn);

$sql = "SELECT * 
        FROM member 
        WHERE member_id = $user_id";

$result = $conn->query($sql); //execute query

if(!$result) {
    die("Invalid query: " . $conn->error);
}

if($row = $result->fetch_assoc()) {
    $id = $row['member_id'];
    $username = $row['username'];
    $name = $row['name'];
    $surname = $row['surname'];
}

?>