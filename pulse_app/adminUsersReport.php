<?php


require_once("connect.php");

$admin_id = null;

if(isset($_GET['admin_id'])) {

    $admin_id = $_GET['admin_id'];

} else {
    header("location: admin_login.php");
    exit();
}


// Check connection establishment
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch users data
$sql = "SELECT name, surname, username, gender, dob, member_id FROM member WHERE role IN ('CUSTOMER')";
$result = $conn->query($sql);

$users = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $row['age'] = date_diff(date_create($row['dob']), date_create('today'))->y;
        $users[] = $row;
    }
} else {
    echo "0 results";
}
$conn->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['export_format'])) {
    $format = $_POST['export_format'];
    if ($format === 'csv') {
        exportToCSV($users);
    }
}

function exportToCSV($users) {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=user_information.csv');
    $output = fopen('php://output', 'w');
    fputcsv($output, array('Name', 'Surname', 'Username', 'Gender', 'Age', 'Member ID'));
    foreach ($users as $user) {
        fputcsv($output, $user);
    }
    fclose($output);
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            color: #000000;
        }
        th {
            background-color: #007bff;
            color: #fff;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        .logout-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #666;
            text-decoration: none;
        }
        .logout-link:hover {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
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
            <?php if (count($users) > 0): ?>
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
            <?php else: ?>
                <tr>
                    <td colspan="6">No users found.</td>
                </tr>
            <?php endif; ?>
        </table>
        <form method="post" action="">
            <input type="hidden" name="export_format" value="csv">
            <div class="button-container">
                <button type="submit">Download as CSV</button>
            </div>
        </form>
        <?php
            echo "<a class='logout-link' href='admin_main.php?admin_id=$admin_id'>Back</a>";
        ?>
    </div>
</body>
</html>
