<?php
session_start();

function sanitizeInput($data) {
    return htmlspecialchars(trim($data));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['errors'] = [];

    $email = sanitizeInput($_POST["email"]);
    $password = sanitizeInput($_POST["password"]);

    // Vérification des champs vides
    if (empty($email) || empty($password)) {
        $_SESSION['errors'][] = "Tous les champs sont obligatoires.";
    } else {
        // Validation de l'email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['errors'][] = "Adresse e-mail invalide.";
        } else {

            // Inclure le gestionnaire de connexion
            require '../model/loginManager.php';

            // Appeler la fonction pour vérifier les identifiants
            if (verifyCredentials($email, $password)) {
                // Connexion réussie
                echo 'its ok';
                echo "<script>window.location.href = 'http://localhost:5001/index.php';</script>";
                exit();
            } else {
                // Identifiants incorrects
                $_SESSION['errors'][] = "E-mail ou mot de passe incorrect.";
            }
        }
    }

    // Rediriger vers la page de connexion si des erreurs sont présentes
    if (!empty($_SESSION['errors'])) {
        echo "it's not ok";
        // header("Location: ?c=login");
        exit();
    }
} else {
    header("Location: ?c=login");
    exit();
}
?>
