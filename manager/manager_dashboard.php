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
                                <h4 class="card-title mb-4"><strong>Overview</strong></h4>
                                <div class="row">
                                    <!-- Overview Section -->
                                    <div class="content container mt-4">
                                        <div class="row g-3 cardBox justify-content-between">
                                            <!-- Card 1 -->
                                            <div class="col-md-4 dashboardcard">
                                                <div class="text-center p-3">
                                                    <div>
                                                        <h5 class="card-title numbers" id="occupiedRooms">10</h5>
                                                        <p class="card-text cardName">Occupied Rooms</p>
                                                    </div>
                                                    <div>
                                                        <img src="assets/imgs/studentdbrd.png" alt="" class="img-fluid"
                                                            style="width: 50px;">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Card 2 -->
                                            <div class="col-md-4 dashboardcard">
                                                <div class="text-center p-3">
                                                    <div>
                                                        <h5 class="card-title numbers" id="maintenanceRooms">4</h5>
                                                        <p class="card-text cardName">Maintenance Requests</p>
                                                    </div>
                                                    <div>
                                                        <img src="assets/imgs/coursedbrd.png" alt="" class="img-fluid"
                                                            style="width: 50px;">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Card 3 -->
                                            <div class="col-md-4 dashboardcard">
                                                <div class="text-center p-3">
                                                    <div>
                                                        <h5 class="card-title numbers" id="totalStudents">1</h5>
                                                        <p class="card-text cardName">Overdue Date</p>
                                                    </div>
                                                    <div>
                                                        <img src="assets/imgs/sectiondbrd.png" alt="" class="img-fluid"
                                                            style="width: 50px;">
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

                                <!-- Divider -->
                                <hr class="my-4">

                                <!-- Upcoming Due Dates and Overdue Date -->
                                <div class="row mt-4">
                                    <!-- Upcoming Due Dates -->
                                    <div class="col-md-6">
                                        <div class="card-body">
                                            <h5 class="card-title mb-4"><strong>Upcoming Due Dates</strong></h5>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Unit</th>
                                                        <th>Due Date</th>
                                                        <th>Days Left</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>G-1</td>
                                                        <td>2025-03-15</td>
                                                        <td>5 days</td>
                                                    </tr>
                                                    <tr>
                                                        <td>F-2</td>
                                                        <td>2025-03-20</td>
                                                        <td>1 day</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Late Payments -->
                                    <div class="col-md-6">
                                        <div class="card-body">
                                            <h5 class="card-title mb-4"><strong>Overdue Date</strong></h5>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Unit</th>
                                                        <th>Due Date</th>
                                                        <th>Days Elapsed</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>G-4</td>
                                                        <td>2025-03-10</td>
                                                        <td>5 days</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Divider -->
                                <hr class="my-4">

                                <!-- Graph Section -->
                                <div class="col-12 mt-4">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4"><strong>Peak Rental Periods</strong></h5>
                                        <div id="peakRentalChart" style="height: 300px;"></div>
                                    </div>
                                </div>

                                <!-- Divider -->
                                <hr class="my-4">

                                <!-- Unit Occupancy Rate and Payment Status Distribution in One Row -->
                                <div class="row mt-4">
                                    <!-- Unit Occupancy Rate Chart -->
                                    <div class="col-md-6">
                                        <div class="card-body">
                                            <h5 class="card-title mb-4"><strong>Unit Occupancy Rate</strong></h5>
                                            <div id="unitOccupancyChart" style="height: 300px;"></div>
                                        </div>
                                    </div>

                                    <!-- Monthly Revenue Chart -->
                                    <div class="col-md-6">
                                        <div class="card-body">
                                            <h5 class="card-title mb-4"><strong>Monthly Revenue</strong></h5>
                                            <div id="monthlyRevenueChart" style="height: 300px;"></div>
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
                var peakRentalOptions = {
                    chart: {
                        type: 'line',
                        height: 300
                    },
                    series: [{
                        name: 'Rental Demand',
                        data: [3, 4, 3, 5, 4, 6, 7, 9, 12, 11, 8, 6]
                    }],
                    xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                    },
                    yaxis: {
                        min: 0,
                        max: 12,
                        tickAmount: 6, // Limit to 6 grid lines
                        labels: {
                            formatter: function (value) {
                                return value.toFixed(0); // Ensure whole numbers
                            }
                        }
                    },
                    title: {
                        text: 'Peak Rental Periods',
                        align: 'center'
                    }
                };

                var peakRentalChart = new ApexCharts(document.querySelector("#peakRentalChart"), peakRentalOptions);
                peakRentalChart.render();

                // Sample data for unit occupancy rate chart
                var unitOccupancyOptions = {
                    chart: {
                        type: 'pie',
                        height: 300
                    },
                    series: [2, 10],
                    labels: ['Available', 'Occupied']
                };

                var unitOccupancyChart = new ApexCharts(document.querySelector("#unitOccupancyChart"), unitOccupancyOptions);
                unitOccupancyChart.render();

                // Monthly Revenue Chart
                var monthlyRevenueOptions = {
                    chart: {
                        type: 'bar',
                        height: 300
                    },
                    series: [{
                        name: 'Revenue',
                        data: [48000, 36000, 60000, 60000, 72000, 72000, 72000, 84000, 120000, 96000, 96000, 120000]
                    }],
                    xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                    },
                    yaxis: {
                        min: 0,
                        max: 144000, // Set the maximum value to 144,000
                        tickAmount: 6, // Limit to 6 grid lines
                        labels: {
                            formatter: function (value) {
                                return value.toLocaleString(); // Format numbers with commas
                            }
                        }
                    },
                    title: {
                        text: 'Monthly Revenue',
                        align: 'center'
                    }
                };

                var monthlyRevenueChart = new ApexCharts(document.querySelector("#monthlyRevenueChart"), monthlyRevenueOptions);
                monthlyRevenueChart.render();
            </script>
</body>

</html>