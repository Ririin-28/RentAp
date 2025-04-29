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
    <title>Maintenance Requests</title>
    <link rel="icon" href="../images/RentAp_logo.png" type="image/x-icon">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../main.css">
</head>

<body>
    <div class="wrapper">
        <?php include '../manager_sidebar.php'; ?>

        <!-- Main Content -->
        <div class="main-content container-fluid g-0">

            <!-- Title Container -->
            <div class="title-container">
                <img src="../images/RentAp_full.png" alt="RentAp Icon" class="rentap_Icon">
                <h1>Maintenance Requests</h1>
            </div>

            <!-- Content Container -->
            <div class="content-container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4"><strong>Requests List</strong></h4>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Unit #</th>
                                                    <th>Rentee</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                include '../db_connection.php';

                                                $query = "SELECT mr.request_id, mr.unit, CONCAT(r.first_name, ' ', r.last_name) AS rentee_name,
                                                                 DATE_FORMAT(mr.date, '%b %e') AS formatted_date,
                                                                 mr.category, mr.issue, mr.description, mr.status
                                                          FROM maintenance_request mr
                                                          JOIN rentee r ON mr.rentee_id = r.rentee_id";
                                                $result = $conn->query($query);

                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        $statusBadgeClass = $row['status'] === 'Pending' ? 'bg-warning' : 'bg-success';
                                                        $actionButton = $row['status'] === 'Pending'
                                                            ? "<button class='btn btn-primary btn-sm view-button'
                                                                 onclick=\"openDetailsModal(event, '{$row['unit']}', '{$row['category']}', '{$row['issue']}', '{$row['description']}', '{$row['status']}')\">View</button>"
                                                            : "<button class='btn btn-secondary btn-sm' disabled><i class='bi bi-check-circle'></i> Done</button>";

                                                        echo "<tr>
                                                                <td>{$row['unit']}</td>
                                                                <td>{$row['rentee_name']}</td>
                                                                <td>{$row['formatted_date']}</td>
                                                                <td><span class='badge $statusBadgeClass'>{$row['status']}</span></td>
                                                                <td>$actionButton</td>
                                                              </tr>";
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='5' class='text-center'>No maintenance requests found.</td></tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- Total Requests -->
                                <div class="card-footer">
                                    <span class="total-requests">Total Requests: <strong><?= $result->num_rows ?></strong></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Request Details Modal -->
    <div class="modal fade" id="detailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Request Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Unit #:</strong> <span id="modalUnit"></span></p>
                    <p><strong>Category:</strong> <span id="modalCategory"></span></p>
                    <p><strong>Issue:</strong> <span id="modalIssue"></span></p>
                    <p><strong>Description:</strong> <span id="modalDescription"></span></p>
                    <p><strong>Status:</strong> <span id="modalStatus" class="badge"></span></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-success" onclick="confirmCompletion()">Mark as Done</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Completion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to mark this request as done?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-success" onclick="markAsDone()">Yes, Done</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const hamBurger = document.querySelector(".toggle-btn");
        hamBurger.addEventListener("click", function () {
            document.querySelector("#sidebar").classList.toggle("expand");
        });

        let currentRow;

        function openDetailsModal(event, unit, category, issue, description, status) {
            currentRow = event.target.closest('tr');

            document.getElementById('modalUnit').textContent = unit;
            document.getElementById('modalCategory').textContent = category;
            document.getElementById('modalIssue').textContent = issue;
            document.getElementById('modalDescription').textContent = description;

            const statusBadge = document.getElementById('modalStatus');
            statusBadge.textContent = status;
            statusBadge.className = `badge bg-${status === 'Pending' ? 'warning' : 'success'}`;

            const detailsModal = new bootstrap.Modal(document.getElementById('detailsModal'));
            detailsModal.show();
        }

        function confirmCompletion() {
            const confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
            confirmModal.show();
        }

        function markAsDone() {
            const requestId = currentRow.querySelector('.view-button').getAttribute('onclick').match(/'([^']*)'/)[1];

            currentRow.querySelector('.badge').textContent = 'Completed';
            currentRow.querySelector('.badge').classList.replace('bg-warning', 'bg-success');
            currentRow.querySelector('.view-button').disabled = true;
            currentRow.querySelector('.view-button').innerHTML = '<i class="bi bi-check-circle"></i> Done';

            bootstrap.Modal.getInstance(document.getElementById('confirmModal')).hide();
            bootstrap.Modal.getInstance(document.getElementById('detailsModal')).hide();
        }
    </script>

</body>

</html>
