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
        .unit {
            border: 2px solid #ddd;
            padding: 10px;
            margin: 10px;
            height: 110px;
            border-radius: 8px;
            text-align: center;
            transition: transform 0.2s;
            position: relative;
        }

        .unit:hover {
            transform: scale(1.05);
        }

        .occupied {
            background-color: #fff3cd;
        }

        .available {
            background-color: #d4edda;
        }

        .maintenance {
            background-color: #f8d7da;
        }

        .unit h5 {
            margin-bottom: 10px;
        }

        .unit p {
            margin: 0;
        }

        .warning-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            color: #ffc107;
            cursor: pointer;
        }

        .warning-tooltip-text {
            display: none;
            position: absolute;
            top: 30px;
            right: 10px;
            background-color: #ffc107;
            color: #fff;
            padding: 5px;
            border-radius: 5px;
            font-size: 12px;
        }

        .warning-icon:hover+.warning-tooltip-text {
            display: block;
        }

        .danger-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            color: rgb(252, 0, 0);
            cursor: pointer;
        }

        .danger-tooltip-text {
            display: none;
            position: absolute;
            top: 30px;
            right: 10px;
            background-color: rgb(255, 0, 0);
            color: #fff;
            padding: 5px;
            border-radius: 5px;
            font-size: 12px;
        }

        .danger-icon:hover+.danger-tooltip-text {
            display: block;
        }

        .legend {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .legend-item {
            display: flex;
            align-items: center;
        }

        .legend-color {
            width: 20px;
            height: 20px;
            margin-right: 10px;
            border-radius: 5px;
        }

        .legend-text {
            font-size: 14px;
            color: #555;
        }

        .view-button {
            position: absolute;
            bottom: 10px;
            right: 10px;
        }

        .occupant-name {
            display: none;
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 5px;
            border-radius: 5px;
        }

        .unit.occupied:hover .occupant-name {
            display: block;
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
                                <h4 class="card-title"><strong>Apartment Layout</strong></h4>
                                <!-- Legend -->
                                <div class="legend d-flex justify-content-end mb-4">
                                    <div class="legend-item">
                                        <div class="legend-color" style="background-color: #d4edda;"></div>
                                        <div class="legend-text">Available</div>
                                    </div>
                                    <div class="legend-item">
                                        <div class="legend-color" style="background-color: #fff3cd;"></div>
                                        <div class="legend-text">Occupied</div>
                                    </div>
                                </div>

                                <!-- Rentee Grid View -->
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <div class="unit occupied" data-unit="Unit 112">
                                            <h5>Unit G-4</h5>
                                            <div class="occupant-name">John Doe</div>
                                            <i class="bi bi-exclamation-triangle-fill danger-icon"></i>
                                            <div class="danger-tooltip-text">Overdue Date</div>
                                            <button type="button" class="btn btn-primary view-button"
                                                data-bs-toggle="modal" data-bs-target="#viewModal"
                                                onclick="fillModal('Occupied', 'John Doe', 'john.doe', 'john.doe@example.com', '1234567890')">View</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="unit occupied" data-unit="Unit 111">
                                            <h5>Unit G-3</h5>
                                            <div class="occupant-name">Jane Smith</div>
                                            <button type="button" class="btn btn-primary view-button"
                                                data-bs-toggle="modal" data-bs-target="#viewModal"
                                                onclick="fillModal('Occupied', 'Jane Smith', 'jane.smith', 'jane.smith@example.com', '0987654321')">View</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="unit available" data-unit="Unit 110">
                                            <h5>Unit G-2</h5>
                                            <button type="button" class="btn btn-primary view-button"
                                                data-bs-toggle="modal" data-bs-target="#viewModal"
                                                onclick="fillModal('Available', '', '', '', '')">View</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="unit occupied" data-unit="Unit 109">
                                            <h5>Unit G-1</h5>
                                            <div class="occupant-name">Alice Johnson</div>
                                            <i class="bi bi-exclamation-triangle-fill warning-icon"></i>
                                            <div class="warning-tooltip-text">Upcoming Due Date</div>
                                            <button type="button" class="btn btn-primary view-button"
                                                data-bs-toggle="modal" data-bs-target="#viewModal"
                                                onclick="fillModal('Occupied', 'Alice Johnson', 'alice.johnson', 'alice.johnson@example.com', '1122334455')">View</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="unit occupied" data-unit="Unit 108">
                                            <h5>Unit K-4</h5>
                                            <div class="occupant-name">Bob Brown</div>
                                            <button type="button" class="btn btn-primary view-button"
                                                data-bs-toggle="modal" data-bs-target="#viewModal"
                                                onclick="fillModal('Occupied', 'Bob Brown', 'bob.brown', 'bob.brown@example.com', '2233445566')">View</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="unit occupied" data-unit="Unit 107">
                                            <h5>Unit K-3</h5>
                                            <div class="occupant-name">Carol White</div>
                                            <button type="button" class="btn btn-primary view-button"
                                                data-bs-toggle="modal" data-bs-target="#viewModal"
                                                onclick="fillModal('Occupied', 'Carol White', 'carol.white', 'carol.white@example.com', '3344556677')">View</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="unit occupied" data-unit="Unit 106">
                                            <h5>Unit K-2</h5>
                                            <div class="occupant-name">Dave Green</div>
                                            <button type="button" class="btn btn-primary view-button"
                                                data-bs-toggle="modal" data-bs-target="#viewModal"
                                                onclick="fillModal('Occupied', 'Dave Green', 'dave.green', 'dave.green@example.com', '4455667788')">View</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="unit occupied" data-unit="Unit 105">
                                            <h5>Unit K-1</h5>
                                            <div class="occupant-name">Eve Black</div>
                                            <button type="button" class="btn btn-primary view-button"
                                                data-bs-toggle="modal" data-bs-target="#viewModal"
                                                onclick="fillModal('Occupied', 'Eve Black', 'eve.black', 'eve.black@example.com', '5566778899')">View</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="unit occupied" data-unit="Unit 104">
                                            <h5>Unit F-4</h5>
                                            <div class="occupant-name">Eve Black</div>
                                            <button type="button" class="btn btn-primary view-button"
                                                data-bs-toggle="modal" data-bs-target="#viewModal"
                                                onclick="fillModal('Occupied', 'Eve Black', 'eve.black', 'eve.black@example.com', '5566778899')">View</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="unit occupied" data-unit="Unit 103">
                                            <h5>Unit F-3</h5>
                                            <div class="occupant-name">Frank Blue</div>
                                            <button type="button" class="btn btn-primary view-button"
                                                data-bs-toggle="modal" data-bs-target="#viewModal"
                                                onclick="fillModal('Occupied', 'Frank Blue', 'frank.blue', 'frank.blue@example.com', '6677889900')">View</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="unit occupied" data-unit="Unit 102">
                                            <h5>Unit F-2</h5>
                                            <div class="occupant-name">Grace Pink</div>
                                            <i class="bi bi-exclamation-triangle-fill warning-icon"></i>
                                            <div class="warning-tooltip-text">Upcoming Due Date</div>
                                            <button type="button" class="btn btn-primary view-button"
                                                data-bs-toggle="modal" data-bs-target="#viewModal"
                                                onclick="fillModal('Occupied', 'Grace Pink', 'grace.pink', 'grace.pink@example.com', '7788990011')">View</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="unit available" data-unit="Unit 101">
                                            <h5>Unit F-1</h5>
                                            <button type="button" class="btn btn-primary view-button"
                                                data-bs-toggle="modal" data-bs-target="#viewModal"
                                                onclick="fillModal('Available', '', '', '', '')">View</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Add Rentee Button -->
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#addRenteeModal">Add Rentee</button>
                                <!-- End Lease Button -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#endLeaseModal">End Lease</button>
                            </div>
                            <!-- QR Code Upload Section -->
                            <h4 class="card-title"><strong>QR Code Upload</strong></h4>
                            <div class="mb-3">
                                <input type="file" class="form-control" id="qrCodeUpload" accept="image/*" required>
                                <small class="form-text text-muted">Upload a QR code image for payment (e.g., PNG,
                                    JPG).</small>
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
                    <h5 class="modal-title" id="viewModalLabel">View Rentee Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="unitStatus" class="form-label"><strong>Unit Status</strong></label>
                            <p id="unitStatusText"></p>
                        </div>
                        <div class="mb-3">
                            <label for="renteeName" class="form-label"><strong>Rentee Name</strong></label>
                            <p id="renteeNameText"></p>
                        </div>
                        <div class="mb-3">
                            <label for="facebookName" class="form-label"><strong>Facebook Name</strong></label>
                            <p id="facebookNameText"></p>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label"><strong>Email</strong></label>
                            <p id="emailText"></p>
                        </div>
                        <div class="mb-3">
                            <label for="phoneNumber" class="form-label"><strong>Phone Number</strong></label>
                            <p id="phoneNumberText"></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Rentee Modal -->
    <div class="modal fade" id="addRenteeModal" tabindex="-1" aria-labelledby="addRenteeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRenteeModalLabel">Add Rentee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addRenteeForm">
                        <div class="mb-3">
                            <label for="newRenteeName" class="form-label"><strong>Rentee Name</strong></label>
                            <input type="text" class="form-control" id="newRenteeName" required>
                        </div>
                        <div class="mb-3">
                            <label for="newFacebookName" class="form-label"><strong>Facebook Name</strong></label>
                            <input type="text" class="form-control" id="newFacebookName" required>
                        </div>
                        <div class="mb-3">
                            <label for="newEmail" class="form-label"><strong>Email</strong></label>
                            <input type="email" class="form-control" id="newEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="newPhoneNumber" class="form-label"><strong>Phone Number</strong></label>
                            <input type="text" class="form-control" id="newPhoneNumber" required>
                        </div>
                        <div class="mb-3">
                            <label for="newUnit" class="form-label"><strong>Unit</strong></label>
                            <select class="form-select" id="newUnit" required>
                                <!-- Options will be populated dynamically -->
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Add Rentee</button>
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
                    <form id="endLeaseForm">
                        <div class="mb-3">
                            <label for="endLeaseUnit" class="form-label"><strong>Unit</strong></label>
                            <select class="form-select" id="endLeaseUnit" required>
                                <!-- Options will be populated dynamically -->
                            </select>
                        </div>
                        <button type="submit" class="btn btn-danger">End Lease</button>
                    </form>
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

        function fillModal(unitStatus, renteeName, facebookName, email, phoneNumber) {
            document.getElementById('unitStatusText').innerText = unitStatus;
            document.getElementById('renteeNameText').innerText = renteeName;
            document.getElementById('facebookNameText').innerText = facebookName;
            document.getElementById('emailText').innerText = email;
            document.getElementById('phoneNumberText').innerText = phoneNumber;
        }

        document.getElementById('addRenteeForm').addEventListener('submit', function (event) {
            event.preventDefault();
            const newRenteeName = document.getElementById('newRenteeName').value;
            const newFacebookName = document.getElementById('newFacebookName').value;
            const newEmail = document.getElementById('newEmail').value;
            const newPhoneNumber = document.getElementById('newPhoneNumber').value;
            const newUnit = document.getElementById('newUnit').value;

            // Here you would typically send this data to your server to update the database
            console.log('Adding Rentee:', {
                renteeName: newRenteeName,
                facebookName: newFacebookName,
                email: newEmail,
                phoneNumber: newPhoneNumber,
                unit: newUnit
            });

            // Close the modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('addRenteeModal'));
            modal.hide();
        });

        document.getElementById('endLeaseForm').addEventListener('submit', function (event) {
            event.preventDefault();
            const endLeaseUnit = document.getElementById('endLeaseUnit').value;

            // Here you would typically send this data to your server to update the database
            console.log('Ending Lease for Unit:', endLeaseUnit);

            // Close the modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('endLeaseModal'));
            modal.hide();
        });

        // Populate available units in the Add Rentee modal
        const addRenteeModal = document.getElementById('addRenteeModal');
        addRenteeModal.addEventListener('show.bs.modal', function (event) {
            const newUnitSelect = document.getElementById('newUnit');
            newUnitSelect.innerHTML = ''; // Clear existing options
            document.querySelectorAll('.unit.available').forEach(unit => {
                const option = document.createElement('option');
                option.value = unit.getAttribute('data-unit');
                option.textContent = unit.getAttribute('data-unit');
                newUnitSelect.appendChild(option);
            });
        });

        // Populate occupied units in the End Lease modal
        const endLeaseModal = document.getElementById('endLeaseModal');
        endLeaseModal.addEventListener('show.bs.modal', function (event) {
            const endLeaseUnitSelect = document.getElementById('endLeaseUnit');
            endLeaseUnitSelect.innerHTML = ''; // Clear existing options
            document.querySelectorAll('.unit.occupied').forEach(unit => {
                const option = document.createElement('option');
                option.value = unit.getAttribute('data-unit');
                option.textContent = unit.getAttribute('data-unit');
                endLeaseUnitSelect.appendChild(option);
            });
        });
    </script>
</body>

</html>