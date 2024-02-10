<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    $mail = new PHPMailer(true);

    try {
        // Paramètres du serveur SMTP Gmail
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'busscameroun@gmail.com'; // Remplacez par votre adresse Gmail
        $mail->Password   = 'azertymaison34'; // Remplacez par votre mot de passe Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Destinataire et expéditeur
        $mail->setFrom($email, $name);
        $mail->addAddress('luciem532@gmail.com'); // Remplacez par l'adresse de votre destinataire

        // Contenu du courriel
        $mail->isHTML(true);
        $mail->Subject = "Nouveau message de $name";
        $mail->Body    = $message;

        $mail->send();

        // Redirection après l'envoi du courriel
        header("Location: index.html");
        exit();
    } catch (Exception $e) {
        echo "Erreur d'envoi de courriel : {$mail->ErrorInfo}";
    }
}
?>
