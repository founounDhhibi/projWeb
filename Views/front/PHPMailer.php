<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Inclure l'autoloader de Composer

function envoyerMail($to, $subject, $body) {
    $mail = new PHPMailer(true);

    try {
        // Configuration du serveur SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Serveur SMTP (par exemple, Gmail)
        $mail->SMTPAuth = true;
        $mail->Username = 'iheb.zaidi.med@gmail.com'; // Votre adresse e-mail
        $mail->Password = 'zdmq jvrz jmku eynj'; // Votre mot de passe ou App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Paramètres de l'expéditeur
        $mail->setFrom('votre-email@gmail.com', 'Nom de l\'expéditeur');
        $mail->addAddress($to); // Destinataire

        // Contenu du mail
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
        echo "L'e-mail a été envoyé avec succès.";
    } catch (Exception $e) {
        echo "Erreur lors de l'envoi de l'e-mail : {$mail->ErrorInfo}";
    }
}
?>
