<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Main</title>
</head>
<body>
    <div>
        <table>
            <tr>
                <th>Username</th>
                <th>Surname</th>
                <th>Name</th>
                <th>Action</th>
            </tr>

            <?php
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
                        $sql = "SELECT * FROM user";
                        $result = $connection->query($sql); //execute query

                        if(!$result) {
                            die("Invalid query: " . $connection->error);
                        }

                        //read each record from table
                        while($row = $result->fetch_assoc()) {
                            echo "      
                                <tr>
                                    <td>$row[username]</td>
                                    <td>$row[name]</td>
                                    <td>$row[surname]</td>
                                    <td>
                                        <a href='view_user.php?id=$row[id]'><span>View</span></a>
                                    </td>
                                </tr>
                            ";
                        }
            ?>
            <tr>
                <td colspan="2" align="center"><a href="welcome.php">Log Out</a></td>
            </tr>
        </table>
    </div>
</body>
</html>