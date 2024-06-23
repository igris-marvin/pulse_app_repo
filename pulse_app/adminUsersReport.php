<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "pulsedb";

//establish connection with the database
$conn = mysqli_connect($servername, $username, $password, $database);

//check connection establishment
if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch users data
$sql = "SELECT name, surname, username, gender, dob, member_id FROM users";
$result = $conn->query($sql);

$users = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $row['age'] = date_diff(date_create($row['dob']), date_create('today'))->y;
        $users[] = $row;
    }
} else {
    echo "0 results";
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Information</title>
</head>
<body>
    <h1>User Information</h1>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Surname</th>
            <th>Username</th>
            <th>Gender</th>
            <th>Age</th>
            <th>Member ID</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo htmlspecialchars($user['name']); ?></td>
            <td><?php echo htmlspecialchars($user['surname']); ?></td>
            <td><?php echo htmlspecialchars($user['username']); ?></td>
            <td><?php echo htmlspecialchars($user['gender']); ?></td>
            <td><?php echo htmlspecialchars($user['age']); ?></td>
            <td><?php echo htmlspecialchars($user['member_id']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <form method="post" action="download.php">
        <button type="submit">Download as PDF</button>
    </form>
</body>
</html>
