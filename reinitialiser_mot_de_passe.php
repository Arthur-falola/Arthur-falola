<?php
// On vérifie que les paramètres sont bien présents dans l'URL
if (!isset($_GET['email']) || !isset($_GET['token'])) {
  header("Location: connexion.html");
  exit;
}

$email = htmlspecialchars($_GET['email']);
$token = htmlspecialchars($_GET['token']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <link rel="apple-touch-icon" sizes="180x180" href="https://arthur-falola.github.io/skyboostfavicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="https://arthur-falola.github.io/skyboostfavicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="https://arthur-falola.github.io/skyboostfavicon/favicon-16x16.png">
  <link rel="manifest" href="https://arthur-falola.github.io/skyboostfavicon/site.webmanifest">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SkyBoost - Réinitialiser mot de passe</title>
  <link rel="stylesheet" href="css/style1.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
  <!-- Assistant -->
  <div id="skyboost-assistant-placeholder"></div>
  <script>
    fetch('assistant.html')
    .then(response => response.text())
    .then(html => {
      document.getElementById('skyboost-assistant-placeholder').innerHTML = html;
    });
  </script>

  <header>
    <div class="logo">
      <h1>SkyBoost</h1>
      <p>
        Boostez votre présence sur les réseaux sociaux
      </p>
    </div>
  </header>

  <div class="container">
    <h2>Réinitialiser votre mot de passe</h2>
    <p>
      Veuillez saisir un nouveau mot de passe pour votre compte associé à l’adresse : <strong><?= $email ?></strong>
    </p>

    <?php if (isset($_GET['expired'])): ?>
    <p style="color: red;">
      Ce lien a expiré ou est invalide.
    </p>
    <?php endif; ?>

    <form action="php/traitement_reinitialisation.php" method="POST">
      <input type="hidden" name="email" value="<?= $email ?>">
      <input type="hidden" name="token" value="<?= $token ?>">

      <label for="new_password">Nouveau mot de passe :</label>
      <input type="password" name="new_password" id="new_password" required>

      <label for="confirm_password">Confirmer le mot de passe :</label>
      <input type="password" name="confirm_password" id="confirm_password" required>

      <button type="submit">Changer le mot de passe</button>
    </form>

    <p>
      <a href="connexion.html"><i class="fas fa-arrow-left"></i> Retour à la connexion</a>
    </p>
  </div>

  <footer>
    <p>
      &copy; 2025 SkyBoost - Tous droits réservés.
    </p>
  </footer>
</body>
</html>