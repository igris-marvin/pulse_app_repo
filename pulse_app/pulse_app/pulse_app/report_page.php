<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Report Pages</title>
    </head>
    <body>
       
    </body>
</html>

<?php

require_once("edit_profileservlet.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profileStyle.css">
    <title>Edit Profile</title>
    <style>
        .nodeco {
            text-decoration: none;
        }
        .text78
        {
            padding-top: 30px;
            padding-left: 10px;
            padding-right: 10px;
            text-align: center;
            text-decoration: none;
        }
        .text77
        {
            color: aliceblue;
            text-decoration: none;
        }

    </style>
</head>
<body>
 <div class="panel1 panelA">
    <h1 class="heading1">Report Pages</h1>
    <form method="POST" enctype="">
        <div class="form-box sign-up ">

        <div  class="input-box animation btn text78" style="--i:17;"> 
        
            <a class="text77" href="EmotionDetectionReport.php">Emotion Detection Report</a>
        </div>

        <div  class="input-box animation btn text78" style="--i:17;"> 
            <a class="text77" href="HeartRateTrendsReport.php">Heart Rate Trends Report</a>
        </div>

        <div  class="input-box animation btn text78" style="--i:17;"> 
            <a class="text77" href="music_report.php">Music Report</a>
        </div>
        
        <div  class="input-box animation btn text78" style="--i:17;"> 
            <a class="text77" href="welcome.php">Back</a>
        </div>  
        
    </form>
    <br/>

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
