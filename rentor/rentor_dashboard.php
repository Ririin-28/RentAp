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
        <?php include '../sidebar.php'; ?>
        <!-- Main Content -->
        <div class="main-content container-fluid g-0">
            <!-- Title Container -->
            <div class="title-container">
                <img src="../images/RentAp_full.png" alt="Dashboard Icon" class="title_icon">
                <h1>Rentor Dashboard</h1>
            </div>

            <!-- Card Containers -->
            <div class="content container mt-4">
                <div class="row g-3 cardBox">
                    <!-- Card 1 -->
                    <div class="col-md-3 card">
                        <div class="text-center p-3">
                            <div>
                                <h5 class="card-title numbers" id="totalAccounts"><></h5>
                                <p class="card-text cardName">Total Accounts</p>
                            </div>
                            <div>
                                <img src="assets/imgs/studentdbrd.png" alt="" class="img-fluid" style="width: 50px;">
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="col-md-3 card">
                        <div class="text-center p-3">
                            <div>
                                <h5 class="card-title numbers" id="totalFacilitators"><></h5>
                                <p class="card-text cardName">Total Facilitators</p>
                            </div>
                            <div>
                                <img src="assets/imgs/coursedbrd.png" alt="" class="img-fluid" style="width: 50px;">
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="col-md-3 card">
                        <div class="text-center p-3">
                            <div>
                                <h5 class="card-title numbers" id="totalStudents"><></h5>
                                <p class="card-text cardName">Total Students</p>
                            </div>
                            <div>
                                <img src="assets/imgs/sectiondbrd.png" alt="" class="img-fluid" style="width: 50px;">
                            </div>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="col-md-3 card">
                        <div class="text-center p-3">
                            <div>
                                <?php
                                    date_default_timezone_set('Asia/Manila');
                                    $date = new DateTime();
                                    echo '<h5 class="card-title numbers">' . $date->format('F j, Y') . '</h5>';
                                ?>
                                <p class="card-text cardName">Date Today</p>
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
