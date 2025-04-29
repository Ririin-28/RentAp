<?php
$servername = "localhost";
$username = "u941873099_rentap";
$password = "Rentapcrm2025";
$dbname = "u941873099_rentap";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
