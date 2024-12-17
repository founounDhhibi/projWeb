<?php
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config.php';

function sendInvoiceByEmail($email, $username, $filePath) {
    try {
        $mail = new PHPMailer(true);

        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'youssefbenghorbal735@gmail.com'; // Your email
        $mail->Password   = 'koml ssam kpej bsrt'; // Your app password (use App Password from Google settings)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Recipients
        $mail->setFrom('youssefbenghorbal735@gmail.com', 'Heritech Team');
        $mail->addAddress($email, $username);

        // Attach the PDF invoice
        $mail->addAttachment($filePath);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Your Invoice from Heritech';

        // HTML Email Content
        $mailContent = "
        <html>
            <head>
                <style>
                    .email-container {
                        font-family: Arial, sans-serif;
                        padding: 20px;
                        background-color: #f9f9f9;
                        border: 1px solid #ddd;
                        border-radius: 8px;
                        width: 600px;
                        margin: 0 auto;
                    }
                    .email-header {
                        text-align: center;
                        background-color: #007bff;
                        color: white;
                        padding: 10px;
                        border-radius: 8px 8px 0 0;
                    }
                    .email-body {
                        padding: 20px;
                        text-align: left;
                        color: #333;
                    }
                    .email-footer {
                        text-align: center;
                        font-size: 12px;
                        color: #999;
                        margin-top: 20px;
                    }
                </style>
            </head>
            <body>
                <div class='email-container'>
                    <div class='email-header'>
                        <h2>Votre facture est prête!</h2>
                    </div>
                    <div class='email-body'>
                        <p>Monsieur/Madame $username,</p>
                        <p>Merci pour votre commande! Vous trouverez ci-dessous votre facture.</p>
                        <p>Si vous avez des questions ou besoin d'aide, contactez nous.</p>
                        <p>Merci de nous avoir choisi Heritech!</p>
                    </div>
                    <div class='email-footer'>
                        &copy; " . date('Y') . " Heritech. All rights reserved.
                    </div>
                </div>
            </body>
        </html>";

        $mail->Body = $mailContent;

        // Send the email
        $mail->send();
        
    } catch (Exception $e) {
        echo "Error: Invoice could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

function sendemail($user) {
    try {
        $mail = new PHPMailer(true);

        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'youssefbenghorbal735@gmail.com'; // Your email
        $mail->Password   = 'koml ssam kpej bsrt'; // Your app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Recipients
        $mail->setFrom('youssefbenghorbal735@gmail.com', 'Heritech Team');
        $mail->addAddress($user['email_user']);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Participation Event';
        $user_name = $user['nom_user'];
        // HTML Email Content
        $mailContent = "
        <html>
            <head>
                <style>
                    .email-container {
                        font-family: Arial, sans-serif;
                        padding: 20px;
                        background-color: #f9f9f9;
                        border: 1px solid #ddd;
                        border-radius: 8px;
                        width: 600px;
                        margin: 0 auto;
                    }
                    .email-header {
                        text-align: center;
                        background-color: #45a049;
                        color: white;
                        padding: 10px;
                        border-radius: 8px 8px 0 0;
                    }
                    .email-body {
                        padding: 20px;
                        text-align: left;
                        color: #333;
                    }
                    .reset-code {
                        font-size: 20px;
                        color: #45a049;
                        font-weight: bold;
                    }
                    .email-footer {
                        text-align: center;
                        font-size: 12px;
                        color: #999;
                        margin-top: 20px;
                    }
                </style>
            </head>
            <body>
                <div class='email-container'>
                    <div class='email-header'>
                        <h2>TuniVerse</h2>
                    </div>
                    <div class='email-body'>
                        <p>Hi,</p>
                        <p>Thank you for your participation :</p>
                        <p class='reset-code'>$user_name</p>
                        <p></p>
                        <p>Best regards.</p>
                    </div>
                    <div class='email-footer'>
                        &copy; " . date('Y') . "
                    </div>
                </div>
            </body>
        </html>";

        $mail->Body = $mailContent;
        $mail->send();

    } catch (Exception $e) {
        echo "Error: Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
