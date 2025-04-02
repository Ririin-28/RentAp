<?php
session_start();
include '../db_connection.php';

header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }

    $requiredFields = ['renteeName', 'lastName', 'facebookProfile', 'email', 'phoneNumber', 'unit', 'moveInDate'];
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            throw new Exception("The field $field is required.");
        }
    }

    $firstName = $_POST['renteeName'];
    $lastName = $_POST['lastName'];
    $facebookProfile = $_POST['facebookProfile'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $unit = $_POST['unit'];
    $moveInDate = $_POST['moveInDate'];
    $pin = rand(100000, 999999);

    $conn->begin_transaction();

    $stmt = $conn->prepare("INSERT INTO Rentee (unit, first_name, last_name, facebook_profile, email, phone_number, pin) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssi", $unit, $firstName, $lastName, $facebookProfile, $email, $phoneNumber, $pin);
    $stmt->execute();
    $renteeId = $stmt->insert_id;
    $stmt->close();

    $stmt = $conn->prepare("UPDATE Unit_Status SET status = 'Occupied' WHERE unit = ?");
    $stmt->bind_param("s", $unit);
    $stmt->execute();
    $stmt->close();

    $remainingDays = 62;
    $stmt = $conn->prepare("INSERT INTO Agreement_Duration (unit, rentee_id, move_in_date, remaining_days) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sisi", $unit, $renteeId, $moveInDate, $remainingDays);
    $stmt->execute();
    $stmt->close();

    $conn->commit();

    echo json_encode(['success' => true, 'message' => 'Rentee added successfully!']);
} catch (Exception $e) {
    $conn->rollback();
    error_log($e->getMessage());
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
} finally {
    $conn->close();
}
?>