<?php

$title = "Home";
require_once __DIR__ . '../../partials/header.php';
?>

<main>
    
    <form method="post" class="register-form" action="./controllers/RegisterController.php" >

        
        <label for="mail">Your mail</label>
        <input type="email" name="mail">

        <label for="user_name">Username</label>
        <input type="text" name="user_name">

        <label for="password">your password</label>
        <input type="password" name="password">

        <label for="confpassword">confirm password</label>
        <input type="password" name="confpassword">

        <label for="first_name">First name</label>
        <input type="text" name="first_name">

        <label for="last_name">Last name</label>
        <input type="text" name="last_name">

        <label for="birth_date">Birth date</label>
        <input type="date" name="birth_date">

        <button type="submit" name="register">ok</button>

    </form>

</main>

<?php
require_once __DIR__ . '../../partials/footer.php';
?>