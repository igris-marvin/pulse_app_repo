<?php

include 'connect.php';

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Display Page</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container my-5">
        <h2>List of Clients</h2>
           <button class="btn btn-primary my-5"><a href="user.php" class="text-light">Add User</a></button>

           <table class="table">
               <thead>
                 <tr>
                    <th scope="col">id </th>
                    <th scope="col">Name </th>
                    <th scope="col">Surname </th>
                    <th scope="col">Gender</th>
                    <th scope="col">Age</th>
                    <th scope="col">Operation</th>

                 </tr>
               </thead>
               <tbody>

               <?php
               
               $sql="Select * from `userdetails`";
               $result =mysqli_query($con,$sql);
               if($result){
                  while ($row=mysqli_fetch_assoc($result)){
                       $id=$row['userid'];
                       $name=$row['name'];
                       $surname=$row['surname'];
                       $gender=$row['gender'];
                       $age=$row['age'];

                       echo' <tr>
                       <th scope="row">'.$id.'</td>
                       <th>'.$name.'</td>
                       <th>'.$surname.'</td>
                       <th>'.$gender.'</td>
                       <th>'.$age.'</td>
                       
                       <td>
                          <button class="btn btn-primary"><a href="update.php? updateid='.$id.'" class ="text-light">Update</a></button>
                          <button class="btn btn-danger"><a href="delete.php? deleteid='.$id.'" class="text-light">Delete</a></button>
                       </td>
                       </tr>';
                    }
               }
               
               
               ?>

               
               </tbody>
           </table>
        </div>

    </body>

</html>