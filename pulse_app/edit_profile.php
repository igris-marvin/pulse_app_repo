<?php
require_once("connect.php");

if(isset($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $id = $_GET['id'];
    
    // Now you can use $id in your queries or other operations
    // For example, you can retrieve user details from the database based on this ID
    // Make sure to use proper prepared statements to prevent SQL injection
} else {
    // Handle the case where 'id' parameter is not set
    echo "User ID is not provided in the URL.";
    header("Location: login.php");
    exit(); // Stop execution if user ID is not provided
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form data when form is submitted
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $error;

    if(validateCredentials($name) || validateCredentials($surname)) {
        
        echo '<p style="color:red; font-size:30px; margin-right:1000px;font-weight: 600;">Invalid name or surname</p>';
        $error = "not empty";
    } elseif(validateUsername($username)) {
        
        echo '<p style="color:red; font-size:30px; margin-right:1000px;font-weight: 600;">Invalid username</p>';
        $error = "not empty";
    } elseif(validateMinLength($name) || validateMinLength($surname) || validateMinLength($username)) {
        
        echo '<p style="color:red; font-size:30px; margin-right:1000px;font-weight: 600;">Error, name, surname or username must be more than 3 characters</p>';
        $error = "not empty";
    } elseif(validateMaxLength($name) || validateMinLength($surname) || validateMinLength($username)) {

        echo '<p style="color:red; font-size:30px; margin-right:1000px;font-weight: 600;">Error, name, surname or username must be less than 25 characters</p>';
        $error = "not empty";
    }

    if(empty($error)) {
        
        // Update the user profile in the database
        $sql = "UPDATE user SET name=?, surname=?, username=?, password=? WHERE user_id=?";
        $stmt = $connection->prepare($sql); 
        $stmt->bind_param("ssssi", $name, $surname, $username, $password, $id);

        if ($stmt->execute()) {
            // Profile updated successfully
            echo '<p style="color:limegreen; font-size:30px; margin-right:1000px;font-weight: 600;">Your Profile Has Been Updated</p>';
        } else {
            // Error updating profile
            echo "Error: " . $sql . "<br>" . $connection->error;
        }

        // Close statement
        $stmt->close();
    }
}

// Redirect to welcome.php
function redirectToWelcomePage() {
    header("Location: welcome.php");
    exit();
}
$sql =  "SELECT *
         FROM user
         WHERE user_id = $id";

$result = $connection->query($sql); //execute query
if (!$result) {
    die("Invalid query: " . $connection->error);
}

$name;
$surname;
$username;
$password;

if($row = $result->fetch_assoc()) {
    $username = $row['username'];
    $name = $row['name'];
    $surname = $row['surname'];
    $password = $row['password'];
}

function validateUsername($text) {
    // For username: only letters and numbers are allowed
    if (preg_match('/^[a-zA-Z0-9]+$/', $text)) {

        return false;
    } else {

        return true;
    }
}

function validateCredentials($text) {
    // For name and surname: only letters are allowed
    if (preg_match('/^[a-zA-Z]+$/', $text)) {

        return false;
    } else {

        return true;
    }
}

function validateMinLength($text) {
    if(strlen($text) < 3) {
        return true;
    }

    return false;
}

function validateMaxLength($text) {
    
    if(strlen($text) > 25) {
        return true;
    }

    return false;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profileStyle.css">
    <title>Edit Profile</title>
    <style>
        .nodeco {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="panel1">
    <h1 class="heading1">Edit Profile</h1>
    <form method="post">
        <div class="form-box sign-up">
 
        <div  class="input-box animation" style="--i:17;">  
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="<?php echo $name?>" required><br>
        </div>

        <div  class="input-box animation" style="--i:17;"> 
        <label for="surname">Surname:</label><br>
        <input type="text" id="surname" name="surname" value="<?php echo $surname?>" required><br>
        </div>

        <div  class="input-box animation" style="--i:17;"> 
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" value="<?php echo $username?>" required><br>
        </div>

        <div  class="input-box animation" style="--i:17;"> 
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" value="<?php echo $password?>" required><br><br>
        </div>

        </div>
        
        <button type="submit" class="btn">Update Profile</button>
    </form>
    <br/>
    <?php echo "
            <a href='user_account.php?user_id=$id'><span class='btn1'>View Profile</span>
                "
    ?>
    <span></span>
    <br>
    <br>
    <?php echo "
        <a href='welcome.php?user_id=$id' class='btn1'>Back to Welcome Page</a>
        "
    ?>
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
    
</body>
</html>
