<?php
$title = "Home";
require_once __DIR__ . '../../partials/header.php';
?>

<main>
    
    <form action="./../../controllers/RegisterController.php">

        
        <label for="mail"></label>
        <input type="email" name="mail">

        <label for="user_name"></label>
        <input type="text" name="user_name">

        <label for="password"></label>
        <input type="text" name="password">

        <label for="first_name"></label>
        <input type="text" name="first_name">

        <label for="last_name"></label>
        <input type="text" name="last_name">

        <label for="birth_date"></label>
        <input type="date" name="birth_date">

        <button type="submit" name="register">Ok</button>

    </form>

</main>

<?php
require_once __DIR__ . '../../partials/footer.php';
?>