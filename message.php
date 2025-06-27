<?php
require_once 'php/db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'php/PHPMailer/PHPMailer.php';
require 'php/PHPMailer/SMTP.php';
require 'php/PHPMailer/Exception.php';

// Préparer le message à envoyer
$sujet = "Avis important – Dépôts momentanément indisponibles";
$contenuHTML = "
    <h2>Bonjour,</h2>
    <p>Nous tenons à vous informer que <strong>les dépôts sont momentanément indisponibles</strong> sur notre plateforme SkyBoost.</p>
    <p>Nous rencontrons actuellement un souci technique et notre équipe travaille activement pour rétablir la situation.</p>
    <p>Nous vous préviendrons dès que tout sera de nouveau opérationnel. Merci de votre patience et de votre compréhension 🙏</p>
    <br>
    <p>Cordialement,<br><strong>Arthur</strong><br>SkyBoost</p>
";

$contenuTexte = "Bonjour,\n\nLes dépôts sont momentanément indisponibles sur SkyBoost. Nous résolvons le problème et vous informerons dès que tout sera rétabli.\n\nMerci de votre compréhension.\n\n– L'équipe SkyBoost";

// Récupérer tous les emails
$stmt = $pdo->query("SELECT email FROM users");
$emails = $stmt->fetchAll(PDO::FETCH_COLUMN);

foreach ($emails as $email) {
    $mail = new PHPMailer(true);
    try {
        // Configuration SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'skyboostweb@gmail.com'; // Ton adresse
        $mail->Password   = 'wbus eojp vwjr mkzz'; // Mot de passe d'application
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Infos de l'email
        $mail->setFrom('skyboostweb@gmail.com', 'SkyBoost');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = $sujet;
        $mail->Body    = $contenuHTML;
        $mail->AltBody = $contenuTexte;

        $mail->send();
        echo "✅ Email envoyé à $email<br>";
    } catch (Exception $e) {
        echo "❌ Échec de l'envoi à $email. Erreur : {$mail->ErrorInfo}<br>";
    }
}