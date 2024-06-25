<?php

// Include the TCPDF library
require_once('C:/xampp/htdocs/atest_pdf/tcpdf/tcpdf.php');
require_once("connect.php");
require_once("average_download_repository.php");
require_once("average_bpm_class.php");

$user_id = 9;

// Create a new PDF document
// Set title and data
// <?php
//============================================================+
// File name   : example_011.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 011 for TCPDF class
//               Colored Table (very simple table)
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Colored Table
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
// require_once('tcpdf_include.php');

// extend TCPF with custom functions


$data = getAverageData($user_id, $conn);

print_r($data);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="download.php">Download</a>
</body>
</html>