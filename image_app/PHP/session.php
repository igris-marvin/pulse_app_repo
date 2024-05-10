<?php

// Start the session
session_start();

// Set session variables
$_SESSION['username'] = 'john_doe';
$_SESSION['user_id'] = 123;

// Access session variables
$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];
echo "Welcome back, $username (User ID: $user_id)";

// Unset a session variable
unset($_SESSION['username']);

// Destroy the session
session_destroy();

?>