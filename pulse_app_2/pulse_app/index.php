<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Home</title>
    
    <style>
        *{
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            animation: slideIn 2s ease-in-out;
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

        .navbar {
    width: 100%;
    height: 10%;
    margin: auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #169384;
    margin-top: 5px;
    opacity: 85%;
    
}

.btn {
    color: #fbfcfd;
    padding: 10px 25px;
    background: transparent;
    border: 1px solid #fff;
    border-radius: 20px;
    text-decoration: none;
    outline: none;
    cursor: pointer;
    transition: color 0.3s;
    position: relative;
}
.btn1
{
    margin-left: 100px;
}

.dropdown {
    position: relative;
}

.dropdown-btn {
    color: #fbfcfd;
    padding: 10px 25px;
    background: transparent;
    border: 1px solid #fff;
    border-radius: 20px;
    text-decoration: none;
    outline: none;
    cursor: pointer;
    margin-right: 100px;
}
.dropdown-content-burger {
    display: none;
    position: absolute;
    background-color: #74A5A0;
    min-width: 160px;
    z-index: 1;
    
}

.dropdown-content-burger a {
    color: white;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    transition: background-color 0.3s ease;
}

.dropdown-content-burger a:hover {
    background-color: #f9f9f9;
    color: black;
}

.dropdown:hover .dropdown-content-burger {
    display: block;
}


.btn:hover {
    color: aqua
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #74A5A0;
    color: #fff;
    padding: 5px 10px;
    border-radius: 5px;
    top: calc(100% + 5px);
    left: 50%;
    transform: translateX(-50%);
}

.dropdown:hover .dropdown-content {
    display: block;
}

.burger-icon {
   cursor: pointer;
}

.contact-info {
    display: none;
    width: 105px;
    height: 20px;
    position: absolute;
    background-color: #74A5A0;
    color: #fff;
    padding: 5px 10px;
    border-radius: 5px;
    top: calc(100% + 5px);
    left: 50%;
    transform: translateX(-50%);
}

.btn:hover .contact-info {
    display: block;
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
        <a href="#" class="btn1 btn">Contact Us<span class="contact-info">081-355-6089</span></a>
        <a href="signup.php" class="btn">Sign Up</a>
        <a href="login.php" class="btn">Login</a>
        <div class="dropdown">
            <button class="dropdown-btn">&#9776;</button>
            <div class="dropdown-content-burger">
                <a href="system.php">Our Journey</a>
                <a href="us.php">About Us</a>
                <a href="admin_login.php">Admin Login</a>
            </div>
        </div>
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
</body>
</html>