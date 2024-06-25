<?php
session_start();
$title = "Home";
require_once __DIR__ . '../../partials/header.php';


?>

<main>
<h1>Pokedex - Homepage</h1>
<p>Hello <strong><?php echo $_SESSION["user"] ?></p></strong>
<section class="pkmn-section">
    <?php
    require('./model/allpkmnManager.php');
    
    page1();
    
    ?>
</section> 
</main>

<?php
require_once __DIR__ . '../../partials/footer.php';
?>