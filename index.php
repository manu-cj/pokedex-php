<?php

function getPath($page) {
    require __DIR__ . "/views/pages/".$page.".php";
}
function getAction($page) {
    require __DIR__ . "/Controller/".$page.".php";
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
    case 'register':
        getPath("register");
            break;
    
    default:
        getPath("404");
        break;
}

$a = secureUrl($_GET["a"]);

switch ($a) {
    case 'connect':
        getAction("LoginController");
        break;
    case 'register':
        getAction("RegisterController");
        break;
    
    default:
        getPath("404");
        break;
}



