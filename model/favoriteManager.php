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
                } else {
                    $_SESSION['notification'] = '<div class="notification-error">An error occurred while adding to favorites.</div>';
                }
            } else {
                $_SESSION['notification'] =  '<div class="notification-error">Invalid verification.</div>';
            }
        } else {
            $_SESSION['notification'] = '<div class="notification-error">An error occurred.</div>';
        }
    } catch (PDOException $e) {
        echo '<div class="notification-error">Database error: ' . $e->getMessage() . '</div>';
    }
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


function removeFavorite($userid, $pokemonId, $token, $pokemonName) {
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
                }else {
                    echo '<div class="notification-error">An error occurred while deleting to favorites.</div>';
                }
            }else {
                echo  '<div class="notification-error">Invalid verification.</div>';
            }
        }else {
            echo '<div class="notification-error">An error occurred.</div>';
        } 
    } catch (PDOException $e) {
        echo '<div class="notification-error">Database error: ' . $e->getMessage() . '</div>';
    }
}
