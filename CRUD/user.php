<?php

  include 'connect.php';
  if (isset($_POST['submit'])){

    $name=$_POST['name'];
    $surname=$_POST['surname'];
    $gender=$_POST['gender'];
    $age=$_POST['age'];

    $sql="insert into `userdetails` (name ,surname,gender,age)
    values ('$name','$surname','$gender','$age')";
    $result=mysqli_query($con,$sql);
    if($result){
        echo "data inserted successfully";
        header('location:display.php');
    }else {
        die(mysqli_error($con));
    }
  }

?>



<!doctype html>
<html lang="en">
    <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <title>USER DETAILS PAGE</title>
    </head>
    <body>
        <div  class="container my-5">
            <form method ="post">
               <div class="form-group">
                   <label>Name</label>
                   <input type="text" class="form-control" name="name" autocomplete="off">
               </div>
               <div class="form-group">
                   <label>Surname</label>
                   <input type="text" class="form-control" name="surname" autocomplete="off">
               </div>

               <div class = "form-group">
                    <label for="gender">Gender</label>
                    <div>
                        <label for="male" class="radio-inline"><input type="radio" name="gender" value="Male" id="male">Male</label>
                        <label for="female" class="radio-inline"><input type="radio" name="gender" value="Female" id="female">Female</label>
                        <label for="others" class="radio-inline"><input type="radio" name="gender" value="Other" id="others">Others</label>
                    </div>
               </div>

               <div class="form-group">
                   <label>Age</label>
                   <input type="text" class="form-control" name="age" autocomplete="off">
               </div>

               <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </form>
        </div>
    </body>
 </html>