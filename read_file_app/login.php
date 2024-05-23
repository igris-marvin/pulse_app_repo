<?php

$file = fopen('C:/Users/Marvin/Desktop/bmp.txt', 'r');
$lines = [];

while (($line = fgets($file)) !== false) {
    echo "$line";

    $lines[] = trim($line);
}

fclose($file);
    
// Get the last 10 records
$last10 = array_slice($lines, -10);
$average = round(array_sum($last10) / count($last10));

echo "------------------";

echo "$readings";

foreach ($last10 as $value) {
    // Code to be executed for each element
    echo "$value" . "\n";
}

echo "------------------";

echo "$average";

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <a href="display.php">Click here</a>
    </body>
</html>