<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $receiver = $_POST['friend'];
    $message = $_POST['message'];

    // Récupérer l'ID de l'ami
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username");
    $stmt->execute(['username' => $receiver]);
    $friend = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($friend) {
        $sender_id = $_SESSION['user_id'];
        $receiver_id = $friend['id'];

        $stmt = $pdo->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (:sender_id, :receiver_id, :message)");
        $stmt->execute(['sender_id' => $sender_id, 'receiver_id' => $receiver_id, 'message' => $message]);

        echo "Message envoyé !";
    } else {
        echo "L'utilisateur n'existe pas.";
    }
}

// Afficher les messages
$stmt = $pdo->prepare("SELECT messages.message, users.username FROM messages JOIN users ON messages.sender_id = users.id WHERE receiver_id = :receiver_id ORDER BY timestamp DESC");
$stmt->execute(['receiver_id' => $_SESSION['user_id']]);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messagerie</title>
</head>
<body>
    <h2>Messagerie</h2>
    <form action="messages.php" method="POST">
        <label for="friend">Destinataire :</label><br>
        <input type="text" id="friend" name="friend" required><br>
        <label for="message">Message :</label><br>
        <textarea id="message" name="message" required></textarea><br>
        <input type="submit" value="Envoyer">
    </form>

    <h3>Messages reçus :</h3>
    <?php foreach ($messages as $msg): ?>
        <p><strong><?= htmlspecialchars($msg['username']) ?> :</strong> <?= htmlspecialchars($msg['message']) ?></p>
    <?php endforeach; ?>

    <a href="logout.php">Se déconnecter</a>
</body>
</html>