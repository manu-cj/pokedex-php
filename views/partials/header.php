<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?> - Pokedex</title>
    <link href="http://localhost/Becode/pokedex-php/public/css/style.css" type="text/css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="../../public/img/pokedex-icon.png">
    <script defer src="https://kit.fontawesome.com/d8438e7f2f.js" crossorigin="anonymous"></script>
</head>

<body>
<header>
<img class="pokemon-logo" src="http://localhost/Becode/pokedex-php/public/img/pokemon-logo.png" alt="Pokemon logo">
    <div class="header-container">
        <div class="logo">            
            <h1><a class="pokedex-home" href="?c=home">Pokedex</a></h1>
        </div>
        <div class="search">
            <form action="http://localhost/Becode/views/pages/search.php" method="get">
                <input type="text" name="query" placeholder="Search...">
                <button class="search-button" type="submit">Search</button>
            </form>
        </div>
        <nav class="navigation">
            <?php 
            session_start();
            if (isset($_SESSION['user'])): ?>
                <!-- Lien vers le profil utilisateur -->
                <a class="user-identification" href="?c=profile.php">My account</a>
                <a class="user-identification" href="?c=logout">Logout</a>
                
                <?php if ($_SESSION['user'][1] == '1'): ?>
                    <a class="user-identification" href="?c=adminPanel">Admin</a>
                <?php endif; ?>
            <?php else: ?>
                <a class="user-identification" href="?c=login">Login</a>
                <a class="user-identification" href="?c=register">Register</a>
            <?php endif; ?>
        </nav>

    </div>
</header>

    
</body>
</body>