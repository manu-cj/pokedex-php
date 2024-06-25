<?php
$title = "page 2";
require_once __DIR__ . '../../partials/header.php';


?>

<main>
<h1>Pokedex - Homepage</h1>
<p>Hello <strong><?php echo $user['name'] ?></p></strong>
<section class="pkmn-section">
    <?php
    require('./model/allpkmnManager.php');
    
    page2();
    
    ?>
</section> 
</main>

<?php
require_once __DIR__ . '../../partials/footer.php';
?>