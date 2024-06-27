<?php

session_start();
$title = "Home";
print_r($_SESSION['user']);
require_once __DIR__ . '../../partials/header.php';


?>

<main>
<h1>Pokedex - Homepage</h1>
<p>Hello <strong><?php echo $_SESSION['user'][0]; ?></p></strong>
<section class="pkmn-section">
    <?php
   
    require('./model/allpkmnManager.php');


    $page = $_GET['page'];

    if (isset($page)) {
        $page = strip_tags($page);
        $page = trim($page);
        $page = htmlspecialchars($page);
    }
   

    switch ($page) {
        case 1:
            page1(0);
            break;
        case 2:
            page1(30);
            break;
        case 3:
            page1(60);
            break;
        case 4:
            page1(90);
            break;
        case 5:
            page1(120);
            break;
        case 6:
            page1(150);
            break;
        case 7:
            page1(180);
            break;
        case 8:
            page1(210);
            break;
        case 9:
            page1(240);
            break;
        case 10:
            page1(270);
            break;
        case 11:
            page1(300);
            break;
        case 12:
            page1(330);
            break;
        case 13:
            page1(360);
            break;
        case 14:
            page1(390);
            break;
        case 15:
            page1(420);
            break;
        case 16:
            page1(450);
            break;
        case 17:
            page1(480);
            break;
        case 18:
            page1(510);
            break;
        case 19:
            page1(540);
            break;
        case 20:
            page1(570);
            break;
        case 21:
            page1(600);
            break;
        case 22:
            page1(630);
            break;
        case 23:
            page1(660);
            break;
        case 24:
            page1(690);
            break;
        case 25:
            page1(720);
            break;
        case 26:
            page1(750);
            break;
        case 27:
            page1(780);
            break;
        case 28:
            page1(810);
            break;
        case 29:
            page1(840);
            break;
        case 30:
            page1(870);
            break;
        case 31:
            page1(900);
            break;
        case 32:
            page1(930);
            break;
        case 33:
            page1(960);
            break;
        case 34:
            page1(990);
            break;
        default:
            page1(0);
            break;
    }
    
    ?>
</section> 
<section class="pagination-section">
    <?php

if ($page <= 5) {
    $start = 1;
} elseif ($page > 5 && $page <= 10) {
    $start = 5;
} elseif ($page > 10 && $page <= 15) {
    $start = 10;
} elseif ($page > 15 && $page <= 20) {
    $start = 15;
} elseif ($page > 20 && $page <= 25) {
    $start = 20;
} elseif ($page > 25 && $page <= 34) {
    $start = 25;
} else {
    $start = 1;
}

if ($page > 14) {
    ?>
        <a href="?c=home&page=<?= 1 ?>" title="First page"><i class="fas fa-angle-double-left"></i></a>

    <?php
}

if ($page > 1) {
    ?>
        <a href="?c=home&page=<?= $page-=1 ?>"><i class="fas fa-caret-left"></i></a>

    <?php
}


for ($i = $start; $i < min($start + 10, 35); $i++) {
    ?>
    <a href="?c=home&page=<?= $i ?>"><?= $i ?></a>
    

    <?php
}
if (!isset($page)) {
    $page = 1;
}
       
    ?>

    <a href="?c=home&page=<?= $page+=1 ?>"><i class="fas fa-caret-right"></i></a>
    <?php
if ($page < 14) {
    ?>
        <a href="?c=home&page=<?= 34 ?>" title="Last page"><i class="fas fa-angle-double-right"></i></a>

    <?php
}
    ?>
</section>
</main>

<?php
require_once __DIR__ . '../../partials/footer.php';
?>