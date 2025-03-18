<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'config.php';

    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hachage du mot de passe

    $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute(['username' => $username, 'password' => $password])) {
        echo "Inscription réussie ! <a href='login.php'>Se connecter</a>";
    } else {
        echo "Erreur lors de l'inscription.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <h2>Créer un compte</h2>
    <form action="signup.php" method="POST">
        <label for="username">Nom d'utilisateur :</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Mot de passe :</label><br>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="S'inscrire">
    </form>
</body>
</html>