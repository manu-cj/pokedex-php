<?php
session_start();
$title = "Admin Panel";

require_once __DIR__ . '../../partials/header.php';

//! A DEPLACER
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
                <li><?php echo $user['first_name'].' '.$user['last_name'];?>
                <form method="POST" action="" style="display:inline;">
                    <input type="hidden" name="user_token" value="<?= $user['verification_token']; ?>">
                    <input type="hidden" name="action" value="edit">
                    <input type="submit" value="edit">
                </form>
                <form method="POST" action="" style="display:inline;">
                    <input type="hidden" name="user_token" value="<?= $user['verification_token']; ?>">
                    <input type="hidden" name="action" value="ban">
                    <input type="submit" value="ban">
                </form>
                </li>
            <?php
        }
    } else {
        echo '<li>Échec de la récupération des utilisateurs.</li>';
    }
    ?>
    </ul>
</main>
<?php
require_once __DIR__ . '../../partials/footer.php';
?>
</body>
</html>
<?php
// Gérer les actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && isset($_POST['user_id'])) {
        $action = $_POST['action'];
        $userToken = $_POST['user_token'];

        if ($action == 'edit') {
            // Logique pour éditer l'utilisateur
            // Vous pouvez rediriger vers une page d'édition ici
            $_SESSION['editUser'] = $userToken;
            header('Location: ./../../controllers/editController.php');
            exit;
        } elseif ($action == 'ban') {
            // Logique pour bannir l'utilisateur
            $sql = 'UPDATE users SET is_active = 0 WHERE id = :id';
            $update = $conn->prepare($sql);
            $update->bindParam(':id', $userId);
            if ($update->execute()) {
                echo "Utilisateur banni avec succès.";
            } else {
                echo "Échec du bannissement de l'utilisateur.";
            }
        }
    }
}
?>