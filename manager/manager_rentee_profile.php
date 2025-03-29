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
        .content-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .card {
            width: 80%;
        }

        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }

        @media print {
            body * {
                visibility: hidden;
            }
            
            .printable, .printable * {
                visibility: visible;
            }
            
            .printable {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <?php include '../manager_sidebar.php'; ?>

        <!-- Main Content -->
        <div class="main-content container-fluid g-0">
            
            <!-- Title Container -->
            <div class="title-container">
                <img src="../images/RentAp_full.png" alt="RentAp Icon" class="rentap_Icon">
                <h1>Rentee Profile</h1>
            </div>

            <!-- Print Button -->
            <div class="d-flex justify-content-end my-3">
                <button onclick="window.print()" class="btn btn-primary">
                    <i class="bi bi-printer"></i> Print List
                </button>
            </div>

            <!-- Content Container -->
            <div class="content-container printable">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4"><strong>Rentees List</strong></h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Rentee ID</th>
                                        <th>Unit Number</th>
                                        <th>Full Name</th>
                                        <th>Contact Number</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>F-1</td>
                                        <td>John Doe</td>
                                        <td>09123456789</td>
                                        <td>john.doe@example.com</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>F-2</td>
                                        <td>Jane Smith</td>
                                        <td>09876543210</td>
                                        <td>jane.smith@example.com</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>F-4</td>
                                        <td>Alice Johnson</td>
                                        <td>09112233445</td>
                                        <td>alice.johnson@example.com</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>K-1</td>
                                        <td>Bob Brown</td>
                                        <td>09223344556</td>
                                        <td>bob.brown@example.com</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>G-2</td>
                                        <td>Carol White</td>
                                        <td>09334455667</td>
                                        <td>carol.white@example.com</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const hamBurger = document.querySelector(".toggle-btn");
        if (hamBurger) {
            hamBurger.addEventListener("click", function () {
                document.querySelector("#sidebar").classList.toggle("expand");
            });
        }
    </script>
</body>

</html>
