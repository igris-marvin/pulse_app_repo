<?php

$memberId = '2'; // Replace with the actual member ID, e.g., from session or request

require_once("connect.php");
// require_once("trigger.php");
// Define the file path
$file_path = 'C:\Users\Marvin\Desktop\bpm\bpm.txt';

// Check if the file exists
if (file_exists($file_path)) {
    // Read the entire file into a string
    $file_content = file_get_contents($file_path);

    $array = explode("\n", $file_content);

    foreach($array as &$pulse_rate) {
        $bpm = (int) $pulse_rate;

        saveBpm($bpm, $memberId, $conn);
    }

    
} else {
    echo "The file does not exist.";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>
        Hey There!


    </h1>
</body>
</html>