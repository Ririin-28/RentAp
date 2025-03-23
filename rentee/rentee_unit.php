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
        .status {
            font-size: 0.9em;
            padding: 5px;
            border-radius: 5px;
            color: white;
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
                            <div class="card-body">
                                <div class="row">
                                    <!-- Due Date Section -->
                                    <div class="col-9 mb-5">
                                        <h4><strong>Due Date</strong></h4>
                                        <p class="mb-0">Your next payment is due on: <strong>March 15, 2025</strong></p>
                                        <p>Payment Status: <strong style="color: red;">Pending</strong></p>
                                    </div>
                                    <!-- QR Code for Payment Section -->
                                    <div class="col-md-3 mb-5">
                                        <div class="section mt-4 d-flex justify-content-between align-items-center">
                                            <h4><strong>QR Code for Payment</strong></h4>
                                            <i class="bi bi-qr-code" data-bs-toggle="modal" data-bs-target="#qrCodeModal" style="font-size: 24px; cursor: pointer; margin-left: 20px;"></i>
                                        </div>
                                    </div>

                                    <!-- QR Code Modal -->
                                    <div class="modal fade" id="qrCodeModal" tabindex="-1" aria-labelledby="qrCodeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="qrCodeModalLabel">QR Code for Payment</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img src="../images/qr_code.png" alt="QR Code for Payment" class="img-fluid" style="width: 326px; height: 373px;">
                                                    <p class="mt-3">Scan the QR code to make a payment.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Maintenance Request Section -->
                                    <div class="section mt-3">
                                        <h4><strong>Request for Maintenance</strong></h4>
                                        
                                        <!-- Dropdown Section -->
                                        <form id="maintenanceForm">
                                            <div class="mb-3">
                                                <label for="issueType" class="form-label">Select Issue Type</label>
                                                <select id="issueType" class="form-select" onchange="showSubDropdown()" required>
                                                    <option value="">-- Select Issue --</option>
                                                    <option value="unit">Unit Maintenance</option>
                                                    <option value="technical">Technical Issue</option>
                                                </select>
                                            </div>

                                            <div id="unitDropdown" class="mb-3" style="display: none;">
                                                <label for="unit" class="form-label">Unit Maintenance Issues</label>
                                                <select id="unit" name="unit" class="form-select">
                                                    <option>Flooring</option>
                                                    <option>Walls and Ceiling</option>
                                                    <option>Windows</option>
                                                    <option>Doors</option>
                                                    <option>Electrical</option>
                                                    <option>Plumbing</option>
                                                </select>
                                            </div>

                                            <div id="technicalDropdown" class="mb-3" style="display: none;">
                                                <label for="technical" class="form-label">Technical Issues</label>
                                                <select id="technical" name="technical" class="form-select">
                                                    <option>Payment Error</option>
                                                    <option>Missing Transaction</option>
                                                    <option>Incorrect Billing Information</option>
                                                </select>
                                            </div>

                                            <!-- Describe the issue -->
                                            <div class="mb-3">
                                                <label for="maintenanceIssue" class="form-label">Describe the issue</label>
                                                <textarea name="maintenanceIssue" id="maintenanceIssue" class="form-control" rows="3" required></textarea>
                                            </div>
                                            
                                            <button type="submit" class="btn btn-primary">Submit Request</button>
                                        </form>
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

            // Show/hide sub-dropdowns based on selection
            function showSubDropdown() {
                const issueType = document.getElementById('issueType').value;
                document.getElementById('unitDropdown').style.display = (issueType === 'unit') ? 'block' : 'none';
                document.getElementById('technicalDropdown').style.display = (issueType === 'technical') ? 'block' : 'none';
            }

            document.getElementById('maintenanceForm').addEventListener('submit', function(event) {
                event.preventDefault();
                alert('Maintenance request submitted successfully!');
                // Add AJAX code here to submit form data to the server
            });
        </script>
    </div>
</body>

</html>
