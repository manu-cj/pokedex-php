<?php
$servername = "localhost:3306"; // Vous devriez le changer chez vous à mon avis
$username = "root";
$password = "password"; // le mot de passe de votre config
$dbname = "pokedex";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Définir le mode d'erreur PDO à exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Échec de la connexion : " . $e->getMessage());
}