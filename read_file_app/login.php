<?php

//$file = fopen('C:/Users/Marvin/Desktop/bmp.txt', 'r');

if(isset($_POST['submit'])) {

    if(isset($_FILES['bpm_file'])) {

        echo "huhhugg";

        $file_tmp = $_FILES['bpm_file']['tmp_name'];
        $file_name = $_FILES['bpm_file']['name'];

        $file_content = file_get_contents($file_tmp);

        echo "$file_tmp";
        echo "$file_name";
        echo "$file_content";

        $array = explode(" ",$file_content);
    }
}


// $lines = [];

// while (($line = fgets($file)) !== false) {
//     echo "$line";

//     $lines[] = trim($line);
// }

// fclose($file);
    
// // Get the last 10 records
// $last10 = array_slice($lines, -10);
// $average = round(array_sum($last10) / count($last10));

// echo "------------------";

// echo "$readings";

// foreach ($last10 as $value) {
//     // Code to be executed for each element
//     echo "$value" . "\n";
// }

// echo "------------------";

// echo "$average";

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

        <form method="POST" enctype="multipart/form-data">
            <tr>
                <td>Upload Pulse Rate file: </td>
                <td><input type="file" name="bpm_file" accept=".txt" required></td>
            </tr>
            <tr>
                <td><input type="submit" value="READ" name="submit"></td>
            </tr>
        </form>
    </body>
</html>