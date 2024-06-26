<?php
session_start();
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

function register($mail,$usrname,$password,$frstName,$lstName,$brthDate,$token) {

    require '../Engine/connect.php';

    try {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        $sql = "INSERT INTO users (email, username, password_hash, first_name, last_name, date_of_birth, verification_token, user_role ) VALUES (:mail, :username, :password, :frstname, :lstname, :brthdate, :verification_token,:user_role)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':username', $usrname);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':frstname', $frstName);
        $stmt->bindParam(':lstname', $lstName);
        $stmt->bindParam(':brthdate', $brthDate);
        $stmt->bindParam(':verification_token', $token);
        $stmt->bindValue(':user_role',$userrole = 1);
        $stmt->execute();
        echo "<script>alert('User registered successfully.'); window.location.href = 'http://localhost:5001/?c=login';</script>";
        $_SESSION["registration"] = true;
    } catch (PDOException $e) {
        // Handle the exception (e.g., log it, display an error message, etc.)
        echo "Error: " . $e->getMessage();
        echo "<script>alert('Error'".$e->getMessage()."); window.location.href = 'http://localhost:5001/?c=register';</script>";
    }
    
}