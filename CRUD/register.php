<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "groupk";

$connection = new mysqli($servername, $username, $password, $database);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$name = "";
$surname = "";
$gender = "";
$age = "";
$passwordValue = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST["username"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $gender = $_POST["gender"];
    $age = $_POST["age"];
    $passwordValue = $_POST["passwordValue"];

    // Validate name and surname (letters only)
    if (!preg_match("/^[a-zA-Z ]*$/", $name) || !preg_match("/^[a-zA-Z ]*$/", $surname)) {
        $errorMessage = "Name and surname should contain only letters and spaces";
    } else {
        // Validate gender (only 'male' or 'female')
        $validGenders = ['male', 'female'];
        if (!in_array(strtolower($gender), $validGenders)) {
            $errorMessage = "Invalid gender. Please enter 'male' or 'female'";
        } else {
            // Validate age (numbers only)
            if (!ctype_digit($age)) {
                $errorMessage = "Age must be a number";
            } else {
                // Check if the username already exists
                $checkUsernameQuery = "SELECT * FROM logindetails WHERE Username = '$username'";
                $result = $connection->query($checkUsernameQuery);

                if ($result->num_rows > 0) {
                    $errorMessage = "Username already exists. Please choose a different username";
                } else {
                    
                    $insertUserQuery = "INSERT INTO userdetails (Name, Surname, Gender, Age)
                    VALUES ('$name', '$surname', '$gender', '$age')";

                    if ($connection->query($insertUserQuery) === TRUE ) {

                        $lastInsertedUserID = $connection->insert_id;

     
                         $insertLoginQuery = "INSERT INTO logindetails (User_ID, Username, Password)
                    VALUES ('$lastInsertedUserID', '$username', '$passwordValue')";

    if ($connection->query($insertLoginQuery) === TRUE) {
        $successMessage = "Successfully registered";;
                    } else {
                        $errorMessage = "Error: " . $connection->error;
                    }
                }
            }
        }
    }}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Register</title>
</head>
<body>
    <div class="container my-5">
        <header>Sign Up</header>
        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
        ?>
            <form method="post">
            <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Username</label>
                    <div class="col-sm-6">
                    <input type="text"  class="form-control" name="username" required value="<?php echo $username; ?>" >
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-6">
                    <input type="text"  class="form-control" name="name" required value="<?php echo $name; ?>" >
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Surname</label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" name="surname" required value="<?php echo $surname; ?>" >
                </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Gender</label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" name="gender" required value="<?php echo $gender; ?>" >
                </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Age</label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" name="age" required value="<?php echo $age; ?>" >
                </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-6">
                    <input type="password" class="form-control" name="passwordValue" required value="<?php echo $passwordValue; ?>" >
                </div>
                </div>
                <?php
                if(!empty($successMessage)){
    echo"
    <div class ='alert-warning alert-dismissible fade show' role ='alert'>
    <strong>$successMessage</strong>
    <button type='button' class='btn-close' data-bs-dissmiss='alert aria-lable='Close'></button>
    </div>"
    ;
}
?>
                <div class="row mb-3">
                   
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
               

            </form>
       
    </div>
</body>
</html>