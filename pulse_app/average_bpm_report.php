<?php
require_once("average_servlet.php"); // File to handle database connection
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <!-- <style>
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #333; /* Dark-grey */
            overflow-x: hidden;
            padding-top: 20px;
        }
        .topbar {
            height: 60px;
            width: 100%;
            position: fixed;
            z-index: 1;
            top: 0;
            background-color: #666; /* Grey */
        }
        .content {
            margin-left: 250px; /* Same as the width of the sidebar */
            margin-top: 60px; /* Same as the height of the topbar */
            padding: 20px;
        }
        html, body {
            height: 100%;
            margin: 0;
        }
        .container-fluid {
            height: 100%;
        }
        </style> -->
    </head>
    <body>

        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid" >
                <?php
                    echo "
                            <a class='navbar-brand fs-2' href='average_bpm_report.php?user_id=$user_id'>Average BPM Report</a>
                        "
                ?>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div style="margin-left: 800px;" class="collapse navbar-collapse fs-4" id="navbarNav">
                <ul class="navbar-nav">
                  <li  style="margin-right: 40px;" class="nav-item">
                    <a>
                        <?php
                            echo "
                                <a href='user_account.php?user_id=$user_id'>
                                    <i class='nav-link bi bi-download'></i>
                                </a>
                            "
                        ?>
                    </a>
                  </li>
                  <li  style="margin-right: 40px;" class="nav-item">
                    <a>
                        <?php
                            echo "
                                <a href='user_account.php?user_id=$user_id'>
                                    <i class='nav-link bi bi-person-circle'></i>
                                </a>
                            "
                        ?>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a>
                        <?php
                            echo "
                                    <a href='welcome.php?user_id=$user_id'>
                                        <i class='nav-link bi bi-box-arrow-left'></i>
                                    </a>
                                "
                        ?>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
        </nav>

        <div class="container">

        <?php

            if(count($avg_bpms) < 1) {

                echo "
                <center>
                    <div class='container'>
                            <h1 class='fs-1'>No Data Found</h1>
                    </div>
                </center>
                ";
            } else {
            
            echo "
            <table class='table caption-top table-striped'>
                <thead>
                  <tr>
                    <th scope='col'>#</th>
                    <th scope='col'>Average BPM</th>
                    <th scope='col'>Mood</th>
                    <th scope='col'>Date</th>
                    <th scope='col'>Time</th>
                  </tr>
                </thead>
                <tbody>
                     
                        ";
                    
                        for($x = 0; $x < count($avg_bpms); $x++) {
                            $number++;

                            echo "
                                <tr>
                                    <th scope='row'>$number</th>
                                    <td>$avg_bpms[$x]</td>
                                    <td>$moods[$x]</td>
                                    <td>$dates[$x]</td>
                                    <td>$times[$x]</td>
                                </tr>
                                ";
                        }
                    echo "
                </tbody>
              </table>
                    ";
                    }
              ?>
        </div>

        <!-- Bootstrap Bundle with Popper -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    </body>
</html>