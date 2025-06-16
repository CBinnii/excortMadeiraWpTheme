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
    $name        = $_POST['name'] ?? '';
    $email       = $_POST['email'] ?? '';
    $phone       = $_POST['phone'] ?? '';
    $city        = $_POST['city'] ?? '';
    $nacionality = $_POST['nacionality'] ?? '';
    $country     = $_POST['country'] ?? '';
    $instagram   = $_POST['instagram'] ?? '';
    $age         = $_POST['age'] ?? '';
    $chest       = $_POST['chest'] ?? '';
    $hip         = $_POST['hip'] ?? '';
    $waist       = $_POST['waist'] ?? '';
    $languages   = $_POST['languages'] ?? '';
    $experience  = $_POST['experience'] ?? '';
    $description = $_POST['description'] ?? '';
    $profile     = $_FILES['profile'] ?? '';
    $wholeBody   = $_FILES['wholeBody'] ?? '';
    $selfie      = $_FILES['selfie'] ?? '';

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
    $mail->Subject = 'Contact from Casting page on The Girl Next Door website';
    $mail->Body = "
        <h3>Casting</h3>
        <p><strong>Name:</strong> $name</p>
        <p><strong>E-mail:</strong> $email</p>
        <p><strong>Phone number:</strong> $phone</p>
        <p><strong>City:</strong> $city</p>
        <p><strong>Nacionality:</strong> $nacionality</p>
        <p><strong>Country:</strong> $country</p>
        <p><strong>Instagram:</strong> $instagram</p>
        <p><strong>Age:</strong> $age</p>
        <p><strong>Chest:</strong> $chest</p>
        <p><strong>Hip:</strong> $hip</p>
        <p><strong>Waist:</strong> $waist</p>
        <p><strong>Languages:</strong> $languages</p>
        <p><strong>Experience:</strong> $experience</p>
        <p><strong>Description:</strong> $description</p>
    ";

    // Handle file uploads
    $uploadDir = __DIR__ . '/uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $files = ['profile', 'wholeBody', 'selfie'];
    foreach ($files as $fileKey) {
        if (!empty($_FILES[$fileKey]['name'])) {
            $fileTmpPath = $_FILES[$fileKey]['tmp_name'];
            $fileName = basename($_FILES[$fileKey]['name']);
            $filePath = $uploadDir . $fileName;

            if (move_uploaded_file($fileTmpPath, $filePath)) {
                $mail->addAttachment($filePath);
            } else {
                $response['warnings'][] = "Could not upload file: $fileName";
            }
        }
    }

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
