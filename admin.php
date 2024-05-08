<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_system";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to display user details in a table
function displayUserDetails($conn, $username, $password) {
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        echo "<table border='1'>
        <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Password</th>
        <th>BPM</th>
        <th>Mood</th>
        </tr>";
        $row = $result->fetch_assoc();
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['password'] . "</td>";
        echo "<td>" . $row['bpm'] . "</td>";
        echo "<td>" . $row['mood'] . "</td>";
        echo "</tr>";
        echo "</table>";
    } else {
        echo "<span style='color:red;'>User does not exist</span>";
    }
}

// Check if form is submitted for Read, Update, or Delete
if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $action = $_POST['submit'];
    
    if ($action === "Read") {
        displayUserDetails($conn, $username, $password);
    } else {
        // Check if the admin exists in the database for Update or Delete actions
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = $conn->query($sql);
        
        if ($result->num_rows == 1) {
            // Admin exists, perform action
            switch ($action) {
                case "Update":
                    echo "Update functionality to be implemented.";
                    break;
                case "Delete":
                    echo "Delete functionality to be implemented.";
                    break;
            }
        } else {
            // Admin doesn't exist
            echo "<span style='color:red;'>User does not exist</span>";
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
</head>
<body>
    
    
    <h2>Admin Actions</h2>
    <form method="post">
        Username: <input type="text" name="username"><br><br>
        Password: <input type="password" name="password"><br><br>
        <input type="submit" name="submit" value="Read">
        <input type="submit" name="submit" value="Update">
        <input type="submit" name="submit" value="Delete">
    </form>

    <p><a href="signup.php">Back</a></p>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
