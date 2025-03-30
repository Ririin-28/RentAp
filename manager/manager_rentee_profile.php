<?php
session_start();
include '../db_connection.php';

if (!isset($_SESSION['m_name'])) {
    header("Location: ../manager/manager_login.php");
    exit();
}

$query = "SELECT rentee_id, unit, CONCAT(first_name, ' ', last_name) AS full_name, phone_number, email FROM Rentee";
$result = $conn->query($query);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../main.css">

    <style>
        .content-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .card {
            width: 80%;
        }

        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }

        @media print {
            body * {
                visibility: hidden;
            }
            
            .printable, .printable * {
                visibility: visible;
            }
            
            .printable {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
            }
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
                <h1>Rentee Profile</h1>
            </div>

            <!-- Print Button -->
            <div class="d-flex justify-content-end my-3">
                <button onclick="window.print()" class="btn btn-primary">
                    <i class="bi bi-printer"></i> Print List
                </button>
            </div>

            <!-- Content Container -->
            <div class="content-container printable">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4"><strong>Rentees List</strong></h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Rentee ID</th>
                                        <th>Unit Number</th>
                                        <th>Full Name</th>
                                        <th>Contact Number</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($result->num_rows > 0): ?>
                                        <?php while ($row = $result->fetch_assoc()): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($row['rentee_id']); ?></td>
                                                <td><?php echo htmlspecialchars($row['unit']); ?></td>
                                                <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                                                <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
                                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5">No rentees found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const hamBurger = document.querySelector(".toggle-btn");
        if (hamBurger) {
            hamBurger.addEventListener("click", function () {
                document.querySelector("#sidebar").classList.toggle("expand");
            });
        }
    </script>
</body>

</html>
