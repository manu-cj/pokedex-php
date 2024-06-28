<?php
function getUsers() {
    require_once './Engine/connect.php';
    try {
        $sql = 'SELECT * FROM users';
        $select = $conn->prepare($sql);
        
        if ($select->execute()) {
            $users = $select->fetchAll(PDO::FETCH_ASSOC);
            if (count($users) > 0) {
                shuffle($users); // Mélanger la liste des utilisateurs
                $userList = [];
                // Afficher un nombre aléatoire d'utilisateurs, par exemple 10 ou moins si moins d'utilisateurs sont disponibles
                $numUsersToShow = min(10, count($users));
                for ($i = 0; $i < $numUsersToShow; $i++) {
                    $userList[] = $users[$i]['username'];
                }
                foreach ($userList as $user) {
                    ?>
                    <a href="http://localhost:5001/?c=collection&username=<?=$user?>" rel="noopener noreferrer"><?=$user?></a><br>
                    <?php
                }
            } else {
                echo '<div class="notification-erreur">Aucun utilisateur trouvé.</div>';
            }
        } else {
            echo '<div class="notification-erreur">Une erreur est survenue.</div>';
            return null;
        } 
    } catch (PDOException $e) {
        echo '<div class="notification-erreur">Erreur de base de données : ' . $e->getMessage() . '</div>';
        return null;
    }
}


?>