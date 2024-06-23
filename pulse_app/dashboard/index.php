<?php

require_once("dashboard_servlet.php");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Client History</title>

    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  </head>
  <body>
    <div class="grid-container">

      <!-- Header -->
      <header class="header">
        <div class="menu-icon" onclick="openSidebar()">
          <span class="material-icons-outlined">menu</span>
        </div>
       
        <div class="header-right">          
          <span class="material-icons-outlined">account_circle</span>
        </div>
      </header>
      <!-- End Header -->

      <!-- Sidebar -->
      <aside id="sidebar">
        <div class="sidebar-title">
          <div class="sidebar-brand">
            <span class="material-icons-outlined">inventory</span> Users Summary
          </div>
          <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
        </div>

        <ul class="sidebar-list">
          <li class="sidebar-list-item">
            <?php

            echo "<a href='/pulse_app/welcome.php?user_id=$user_id'>
              <span class='material-icons-outlined'>dashboard</span> Media
            </a>"

            ?>
          </li>
          <li class="sidebar-list-item">
            <a href="/pulse_app/index.php">
              <span class="material-icons-outlined">inventory_2</span> Logout
            </a>
          </li>
         
        </ul>
      </aside>
      <!-- End Sidebar -->

      <!-- Main -->
      <main class="main-container">
        <div class="main-title">
          <p class="font-weight-bold">DASHBOARD</p>
        </div>

        <?php
require_once("connect.php"); // File to handle database connection

$user_id = null;

if(isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
 
} else {
    // Handle the case where 'id' parameter is not set
    echo "User ID is not provided in the URL.";
 
    header("location: login.php");
}

// Fetch data from the database
function getPulseData($conn, $limit) {
    $data = [];

    $sql = "SELECT pulse_rate, timestamp 
            FROM pulse_data p, emotion_regulator_app e
            WHERE p.device_id = e.pulse_device_id 
            LIMIT $limit";
            

    $result = $conn->query($sql);

    if ($result === false) {
        // Output error message and terminate script
        die("Error executing query: " . $conn->error);
    }

    while ($row = $result->fetch_assoc()) {
        $pulse_rate = $row['pulse_rate'];
        $mood = "";

        if ($pulse_rate >= 80) {
            $mood = "Happy";
        } elseif ($pulse_rate >= 60 && $pulse_rate < 80) {
            $mood = "Moderate";
        } else {
            $mood = "Sad";
        }

        $data[] = [
            'timestamp' => $row['timestamp'],
            'pulse_rate' => $pulse_rate,
            'mood' => $mood
        ];
    }

    return $data;
}

// Determine the number of records to display
$limit = 10; // Default limit
if (isset($_GET['limit']) && in_array($_GET['limit'], [10, 20, 30])) {
    $limit = (int)$_GET['limit'];
}

$pulseData = getPulseData($conn, $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pulse Data Call Log</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f8ff;
            color: #333;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0;
            margin:0;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .filter-form {
            margin-bottom: 20px;
        }
        .filter-form select {
            padding: 10px;
            font-size: 16px;
        }
        .charts-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            width: 100%;
            max-width: 1200px;
        }
        .chart-container {
            width: 45%;
            max-width: 500px;
            margin: 20px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    
        .back-button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        margin-top: 20px;
    }

    .back-button:hover {
        background-color: #0056b3;
    }
    .download-button
    {
      display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        margin-top: 20px;
    }
    .download-button:hover
    {
      background-color: #0056b3;
    }

    .back-button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        margin-top: 20px;
    }

    .back-button:hover {
        background-color: #0056b3;
    }
    .download-button
    {
      display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        margin-top: 20px;
    }
    .download-button:hover
    {
      background-color: #0056b3;
    }
    </style>
</head>
<body>
    <h1>Pulse Data </h1>
    <form class="filter-form" method="get" action="">
        <label for="limit">Show records:</label>
        <select name="limit" id="limit" onchange="this.form.submit()">
            <option value="10" <?php if ($limit == 10) echo 'selected'; ?>>10</option>
            <option value="20" <?php if ($limit == 20) echo 'selected'; ?>>20</option>
            <option value="30" <?php if ($limit == 30) echo 'selected'; ?>>30</option>

        </select>
        <?php
         echo "<input type = 'hidden' name = 'user_id' value = '$user_id'>";
        ?>
    </form>

    <div class="charts-container">
        <div class="chart-container">
            <canvas id="pulseRateChart"></canvas>
        </div>
        <div class="chart-container">
            <canvas id="moodChart"></canvas>
        </div>
    </div>

    <button class="download-button" onclick="downloadCharts()">Download Charts</button>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script>
        function downloadCharts() {
            const pulseCanvas = document.getElementById('pulseRateChart');
            const moodCanvas = document.getElementById('moodChart');

            // Create a new jsPDF instance
            const pdf = new jsPDF();

            // Function to generate PDF from canvas
            function generatePDF(canvas, title) {
                html2canvas(canvas)
                    .then((canvas) => {
                        const imgData = canvas.toDataURL('image/png');
                        pdf.addPage();
                        pdf.text(title, 10, 10);
                        pdf.addImage(imgData, 'PNG', 10, 20);
                    })
                    .then(() => {
                        if (canvas === moodCanvas) {
                            pdf.save('charts.pdf');
                        }
                    });
            }

            // Generate PDF for each canvas
            generatePDF(pulseCanvas, 'Pulse Rate Chart');
            generatePDF(moodCanvas, 'Mood Chart');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const pulseData = <?php echo json_encode($pulseData); ?>;

            // Prepare data for pulse rate chart
            const timestamps = pulseData.map(entry => entry.timestamp);
            const pulseRates = pulseData.map(entry => entry.pulse_rate);

            // Create pulse rate chart
            const ctxPulse = document.getElementById('pulseRateChart').getContext('2d');
            new Chart(ctxPulse, {
                type: 'line',
                data: {
                    labels: timestamps,
                    datasets: [{
                        label: 'Pulse Rate',
                        data: pulseRates,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: true,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Timestamp'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Pulse Rate'
                            }
                        }
                    }
                }
            });

            // Prepare data for mood chart
            const moodCounts = { 'Happy': 0, 'Moderate': 0, 'Sad': 0 };
            pulseData.forEach(entry => {
                moodCounts[entry.mood]++;
            });

            // Create mood chart
            const ctxMood = document.getElementById('moodChart').getContext('2d');
            new Chart(ctxMood, {
                type: 'pie',
                data: {
                    labels: ['Happy', 'Moderate', 'Sad'],
                    datasets: [{
                        data: [moodCounts.Happy, moodCounts.Moderate, moodCounts.Sad],
                        backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(192, 192, 75, 0.2)', 'rgba(192, 75, 75, 0.2)'],
                        borderColor: ['rgba(75, 192, 192, 1)', 'rgba(192, 192, 75, 1)', 'rgba(192, 75, 75, 1)'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    }
                }
            });
        });
    </script>
    <?php
  echo "<a href='\pulse_app\welcome.php?user_id=$user_id' class='back-button'>Back</a>";
?>
</body>
</html>

    
