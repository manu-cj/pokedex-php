<?php


function clean_encode_and_escape_text($text)
{
    // Remplacer uniquement le caractère \f (saut de page) par un espace
    $cleaned_text = str_replace("\f", ' ', $text);
    // Convertir en UTF-8
    $encoded_text = mb_convert_encoding($cleaned_text, 'UTF-8', 'auto');
    // Remplacer les '?' par 'é'
    $replaced_text = str_replace('?', 'é', $encoded_text);
    // Échapper les caractères spéciaux HTML
    $escaped_text = htmlspecialchars($replaced_text, ENT_QUOTES, 'UTF-8');
    return $escaped_text;
}

function page1($offset = 0)
{
    require("./Engine/connect.php");

    // Assurez-vous que l'offset est un entier positif
    $offset = intval($offset);
    if ($offset < 0) {
        $offset = 0;
    }

    $sql = 'SELECT * FROM pokemon LIMIT 30 OFFSET :offset';
    $select = $conn->prepare($sql);
    $select->bindValue(':offset', $offset, PDO::PARAM_INT);
    $favoris_list = [];

    if ($select->execute()) {
        $results = $select->fetchAll(PDO::FETCH_ASSOC);

        foreach ($results as $pkmn) {
            $type = explode(', ', $pkmn['type']);
?>
            <article class="card-pkmn card<?= lcfirst($type[0]) ?>" id="<?=$pkmn['name']?>">
                <div class="header-card <?= lcfirst($type[0]) ?>">
                    <div class="header-data">
                        <h2><?= $pkmn['name'] ?></h2>
                        <h2>n°<?= $pkmn['pokedexNumber'] ?></h2>
                    </div>
                    <div class="control">
                        <?php
                        if (isset($_SESSION['user'])) {
                            require_once './model/favoriteManager.php';
                            checkFavorite($pkmn['id'], $pkmn['name']);
                            
                            
                        }
                        ?>
                    </div>
                </div>
                <div class="picture-pkmn" style="background-image: url(<?= $pkmn['image'] ?>);"></div>
                <div class="data-pkmn <?= lcfirst($type[0]) ?>">
                    <div class="types-pkmn">
                        <p class="type <?= lcfirst($type[0]) ?>"><?= $type[0] ?></p>
                        <?php
                        if (!empty($type[1])) {
                        ?>
                            <p class="type <?= lcfirst($type[1]) ?>"><?= $type[1] ?></p>
                        <?php
                        }
                        ?>
                    </div>
                    <blockquote><?= clean_encode_and_escape_text(strtolower($pkmn['description'])) ?></blockquote>
                    <a href="http://localhost:5001/views/pages/search.php?query=<?= $pkmn['name'] ?>">See More</a>
                </div>
            </article>
        <?php
        }
    }
}
