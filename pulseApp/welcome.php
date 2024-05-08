<?php
session_start();

$db_host = 'localhost'; // Your MySQL host
$db_username = 'root'; // Your MySQL username
$db_password = ''; // Your MySQL password
$db_name = 'login_system'; // Your MySQL database name

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

$username = $_SESSION['username'];

// CRUD operations

if (isset($_POST['add_info'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $bpm = rand(60, 100); // Generating a random BPM

    $username = $_SESSION['username'];
    $sql = "UPDATE users SET name='$name', surname='$surname', bpm='$bpm' WHERE username='{$_SESSION['username']}'";
    
    if (mysqli_query($conn, $sql)) {
        // Redirect to summary.php upon successful save
        $_SESSION['name'] = $name;
        $_SESSION['surname'] = $surname;
        $_SESSION['bpm'] = $bpm;
        // Redirect to summary.php
        header('Location: summary.php');
        exit();
    } else {
        // Error message
    }
}

if (isset($_POST['delete_info'])) {
    $sql = "UPDATE users SET name=NULL, surname=NULL, bpm=NULL WHERE username='{$_SESSION['username']}'";
    
    if (mysqli_query($conn, $sql)) {
        // Success message
    } else {
        // Error message
    }
}

$sql = "SELECT name, surname, bpm FROM users WHERE username='{$_SESSION['username']}'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$surname = $row['surname'];
$bpm = $row['bpm'];


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['delete_user'])) {
    $username = $_SESSION['username'];

    $sql = "DELETE FROM users WHERE username='$username'";
    
    if (mysqli_query($conn, $sql)) {
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit();
    } else {
        // Error message
    }

}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        body {
            background-color: #000;
            color: #fff;
            font-family: Arial, sans-serif;
            animation: slideIn 1s ease-in-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-100%);
            }
            to {
                transform: translateY(0);
            }
        }

        .container {
            width: 800px;
            margin: 0 auto;
            margin-top: 100px;
            text-align: center;
        }
        .circle {
            width: 150px;
            height: 150px;
            background-color: #fff;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto;
            font-size: 24px;
            color: #000;
            font-weight: bold;
            margin-bottom: 20px;
            animation: pulse 2s infinite alternate;
        }
        @keyframes pulse {
            from {
                transform: scale(1);
                box-shadow: 0 0 0px #fff;
            }
            to {
                transform: scale(1.1);
                box-shadow: 0 0 20px #fff;
            }
        }
        .form-container {
            margin-top: 30px;
        }
        input[type="text"] {
            width: 300px;
            padding: 10px;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo $username; ?>!</h2>
        
        <div class="circle"><?php echo $bpm; ?> BPM</div>

        <div class="form-container">
            <form method="post" action="">
                <input type="text" name="name" placeholder="Name" value="<?php echo $name; ?>">
                <br>
                <input type="text" name="surname" placeholder="Surname" value="<?php echo $surname; ?>">
                <br>
                <input type="submit" name="add_info" value="Save Information">
                <input type="submit" name="delete_info" value="Delete Information">
                <input type="submit" name="delete_user" value="Delete User">
            </form>
        </div>
    </div>
</body>
</html>
