<?php
// Pas besoin de session ici, l'utilisateur n'est pas connecté
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
  <title>SkyBoost - Mot de passe oublié</title>
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
      <p>Boostez votre présence sur les réseaux sociaux</p>
    </div>
  </header>

  <div class="container">
    <h2>Mot de passe oublié</h2>
    <p>Entrez votre adresse e-mail et nous vous enverrons un lien pour réinitialiser votre mot de passe.</p>

    <?php if (isset($_GET['success'])): ?>
      <p style="color: green;">Un lien de réinitialisation vous a été envoyé par email.</p>
    <?php elseif (isset($_GET['error'])): ?>
      <p style="color: red;">Adresse e-mail non trouvée.</p>
    <?php endif; ?>

    <form action="php/traitement_mot_de_passe_oublie.php" method="POST">
      <label for="email">Adresse e-mail :</label>
      <input type="email" name="email" id="email" required>
      <button type="submit">Envoyer le lien</button>
    </form>

    <p><a href="connexion.html"><i class="fas fa-arrow-left"></i> Retour à la connexion</a></p>
  </div>

  <footer>
    <p>&copy; 2025 SkyBoost - Tous droits réservés.</p>
  </footer>
</body>
</html>