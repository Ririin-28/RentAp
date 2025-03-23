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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../main.css">

    <!-- Print-specific CSS -->
    <style>
        /* Print Styling */
        @media print {
            body {
                font-family: Arial, sans-serif;
                line-height: 1.5;
                color: #000;
                margin: 0;
                padding: 0;
            }
            body * {
                visibility: hidden;
            }

            #archiveTable, #archiveTable * {
                visibility: visible;
            }

            /* Print layout */
            #archiveTable {
                position: absolute;
                top: 50px;
                left: 50%;
                transform: translateX(-50%);
                width: 90%;
                max-width: 1200px;
                border-collapse: collapse;
                font-size: 14px;
                color: #000;
            }

            /* Table styling */
            .table th, .table td {
                border: 1px solid #000 !important;
                padding: 10px;
                text-align: left;
                vertical-align: middle;
            }

            .table th {
                background-color: #f0f0f0;
                color: #000;
                font-weight: bold;
                text-transform: uppercase;
            }

            /* Footer */
            .print-footer {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                text-align: center;
                font-size: 12px;
                color: #555;
                padding: 10px 0;
                border-top: 1px solid #000;
            }

            /* Page Breaks */
            tr {
                page-break-inside: avoid;
            }

            /* Remove the print button */
            .print-btn {
                display: none;
            }
        }

        /* Full-width filters */
        .filters {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 20px;
        }

        .filters > div {
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

        <!-- Main Content -->
        <div class="main-content container-fluid g-0">

            <!-- Title Container -->
            <div class="title-container">
                <img src="../images/RentAp_full.png" alt="RentAp Icon" class="rentap_Icon">
                <h1>Archive</h1>
            </div>

            <!-- Filters -->
            <div class="content-container">
                <div class="filters no-print">
                    <div>
                        <label for="unitFilter">Unit:</label>
                        <input type="text" id="unitFilter" class="form-control" placeholder="Enter Unit">
                    </div>

                    <div>
                        <label for="dateFilter">Date:</label>
                        <input type="date" id="dateFilter" class="form-control">
                    </div>

                    <div>
                        <label for="yearFilter">Year:</label>
                        <input type="number" id="yearFilter" class="form-control" placeholder="Enter Year">
                    </div>

                    <button class="btn btn-secondary" onclick="applyFilter()">Filter</button>
                </div>

                <!-- Print Button -->
                <div class="row">
                    <div class="col-12">
                        <button class="btn btn-primary print-btn no-print" onclick="window.print()">
                            <i class="bi bi-printer"></i> Print Archive
                        </button>

                        <!-- Table -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><strong>Archived Rentees</strong></h4>
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
                                            <tr>
                                                <td>1</td>
                                                <td>John Doe</td>
                                                <td>A101</td>
                                                <td>09123456789</td>
                                                <td>john.doe@example.com</td>
                                                <td>2025-03-01</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Jane Smith</td>
                                                <td>B202</td>
                                                <td>09876543210</td>
                                                <td>jane.smith@example.com</td>
                                                <td>2025-02-15</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Alice Johnson</td>
                                                <td>A101</td>
                                                <td>09112233445</td>
                                                <td>alice.johnson@example.com</td>
                                                <td>2025-01-30</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Bob Brown</td>
                                                <td>C303</td>
                                                <td>09223344556</td>
                                                <td>bob.brown@example.com</td>
                                                <td>2025-01-10</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Carol White</td>
                                                <td>D404</td>
                                                <td>09334455667</td>
                                                <td>carol.white@example.com</td>
                                                <td>2024-12-20</td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>Dave Green</td>
                                                <td>A101</td>
                                                <td>09445566778</td>
                                                <td>dave.green@example.com</td>
                                                <td>2024-11-25</td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td>Eve Black</td>
                                                <td>B202</td>
                                                <td>09556677889</td>
                                                <td>eve.black@example.com</td>
                                                <td>2024-10-15</td>
                                            </tr>
                                            <tr>
                                                <td>8</td>
                                                <td>Frank Blue</td>
                                                <td>C303</td>
                                                <td>09667788990</td>
                                                <td>frank.blue@example.com</td>
                                                <td>2024-09-05</td>
                                            </tr>
                                            <tr>
                                                <td>9</td>
                                                <td>Grace Pink</td>
                                                <td>D404</td>
                                                <td>09778899001</td>
                                                <td>grace.pink@example.com</td>
                                                <td>2024-08-20</td>
                                            </tr>
                                            <tr>
                                                <td>10</td>
                                                <td>Henry Yellow</td>
                                                <td>A101</td>
                                                <td>09889900112</td>
                                                <td>henry.yellow@example.com</td>
                                                <td>2024-07-10</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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
            const date = document.getElementById('dateFilter').value;
            const year = document.getElementById('yearFilter').value;

            const table = document.getElementById('archiveTable');
            const rows = table.getElementsByTagName('tr');

            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                const unitCell = row.cells[2].textContent.toLowerCase();
                const dateCell = row.cells[5].textContent;
                const yearCell = dateCell.split('-')[0];

                const matchUnit = !unit || unitCell.includes(unit);
                const matchDate = !date || dateCell === date;
                const matchYear = !year || yearCell === year;

                row.style.display = (matchUnit && matchDate && matchYear) ? '' : 'none';
            }
        }
    </script>

</body>
</html>
