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
        <!-- Main Content -->
        <div class="main-content container-fluid g-0">
            <!-- Title Container -->
            <div class="title-container">
                <img src="../images/RentAp_full.png" alt="Dashboard Icon" class="title_icon">
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
                                    <!-- First Column -->
                                    <div class="col-12 mb-3">
                                    <h3 class="card-title"><strong>Personal Information</strong></h3>
                                    </div>
                                    <div class="col-12 col-md-4">
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
            </div>

            <!-- Payment History Section -->
            <div class="row mt-4">
                <div class="col-12">
                    <h4 class="card-title"><strong>Payment History</strong></h4>
                    <table class="table table-striped">
                        <thead>
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
                                <td>Paid</td>
                            </tr>
                            <tr>
                                <td>February 15, 2025</td>
                                <td>$500</td>
                                <td>Paid</td>
                            </tr>
                            <tr>
                                <td>March 15, 2025</td>
                                <td>$500</td>
                                <td>Pending</td>
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

        const fullNameText = document.getElementById('fullNameText');
        const fullNameInput = document.getElementById('fullNameInput');
        const facebookNameText = document.getElementById('facebookNameText');
        const facebookNameInput = document.getElementById('facebookNameInput');
        const phoneNumberText = document.getElementById('phoneNumberText');
        const phoneNumberInput = document.getElementById('phoneNumberInput');
        const emailText = document.getElementById('emailText');
        const emailInput = document.getElementById('emailInput');

        editProfileButton.addEventListener('click', function () {
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
            fullNameText.classList.remove('d-none');
            fullNameInput.classList.add('d-none');
            facebookNameText.classList.remove('d-none');
            facebookNameInput.classList.add('d-none');
            phoneNumberText.classList.remove('d-none');
            phoneNumberInput.classList.add('d-none');
            emailText.classList.remove('d-none');
            emailInput.classList.add('d-none');

            editProfileButton.classList.remove('d-none');
            cancelButton.classList.add('d-none');
            saveButton.classList.add('d-none');
        });

        saveButton.addEventListener('click', function () {
            fullNameText.textContent = fullNameInput.value;
            facebookNameText.textContent = facebookNameInput.value;
            phoneNumberText.textContent = phoneNumberInput.value;
            emailText.textContent = emailInput.value;

            fullNameText.classList.remove('d-none');
            fullNameInput.classList.add('d-none');
            facebookNameText.classList.remove('d-none');
            facebookNameInput.classList.add('d-none');
            phoneNumberText.classList.remove('d-none');
            phoneNumberInput.classList.add('d-none');
            emailText.classList.remove('d-none');
            emailInput.classList.add('d-none');

            editProfileButton.classList.remove('d-none');
            cancelButton.classList.add('d-none');
            saveButton.classList.add('d-none');

            // Add your AJAX code here to save the changes to the server
        });
    </script>
</body>

</html>