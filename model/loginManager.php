<?php
require_once '../Engine/connect.php';

function verifyCredentials($email, $password) {
    global $conn;

    // Correction de la requête SQL
    $stmt = $conn->prepare("SELECT username, password_hash FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION["user"] = $user['username'];
        return true;
    }

    return false;
}
