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
            background-color: rgb(219, 219, 219);
            scroll-behavior: smooth;
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
            font-size: 1.2rem;
            color: #666;
            text-align: justify;
            max-width: 1000px;
            margin: 0 auto;
        }

        .about-item {
            text-align: center;
            padding: 20px;
        }

        .about-item i {
            margin-bottom: 15px;
        }

        .about-item h4 {
            text-align: center;
            margin-bottom: 40px;
            font-size: 1.5rem;
            font-weight: 700;
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#location">Location</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#footer">Contact</a>
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
                        <button class="carousel-control-prev" type="button" data-bs-target="#featuresCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#featuresCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us Section with Icons -->
    <section id="about" class="about-section">
        <div class="container text-center">
            <h2>About Us</h2>
            <p class="lead" style="text-align: justify; max-width: 1000px; margin: 0 auto;">
                RentAp is an innovative apartment rental management system designed to streamline the rental process for
                both property owners and tenants. Our platform eliminates the hassle of manual rent tracking, improves
                communication, and ensures a seamless rental experience.
            </p>

            <div class="row mt-5">
                <!-- Rent Tracking -->
                <div class="col-md-4 about-item">
                    <i class="bi bi-cash-stack text-primary" style="font-size: 3rem;"></i>
                    <h4>Easy Rent Tracking</h4>
                    <p>Monitor payments, send reminders, and stay updated with automated tracking features.</p>
                </div>

                <!-- Tenant Management -->
                <div class="col-md-4 about-item">
                    <i class="bi bi-people text-success" style="font-size: 3rem;"></i>
                    <h4>Tenant Management</h4>
                    <p>Keep track of tenant information, lease agreements, and rental history effortlessly.</p>
                </div>

                <!-- Maintenance Requests -->
                <div class="col-md-4 about-item">
                    <i class="bi bi-tools text-danger" style="font-size: 3rem;"></i>
                    <h4>Maintenance Requests</h4>
                    <p>Tenants can easily submit repair requests, and landlords can respond efficiently.</p>
                </div>
            </div>
        </div>
    </section>


    <!-- Where's the apartment located -->
    <section id="location" class="features-section">
        <div class="container-fluid">
            <div class="row align-items-center features-container">
                <div class="col-md-4 d-flex align-items-center justify-content-center">
                    <h2>Apartment <br>Location:</h2>
                </div>
                <div class="col-md-8">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="footer" class="text-white py-4" style="background-color: #333333;">
        <div class="container-fluid"> 
            <div class="row">
                <!-- Logo and Description -->
                <div class="col-md-4 d-flex flex-column">
                    <img src="../images/RentAp_logo.png" alt="RentAp Logo" class="h-auto" style="width: 90px; height: auto; margin-bottom: 10px; margin-left: 20px;">
                    <p class="mb-0" style="margin-left: 20px;">Rentap was developed for <br>Garcia's Apartment</p>
                </div>

                <!-- Location -->
                <div class="col-md-4">
                    <h5 class="fw-bold">Location</h5>
                    <p class="mb-1"><i class="bi bi-geo-alt"></i> Millionaire's Village, 4 Silver, Novaliches, Quezon
                        City, 1123 Metro Manila</p>
                    </ul>
                </div>

                <!-- Contact Information -->
                <div class="col-md-4">
                    <h5 class="fw-bold">Contact Us</h5>
                    <p class="mb-0"><i class="bi bi-telephone"></i> 0912 345 6789</p>
                    <p class="mb-0"><i class="bi bi-envelope"></i> rentap@gmail.com</p>
                </div>
            </div>
            <hr class="my-4">
            <p class="text-center mb-0">&copy; 2025 RentAp. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([14.723024323409765, 121.03681689362779], 14);

        // OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Marker
        var marker = L.marker([14.723024323409765, 121.03681689362779]).addTo(map)
            .bindPopup("Millionaire's Village, 4 Silver, Novaliches, Quezon City, 1123 Metro Manila")
            .openPopup();
    </script>
</body>

</html>