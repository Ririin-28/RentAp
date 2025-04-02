<?php
session_start();
include '../db_connection.php';

if (!isset($_SESSION['m_name'])) {
    header("Location: ../manager/manager_login.php");
    exit();
}

// Count of Occupied Rooms
$occupiedRoomsQuery = "SELECT COUNT(*) AS occupied_count FROM Unit_Status WHERE status = 'Occupied'";
$occupiedRoomsResult = $conn->query($occupiedRoomsQuery);
$occupiedRooms = $occupiedRoomsResult->fetch_assoc()['occupied_count'];

// Count of Available Rooms
$availableRoomsQuery = "SELECT COUNT(*) AS available_count FROM Unit_Status WHERE status = 'Available'";
$availableRoomsResult = $conn->query($availableRoomsQuery);
$availableRooms = $availableRoomsResult->fetch_assoc()['available_count'];

// Count of Maintenance Requests
$maintenanceRequestsQuery = "SELECT COUNT(*) AS maintenance_count FROM Maintenance_Request WHERE status = 'Pending'";
$maintenanceRequestsResult = $conn->query($maintenanceRequestsQuery);
$maintenanceRequests = $maintenanceRequestsResult->fetch_assoc()['maintenance_count'];

// Count of Overdue Payments
$overduePaymentsQuery = "SELECT COUNT(*) AS overdue_count FROM Payment_History WHERE status = 'Overdue'";
$overduePaymentsResult = $conn->query($overduePaymentsQuery);
$overduePayments = $overduePaymentsResult->fetch_assoc()['overdue_count'];

// Upcoming Due Dates
$upcomingDueDatesQuery = "
    SELECT rentee_id, due_date, DATEDIFF(due_date, CURDATE()) AS days_left
    FROM Pending_Payments
    WHERE status = 'Pending' AND due_date >= CURDATE()
    ORDER BY due_date ASC
";
$upcomingDueDatesResult = $conn->query($upcomingDueDatesQuery);

// Overdue Dates
$overdueDatesQuery = "
    SELECT rentee_id, due_date, DATEDIFF(CURDATE(), due_date) AS days_elapsed
    FROM Pending_Payments
    WHERE status = 'Pending' AND due_date < CURDATE()
    ORDER BY due_date ASC
";
$overdueDatesResult = $conn->query($overdueDatesQuery);

// Peak Rental Periods (Move-in Dates by Month)
$peakRentalQuery = "
    SELECT MONTH(move_in_date) AS month, COUNT(*) AS count
    FROM Agreement_Duration
    WHERE move_in_date IS NOT NULL
    GROUP BY MONTH(move_in_date)
    ORDER BY MONTH(move_in_date)
";
$peakRentalResult = $conn->query($peakRentalQuery);

$peakRentalData = array_fill(1, 12, 0);
while ($row = $peakRentalResult->fetch_assoc()) {
    $peakRentalData[(int)$row['month']] = (int)$row['count'];
}

// Monthly Revenue Based on Payment_History
$monthlyRevenueQuery = "
    SELECT MONTH(date) AS month, SUM(amount) AS total_revenue
    FROM Payment_History
    WHERE status = 'Paid' AND YEAR(date) = YEAR(CURDATE())
    GROUP BY MONTH(date)
    ORDER BY MONTH(date)
";
$monthlyRevenueResult = $conn->query($monthlyRevenueQuery);

$monthlyRevenueData = array_fill(1, 12, 0);
while ($row = $monthlyRevenueResult->fetch_assoc()) {
    $monthlyRevenueData[(int)$row['month']] = (float)$row['total_revenue'];
}

// Yearly Revenue Based on Payment_History
$yearlyRevenueQuery = "
    SELECT YEAR(date) AS year, SUM(amount) AS total_revenue
    FROM Payment_History
    WHERE status = 'Paid'
    GROUP BY YEAR(date)
    ORDER BY YEAR(date)
";
$yearlyRevenueResult = $conn->query($yearlyRevenueQuery);

$yearlyRevenueData = [];
while ($row = $yearlyRevenueResult->fetch_assoc()) {
    $yearlyRevenueData[(int)$row['year']] = (float)$row['total_revenue'];
}

// Payment Status Breakdown
$paymentStatusQuery = "
    SELECT status, COUNT(*) AS count
    FROM (
        SELECT status FROM Payment_History
        UNION ALL
        SELECT status FROM Pending_Payments
    ) AS combined_status
    GROUP BY status
";
$paymentStatusResult = $conn->query($paymentStatusQuery);

$paymentStatusData = [
    'Paid' => 0,
    'Overdue' => 0,
    'Pending' => 0
];
while ($row = $paymentStatusResult->fetch_assoc()) {
    $paymentStatusData[$row['status']] = (int)$row['count'];
}
?>

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
                                            <!-- Card 1: Occupied Rooms -->
                                            <div class="col-md-4 dashboardcard">
                                                <div class="text-center p-3">
                                                    <h5 class="card-title numbers"><?= $occupiedRooms ?></h5>
                                                    <p class="card-text cardName">Occupied Rooms</p>
                                                </div>
                                            </div>

                                            <!-- Card 2: Maintenance Requests -->
                                            <div class="col-md-4 dashboardcard">
                                                <div class="text-center p-3">
                                                    <h5 class="card-title numbers"><?= $maintenanceRequests ?></h5>
                                                    <p class="card-text cardName">Maintenance Requests</p>
                                                </div>
                                            </div>

                                            <!-- Card 3: Overdue Payments -->
                                            <div class="col-md-4 dashboardcard">
                                                <div class="text-center p-3">
                                                    <h5 class="card-title numbers"><?= $overduePayments ?></h5>
                                                    <p class="card-text cardName">Overdue Payments</p>
                                                </div>
                                            </div>

                                            <!-- Card 4: Date Today -->
                                            <div class="col-md-4 dashboardcard">
                                                <div class="text-center p-3">
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

                                <!-- Divider -->
                                <hr class="my-4">

                                <!-- Upcoming Due Dates and Overdue Dates -->
                                <div class="row mt-4">
                                    <!-- Upcoming Due Dates -->
                                    <div class="col-md-6">
                                        <div class="card-body">
                                            <h5 class="card-title mb-4"><strong>Upcoming Due Dates</strong></h5>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Rentee ID</th>
                                                        <th>Due Date</th>
                                                        <th>Days Left</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php while ($row = $upcomingDueDatesResult->fetch_assoc()): ?>
                                                        <tr>
                                                            <td><?= htmlspecialchars($row['rentee_id']) ?></td>
                                                            <td><?= htmlspecialchars($row['due_date']) ?></td>
                                                            <td><?= htmlspecialchars($row['days_left']) ?> days</td>
                                                        </tr>
                                                    <?php endwhile; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Overdue Dates -->
                                    <div class="col-md-6">
                                        <div class="card-body">
                                            <h5 class="card-title mb-4"><strong>Overdue Dates</strong></h5>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Rentee ID</th>
                                                        <th>Due Date</th>
                                                        <th>Days Elapsed</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php while ($row = $overdueDatesResult->fetch_assoc()): ?>
                                                        <tr>
                                                            <td><?= htmlspecialchars($row['rentee_id']) ?></td>
                                                            <td><?= htmlspecialchars($row['due_date']) ?></td>
                                                            <td><?= htmlspecialchars($row['days_elapsed']) ?> days</td>
                                                        </tr>
                                                    <?php endwhile; ?>
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

                                <!-- Unit Occupancy Rate and Payment Status Breakdown -->
                                <div class="row mt-4">
                                    <!-- Unit Occupancy Rate -->
                                    <div class="col-md-6">
                                        <div class="card-body">
                                            <h5 class="card-title mb-4"><strong>Unit Occupancy Rate</strong></h5>
                                            <div id="unitOccupancyChart" style="height: 300px;"></div>
                                        </div>
                                    </div>

                                    <!-- Payment Status Breakdown -->
                                    <div class="col-md-6">
                                        <div class="card-body">
                                            <h5 class="card-title mb-4"><strong>Payment Status Breakdown</strong></h5>
                                            <div id="paymentStatusChart" style="height: 300px;"></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Divider -->
                                <hr class="my-4">

                                <!-- Monthly and Yearly Revenue Chart -->
                                <div class="col-12 mt-4">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4"><strong>Monthly and Yearly Revenue</strong></h5>
                                        <div class="d-flex justify-content-end mb-3">
                                            <select id="revenueViewSelector" class="form-select w-auto">
                                                <option value="monthly" selected>Monthly</option>
                                                <option value="yearly">Yearly</option>
                                            </select>
                                        </div>
                                        <div id="revenueChart" style="height: 300px;"></div>
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

                // Peak Rental Periods Chart
                var peakRentalOptions = {
                    chart: { type: 'line', height: 300 },
                    series: [{
                        name: 'Move-ins',
                        data: <?= json_encode(array_values($peakRentalData)) ?>
                    }],
                    xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                    },
                    yaxis: {
                        min: 0,
                        labels: { formatter: value => value.toFixed(0) }
                    },
                    title: { text: 'Peak Rental Periods', align: 'center' }
                };
                new ApexCharts(document.querySelector("#peakRentalChart"), peakRentalOptions).render();

                // Unit Occupancy Rate Chart
                var unitOccupancyOptions = {
                    chart: { type: 'pie', height: 300 },
                    series: [<?= $occupiedRooms ?>, <?= $availableRooms ?>],
                    labels: ['Occupied', 'Available'],
                    title: { text: 'Unit Occupancy Rate', align: 'center' }
                };
                new ApexCharts(document.querySelector("#unitOccupancyChart"), unitOccupancyOptions).render();

                // Monthly and Yearly Revenue Chart
                const monthlyRevenueData = <?= json_encode(array_values($monthlyRevenueData)) ?>;
                const yearlyRevenueData = <?= json_encode(array_values($yearlyRevenueData)) ?>;
                const yearlyRevenueLabels = <?= json_encode(array_keys($yearlyRevenueData)) ?>;

                let revenueChartOptions = {
                    chart: { type: 'bar', height: 300 },
                    series: [{
                        name: 'Revenue',
                        data: monthlyRevenueData
                    }],
                    xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                    },
                    yaxis: {
                        min: 0,
                        labels: { formatter: value => value.toLocaleString() }
                    },
                    title: { text: 'Monthly Revenue', align: 'center' }
                };
                let revenueChart = new ApexCharts(document.querySelector("#revenueChart"), revenueChartOptions);
                revenueChart.render();

                document.getElementById('revenueViewSelector').addEventListener('change', function (e) {
                    const view = e.target.value;
                    if (view === 'monthly') {
                        revenueChart.updateOptions({
                            series: [{ name: 'Revenue', data: monthlyRevenueData }],
                            xaxis: { categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'] },
                            title: { text: 'Monthly Revenue', align: 'center' }
                        });
                    } else if (view === 'yearly') {
                        revenueChart.updateOptions({
                            series: [{ name: 'Revenue', data: yearlyRevenueData }],
                            xaxis: { categories: yearlyRevenueLabels },
                            title: { text: 'Yearly Revenue', align: 'center' }
                        });
                    }
                });

                var paymentStatusOptions = {
                    chart: { type: 'pie', height: 300 },
                    series: [<?= $paymentStatusData['Paid'] ?>, <?= $paymentStatusData['Overdue'] ?>, <?= $paymentStatusData['Pending'] ?>],
                    labels: ['Paid', 'Overdue', 'Pending'],
                    title: { text: 'Payment Status Breakdown', align: 'center' }
                };
                new ApexCharts(document.querySelector("#paymentStatusChart"), paymentStatusOptions).render();
            </script>
</body>

</html>
