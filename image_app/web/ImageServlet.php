<?php

$conn = mysqli_connect('localhost', 'root', '', 'imagedb');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_FILES['image'])){
    // Get the image data
    $image_data = file_get_contents($_FILES['image']['tmp_name']);

    // Prepare the SQL statement
    $sql = "INSERT INTO Image (image_source) VALUES (?)";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $sql);

    // Bind the image data as a parameter
    mysqli_stmt_bind_param($stmt, "s", $image_data);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);

    // Redirect to display.php after inserting the record
    header("Location:/image_app/display.php");
    exit;
}

mysqli_close($conn);

?>