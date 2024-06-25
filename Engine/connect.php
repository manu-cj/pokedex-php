<?php

$servername = "db"; // Vous devriez le changer chez vous à mon avis
$username = "root";
$pwd = "rootpassword"; // le mot de passe de votre config
$dbname = "pokedex";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $pwd);
    // Définir le mode d'erreur PDO à exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connexion réussie à la base de données";
} catch(PDOException $e) {
    die("Échec de la connexion : " . $e->getMessage());
}
?>