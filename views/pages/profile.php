<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start(); // Start the session
$title = "profile";

if (!isset($_SESSION['user'])) {
    
    header('Location: ?c=home');
    exit; 
}

print_r($_SESSION['user']);

require_once __DIR__ . '../../partials/header.php';



?>
<main>
    <?php 
    if ($_SESSION['user']['user_role'] == 1) {
        echo '<p>admin</p>';
    } else {
        echo '<p>user</p>';
    }
    ?>

    <div class="userInfo">
    <form id="modifUserform" method="post" action="./controllers/modifController.php">
        <?php
        foreach ($_SESSION['user'] as $key=>$value) {
            if ($value != $_SESSION['user']['verification_token'] && $value != $_SESSION['user']['user_id']
                && $value != $_SESSION['user']['user_role']) {
                echo "<label for=$key> $key</label>";
                echo '<div class="info"><input name='.$key.' type="text" value='. $value .'></div>';
            }
        }
        ?>
        <label for="password">Put your password to confirm changes</label>
        <input type="password" name="password">
        <input type="submit" name="update" value="uptade">
    </form> 
    </div>
</main>


<?php

require_once __DIR__ . '../../partials/footer.php';

?>