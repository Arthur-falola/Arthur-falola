<?php
session_start();

// Initialisation si pas encore définie
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
 <link rel="manifest" href=" https://arthur-falola.github.io/skyboostfavicon/site.webmanifest">
    <meta charset="UTF-8">
        <title>Mes Commandes - SkyBoost</title>
            <link rel="stylesheet" href="css/style1.css"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
            </head>
            <body>
                <header>
                        <h1>Mes Commandes</h1>
                           <?php include 'solde.php'; ?>     
                                
                                    </div>
                                        <div class="user-info" style="text-align: right; margin: 10px;">
                                                <?php if (isset($_SESSION['username'])): ?>
                                                            <p style="font-weight: bold;">Bienvenue, <?php echo htmlspecialchars($_SESSION['username']); ?> !</p>
                                                                    <?php endif; ?>
                                                                        </div>
                                                                            </header>
                                                         <nav id="nav-men">
                                                                                                                                                 <a href="index.php" class="nav-link"><i class="fas fa-home"></i><span>Accueil</span></a>
                                                                                                                                                                                                                                           <a href="mes_commandes.php" class="nav-link"><i class="fas fa-list"></i><span>Commandes</span></a>
                                                                                                                                                                                                                                                                                                                                       <a href="mes_transactions.php" class="nav-link active"><i class="fas fa-money-check-alt"></i><span>Transactions</span></a>                                                                                                                                                                                                                                                    <a href="depot.php" class="nav-link active"><i class="fas fa-wallet"></i><span>Dépôt</span></a>
                                                                           <a href="apropos.php" class="nav-link"><i class="fas fa-info-circle"></i><span>À propos</span></a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <a href="php/deconnexion.php" class="nav-link"><i class="fas fa-sign-out-alt"></i><span>Déconnexion</span></a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              </nav>                  
                                                                                                                <div class="container">
                                                                                                                <?php if (isset($_GET['commande']) && $_GET['commande'] === 'ok'): ?>
                                                                                                                    <div class="success-message">
                                                                                                                            Votre commande a été enregistrée avec succès !
                                                                                                                                </div>
                                                                                                                                <?php endif; ?>
                                                                                                                        <h2>Historique de vos commandes</h2>
                                                                                                                                <div id="commandes">
                                                                                                                                            <?php include("php/afficher_commandes.php"); ?>
                                                                                                                                                    </div>
                                                                                                                                                        </div>

                                                                                                                                                            <footer>
                                                                                                                                                                    <p>&copy; 2025 SkyBoost - Tous droits réservés.</p>
                                                                                                                                                                        </footer>
                                                                                                                                                                        </body>
                                                                                                                                                                        </html>