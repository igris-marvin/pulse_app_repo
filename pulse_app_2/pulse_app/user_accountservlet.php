<?php 

require_once("connect.php");
require_once("user_accountpersistence.php");
require_once("member.php");

$user_id;

if(isset($_GET['user_id'])) {

    $user_id = $_GET['user_id'];

} else {
    header("Location: login.php");
}

$sql =  "SELECT *
         FROM user
         WHERE user_id = $id";

$result = $connection->query($sql); //execute query

if (!$result) {
    die("Invalid query: " . $connection->error);
}

//GET USER INFORMATION
$name;
$surname;
$username;

if($row = $result->fetch_assoc()) {
    $username = $row['username'];
    $name = $row['name'];
    $surname = $row['surname'];
}

?>