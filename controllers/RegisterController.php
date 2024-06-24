<?php
if (isset($_POST['register'])) {
    // Get and sanitize form data
    $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL);
    $usrname = htmlspecialchars($_POST['user_name']);
    $password = htmlspecialchars($_POST['password']);
    $frstName = htmlspecialchars($_POST['first_name']);
    $lstName = htmlspecialchars($_POST['last_name']);
    $brthDate = htmlspecialchars($_POST['birth_date']);

    // Validate email
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
    } else {
        // Define the password requirement pattern
        $pattern = '/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/';

        // Check if the password meets the requirements
        if (!preg_match($pattern, $password)) {
            echo "Password should be 8 to 20 characters long, with at least one uppercase letter, one number, and one special character.";
        } else {
            // Check for errors
            if (isset($errors) && count($errors) > 0) {
                header('location ?c=login');
            } else {
                include('./model/registerManager.php');
                register();
            }
        }
    }
}
