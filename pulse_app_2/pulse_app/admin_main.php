<?php

require_once('connect.php'); //connect to database

$message;

if(isset($_GET['user_id'])) {
    $del_id = $_GET['user_id'];

    //CHECK IF USER EXISTS
    $sql = "SELECT user_id FROM user WHERE user_id = $del_id";
    $result = $connection->query($sql); //execute query

    if (!$result) {
        die("Invalid query: " . $connection->error);
    }

    //read each record from table
    if ($row = $result->fetch_assoc()) {
            
        // DELETE PULSE RECORDS FIRST
        $sql_pulse = "DELETE FROM pulse WHERE user_id = $del_id";
        $update_pulse = $connection->prepare($sql_pulse);
        $update_pulse->execute();

        // CHECK IF DELETION OF PULSE RECORDS WAS SUCCESSFUL
        if($update_pulse->error) {
            die("Error deleting pulse records: " . $update_pulse->error);
        }

        // DELETE USER
        $sql_user = "DELETE FROM user WHERE user_id = $del_id";          
        $update_user = $connection->prepare($sql_user);
        $update_user->execute();

        // CHECK IF DELETION OF USER WAS SUCCESSFUL
        if($update_user->error) {
            die("Error deleting user: " . $update_user->error);
        } else {
            $message = "User deleted succesfully";
        }

    } else {
        $message;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Main</title>
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
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        .align-category {
            text-align: center;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        .action-links {
            display: flex;
            justify-content: space-around;
        }

        .action-links a {
            color: #007bff;
            text-decoration: none;
        }

        .remove-link a {
            color: red;
        }

        .action-links a:hover {
            text-decoration: underline;
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

        .success {
            color: black;
            text-align: center;
            margin-bottom: 10px;
            padding: 10px;
            background-color: lightgreen;
            border: 2px solid darkgreen;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<div class="container">

    <h1>List Of Users</h1>

    <?php if (!empty($message)): ?>
        <div class="success">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <table>
        <tr>
            <th>Username</th>
            <th>Surname</th>
            <th>Name</th>
            <th class="align-category">Action</th>
        </tr>

        <?php

        //read all records from database table, for the admin that has logged in
        $sql = "SELECT u.user_id, u.name, u.surname, u.username FROM user u, admin a WHERE u.admin_id = a.admin_id";
        $result = $connection->query($sql); //execute query

        if (!$result) {
            die("Invalid query: " . $connection->error);
        }

        //read each record from table
        while ($row = $result->fetch_assoc()) {
            echo "
                                <tr>
                                    <td>$row[username]</td>
                                    <td>$row[name]</td>
                                    <td>$row[surname]</td>
                                    <td class='action-links'>
                                        <a href='view_user.php?user_id=$row[user_id]'>View</a>
                                    </td>
                                    <td class='action-links remove-link'>
                                        <a href='admin_main.php?user_id=$row[user_id]'>Remove</a>
                                    </td>
                                </tr>
                            ";
        }
        ?>
        <tr>
            <td colspan="4"><a href="admin_login.php" class="logout-link">Log Out</a></td>
        </tr>
    </table>
</div>
</body>
</html>
