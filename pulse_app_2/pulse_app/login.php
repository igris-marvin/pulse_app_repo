<?php

require_once("loginservlet.php")

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styleLogin.css">
    <link rel="stylesheet" href="styleLog.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        /* Base styles */
        .container99 {
            background-color: black;
            height: 600px;
            padding: 30px;
            border: 2px solid #0ef;
            background: transparent;
        }

        .navbar {          
            margin-bottom: 10%;         
        }

        .btn6 {
            color: #fbfcfd;
            padding: 10px 25px;
            background: transparent;
            border: 1px solid #fff;
            border-radius: 20px;
            text-decoration: none;
            outline: none;
            cursor: pointer;
            transition: color 0.3s;            
            margin-bottom: 100px;
        }

        .btn6:hover {
            color: aqua;           
        }

        .fileEdit {
            margin-top: 20px;
        }

        .btn7 {
            margin-top: 20px;
        }

        /* Responsive styles */
        @media only screen and (max-width: 768px) {
            .container99 {
                height: auto;
            }

            .btn6 {
                margin-bottom: 50px;
            }
        }

        @media only screen and (max-width: 480px) {
            .btn6 {
                margin-bottom: 20px;
            }
        }
        .upload_file
        {
            color: white;
            font-size: 15px;
        }
        .upload_button
        {
            color: red;
            font-size: 15px;
        }
        .back-button
        {
            width: 465px;
        }
    </style>
</head>
<body>

<div class="container99">
    <div class="navbar">
        <a href="index.php" class="btn6">Home</a>            
    </div>
    <div class="form-box sign-up">
        <h2 class="animation">Login</h2>
        <form method="POST" enctype="multipart/form-data">
            <div  class="input-box animation" style="--i:17;">            
                <input type="text" name="username" required>
                <label>Username</label>
            </div>

            <div class="input-box animation" style="--i:18;">
                <input type="password" name="password" required>
                <label>Password</label>
            </div> 

            <!-- <div class="upload" style="--i:19;">
                <div class="fileEdit">
                    <input class="upload_button" type="file" name="bpm_file" accept=".txt" required>
                    <label class="upload_file">Please upload the BPM file</label>
                </div>
            </div>           -->
            <?php if ($errMsg != ""): ?>
                <p style="color: red;"><?php echo $errMsg; ?></p>
            <?php endif; ?>
            
            <input type="submit" name="register" class="btn btn7 animation" style="--i:19;" value="Login">
                
            <div class="form-box login">
                <div class="animation">
                    <p><a href="index.php" class="back-link animation back-button" style="--i:0;">Back</a></p>        
                </div>  
            </div> 
        </form>
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

<script src="script.js"></script>
</body>
</html>
