<?php
if (isset($_POST['add-to-favorite'])) {
    $token = $_POST['token'];
    $id = htmlspecialchars($_POST['id']);
    $pkmnId = htmlspecialchars($_POST['pokemon-id']);
    $pkmnName = htmlspecialchars($_POST['pokemon-name']);

    require_once '../model/favoriteManager.php';

    addToFavorite($id, $pkmnId, $token, $pkmnName);
}

if (isset($_POST['delete-favorite'])) {
    $token = $_POST['token'];
    $id = htmlspecialchars($_POST['id']);
    $pkmnId = htmlspecialchars($_POST['pokemon-id']);
    $pkmnName = htmlspecialchars($_POST['pokemon-name']);

    require_once '../model/favoriteManager.php';

    removeFavorite($id, $pkmnId, $token, $pkmnName);
}