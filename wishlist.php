<?php
// Email configuration
$to = 'recipient@example.com';
$subject = 'Test email';
$message = 'This is a test email sent using PHP';
$headers = 'From: sender@example.com';

// SMTP configuration
$smtpHost = 'smtp.example.com';
$smtpUsername = 'username@example.com';
$smtpPassword = 'password';
$smtpPort = 587;

// Create a new PHPMailer instance
$mail = new mail PHPMailer();
$mail->isSMTP();
$mail->Host = $smtpHost;
$mail->SMTPAuth = true;
$mail->Username = $smtpUsername;
$mail->Password = $smtpPassword;
$mail->SMTPSecure = 'tls';
$mail->Port = $smtpPort;

// Set email parameters
$mail->setFrom('sender@example.com', 'Sender Name');
$mail->addAddress($to);
$mail->Subject = $subject;
$mail->Body = $message;

// Send email
if ($mail->send()) {
    echo 'Email sent successfully';
} else {
    echo 'Email could not be sent';
}
