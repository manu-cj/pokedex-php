<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?> - Pokedex</title>
    <link href="public/css/style.css" type="text/css" rel="stylesheet">
</head>

<header>

    <nav>
        <?php
        if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
            echo '<a href="?a=disconnect">Disconnect</a>';
        } else {
            echo '<a href="?c=register">register</a>
                    <a href="?c=login">login</a>';
        }
        ?>
    </nav>

</header>

<body>