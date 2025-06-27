<?php
$data = json_decode(file_get_contents("php://input"), true);
$question = $data['question'];

$to = "arthurfalola2006@gmail.com";
$subject = "Nouvelle question depuis l'assistant SkyBoost";
$message = "Question posée par un utilisateur :\n\n" . $question;
$headers = "From: chatbot@skyboost.com";

mail($to, $subject, $message, $headers);
?>