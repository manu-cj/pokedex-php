<?php
session_start();

function sanitizeInput($data) {
    return htmlspecialchars(trim($data));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = sanitizeInput($_POST["email"]);
    $password = sanitizeInput($_POST["password"]);

    $_SESSION['errors'] = [];

    if (empty($email) || empty($password)) {
        $_SESSION['errors'][] = "Tous les champs sont obligatoires.";
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['errors'][] = "Adresse e-mail invalide.";
        }

        // Vérifier les informations d'identification (exemple simple)
        $dummy_user = "test@test.com";
        $dummy_password = "aze";

        if ($email === $dummy_user && $password === $dummy_password) {
            // Connexion réussie
            $_SESSION["user"] = $email;
            header("Location: ../views/pages/index.php");
            exit();
        } else {
            $_SESSION['errors'][] = "E-mail ou mot de passe incorrect.";
        }
    }

    // Rediriger vers la page de connexion si des erreurs sont présentes
    if (!empty($_SESSION['errors'])) {
        header("Location: ../views/pages/login.php");
        exit();
    }
} else {
    header("Location: ../views/pages/login.php");
    exit();
}
?>
