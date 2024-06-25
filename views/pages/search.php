<?php
// Connecting to the database
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "pokedex";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

//Function for clearing, encoding, and screening text
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

// Checking the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Receiving a search query
$query = isset($_GET['query']) ? $_GET['query'] : '';

// Protection against SQL injections
$query = $conn->real_escape_string($query);

// Search
$suggestions = [];
if (!empty($query)) {
    $sql = "SELECT * FROM pokemon WHERE name LIKE '%$query%' LIMIT 10";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $suggestions[] = $row;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - Pokedex</title>
    <link href="../../assets/css/style.css" type="text/css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="../../public/img/pokedex-icon.png">
</head>

<body>
<?php include '../partials/header.php'; ?>

<main>
    <div class="search-results">
        <?php
        // Search for Pokemon by the entered query
        if (!empty($query)) {
            $sql = "SELECT * FROM pokemon WHERE name LIKE '%$query%'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0): ?>
                <div class="search-container">
                        <?php while ($row = $result->fetch_assoc()): ?> 
                        <div class="pokemon-info">
                            <h2><?php echo htmlspecialchars($query); ?></h2>
                            <p><strong><?php echo htmlspecialchars($row['type']); ?></strong></p>
                            <p><strong>Description:</strong> <?php echo clean_encode_and_escape_text($row['description']); ?></p>
                            <p><strong>HP:</strong> <?php echo htmlspecialchars($row['hp']); ?></p>
                            <p><strong>Attack:</strong> <?php echo htmlspecialchars($row['attack']); ?></p>
                            <p><strong>Specific Attack:</strong> <?php echo htmlspecialchars($row['special_attack']); ?></p>
                            <p><strong>Defense:</strong> <?php echo htmlspecialchars($row['defense']); ?></p>
                            <p><strong>Specific Defense:</strong> <?php echo htmlspecialchars($row['special_defense']); ?></p>
                            <p><strong>Speed:</strong> <?php echo htmlspecialchars($row['speed']); ?></p>
                            <p><strong>Evolution:</strong> <?php echo htmlspecialchars($row['gen']); ?></p>
                            <!-- <audio controls>
                                <source src="<?php echo htmlspecialchars($row['cry_url']); ?>" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio> -->
                        </div>
                        <div class="pokemon-image">
                           <p class="pokemon-number"><?php echo "# ". htmlspecialchars($row['pokedexNumber']); ?></p>
                           <img class="card-image" src="<?php echo"./../../public/img/pokemon/" . htmlspecialchars($row['name']) . ".png"; ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
                        </div>
                       
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p>No results found</p>
            <?php endif;
        }
        ?>
    </div>
</main>

</body>
</html>

<?php
// Close the connection
$conn->close();
?>
