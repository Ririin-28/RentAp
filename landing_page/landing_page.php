<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentAp - Welcome</title>
    <link rel="icon" href="../images/RentAp_logo.png" type="image/x-icon">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../main.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: rgb(219, 219, 219); /* Set background color */
            scroll-behavior: smooth; /* Enable smooth scrolling */
        }

        .navbar {
            background-color: #333333;
        }

        .navbar-brand {
            color: #fff;
            font-weight: 600;
            display: flex;
            align-items: center;
        }

        .navbar-brand img {
            height: 40px;
            margin-right: 10px;
        }

        .navbar-nav .nav-link {
            color: #fff;
        }

        .hero-section {
            background: url('../images/login.jpg') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-align: center;
        }

        .hero-section h1 {
            font-size: 3rem;
            font-weight: 700;
        }

        .hero-section p {
            font-size: 1.25rem;
            margin: 20px 0;
        }

        .hero-section .btn {
            padding: 10px 20px;
            font-size: 1rem;
        }

        .features-section {
            padding: 60px 0;
            background-color: #fff;
        }

        .features-section h2 {
            font-size: 2.5rem;
            font-weight: 700;
        }

        .feature-item {
            text-align: center;
            padding: 20px;
        }

        .feature-item i {
            font-size: 3rem;
            color: #333333;
            margin-bottom: 20px;
        }

        .feature-item h4 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .feature-item p {
            font-size: 1rem;
            color: #666;
        }

        .about-section {
            padding: 60px 0;
            background-color: #f5f5f5;
        }

        .about-section h2 {
            text-align: center;
            margin-bottom: 40px;
            font-size: 2.5rem;
            font-weight: 700;
        }

        .about-section p {
            font-size: 1rem;
            color: #666;
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
        }

        #map {
            height: 400px;
            width: 100%;
            margin-top: 20px;
        }

        .footer {
            background-color: #333333;
            color: #fff;
            padding: 40px 0;
            text-align: center;
        }

        .footer p {
            margin: 0;
            font-size: 1rem;
        }

        .footer .contact-info {
            margin-bottom: 20px;
        }

        .footer .contact-info i {
            font-size: 1.5rem;
            color: #fff;
            margin-bottom: 10px;
        }

        .footer .contact-info p {
            margin: 0;
            font-size: 1rem;
            color: #ccc;
        }

        .features-container {
            background-color: #fff;
            padding: 20px;
        }

        .features-container .row {
            align-items: center;
        }

        .features-container h2 {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            height: 100%;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #333333;">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="../images/RentAp_logo.png" alt="RentAp Logo" style="height: 40px; margin-right: 10px;">
                <span>RentAp</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#location">Location</a> <!-- Links to the Location section -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#footer">Contact</a> <!-- Links to the Footer section -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary text-white px-3" href="../rentee/rentee_login.php" style="border-radius: 20px;">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1>Welcome to RentAp</h1>
            <p>Your ideal apartment!</p>
            <a href="../rentee/rentee_login.php" class="btn btn-primary">Get Started</a>
        </div>
    </section>

    <!-- What our apartment offers -->
    <section id="features" class="features-section">
        <div class="container-fluid">
            <div class="row align-items-center features-container">
                <div class="col-md-4 d-flex align-items-center justify-content-center">
                    <h2>What our <br>Apartment Offers:</h2>
                </div>
                <div class="col-md-8">
                    <div id="featuresCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="../images/feature1.png" class="d-block w-100" alt="About Us 1">
                            </div>
                            <div class="carousel-item">
                                <img src="../images/feature2.png" class="d-block w-100" alt="About Us 2">
                                <div class="carousel-caption d-none d-md-block">
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="../images/feature3.png" class="d-block w-100" alt="About Us 3">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#featuresCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#featuresCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Where's the apartment located -->
    <section id="location" class="features-section">
        <div class="container-fluid">
            <div class="row align-items-center features-container">
                <div class="col-md-4 d-flex align-items-center justify-content-center">
                    <h2>Apartment <br>Location</h2>
                </div>
                <div class="col-md-8">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 contact-info">
                    <i class="bi bi-geo-alt"></i>
                    <p>Millionaire's Village, 4 Silver, Novaliches, Quezon City, 1123 Metro Manila</p>
                </div>
                <div class="col-md-4 contact-info">
                    <i class="bi bi-envelope"></i>
                    <p>rentap@gmail.com</p>
                </div>
                <div class="col-md-4 contact-info">
                    <i class="bi bi-telephone"></i>
                    <p>0912 345 6789</p>
                </div>
            </div>
            <p>&copy; 2025 RentAp. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Initialize the map
        var map = L.map('map').setView([14.723024323409765, 121.03681689362779], 14); // Coordinates for Quezon City

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Add a marker
        var marker = L.marker([14.723024323409765, 121.03681689362779]).addTo(map)
            .bindPopup("Millionaire's Village, 4 Silver, Novaliches, Quezon City, 1123 Metro Manila")
            .openPopup();
    </script>
</body>

</html>
