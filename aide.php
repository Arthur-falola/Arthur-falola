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
  <meta name="google-site-verification" content="qlQqsxt1TF-22DzvLEw5XItBt_J04r-DosPz9oaUUJQ" />
 <link rel="icon" type="image/png" href="favicon-96x96.png" sizes="96x96" />
 <link rel="icon" type="image/svg+xml" href="favicon.svg" />
 <link rel="shortcut icon" href="favicon.ico" />
 <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png" />
 <link rel="manifest" href="site.webmanifest" />
  
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SkyBoost - Aide</title>
  <link rel="stylesheet" href="css/style1.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
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
    <?php include 'solde.php'; ?>
  </header>

  <nav id="nav-men">
    <a href="index.php" class="nav-link"><i class="fas fa-home"></i><span>Accueil</span></a>
    <a href="mes_commandes.php" class="nav-link"><i class="fas fa-list"></i><span>Commandes</span></a>
    <a href="depot.php" class="nav-link"><i class="fas fa-wallet"></i><span>Dépôt</span></a>
    <a href="depot.php" class="nav-link"><i class="fas fa-wallet"></i><span>Dépôt</span></a>
    <a href="aide.php" class="nav-link active"><i class="fas fa-question-circle"></i><span>Aide</span></a>
    <a href="php/deconnexion.php" class="nav-link"><i class="fas fa-sign-out-alt"></i><span>Déconnexion</span></a>
  </nav>

  <div class="container">
    <h2>Centre d’aide SkyBoost</h2>
    <p>Tu rencontres des problèmes avec ta commande ? Voici tout ce qu’il faut savoir pour que ça fonctionne parfaitement.</p>

    <h3>🧾 Pourquoi ma commande échoue ?</h3>
    <p>La majorité des échecs de commande sont dus à des <strong>liens incorrects</strong>. Chaque service nécessite un <strong>type de lien spécifique</strong>.</p>

    <h3>🔗 Quel lien dois-je fournir ?</h3>
    <table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse: collapse;">
      <thead style="background:#f0f0f0;">
        <tr>
          <th>Service</th>
          <th>Lien attendu</th>
          <th>Exemple</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>👍 Facebook – J’aime</td>
          <td>Publication publique Facebook</td>
          <td>https://www.facebook.com/user/posts/123456789</td>
        </tr>
        <tr>
          <td>👥 Facebook – Abonnés</td>
          <td>Page Facebook</td>
          <td>https://www.facebook.com/nomdelapage</td>
        </tr>
        <tr>
          <td>❤️ Instagram – J’aime</td>
          <td>Publication Instagram publique</td>
          <td>https://www.instagram.com/p/CODE/</td>
        </tr>
        <tr>
          <td>👣 Instagram – Abonnés</td>
          <td>Profil Instagram</td>
          <td>https://www.instagram.com/tonpseudo/</td>
        </tr>
        <tr>
          <td>▶️ YouTube – Vues</td>
          <td>Vidéo YouTube</td>
          <td>https://www.youtube.com/watch?v=CODE</td>
        </tr>
        <tr>
          <td>🔔 YouTube – Abonnés</td>
          <td>Chaîne YouTube</td>
          <td>https://www.youtube.com/@tonchaine</td>
        </tr>
        <tr>
          <td>🎵 TikTok – Vues/J’aime</td>
          <td>Vidéo TikTok</td>
          <td>https://www.tiktok.com/@pseudo/video/12345</td>
        </tr>
      </tbody>
    </table>

    <h3>⚠️ Ce qu’il ne faut pas faire</h3>
    <ul>
      <li>❌ Lien vers un compte privé</li>
      <li>❌ Lien raccourci (bit.ly, etc.)</li>
      <li>❌ Lien vers une story (non supporté)</li>
      <li>❌ Lien vide ou lien d’un autre réseau</li>
    </ul>

    <h3>✅ Astuces</h3>
    <ul>
      <li>Rends ton contenu <strong>public</strong> avant de passer commande</li>
      <li>Teste le lien dans un navigateur en navigation privée</li>
      <li>Utilise l’application officielle du réseau pour copier l’URL</li>
    </ul>

    <h3>📞 Besoin d’aide ?</h3>
    <p>Si tu n’es pas sûr du lien à utiliser, contacte-nous avant de commander :</p>
    <ul>
      <li>📧 Email : <a href="mailto: skyboostweb@gmail.com">skyboostweb@gmail.com</a></li>
   <li>🕐 Assistance disponible de 9h à 18h</li>
    </ul>
  </div>

  <footer>
    <p>&copy; 2025 SkyBoost - Tous droits réservés.</p>
  </footer>
</body>
</html>