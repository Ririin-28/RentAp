<?php
session_start();
include '../db_connection.php';

header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }

    if (!isset($_POST['rentee_id']) || !isset($_POST['due_date'])) {
        throw new Exception('Rentee ID or Due Date is missing.');
    }

    $renteeId = intval($_POST['rentee_id']);
    $dueDate = $_POST['due_date'];
    $amount = 12000.00;

    $stmt = $conn->prepare("INSERT INTO Payment_History (rentee_id, date, amount, status) VALUES (?, ?, ?, 'Paid')");
    $stmt->bind_param("isd", $renteeId, $dueDate, $amount);
    $stmt->execute();
    $stmt->close();

    $stmt = $conn->prepare("DELETE FROM Pending_Payments WHERE rentee_id = ? AND due_date = ?");
    $stmt->bind_param("is", $renteeId, $dueDate);
    $stmt->execute();
    $stmt->close();

    echo json_encode(['success' => true, 'message' => 'Payment marked as paid successfully.']);
} catch (Exception $e) {
    error_log($e->getMessage());
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>