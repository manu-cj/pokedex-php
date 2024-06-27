<?php

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
<!-- 'username', 'user_role','verification_token','user_id', 'first_name', 'last_name' -->
    <pre>
    <?php print_r( $_SESSION['user'])?>
    </pre>
    <button>modifier</button>

    <!-- afficher les info du user ensuite qd il appuie sur le bouton modifier l'utilisateur 
     dois pouvoir voir ces info et les modifier avec le btn push Enfin je dois faire modif mots de passe separement -->

</main>

<?php

require_once __DIR__ . '../../partials/footer.php';

?>