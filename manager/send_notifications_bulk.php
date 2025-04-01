<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

include '../db_connection.php';

$response = ['status' => '', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rentees = isset($_POST['rentees']) ? $_POST['rentees'] : [];

    if (empty($rentees)) {
        $response['status'] = 'error';
        $response['message'] = 'No rentees selected.';
        echo json_encode($response);
        exit;
    }

    $mail = new PHPMailer(true);
    $successCount = 0;
    $failureCount = 0;

    foreach ($rentees as $renteeData) {
        $rentee = json_decode($renteeData, true);
        $email = $rentee['email'];
        $due_date = $rentee['due_date'];
        $rentee_id = $rentee['rentee_id'];

        $subject = "Payment Reminder";
        $message = "Dear Rentee,\n\nThis is a reminder that your payment is due on $due_date. Please make the payment at your earliest convenience.\n\nThank you,\nRentAp Management";

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'rentapnotifier@gmail.com';
            $mail->Password = 'qonelandphqmygeb';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('rentapnotifier@gmail.com', 'RentAp');
            $mail->addAddress($email);
            $mail->Subject = $subject;
            $mail->Body = $message;

            $mail->send();

            $update_query = "UPDATE Pending_Payments SET status = 'Pending' WHERE rentee_id = ?";
            $stmt = $conn->prepare($update_query);
            $stmt->bind_param("i", $rentee_id);
            $stmt->execute();
            $stmt->close();

            $successCount++;
        } catch (Exception $e) {
            $failureCount++;
        }
    }

    $response['status'] = 'success';
    $response['message'] = "Bulk reminders sent. Success: $successCount, Failures: $failureCount.";
}

$conn->close();
echo json_encode($response);
?>
