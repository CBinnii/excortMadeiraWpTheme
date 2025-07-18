<?php
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Set response header to JSON
header('Content-Type: application/json');

$response = [];

try {
    // Capture form data
    $firstName = $_POST['firstName'] ?? '';
    $lastName = $_POST['lastName'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $message = $_POST['message'] ?? '';

    // PHPMailer configuration
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.transip.email'; // Change to your SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'office@the-girl-next-door.com'; // Your SMTP email
    $mail->Password = 'Th3G1rlN3xtD00r'; // Your SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    // Set sender and recipient
    $mail->setFrom('office@the-girl-next-door.com', 'Website The Girl Next Door');
    $mail->addAddress('office@the-girl-next-door.com'); 
    // $mail->addAddress('milla.binni@gmail.com'); 
    $mail->addReplyTo('office@the-girl-next-door.com', 'Information The Girl Next Door');

    // Email content
    $mail->isHTML(true);
    $mail->Subject = 'Contact from Contact page on The Girl Next Door website';
    $mail->Body = "
        <h3>Contact</h3>
        <p><strong>Name:</strong> $firstName $lastName</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Phone number:</strong> $phone</p>
        <p><strong>Message:</strong> $message</p>
    ";

    // Send email
    if ($mail->send()) {
        $response = ['status' => 'success', 'message' => 'Email sent successfully!'];
    } else {
        $response = ['status' => 'error', 'message' => 'Failed to send email.'];
    }
} catch (Exception $e) {
    $response = ['status' => 'error', 'message' => 'Error: ' . $mail->ErrorInfo];
}

// Return JSON response
echo json_encode($response);
exit;
