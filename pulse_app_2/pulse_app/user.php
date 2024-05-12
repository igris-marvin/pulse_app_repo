<?php
class User {
    private $id_num;
    private $image_data;
    private $name;
    private $surname;
    private $password;
    private $gender;
    private $dob;
    private $role;
    private $mgr;

    // Constructor
    public function __construct($id_num, $image_data, $name, $surname, $password, $gender, $dob, $role, $mgr) {
        $this->id_num = $id_num;
        $this->image_data = $image_data;
        $this->name = $name;
        $this->surname = $surname;
        $this->password = $password;
        $this->gender = $gender;
        $this->dob = $dob;
        $this->role = $role;
        $this->mgr = $mgr;
    }

    // Getter methods
    public function getIdNum() {
        return $this->id_num;
    }

    public function getImageData() {
        return $this->image_data;
    }

    public function getName() {
        return $this->name;
    }

    public function getSurname() {
        return $this->surname;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getGender() {
        return $this->gender;
    }

    public function getDob() {
        return $this->dob;
    }

    public function getRole() {
        return $this->role;
    }

    public function getMgr() {
        return $this->mgr;
    }

    // Setter methods
    public function setIdNum($id_num) {
        $this->id_num = $id_num;
    }

    public function setImageData($image_data) {
        $this->image_data = $image_data;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setSurname($surname) {
        $this->surname = $surname;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setGender($gender) {
        $this->gender = $gender;
    }

    public function setDob($dob) {
        $this->dob = $dob;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    public function setMgr($mgr) {
        $this->mgr = $mgr;
    }
}
?>