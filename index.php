<?php

function getPath($page) {
    require __DIR__ . "/views/pages/".$page.".php";
}
function getAction($page) {
    require __DIR__ . "/controllers/".$page.".php";
}

if (!isset($_GET["c"])) {
    header('Location: ?c=home');
}

function secureUrl($url) {
    $url = strip_tags($url);
    $url = trim($url);
    $url = htmlspecialchars($url);

    return $url;
}


$c = secureUrl($_GET['c']);
switch ($c) {
    case 'home':
       getPath("index");
        break;
    case 'pokemon':
        getPath("show");
        break;
    case 'login':
        getPath("login");
         break;
    case 'logout':
        getPath("logout");
        break;
    case 'register':
        getPath("register");
        break;
    case 'search':
        getPath("search");
    case 'adminPanel':
        getPath("adminPanel");
    case 'connect':
        require __DIR__ . "./controllers/loginController.php";
        break;
    
    default:
        require __DIR__ . "/views/errors/404.php";
        break;
}


if (isset($_GET['a'])) {
    $a = secureUrl($_GET["a"]);

switch ($a) {
    case 'connect':
        getAction("loginController");
        break;
    case 'register':
        getAction("RegisterController");
        break;
    case 'edit':
        getAction("editController");
        break;
    default:
        getPath("404");
        break;
}
}




