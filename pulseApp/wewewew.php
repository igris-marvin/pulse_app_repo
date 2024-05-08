<?php

$query = "Select * from userdetails";
$result = mysqli_query($connection,$query)

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Webpage</title>
    <link rel="stylesheet" href="styles.css">
    <title>Display of user's details</title>
</head>

<body >
    <div class = "container">
        <div class = "row mt-5">
            <div class = "col">
                <div class="display mt-5">
                    <div class = "display-heading ">
                        <h2 class="display-6 text-center">All Users Details</h2>
                    </div>
                        <div class="display-body">
                            <table border="1">
                                <tr>
                                    <td>Username</td>
                                    <td>ID Number</td>
                                    <td>Name</td>
                                    <td>Surname</td>
                                    <td>Phone Number</td>
                                    <td>Email</td>
                                </tr>
                                <tr>
                                    <?php 
                                    
                                        while($row = mysqli_fetch_assoc($result)){

                                        
                                    ?>

`                                       <td><?php echo $row['userid']; ?></td>
`                                       <td><?php echo $row['age']; ?></td>
`                                       <td><?php echo $row['name']; ?></td>
`                                       <td><?php echo $row['surname']; ?></td>
`                                       <td><?php echo $row['phone']; ?></td>
`                                       <td><button onclick="window.location.href = ViewPulsePage.php">Pulse Details</button></td>

                                </tr>
                                <?php 
                                }
                                ?>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
</body>