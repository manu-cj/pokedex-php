<?php


function addToFavorite($userid, $pokemonId, $token, $pokemonName)
{
    require_once '../Engine/connect.php';

    try {
        $sql = 'SELECT * FROM users WHERE user_id = :user_id';
        $select = $conn->prepare($sql);

        if ($select->execute([':user_id' => $userid])) {
            $user = $select->fetch(PDO::FETCH_ASSOC);
            if ($user['verification_token'] === $token) {
                $sql = 'INSERT INTO user_collection (user_id, pokemon_id) VALUES (:user_id, :pokemon_id)';
                $insert = $conn->prepare($sql);
                if ($insert->execute([':user_id' => $userid, ':pokemon_id' => $pokemonId])) {
                    $_SESSION['notification'] = '<div class="notification-success">' . $pokemonName . ' added to favorites</div>';
                    header("location: http://localhost:5001/?c=home&#".$pokemonName."");
                } else {
                    $_SESSION['notification'] = '<div class="notification-error">An error occurred while adding to favorites.</div>';
                    header("location: http://localhost:5001/?c=home&#".$pokemonName."");                }
            } else {
                $_SESSION['notification'] =  '<div class="notification-error">Invalid verification.</div>';
                header("location: http://localhost:5001/?c=home&#".$pokemonName."");            }
        } else {
            $_SESSION['notification'] = '<div class="notification-error">An error occurred.</div>';
            header("location: http://localhost:5001/?c=home&#".$pokemonName."");        }
    } catch (PDOException $e) {
        echo '<div class="notification-error">Database error: ' . $e->getMessage() . '</div>';
         header("location: http://localhost:5001/?c=home&#".$pokemonName."");    }
}

function checkFavorite($pokemonId, $pokemonName)
{
    require('./Engine/connect.php');

    try {

        $sql = 'SELECT * FROM user_collection WHERE user_id = :user_id AND pokemon_id = :pokemon_id';
        $select = $conn->prepare($sql);
        if ($select->execute([':user_id' => $_SESSION['user'][3], ':pokemon_id' => $pokemonId])) {
            if ($select->rowCount() > 0) {
?>
                <form action="./controllers/favoriteController.php" method="post">
                    <input type="hidden" name="token" value="<?= $_SESSION['user'][2] ?>">
                    <input type="hidden" name="id" value="<?= $_SESSION['user'][3] ?>">
                    <input type="hidden" name="pokemon-id" value="<?= $pokemonId ?>">
                    <input type="hidden" name="pokemon-name" value="<?= $pokemonName ?>">
                    <button name="delete-favorite"><i class="fas fa-star" title="delete to favorite"></i></button>
                </form>
            <?php
            } else {
            ?>
                <form action="./controllers/favoriteController.php" method="post">
                    <input type="hidden" name="token" value="<?= $_SESSION['user'][2] ?>">
                    <input type="hidden" name="id" value="<?= $_SESSION['user'][3] ?>">
                    <input type="hidden" name="pokemon-id" value="<?= $pokemonId ?>">
                    <input type="hidden" name="pokemon-name" value="<?= $pokemonName ?>">
                    <button name="add-to-favorite"><i class="far fa-star" title="add to favorite"></i></button>
                </form>

                <?php
            }
        }
    } catch (PDOException $e) {
        echo '<div class="notification-error">Database error: ' . $e->getMessage() . '</div>';
    }
}


function removeFavorite($userid, $pokemonId, $token, $pokemonName)
{
    require_once '../Engine/connect.php';
    try {

        $sql = 'SELECT * FROM users WHERE user_id = :user_id';
        $select = $conn->prepare($sql);
        if ($select->execute([':user_id' => $userid])) {
            $user = $select->fetch(PDO::FETCH_ASSOC);
            if ($user['verification_token'] === $token) {
                $sql = 'DELETE FROM user_collection WHERE user_id = :user_id AND pokemon_id = :pokemon_id';
                $delete = $conn->prepare($sql);
                if ($delete->execute([':user_id' => $userid, ':pokemon_id' => $pokemonId])) {
                    echo '<div class="notification-success">' . $pokemonName . ' deleted to favorites</div>';
                    header("location: http://localhost:5001/?c=home&#".$pokemonName."");
                } else {
                    echo '<div class="notification-error">An error occurred while deleting to favorites.</div>';
                    header("location: http://localhost:5001/?c=home&#".$pokemonName."");
                }
            } else {
                echo  '<div class="notification-error">Invalid verification.</div>';
                header("location: http://localhost:5001/?c=home&#".$pokemonName."");
            }
        } else {
            echo '<div class="notification-error">An error occurred.</div>';
            header("location: http://localhost:5001/?c=home&#".$pokemonName."");
        }
    } catch (PDOException $e) {
        echo '<div class="notification-error">Database error: ' . $e->getMessage() . '</div>';
        header("location: http://localhost:5001/?c=home&#".$pokemonName."");
    }
}

function clean_encode($text)
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

function getFavorite($usernameData)
{
    require('./Engine/connect.php');
    try {
        $sql = 'SELECT user_id FROM users WHERE username = :username';
        $select = $conn->prepare($sql);
        if ($select->execute([':username' => $usernameData])) {
            $user = $select->fetch(PDO::FETCH_ASSOC);
            $sql = 'SELECT * FROM user_collection WHERE user_id = :user_id';
            $select = $conn->prepare($sql);
            if ($select->execute([':user_id' => $user['user_id']])) {
                if ($select->rowCount() > 0) {
                    $favoris = $select->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($favoris as $value) {
                        $pokemonId = $value['pokemon_id'];
                        $sql = 'SELECT * FROM pokemon WHERE id = :id';
                        $select = $conn->prepare($sql);
                        if ($select->execute([':id' => $pokemonId])) {
                            $results = $select->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($results as $pkmn) {
                                $type = explode(', ', $pkmn['type']);
                ?>
                                <article class="card-pkmn card<?= lcfirst($type[0]) ?>">
                                    <div class="header-card <?= lcfirst($type[0]) ?>">
                                        <div class="header-data">
                                            <h2><?= $pkmn['name'] ?></h2>
                                            <h2>n°<?= $pkmn['pokedexNumber'] ?></h2>
                                        </div>
                                        <div class="control">
                                            <?php
                                            if (isset($_SESSION['user'])) {
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
                                        <blockquote><?= clean_encode(strtolower($pkmn['description'])) ?></blockquote>
                                        <a href="http://localhost:5001/views/pages/search.php?query=<?= $pkmn['name'] ?>">See More</a>
                                    </div>
                                </article>
<?php
                            }
                        }
                    }
                } else {
                    echo 'Nothing pokemon add in favorite here';
                }
            }
        }
    } catch (PDOException $e) {
        echo '<div class="notification-error">This user not exist</div>';
    }
}
