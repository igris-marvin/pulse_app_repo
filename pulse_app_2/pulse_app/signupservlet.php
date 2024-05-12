<?php
session_start();

require_once("connect.php"); //IMPORT DATABASE CONNECTION
require_once("persistence.php"); //IMPORT PERSISTENCE FUNCTIONS
require_once("user.php"); //IMPORT USER CLASS

$error;

if (isset($_POST['register'])) {
    $name = $_POST['name']; //get name from input
    $surname = $_POST['surname']; //get surname from input
    $username = $_POST['username']; //get username from input
    
    //TEST USERNAME
    $sql = "SELECT username FROM user";
    $result = $connection->query($sql);

    while($row = $result->fetch_assoc()) {

        if($row['username'] == $username) {

            $error = "Username already exists, please enter a different username.";
        }
    }

    //validate users input
    if (!validateCredentials($name) || !validateCredentials($surname)) {
        
        $error = "Invalid name or surname";
    } elseif (!validateUsername($username)) {

        $error = "Invalid username";
    } elseif(!validateMinLength($name) || !validateMinLength($surname) || !validateMinLength($username)) {

        $error = "name, surname or username length must be greater than 3 characters";
    }elseif(!validateMaxLength($name) || !validateMaxLength($surname) || !validateMaxLength($username)) {

        $error = "name, surname or username length must be less than 25 characters";
    }

    if(empty($error)) {
            
        $user_id;
        
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];    

        if ($password !== $confirm_password) { //COMPARE PASSWORDS 

            $error = "Passwords do not match";

        } else {

            $admin_id = assignAdmin($connection);

            if(!empty($admin_id)) {

                $sql = "INSERT INTO user (name, surname, username, password, admin_id)
                        VALUES ('$name', '$surname', '$username', '$password', $admin_id)";
                
                if (mysqli_query($connection, $sql)) {

                    //get new user user_id
                    $sql = "SELECT user_id FROM user WHERE username = '$username'";
                    $result = $connection->query($sql);

                    if($row = $result->fetch_assoc()) {
                        $user_id = $row['user_id'];
                    }

                    header('Location: login.php');
                    exit();
                } else {
                    $error = "Error: " . $sql . "<br>" . mysqli_error($connection);
                }
            }
        }
    }
}

function assignAdmin($connection) { //ASSIGN ADMIN TO new user

    $sql = "SELECT * FROM admin";
    $result = $connection->query($sql); //execute query

    if (!$result) {
        die("Invalid query: " . $connection->error);
    }

    $admin_ids = array();

    //read each record from table
    while ($row = $result->fetch_assoc()) {
        //store admin ids inside an array
        $admin_ids[] = $row['admin_id']; // assuming 'id' is the column name for admin id
    }

    if (count($admin_ids) > 0) {
        //randomise a number from 0 to whichever number of admins are available - 1
        $random_index = rand(0, count($admin_ids) - 1);

        //get the admin id of that index/randomised number
        $random_admin_id = $admin_ids[$random_index];

        return $random_admin_id;
    } else {
        $error = "No administrators found!";
    }
}

function validateUsername($text) {
    // For username: only letters and numbers are allowed
    if (preg_match('/^[a-zA-Z0-9]+$/', $text)) {

        return true;
    } else {

        return false;
    }
}

function validateCredentials($text) {
    // For name and surname: only letters are allowed
    if (preg_match('/^[a-zA-Z]+$/', $text)) {

        return true;
    } else {

        return false;
    }
}

function validateMinLength($text) {
    if(strlen($text) < 3) {
        return false;
    }

    return true;
}

function validateMaxLength($text) {
    
    if(strlen($text) > 25) {
        return false;
    }

    return true;
}

mysqli_close($connection);

?>