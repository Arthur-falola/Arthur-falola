<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: connexion.html");
  exit;
}

if (!isset($_SESSION['Boostage_gratuit'])) {
  $_SESSION['Boostage_gratuit'] = 0;
}
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
  <title>SkyBoost - Paiement</title>
  <link rel="stylesheet" href="css/style1.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://cdn.kkiapay.me/k.js"></script>

  <style>
    .paiement-box {
      background: #fff;
      max-width: 400px;
      margin: 40px auto;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0, 102, 255, 0.1);
      text-align: center;
    }
    .paiement-box h2 {
      color: #0066ff;
      margin-bottom: 20px;
    }
    .paiement-box input[type="number"] {
      width: 100%;
      padding: 12px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 6px;
      margin-bottom: 20px;
    }
    .paiement-box button {
      background-color: #0066ff;
      color: white;
      border: none;
      padding: 12px;
      font-size: 16px;
      border-radius: 6px;
      cursor: pointer;
      width: 100%;
      transition: background-color 0.3s ease;
    }
    .paiement-box button:hover {
      background-color: #004fcc;
    }
  </style>
</head>
<body>

  <header>
    <div class="logo">
      <h1>SkyBoost</h1>
      <p>
        Boostez votre présence sur les réseaux sociaux
      </p>
    </div>
    <?php include 'solde.php'; ?>
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
    <div class="paiement-box">
      <h2>Faire un dépôt</h2>
      <input type="number" id="montant" placeholder="Montant (100 - 50000 FCFA)" min="100" max="50000" required>
      <button onclick="payer()">Payer maintenant</button>
    </div>
  </div>

  <footer>
    <p>
      &copy; 2025 SkyBoost - Tous droits réservés.
    </p>
  </footer>

  <script>
    function payer() {
      const montant = document.getElementById('montant').value;
      if (montant < 100 || montant > 50000) {
        alert("Veuillez entrer un montant entre 100 et 50 000 FCFA.");
        return;
      }

      // On récupère le user_id depuis une variable PHP injectée
      const userId = <?php echo json_encode($_SESSION['user_id']); ?>;

      openKkiapayWidget({
        amount: parseInt(montant),
        api_key: "8fc8f02d7e1635da4e42f7185052fe09e013aabf",
        sandbox: false,
        name: "SkyBoost",
        description: "Recharge de solde",
        data: JSON.stringify({
          clientId: userId
        }),
        callback: "https://skyboost.me/réussi.php?amount=" + montant
      });
    }
  </script>

</body>
</html>