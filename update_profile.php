<?php
include 'db_connection.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rentee_id = $_POST['rentee_id'];
    $unit = $_POST['unit'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $facebook_profile = $_POST['facebook_profile'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];

    try {
        $query = "CALL edit_rentee(?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param(
            "issssss",
            $rentee_id,
            $unit,
            $first_name,
            $last_name,
            $facebook_profile,
            $email,
            $phone_number,
        );

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => $stmt->error]);
        }

        $stmt->close();
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }

    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>