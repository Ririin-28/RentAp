<?php
session_start();
include '../db_connection.php';

header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }

    if (!isset($_POST['leaseUnit']) || !isset($_POST['moveOutDate'])) {
        throw new Exception('Unit or Move-out Date is missing.');
    }

    $unit = $_POST['leaseUnit'];
    $moveOutDate = $_POST['moveOutDate'];

    $conn->begin_transaction();

    $stmt = $conn->prepare("
        SELECT r.rentee_id, r.first_name, r.last_name, r.phone_number, r.email
        FROM rentee r
        WHERE r.unit = ?
    ");
    $stmt->bind_param("s", $unit);
    $stmt->execute();
    $result = $stmt->get_result();
    $rentee = $result->fetch_assoc();
    $stmt->close();

    if (!$rentee) {
        throw new Exception('No rentee found for the selected unit.');
    }

    $renteeId = $rentee['rentee_id'];
    $firstName = $rentee['first_name'];
    $lastName = $rentee['last_name'];
    $phoneNumber = $rentee['phone_number'];
    $email = $rentee['email'];

    $stmt = $conn->prepare("
        INSERT INTO rentee_archive (rentee_id, first_name, last_name, unit, contact_number, email, move_out_date)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("issssss", $renteeId, $firstName, $lastName, $unit, $phoneNumber, $email, $moveOutDate);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    $stmt = $conn->prepare("DELETE FROM rentee WHERE rentee_id = ?");
    $stmt->bind_param("i", $renteeId);
    if (!$stmt->execute()) {
        throw new Exception('Failed to delete rentee: ' . $stmt->error);
    }
    $stmt->close();

    $stmt = $conn->prepare("DELETE FROM agreement_duration WHERE rentee_id = ?");
    $stmt = $conn->prepare("DELETE FROM agreement_duration WHERE rentee_id = ?");
    $stmt->bind_param("i", $renteeId);
    if (!$stmt->execute()) {
        throw new Exception('Failed to delete agreement duration: ' . $stmt->error);
    }
    $stmt->close();

    $stmt = $conn->prepare("UPDATE unit_status SET status = 'Available' WHERE unit = ?");
    $stmt = $conn->prepare("UPDATE unit_status SET status = 'Available' WHERE unit = ?");
    $stmt->bind_param("s", $unit);
    if (!$stmt->execute()) {
        throw new Exception('Failed to update unit status: ' . $stmt->error);
    }
    $stmt->close();

    $conn->commit();

    echo json_encode(['success' => true, 'message' => $message . ' Lease ended successfully and rentee archived.']);
} catch (Exception $e) {
    $conn->rollback();
    error_log($e->getMessage());
    echo json_encode(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
} finally {
    $conn->close();
}
?>