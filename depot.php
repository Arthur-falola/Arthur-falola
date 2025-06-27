<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: connexion.html");
  exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta name="google-site-verification" content="qlQqsxt1TF-22DzvLEw5XItBt_J04r-DosPz9oaUUJQ" />
 <link rel="icon" type="image/png" href="favicon-96x96.png" sizes="96x96" />
 <link rel="icon" type="image/svg+xml" href="favicon.svg" />
 <link rel="shortcut icon" href="favicon.ico" />
 <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png" />
 <link rel="manifest" href="site.webmanifest" />
  
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dépôt - SkyBoost</title>
  <link rel="stylesheet" href="css/style1.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    .deposit-container {
      padding: 30px;
      text-align: center;
    }
    .payment-option {
      display: flex;
      justify-content: center;
      gap: 40px;
      flex-wrap: wrap;
      margin-top: 40px;
    }
    .payment-card {
      background: linear-gradient(145deg, #ffffff, #e6e6e6);
      border-radius: 15px;
      padding: 30px 20px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
      cursor: pointer;
      transition: transform 0.3s ease;
      width: 250px;
    }
    .payment-card:hover {
      transform: translateY(-10px);
    }
    .payment-card img {
      height: 40px;
      margin: 10px;
    }
    .payment-title {
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 15px;
      color: #333;
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
    <a href="depot.php" class="nav-link"><i class="fas fa-wallet"></i><span>Dépôt</span></a>
    <a href="depot.php" class="nav-link active"><i class="fas fa-wallet"></i><span>Dépôt</span></a>
    <a href="apropos.php" class="nav-link"><i class="fas fa-info-circle"></i><span>À propos</span></a>
    <a href="php/deconnexion.php" class="nav-link"><i class="fas fa-sign-out-alt"></i><span>Déconnexion</span></a>
  </nav>

  <div class="container deposit-container">
    <h2>Choisissez un moyen de paiement</h2>
    <div class="payment-option">
      <!-- Mobile Money -->
      <div class="payment-card" onclick="window.location.href='depotx.php'">
        <div class="payment-title">
          Mobile Money
        </div>
        <img src="mtn.png" alt="MTN">
        <img src="moov.png" alt="Moov">
      <!--  <h5 style="color:red;">Les dépôt sont momentanément indisponible en raison des maintenant qu'effectue notre équipe technique. Elles seront bientôt disponibles </h5>-->
      </div>

      <!-- Crypto -->
      <div class="payment-card" onclick="window.location.href='crypto.php'">
        <div class="payment-title">
          Cryptomonnaie
        </div>
        <img src="crypto.png" alt="Bitcoin">
      <h4>Non disponible </h4>  <!--     <img src="https://cryptologos.cc/logos/tether-usdt-logo.png" alt="USDT">  -->
      </div>
      
    </div>
  </div>

  <footer>
    <p>
      &copy; 2025 SkyBoost - Tous droits réservés.
    </p>
  </footer>
</body>
</html>