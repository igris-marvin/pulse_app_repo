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
    </style>
</head>
<body>
<div class="container">
    <h1>Admin Main</h1>
    <table>
        <tr>
            <th>Username</th>
            <th>Surname</th>
            <th>Name</th>
            <th colspan="2">Action</th>
        </tr>

        <?php
        require_once('connect.php'); //importing connect.php

        //read all records from database table
        $sql = "SELECT * FROM user";
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
                                        <a href='view_user.php?id=$row[id]'>View</a>
                                        <a href='remove_user.php?id=$row[id]'>Remove</a>
                                    </td>
                                </tr>
                            ";
        }
        ?>
        <tr>
            <td colspan="4" align="center"><a href="welcome.php" class="logout-link">Log Out</a></td>
        </tr>
    </table>
</div>
</body>
</html>
