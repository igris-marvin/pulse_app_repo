<?php

require('C:/xampp/htdocs/pulse_app/tfpdf/tfpdf.php');
require_once("average_persistence.php");
require_once("connect.php");

$user_id = null;

if(isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
} else {
    header("Location: login.php");
    exit();
}

$avg_bpms = getBpms($user_id, $conn);
$moods = getMoods($user_id, $conn);
$timestamps = getTimes($user_id, $conn);

$number = 0;

$times = [];
$dates = [];

for($i = 0; $i < count($timestamps); $i++) {

    $dates[] = ( new DateTime($timestamps[$i]) )->format('d M y');
    $times[] = ( new DateTime($timestamps[$i]) )->format('H:i:s');

}


$string = "Average Report\n\n
            #\t\tAverage BPM\t\tMood\t\tDate\t\tTime\n\n
            ";

for($x = 0; $x < count($avg_bpms); $x++) {
    $number++;

    $number;
    $avg_bpms[$x];
    $moods[$x];
    $dates[$x];
    $times[$x];

    $string = $string . "$number\t\t$avg_bpms[$x]\t\t$moods[$x]\t\t$dates[$x]\t\t$times[$x]";
}

$string = replace_tabs_with_spaces($string);

// Create instance of tFPDF
$pdf = new tFPDF();
$pdf->AddPage();
$pdf->AddFont('DejaVu', '', 'DejaVuSans.ttf', true);
$pdf->SetFont('DejaVu', '', 16);
$pdf->MultiCell(0, 10, $string);

// Output the PDF as a download
$pdf->Output('D', 'download.pdf');
exit;

function replace_tabs_with_spaces($text, $spaces_per_tab = 4) {
    $spaces = str_repeat(' ', $spaces_per_tab);
    return str_replace("\t", $spaces, $text);
}

?>