<?php
$status = $_GET['status'] ?? 'unknown';

if ($status === 'success') {
  $message = "✅ Paiement effectué avec succès. Votre solde sera mis à jour sous peu.";
} elseif ($status === 'FAILED') {
  $message = "❌ Paiement échoué ou annulé. Aucun montant n’a été débité.";
} else {
  $message = "ℹ️ Statut de paiement inconnu.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Retour Paiement - SkyBoost</title>
  <style>
    body { font-family: sans-serif; padding: 40px; text-align: center; }
    .box {
      padding: 30px;
      border-radius: 12px;
      max-width: 500px;
      margin: auto;
      background-color: #f9f9f9;
      box-shadow: 0 0 15px rgba(0, 102, 255, 0.1);
    }
    h1 { color: #0066ff; }
    p { font-size: 18px; }
  </style>
</head>
<body>
  <div class="box">
    <h1>SkyBoost</h1>
    <p><?php echo $message; ?></p>
    <a href="index.php">← Retour à l’accueil</a>
  </div>
</body>
</html>