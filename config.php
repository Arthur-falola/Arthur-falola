<?php
$host = 'localhost'; // Change selon ton serveur de base de données
$dbname = 'messagerie';
$username = 'root'; // Ton nom d'utilisateur MySQL
$password = ''; // Ton mot de passe MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>