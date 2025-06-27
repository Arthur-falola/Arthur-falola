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

// Ne garder que les services facebook
$services = array_filter($services_all, function($s) {
  return stripos($s['name'], 'facebook') !== false;
});

// Extraire et trier les catégories
$categories = array_unique(array_map(function($s) {
  return $s['category'];
}, $services));
sort($categories);
?>
<?php
$services = json_decode($response, true); // Remplace par l'appel réel

$facebookSubcategories = [];
foreach ($services as $srv) {
    if (stripos($srv['category'], 'Facebook') === 0) {
        $facebookSubcategories[] = $srv['category'];
    }
}
$facebookSubcategories = array_unique($facebookSubcategories);
sort($facebookSubcategories);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SkyBoost - facebook</title>
  <link rel="stylesheet" href="css/style1.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
        const scripts = container.querySelectorAll("script");
        scripts.forEach(oldScript => {
          const newScript = document.createElement("script");
          if (oldScript.src) newScript.src = oldScript.src;
          else newScript.textContent = oldScript.textContent;
          document.body.appendChild(newScript);
        });
      }
    });
  </script>

  <header>
    <div class="logo">
      <h1>SkyBoost</h1>
      <p>
        Boostez votre présence sur facebook
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
    <h2>Commandes facebook</h2>
    <form method="post" action="php/traitement_commande.php">
<label for="category">Catégorie :</label>
<select name="category" id="category" required>
  <option value="">-- Sélectionner une catégorie --</option>
  <?php foreach ($facebookSubcategories as $cat): ?>
    <option value="<?= htmlspecialchars($cat) ?>"><?= htmlspecialchars($cat) ?></option>
  <?php endforeach; ?>
</select>

<label for="service">Service facebook :</label>
<select id="service" name="service" required>
  <option value="">-- Choisissez un service --</option>
  <?php foreach ($services as $srv): ?>
    <?php if (stripos($srv['category'], 'Facebook') === 0): ?>
      <option value="<?= $srv['service'] ?>"
              data-category="<?= htmlspecialchars($srv['category']) ?>"
              data-rate="<?= $srv['rate'] ?>"
              data-min="<?= $srv['min'] ?>"
              data-max="<?= $srv['max'] ?>"
              data-name="<?= htmlspecialchars($srv['name']) ?>"
              style="display: none;">
        <?= htmlspecialchars($srv['name']) ?> (<?= $srv['min'] ?> - <?= $srv['max'] ?>)
      </option>
    <?php endif; ?>
  <?php endforeach; ?>
</select>

<!-- Choix du service -->
<select id="service" name="service" required>
  <option value="">-- Choisissez un service --</option>
  <?php foreach ($services as $srv): ?>
    <?php if (stripos($srv['category'], 'Facebook') === 0): ?>
      <option value="<?= $srv['service'] ?>"
              data-category="<?= htmlspecialchars($srv['category']) ?>"
              data-rate="<?= $srv['rate'] ?>"
              data-min="<?= $srv['min'] ?>"
              data-max="<?= $srv['max'] ?>"
              data-name="<?= htmlspecialchars($srv['name']) ?>">
        <?= htmlspecialchars($srv['name']) ?> (<?= $srv['min'] ?> - <?= $srv['max'] ?>)
      </option>
    <?php endif; ?>
  <?php endforeach; ?>
</select>

      <label for="link">Lien :</label>
      <input type="url" name="lien" id="link" placeholder="https://..." required>

      <label for="quantity">Quantité :</label>
      <input type="number" name="quantity" id="quantity" min="1" required>

      <p id="price-display">
        <strong>Prix total en FCFA:</strong>
      </p>
      <input type="text" name="prix" id="prix" readonly>
      <input type="hidden" name="boost_gratuit" id="boost_gratuit" value="0">

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
      placeholder: "Sélectionner un service facebook",
      width: '100%'
    });
    $('#category').select2({
      placeholder: "Sélectionner une catégorie",
      width: '100%'
    });
  });

  const services = <?= json_encode(array_values($services)) ?>;
  const serviceSelect = document.getElementById('service');
  const categorySelect = document.getElementById('category');
  const quantityInput = document.getElementById('quantity');
  const prixInput = document.getElementById('prix');
  const boostButton = document.getElementById('boost-button');

  categorySelect.addEventListener('change', function () {
    const selectedCategory = this.value;
    const options = serviceSelect.querySelectorAll('option');

    options.forEach(option => {
      const category = option.getAttribute('data-category');
      if (category === selectedCategory) {
        option.style.display = "block";
      } else {
        option.style.display = "none";
      }
    });

    // Réinitialiser la sélection
    $('#service').val('').trigger('change');
  });

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
    const total = (qty * selected.rate * 660 / 1000).toFixed(4);
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
</body>
</html>