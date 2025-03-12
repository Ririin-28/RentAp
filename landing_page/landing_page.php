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
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
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
            text-align: center;
            margin-bottom: 40px;
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

        .contact-section {
            padding: 60px 0;
            background-color: #fff;
        }

        .contact-section h2 {
            text-align: center;
            margin-bottom: 40px;
            font-size: 2.5rem;
            font-weight: 700;
        }

        .contact-section .contact-info {
            text-align: center;
            font-size: 1rem;
            color: #666;
        }

        .contact-section .contact-info i {
            font-size: 2rem;
            color: #333333;
            margin-bottom: 10px;
        }

        .footer {
            background-color: #333333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        .footer p {
            margin: 0;
            font-size: 1rem;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="../images/RentAp_logo.png" alt="RentAp Logo">
                RentAp
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../rentee/rentee_login.php">Login</a>
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

    <!-- Features Section -->
    <section id="features" class="features-section">
        <div class="container">
            <h2>Features</h2>
            <div class="row">
                <div class="col-md-4 feature-item">
                    <i class="bi bi-building"></i>
                    <h4>Modern Apartments</h4>
                    <p>Our apartments are equipped with modern amenities to ensure a comfortable living experience.</p>
                </div>
                <div class="col-md-4 feature-item">
                    <i class="bi bi-shield-check"></i>
                    <h4>Secure Environment</h4>
                    <p>We prioritize your safety with 24/7 CCTV cameras.</p>
                </div>
                <div class="col-md-4 feature-item">
                    <i class="bi bi-tools"></i>
                    <h4>Maintenance Support</h4>
                    <p>Our dedicated maintenance team is always ready to assist you with any issues.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-section">
        <div class="container">
            <h2>About Us</h2>
            <p>RentAp is an apartment management system designed to provide a seamless living experience for our residents. Our mission is to offer modern, secure, and well-maintained apartments that cater to your needs. Join our community and enjoy the best living experience.</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section">
        <div class="container">
            <h2>Contact Us</h2>
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
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 RentAp. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>