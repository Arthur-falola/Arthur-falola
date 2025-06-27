<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: connexion.html");
  exit;
}

if (!isset($_SESSION['Boostage_gratuit'])) {
  $_SESSION['Boostage_gratuit'] = 0;
}

$api_url = "https://smmcheep.com/api/v2";
$api_key = "bc6fb69a8a7fab7bd8ac391ff6ea1885"; // Remplace par ta vraie clé API

$post_fields = [
  'key' => $api_key,
  'action' => 'services',
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
$response = curl_exec($ch);
curl_close($ch);

$services_all = json_decode($response, true);

// Ne garder que les services instagram
$services = array_filter($services_all, function($s) {
  return stripos($s['name'], 'instagram ') !== false;
});
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
  <title>SkyBoost - instagram </title>
  <link rel="stylesheet" href="css/style1.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
 <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />-->
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
        Boostez votre présence sur instagram
      </p>
    </div>
    <?php include 'solde.php'; ?>
  </header>

  <nav id="nav-men">
    <a href="index.php" class="nav-link"><i class="fas fa-home"></i><span>Accueil</span></a>
    <a href="mes_commandes.php" class="nav-link"><i class="fas fa-list"></i><span>Commandes</span></a>
    <a href="mes_transactions.php" class="nav-link active"><i class="fas fa-money-check-alt"></i><span>Transactions</span></a>
    <a href="depot.php" class="nav-link active"><i class="fas fa-wallet"></i><span>Dépôt</span></a>
    <a href="apropos.php" class="nav-link"><i class="fas fa-info-circle"></i><span>À propos</span></a>
    <a href="php/deconnexion.php" class="nav-link"><i class="fas fa-sign-out-alt"></i><span>Déconnexion</span></a>
  </nav>

  <div class="container">
    <h2>Commandes instagram </h2>
    <form method="post" action="php/traitement_commande.php">
      <label for="service">Service instagram  :</label>
      <select name="service" id="service" required>
        <option value="">-- Sélectionner un service instagram  --</option>
        <?php foreach ($services as $service): ?>
        <option value="<?= $service['service'] ?>" data-rate="<?= $service['rate'] ?? 0 ?>">
          <?= htmlspecialchars($service['name']) ?> (Min: <?= $service['min'] ?>, Max: <?= $service['max'] ?>)
        </option>
        <?php endforeach; ?>
      </select>

      <label for="link">Lien :</label>
      <input type="url" name="lien" id="link" placeholder="https://..." required>

      <label for="quantity">Quantité :</label>
      <input type="number" name="quantity" id="quantity" min="1" required>

      <p id="price-display">
        <strong>  Prix total en FCFA:</strong>
      </p>

      <input type="text" name="prix" id="prix" readonly>                                                                                                                                                                                                                                                                                                                                                       <input type="hidden" name="boost_gratuit" id="boost_gratuit" value="0">

      <button type="submit">Valider la commande</button>

      <?php if ($_SESSION['Boostage_gratuit'] > 0): ?>
      <button type="submit" id="boost-button"
        style="display: block; margin-top: 15px; padding: 10px; border: none; border-radius: 5px; cursor: pointer;"
        onclick="document.getElementById('boost_gratuit').value='1';"
        disabled>
        Utiliser votre boost gratuit
      </button>
      <?php endif; ?>
    </form>
  </div>

  <footer>
    <p>
      &copy; 2025 SkyBoost - Tous droits réservés.
    </p>
  </footer>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



  <script>
    $(document).ready(function () {
      $('#service').select2({
        placeholder: "Sélectionner un service instagram ",
        width: '100%'
      });
    });

    const services = <?= json_encode(array_values($services)) ?>;
    const serviceSelect = document.getElementById('service');
    const quantityInput = document.getElementById('quantity');
    const prixInput = document.getElementById('prix');
    const boostButton = document.getElementById('boost-button');

    serviceSelect.addEventListener('change', updatePrice);
    quantityInput.addEventListener('input', updatePrice);

    function updatePrice() {
      const serviceId = serviceSelect.value;
      const qty = parseFloat(quantityInput.value) || 0;

      const selected = services.find(s => s.service == serviceId);

      if (!selected || !selected.rate) {
        prixInput.value = "0.0000";
        disableBoost();
        return;
      }

      const total = (qty * selected.rate *660 / 1000).toFixed(4);
      prixInput.value = total;

      if (parseFloat(total) <= 300 && parseFloat(total) > 0) {
        enableBoost();
      } else {
        disableBoost();
      }
    }

    function enableBoost() {
      if (boostButton) {
        boostButton.disabled = false;
        boostButton.style.backgroundColor = "#28a745";
        boostButton.style.color = "white";
      }
    }

    function disableBoost() {
      if (boostButton) {
        boostButton.disabled = true;
        boostButton.style.backgroundColor = "white";
        boostButton.style.color = "black";
      }
    }
    setInterval(updatePrice, 500);
  </script>
    <script>
  const services = <?= json_encode(array_values($services)) ?>;
</script>
<script src="js/traductions.js"></script>

</body>
</html>