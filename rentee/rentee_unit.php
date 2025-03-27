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
            <div class="title-container">
                <img src="../images/RentAp_full.png" alt="RentAp Icon" class="rentap_Icon">
                <h1>Unit</h1>
            </div>

            <div class="content-container">
                <div class="row">
                    <div class="col-12">

                        <!-- Due Date and QR Code Section -->
                        <div class="card mb-3">
                            <div class="card-body p-4">
                                <div class="row align-items-center">
                                    <div class="col-md-9">
                                        <h4 class="fw-bold">Due Date</h4>
                                        <div class="p-3 rounded-3">
                                            <p class="mb-2">Your next payment is due on: 
                                                <strong class="text-primary">March 15, 2025</strong>
                                            </p>
                                            <p class="mb-0">Payment Status: 
                                                <span class="badge bg-warning">Pending</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <h4 class="fw-bold">QR Code for Payment:</h4>
                                        <button class="btn btn-outline-primary mt-3" data-bs-toggle="modal" data-bs-target="#qrCodeModal" style="font-size: 2rem;">
                                            <i class="bi bi-qr-code"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Maintenance Request Section -->
                        <div class="card">
                            <div class="card-body p-4">
                                <h4 class="fw-bold">Request for Maintenance</h4>
                                <form id="maintenanceForm" class="needs-validation" novalidate>
                                    <div class="row g-4">
                                        
                                        <!-- Issue Type Dropdown -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Select a Category</label>
                                            <select id="issueType" class="form-select" required>
                                                <option value="">-- Select Category --</option>
                                                <option value="unit">Unit Maintenance</option>
                                                <option value="technical">Technical Issue</option>
                                            </select>
                                            <div class="invalid-feedback">Please select a category.</div>
                                        </div>

                                        <!-- Dynamic Dropdowns -->
                                        <div class="col-md-6">
                                            <div id="unitDropdown" class="form-group" style="display: none;">
                                                <label class="form-label fw-bold">Unit Maintenance Issues</label>
                                                <select id="unit" class="form-select">
                                                    <option>Flooring</option>
                                                    <option>Walls and Ceiling</option>
                                                    <option>Windows</option>
                                                    <option>Doors</option>
                                                    <option>Electrical</option>
                                                    <option>Plumbing</option>
                                                </select>
                                            </div>

                                            <div id="technicalDropdown" class="form-group" style="display: none;">
                                                <label class="form-label fw-bold">Technical Issues</label>
                                                <select id="technical" class="form-select">
                                                    <option>Payment Error</option>
                                                    <option>Missing Transaction</option>
                                                    <option>Incorrect Billing Information</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Issue Description -->
                                        <div class="col-md-12">
                                            <label class="form-label fw-bold">Describe the issue</label>
                                            <textarea id="maintenanceIssue" class="form-control" rows="4" required></textarea>
                                            <div class="invalid-feedback">Please describe the issue.</div>
                                        </div>

                                        <!-- Centered Submit Button -->
                                        <div class="text-center mt-4">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal">
                                                Submit Request
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
    </script>

</body>
</html>
