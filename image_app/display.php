<?php
$conn = mysqli_connect('localhost', 'root', '', 'imagedb');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT image_source FROM Image WHERE id=1";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $image_data = $row['image_source'];
    
    // Set the appropriate content type header
    header("Content-type: image/jpeg"); // Assuming the image type is JPEG
    
    // Output the image data
    echo $image_data;
} else {
    echo "Error: Image not found.";
}

mysqli_close($conn);
?>
