<?php
session_start();
include '../db_connection.php';

if (!isset($_SESSION['m_name'])) {
    header("Location: ../manager/manager_login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentAp</title>
    <link rel="icon" href="../images/RentAp_logo.png" type="image/x-icon">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../main.css">

    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            .printable,
            .printable * {
                visibility: visible;
            }

            .printable {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
            }

            .no-print {
                display: none !important;
            }
        }

        .filters {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 20px;
        }

        .filters>div {
            flex: 1;
            min-width: 200px;
        }

        .filters label {
            font-weight: bold;
        }

        .print-btn {
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <?php include '../manager_sidebar.php'; ?>

        <div class="main-content container-fluid g-0">
            <div class="title-container">
                <img src="../images/RentAp_full.png" alt="RentAp Icon" class="rentap_Icon">
                <h1>Archive</h1>
            </div>

            <div class="content-container">
                <div class="filters no-print">
                    <div>
                        <label for="unitFilter">Unit:</label>
                        <input type="text" id="unitFilter" class="form-control" placeholder="Enter Unit">
                    </div>

                    <!-- Name Filter -->
                    <div>
                        <label for="nameFilter">Name:</label>
                        <input type="text" id="nameFilter" class="form-control" placeholder="Enter Name">
                    </div>

                    <div>
                        <label for="yearFilter">Year:</label>
                        <input type="number" id="yearFilter" class="form-control" placeholder="Enter Year">
                    </div>

                    <button class="btn btn-secondary" onclick="applyFilter()">Filter</button>
                </div>

                <!-- Print Button -->
                <div class="d-flex justify-content-end my-3">
                    <button onclick="window.print()" class="btn btn-primary">
                        <i class="bi bi-printer"></i> Print List
                    </button>
                </div>

                <div class="card">
                    <div class="card-body printable">
                        <h4 class="card-title mb-4"><strong>Archived Rentees</strong></h4>
                        <div class="table-responsive">
                            <table class="table" id="archiveTable">
                                <thead>
                                    <tr>
                                        <th>Rentee ID</th>
                                        <th>Full Name</th>
                                        <th>Unit</th>
                                        <th>Contact Number</th>
                                        <th>Email</th>
                                        <th>Move-Out Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    }

                                    $sql = "SELECT rentee_id, CONCAT(first_name, ' ', last_name) AS full_name, unit, contact_number, email, move_out_date FROM rentee_archive";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                                    <td>{$row['rentee_id']}</td>
                                                    <td>{$row['full_name']}</td>
                                                    <td>{$row['unit']}</td>
                                                    <td>{$row['contact_number']}</td>
                                                    <td>{$row['email']}</td>
                                                    <td>{$row['move_out_date']}</td>
                                                  </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6' class='text-center'>No records found</td></tr>";
                                    }

                                    $conn->close();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

            <script>
                const hamBurger = document.querySelector(".toggle-btn");
                hamBurger.addEventListener("click", function () {
                    document.querySelector("#sidebar").classList.toggle("expand");
                });

                function applyFilter() {
                    const unit = document.getElementById('unitFilter').value.toLowerCase();
                    const name = document.getElementById('nameFilter').value.toLowerCase();
                    const year = document.getElementById('yearFilter').value;

                    const table = document.getElementById('archiveTable');
                    const rows = table.getElementsByTagName('tr');

                    for (let i = 1; i < rows.length; i++) {
                        const row = rows[i];
                        const unitCell = row.cells[2].textContent.toLowerCase();
                        const nameCell = row.cells[1].textContent.toLowerCase();
                        const dateCell = row.cells[5].textContent;
                        const yearCell = dateCell.split('-')[0];

                        const matchUnit = !unit || unitCell.includes(unit);
                        const matchName = !name || nameCell.includes(name);
                        const matchYear = !year || yearCell === year;

                        row.style.display = (matchUnit && matchName && matchYear) ? '' : 'none';
                    }
                }
            </script>

</body>

</html>