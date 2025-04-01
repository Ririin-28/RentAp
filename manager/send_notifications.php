<?php
header('Content-Type: application/json');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

include '../db_connection.php';

$response = ['status' => '', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Debugging: Log received POST data
    error_log(print_r($_POST, true));

    $rentee_id = $_POST['rentee_id'] ?? null;
    $email = $_POST['email'] ?? null;
    $due_date = $_POST['due_date'] ?? null;

    if ($rentee_id && $email && $due_date) {
        $subject = "Payment Reminder";
        $message = "Dear Rentee,\n\nThis is a reminder that your payment is due on $due_date. Please make the payment at your earliest convenience.\n\nThank you,\nRentAp Management";

        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = 0;
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

            $response['status'] = 'success';
            $response['message'] = "Reminder sent successfully to $email.";
        } catch (Exception $e) {
            $response['status'] = 'error';
            $response['message'] = "Failed to send reminder. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Invalid data received.';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method.';
}

$conn->close();
echo json_encode($response);
?>
