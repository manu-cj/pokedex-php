<?php
require 'engine/connect.php';

$email = 'aze@aze.com';
$password = 'aze';
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (email, password_hash) VALUES (:email, :password)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
$stmt->execute();

echo "Utilisateur inséré avec succès.";
