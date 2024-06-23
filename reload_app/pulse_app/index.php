<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            animation: slideIn 1s ease-in-out;
        }
        

        .hero
        {
            width: 100h;
            height: 100vh;
            background-image: url(images/background.png);
            background-size: cover;
            background-position: center;
            position: relative;
            overflow: hidden;
        }
        .navbar
        {
            width: 85%;
            height: 15%;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .btn
        {
            color: #fbfcfd;
            padding: 10px 25px;
            background: transparent;
            border: 1px solid #fff;
            border-radius: 20px;
            text-decoration: none;
            outline: none;
            cursor: pointer;
        }

        .btn:hover
        {
            
            
            color: aquamarine;
        }

        .bubbles img
        {
            width: 50px;
            animation: bubble 7s linear infinite;
           
        }



        .bubbles 
        {
            width: 85%;
            display: flex;
            align-items: center;
            justify-content: space-around;
            position: absolute;
            bottom: -70px;
            opacity: 30%;
        }

        @keyframes bubble
        {
            0%
            {
                transform: translateY(0);
                opacity: 0;
            }

            50%
            {
                
                opacity: 1;
            }

            70%
            {
               
                opacity: 1;
            }

            100%
            {
                transform: translateY(-80vh);
                opacity: 0;
            }
        }

        .bubbles img:nth-child(1)
        {
            animation-delay: 2s;
            width: 25px;
        }

        .bubbles img:nth-child(2)
        {
            animation-delay: 1s;
        }
        .bubbles img:nth-child(3)
        {
            animation-delay: 3s;
            width: 25px;
        }
        .bubbles img:nth-child(4)
        {
            animation-delay: 4.5s;
            
        }
        .bubbles img:nth-child(5)
        {
            animation-delay: 3s;
        }
        .bubbles img:nth-child(6)
        {
            animation-delay: 6s;
            width: 20px;
        }
        .bubbles img:nth-child(7)
        {
            animation-delay: 7s;
            width: 35px;
        }
    </style>
</head>
<body>
    <div class="hero">
        <div class="navbar">
            <a href="signup.php" class="btn">Sign Up</a>

            <div class="bubbles">
            <img src="images/bubble.png">
            <img src="images/bubble.png">
            <img src="images/bubble.png">
            <img src="images/bubble.png">
            <img src="images/bubble.png">
            <img src="images/bubble.png">
            <img src="images/bubble.png">
           
        </div>
        <a href="login.php" class="btn">Login</a>
        </div>

        
    </div>
</body>
</html>