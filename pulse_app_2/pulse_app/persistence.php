<?php

/* SIGN UP PERSISTENCE FUNCTIONS */

    //PERSISTENCE FUNCTION FOR SIGNUP
    function createUser($member_object, $conn) {
        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO member (dob, gender, id_number, image, mgr, name, password, role, tcs, username) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
        $dob = $member_object->getDob();      // DATE field, use "s" for string representation
        $gender = $member_object->getGender();   // CHAR(1), use "s" for string representation
        $idnum = $member_object->getIdNum();    // VARCHAR(13), use "s" for string representation
        $image = $member_object->getImageData();  // LONGBLOB, use "b" for binary data
        $mgr = $member_object->getMgr();      // INTEGER, use "i" for integer
        $name = $member_object->getName();     // VARCHAR(?), use "s" for string representation
        $surname = $member_object->getSurname();  // VARCHAR(?), use "s" for string representation
        $password = $member_object->getPassword(); // VARCHAR(?), use "s" for string representation
        $role = $member_object->getRole();     // VARCHAR(?), use "s" for string representation
        $tcs = $member_object->getTcs();
        $username = $member_object->getUsername(); 

        // Bind parameters and execute the statement
        $stmt->bind_param("sssbissssss",
            $dob,      // DATE field, use "s" for string representation
            $gender,   // CHAR(1), use "s" for string representation
            $idnum,    // VARCHAR(13), use "s" for string representation
            $image,  // LONGBLOB, use "b" for binary data
            $mgr,      // INTEGER, use "i" for integer
            $name,     // VARCHAR(?), use "s" for string representation
            $surname,  // VARCHAR(?), use "s" for string representation
            $password, // VARCHAR(?), use "s" for string representation
            $role,    // VARCHAR(?), use "s" for string representation
            $tcs,       // CHAR(1), use "s" for string representation
            $username
        );


        $stmt->execute();
    
        // Check if the data was inserted successfully
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    


    //PERSISTENCE FUNCTION FOR GETTING USERNAMES
    function testUsername($username, $error, $conn) {
        $sql = "SELECT username FROM member";
        $result = $conn->query($sql);

        while($row = $result->fetch_assoc()) {

            if($row['username'] == $username) {

                $error = "Username already exists, please enter a different username.";
            }
        }

        return $error;
    }

    function assignAdmin($conn) { //ASSIGN ADMIN TO new user
        $mgr = "";

        $sql = "SELECT member_id FROM member WHERE role = 'ADMIN'";
        $result = $conn->query($sql); //execute query
    
        if (!$result) {
            die("Invalid query: " . $conn->error);
        }

        if($row = $result->fetch_assoc()) {
            //store admin ids inside an array
            $mgr = $row['member_id'];

            return $mgr;
        }

        return $mgr;
    }

?>