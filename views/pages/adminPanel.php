<?php
session_start();
$title = "Admin Panel";

require_once __DIR__ . '../../partials/header.php';

//! A DEPLACER
$servername = "localhost:3306"; // Vous devriez le changer chez vous à mon avis
$username = "root";
$pwd = "password"; // le mot de passe de votre config
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

<main>
    <h1>Admin Panel</h1>
    <ul id="userList">
    <?php
    // Préparation de la requête pour obtenir les utilisateurs
    $sql = 'SELECT * FROM users';
    $select = $conn->prepare($sql);

    if ($select->execute()) {
        // Récupération de tous les utilisateurs
        $users = $select->fetchAll(PDO::FETCH_ASSOC);

        foreach ($users as $user) {
            // Affichage de chaque utilisateur
            ?>
                <li><?php echo $user['username'];?></li>
                <input type="button" value="edit">
                <input type="button" value="ban">
            <?php
        }
    } else {
        echo '<li>Échec de la récupération des utilisateurs.</li>';
    }
    ?>
    </ul>
</main>
