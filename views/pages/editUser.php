<?php

$title = "Edit User";
require_once __DIR__ . '../../partials/header.php';
?>

<main>
    
    <form method="post" class="register-form" action="./controllers/editController.php" >

        
        <label for="mail">E-mail</label>
        <input type="email" name="mail">

        <label for="user_name">Username</label>
        <input type="text" name="user_name">

        <label for="password">Password</label>
        <input type="password" name="password">

        <label for="confpassword">Confirm password</label>
        <input type="password" name="confpassword">

        <label for="first_name">First name</label>
        <input type="text" name="first_name">

        <label for="last_name">Last name</label>
        <input type="text" name="last_name">

        <label for="birth_date">Birth date</label>
        <input type="date" name="birth_date">

        <label for="role">Role</label>
        <input type="number" name="role">

        <button type="submit" name="register">ok</button>

    </form>

</main>

<?php
require_once __DIR__ . '../../partials/footer.php';
?>