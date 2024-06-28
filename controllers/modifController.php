<?php
session_start();
require '../Engine/connect.php';
if(isset($_POST['update'])&& isset($_SESSION['user'])){
    $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL);
    $usrname = htmlspecialchars($_POST['username']);
    $pswd = trim(htmlspecialchars($_POST['password']));
    $frstName = htmlspecialchars($_POST['first_name']);
    $lstName = htmlspecialchars($_POST['last_name']);

    $token = $_SESSION['user']['verification_token'];

    if(passwordCorrect($pswd,$token)){

        require '../model/modiManager.php';

        updateData($mail,$usrname,$frstName,$lstName,$token);

    }else{
        echo'kawwoud';
    }
}

function passwordCorrect($pswrd, $tkn) {

    global $conn;
    // Corrected SQL query
    $stmt = $conn->prepare("SELECT * FROM users WHERE verification_token = :tkn");
    $stmt->execute([':tkn' => $tkn]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    var_dump(password_verify($pswrd, $user['password_hash']));

    // if (password_verify($pswrd, $user['password_hash'])) {
    //     return true;
    // }
    // return false;
}
