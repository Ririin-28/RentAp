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
        <?php include '../rentor_sidebar.php'; ?>
        <!-- Main Content -->
        <div class="main-content container-fluid g-0">
            <!-- Title Container -->
            <div class="title-container">
                <img src="../images/RentAp_full.png" alt="RentAp Icon" class="rentap_Icon">
                <h1>Rentee Maintenance Duration</h1>
            </div>

            <!-- Content Container -->
            <div class="content-container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><strong>Maintenance Duration</strong></h4>
                                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addRenteeModal">Add Rentee</button>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Rentee ID</th>
                                                <th>Full Name</th>
                                                <th>Unit Number</th>
                                                <th>Move-In Date</th>
                                                <th>Remaining Days</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>John Doe</td>
                                                <td>101</td>
                                                <td>2025-01-01</td>
                                                <td>30</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Jane Smith</td>
                                                <td>102</td>
                                                <td>2025-02-01</td>
                                                <td>60</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Alice Johnson</td>
                                                <td>103</td>
                                                <td>2025-03-01</td>
                                                <td>90</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Bob Brown</td>
                                                <td>104</td>
                                                <td>2025-04-01</td>
                                                <td>120</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Carol White</td>
                                                <td>105</td>
                                                <td>2025-05-01</td>
                                                <td>150</td>
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

    <!-- Add Rentee Modal -->
    <div class="modal fade" id="addRenteeModal" tabindex="-1" aria-labelledby="addRenteeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRenteeModalLabel">Add Rentee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addRenteeForm">
                        <div class="mb-3">
                            <label for="renteeID" class="form-label">Rentee ID</label>
                            <input type="text" class="form-control" id="renteeID" required>
                        </div>
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullName" required>
                        </div>
                        <div class="mb-3">
                            <label for="unitNumber" class="form-label">Unit Number</label>
                            <input type="text" class="form-control" id="unitNumber" required>
                        </div>
                        <div class="mb-3">
                            <label for="moveInDate" class="form-label">Move-In Date</label>
                            <input type="date" class="form-control" id="moveInDate" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Rentee</button>
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

        document.getElementById('addRenteeForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const renteeID = document.getElementById('renteeID').value;
            const fullName = document.getElementById('fullName').value;
            const unitNumber = document.getElementById('unitNumber').value;
            const moveInDate = document.getElementById('moveInDate').value;

            // Calculate remaining days
            const moveInDateObj = new Date(moveInDate);
            const currentDate = new Date();
            const timeDiff = currentDate.getTime() - moveInDateObj.getTime();
            const daysDiff = Math.floor(timeDiff / (1000 * 3600 * 24));
            const remainingDays = 60 - daysDiff;

            const table = document.querySelector('table tbody');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>${renteeID}</td>
                <td>${fullName}</td>
                <td>${unitNumber}</td>
                <td>${moveInDate}</td>
                <td>${remainingDays > 0 ? remainingDays : 0}</td>
            `;
            table.appendChild(newRow);

            // Close the modal
            const addRenteeModal = new bootstrap.Modal(document.getElementById('addRenteeModal'));
            addRenteeModal.hide();

            // Reset the form
            document.getElementById('addRenteeForm').reset();
        });
    </script>
</body>

</html>