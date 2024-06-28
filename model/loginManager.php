<?php
require_once '../Engine/connect.php';

function verifyCredentials($email, $password) {
    global $conn;

    // Correction de la requête SQL
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute([':email' => $email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION["user"] = ['username'=> $user['username'],'user_role'=> $user['user_role'],'verification_token'=> $user['verification_token'],'user_id'=> $user['user_id'], 'first_name'=>$user['first_name'], 'last_name'=>$user['last_name'],'mail'=>$user['email']];
        return true;
    }

    return false;
}
