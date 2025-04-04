<?php
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $p_name = $_POST['p_name'];
    $p_password = $_POST['p_password'];

    $stmt = $conn->prepare("SELECT m_name FROM manager WHERE m_name = ? AND password = ?");
    $stmt->bind_param("ss", $p_name, $p_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        session_start();
        $_SESSION['m_name'] = $p_name;
        echo json_encode(['status' => 'success', 'redirect' => '../manager/manager_dashboard.php']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid Username or Password.']);
    }

    $stmt->close();
    $conn->close();
    exit;
}
?>


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
                                    <p class="login-card-description mb-4">Sign in to your Manager account</p>
                                    <form id="loginForm">
                                        <div class="mb-3">
                                            <label for="p_name" class="form-label">Username</label>
                                            <input type="text" name="p_name" id="p_name" class="form-control" 
                                                placeholder="Enter your username" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="p_password" class="form-label">Password</label>
                                            <div class="input-group">
                                                <input type="password" name="p_password" id="p_password" 
                                                    class="form-control" placeholder="Enter your password" required>
                                                <button type="button" class="btn btn-outline-secondary" 
                                                    onclick="togglePasswordVisibility()">
                                                    <i class="bi bi-eye-fill" id="togglePasswordIcon"></i>
                                                </button>
                                            </div>
                                            <small class="form-text text-muted">
                                                Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character.
                                            </small>
                                        </div>
                                        <div class="mb-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="rememberMe">
                                                <label class="form-check-label" for="rememberMe">
                                                    Remember me
                                                </label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-block login-btn w-100 mb-3">Sign In</button>
                                        <div class="text-center">
                                            <a href="forgot-password.php" class="text-decoration-none">Forgot password?</a>
                                        </div>
                                    </form>
                                    <div id="loginResponse" class="mt-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('p_password');
            const icon = document.getElementById('togglePasswordIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('bi-eye-fill');
                icon.classList.add('bi-eye-slash-fill');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('bi-eye-slash-fill');
                icon.classList.add('bi-eye-fill');
            }
        }


    $(document).ready(function() {
        $('#loginForm').submit(function(event) {
        event.preventDefault();
        var p_name = $('#p_name').val();
        var p_password = $('#p_password').val();

        $.ajax({
          url: '',
          method: 'POST',
          data: { p_name: p_name, p_password: p_password },
          dataType: 'json',
          success: function(response) {
            if (response.status === 'success') {
              window.location.href = response.redirect;
            } else {
              $('#loginResponse').html('<div class="alert alert-danger">' + response.message + '</div>');
            }
          },
          error: function() {
            $('#loginResponse').html('<div class="alert alert-danger">Error occurred. Please try again later.</div>');
          }
        });
      });
    });


  </script>
</body>
</html>
