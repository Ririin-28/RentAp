<?php
session_start();
include '../db_connection.php';

// QR Code upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['qrCodePicture'])) {
    $uploadDir = '../uploads/';
    $fileName = basename($_FILES['qrCodePicture']['name']);
    $targetFilePath = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES['qrCodePicture']['tmp_name'], $targetFilePath)) {
        $stmt = $conn->prepare("INSERT INTO qr_code (picture) VALUES (?)");
        $stmt->bind_param("s", $fileName);
        $stmt->execute();
        $stmt->close();

        $_SESSION['upload_message'] = "QR Code uploaded successfully!";
    } else {
        $_SESSION['upload_message'] = "Failed to upload QR Code. Please try again.";
    }
    header("Location: apartment_management.php");
    exit();
}

$uploadMessage = $_SESSION['upload_message'] ?? '';
$successMessage = $_SESSION['success_message'] ?? '';
$errorMessage = $_SESSION['error_message'] ?? '';

unset($_SESSION['upload_message']);
unset($_SESSION['success_message']);
unset($_SESSION['error_message']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentAp - Apartment Management</title>
    <link rel="icon" href="../images/RentAp_logo.png" type="image/x-icon">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../main.css">
    <style>
        .apartment-layout {
            margin-top: 20px;
            background: #f8f9fa;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            width: 100%;
            font-size: 1.1rem;
        }

        .unit-grid-container {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .unit-row {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            width: 100%;
        }

        .unit-card {
            flex: 1;
            min-width: 220px;
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            border-top: 5px solid transparent;
            cursor: pointer;
        }

        .unit-card.available {
            border-top-color: #2e7d32;
        }

        .unit-card.occupied {
            border-top-color: #ff8f00;
        }

        .unit-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .unit-name {
            font-weight: 600;
            font-size: 1.3rem;
            color: #333;
        }

        .unit-status-badge {
            font-size: 1rem;
            padding: 5px 12px;
            border-radius: 15px;
            font-weight: 600;
        }

        .unit-card.available .unit-status-badge {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .unit-card.occupied .unit-status-badge {
            background: #fff8e1;
            color: #ff8f00;
        }

        .unit-body {
            flex-grow: 1;
        }

        .unit-info {
            font-size: 1.1rem;
            color: #555;
            margin-bottom: 10px;
            display: flex;
            gap: 8px;
            line-height: 1.5;
        }

        .info-label {
            font-weight: 600;
            color: #333;
            min-width: 80px;
        }

        .vacant-text {
            font-size: 1.1rem;
            color: #666;
            font-style: italic;
        }

        .unit-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
        }

        .legend {
            display: flex;
            justify-content: flex-end;
            gap: 25px;
            margin-bottom: 25px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .legend-color {
            width: 22px;
            height: 22px;
            border-radius: 5px;
        }

        .legend-color.available {
            background: #2e7d32;
        }

        .legend-color.occupied {
            background: #ff8f00;
        }

        .legend-text {
            font-size: 1.1rem;
            color: #555;
            font-weight: 500;
        }

        @media (max-width: 992px) {
            .unit-row {
                flex-wrap: wrap;
            }

            .unit-card {
                min-width: calc(50% - 15px);
            }
        }

        @media (max-width: 576px) {
            .apartment-layout {
                font-size: 1rem;
                padding: 15px;
            }

            .unit-card {
                min-width: 100%;
                padding: 15px;
            }

            .unit-name {
                font-size: 1.2rem;
            }

            .unit-info {
                font-size: 1rem;
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
                <h1>Apartment Management</h1>
            </div>
            <div class="content-container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <?php if ($successMessage): ?>
                                    <div class="alert alert-success"><?php echo $successMessage; ?></div>
                                <?php endif; ?>
                                <?php if ($errorMessage): ?>
                                    <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
                                <?php endif; ?>

                                <h4 class="card-title mb-4"><strong>Apartment Layout</strong></h4>
                                <!-- Legend -->
                                <div class="legend">
                                    <div class="legend-item">
                                        <div class="legend-color available"></div>
                                        <div class="legend-text">Available</div>
                                    </div>
                                    <div class="legend-item">
                                        <div class="legend-color occupied"></div>
                                        <div class="legend-text">Occupied</div>
                                    </div>
                                </div>

                                <!-- Apartment Layout -->
                                <div class="apartment-layout">
                                    <?php
                                    $query = "SELECT us.unit, us.status, 
                                             CONCAT(r.first_name, ' ', r.last_name) AS rentee_full_name,
                                             r.facebook_profile, r.email, r.phone_number,
                                             ad.move_in_date
                                      FROM unit_status us
                                      LEFT JOIN rentee r ON us.unit = r.unit
                                      LEFT JOIN agreement_duration ad ON r.rentee_id = ad.rentee_id AND us.unit = ad.unit";
                                    $result = $conn->query($query);
                                    $units = [];
                                    while ($row = $result->fetch_assoc()) {
                                        $units[$row['unit']] = $row;
                                    }

                                    $unitGroups = [
                                        ['G-4', 'G-3', 'G-2', 'G-1'],
                                        ['K-4', 'K-3', 'K-2', 'K-1'],
                                        ['F-4', 'F-3', 'F-2', 'F-1']
                                    ];
                                    ?>

                                    <div class="unit-grid-container">
                                        <?php foreach ($unitGroups as $group): ?>
                                            <div class="unit-row">
                                                <?php foreach ($group as $unit):
                                                    $unitData = $units[$unit] ?? null;
                                                    $status = $unitData['status'] ?? 'Available';
                                                    $statusClass = strtolower($status);
                                                ?>
                                                    <div class="unit-card <?php echo $statusClass; ?>" data-bs-toggle="modal" data-bs-target="#viewModal"
                                                        data-unit="<?php echo $unit; ?>"
                                                        data-status="<?php echo $status; ?>"
                                                        data-rentee="<?php echo htmlspecialchars($unitData['first_name'] ?? 'Vacant'); ?>"
                                                        data-rentee="<?php echo htmlspecialchars($unitData['last_name'] ?? 'Vacant'); ?>"
                                                        data-facebook="<?php echo htmlspecialchars($unitData['facebook_profile'] ?? ''); ?>"
                                                        data-email="<?php echo htmlspecialchars($unitData['email'] ?? ''); ?>"
                                                        data-phone="<?php echo htmlspecialchars($unitData['phone_number'] ?? ''); ?>"
                                                        data-movein="<?php echo htmlspecialchars($unitData['move_in_date'] ?? ''); ?>">
                                                        <div class="unit-header">
                                                            <span class="unit-name"><?php echo $unit; ?></span>
                                                            <span class="unit-status-badge"><?php echo $status; ?></span>
                                                        </div>
                                                        <div class="unit-body">
                                                            <?php if ($unitData && $unitData['rentee_full_name']): ?>
                                                                <div class="unit-info">
                                                                    <span class="info-label">Rentee:</span>
                                                                    <span><?php echo htmlspecialchars($unitData['rentee_full_name']); ?></span>
                                                                </div>
                                                                <div class="unit-info">
                                                                    <span class="info-label">Move-in:</span>
                                                                    <span><?php echo htmlspecialchars($unitData['move_in_date']); ?></span>
                                                                </div>
                                                            <?php else: ?>
                                                                <div class="unit-info">
                                                                    <span class="vacant-text">Vacant Unit</span>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <button class="btn btn-success w-20%" data-bs-toggle="modal"
                                            data-bs-target="#addRenteeModal">
                                            <i class="bi bi-person-plus"></i> Add Rentee
                                        </button>
                                        <button class="btn btn-danger w-20%" data-bs-toggle="modal"
                                            data-bs-target="#endLeaseModal">
                                            <i class="bi bi-person-x"></i> End Lease
                                        </button>
                                    </div>
                                </div>

                                <!-- QR Code Upload Section -->
                                <div class="card-body p-4">
                                    <h4 class="fw-bold mb-4">QR Code Management</h4>
                                    <?php if ($uploadMessage): ?>
                                        <div class="alert alert-info"><?php echo $uploadMessage; ?></div>
                                    <?php endif; ?>
                                    <form method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                        <div class="mb-3">
                                            <label for="qrCodePicture" class="form-label">Upload QR Code</label>
                                            <input type="file" class="form-control" name="qrCodePicture"
                                                id="qrCodePicture" accept="image/*" required>
                                            <div class="invalid-feedback">Please upload a valid QR Code image.</div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Upload QR Code</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- View Modal -->
        <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewModalLabel">Unit Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label"><strong>Unit</strong></label>
                            <p id="viewUnit"></p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Status</strong></label>
                            <p id="viewStatus"></p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Rentee Name</strong></label>
                            <p id="viewRentee"></p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Facebook Profile</strong></label>
                            <p id="viewFacebook"></p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Email</strong></label>
                            <p id="viewEmail"></p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Phone Number</strong></label>
                            <p id="viewPhone"></p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Move-in Date</strong></label>
                            <p id="viewMoveIn"></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Rentee Modal -->
        <div class="modal fade" id="addRenteeModal" tabindex="-1" aria-labelledby="addRenteeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addRenteeModalLabel">Add New Rentee</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addRenteeForm" method="POST" action="add_rentee.php">
                            <div class="mb-3">
                                <label for="renteeName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="renteeName" name="renteeName" required>
                            </div>
                            <div class="mb-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" required>
                            </div>
                            <div class="mb-3">
                                <label for="facebookProfile" class="form-label">Facebook Profile</label>
                                <input type="text" class="form-control" id="facebookProfile" name="facebookProfile" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="phoneNumber" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" required>
                            </div>
                            <div class="mb-3">
                                <label for="unit" class="form-label">Unit</label>
                                <select class="form-select" id="unit" name="unit" required>
                                    <option value="" selected disabled>Select a unit</option>
                                    <?php
                                    $availableUnitsQuery = "SELECT unit FROM unit_status WHERE status = 'Available'";
                                    $availableUnitsResult = $conn->query($availableUnitsQuery);

                                    while ($unit = $availableUnitsResult->fetch_assoc()) {
                                        echo "<option value='" . $unit['unit'] . "'>" . $unit['unit'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="moveInDate" class="form-label">Move-in Date</label>
                                <input type="date" class="form-control" id="moveInDate" name="moveInDate" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Add Rentee</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- End Lease Modal -->
        <div class="modal fade" id="endLeaseModal" tabindex="-1" aria-labelledby="endLeaseModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="endLeaseModalLabel">End Lease</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="endLeaseForm" method="POST" action="end_lease.php">
                            <div class="mb-3">
                                <label for="leaseUnit" class="form-label">Select Unit</label>
                                <select class="form-select" id="leaseUnit" name="leaseUnit" required>
                                    <option value="" selected disabled>Select a unit</option>
                                    <?php
                                    $occupiedUnitsQuery = "SELECT unit FROM Unit_Status WHERE status = 'Occupied'";
                                    $occupiedUnitsResult = $conn->query($occupiedUnitsQuery);

                                    while ($unit = $occupiedUnitsResult->fetch_assoc()) {
                                        echo "<option value='" . $unit['unit'] . "'>" . $unit['unit'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="moveOutDate" class="form-label">Move-out Date</label>
                                <input type="date" class="form-control" id="moveOutDate" name="moveOutDate" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">End Lease</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notification Modal -->
        <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="notificationModalLabel">Notification</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <p id="notificationMessage" class="fs-5"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            const hamBurger = document.querySelector(".toggle-btn");
            hamBurger.addEventListener("click", function() {
                document.querySelector("#sidebar").classList.toggle("expand");
            });

            const viewModal = document.getElementById('viewModal');
            viewModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                document.getElementById('viewUnit').textContent = button.getAttribute('data-unit');
                document.getElementById('viewStatus').textContent = button.getAttribute('data-status');
                document.getElementById('viewRentee').textContent = button.getAttribute('data-rentee');
                document.getElementById('viewFacebook').textContent = button.getAttribute('data-facebook') || 'N/A';
                document.getElementById('viewEmail').textContent = button.getAttribute('data-email') || 'N/A';
                document.getElementById('viewPhone').textContent = button.getAttribute('data-phone') || 'N/A';
                document.getElementById('viewMoveIn').textContent = button.getAttribute('data-movein') || 'N/A';
            });

            document.addEventListener('DOMContentLoaded', function() {
                const today = new Date().toISOString().split('T')[0];
                document.getElementById('moveInDate').value = today;
                document.getElementById('moveOutDate').value = today;
            });

            (function() {
                'use strict';
                const forms = document.querySelectorAll('.needs-validation');
                Array.prototype.slice.call(forms).forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            })();

            document.getElementById('addRenteeForm').addEventListener('submit', function (event) {
                event.preventDefault();

                const form = event.target;
                const formData = new FormData(form);
                const submitButton = form.querySelector('button[type="submit"]');
                const originalText = submitButton.innerHTML;
                submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Adding...';
                submitButton.disabled = true;

                fetch('add_rentee.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        const notificationModal = new bootstrap.Modal(document.getElementById('notificationModal'));
                        const notificationMessage = document.getElementById('notificationMessage');

                        if (data.success) {
                            notificationMessage.textContent = data.message;
                            notificationMessage.className = 'text-success';

                            const addRenteeModal = bootstrap.Modal.getInstance(document.getElementById('addRenteeModal'));
                            addRenteeModal.hide();

                            document.getElementById('addRenteeModal').removeEventListener('hidden.bs.modal', showNotificationModal);
                            document.getElementById('addRenteeModal').addEventListener('hidden.bs.modal', showNotificationModal);

                            function showNotificationModal() {
                                notificationModal.show();

                                document.getElementById('notificationModal').addEventListener('hidden.bs.modal', () => {
                                    location.reload();
                                });
                            }
                        } else {
                            notificationMessage.textContent = data.message;
                            notificationMessage.className = 'text-danger';

                            const addRenteeModal = bootstrap.Modal.getInstance(document.getElementById('addRenteeModal'));
                            addRenteeModal.hide();

                            document.getElementById('addRenteeModal').removeEventListener('hidden.bs.modal', showNotificationModal);
                            document.getElementById('addRenteeModal').addEventListener('hidden.bs.modal', showNotificationModal);

                            function showNotificationModal() {
                                notificationModal.show();
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        const notificationModal = new bootstrap.Modal(document.getElementById('notificationModal'));
                        const notificationMessage = document.getElementById('notificationMessage');
                        notificationMessage.textContent = 'An error occurred while adding the rentee.';
                        notificationMessage.className = 'text-danger';

                        const addRenteeModal = bootstrap.Modal.getInstance(document.getElementById('addRenteeModal'));
                        addRenteeModal.hide();

                        document.getElementById('addRenteeModal').removeEventListener('hidden.bs.modal', showNotificationModal);
                        document.getElementById('addRenteeModal').addEventListener('hidden.bs.modal', showNotificationModal);

                        function showNotificationModal() {
                            notificationModal.show();
                        }
                    })
                    .finally(() => {
                        submitButton.innerHTML = originalText;
                        submitButton.disabled = false;
                    });
            });

            document.getElementById('endLeaseForm').addEventListener('submit', function (event) {
                event.preventDefault();

                const form = event.target;
                const formData = new FormData(form);

                const submitButton = form.querySelector('button[type="submit"]');
                const originalText = submitButton.innerHTML;
                submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Ending Lease...';
                submitButton.disabled = true;

                fetch('end_lease.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        const notificationModal = new bootstrap.Modal(document.getElementById('notificationModal'));
                        const notificationMessage = document.getElementById('notificationMessage');

                        if (data.success) {
                            notificationMessage.textContent = data.message;
                            notificationMessage.className = 'text-success';

                            const endLeaseModal = bootstrap.Modal.getInstance(document.getElementById('endLeaseModal'));
                            endLeaseModal.hide();

                            const endLeaseModalElement = document.getElementById('endLeaseModal');
                            endLeaseModalElement.removeEventListener('hidden.bs.modal', showNotificationModal);
                            endLeaseModalElement.addEventListener('hidden.bs.modal', showNotificationModal);

                            function showNotificationModal() {
                                notificationModal.show();

                                document.getElementById('notificationModal').addEventListener('hidden.bs.modal', () => {
                                    location.reload();
                                });
                            }
                        } else {
                            notificationMessage.textContent = data.message;
                            notificationMessage.className = 'text-danger';

                            const endLeaseModal = bootstrap.Modal.getInstance(document.getElementById('endLeaseModal'));
                            endLeaseModal.hide();

                            const endLeaseModalElement = document.getElementById('endLeaseModal');
                            endLeaseModalElement.removeEventListener('hidden.bs.modal', showNotificationModal);
                            endLeaseModalElement.addEventListener('hidden.bs.modal', showNotificationModal);

                            function showNotificationModal() {
                                notificationModal.show();
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        const notificationModal = new bootstrap.Modal(document.getElementById('notificationModal'));
                        const notificationMessage = document.getElementById('notificationMessage');
                        notificationMessage.textContent = 'An error occurred while ending the lease.';
                        notificationMessage.className = 'text-danger';

                        const endLeaseModal = bootstrap.Modal.getInstance(document.getElementById('endLeaseModal'));
                        endLeaseModal.hide();

                        const endLeaseModalElement = document.getElementById('endLeaseModal');
                        endLeaseModalElement.removeEventListener('hidden.bs.modal', showNotificationModal);
                        endLeaseModalElement.addEventListener('hidden.bs.modal', showNotificationModal);

                        function showNotificationModal() {
                            notificationModal.show();
                        }
                    })
                    .finally(() => {
                        submitButton.innerHTML = originalText;
                        submitButton.disabled = false;
                    });
            });
        </script>
    </div>
</body>

</html>
<?php $conn->close(); ?>