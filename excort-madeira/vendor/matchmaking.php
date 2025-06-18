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
    $gender = $_POST['gender'] ?? '';
    $firstName = $_POST['firstName'] ?? '';
    $lastName = $_POST['lastName'] ?? '';
    $email = $_POST['email'] ?? '';
    $aboutYou = $_POST['aboutYou'] ?? '';
    $languages = $_POST['languages'] ?? [];
    $conversation = $_POST['conversation'] ?? '';
    $MoreIntroOrExtro = $_POST['MoreIntroOrExtro'] ?? '';
    $TakeTheLead = $_POST['TakeTheLead'] ?? '';
    $smoke = $_POST['smoke'] ?? '';
    $DoYouMidSmoke = $_POST['DoYouMidSmoke'] ?? '';
    $likeTatoos = $_POST['likeTatoos'] ?? '';
    $bookedEscortBefore = $_POST['bookedEscortBefore'] ?? '';
    $aspectsEnjoy = $_POST['aspectsEnjoy'] ?? '';
    $aspectsPreference = $_POST['aspectsPreference'] ?? '';
    $rangeAgeFrom = $_POST['rangeAgeFrom'] ?? '';
    $rangeAgeUntil = $_POST['rangeAgeUntil'] ?? '';
    $dreamEscortPersonality = $_POST['dreamEscortPersonality'] ?? '';
    $dreamEscortAppearance = $_POST['dreamEscortAppearance'] ?? '';
    $anyTurnOnOtherWish = $_POST['anyTurnOnOtherWish'] ?? '';
    $anyTurnOffOtherWish = $_POST['anyTurnOffOtherWish'] ?? '';
    $dreamBooking = $_POST['dreamBooking'] ?? '';
    $MostImportant1 = $_POST['MostImportant1'] ?? '';
    $MostImportant2 = $_POST['MostImportant2'] ?? '';
    $MostImportant3 = $_POST['MostImportant3'] ?? '';
    $MostImportant4 = $_POST['MostImportant4'] ?? '';
    $MostImportant5 = $_POST['MostImportant5'] ?? '';
    $MostImportant6 = $_POST['MostImportant6'] ?? '';
    $MostImportant7 = $_POST['MostImportant7'] ?? '';
    $terms = $_POST['terms'] ?? '';
    $langs = implode(', ', array_map('htmlspecialchars', $languages));

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
    $mail->Subject = 'Contact from Matchmaking page on The Girl Next Door website';
    $mail->Body = "
        <h3>Matchmaking</h3>
        <p><strong>Gender:</strong> $gender</p>
        <p><strong>Name:</strong> $firstName $lastName</p>
        <p><strong>E-mail:</strong> $email</p>
        <p><strong>About you:</strong> $aboutYou</p>
        <p><strong>Which languages are you fluent in?</strong> $langs</p>
        <p><strong>What are you like as a conversationalist?</strong> $conversation</p>
        <p><strong>Are you more introverted or extroverted?</strong> $MoreIntroOrExtro</p>
        <p><strong>Who takes the lead?</strong> $TakeTheLead</p>
        <p><strong>Do you smoke?</strong> $smoke</p>
        <p><strong>Do you mind if the escort smokes?</strong> $DoYouMidSmoke</p>
        <p><strong>Do you like tattoos?</strong> $likeTatoos</p>
        <p><strong>Have you ever booked an escort before?</strong> $bookedEscortBefore</p>
        <p><strong>Which aspects did you enjoy most from your previous experiences?</strong> $aspectsEnjoy</p>
        <p><strong>Which aspects would you prefer different compared to your previous experiences?</strong> $aspectsPreference</p>
        <p><strong>From and until what age do you prefer?</strong> From: $rangeAgeFrom - Until $rangeAgeUntil</p>
        <p><strong>Describe your dream escort (personality)</strong> $dreamEscortPersonality</p>
        <p><strong>Describe your dream escort (appearance)</strong> $dreamEscortAppearance</p>
        <p><strong>Any other turn-ons that you wish to share?</strong> $anyTurnOnOtherWish</p>
        <p><strong>Any turn-offs that you wish to share?</strong> $anyTurnOffOtherWish</p>
        <p><strong>What does your dream booking look like?</strong> $dreamBooking</p>
        <p><strong>Most important booking aspects</strong> $MostImportant1 $MostImportant2 $MostImportant3 $MostImportant4 $MostImportant5 $MostImportant6 $MostImportant7 </p>
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
