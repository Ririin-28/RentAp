<?php
session_start();
include '../db_connection.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';
require '../vendor/setasign/fpdf/fpdf.php';

header('Content-Type: application/json');

function sendEmail($to, $subject, $message, $attachments = []) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'rentapnotifier@gmail.com';
        $mail->Password = 'qonelandphqmygeb';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('rentapnotifier@gmail.com', 'RentAp');
        $mail->addAddress($to);

        // Attachments
        foreach ($attachments as $file) {
            if (file_exists($file)) {
                $mail->addAttachment($file);
            }
        }

        // Content
        $mail->isHTML(false);
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Mailer Error: " . $mail->ErrorInfo);
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (!isset($_POST['rentee_id']) || !isset($_POST['date'])) {
            throw new Exception('Rentee ID or Payment Date is missing.');
        }

        $renteeId = intval($_POST['rentee_id']);
        $date = $_POST['date'];

        $stmt = $conn->prepare("SELECT CONCAT(first_name, ' ', last_name) AS full_name, email FROM rentee WHERE rentee_id = ?");
        $stmt->bind_param("i", $renteeId);
        $stmt->execute();
        $stmt->bind_result($fullName, $renteeEmail);
        $stmt->fetch();
        $stmt->close();

        if (!$fullName || !$renteeEmail) {
            throw new Exception('Rentee details not found.');
        }

        $receiptsDir = "../receipts";
        if (!is_dir($receiptsDir)) {
            mkdir($receiptsDir, 0777, true);
        }

        $pdfFileName = "receipt_{$renteeId}_{$date}.pdf";
        $pdfFilePath = "$receiptsDir/$pdfFileName";

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Payment Receipt', 0, 1, 'C');
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, "Rentee Name: $fullName", 0, 1);
        $pdf->Cell(0, 10, "Rentee ID: $renteeId", 0, 1);
        $pdf->Cell(0, 10, "Payment Date: $date", 0, 1);
        $pdf->Ln(10);
        $pdf->Cell(0, 10, "Thank you for your payment!", 0, 1);
        $pdf->Output('F', $pdfFilePath);

        if (!file_exists($pdfFilePath)) {
            throw new Exception('Failed to create receipt file.');
        }

        $subject = "Payment Receipt";
        $message = "Dear $fullName,\n\nWe have received your payment for the date $date. Please find your receipt attached.\n\nThank you.";
        $attachments = [$pdfFilePath];

        if (sendEmail($renteeEmail, $subject, $message, $attachments)) {
            echo json_encode(['success' => true, 'message' => 'Receipt sent successfully!']);
        } else {
            throw new Exception('Failed to send receipt. Please check the email configuration.');
        }
    } catch (Exception $e) {
        error_log($e->getMessage());

        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}
?>
