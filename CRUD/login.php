<!-- start session                  -->
<!-- connect to the database        -->
<!-- check database connection/end  -->
<!-- validate submitted details     -->
    <!-- display appropriate message    -->
    <!-- attach values to session       -->
    <!-- redirect user to the next page -->
    <!-- exit execution of the page     -->

<!-- !!!update page redirection link   -->
<!-- !!!update Sign Up Link            -->

<?php
    session_start();

    // Database connection details
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $database = "logindetails";

    // Initialize details for this page
    $id = "";
    $post_username = "";
    $post_password = "";

    $error_message = "";

    $connection = new mysqli($servername, $db_username, $db_password, $database);

    // Check MySQL connection
    if ($connection->connect_error) {
        // Display SQL connection error message: hard message
        die("Connection failed: " . $connection->connect_error);
    }

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form details
        $id = $_POST["id"];
        $post_username = $_POST["username"];
        $post_password = $_POST["password"];

        // Get record from the database using id from POST
        $sql = "SELECT * FROM login WHERE id = '$id'";
        $result = $connection->query($sql);

        // Check number of records returned
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            // Check record username and password against POST username and password
            if ($row["username"] == $post_username && $row["password"] == $post_password) {
                // Attach values to session
                $_SESSION["user_id"] = $row["id"];
                $_SESSION["username"] = $row["username"];

                // Redirect user
                header("Location: register.php");
                exit(); // Exit execution
            } else {
                // Display error message: soft message
                $error_message = "Incorrect username or password";
            }
        } else {
            // Display error message: soft message
            $error_message = "ID not found";
        }
    }

    // Close the database connection
    $connection->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <script src="" rel="javascript"></script>
        <title>Login Page</title>
    </head>
    <body>
        <div class="container my-5">
            <div class="">
                <h1 class="">Login</h1>
            </div>

            <div class="">
                <form method="POST">
                    <table class="table">
                        <tr>
                            <td>User ID </td>
                            <td>
                                <input type="number" start="1000" name="id" autocomplete="false" value="" required />
                            </td>
                        </tr>
                        <tr>
                            <td>Username </td>
                            <td>
                                <input type="text" name="username" autocomplete="false" value="" required />
                            </td>
                        </tr>
                        <tr>
                            <td>Password </td>
                            <td>
                                <input type="password" name="password" autocomplete="false" value="" required />
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="2">
                                <input class="btn btn-primary" type="submit" value="Login" />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>

            <?php
                
                if(!empty($error_message)) {
                    echo "
                        <div class=''>
                            <h4>$error_message</h4>
                        </div>
                    ";
                }
            ?>
            <div class="">
                <p class="text-center">Not a member? <a class="link-underline-opacity-50" href="register.php">Sign Up</a></p>
            </div>
        </div>
    </body>
</html>