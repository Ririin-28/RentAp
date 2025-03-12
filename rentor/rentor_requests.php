<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Requests</title>
    <link rel="icon" href="../images/RentAp_logo.png" type="image/x-icon">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../main.css">
</head>

<body>
    <div class="wrapper">
        <?php include '../rentor_sidebar.php'; ?>
        <div class="main-content container-fluid g-0">
            <div class="title-container">
                <img src="../images/RentAp_full.png" alt="RentAp Icon" class="rentap_Icon">
                <h1>Rentee Maintenance Requests</h1>
            </div>
            
            <!-- Content Container -->
            <div class="content-container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><strong>Requests List</strong></h4>
                                <div class="card-header">
                                    <span class="total-requests">Total Requests:<strong> 4</strong></span>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Unit #</th>
                                                    <th>Rentee</th>
                                                    <th>Date</th>
                                                    <th>Issue</th>
                                                    <th>Description</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>101</td>
                                                    <td>Juan Dela Cruz</td>
                                                    <td>Mar 8</td>
                                                    <td>Light Bulb</td>
                                                    <td>Bulb in living room flickering</td>
                                                    <td><span class="badge bg-warning">Pending</span></td>
                                                    <td>
                                                        <button class="btn btn-success btn-sm" onclick="markAsDone(this)">
                                                            <i class="bi bi-check-lg"></i> Done
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>202</td>
                                                    <td>Maria Santos</td>
                                                    <td>Mar 7</td>
                                                    <td>Toilet</td>
                                                    <td>Flush not working</td>
                                                    <td><span class="badge bg-warning">Pending</span></td>
                                                    <td>
                                                        <button class="btn btn-success btn-sm" onclick="markAsDone(this)">
                                                            <i class="bi bi-check-lg"></i> Done
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>305</td>
                                                    <td>Carlos Reyes</td>
                                                    <td>Mar 6</td>
                                                    <td>Tiles</td>
                                                    <td>Cracked tiles in kitchen</td>
                                                    <td><span class="badge bg-success">Completed</span></td>
                                                    <td>
                                                        <button class="btn btn-secondary btn-sm" disabled>
                                                            <i class="bi bi-check-circle"></i> Done
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>408</td>
                                                    <td>Ana Mendoza</td>
                                                    <td>Mar 5</td>
                                                    <td>Ceiling</td>
                                                    <td>Water leakage</td>
                                                    <td><span class="badge bg-warning">Pending</span></td>
                                                    <td>
                                                        <button class="btn btn-success btn-sm" onclick="markAsDone(this)">
                                                            <i class="bi bi-check-lg"></i> Done
                                                        </button>
                                                    </td>
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const hamBurger = document.querySelector(".toggle-btn");
        const sidebar = document.querySelector("#sidebar");
        const mainContent = document.querySelector(".main-content");

        hamBurger.addEventListener("click", function () {
            sidebar.classList.toggle("expand");
            if (sidebar.classList.contains("expand")) {
                mainContent.style.marginLeft = "260px";
            } else {
                mainContent.style.marginLeft = "70px";
            }
        });

        function markAsDone(button) {
            const row = button.closest('tr');
            row.querySelector('.badge').classList.remove('bg-warning');
            row.querySelector('.badge').classList.add('bg-success');
            row.querySelector('.badge').textContent = 'Completed';
            button.classList.remove('btn-success');
            button.classList.add('btn-secondary');
            button.disabled = true;
            button.innerHTML = '<i class="bi bi-check-circle"></i> Done';
        }
    </script>
</body>

</html>