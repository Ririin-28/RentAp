<?php
include '../db_connection.php';

header('Content-Type: application/json');

try {
    $query = "SELECT unit, status, name, facebook_name, email, phone_number FROM Rentees";
    $result = $conn->query($query);

    $rentees = [];
    while ($row = $result->fetch_assoc()) {
        $rentees[] = $row;
    }

    echo json_encode(['success' => true, 'data' => $rentees]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

$conn->close();
?>