<?php
session_start();
$title = "login";
require_once __DIR__ . '../../partials/header.php';
?>
<main>
    <form id="loginForm" method="post" action="./../../controllers/loginController.php">
        <h2>Mon compte</h2>

        <label for="emailID">E-mail :</label>
        <input type="email" name="email" id="emailID" placeholder="example@email.com" autocomplete="email">

        <label for="passwordID">Mot de passe :</label>
        <input type="password" name="password" id="passwordID" placeholder="*********">

        <?php
        if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
            echo '<p id="loginError" style="color: red;">';
            foreach ($_SESSION['errors'] as $error) {
                echo htmlspecialchars($error) . '<br>';
            }
            echo '</p>';

            unset($_SESSION['errors']);
        }
        ?>

        <button name="submit" type="submit">Connexion</button>
    </form>
</main>

<?php
require_once __DIR__ . '../../partials/footer.php';
?>