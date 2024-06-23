<?php

require_once("feed_servlet.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback and Mood Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            height: 100vh;
            background-color: #f0f8ff;
            font-family: 'Roboto', sans-serif;
        }

        .container {
            display: flex;
            width: 100%;
        }

        .left, .right {
            width: 48%;
            margin: 1%;
        }

        .scrollable-container {
            width: 100%;
            height: 650px;
            border: 2px solid #ADFFFA;
            padding: 20px;
            overflow-y: auto;
            box-sizing: border-box;
            background-color: #f0f8ff;
            opacity: 90%;
        }

        .scrollable-container h1 {
            color: #333;
        }

        .scrollable-container p, .scrollable-container .advice {
            color: #666;
        }

        .scrollable-container .advice i {
            color: #444;
        }

        .scrollable-container::-webkit-scrollbar {
            width: 12px;
        }

        .scrollable-container::-webkit-scrollbar-thumb {
            background-color: #ADFFFA;
            border-radius: 10px;
            border: 3px solid #f0f8ff;
        }

        .scrollable-container::-webkit-scrollbar-track {
            background: #f0f8ff;
            border-radius: 10px;
        }

        .emoji__face,
.emoji__eyebrows,
.emoji__eyes,
.emoji__mouth,
.emoji__tongue,
.emoji__heart, 
.emoji__hand,
.emoji__thumb {
  position: absolute;
}

.emoji__face:before,
.emoji__face:after,
.emoji__eyebrows:before,
.emoji__eyebrows:after,
.emoji__eyes:before,
.emoji__eyes:after,
.emoji__mouth:before,
.emoji__mouth:after,
.emoji__tongue:before,
.emoji__tongue:after,
.emoji__heart:before,
.emoji__heart:after, 
.emoji__hand:before,
.emoji__hand:after,
.emoji__thumb:before,
.emoji__thumb:after {
  position: absolute;
  content: "";
}
.emoji__face {
	position: absolute;
	width: 120px;
	height: 120px;
   }

/*common css start*/

.emoji {
	width: 120px;
	height: 120px;
	margin: 15px 15px 40px;
	background: #ffda6a;
	display: inline-block;
	border-radius: 50%;
	position: relative;
   }
 
   .emoji:after {
	position: absolute;
	bottom: -40px;
	font-size: 18px;
	width: 60px;
	left: calc(50% - 30px);
	color: #8a8a8a;
   }

   /*emoji-yay css start*/
   .emoji--yay:after {
	content: "Yay";
	animation: yay-reverse 1s linear infinite;
   }
   
   .emoji--yay .emoji__face {
	animation: yay 1s linear infinite alternate;
   }
   
   .emoji--yay .emoji__eyebrows {
	left: calc(50% - 3px);
	top: 30px;
	height: 6px;
	width: 6px;
	border-radius: 50%;
	background: transparent;
	box-shadow: -6px 0 0 0 #000000, -36px 0 0 0px #000000, 6px 0 0 0 #000000,
	  36px 0 0 0px #000000;
   }
   
   .emoji--yay .emoji__eyebrows:before,
   .emoji--yay .emoji__eyebrows:after {
	width: 36px;
	height: 18px;
	border-radius: 60px 60px 0 0;
	background: transparent;
	border: 6px solid black;
	box-sizing: border-box;
	border-bottom: 0;
	bottom: 3px;
	left: calc(50% - 18px);
   }
   
   .emoji--yay .emoji__eyebrows:before {
	margin-left: -21px;
   }
   
   .emoji--yay .emoji__eyebrows:after {
	margin-left: 21px;
   }
   
   .emoji--yay .emoji__mouth {
	top: 60px;
	background: transparent;
	left: 50%;
   }
   
   .emoji--yay .emoji__mouth:after {
	width: 80px;
	height: 80px;
	left: calc(50% - 40px);
	top: -75px;
	border-radius: 50%;
	background: transparent;
	border: 6px solid #000000;
	box-sizing: border-box;
	border-top-color: transparent;
	border-left-color: transparent;
	border-right-color: transparent;
	z-index: 1;
   }
   
   .emoji--yay .emoji__mouth:before {
	width: 6px;
	height: 6px;
	background: transparent;
	border-radius: 50%;
	bottom: 5px;
	left: calc(50% - 3px);
	box-shadow: -25px 0 0 0 #000000, 25px 0 0 0 #000000,
	  -35px -2px 30px 10px #d5234c, 35px -2px 30px 10px #d5234c;
   }

   .custom-video {
    width: 100%;
    background-color: black; /* Fallback color for older browsers */
    margin-top: 50px;
}

/* Style the controls */
.custom-video::-webkit-media-controls {
    display: flex;
    background-color: rgba(0, 0, 0, 0.7);
    color: white;
    font-family: 'Roboto', sans-serif;
}

/* Style individual control buttons */
.custom-video::-webkit-media-controls-play-button {
    color: white;
}

.custom-video::-webkit-media-controls-pause-button {
    color: white;
}

.custom-video::-webkit-media-controls-volume-slider {
    background-color: transparent;
}


    </style>
</head>
<body>
    <div class="container">
        <div class="left">
            <?php
                require_once("feed_servlet.php");
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <title>Feedback Report Page</title>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
                
            </head>
            <body>
                <div class="scrollable-container">
                    <h1>Feedback Report</h1>
                    <p>The following information are advices based on your latest bpm average.<br> 
                    <i>Try them.</i></p>
                    <div class="advice">
                        <i><?php echo nl2br($advice); ?></i>
                    </div>
                </div>
            </body>
            </html>
        </div>

        <div class="right">
        <!DOCTYPE html>
            <html lang="en">
            <head>
                <title>Feedback Report Page</title>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
                
            </head>
            <body>
                <div class="scrollable-container">
                    <h1>Follow Steps Below</h1>
                    <p>The following video will provide steps based on your latest bpm average to help you get through your day.<br> 
                    <video autoplay muted controls class="custom-video">
                        <source src="video/Emotions.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>

                </div>
            </body>
            </html>
        </div>
    </div>
</body>
</html>
