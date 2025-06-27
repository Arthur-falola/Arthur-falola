<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: connexion.html");
  exit;
}
// Initialisation si pas encore définie
if (!isset($_SESSION['Boostage_gratuit'])) {
  $_SESSION['Boostage_gratuit'] = 0;
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
  <title>SkyBoost - Boost des réseaux sociaux</title>
  <link rel="stylesheet" href="css/style1.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

  <div id="preloader">

    <div id="barre">
      <h1 id="skyboost">SkyBoost</h1>
      <div id="progress-bar"></div>

    </div>
  </div>
  <div id="content" style="display: none;">
    <!-- Votre contenu principal ici -->

    <header>
      <div class="logo">
        <h1>SkyBoost</h1>
        <p>
          Boostez votre présence sur les réseaux sociaux
        </p>
      </div>
      <?php include 'solde.php'; ?>                                                                                                  <div class="user-info" style="text-align: right; margin: 10px;">
        <?php if (isset($_SESSION['username'])): ?>
        <p style="font-weight: bold;">
          Bienvenue, <?php echo htmlspecialchars($_SESSION['username']); ?> !
        </p>
        <?php endif; ?>
      </div>
    </header>
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

    <nav id="nav-men">
      <a href="index.php" class="nav-link"><i class="fas fa-home"></i><span>Accueil</span></a>
      <a href="mes_commandes.php" class="nav-link"><i class="fas fa-list"></i><span>Commandes</span></a>
      <a href="mes_transactions.php" class="nav-link active"><i class="fas fa-money-check-alt"></i><span>Transactions</span></a>
      <a href="depot.php" class="nav-link active"><i class="fas fa-wallet"></i><span>Dépôt</span></a>
      <a href="apropos.php" class="nav-link"><i class="fas fa-info-circle"></i><span>À propos</span></a>
      <a href="php/deconnexion.php" class="nav-link"><i class="fas fa-sign-out-alt"></i><span>Déconnexion</span></a>
    </nav>
    <div class="container">
      <h2>Nos services exclusifs pour propulser votre succès</h2>
      <p>
        Choisissez un réseau social et découvrez nos options de boost personnalisées. Profitez de notre expertise pour augmenter votre visibilité.
      </p>

      <!-- Instagram -->
      <div class="service">
        <h3><img class="icone" src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" alt="instagram"> Instagram</h3>
        <p>
          Boostez votre compte Instagram rapidement avec des likes, des abonnés et des commentaires authentiques.
        </p>
        <button><a href="a.php" style="text-decoration:none;">  Commancer</a></button>

      </div>
      <!-- Facebook -->
      <div class="service">
        <h3><img class="icone" src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="facebook"> Facebook</h3>
        <p>
          Augmentez votre influence sur Facebook avec des likes et des abonnés qualifiés.
        </p>
        <button><a href="b.php" style="text-decoration:none;">  Commancer</a> </button>

      </div>

      <!-- YouTube -->
      <div class="service">
        <h3><img class="icone" src="https://upload.wikimedia.org/wikipedia/commons/b/b8/YouTube_Logo_2017.svg" alt="youtube"> YouTube</h3>
        <p>
          Faites décoller votre chaîne YouTube avec des vues et des abonnés.
        </p>
        <button><a href="c.php" style="text-decoration:none;">  Commancer</a></button>

      </div>
      <!--tiktok-->
      <div class="service">
        <h3><img class="icone" src="https://www.svgrepo.com/show/452226/tiktok.svg" alt="tiktok"> TikTok</h3>
        <p>
          Boostez votre présence TikTok avec nos options.
        </p>
        <button><a href="d.php" style="text-decoration:none;">  Commancer</a></button>

      </div>

      <footer>
        <p>
          &copy; 2025 SkyBoost - Tous droits réservés.
        </p>
      </footer>
    </div>
    <script>
      /*function toggleOptions(service) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             // Récupérer l'élément contenant les options
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 var options = document.getElementById(service);

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     // Vérifier si les options sont déjà visibles
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         if (options.style.display === "none" || options.style.display === "") {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 // Si les options sont cachées, les afficher
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         options.style.display = "block";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             } else {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     // Si elles sont déjà affichées, les cacher
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             options.style.display = "none";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 }*/
      function toggleOptions(service) {
        var options = document.getElementById(service);
        if (options.style.display === "none" || options.style.display === "") {
          options.style.display = "flex";
          options.style.opacity = 0;
          setTimeout(() => options.style.opacity = 1, 100);
        } else {
          options.style.opacity = 0;
          setTimeout(() => options.style.display = "none", 300);
        }
      }

      document.addEventListener("DOMContentLoaded", function() {
        let progressBar = document.getElementById('progress-bar');
        let content = document.getElementById('content');
        let width = 0;

        let interval = setInterval(function() {
          if (width >= 100) {
            clearInterval(interval);
            document.getElementById('preloader').style.display = 'none';
            content.style.display = 'block';
          } else {
            width += 7; // Augmentez ou diminuez cette valeur pour ajuster la vitesse de progression
            progressBar.style.width = width + '%';
          }
        },
          50); // Ajustez cet intervalle pour contrôler la vitesse de la barre de progression
      });

      function toggleOptions(id) {
        const container = document.getElementById(id);
        container.style.display = container.style.display === 'none' ? 'block': 'none';
      }

      function toggleSubOptions(id) {
        const sub = document.getElementById(id);
        sub.style.display = sub.style.display === 'none' ? 'block': 'none';
      }

    </script>

  </body>
</html>