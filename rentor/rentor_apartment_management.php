<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentAp - Apartment Management</title>
    <link rel="icon" href="../images/RentAp_logo.png" type="image/x-icon">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../main.css">
    <style>
        /* Unit Styles */
        .unit {
            border: 2px solid #ddd;
            padding: 10px;
            margin: 10px;
            height: 100px;
            border-radius: 8px;
            text-align: center;
            transition: transform 0.2s;
            position: relative;
        }

        .unit:hover {
            transform: scale(1.05);
        }

        .occupied {
            background-color: #d4edda;
        }

        .available {
            background-color: #fff3cd;
        }

        .maintenance {
            background-color: #f8d7da;
        }

        .unit h5 {
            margin-bottom: 10px;
        }

        /* Warning Icon and Tooltip */
        .warning-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            color: #ffc107;
            cursor: pointer;
        }

        .tooltip-text {
            display: none;
            position: absolute;
            top: 30px;
            right: 10px;
            background-color: #ffc107;
            color: #fff;
            padding: 5px;
            border-radius: 5px;
            font-size: 12px;
        }

        .warning-icon:hover + .tooltip-text {
            display: block;
        }

        /* Legend Styles */
        .legend {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .legend-item {
            display: flex;
            align-items: center;
        }

        .legend-color {
            width: 20px;
            height: 20px;
            margin-right: 10px;
            border-radius: 5px;
        }

        .legend-text {
            font-size: 14px;
            color: #555;
        }

        /* Modify Button and Occupant Name */
        .modify-button {
            position: absolute;
            bottom: 10px;
            right: 10px;
        }

        .occupant-name {
            display: none;
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 5px;
            border-radius: 5px;
        }

        .unit.occupied:hover .occupant-name {
            display: block;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <?php include '../rentor_sidebar.php'; ?>
        <!-- Main Content -->
        <div class="main-content container-fluid g-0">
            <!-- Title Container -->
            <div class="title-container">
                <img src="../images/RentAp_full.png" alt="RentAp Icon" class="rentap_Icon">
                <h1>Apartment Management</h1>
            </div>
            <div class="content-container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><strong>Apartment Layout</strong></h4>
                                <!-- Legend -->
                                <div class="legend" style="justify-content: flex-end;">
                                    <div class="legend-item">
                                        <div class="legend-color" style="background-color: #d4edda;"></div>
                                        <div class="legend-text">Occupied</div>
                                    </div>
                                    <div class="legend-item">
                                        <div class="legend-color" style="background-color: #fff3cd;"></div>
                                        <div class="legend-text">Available</div>
                                    </div>
                                    <div class="legend-item">
                                        <div class="legend-color" style="background-color: #f8d7da;"></div>
                                        <div class="legend-text">Under Maintenance</div>
                                    </div>
                                </div>

                                <!-- Rentee Grid View -->
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <div class="unit occupied">
                                            <h5>Unit 112</h5>
                                            <div class="occupant-name">John Doe</div>
                                            <i class="bi bi-exclamation-triangle-fill warning-icon"></i>
                                            <div class="tooltip-text">Incoming Due Date</div>
                                            <button type="button" class="btn btn-primary modify-button">Modify</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="unit occupied">
                                            <h5>Unit 111</h5>
                                            <div class="occupant-name">Jane Smith</div>
                                            <button type="button" class="btn btn-primary modify-button">Modify</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="unit available">
                                            <h5>Unit 110</h5>
                                            <button type="button" class="btn btn-primary modify-button">Modify</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="unit occupied">
                                            <h5>Unit 109</h5>
                                            <div class="occupant-name">Alice Johnson</div>
                                            <i class="bi bi-exclamation-triangle-fill warning-icon"></i>
                                            <div class="tooltip-text">Incoming Due Date</div>
                                            <button type="button" class="btn btn-primary modify-button">Modify</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="unit occupied">
                                            <h5>Unit 108</h5>
                                            <div class="occupant-name">Bob Brown</div>
                                            <button type="button" class="btn btn-primary modify-button">Modify</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="unit occupied">
                                            <h5>Unit 107</h5>
                                            <div class="occupant-name">Carol White</div>
                                            <button type="button" class="btn btn-primary modify-button">Modify</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="unit occupied">
                                            <h5>Unit 106</h5>
                                            <div class="occupant-name">Dave Green</div>
                                            <button type="button" class="btn btn-primary modify-button">Modify</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="unit maintenance">
                                            <h5>Unit 105</h5>
                                            <button type="button" class="btn btn-primary modify-button">Modify</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="unit occupied">
                                            <h5>Unit 104</h5>
                                            <div class="occupant-name">Eve Black</div>
                                            <button type="button" class="btn btn-primary modify-button">Modify</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="unit occupied">
                                            <h5>Unit 103</h5>
                                            <div class="occupant-name">Frank Blue</div>
                                            <button type="button" class="btn btn-primary modify-button">Modify</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="unit occupied">
                                            <h5>Unit 102</h5>
                                            <div class="occupant-name">Grace Pink</div>
                                            <i class="bi bi-exclamation-triangle-fill warning-icon"></i>
                                            <div class="tooltip-text">Incoming Due Date</div>
                                            <button type="button" class="btn btn-primary modify-button">Modify</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="unit available">
                                            <h5>Unit 101</h5>
                                            <button type="button" class="btn btn-primary modify-button">Modify</button>
                                        </div>
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
        hamBurger.addEventListener("click", function () {
            document.querySelector("#sidebar").classList.toggle("expand");
        });
    </script>
</body>

</html>
