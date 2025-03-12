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
            background-color: #d4edda;
        }

        .available {
            background-color: #fff3cd;
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

        .warning-icon:hover + .tooltip-text {
            display: block;
        }

        .danger-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            color:rgb(252, 0, 0);
            cursor: pointer;
        }

        .danger-tooltip-text {
            display: none;
            position: absolute;
            top: 30px;
            right: 10px;
            background-color:rgb(255, 0, 0);
            color: #fff;
            padding: 5px;
            border-radius: 5px;
            font-size: 12px;
        }

        .danger-icon:hover + .danger-tooltip-text {
            display: block;
        }

        /* Legend Styles */
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
        <?php include '../rentor_sidebar.php'; ?>
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
                                <div class="legend">
                                    <div class="legend-item">
                                        <div class="legend-color" style="background-color: #d4edda;"></div>
                                        <div class="legend-text">Occupied</div>
                                    </div>
                                    <div class="legend-item">
                                        <div class="legend-color" style="background-color: #fff3cd;"></div>
                                        <div class="legend-text">Available</div>
                                    </div>
                                    <div class="legend-item">
                                        <div class="legend-color" style="background-color: #f8d7da;"></div>
                                        <div class="legend-text">Under Maintenance</div>
                                    </div>
                                </div>

                                <!-- Rentee Grid View -->
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <div class="unit occupied">
                                            <h5>Unit 112</h5>
                                            <div class="occupant-name">John Doe</div>
                                            <i class="bi bi-exclamation-triangle-fill danger-icon"></i>
                                            <div class="danger-tooltip-text">Overdue Date</div>
                                            <button type="button" class="btn btn-primary view-button" data-bs-toggle="modal" data-bs-target="#viewModal" onclick="fillModal('Occupied', 'John Doe', 'john.doe', 'john.doe@example.com', '1234567890')">View</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="unit occupied">
                                            <h5>Unit 111</h5>
                                            <div class="occupant-name">Jane Smith</div>
                                            <button type="button" class="btn btn-primary view-button" data-bs-toggle="modal" data-bs-target="#viewModal" onclick="fillModal('Occupied', 'Jane Smith', 'jane.smith', 'jane.smith@example.com', '0987654321')">View</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="unit available">
                                            <h5>Unit 110</h5>
                                            <button type="button" class="btn btn-primary view-button" data-bs-toggle="modal" data-bs-target="#viewModal" onclick="fillModal('Available', '', '', '', '')">View</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="unit occupied">
                                            <h5>Unit 109</h5>
                                            <div class="occupant-name">Alice Johnson</div>
                                            <i class="bi bi-exclamation-triangle-fill warning-icon"></i>
                                            <div class="tooltip-text">Upcoming Due Date</div>
                                            <button type="button" class="btn btn-primary view-button" data-bs-toggle="modal" data-bs-target="#viewModal" onclick="fillModal('Occupied', 'Alice Johnson', 'alice.johnson', 'alice.johnson@example.com', '1122334455')">View</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="unit occupied">
                                            <h5>Unit 108</h5>
                                            <div class="occupant-name">Bob Brown</div>
                                            <button type="button" class="btn btn-primary view-button" data-bs-toggle="modal" data-bs-target="#viewModal" onclick="fillModal('Occupied', 'Bob Brown', 'bob.brown', 'bob.brown@example.com', '2233445566')">View</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="unit occupied">
                                            <h5>Unit 107</h5>
                                            <div class="occupant-name">Carol White</div>
                                            <button type="button" class="btn btn-primary view-button" data-bs-toggle="modal" data-bs-target="#viewModal" onclick="fillModal('Occupied', 'Carol White', 'carol.white', 'carol.white@example.com', '3344556677')">View</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="unit occupied">
                                            <h5>Unit 106</h5>
                                            <div class="occupant-name">Dave Green</div>
                                            <button type="button" class="btn btn-primary view-button" data-bs-toggle="modal" data-bs-target="#viewModal" onclick="fillModal('Occupied', 'Dave Green', 'dave.green', 'dave.green@example.com', '4455667788')">View</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="unit maintenance">
                                            <h5>Unit 105</h5>
                                            <button type="button" class="btn btn-primary view-button" data-bs-toggle="modal" data-bs-target="#viewModal" onclick="fillModal('Under Maintenance', '', '', '', '')">View</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="unit occupied">
                                            <h5>Unit 104</h5>
                                            <div class="occupant-name">Eve Black</div>
                                            <button type="button" class="btn btn-primary view-button" data-bs-toggle="modal" data-bs-target="#viewModal" onclick="fillModal('Occupied', 'Eve Black', 'eve.black', 'eve.black@example.com', '5566778899')">View</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="unit occupied">
                                            <h5>Unit 103</h5>
                                            <div class="occupant-name">Frank Blue</div>
                                            <button type="button" class="btn btn-primary view-button" data-bs-toggle="modal" data-bs-target="#viewModal" onclick="fillModal('Occupied', 'Frank Blue', 'frank.blue', 'frank.blue@example.com', '6677889900')">View</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="unit occupied">
                                            <h5>Unit 102</h5>
                                            <div class="occupant-name">Grace Pink</div>
                                            <i class="bi bi-exclamation-triangle-fill warning-icon"></i>
                                            <div class="tooltip-text">Upcoming Due Date</div>
                                            <button type="button" class="btn btn-primary view-button" data-bs-toggle="modal" data-bs-target="#viewModal" onclick="fillModal('Occupied', 'Grace Pink', 'grace.pink', 'grace.pink@example.com', '7788990011')">View</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="unit available">
                                            <h5>Unit 101</h5>
                                            <button type="button" class="btn btn-primary view-button" data-bs-toggle="modal" data-bs-target="#viewModal" onclick="fillModal('Available', '', '', '', '')">View</button>
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
    <!-- Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">View Rentee Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="unitStatus" class="form-label">Unit Status</label>
                            <p id="unitStatusText"></p>
                        </div>
                        <div class="mb-3">
                            <label for="renteeName" class="form-label">Rentee Name</label>
                            <p id="renteeNameText"></p>
                        </div>
                        <div class="mb-3">
                            <label for="facebookName" class="form-label">Facebook Name</label>
                            <p id="facebookNameText"></p>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <p id="emailText"></p>
                        </div>
                        <div class="mb-3">
                            <label for="phoneNumber" class="form-label">Phone Number</label>
                            <p id="phoneNumberText"></p>
                        </div>
                    </form>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-primary" onclick="enableEdit()">Edit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                    <div>
                        <button type="button" class="btn btn-danger" onclick="endContract()">End Contract</button>
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

        function fillModal(unitStatus, renteeName, facebookName, email, phoneNumber) {
            document.getElementById('unitStatusText').innerText = unitStatus;
            document.getElementById('renteeNameText').innerText = renteeName;
            document.getElementById('facebookNameText').innerText = facebookName;
            document.getElementById('emailText').innerText = email;
            document.getElementById('phoneNumberText').innerText = phoneNumber;
        }

        function enableEdit() {
            document.getElementById('unitStatusText').innerHTML = `<select class="form-select" id="unitStatus" required>
                <option value="Occupied">Occupied</option>
                <option value="Available">Available</option>
                <option value="Under Maintenance">Under Maintenance</option>
            </select>`;
            document.getElementById('renteeNameText').innerHTML = `<input type="text" class="form-control" id="renteeName" required>`;
            document.getElementById('facebookNameText').innerHTML = `<input type="text" class="form-control" id="facebookName">`;
            document.getElementById('emailText').innerHTML = `<input type="email" class="form-control" id="email" required>`;
            document.getElementById('phoneNumberText').innerHTML = `<input type="text" class="form-control" id="phoneNumber" required>`;
        }

        function endContract() {
            // Add your logic to end the contract here
            alert('Contract ended successfully!');
        }
    </script>
</body>

</html>
