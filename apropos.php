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
            <title>SkyBoost - À Propos</title>
                <link rel="stylesheet" href="css/style1.css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
                </head>
                <body>
                <!-- Inclure l'assistant SkyBoost -->
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
                                                                                                                                                                                                                                                                                                                                          <a href="mes_transactions.php" class="nav-link active"><i class="fas fa-money-check-alt"></i><span>Transactions</span></a>                    <a href="depot.php" class="nav-link active"><i class="fas fa-wallet"></i><span>Dépôt</span></a>
                                                                                                                                                                                                                                                          <a href="apropos.php" class="nav-link"><i class="fas fa-info-circle"></i><span>À propos</span></a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <a href="php/deconnexion.php" class="nav-link"><i class="fas fa-sign-out-alt"></i><span>Déconnexion</span></a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  </nav>                                                                                                                       <div class="container">
                                                                                                                                <h2>À Propos de SkyBoost</h2>
                                                                                                                                        
                                                                                                                                                <h3>Notre Mission</h3>
                                                                                                                                                        <p>Chez <strong>SkyBoost</strong>, nous avons une seule ambition : vous aider à réussir sur les réseaux sociaux. Nous savons à quel point la visibilité est essentielle pour être remarqué, créer de l'engagement et développer une audience fidèle. C'est pourquoi nous mettons à votre disposition des services fiables et efficaces pour booster votre présence en ligne en toute sécurité.</p>
                                                                                                                                                                
                                                                                                                                                                        <h3>Nos Valeurs</h3>
                                                                                                                                                                                <h4>Honnêteté et Transparence</h4>
                                                                                                                                                                                        <p>Nous croyons en une relation de confiance avec nos clients. Chez SkyBoost, chaque service que nous proposons est clair, sans frais cachés, ni mauvaises surprises. Vous obtenez exactement ce pour quoi vous payez.</p>
                                                                                                                                                                                                
                                                                                                                                                                                                        <h4>Qualité et Satisfaction</h4>
                                                                                                                                                                                                                <p>Votre satisfaction est notre priorité. Nous travaillons avec des systèmes performants et éthiques pour vous fournir des abonnés, des vues, des likes et des interactions réels et pertinents.</p>
                                                                                                                                                                                                                        
                                                                                                                                                                                                                                <h4>Sécurité et Confidentialité</h4>
                                                                                                                                                                                                                                        <p>Nous respectons la confidentialité de nos clients et nous garantissons un traitement sécurisé de chaque commande. Aucune information personnelle ne sera partagée ou utilisée à des fins malveillantes.</p>
                                                                                                                                                                                                                                                
                                                                                                                                                                                                                                                        <h3>Pourquoi Choisir SkyBoost ?</h3>
                                                                                                                                                                                                                                                                <ul>
                                                                                                                                                                                                                                                                            <li><strong>Aucun vol, aucun abus</strong> : Nos transactions sont transparentes et honnêtes.</li>
                                                                                                                                                                                                                                                                                        <li><strong>Résultats garantis</strong> : Nous offrons des services de qualité pour une croissance rapide et efficace.</li>
                                                                                                                                                                                                                                                                                                    <li><strong>Support client réactif</strong> : Une équipe disponible pour répondre à toutes vos questions et vous accompagner.</li>
                                                                                                                                                                                                                                                                                                                <li><strong>Services adaptés à tous</strong> : Que vous soyez influenceur, entreprise ou particulier, nous avons des solutions sur mesure.</li>
                                                                                                                                                                                                                                                                                                                        </ul>

                                                                                                                                                                                                                                                                                                                                <h3>Contactez-nous</h3>
                                                                                                                                                                                                                                                                                                                                        <p>Besoin d'informations ou d'assistance ? N'hésitez pas à nous contacter via notre page de contact ou directement par email. Rejoignez-nous et boostez votre notoriété avec SkyBoost !</p>
                                                                                                                                                                                                                                                                                                                                            </div>

                                                                                                                                                                                                                                                                                                                                                <footer>
                                                                                                                                                                                                                                                                                                                                                        <p>&copy; 2025 SkyBoost - Tous droits réservés.</p>
                                                                                                                                                                                                                                                                                                                                                            </footer>
                                                                                                                                                                                                                                                                                                                                                            </body>
                                                                                                                                                                                                                                                                                                                                                            </html>
                                                                                                                                                                                                                                                                                                                                                            