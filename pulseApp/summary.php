<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

// Retrieve user information from session
$username = $_SESSION['username'];
$name = $_SESSION['name'];
$surname = $_SESSION['surname'];
$bpm = $_SESSION['bpm'];
$mood = getMood($bpm);

// Function to determine mood based on BPM
function getMood($bpm) {
    if ($bpm >= 80) {
        return "Happy";
    } elseif ($bpm >= 60 && $bpm < 80) {
        return "Moderate";
    } else {
        return "Sad";
    }

    if (isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Summary</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-2lT5lQpYCl0MJwF+zUyKhDhzoQvVUM2MzmksJ9VZmbM+jy+h8zGdMq3i5TXvMn8DK9po3xr4yvWE61VzvNSdLw==" crossorigin="anonymous" />

    <style>
        body {
            background-color: #000;
            color: #fff;
            font-family: Arial, sans-serif;
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        .container {
            width: 800px;
            margin: 0 auto;
            margin-top: 50px;
            text-align: center;
        }
        .panel {
            background-color: #333;
            color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            animation: slideIn 1s ease-in-out;
        }
        @keyframes slideIn {
            from {
                transform: translateY(-100%);
            }
            to {
                transform: translateY(0);
            }
        }
        iframe {
            width: 100%;
            height: 300px;
            margin-bottom: 20px;
        }
        .pulseapp-text {
            padding: 20px;
            background-color: #444;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .pulseapp-text h2 {
            color: #fff;
            margin-bottom: 10px;
        }
        .pulseapp-text p {
            color: #ccc;
            line-height: 1.5;
        }
        .logout-btn {
            padding: 10px 20px;
            background-color: #555;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            animation: slideIn 1s ease-in-out;
        }
        .logout-btn:hover {
            background-color: #777;
        }
        .footer {
            margin-top: 50px;
            background-color: #333;
        }
        .footer a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
            transition: transform 0.3s ease;
        }
        .footer a:hover {
            transform: scale(1.2);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Summary</h2>
        <div class="panel">
            <h3>User Information</h3>
            <p><strong>Username:</strong> <?php echo $username; ?></p>
            <p><strong>Name:</strong> <?php echo $name; ?></p>
            <p><strong>Surname:</strong> <?php echo $surname; ?></p>
            <p><strong>BPM:</strong> <?php echo $bpm; ?> (<?php echo $mood; ?>)</p>
        </div>
        <div class="panel">
            <h3>Video - BPM</h3>
            <iframe src="/pulseApp/video/ad_Video.mp4" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="panel">
        <h1>The Pulse Watch</h1>
            <div class="pulseapp-text">
                <h2>Welcome to PulseApp</h2>
                <p>PulseApp is your ultimate BPM companion, revolutionizing how you monitor your pulse and immerse yourself in personalized music experiences. With PulseApp, tracking your BPM is as easy as a tap, and our advanced algorithms ensure accurate readings, empowering you to stay in tune with your body's rhythms effortlessly.</p>
                <p>But PulseApp is not just about numbers; it's about enhancing your experience through music. Based on your BPM and mood, PulseApp curates a tailor-made playlist that resonates with your current state. Feeling energetic? Pump up the volume with upbeat tracks. Need to unwind? Let soothing melodies calm your senses. PulseApp adapts to your mood, ensuring that every heartbeat is accompanied by the perfect soundtrack.</p>
                <p>Experience PulseApp today and take control of your pulse and elevate your music experience!</p>
            </div>
        </div>
        <form method="post" action="index.php">
            <input type="submit" name="logout" value="Logout" class="logout-btn">
        </form>
    </div>
    <div >
        <a href="#"><i class="fab fa-whatsapp"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-youtube"></i></a>
    </div>
</body>
</html>
