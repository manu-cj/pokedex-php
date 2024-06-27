<?php
require_once '../Engine/connect.php';

function verifyCredentials($email, $password) {
    global $conn;

    // Correction de la requête SQL
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute([':email' => $email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION["user"] = ['username : ' . $user['username'], 'role :'. $user['user_role']];
        return true;
    }

    return false;
}
