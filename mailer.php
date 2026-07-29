<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function sendVerificationEmail($toEmail, $toName, $token) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'careact.system@gmail.com'; // ← replace with your Gmail
        $mail->Password   = 'awks grpn ivnv xyfu';             // ← replace with your 16-char app password (no spaces)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('careact.system@gmail.com', 'CareAct');
        $mail->addAddress($toEmail, $toName);

        // Verification link
        // Change 'localhost/Thesis System FINAL' to your actual path
        $verifyLink = "https://dodgerblue-lion-564968.hostingersite.com/verify.php?token=" . $token;

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'CareAct - Verify Your Email Address';
        $mail->Body    = '
        <div style="font-family: Segoe UI, sans-serif; max-width: 600px; margin: auto; padding: 30px; border: 1px solid #e0e0e0; border-radius: 10px;">
            <h2 style="color: #536dfe; text-align: center;">CareAct</h2>
            <h3 style="text-align: center;">Email Verification</h3>
            <p>Hello <b>' . htmlspecialchars($toName) . '</b>,</p>
            <p>Thank you for signing up for CareAct! Please click the button below to verify your email address.</p>
            <div style="text-align: center; margin: 30px 0;">
                <a href="' . $verifyLink . '"
                   style="background: #536dfe; color: white; padding: 14px 32px;
                          border-radius: 8px; text-decoration: none; font-weight: bold;
                          font-size: 16px;">
                    Verify My Email
                </a>
            </div>
            <p>Or copy and paste this link into your browser:</p>
            <p style="word-break: break-all; color: #536dfe;">' . $verifyLink . '</p>
            <p style="color: #888; font-size: 13px;">This link will expire in 24 hours. If you did not create a CareAct account, you can ignore this email.</p>
            <hr style="border: none; border-top: 1px solid #eee; margin: 20px 0;">
            <p style="text-align: center; color: #888; font-size: 12px;">© 2025 CareAct | Web-Based Caregiver Training System</p>
        </div>';

        $mail->AltBody = "Hello $toName, please verify your email by visiting: $verifyLink";

        $mail->send();
        return true;

    } catch (Exception $e) {
        return false;
    }
}
?>