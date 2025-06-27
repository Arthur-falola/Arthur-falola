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
    <link rel="apple-touch-icon" sizes="180x180" href="https://arthur-falola.github.io/skyboostfavicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://arthur-falola.github.io/skyboostfavicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://arthur-falola.github.io/skyboostfavicon/favicon-16x16.png">
    <link rel="manifest" href="https://arthur-falola.github.io/skyboostfavicon/site.webmanifest">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dépôt - SkyBoost</title>
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<!-- Assistant SkyBoost -->
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
   <a href="mes_transactions.php" class="nav-link active"><i class="fas fa-money-check-alt"></i><span>Transactions</span></a>
    <a href="depot.php" class="nav-link active"><i class="fas fa-wallet"></i><span>Dépôt</span></a>
    <a href="apropos.php" class="nav-link"><i class="fas fa-info-circle"></i><span>À propos</span></a>
    <a href="php/deconnexion.php" class="nav-link"><i class="fas fa-sign-out-alt"></i><span>Déconnexion</span></a>
</nav>

<div class="container">
    <h2>Faire un dépôt</h2>
    <p>Veuillez transférer les fonds vers l’un des numéros ci-dessous avant de remplir ce formulaire.</p>

    <div class="info-paiement" style="background: #f2f2f2; padding: 10px; border-left: 5px solid #00aaff; margin-bottom: 20px;">
      <p>Exécutez les codes USSD suivants selon le réseau que vous utilisez </p>
        <p><strong>MTN :</strong> *880*41*535445*montant#</p>
        <p><strong>Moov :</strong> *855*4*1*248851*montant#</p>
        
        <p><strong>NB :</strong> Ajoutez ce code dans la référence du transfert : <strong>SKYBOOST</strong></p>
    </div>

    <form id="formDepot"  action="php/traitement_depot.php" method="post">
        <label>Montant envoyé :</label><br>
        <input type="number" name="montant" required><br><br>

        <label>Réseau utilisé :</label><br>
        <select name="reseau" required>
            <option value="">-- Choisir --</option>
            <option value="MTN">MTN</option>
            <option value="Moov">Moov</option>
            
        </select><br><br>

        <label>Numéro de téléphone utilisé :</label><br>
        <input type="text" name="telephone" required><br><br>

        <label>Nom complet :</label><br>
        <input type="text" name="nom" required><br><br>

        <label>Email :</label><br>
        <input type="email" name="email" required><br><br>

        <label>ID de transaction (dans le SMS de la transaction) :</label><br>
        <input type="text" name="transaction_id" placeholder="Commence par 10..." required><br><br>

        <input type="submit" value="Soumettre le paiement" style="background-color:blue;color: white;">
    </form>
</div>
<div class="info-validation" style="background: #fff8e1; padding: 10px; border-left: 5px solid #ffc107; margin-top: 20px;">
    <p><strong>⏰ Horaires de validation des dépôts :</strong></p>
    <ul>
        <li>🕗 08h00 - 10h00</li>
        <li>🕒 15h00 - 16h00</li>
    </ul>
    <p>⚠️ En dehors de ces horaires, votre dépôt sera validé lors de la prochaine session.</p>
</div>

<footer>
    <p>&copy; 2025 SkyBoost - Tous droits réservés.</p>
</footer>

<script>
document.getElementById('formDepot').addEventListener('submit', function(event) {
    event.preventDefault(); // bloque l'envoi du formulaire par défaut

    // Affiche un popup avec 2 boutons Oui / Non (confirm())
    let confirmation = confirm("Assurez-vous d'avoir déjà fait la transaction.\n\nCliquez sur OK si oui, Annuler si non.");

    if (confirmation) {
        // l'utilisateur a cliqué "OK" = Oui, on envoie le formulaire
        this.submit();
    } else {
        // l'utilisateur a cliqué "Annuler" = Non, on ne fait rien, formulaire non soumis
        alert("Veuillez effectuer la transaction avant de soumettre.");
    }
});
</script>

</body>
</html>