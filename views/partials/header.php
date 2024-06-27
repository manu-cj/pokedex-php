<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?> - Pokedex</title>
    <link href="http://localhost:5001/public/css/style.css" type="text/css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="http://localhost:5001/public/img/pokedex-icon.png">
    <script defer src="https://kit.fontawesome.com/d8438e7f2f.js" crossorigin="anonymous"></script>
</head>

<body>
<header>
<img class="pokemon-logo" src="../../public/img/pokemon-logo.png" alt="Pokemon logo">
    <div class="header-container">
        <div class="logo">            
            <h1><a class="pokedex-home" href="http://localhost:5001/?c=home">Pokedex</a></h1>
        </div>
        <div>
            <form class="search" action="http://localhost:5001/views/pages/search.php" method="get">
                <input type="text" name="query" placeholder="Search...">
                <button class="search-button" type="submit">Search</button>
            </form>
        </div>
        <nav class="navigation">
            <?php 
            session_start();
            include('./views/partials/notification.php');
            if (isset($_SESSION['user'])): ?>
                <!-- Lien vers le profil utilisateur -->
                <a class="user-identification" href="http://localhost:5001/profile.php">My account</a>
                <a class="user-identification" href="http://localhost:5001/?c=logout">Logout</a>
                
                <?php if ($_SESSION['user'][1] == '1'): ?>
                    <a class="user-identification" href="http://localhost:5001/?c=adminPanel">Admin</a>
                <?php endif; ?>
            <?php else: ?>
                <a class="user-identification" href="http://localhost:5001/?c=login">Login</a>
                <a class="user-identification" href="http://localhost:5001/?c=register">Register</a>
            <?php endif; ?>
        </nav>

    </div>
</header>

    
</body>