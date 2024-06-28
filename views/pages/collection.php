<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
require_once __DIR__ . '../../partials/header.php';
require('./model/favoriteManager.php');
require('./model/userManager.php');
?>

<section class="favorite-page">
    <div class="user-list">
        <h2>Other Users</h2>
        <?php
        getUsers();
        ?>
    </div>
    <div class="favorite-card">
    <div class="titlePage">
<h2>Collection de : <?=$_GET['username'];?></h2>
</div>
        <section class="pkmn-section">
            <?php
            $username = $_GET['username'];
            getFavorite($username);
            ?>
        </section>
    </div>
</section>
<?php
require_once __DIR__ . '../../partials/footer.php';
?>