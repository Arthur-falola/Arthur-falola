<?php
session_start();

// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
  echo "Erreur : vous devez être connecté pour effectuer un paiement.";
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Récupérer les données depuis le formulaire
  $user_id = $_SESSION['user_id'];
  $prenom = $_POST['prenom'];
  $nom = $_POST['nom'];
  $email = $_POST['email'];
  $telephone = $_POST['telephone'];
  $montant = intval($_POST['montant']);

  // Générer une référence unique
  $reference = 'CMD' . time();

  // Connexion à la base de données
  require_once('php/db.php');

  // Enregistrer la transaction
  $stmt = $pdo->prepare("INSERT INTO transactions (user_id, reference, montant, statut) VALUES (?, ?, ?, 'en attente')");
  $stmt->execute([$user_id, $reference, $montant]);

  // Infos Paiement Pro
  $merchantId = 'PP-F6055'; // Remplace par ton identifiant réel
  $cle_secrete = 'MA_CLE_SECRETE_ICI'; // Fournie par Paiement Pro

  // Génération du hashcode
  $hashcode = hash('sha256', $merchantId . $reference . $montant . $cle_secrete);
  // si ça échoue, j'essaie : $hashcode = md5(...);

  // Préparer les paramètres
  $params = array(
    'merchantId' => $merchantId,
    'countryCurrencyCode' => '952',
    'amount' => $montant,
    'customerId' => $user_id,
    'channel' => 'MOMOBJ', // Forcé à Mobile Money
    'customerEmail' => $email,
    'customerFirstName' => $prenom,
    'customerLastname' => $nom,
    'customerPhoneNumber' => $telephone,
    'referenceNumber' => $reference,
    'notificationURL' => 'http://skyboost.me/php/notification.php',
    'returnURL' => 'http://skyboost.me/retour.php',
    'description' => 'Recharge de solde SkyBoost',
    'returnContext' => 'client=' . $user_id,
    'hashcode' => $hashcode
  );

  // Appel API Paiement Pro
  try {
    ini_set("soap.wsdl_cache_enabled", 0);
    $wsdl = "https://www.paiementpro.net/webservice/OnlineServicePayment_v2.php?wsdl";
    $client = new SoapClient($wsdl, array('cache_wsdl' => WSDL_CACHE_NONE));
    $response = $client->initTransact($params);

    if ($response->Code == 0) {
      $sessionid = $response->Sessionid;
      header("Location: https://www.paiementpro.net/webservice/onlinepayment/processing_v2.php?sessionid=$sessionid");
      exit;
    } else {
      echo "Erreur Paiement Pro : " . $response->Description;
    }

  } catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
  }
}
?>