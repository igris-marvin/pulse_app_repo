<?php

require_once("feed_servlet.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Feedback Report Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <style>
        body
        {
            background-color: black;
        }

        p{
            color: white;
            text-align: center;
            font-size: 30px;
        }
        .advice
        {
            margin-top: 100px;
            margin-left: 50px;
            color:white;
            font-size: 30px;
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

    </div>
   

</body>
</html>