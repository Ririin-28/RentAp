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
                <h1>Archive</h1>
            </div>
            <!-- Content Container -->
            <div class="content-container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><strong>Archived Rentees</strong></h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Rentee ID</th>
                                                <th>Full Name</th>
                                                <th>Contact Number</th>
                                                <th>Email</th>
                                                <th>Move-Out Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>John Doe</td>
                                                <td>09123456789</td>
                                                <td>john.doe@example.com</td>
                                                <td>2025-03-01</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Jane Smith</td>
                                                <td>09876543210</td>
                                                <td>jane.smith@example.com</td>
                                                <td>2025-02-15</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Alice Johnson</td>
                                                <td>09112233445</td>
                                                <td>alice.johnson@example.com</td>
                                                <td>2025-01-30</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Bob Brown</td>
                                                <td>09223344556</td>
                                                <td>bob.brown@example.com</td>
                                                <td>2025-01-10</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Carol White</td>
                                                <td>09334455667</td>
                                                <td>carol.white@example.com</td>
                                                <td>2024-12-20</td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>Dave Green</td>
                                                <td>09445566778</td>
                                                <td>dave.green@example.com</td>
                                                <td>2024-11-25</td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td>Eve Black</td>
                                                <td>09556677889</td>
                                                <td>eve.black@example.com</td>
                                                <td>2024-10-15</td>
                                            </tr>
                                            <tr>
                                                <td>8</td>
                                                <td>Frank Blue</td>
                                                <td>09667788990</td>
                                                <td>frank.blue@example.com</td>
                                                <td>2024-09-05</td>
                                            </tr>
                                            <tr>
                                                <td>9</td>
                                                <td>Grace Pink</td>
                                                <td>09778899001</td>
                                                <td>grace.pink@example.com</td>
                                                <td>2024-08-20</td>
                                            </tr>
                                            <tr>
                                                <td>10</td>
                                                <td>Henry Yellow</td>
                                                <td>09889900112</td>
                                                <td>henry.yellow@example.com</td>
                                                <td>2024-07-10</td>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const hamBurger = document.querySelector(".toggle-btn");
        hamBurger.addEventListener("click", function () {
            document.querySelector("#sidebar").classList.toggle("expand");
        });
    </script>
</body>

</html>