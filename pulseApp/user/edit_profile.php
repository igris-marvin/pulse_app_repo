<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit User Details</title>
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

        form {
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .logout-link {
            display: block;
            text-align: center;
            color: #666;
            text-decoration: none;
        }

        .logout-link:hover {
            color: #333;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Edit User Details</h1>
    <form action="update_profile.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="John" required>
        
        <label for="surname">Surname:</label>
        <input type="text" id="surname" name="surname" value="Doe" required>
        
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="SampleUsername" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        
        <input type="submit" value="Save Changes">
    </form>
    <a href="user_account.php?" class="logout-link">Cancel</a>
</div>
</body>
</html>
