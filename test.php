<?php
require_once 'php/api.php'; // Doit contenir $api_url et $api_key

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'] ?? '';

    if (empty($order_id)) {
        echo "Veuillez entrer un ID de commande.";
        exit;
    }

    // Prépare la requête à l'API
    $data = [
        'key' => $api_key,
        'action' => 'status',
        'order' => $order_id
    ];

    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $api_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($data)
    ]);

    $response = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);

    echo "<h3>Résultat brut de l'API :</h3>";
    if ($response) {
        echo "<pre>" . htmlspecialchars($response) . "</pre>";
    } else {
        echo "Erreur CURL : " . htmlspecialchars($error);
    }

    echo "<p><a href='test_api_status.php'>↩ Retour</a></p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Test API Status</title>
</head>
<body>
  <h2>Tester le statut d'une commande via l'API</h2>
  <form method="post">
    <label for="order_id">ID de commande API :</label>
    <input type="text" name="order_id" id="order_id" required>
    <button type="submit">Tester</button>
  </form>
</body>
</html>