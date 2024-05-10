<?php
session_start();

require_once("connect.php");

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="styleLogin.css">
    <title>Register</title>
    
    <style>
        .navbar
        {          
           margin-bottom: 42%;         
        }
        .btn6
        {
            color: #fbfcfd;
            padding: 10px 25px;
            background: transparent;
            border: 1px solid #fff;
            border-radius: 20px;
            text-decoration: none;
            outline: none;
            cursor: pointer;
            transition: color 0.3s;            
            margin-bottom: 100px;
            
           
        }
        .btn6:hover
        {
            color: aqua            
        }
    </style>
</head>
<body>
<div class="navbar">
            <a href="index.php" class="btn6">Home</a>            
        </div>
  
    <div class="container">
        
        <span class="bg-animate"></span>
        <span class="bg-animate2"></span>

       <div class="form-box login">
        
        <div class="animation">
        <p><a href="#" class="register-link animation" style="--i:0;">Register</a></p>       
        </div>              
        
       </div>      

       <div class="info-text login">
         <h2 class="animation" style="--i:0;">Welcome To Our,<br>Pulse App!</h2>
         <p class="animation" style="--i:1;">Track your pulse and <br> stay healthly with our app.</p>
      </div>
      <div class="form-box sign-up">
        <h2 class="animation">Sign Up</h2>
        <form method="post" action="">
            <?php if(isset($error)) { ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>
            <div class="input-box animation" style="--i:17;">
                
            <input type="text" name="name" required>
                <label>Name</label>
            </div>

            <div class="input-box animation" style="--i:18;">
                
            <input type="text" name="surname" required>
                <label>Surname</label>
            </div>

            <div class="input-box animation" style="--i:19;">
                
                <input type="text" name="username"  required>
                <label>Username</label>
            </div>
            <div class="input-box animation" style="--i:20;">
                
                <input type="password" name="password"  required>
                <label>Password</label>
            </div>  
            <div class="input-box animation" style="--i:21;">  
                
                <input type="password" name="confirm_password"  required>
                <label>Confirm Password</label>
            </div>
            
            <input type="submit" name="register" class="btn animation" style="--i:22;"; value="Sign Up">

            <div class="reg-link animation" style="--i:23;">
                <p>Already have an account?<a href="login.php" class="signup-link">Login</a></p>
            </div>
        </form>
        
       </div> 
       <div class="info-text sign-up">         
         <h2 class="heading animation" style="--i:17;">Pulse App</h2>
         <p class="animation" style="--i:18;">The pulse app is an application that<br> tracks your pulse.</p>
         <div class="animation" style="--i:19;">
         <div class="heart ">
            
            </div>
         </div>
         
      </div>
    </div>     

            <div class="bubbles">
            <img src="images/bubble.png">
            <img src="images/bubble.png">
            <img src="images/bubble.png">
            <img src="images/bubble.png">
            <img src="images/bubble.png">
            <img src="images/bubble.png">
            <img src="images/bubble.png">
            </div>
     
      
    <script src="script.js"></script>
</body>
</html>
