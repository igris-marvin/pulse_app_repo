<?php
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username and password are correct
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username == "admin" && $password == "123") {
        // Redirect to admin_main.php
        header("Location: admin_main.php");
        exit();
    } else {
        // Set error message
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Admin Login Page</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="bilink">
    </head>
    <body>
        <div>
            <h1>Administrator Login</h1>
        </div>
        <div>
            <div>
                <form method="post" action="">
                    <table>
                        <tr>
                            <td>Username: </td>
                            <td><input type="text" name="username" required></td>
                        </tr>
                        <tr>
                            <td>Password: </td>
                            <td><input type="password" name="password" required></td>
                        </tr>

                        <?php if (!empty($error)): ?>
                            <tr>
                                <td colspan="2" align="center"><?php echo $error; ?></td>
                            </tr>
                        <?php endif; ?>

                        <tr>
                            <td colspan="2" align="center"><input type="submit" value="Log In"></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">Not an Administrator? Click <a href="/welcome.php">here</a> to go back</td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </body>
</html>
