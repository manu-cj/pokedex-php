<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?> - Pokedex</title>
    <link href="../../assets/css/style.css" type="text/css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="../../public/img/pokedex-icon.png">
</head>

<body>
<header>
<img class="pokemon-logo" src="../../public/img/pokemon-logo.png" alt="Pokemon logo">
    <div class="header-container">
        <div class="logo">            
            <h1><a class="pokedex-home" href="/">Pokedex</a></h1>
        </div>
        <div class="search">
            <form action="../pages/search.php" method="get">
                <input type="text" name="query" placeholder="Search...">
                <button class="search-button" type="submit">Search</button>
            </form>
        </div>
        <nav class="navigation">
            <ul>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a class="user-identification"href="profile.php"><!--RegisterManager.php???-->My account</a></li>
                    <li><a class="user-identification"href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a class="user-identification"href="login.php">Login</a></li>
                    <li><a class="user-identification"href="register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>

<main class="">
</main>
    
</body>