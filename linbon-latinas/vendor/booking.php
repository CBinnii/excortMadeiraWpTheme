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
    $escort = $_POST['escort'] ?? '';
    $bookedBefore = $_POST['bookedBefore'] ?? '';
    $youAre = $_POST['youAre'] ?? '';
    $firstName = $_POST['firstName'] ?? '';
    $lastName = $_POST['lastName'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $telegram = $_POST['telegram'] ?? '';
    $nationality = $_POST['nationality'] ?? '';
    $birthYear = $_POST['birthYear'] ?? '';
    $introduceYourself = $_POST['introduceYourself'] ?? '';
    $date = $_POST['date'] ?? '';
    $time = $_POST['time'] ?? '';
    $duration = $_POST['duration'] ?? '';
    $country = $_POST['country'] ?? '';
    $address = $_POST['address'] ?? '';
    $specialRequirement = $_POST['specialRequirement'] ?? '';
    $contactMeBy = $_POST['contactMeBy'] ?? '';

    // PHPMailer configuration
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.transip.email'; // Change to your SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'office@escort-madeira.com'; // Your SMTP email
    $mail->Password = 'L1$b0nL@t1n@$'; // Your SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    // Set sender and recipient
    $mail->setFrom('office@escort-madeira.com', 'Website Lisbon Latinas');
    $mail->addAddress('office@escort-madeira.com'); 
    // $mail->addAddress('milla.binni@gmail.com'); 
    $mail->addReplyTo('office@escort-madeira.com', 'Information Lisbon Latinas');

    // Email content
    $mail->isHTML(true);
    $mail->Subject = 'Contact from Booking page on Lisbon Latinas website';
    $mail->Body = "
        <h3>Booking</h3>
        <h4 style='font-weight: 700'>Choose your escort</h4>
        <p><strong>Escort:</strong> $escort</p>
        <h4 style='font-weight: 700'>Personal details</h4>
        <p><strong>Name:</strong> $firstName $lastName</p>
        <p><strong>Booked before:</strong> $bookedBefore</p>
        <p><strong>You are:</strong> $youAre</p>
        <p><strong>E-mail:</strong> $email</p>
        <p><strong>Phone number:</strong> $phone</p>
        <p><strong>Telegram:</strong> $telegram</p>
        <p><strong>Nationality:</strong> $nationality</p>
        <p><strong>Birth Year:</strong> $birthYear</p>
        <p><strong>Introduce yourself:</strong> $introduceYourself</p>
        <h4 style='font-weight: 700'>Booking details</h4>
        <p><strong>Date:</strong> $date</p>
        <p><strong>Time:</strong> $time</p>
        <p><strong>Booking duration:</strong> $duration</p>
        <p><strong>Country:</strong> $country</p>
        <p><strong>Address:</strong> $address</p>
        <p><strong>Special Requirement:</strong> $specialRequirement</p>
        <p><strong>Contact me by:</strong> $contactMeBy</p>
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
