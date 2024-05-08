w<!-- Since the information gathered from this file will be submitted to this file -->
<!-- read the data submitted by this file to this file at the beginning of the document -->

<?php

    //connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "myshop";
        //establish connection to the database
    $connection = new mysqli($servername, $username, $password, $database);

    //initialize field variables
    $name = "";
    $email = "";
    $phone = "";
    $address = "";

    $errorMessage = "";
    $successMessage = "";

    // if the data is transmitted using the POST method, initialize the data
    if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];
    
        // check if there are any empty fields
        do {
            if(empty($name) || empty($email) || empty($phone) || empty($address)) {
                $errorMessage = "All the fields are required";
                break;
            }

            //insert a new client to the database
                //create an sql query
            $sql = "INSERT INTO clients (name, email, phone, address)" . 
                    "VALUES ('$name', '$email', '$phone', '$address')";
                //execute sql query
            $result = $connection->query($sql);

            if (!$result) {
                $errorMessage = "Invalid query: " . $connection->error;
                break;
            }

            //re-initialize the variables
            $name = "";
            $email = "";
            $phone = "";
            $address = "";

            $successMessage = "Client created succesfully";

            header("location: /myshop/index.php");
            exit; //end the execution of this file
        } while (false);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Shop - Create</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" rel="javascript"></script>
    </head>
    <body>
        <div class="container my-5">
            <h2>New Client</h2>

            <?php
                if( !empty($errorMessage) ) {
                    echo "
                        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                            <strong>$errorMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>

                    ";
                }
            ?>

            <form method="POST"> <!-- we do not need the action because we need to submit the parameters to the same page -->
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-6">
                        <input type="text" autocomplete="false" class="form-control" name="name" value="<?php $name; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-6">
                        <input type="text" autocomplete="false" class="form-control" name="email" value="<?php $email; ?>" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Phone</label>
                    <div class="col-sm-6">
                        <input type="text" autocomplete="false" class="form-control" name="phone" value="<?php $namphonee; ?>" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Address</label>
                    <div class="col-sm-6">
                        <input type="text" autocomplete="false" class="form-control" name="address" value="<?php $address; ?>" required>
                    </div>
                </div>

                <?php
                
                    if( !empty($successMessage)) {
                        echo "
                            <div class='row mb-3'>
                                <div class='offset-sm-3 col-sm-6'>
                                    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                        <strong>$successMessage</strong>
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>
                                </div>
                            </div>
                        ";
                    }

                ?>

                <div class="row mb-3">
                    <div class="offset-sm-3 col-sm-3 d-grid">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="col-sm-3 d-grid">
                        <a class="btn btn-outline-primary" href="/myshop/index.php" role="button">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>