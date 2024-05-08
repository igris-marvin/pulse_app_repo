<?php

class User {
    // Properties
    private $id_number;
    private $username;
    private $email;
    private $password;

    // Constructor
    public function __construct($username, $email, $password) {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    // Getters and setters
    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    // For security reasons, password should not be directly accessible
    // If needed, you can implement a method to check password against a given input
    // For example:
    // public function verifyPassword($inputPassword) {
    //     return password_verify($inputPassword, $this->password);
    // }

    // Other methods
    public function displayUserInfo() {
        echo "Username: " . $this->username . "<br>";
        echo "Email: " . $this->email . "<br>";
    }
}

// Example usage:
$user = new User("john_doe", "john@example.com", "password123");
$user->displayUserInfo();


?>