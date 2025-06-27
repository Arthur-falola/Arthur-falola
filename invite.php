<?php
// Démarrer la session pour obtenir l'ID utilisateur
session_start();

// Vérifier si l'utilisateur est connecté, sinon rediriger vers la page de connexion
if (!isset($_SESSION['user_id'])) {
  header("Location: connexion.html");
  exit();
}

$user_id = $_SESSION['user_id']; // L'ID de l'utilisateur connecté
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <link rel="apple-touch-icon" sizes="180x180" href="https://arthur-falola.github.io/skyboostfavicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="https://arthur-falola.github.io/skyboostfavicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="https://arthur-falola.github.io/skyboostfavicon/favicon-16x16.png">
  <link rel="manifest" href=" https://arthur-falola.github.io/skyboostfavicon/site.webmanifest">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SkyBoost - Invitez vos amis</title>
  <link rel="stylesheet" href="css/style1.css">
  <script>
    // Fonction pour copier le lien de parrainage
    function copyReferralLink() {
      var copyText = document.getElementById("referral-link");
      copyText.select();
      document.execCommand("copy");
      alert("Lien copié : " + copyText.value);
    }
  </script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
  <div id="skyboost-assistant-placeholder"></div>

  <script>
    fetch('assistant.html')
    .then(res => res.text())
    .then(html => {
      const container = document.getElementById('skyboost-assistant-placeholder');
      if (container) {
        container.innerHTML = html;

        // Exécuter les balises <script> du HTML chargé
        const scripts = container.querySelectorAll("script");
        scripts.forEach(oldScript => {
          const newScript = document.createElement("script");
          if (oldScript.src) {
            newScript.src = oldScript.src;
          } else {
            newScript.textContent = oldScript.textContent;
          }
          document.body.appendChild(newScript);
        });
      }
    });
  </script>
  <header>
    <div class="logo">
      <h1>SkyBoost</h1>
      <p>
        Boostez votre présence sur les réseaux sociaux
      </p>
      <div>
        <?php include 'solde.php'; ?>
      </div>
    </div>
  </header>

  <nav id="nav-men">
    <a href="index.php" class="nav-link"><i class="fas fa-home"></i><span>Accueil</span></a>
    <a href="mes_commandes.php" class="nav-link"><i class="fas fa-list"></i><span>Commandes</span></a>
    <a href="invite.php" class="nav-link"><i class="fas fa-user-friends"></i><span>Inviter</span></a>
    <a href="depot.php" class="nav-link active"><i class="fas fa-wallet"></i><span>Dépôt</span></a>
    <a href="apropos.php" class="nav-link"><i class="fas fa-info-circle"></i><span>À propos</span></a>
    <a href="php/deconnexion.php" class="nav-link"><i class="fas fa-sign-out-alt"></i><span>Déconnexion</span></a>
  </nav>
  <div class="container">
    <h2>Invitez vos amis à rejoindre SkyBoost</h2>
    <p>
      Partagez votre lien de parrainage avec vos amis pour les inviter à rejoindre SkyBoost et bénéficiez d'avantages exclusifs.
    </p>

    <h3>Votre lien de parrainage</h3>
    <p>
      Copiez le lien ci-dessous pour inviter vos amis :
    </p>

    <!-- Lien de parrainage dynamique -->
    <input type="text" value="https://skyboost.me/inscription.html?ref=<?php echo $user_id; ?>" id="referral-link" readonly>

    <!-- Bouton pour copier le lien -->
    <button onclick="copyReferralLink()">Copier le lien</button>

    <p>
      Partager ce lien avec vos amis et obtenez 20 XOF de récompenses à chaque inscription réussie !
    </p>
  </div>

  <footer>
    <p>
      &copy; 2025 SkyBoost - Tous droits réservés.
    </p>
  </footer>
</body>
</html>