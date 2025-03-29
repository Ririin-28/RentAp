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
                                            <!-- Due Date Section -->
                                            <div class="col-lg-6">
                                                <h5 class="fw-bold">📅 Due Date</h5>
                                                <div class="p-3 border rounded-3 bg-light">
                                                    <p class="mb-2">
                                                        <strong>Monthly Rent Due Date:</strong>
                                                        <span class="text-primary fw-bold">March 15, 2025</span>
                                                    </p>
                                                    <p class="mb-0">
                                                        <strong>Payment Status:</strong>
                                                        <span class="badge bg-warning text-dark">Pending</span>
                                                    </p>
                                                </div>
                                            </div>

                                            <!-- Online Payment Section -->
                                            <div class="col-lg-6 text-center">
                                                <h5 class="fw-bold">💳 Online Payment</h5>
                                                <button class="btn btn-outline-primary mt-3 p-3" data-bs-toggle="modal"
                                                    data-bs-target="#qrCodeModal">
                                                    <i class="bi bi-qr-code" style="font-size: 2rem;"></i> <br>
                                                    Scan to Pay
                                                </button>
                                            </div>

                                            <!-- Upload Proof of Payment -->
                                            <div class="col-12">
                                                <h5 class="fw-bold">📤 Upload Proof of Payment</h5>
                                                <form id="paymentProofForm" class="needs-validation" novalidate>
                                                    <div class="input-group">
                                                        <input type="file" class="form-control" id="paymentProof"
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
                                        <form id="maintenanceForm" class="needs-validation" novalidate>
                                            <div class="row gy-4">
                                                <!-- Select Category -->
                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold">📌 Select a Category</label>
                                                    <select id="issueType" class="form-select" required>
                                                        <option value="">-- Select Category --</option>
                                                        <option value="unit">Unit Maintenance</option>
                                                        <option value="technical">Technical Issue</option>
                                                    </select>
                                                    <div class="invalid-feedback">Please select a category.</div>
                                                </div>

                                                <!-- Describe the Issue -->
                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold">✏️ Describe the Issue</label>
                                                    <textarea id="maintenanceIssue" class="form-control" rows="4"
                                                        placeholder="Provide details about the issue..." required></textarea>
                                                    <div class="invalid-feedback">Please describe the issue.</div>
                                                </div>

                                                <!-- Submit Button -->
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
                    <img src="../images/qr_code.png" alt="QR Code" class="img-fluid rounded" style="max-width: 300px;">
                    <p class="mt-3 text-muted">Scan to make payment</p>
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
            unitDropdown.style.display = (issueTypeSelect.value === 'unit') ? 'block' : 'none';
            technicalDropdown.style.display = (issueTypeSelect.value === 'technical') ? 'block' : 'none';
        });

        function submitRequest() {
            const form = document.getElementById('maintenanceForm');

            if (form.checkValidity()) {
                alert('Maintenance request submitted successfully!');
                form.reset();
                const modal = bootstrap.Modal.getInstance(document.getElementById('confirmModal'));
                modal.hide();
            } else {
                form.classList.add('was-validated');
            }
        }

        // Handle payment proof form submission
        const paymentProofForm = document.getElementById('paymentProofForm');
        paymentProofForm.addEventListener('submit', function (e) {
            e.preventDefault();
            if (paymentProofForm.checkValidity()) {
                alert('Payment proof uploaded successfully!');
                paymentProofForm.reset();
            } else {
                paymentProofForm.classList.add('was-validated');
            }
        });
    </script>

</body>

</html>
