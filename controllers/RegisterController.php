<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

if (isset($_POST['register'])) {
    // Get and sanitize form data
    $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL);
    $usrname = htmlspecialchars($_POST['user_name']);
    $password = htmlspecialchars($_POST['password']);
    $frstName = htmlspecialchars($_POST['first_name']);
    $lstName = htmlspecialchars($_POST['last_name']);
    $brthDate = htmlspecialchars($_POST['birth_date']);
    $confpass = htmlspecialchars($_POST['confpassword']);

    // Validate email
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
    } else {
        // Define the password requirement pattern
        $pattern = '/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{6,20}$/';

        // Check if the password meets the requirements
        if (!preg_match($pattern, $password) || ($password !== $confpass) ) {
            echo "Password should be 6 to 20 characters long, with at least one uppercase letter, one number, and one special character.<br>";
        } else {
            // Check for errors
            if (isset($errors) && count($errors) > 0) {
                header('location ?c=login');
            } else {
                require('../model/registerManager.php');
                register($mail,$usrname,$password,$frstName,$lstName,$brthDate);
            }
        }
    }
}
