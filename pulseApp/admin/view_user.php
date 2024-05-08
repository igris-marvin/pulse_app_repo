<?php 


// Check if the 'id' parameter is set in the URL
if(isset($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $user_id = $_GET['id'];
    
    // Now you can use $user_id in your queries or other operations
    // For example, you can retrieve user details from the database based on this ID
    // Make sure to use proper prepared statements to prevent SQL injection
} else {
    // Handle the case where 'id' parameter is not set
    echo "User ID is not provided in the URL.";
}


$servername = "localhost";
$username = "root";
$password = "";
$database = "login_system";

//establish connection with the database
$connection = mysqli_connect($servername, $username, $password, $database);

//check connection establishment
if($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

//read all records from database table
$sql = "SELECT * 
        FROM user 
        WHERE id=$user_id";

$result = $connection->query($sql); //execute query

if(!$result) {
    die("Invalid query: " . $connection->error);
}

if($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $username = $row['username'];
    $name = $row['name'];
    $surname = $row['surname'];
    $bpm = $row['bpm'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>User Pulse Details</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="display-head">
                        <h2><?php echo $name ?> Pulse Details<h2>
                </div>
                <div class="display-body">
                    <table>
                        <tr>
                            <td>User ID: </td>
                            <td><b><?php echo $id ?></b></td>
                        </tr>
                        <tr>
                            <td>Username: </td>
                            <td><b><?php echo $username ?></b></td>
                        </tr>
                        <tr>
                            <td>Name: </td>
                            <td><b><?php echo $name ?></b></td>
                        </tr>
                        <tr>
                            <td>Surname: </td>
                            <td><b><?php echo $surname ?></b></td>
                        </tr>
                        <tr>
                            <td>BPM: </td>
                            <td><b><?php echo $bpm ?></b></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><a href="admin_main.php">Back</a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>