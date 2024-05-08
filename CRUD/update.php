<?php

  include 'connect.php';
  $id=$_GET['updateid'];
  $sql = "Select * from `userdetails` where userid=$id";
  $result=mysqli_query($con,$sql);
  $row=mysqli_fetch_assoc($result);
  $name=$row['name'];
  $surname=$row['surname'];
  $gender=$row['gender'];
  $age=$row['age'];


  if (isset($_POST['submit'])){

    $name=$_POST['name'];
    $surname=$_POST['surname'];
    $gender=$_POST['gender'];
    $age=$_POST['age'];

    $sql="Update `userdetails` set userid=$id , name='$name' , surname='$surname', gender='$gender', age='$age' where userid=$id";
    $result=mysqli_query($con,$sql);
    if($result){
        //echo "Updated successfully";
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
                   <input type="text" class="form-control" name="name" autocomplete="off" value=<?php echo $name;?>>
               </div>
               <div class="form-group">
                   <label>Surname</label>
                   <input type="text" class="form-control" name="surname" autocomplete="off" value=<?php echo $surname;?> >
               </div>

               <div class = "form-group">
                    <label for="gender">Gender</label>
                    <div>
                        <label for="male" class="radio-inline"><input type="radio" name="gender" value="m" id="male" value=<?php echo $gender;?>>Male</label>
                        <label for="female" class="radio-inline"><input type="radio" name="gender" value="f" id="female" value=<?php echo $gender;?>>Female</label>
                        <label for="others" class="radio-inline"><input type="radio" name="gender" value="o" id="others" value=<?php echo $gender;?>>Others</label>
                    </div>
               </div>

               <div class="form-group">
                   <label>Age</label>
                   <input type="text" class="form-control" name="age" autocomplete="off" value=<?php echo $age;?>>
               </div>

               <button type="submit" class="btn btn-primary" name="submit">Update</button>
            </form>
        </div>
    </body>
 </html>