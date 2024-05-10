<?php
// Database connection
require_once("connect.php");

$errMsg = "";

//attach se

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get username and password from form
    $username = $_POST["username"];
    $password = $_POST["password"];

    if(!validateUsername($username)) {
        $errMsg = "Invalid Username";
    }

    if(empty($errMsg)) {

        $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            if ($row = $result->fetch_assoc()) {
                $id = $row['user_id'];
            }
        
        // Assuming you have the connection established in $connection and $id holds the user ID

            //CHECK IF pulse record for user exists
            $sql = "SELECT * FROM pulse WHERE user_id = '$id'";
            $result = $connection->query($sql);
                
            $bpm = rand(60, 100); // Generating a random BPM

            if($result->num_rows > 0) { //CHECK IF USER IS ASSOCIATED WITH PULSE

                //update pulse record of user 
                $sql = "UPDATE pulse SET pulse_rate = '$bpm' WHERE user_id = '$id'";
            } else {
                
                //create pulse record for user
                $sql = "INSERT INTO pulse (pulse_rate, user_id) VALUES ('$bpm', '$id')";
            }
        
            if (mysqli_query($connection, $sql)) {

                header("Location: welcome.php?user_id=$id");
                exit();
            } else {

                echo "Error updating record: " . mysqli_error($connection);
            }

        } else {
            
            $errMsg = "Invalid username or password";
        }
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

// Close connection
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styleLogin.css">
    <link rel="stylesheet" href="styleLog.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        .container99
        {
            background-color: black;
            height: 400px;
            padding: 30px;
            border: 2px solid #0ef;
            background: transparent;
        }

        .navbar
        {          
           margin-bottom: 35%;         
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
  

<div class="container99">
    <div class="form-box sign-up">
        <h2 class="animation">Login</h2>
        <form method="post" action="">

            <div  class="input-box animation" style="--i:17;">            
                <input type="text" name="username" required>
                <label>Username</label>
            </div>

            <div class="input-box animation" style="--i:18;">
                <input type="password" name="password" required>
                <label>Password</label>
            </div>          
        <?php if ($errMsg != ""): ?>
            <p style="color: red;"><?php echo $errMsg; ?></p>
        <?php endif; ?>
            
            <input type="submit" name="register" class="btn animation" style="--i:19;"; value="Login">
                
            <div class="form-box login">
                
            <div class="animation">
                <p><a href="signup.php" class="back-link animation" style="--i:0;">Back</a></p>        
            </div>  
        </form>
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
