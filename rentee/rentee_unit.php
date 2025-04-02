<?php
session_start();
include '../db_connection.php';

if (!isset($_SESSION['p_first_name']) || !isset($_SESSION['p_unit']) || !isset($_SESSION['rentee_id'])) {
    header('Location: ../rentee/rentee_login.php');
    exit();
}

$p_first_name = $_SESSION['p_first_name'];
$p_unit = $_SESSION['p_unit'];
$rentee_id = $_SESSION['rentee_id'];

$stmt = $conn->prepare("SELECT due_date, status FROM pending_payments WHERE rentee_id = ? AND status = 'Pending' ORDER BY due_date ASC LIMIT 1");
$stmt->bind_param("i", $rentee_id);
$stmt->execute();
$result = $stmt->get_result();

$due_date = null;
$status = null;

if ($row = $result->fetch_assoc()) {
    $due_date = $row['due_date'];
    $status = $row['status'];
} else {
    $due_date = "No pending payments";
    $status = "N/A";
}

$stmt->close();

$qrCodePicture = null;
$qrStmt = $conn->prepare("SELECT picture FROM QR_Code ORDER BY id DESC LIMIT 1");
$qrStmt->execute();
$qrResult = $qrStmt->get_result();

if ($qrRow = $qrResult->fetch_assoc()) {
    $qrCodePicture = $qrRow['picture'];
}

$qrStmt->close();

$remainingDaysStmt = $conn->prepare("SELECT remaining_days FROM Agreement_Duration WHERE rentee_id = ? AND unit = ?");
$remainingDaysStmt->bind_param("is", $rentee_id, $p_unit);
$remainingDaysStmt->execute();
$remainingDaysResult = $remainingDaysStmt->get_result();

$canRequestMaintenance = false;
if ($remainingDaysRow = $remainingDaysResult->fetch_assoc()) {
    $canRequestMaintenance = $remainingDaysRow['remaining_days'] > 0;
}
$remainingDaysStmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['maintenanceCategory'], $_POST['maintenanceIssue'], $_POST['maintenanceDescription'])) {
    if ($canRequestMaintenance) {
        $category = $_POST['maintenanceCategory'];
        $issue = $_POST['maintenanceIssue'];
        $description = $_POST['maintenanceDescription'];
        $requestDate = date('Y-m-d');

        $maintenanceStmt = $conn->prepare("INSERT INTO Maintenance_Request (unit, rentee_id, date, category, issue, description, status) VALUES (?, ?, ?, ?, ?, ?, 'Pending')");
        $maintenanceStmt->bind_param("sissss", $p_unit, $rentee_id, $requestDate, $category, $issue, $description);
        $maintenanceStmt->execute();
        $maintenanceStmt->close();

        $maintenanceMessage = "Maintenance request submitted successfully!";
    } else {
        $maintenanceMessage = "You cannot request maintenance as your agreement has expired.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['paymentProof'])) {
    $uploadDir = '../uploads/';
    $fileName = basename($_FILES['paymentProof']['name']);
    $targetFilePath = $uploadDir . $fileName;
    $uploadDate = date('Y-m-d');

    if (move_uploaded_file($_FILES['paymentProof']['tmp_name'], $targetFilePath)) {
        $stmt = $conn->prepare("INSERT INTO Rentee_Payment (rentee_id, payment_picture, date) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $rentee_id, $fileName, $uploadDate);
        $stmt->execute();
        $stmt->close();

        $confirmationMessage = "Payment proof uploaded successfully for the due date: " . date("F j, Y", strtotime($due_date));
        $uploadSuccess = true;
    } else {
        $confirmationMessage = "Failed to upload payment proof. Please try again.";
        $uploadSuccess = false;
    }
}

$conn->close();
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
</head>

<body>
    <div class="wrapper">
        <?php include '../rentee_sidebar.php'; ?>

        <div class="main-content container-fluid g-0">
            <div class="title-container text-center mb-4">
                <img src="../images/RentAp_full.png" alt="RentAp Icon" class="rentap_Icon">
                <h1>Unit Management</h1>
            </div>

            <div class="content-container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body p-4">
                                <h4 class="fw-bold mb-4">Unit Management</h4>
                                <ul class="nav nav-tabs" id="unitManagementTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="dueDateTab" data-bs-toggle="tab"
                                            data-bs-target="#dueDateContent" type="button" role="tab"
                                            aria-controls="dueDateContent" aria-selected="true">Manage Payment</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="maintenanceTab" data-bs-toggle="tab"
                                            data-bs-target="#maintenanceContent" type="button" role="tab"
                                            aria-controls="maintenanceContent" aria-selected="false">Request
                                            Maintenance</button>
                                    </li>
                                </ul>
                                <div class="tab-content mt-4" id="unitManagementTabContent">
                                    <div class="tab-pane fade show active" id="dueDateContent" role="tabpanel"
                                        aria-labelledby="dueDateTab">
                                        <div class="row gy-4">
                                            <div class="col-lg-6">
                                                <h5 class="fw-bold">📅 Due Date</h5>
                                                <div class="p-3 border rounded-3 bg-light">
                                                    <p class="mb-2">
                                                        <strong>Monthly Rent Due Date:</strong>
                                                        <span class="text-primary fw-bold">
                                                            <?php echo $due_date !== "No pending payments" ? date("F j, Y", strtotime($due_date)) : $due_date; ?>
                                                        </span>
                                                    </p>
                                                    <p class="mb-0">
                                                        <strong>Payment Status:</strong>
                                                        <span class="badge bg-warning text-dark"><?php echo $status; ?></span>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 text-center">
                                                <h5 class="fw-bold">💳 Online Payment</h5>
                                                <button class="btn btn-outline-primary mt-3 p-3" data-bs-toggle="modal"
                                                    data-bs-target="#qrCodeModal">
                                                    <i class="bi bi-qr-code" style="font-size: 2rem;"></i> <br>
                                                    Scan to Pay
                                                </button>
                                            </div>

                                            <div class="col-12">
                                                <h5 class="fw-bold">📤 Upload Proof of Payment</h5>
                                                <form id="paymentProofForm" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                                    <div class="input-group">
                                                        <input type="file" class="form-control" name="paymentProof"
                                                            accept="image/*,application/pdf" required>
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="bi bi-upload"></i> Upload
                                                        </button>
                                                    </div>
                                                    <div class="invalid-feedback">Please upload a valid payment proof.</div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="maintenanceContent" role="tabpanel"
                                        aria-labelledby="maintenanceTab">
                                        <h5 class="fw-bold mb-4">🛠️ Request Maintenance</h5>
                                        <?php if (isset($maintenanceMessage)): ?>
                                        <div class="alert alert-info text-center">
                                            <?php echo $maintenanceMessage; ?>
                                        </div>
                                        <?php endif; ?>
                                        <form id="maintenanceForm" class="needs-validation" method="POST" novalidate>
                                            <div class="row gy-4">
                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold">📌 Select a Category</label>
                                                    <select id="issueType" name="maintenanceCategory" class="form-select" required>
                                                        <option value="">-- Select Category --</option>
                                                        <option value="Unit Maintenance">Unit Maintenance</option>
                                                        <option value="Technical Issue">Technical Issue</option>
                                                    </select>
                                                    <div class="invalid-feedback">Please select a category.</div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div id="unitDropdown" class="form-group" style="display: none;">
                                                        <label class="form-label fw-bold">Unit Maintenance Issues</label>
                                                        <select id="unitIssues" class="form-select">
                                                            <option value="">-- Select Issue --</option>
                                                            <option value="Flooring">Flooring</option>
                                                            <option value="Walls and Ceiling">Walls and Ceiling</option>
                                                            <option value="Windows">Windows</option>
                                                            <option value="Doors">Doors</option>
                                                            <option value="Electrical">Electrical</option>
                                                            <option value="Plumbing">Plumbing</option>
                                                        </select>
                                                    </div>

                                                    <div id="technicalDropdown" class="form-group" style="display: none;">
                                                        <label class="form-label fw-bold">Technical Issues</label>
                                                        <select id="technicalIssues" class="form-select">
                                                            <option value="">-- Select Issue --</option>
                                                            <option value="Payment Error">Payment Error</option>
                                                            <option value="Missing Transaction">Missing Transaction</option>
                                                            <option value="Incorrect Billing Information">Incorrect Billing Information</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <label class="form-label fw-bold">✏️ Describe the Issue</label>
                                                    <textarea id="maintenanceDescription" name="maintenanceDescription" class="form-control" rows="4"
                                                        placeholder="Provide details about the issue..." required></textarea>
                                                    <div class="invalid-feedback">Please describe the issue.</div>
                                                </div>

                                                <div class="text-end mt-4">
                                                    <button type="button" class="btn btn-primary p-3" data-bs-toggle="modal"
                                                        data-bs-target="#confirmModal">
                                                        <i class="bi bi-send"></i> Submit
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- QR Code Modal -->
    <div class="modal fade" id="qrCodeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">QR Code for Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center p-4">
                    <?php if ($qrCodePicture): ?>
                        <img src="../uploads/<?php echo htmlspecialchars($qrCodePicture); ?>" alt="QR Code" class="img-fluid rounded" style="max-width: 300px;">
                        <p class="mt-3 text-muted">Scan to make payment</p>
                    <?php else: ?>
                        <p class="text-muted">No QR Code available at the moment.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Submission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to submit this maintenance request?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" onclick="submitRequest()">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Upload Notification Modal -->
    <div class="modal fade" id="uploadNotificationModal" tabindex="-1" aria-labelledby="uploadNotificationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadNotificationModalLabel">Payment Upload Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if (isset($confirmationMessage)): ?>
                        <?php echo $confirmationMessage; ?>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Confirmation Modal -->
    <?php if (isset($confirmationMessage)): ?>
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Payment Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php echo $confirmationMessage; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        const confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
        confirmationModal.show();
    </script>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    const hamBurger = document.querySelector(".toggle-btn");
    hamBurger.addEventListener("click", function () {
        document.querySelector("#sidebar").classList.toggle("expand");
    });

    const issueTypeSelect = document.getElementById('issueType');
    const unitDropdown = document.getElementById('unitDropdown');
    const technicalDropdown = document.getElementById('technicalDropdown');

    issueTypeSelect.addEventListener('change', () => {
        unitDropdown.style.display = (issueTypeSelect.value === 'Unit Maintenance') ? 'block' : 'none';
        technicalDropdown.style.display = (issueTypeSelect.value === 'Technical Issue') ? 'block' : 'none';
    });

    function submitRequest() {
        const form = document.getElementById('maintenanceForm');
        const category = document.getElementById('issueType').value;
        const issue = category === 'Unit Maintenance'
            ? document.getElementById('unitIssues').value
            : document.getElementById('technicalIssues').value;
        const description = document.getElementById('maintenanceDescription').value;

        if (form.checkValidity() && category && issue && description) {
            const hiddenIssueInput = document.createElement('input');
            hiddenIssueInput.type = 'hidden';
            hiddenIssueInput.name = 'maintenanceIssue';
            hiddenIssueInput.value = issue;
            form.appendChild(hiddenIssueInput);

            const formData = new FormData(form);
            fetch('', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(() => {
                const maintenanceMessage = document.createElement('div');
                maintenanceMessage.className = 'alert alert-info text-center';
                maintenanceMessage.textContent = 'Maintenance request submitted successfully!';
                form.parentElement.insertBefore(maintenanceMessage, form);

                const modal = bootstrap.Modal.getInstance(document.getElementById('confirmModal'));
                modal.hide();

                setTimeout(() => {
                    maintenanceMessage.remove();
                }, 5000);

                form.reset();
                form.classList.remove('was-validated');
                unitDropdown.style.display = 'none';
                technicalDropdown.style.display = 'none';
            })
            .catch(() => {
                alert('Failed to submit the maintenance request. Please try again.');
            });
        } else {
            form.classList.add('was-validated');
        }
    }
</script>

<script>
    <?php if (isset($uploadSuccess)): ?>
        const uploadNotificationModal = new bootstrap.Modal(document.getElementById('uploadNotificationModal'));
        uploadNotificationModal.show();
    <?php endif; ?>
</script>

</body>

</html>
