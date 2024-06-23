<?php 

//START OR RESUME SESSION FROM PREVIOUS PAGE
session_start();

//CONNECT TO DATABASE
require_once("connect.php");

if(isset($_GET['user_id'])) {
    // Sanitize the input to prevent SQL injection
    $id = $_GET['user_id'];
    
    // Now you can use $user_id in your queries or other operations
    // For example, you can retrieve user details from the database based on this ID
    // Make sure to use proper prepared statements to prevent SQL injection
} else {
    // Handle the case where 'id' parameter is not set
    echo "User ID is not provided in the URL.";
}

$id;

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
    <link rel="stylesheet" href="userAccountStyle.css">
    <style>
        

     

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: white;
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
            background-color: #080B0E;
        }

        .profile-link {
            position: relative;
            width: 200px;
            height: 35px;            
            background: transparent;
            border: 2px solid #0ef;
            outline: none;
            border-radius: 40px;
            cursor: pointer;
            font-size: 16px;
            color: #fff;
            font-weight: 600;       
            margin-top: 30px;   
            margin-left: 20px;  
            transition: .5s;
        }

        .profile-link:hover {
             background-color: #009EC1;
            border: 2px solid #fff;
        }

        .logout-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #666;
            text-decoration: none;
        }
        
        .logout-link:hover {
            color: white;
            transition: .5s;
        }

        .delete-button {
            background-color: red;
            color: #0ef;
        }
        .movBtn
        {
            margin-left: 15px;
        }
        .textE
        {
           margin-top: 5px;
        }
    </style>
</head>
<body>
<div class="panel1">
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
                                <a href='edit_profile.php?id=$id' class='btn2'><span class='textE'>Edit Profile<span></a>
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
                        <div class="movBtn">
                        <button type="submit" name="delete_user" class='profile-link'>Delete User</button>
                        </div>
                   
                </form>
                </td>
            </tr>
        </table>
        <a href="index.php" class="logout-link">Log Out</a>
    </div>
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