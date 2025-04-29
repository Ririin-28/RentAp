<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification Management</title>
    <link rel="icon" href="../images/RentAp_logo.png" type="image/x-icon">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../main.css">
</head>

<body>
    <div class="wrapper">
        <?php include '../manager_sidebar.php'; ?>
        <?php
        include '../db_connection.php';

        // Pending Payments
        $query = "SELECT R.rentee_id, CONCAT(R.first_name, ' ', R.last_name) AS full_name, R.email, P.due_date, P.status 
                  FROM rentee R 
                  JOIN pending_payments P ON R.rentee_id = P.rentee_id 
                  WHERE P.status = 'Pending'";
        $result = $conn->query($query);

        // Rentee Payments
        $paymentsQuery = "
            SELECT RP.rentee_id, CONCAT(R.first_name, ' ', R.last_name) AS full_name, RP.payment_picture, RP.date AS payment_date, P.due_date
            FROM rentee_payment RP
            JOIN rentee R ON RP.rentee_id = R.rentee_id
            JOIN pending_payments P ON RP.rentee_id = P.rentee_id
        ";
        $paymentsResult = $conn->query($paymentsQuery);
        ?>
        <!-- Main Content -->
        <div class="main-content container-fluid g-0">
            <!-- Title Container -->
            <div class="title-container">
                <img src="../images/RentAp_full.png" alt="RentAp Icon" class="rentap_Icon">
                <h1>Notification Management</h1>
            </div>

            <!-- Notification for Payment Section -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4"><strong>Notification for Payment</strong></h4>
                    <form id="bulk-reminder-form">
                        <div class="table-responsive">
                            <table class="table" id="notificationTable">
                                <thead>
                                    <tr>
                                        <th>Select</th>
                                        <th>Rentee ID</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Due Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $result->fetch_assoc()) { ?>
                                        <tr>
                                            <td><input type="checkbox" class="select-row" name="rentees[]" value="<?php echo htmlspecialchars(json_encode($row)); ?>"></td>
                                            <td><?php echo $row['rentee_id']; ?></td>
                                            <td><?php echo $row['full_name']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['due_date']; ?></td>
                                            <td><span class="badge bg-warning"><?php echo $row['status']; ?></span></td>
                                            <td>
                                                <form class="send-reminder-form">
                                                    <input type="hidden" name="rentee_id" value="<?php echo $row['rentee_id']; ?>">
                                                    <input type="hidden" name="email" value="<?php echo $row['email']; ?>">
                                                    <input type="hidden" name="due_date" value="<?php echo $row['due_date']; ?>">
                                                    <button type="button" class="btn btn-primary btn-sm send-reminder-btn">
                                                        <i class="bi bi-envelope"></i> Send Reminder
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <button type="button" id="bulkSendBtn" class="btn btn-success mt-3">Send Bulk Reminders</button>
                    </form>
                </div>
            </div>

            <!-- Rentee Payments Section -->
            <div class="card mt-4">
                <div class="card-body">
                    <h4 class="card-title mb-4"><strong>Rentee Payments</strong></h4>
                    <div class="table-responsive">
                        <table class="table table-borderless table-sm" id="renteePaymentsTable">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">Rentee ID</th>
                                    <th style="width: 20%;">Full Name</th>
                                    <th style="width: 20%;">Payment Picture</th>
                                    <th style="width: 15%;">Payment Date</th>
                                    <th style="width: 15%;">Due Date</th>
                                    <th style="width: 20%;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $paymentsResult->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $row['rentee_id']; ?></td>
                                        <td><?php echo $row['full_name']; ?></td>
                                        <td>
                                            <a href="#" class="view-picture" data-picture="../uploads/<?php echo $row['payment_picture']; ?>">
                                                <?php echo $row['payment_picture']; ?>
                                            </a>
                                        </td>
                                        <td><?php echo $row['payment_date']; ?></td>
                                        <td><?php echo $row['due_date']; ?></td>
                                        <td>
                                            <form class="send-receipt-form d-inline">
                                                <input type="hidden" name="rentee_id" value="<?php echo $row['rentee_id']; ?>">
                                                <input type="hidden" name="date" value="<?php echo $row['payment_date']; ?>">
                                                <button type="button" class="btn btn-secondary btn-sm send-receipt-btn">Send Receipt</button>
                                            </form>
                                            <form class="mark-as-paid-form d-inline">
                                                <input type="hidden" name="rentee_id" value="<?php echo $row['rentee_id']; ?>">
                                                <input type="hidden" name="due_date" value="<?php echo $row['due_date']; ?>">
                                                <button type="button" class="btn btn-success btn-sm mark-as-paid-btn">Mark as Paid</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Viewing Picture -->
    <div class="modal fade" id="pictureModal" tabindex="-1" aria-labelledby="pictureModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pictureModalLabel">Payment Picture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalPicture" src="" alt="Payment Picture" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <!-- Response Modal -->
    <div class="modal fade" id="responseModal" tabindex="-1" aria-labelledby="responseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="responseModalLabel">
                        <i class="bi bi-info-circle"></i> Notification
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div id="responseMessage" class="fs-5"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="responseModal" tabindex="-1" aria-labelledby="responseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="responseModalLabel">
                        <i class="bi bi-info-circle"></i> Notification
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body text-center">
                    <div id="responseMessage" class="fs-5"></div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmMarkAsPaidModal" tabindex="-1" aria-labelledby="confirmMarkAsPaidLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="confirmMarkAsPaidLabel">
                        <i class="bi bi-exclamation-circle"></i> Confirm Action
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    Are you sure you want to mark this payment as paid?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="confirmMarkAsPaidBtn" class="btn btn-success">Yes, Mark as Paid</button>
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

        // View picture in modal
        document.querySelectorAll('.view-picture').forEach(link => {
            link.addEventListener('click', function (event) {
                event.preventDefault();
                const pictureSrc = this.getAttribute('data-picture');
                const modalPicture = document.getElementById('modalPicture');
                modalPicture.src = pictureSrc;

                const pictureModal = new bootstrap.Modal(document.getElementById('pictureModal'));
                pictureModal.show();
            });
        });

        // Individual Reminder
        document.querySelectorAll('.send-reminder-btn').forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();

                const form = this.closest('.send-reminder-form');
                const formData = new FormData(form);

                const originalText = this.innerHTML;
                this.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...';
                this.disabled = true;

                fetch('send_notifications.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    const modal = new bootstrap.Modal(document.getElementById('responseModal'));
                    const modalMessage = document.getElementById('responseMessage');

                    if (data.success) {
                        modalMessage.textContent = data.message;
                        modalMessage.className = 'text-success';
                    } else {
                        modalMessage.textContent = data.message;
                        modalMessage.className = 'text-danger';
                    }

                    modal.show();
                })
                .catch(error => {
                    console.error('Error:', error);
                    const modal = new bootstrap.Modal(document.getElementById('responseModal'));
                    const modalMessage = document.getElementById('responseMessage');
                    modalMessage.textContent = 'An error occurred while sending the reminder.';
                    modalMessage.className = 'text-danger';
                    modal.show();
                })
                .finally(() => {
                    this.innerHTML = originalText;
                    this.disabled = false;
                });
            });
        });

        // Bulk Reminder
        document.getElementById('bulkSendBtn').addEventListener('click', function () {
            const form = document.getElementById('bulk-reminder-form');
            const formData = new FormData(form);

            const originalText = this.innerHTML;
            this.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...';
            this.disabled = true;

            fetch('send_notifications_bulk.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                const modal = new bootstrap.Modal(document.getElementById('responseModal'));
                const modalMessage = document.getElementById('responseMessage');

                if (data.success) {
                    modalMessage.textContent = data.message;
                    modalMessage.className = 'text-success';
                } else {
                    modalMessage.textContent = data.message;
                    modalMessage.className = 'text-danger';
                }

                modal.show();
            })
            .catch(error => {
                console.error('Error:', error);
                const modal = new bootstrap.Modal(document.getElementById('responseModal'));
                const modalMessage = document.getElementById('responseMessage');
                modalMessage.textContent = 'An error occurred while sending the bulk reminders.';
                modalMessage.className = 'text-danger';
                modal.show();
            })
            .finally(() => {
                this.innerHTML = originalText;
                this.disabled = false;
            });
        });

        // Send Receipt
        document.querySelectorAll('.send-receipt-btn').forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();

                const form = this.closest('.send-receipt-form');
                const formData = new FormData(form);

                const originalText = this.innerHTML;
                this.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...';
                this.disabled = true;

                fetch('send_receipt.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    const modal = new bootstrap.Modal(document.getElementById('responseModal'));
                    const modalMessage = document.getElementById('responseMessage');

                    if (data.success) {
                        modalMessage.textContent = data.message;
                        modalMessage.className = 'text-success';
                    } else {
                        modalMessage.textContent = data.message;
                        modalMessage.className = 'text-danger';
                    }

                    modal.show();
                })
                .catch(error => {
                    console.error('Error:', error);
                    const modal = new bootstrap.Modal(document.getElementById('responseModal'));
                    const modalMessage = document.getElementById('responseMessage');
                    modalMessage.textContent = 'An error occurred while sending the receipt.';
                    modalMessage.className = 'text-danger';
                    modal.show();
                })
                .finally(() => {
                    this.innerHTML = originalText;
                    this.disabled = false;
                });
            });
        });

        let selectedMarkAsPaidForm = null;

        document.querySelectorAll('.mark-as-paid-btn').forEach(button => {
            button.addEventListener('click', function () {
                selectedMarkAsPaidForm = this.closest('.mark-as-paid-form');
                const confirmModal = new bootstrap.Modal(document.getElementById('confirmMarkAsPaidModal'));
                confirmModal.show();
            });
        });

        document.getElementById('confirmMarkAsPaidBtn').addEventListener('click', function () {
            if (!selectedMarkAsPaidForm) return;

            const formData = new FormData(selectedMarkAsPaidForm);

            const originalText = this.innerHTML;
            this.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...';
            this.disabled = true;

            const confirmModal = bootstrap.Modal.getInstance(document.getElementById('confirmMarkAsPaidModal'));
            confirmModal.hide();

            fetch('mark_as_paid.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                const responseModal = new bootstrap.Modal(document.getElementById('responseModal'));
                const modalMessage = document.getElementById('responseMessage');

                if (data.success) {
                    modalMessage.textContent = data.message;
                    modalMessage.className = 'text-success';

                    selectedMarkAsPaidForm.closest('tr').remove();
                } else {
                    modalMessage.textContent = data.message;
                    modalMessage.className = 'text-danger';
                }

                responseModal.show();
            })
            .catch(error => {
                console.error('Error:', error);
                const responseModal = new bootstrap.Modal(document.getElementById('responseModal'));
                const modalMessage = document.getElementById('responseMessage');
                modalMessage.textContent = 'An error occurred while marking the payment as paid.';
                modalMessage.className = 'text-danger';
                responseModal.show();
            })
            .finally(() => {
                this.innerHTML = originalText;
                this.disabled = false;
            });
        });
    </script>
</body>

</html>