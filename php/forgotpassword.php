<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/phpmailer/Exception.php';
require '../PHPMailer/phpmailer/PHPMailer.php';
require '../PHPMailer/phpmailer/SMTP.php';

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = 'sp1312.mschosting.cloud';             // ⚠️ Use your domain's mail server (not 'localhost')
    $mail->SMTPAuth = true;
    $mail->Username = 'noreply@jumpa.com.my';      // Full email address
    $mail->Password = '';        // Actual email password from Plesk
    $mail->SMTPSecure = 'tls';                     // Or 'ssl' depending on Plesk setup
    $mail->Port = 587;                             // 587 for TLS, 465 for SSL

    // Sender and recipient
    $mail->setFrom('noreply@jumpa.com.my', 'Jumpa Support');
    $mail->addAddress('abgmhafizhan1908@gmail.com'); // Recipient

    // Content
    $mail->isHTML(false);                          // Set to true if you're sending HTML
    $mail->Subject = 'Reset your password';
    $mail->Body    = "Click this link to reset your password:\nhttps://yourdomain.com/reset_password.php?token=12";

    $mail->send();
    echo 'Password reset email sent!';
} catch (Exception $e) {
    echo "Mailer Error: {$mail->ErrorInfo}";
}

?>