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

        $query = "SELECT R.rentee_id, CONCAT(R.first_name, ' ', R.last_name) AS full_name, R.email, P.due_date, P.status 
                  FROM Rentee R 
                  JOIN Pending_Payments P ON R.rentee_id = P.rentee_id 
                  WHERE P.status = 'Pending'";
        $result = $conn->query($query);
        ?>
        <!-- Main Content -->
        <div class="main-content container-fluid g-0">
            <!-- Title Container -->
            <div class="title-container">
                <img src="../images/RentAp_full.png" alt="RentAp Icon" class="rentap_Icon">
                <h1>Notification Management</h1>
            </div>

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
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="responseModal" tabindex="-1" aria-labelledby="responseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="responseModalLabel">Notification</h5>
                </div>
                <div class="modal-body" id="responseMessage">

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

        // Individual reminder
        document.querySelectorAll('.send-reminder-btn').forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();

                const form = this.closest('.send-reminder-form');
                const formData = new FormData(form);

                fetch('send_notifications.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    const modal = new bootstrap.Modal(document.getElementById('responseModal'));
                    document.getElementById('responseMessage').textContent = data.message;

                    const notification = document.createElement('div');
                    notification.className = 'alert alert-success';
                    notification.textContent = 'Email sent successfully!';
                    document.body.appendChild(notification);

                    modal.show();

                    setTimeout(() => {
                        modal.hide();
                        notification.remove(); 
                    }, 3000);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        });

        // Bulk reminder
        document.getElementById('bulkSendBtn').addEventListener('click', function () {
            const form = document.getElementById('bulk-reminder-form');
            const formData = new FormData(form);

            fetch('send_notifications_bulk.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                const modal = new bootstrap.Modal(document.getElementById('responseModal'));
                document.getElementById('responseMessage').textContent = data.message;

                const notification = document.createElement('div');
                notification.className = 'alert alert-success';
                notification.textContent = 'Email sent successfully!';
                document.body.appendChild(notification);

                modal.show();

                setTimeout(() => {
                    modal.hide();
                    notification.remove();
                }, 3000);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

        // Select all checkboxes
        document.getElementById('selectAll').addEventListener('change', function () {
            const checkboxes = document.querySelectorAll('.select-row');
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        });
    </script>
</body>

</html>