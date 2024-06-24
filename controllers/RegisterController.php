
<?php
if (isset($_POST['register'])) {
    $mail = htmlspecialchars($_POST['mail']);


    


    if (count($errors) > 0) {
       header('location ?c=login');
    }else {
        include('./model/registerManager.php');
        register();
    }
}