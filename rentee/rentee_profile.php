<?php
session_start();
include '../db_connection.php';

if (!isset($_SESSION['p_first_name']) || !isset($_SESSION['p_unit'])) {
    header('Location: ../rentee/rentee_login.php');
    exit();
}


$p_first_name = $_SESSION['p_first_name'];
$p_unit = $_SESSION['p_unit'];

$query = "SELECT * FROM rentee WHERE first_name = ? AND (unit = ? OR unit IS NULL)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $p_first_name, $p_unit);
$stmt->execute();
$result = $stmt->get_result();
$rentee = $result->fetch_assoc();

if (!$rentee) {
    echo "No matching rentee found.";
    exit();
}

$stmt->close();

$payment_query = "SELECT date, amount, status FROM payment_history WHERE rentee_id = ?";
$stmt2 = $conn->prepare($payment_query);
$stmt2->bind_param("i", $rentee['rentee_id']);
$stmt2->execute();
$payments = $stmt2->get_result();
$stmt2->close();
$conn->close();
?>

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
<div class="wrapper">
    <?php include '../rentee_sidebar.php'; ?>

    <div class="main-content container-fluid g-0">
        <div class="title-container">
            <img src="../images/RentAp_full.png" alt="RentAp Icon" class="rentap_Icon">
            <h1>Rentee Profile</h1>
        </div>

        <div class="content-container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mb-5">
                                    <h4 class="card-title"><strong>Unit Number</strong></h4>
                                    <p class="card-text"><?= htmlspecialchars($rentee['unit']) ?></p>
                                </div>

                                <div class="col-12 mb-3">
                                    <h3 class="card-title"><strong>Personal Information</strong></h3>
                                </div>

                                <div id="profileDisplay">
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <h4 class="card-title"><strong>Full Name</strong></h4>
                                            <p class="card-text">
                                                <?= htmlspecialchars($rentee['first_name'] . ' ' . $rentee['last_name']) ?>
                                            </p>

                                            <h4 class="card-title"><strong>Facebook Name</strong></h4>
                                            <p class="card-text"><?= htmlspecialchars($rentee['facebook_profile']) ?></p>
                                        </div>

                                        <div class="col-12 col-md-4">
                                            <h4 class="card-title"><strong>Phone Number</strong></h4>
                                            <p class="card-text"><?= htmlspecialchars($rentee['phone_number']) ?></p>

                                            <h4 class="card-title"><strong>Email</strong></h4>
                                            <p class="card-text"><?= htmlspecialchars($rentee['email']) ?></p>
                                        </div>

                                        <div class="col-12 col-md-4 d-flex justify-content-end align-items-start">
                                            <button type="button" class="btn btn-primary" id="editProfileButton">Update Profile</button>
                                        </div>
                                    </div>
                                </div>

                                <form id="profileForm" class="d-none mt-4">
                                    <input type="hidden" id="rentee_id" value="<?= $rentee['rentee_id'] ?>">
                                    <input type="hidden" id="unit" value="<?= htmlspecialchars($rentee['unit']) ?>">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>First Name:</label>
                                            <input type="text" id="first_name" class="form-control"
                                                   value="<?= htmlspecialchars($rentee['first_name']) ?>" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label>Last Name:</label>
                                            <input type="text" id="last_name" class="form-control"
                                                   value="<?= htmlspecialchars($rentee['last_name']) ?>" required>
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label>Facebook Profile:</label>
                                            <input type="text" id="facebook_profile" class="form-control"
                                                   value="<?= htmlspecialchars($rentee['facebook_profile']) ?>" required>
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label>Phone Number:</label>
                                            <input type="text" id="phone_number" class="form-control"
                                                   value="<?= htmlspecialchars($rentee['phone_number']) ?>" required>
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label>Email:</label>
                                            <input type="email" id="email" class="form-control"
                                                   value="<?= htmlspecialchars($rentee['email']) ?>" required>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-success mt-4">Save Changes</button>
                                    <button type="button" class="btn btn-secondary mt-4" id="cancelButton">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="payment-container mt-4">
                <h4 class="card-title mb-4"><strong>Payment History</strong></h4>
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while ($payment = $payments->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($payment['date']) ?></td>
                            <td>₱<?= htmlspecialchars($payment['amount']) ?></td>
                            <td>
                                <span class="badge <?= $payment['status'] === 'Paid' ? 'bg-success' : 'bg-warning text-dark' ?>">
                                    <?= htmlspecialchars($payment['status']) ?>
                                </span>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal" tabindex="-1" id="successModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Success</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Profile updated successfully!</p>
            </div>
        </div>
    </div>
</div>

<script>
    const hamBurger = document.querySelector(".toggle-btn");
    hamBurger.addEventListener("click", function () {
        document.querySelector("#sidebar").classList.toggle("expand");
    });

$(document).ready(function () {
    $('#editProfileButton').click(() => {
        $('#profileDisplay').hide();
        $('#profileForm').removeClass('d-none');
    });

    $('#cancelButton').click(() => {
        $('#profileForm').addClass('d-none');
        $('#profileDisplay').show();
    });

    $('#profileForm').submit(function (e) {
        e.preventDefault();

        const renteeData = {
            rentee_id: $('#rentee_id').val(),
            unit: $('#unit').val(), 
            pin: $('#pin').val(), 
            first_name: $('#first_name').val(),
            last_name: $('#last_name').val(),
            facebook_profile: $('#facebook_profile').val(),
            phone_number: $('#phone_number').val(),
            email: $('#email').val()
        };

        $.ajax({
            url: '../update_profile.php',
            type: 'POST',
            data: renteeData,
            success: function (response) {
                if (response.success) {
                    $('#successModal').modal('show');
                    setTimeout(() => location.reload(), 2000);
                } else {
                    alert('Failed to update profile: ' + response.message);
                }
            },
            error: function () {
                alert('An error occurred while updating the profile.');
            }
        });
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
