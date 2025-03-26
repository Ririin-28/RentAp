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
                                <h4 class="card-title"><strong>Requests List</strong></h4>
                                <div class="card-header">
                                    <span class="total-requests">Total Requests:<strong> 4</strong></span>
                                </div>
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
                                                <tr>
                                                    <td>101</td>
                                                    <td>Juan Dela Cruz</td>
                                                    <td>Mar 8</td>
                                                    <td><span class="badge bg-warning">Pending</span></td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm" onclick="openDetailsModal(event, '101', 'Electrical', 'Light Bulb', 'Bulb in living room flickering', 'Pending')">
                                                            <i class="bi bi-eye"></i> View
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>202</td>
                                                    <td>Maria Santos</td>
                                                    <td>Mar 7</td>
                                                    <td><span class="badge bg-warning">Pending</span></td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm" onclick="openDetailsModal(event, '202', 'Plumbing', 'Toilet', 'Flush not working', 'Pending')">
                                                            <i class="bi bi-eye"></i> View
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>305</td>
                                                    <td>Carlos Reyes</td>
                                                    <td>Mar 6</td>
                                                    <td><span class="badge bg-success">Completed</span></td>
                                                    <td>
                                                        <button class="btn btn-secondary btn-sm" disabled>
                                                            <i class="bi bi-check-circle"></i> Done
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>408</td>
                                                    <td>Ana Mendoza</td>
                                                    <td>Mar 5</td>
                                                    <td><span class="badge bg-warning">Pending</span></td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm" onclick="openDetailsModal(event, '408', 'Walls and Ceiling', 'Ceiling', 'Water leakage', 'Pending')">
                                                            <i class="bi bi-eye"></i> View
                                                        </button>
                                                    </td>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
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
            currentRow.querySelector('.badge').textContent = 'Completed';
            currentRow.querySelector('.badge').classList.replace('bg-warning', 'bg-success');

            bootstrap.Modal.getInstance(document.getElementById('confirmModal')).hide();
            bootstrap.Modal.getInstance(document.getElementById('detailsModal')).hide();
        }
    </script>

</body>
</html>
