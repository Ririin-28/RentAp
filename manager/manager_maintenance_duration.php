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
        <?php include '../manager_sidebar.php'; ?>
        <!-- Main Content -->
        <div class="main-content container-fluid g-0">
            <!-- Title Container -->
            <div class="title-container">
                <img src="../images/RentAp_full.png" alt="RentAp Icon" class="rentap_Icon">
                <h1>Maintenance Agreement Duration</h1>
            </div>

            <!-- Content Container -->
            <div class="content-container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4"><strong>Maintenance Duration</strong></h4>
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
                                            <?php
                                            include '../db_connection.php';

                                            $query = "SELECT ad.rentee_id, CONCAT(r.first_name, ' ', r.last_name) AS full_name, ad.unit, ad.move_in_date, ad.remaining_days
                                                      FROM Agreement_Duration ad
                                                      JOIN Rentee r ON ad.rentee_id = r.rentee_id";
                                            $result = $conn->query($query);

                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>
                                                            <td>{$row['rentee_id']}</td>
                                                            <td>{$row['full_name']}</td>
                                                            <td>{$row['unit']}</td>
                                                            <td>{$row['move_in_date']}</td>
                                                            <td>{$row['remaining_days']}</td>
                                                          </tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='5' class='text-center'>No rentee data found.</td></tr>";
                                            }
                                            ?>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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

            // Here you would typically make an AJAX call to insert the data into the database
            // For now, we'll just simulate it by updating the UI

            // Calculate remaining days
            const moveInDateObj = new Date(moveInDate);
            const currentDate = new Date();
            const timeDiff = currentDate.getTime() - moveInDateObj.getTime();
            const daysDiff = Math.floor(timeDiff / (1000 * 3600 * 24));
            const remainingDays = 62 - daysDiff; // Assuming default is 62 days

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
