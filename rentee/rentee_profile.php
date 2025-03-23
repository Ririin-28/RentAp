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
        .payment-container {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 30px;
        }

        .payment-container h4 {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .payment-container table {
            border-radius: 8px;
            overflow: hidden;
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
                <h1>Rentee Profile</h1>
            </div>

            <!-- Content Container -->
            <div class="content-container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 mb-5">
                                        <h4 class="card-title"><strong>Unit Number</strong></h4>
                                        <p class="card-text">Unit 101</p>
                                    </div>
                                    
                                    <!-- Personal Information -->
                                    <div class="col-12 mb-3">
                                        <h3 class="card-title"><strong>Personal Information</strong></h3>
                                    </div>

                                    <!-- First Column -->
                                    <div class="col-12 col-md-4">
                                    <div class="col-12 mb-4">
                                                <h4 class="card-title"><strong>Rentee ID</strong></h4>
                                                <p class="card-text" id="renteeIDText">10001</p>
                                                <input type="text" class="form-control d-none" id="renteeIDInput" value="10001">
                                            </div>
                                        <div class="row">
                                            <div class="col-12 mb-4">
                                                <h4 class="card-title"><strong>Full Name</strong></h4>
                                                <p class="card-text" id="fullNameText">Juan Dela Cruz</p>
                                                <input type="text" class="form-control d-none" id="fullNameInput" value="Juan Dela Cruz">
                                            </div>
                                            <div class="col-12 mb-4">
                                                <h4 class="card-title"><strong>Facebook Name</strong></h4>
                                                <p class="card-text" id="facebookNameText">JD Cruz</p>
                                                <input type="text" class="form-control d-none" id="facebookNameInput" value="JD Cruz">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Second Column -->
                                    <div class="col-12 col-md-4">
                                        <div class="row">
                                            <div class="col-12 mb-4">
                                                <h4 class="card-title"><strong>Phone Number</strong></h4>
                                                <p class="card-text" id="phoneNumberText">0912-345-6789</p>
                                                <input type="tel" class="form-control d-none" id="phoneNumberInput" value="0912-345-6789">
                                            </div>
                                            <div class="col-12 mb-4">
                                                <h4 class="card-title"><strong>Email</strong></h4>
                                                <p class="card-text" id="emailText">juandelacruz@gmail.com</p>
                                                <input type="email" class="form-control d-none" id="emailInput" value="juandelacruz@gmail.com">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Third Column -->
                                    <div class="col-12 col-md-4">
                                        <button type="button" class="btn btn-primary" id="editProfileButton">Update Profile</button>
                                        <button type="button" class="btn btn-secondary d-none" id="cancelButton">Cancel</button>
                                        <button type="button" class="btn btn-primary d-none" id="saveButton">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment History Section -->
                <div class="payment-container">
                    <h4 class="card-title"><strong>Payment History</strong></h4>
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>January 15, 2025</td>
                                <td>$500</td>
                                <td><span class="badge bg-success">Paid</span></td>
                            </tr>
                            <tr>
                                <td>February 15, 2025</td>
                                <td>$500</td>
                                <td><span class="badge bg-success">Paid</span></td>
                            </tr>
                            <tr>
                                <td>March 15, 2025</td>
                                <td>$500</td>
                                <td><span class="badge bg-warning text-dark">Pending</span></td>
                            </tr>
                        </tbody>
                    </table>
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

        const editProfileButton = document.getElementById('editProfileButton');
        const cancelButton = document.getElementById('cancelButton');
        const saveButton = document.getElementById('saveButton');

        const renteeIDText = document.getElementById('renteeIDText');
        const renteeIDInput = document.getElementById('renteeIDInput');
        const fullNameText = document.getElementById('fullNameText');
        const fullNameInput = document.getElementById('fullNameInput');
        const facebookNameText = document.getElementById('facebookNameText');
        const facebookNameInput = document.getElementById('facebookNameInput');
        const phoneNumberText = document.getElementById('phoneNumberText');
        const phoneNumberInput = document.getElementById('phoneNumberInput');
        const emailText = document.getElementById('emailText');
        const emailInput = document.getElementById('emailInput');

        editProfileButton.addEventListener('click', function () {
            renteeIDText.classList.add('d-none');
            renteeIDInput.classList.remove('d-none');
            fullNameText.classList.add('d-none');
            fullNameInput.classList.remove('d-none');
            facebookNameText.classList.add('d-none');
            facebookNameInput.classList.remove('d-none');
            phoneNumberText.classList.add('d-none');
            phoneNumberInput.classList.remove('d-none');
            emailText.classList.add('d-none');
            emailInput.classList.remove('d-none');

            editProfileButton.classList.add('d-none');
            cancelButton.classList.remove('d-none');
            saveButton.classList.remove('d-none');
        });

        cancelButton.addEventListener('click', function () {
            window.location.reload();
        });

        saveButton.addEventListener('click', function () {
            alert("Profile updated successfully!");
        });
    </script>
</body>

</html>
