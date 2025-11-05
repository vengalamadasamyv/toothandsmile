<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './phpmailer/src/Exception.php';
require './phpmailer/src/PHPMailer.php';
require './phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $mobile = trim($_POST["mobile"]);
    $appointment = trim($_POST["appointment"]);
    $problem = trim($_POST["problem"]);
    $pro = trim($_POST["pro"]);

    $mail = new PHPMailer(true);

    try {
        // SMTP setup
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'vasanthvenkat0000@gmail.com'; // your Gmail
        $mail->Password = 'vqfudadhjfgtcyqd'; // 16-character Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Sender and recipient
        $mail->setFrom('vasanthvenkat0000@gmail.com', 'Tooth & Smile Website');
        $mail->addAddress('vvengalamadasamy001@gmail.com'); // Dentist email
        $mail->addReplyTo($mail->Username, $name);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = '🦷 New Appointment Request - Tooth & Smile';
        $mail->Body = "
            <h2 style='color:#4CAF50;'>New Appointment Request</h2>
            <p><b>Name:</b> $name</p>
            <p><b>Mobile:</b> $mobile</p>
            <p><b>Preferred Date:</b> $appointment</p>
            <p><b>Treatment:</b> $problem</p>
            <p><b>Details:</b> $pro</p>
            <hr>
            <p style='font-size:12px;color:#555;'>Sent via Tooth & Smile Website</p>
        ";

        $mail->send();
        echo "success";
    } catch (Exception $e) {
        echo "error: " . $mail->ErrorInfo;
    }
}
?>
