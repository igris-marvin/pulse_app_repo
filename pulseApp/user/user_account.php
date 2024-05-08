<?php 

//START OR RESUME SESSION FROM PREVIOUS PAGE
session_start();

//CONNECT TO DATABASE
require_once("connect.php");

$id;

//get user id from session
if(isset($_SESSION['user_id'])) {
    // Retrieve the user ID from the session
    $id = $_SESSION['user_id'];
}

$sql =  "SELECT *
         FROM user
         WHERE user_id = $id";

$result = $connection->query($sql); //execute query

if (!$result) {
    die("Invalid query: " . $connection->error);
}

//DELETE USER
if(isset($_POST['delete_user'])) {
    $del_id = $_POST['del_id'];

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
     }
     
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit;
}

//GET USER INFORMATION
$name;
$surname;
$username;

if($row = $result->fetch_assoc()) {
    $username = $row['username'];
    $name = $row['name'];
    $surname = $row['surname'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        table {
            width: 100%;
            margin-bottom: 30px;
            border-collapse: collapse;
        }

        table td, table th {
            padding: 10px;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #f2f2f2;
        }

        .profile-link {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .profile-link:hover {
            background-color: #0056b3;
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

        .delete-button {
            background-color: red;
            color: black;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>User Account Details</h1>
    <table>
        <tr>
            <th>User ID:</th>
            <td><?php echo $id?></td>
        </tr>
        <tr>
            <th>Username:</th>
            <td><?php echo $username?></td>
        </tr>
        <tr>
            <th>Name:</th>
            <td><?php echo $name?></td>
        </tr>
        <tr>
            <th>Surname:</th>
            <td><?php echo $surname?></td>
        </tr>
        <tr>
            <td colspan="2"> 
                <?php echo  
                        "
                            <a href='edit_profile.php?id=$id' class='profile-link'>Edit Profile</a>
                        "
                    ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
            <form method="post">
                    <?php echo " 
                <input type='hidden' name='del_id' value='$id'>"  ?> <!-- Replace 123 with the actual user ID -->
                    <!-- Add a submit button -->
                <button type="submit" name="delete_user">Delete User</button>
            </form>
            </td>
        </tr>
    </table>
    <a href="index.php" class="logout-link">Log Out</a>
</div>
</body>
</html>