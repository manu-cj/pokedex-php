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

    

</main>

<?php

require_once __DIR__ . '../../partials/footer.php';

?>