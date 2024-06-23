<?php

require_once("feed_servlet.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Feedback Report Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="reports.css">
    <style>
        

     

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: white;
            font-size: 60px;
        }
        .advice {
            padding: 20px;
            position: center;
            width: 700px;
            height: 80pc;            
            background: transparent;
            border: 2px solid #0ef;
            outline: none;
            border-radius: 40px;
            cursor: pointer;
            color: #fff;
            font-weight: 600;       
            margin-top: 30px;   
            margin-left: 20px;  
            transition: .5s;
            font-size: 30px;
        }
        
        {
            text-align: center;
            margin-bottom: 30px;
            color: white;
            font-size: 30px;
        }
        
        .scrollable-container {
            width: 100%;
            height: 100%;
            overflow: auto; /* Make this container scrollable */
        }
    </style>
</head>
<body class="scrollable-container">
    <div>
    <h1>Feedback Report</h1>
        <p>The following information are advices based on your latest bpm average.<br> 
                                        <i>Try them.</i></p>
        <div class="advice">
            <i><?php echo nl2br($advice); ?></i>
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
    </div>
   

</body>
</html>