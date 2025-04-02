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
        FROM Rentee r
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
        INSERT INTO Rentee_Archive (rentee_id, first_name, last_name, unit, contact_number, email, move_out_date)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("issssss", $renteeId, $firstName, $lastName, $unit, $phoneNumber, $email, $moveOutDate);
    $stmt->execute();
    $stmt->close();

    $stmt = $conn->prepare("DELETE FROM Rentee WHERE rentee_id = ?");
    $stmt->bind_param("i", $renteeId);
    $stmt->execute();
    $stmt->close();

    $stmt = $conn->prepare("DELETE FROM Agreement_Duration WHERE rentee_id = ?");
    $stmt->bind_param("i", $renteeId);
    $stmt->execute();
    $stmt->close();

    $stmt = $conn->prepare("UPDATE Unit_Status SET status = 'Available' WHERE unit = ?");
    $stmt->bind_param("s", $unit);
    $stmt->execute();
    $stmt->close();

    $conn->commit();

    echo json_encode(['success' => true, 'message' => 'Lease ended successfully and rentee archived.']);
} catch (Exception $e) {
    $conn->rollback();
    error_log($e->getMessage());
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
} finally {
    $conn->close();
}
?>