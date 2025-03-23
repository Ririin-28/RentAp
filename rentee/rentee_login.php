
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" href="../images/RentAp_Icon.png" type="image/x-icon">
    <title>RentAp: Login Page</title>
    <style>
        body {
            background-color: #f5f5f5;
            overflow: hidden;
        }
        .login-card {
            width: 95%;
            height: 92%;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            border-radius: 15px;
            overflow: hidden;
        }
        .login-card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .login-btn {
            background-color: black;
            color: white;
            border: 2px solid black;
            padding: 10px;
            transition: all 0.3s ease;
        }
        .login-btn:hover {
            background-color: white;
            color: black;
            border: 2px solid black;
        }
        .RentApLogo {
            max-height: 60px;
        }
        .titlebarcontainer {
            padding: 10px;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 20px;
        }
    </style>
</head>
<body>
    <div class="titlebarcontainer">
        <a href="../landing_page/landing_page.php">
            <img src="../images/RentAp_full.png" alt="RentAp Logo" class="RentApLogo">
        </a>
        <h6 class="logoname mb-0">RentAp: Apartment Management System</h6>
    </div>

    <main class="d-flex align-items-center min-vh-100 py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card login-card">
                        <div class="row g-0">
                            <div class="col-md-5">
                                <img src="../images/login.jpg" alt="login" class="login-card-img">
                            </div>
                            <div class="col-md-7">
                                <div class="card-body p-5">
                                    <h4 class="mb-4">Welcome Back!</h4>
                    <p class="login-card-description mb-4">Sign in to your Rentee account</p>
                    <form id="loginForm">
                        <div class="mb-3">
                        <label for="unitNumber" class="form-label">Unit Number</label>
                            <select name="unitNumber" id="unitNumber" class="form-control" required>
                                <option value="" disabled selected>Select your unit number</option>
                                <?php for ($i = 101; $i <= 112; $i++): ?>
                                    <option value="unit <?= $i ?>">unit <?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="renteeName" class="form-label">Name</label>
                            <input type="text" name="renteeName" id="renteeName" class="form-control" 
                                placeholder="Enter your name" required>
                        </div>
                        <div class="mb-4">
                            <label for="pin" class="form-label">6-Digit Pin</label>
                            <input type="password" name="pin" id="pin" class="form-control" 
                                placeholder="Enter your 6-digit pin" required maxlength="6">
                        </div>
                        <button type="submit" class="btn btn-block login-btn w-100 mb-3">Sign In</button>
                    </form>
                    <div id="loginResponse" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#loginForm').submit(function(event) {
                event.preventDefault();
                const formData = {
                    unitNumber: $('#unitNumber').val(),
                    renteeName: $('#renteeName').val(),
                    pin: $('#pin').val()
                };

                $.ajax({
                    url: window.location.href,
                    method: 'POST',
                    data: formData,
                    dataType: 'json',
                    beforeSend: function() {
                        $('.login-btn').prop('disabled', true).html(
                            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                        );
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#loginResponse').html('<div class="alert alert-success">Login successful! Redirecting...</div>');
                            window.location.href = response.redirect;
                        } else {
                            $('#loginResponse').html('<div class="alert alert-danger">' + response.message + '</div>');
                        }
                    },
                    error: function() {
                        $('#loginResponse').html('<div class="alert alert-danger">Error occurred. Please try again later.</div>');
                    },
                    complete: function() {
                        $('.login-btn').prop('disabled', false).html('Sign In');
                    }
                });
            });
        });
    </script>
</body>
</html>