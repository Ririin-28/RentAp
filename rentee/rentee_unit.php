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
        /* Enhanced Styles */
        .card {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border-radius: 8px;
            margin-bottom: 20px;
            border: none;
        }

        .section {
            padding: 24px;
            margin-bottom: 20px;
        }

        h4 {
            margin-bottom: 1.5rem;
            color: #2c3e50;
            font-weight: 600;
        }

        .btn-primary {
            padding: 10px 24px;
            font-weight: 500;
            transition: all 0.3s ease;
            background-color: #0066cc;
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            background-color: #0052a3;
        }

        .form-control, .form-select {
            padding: 0.75rem;
            border-radius: 6px;
            border: 1px solid #dee2e6;
            transition: border-color 0.15s ease-in-out;
        }

        .form-control:focus, .form-select:focus {
            border-color: #0066cc;
            box-shadow: 0 0 0 0.2rem rgba(0,102,204,0.25);
        }

        .badge {
            padding: 8px 12px;
            border-radius: 6px;
            font-weight: 500;
        }

        .modal-content {
            border-radius: 12px;
            border: none;
        }

        @media (max-width: 768px) {
            .card-body {
                padding: 1rem;
            }
            
            .section {
                padding: 16px;
            }
            
            h4 {
                font-size: 1.2rem;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <?php include '../rentee_sidebar.php'; ?>
        <!-- Main Content -->
        <div class="main-content container-fluid g-0">
            <!-- Title Container -->
            <div class="title-container">
                <img src="../images/RentAp_full.png" alt="RentAp Icon" class="rentap_Icon">
                <h1>Unit</h1>
            </div>

            <div class="content-container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body p-4">
                                <div class="row">
                                    <!-- Due Date Section -->
                                    <div class="col-md-9 mb-5">
                                        <h4>Due Date</h4>
                                        <div class="p-3 rounded-3">
                                            <p class="mb-2">Your next payment is due on: 
                                                <strong class="text-primary">March 15, 2025</strong>
                                            </p>
                                            <p class="mb-0">Payment Status: 
                                                <span class="badge bg-primary">Pending</span>
                                            </p>
                                        </div>
                                    </div>

                                    <!-- QR Code Section -->
                                    <div class="col-md-3 mb-5">
                                        <div class="d-flex flex-column align-items-center">
                                            <h4>QR Code for Payment:</h4>
                                            <button class="btn btn-outline-primary mt-3" data-bs-toggle="modal" data-bs-target="#qrCodeModal" style="font-size: 2rem;">
                                                <i class="bi bi-qr-code"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Maintenance Request Section -->
                                    <div class="col-12">
                                        <div class="section rounded-3">
                                            <h4>Request for Maintenance</h4>
                                            <form id="maintenanceForm" class="needs-validation" novalidate>
                                                <div class="row g-4">
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-4">
                                                            <label class="form-label fw-bold">Select Issue Type</label>
                                                            <select id="issueType" class="form-select" required>
                                                                <option value="">-- Select Issue --</option>
                                                                <option value="unit">Unit Maintenance</option>
                                                                <option value="technical">Technical Issue</option>
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                Please select an issue type.
                                                            </div>
                                                        </div>

                                                        <div id="unitDropdown" class="form-group mb-4" style="display: none;">
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

                                                        <div id="technicalDropdown" class="form-group mb-4" style="display: none;">
                                                            <label class="form-label fw-bold">Technical Issues</label>
                                                            <select id="technical" class="form-select">
                                                                <option>Payment Error</option>
                                                                <option>Missing Transaction</option>
                                                                <option>Incorrect Billing Information</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label fw-bold">Describe the issue</label>
                                                            <textarea id="maintenanceIssue" class="form-control" rows="5" required></textarea>
                                                            <div class="invalid-feedback">
                                                                Please describe the issue.
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar Toggle
        const hamBurger = document.querySelector(".toggle-btn");
        hamBurger.addEventListener("click", function () {
            document.querySelector("#sidebar").classList.toggle("expand");
        });

        // Form Handling
        const form = document.getElementById('maintenanceForm');
        const issueTypeSelect = document.getElementById('issueType');

        function showSubDropdown() {
            const issueType = issueTypeSelect.value;
            document.getElementById('unitDropdown').style.display = (issueType === 'unit') ? 'block' : 'none';
            document.getElementById('technicalDropdown').style.display = (issueType === 'technical') ? 'block' : 'none';
        }

        issueTypeSelect.addEventListener('change', showSubDropdown);

        form.addEventListener('submit', function(event) {
            event.preventDefault();
            
            if (!form.checkValidity()) {
                event.stopPropagation();
                form.classList.add('was-validated');
                return;
            }

            const submitButton = this.querySelector('button[type="submit"]');
            submitButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Submitting...';
            submitButton.disabled = true;

            // Simulate form submission
            setTimeout(() => {
                submitButton.innerHTML = 'Submit Request';
                submitButton.disabled = false;
                alert('Maintenance request submitted successfully!');
                form.reset();
                form.classList.remove('was-validated');
            }, 1500);
        });
    </script>
</body>
</html>
