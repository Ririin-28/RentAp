<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require 'db_connection.php';

// Get current date
$currentDate = date('Y-m-d');

// Query to get users with due dates 7 days before or after today
$sql = "SELECT * FROM rentals WHERE DATEDIFF(due_date, ?) IN (-7, 7)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $currentDate);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $email = $row['email'];
    $dueDate = $row['due_date'];
    $name = $row['tenant_name'];

    // Determine if it's a reminder or overdue notice
    if (strtotime($dueDate) > strtotime($currentDate)) {
        $subject = "Upcoming Rent Due - Reminder";
        $message = "Hello $name, your rent is due on $dueDate. Please ensure payment is made on time.";
    } else {
        $subject = "Overdue Rent Notification";
        $message = "Hello $name, your rent was due on $dueDate. Please settle your balance immediately.";
    }

    // Send Email
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.example.com'; // Replace with your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'rentapnotifier@gmail.com'; // Your email
        $mail->Password = 'rentappassword0000'; // Your email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('rentapnotifier@gmail.com', 'RentAp Garcia Apartment Rental CRM System');
        $mail->addAddress($email, $name);

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();
        echo "Email sent to $email <br>";
    } catch (Exception $e) {
        echo "Error sending email to $email: {$mail->ErrorInfo} <br>";
    }
}

$stmt->close();
$conn->close();
?>
