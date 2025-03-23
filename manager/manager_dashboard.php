<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentAp Dashboard</title>
    <link rel="icon" href="../images/RentAp_logo.png" type="image/x-icon">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../main.css">
</head>
<style>
    .cardBox {
        background-color: transparent !important;
        border-bottom: none !important;
    }
</style>
<body>
    <div class="wrapper">
        <?php include '../manager_sidebar.php'; ?>
        <!-- Main Content -->
        <div class="main-content container-fluid g-0">
            <!-- Title Container -->
            <div class="title-container">
                <img src="../images/RentAp_full.png" alt="RentAp Icon" class="rentap_Icon">
                <h1>Dashboard</h1>
            </div>

            <!-- Content Container -->
            <div class="content-container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                            <h4 class="card-title"><strong>Overview</strong></h4>
                                <div class="row">
                                    <!-- Overview Section -->
                                    <div class="content container mt-4">
                                        <div class="row g-3 cardBox justify-content-between">
                                            <!-- Card 1 -->
                                            <div class="col-md-4 dashboardcard">
                                                <div class="text-center p-3">
                                                    <div>
                                                        <h5 class="card-title numbers" id="occupiedRooms">150</h5>
                                                        <p class="card-text cardName">Occupied Rooms</p>
                                                    </div>
                                                    <div>
                                                        <img src="assets/imgs/studentdbrd.png" alt="" class="img-fluid" style="width: 50px;">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Card 2 -->
                                            <div class="col-md-4 dashboardcard">
                                                <div class="text-center p-3">
                                                    <div>
                                                        <h5 class="card-title numbers" id="maintenanceRooms">10</h5>
                                                        <p class="card-text cardName">Rooms Under Maintenance</p>
                                                    </div>
                                                    <div>
                                                        <img src="assets/imgs/coursedbrd.png" alt="" class="img-fluid" style="width: 50px;">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Card 3 -->
                                            <div class="col-md-4 dashboardcard">
                                                <div class="text-center p-3">
                                                    <div>
                                                        <h5 class="card-title numbers" id="totalStudents"><></h5>
                                                        <p class="card-text cardName">Total Late Payments</p>
                                                    </div>
                                                    <div>
                                                        <img src="assets/imgs/sectiondbrd.png" alt="" class="img-fluid" style="width: 50px;">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Card 4 -->
                                            <div class="col-md-4 dashboardcard">
                                                <div class="text-center p-3">
                                                    <div>
                                                        <?php
                                                            date_default_timezone_set('Asia/Manila');
                                                            $date = new DateTime();
                                                            echo '<h5 class="card-title numbers">' . $date->format('F j, Y') . '</h5>';
                                                        ?>
                                                        <p class="card-text cardName">Date Today</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


            <!-- Incoming Due Dates -->
            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><strong>Incoming Due Dates</strong></h5>
                        <ul class="list-group">
                            <li class="list-group-item">Room 101 - Due on 2025-03-15</li>
                            <li class="list-group-item">Room 205 - Due on 2025-03-20</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Graph Section -->
            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><strong>Peak Rental Periods</strong></h5>
                        <p class="card-text">
                            Based on machine learning analysis, the peak rental periods are typically during the months of May and June.
                        </p>
                        <div id="peakRentalChart" style="height: 300px;"></div>
                    </div>
                </div>
            </div>

            <!-- Late Payments -->
            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><strong>Late Payments</strong></h5>
                        <ul class="list-group">
                            <li class="list-group-item">Room 303 - Overdue by 5 days</li>
                            <li class="list-group-item">Room 402 - Overdue by 3 days</li>
                        </ul>
                    </div>
                </div>
            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        const hamBurger = document.querySelector(".toggle-btn");
        hamBurger.addEventListener("click", function () {
            document.querySelector("#sidebar").classList.toggle("expand");
        });

        // Sample data for peak rental periods chart
        var options = {
            chart: {
                type: 'line',
                height: 300
            },
            series: [{
                name: 'Rental Demand',
                data: [30, 40, 35, 50, 49, 60, 70, 91, 125, 110, 80, 60]
            }],
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            }
        };

        var chart = new ApexCharts(document.querySelector("#peakRentalChart"), options);
        chart.render();
    </script>
</body>

</html>