<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.html");
    exit;
}
require_once('php/db.php');
$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM paiements_en_attente WHERE user_id = ? ORDER BY date_envoi DESC");
$stmt->execute([$user_id]);
$transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Mes Transactions - SkyBoost</title>
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .valide {
            background-color: #d4edda;
        }

        .en_attente {
            background-color: #fff3cd;
        }

        .rejete {
            background-color: #f8d7da;
        }
        .transaction-card {
    background-color: #fff;
    border: 1px solid #ddd;
    border-left: 5px solid #007bff;
    padding: 15px;
    margin-bottom: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
}

.transaction-card.valide {
    border-left-color: #28a745;
    background-color: #e9f7ef;
}

.transaction-card.en_attente {
    border-left-color: #ffc107;
    background-color: #fffbea;
}

.transaction-card.rejete {
    border-left-color: #dc3545;
    background-color: #fdecea;
}

.transaction-card p {
    margin: 5px 0;
}
    </style>
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
    
    <a href="depot.php" class="nav-link"><i class="fas fa-wallet"></i><span>Dépôt</span></a>
    <a href="mes_transactions.php" class="nav-link active"><i class="fas fa-money-check-alt"></i><span>Transactions</span></a>
    <a href="apropos.php" class="nav-link"><i class="fas fa-info-circle"></i><span>À propos</span></a>
    <a href="php/deconnexion.php" class="nav-link"><i class="fas fa-sign-out-alt"></i><span>Déconnexion</span></a>
</nav>

<div class="container">
    <h2>📋 Mes Transactions</h2>

    <div class="info-validation" style="background: #fff8e1; padding: 10px; border-left: 5px solid #ffc107; margin-bottom: 20px;">
        <p><strong>⏰ Horaires de validation des paiements :</strong></p>
        <ul>
            <li>🕗 08h00 - 10h00</li>
            <li>🕒 15h00 - 16h00</li>
        </ul>
        <p>✅ Votre paiement peut aussi être validé plus tôt si le nombre de demandes est faible.</p>
    </div>

    <?php if (count($transactions) > 0): ?>
        <?php foreach ($transactions as $tx): ?>
    <div class="transaction-card <?= $tx['statut'] ?>">
        <p><strong>💳 Montant :</strong> <?= htmlspecialchars($tx['montant']) ?> FCFA</p>
        <p><strong>📱 Réseau :</strong> <?= htmlspecialchars($tx['reseau']) ?></p>
        <p><strong>📞 Numéro :</strong> <?= htmlspecialchars($tx['telephone']) ?></p>
        <p><strong>📧 Email :</strong> <?= htmlspecialchars($tx['email']) ?></p>
        <p><strong>🔢 ID Transaction :</strong> <code><?= htmlspecialchars($tx['transaction_id']) ?></code></p>
        <p><strong>📅 Date :</strong> <?= date('d/m/Y H:i', strtotime($tx['date_envoi'])) ?></p>
        <p><strong>✅ Statut :</strong>
            <?php
            if ($tx['statut'] == 'valide') echo "Validé ✅";
            elseif ($tx['statut'] == 'en_attente') echo "En attente ⏳";
            else echo "Rejeté ❌";
            ?>
        </p>
    </div>
<?php endforeach; ?>
    <?php else: ?>
        <p>Vous n'avez effectué aucune transaction pour le moment.</p>
    <?php endif; ?>
</div>

<footer>
    <p>&copy; 2025 SkyBoost - Tous droits réservés.</p>
</footer>

</body>
</html>