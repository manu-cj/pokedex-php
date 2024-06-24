<?php
$title = "Home";
require_once __DIR__ . '../../partials/header.php';


?>

<main>
<section class="pkmn-section">
    <?php
    require('./model/allpkmnManager.php');
    getfirstPagePkmn();
    ?>
</section>
    <h1>Pokedex - Homepage</h1>
    <p>Hello <strong><?php echo $user['name'] ?></p></strong>
    
</main>

<?php
require_once __DIR__ . '../../partials/footer.php';
?>