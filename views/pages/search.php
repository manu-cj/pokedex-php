
<?php
// Connecting to the database
// $servername = "db";
// $username = "root";
// $password = "rootpassword";
// $dbname = "pokedex";

// // Create a connection
// $conn = new mysqli($servername, $username, $password, $dbname);
include('./../../Engine/connect.php');
// Function for clearing, encoding, and screening text
function clean_encode_and_escape_text($text)
{
    // Replace only the \f (form feed) character with a space
    $cleaned_text = str_replace("\f", ' ', $text);
    // Convert to UTF-8
    $encoded_text = mb_convert_encoding($cleaned_text, 'UTF-8', 'auto');
    // Replace '?' with 'é'
    $replaced_text = str_replace('?', 'é', $encoded_text);
    // Escape HTML special characters
    $escaped_text = htmlspecialchars($replaced_text, ENT_QUOTES, 'UTF-8');
    return $escaped_text;
}

// Receiving a search query
$query = isset($_GET['query']) ? $_GET['query'] : '';

// Protection against SQL injections
$query = htmlspecialchars($query, ENT_QUOTES, 'UTF-8');

// Search
$suggestions = [];
if (!empty($query)) {
    $query = lcfirst($query);
    $sql = "SELECT * FROM pokemon WHERE name = :query LIMIT 10";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':query' => lcfirst($query)]);
    $suggestions = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - Pokedex</title>
    <link href="../../public/css/style.css" type="text/css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="../../public/img/pokedex-icon.png">
</head>

<body>
    <?php include '../partials/header.php'; ?>

    <main>
        <div class="search-results">
            <?php if (!empty($suggestions)): ?>
                <div class="search-container">
                    <?php foreach ($suggestions as $row): ?>
                        <div class="pokemon-info">
                            <h2><?php echo htmlspecialchars($row['name']); ?></h2>
                            <?php $type = explode(', ', $row['type']); ?>
                            <div class="pokemon-type">
                                <strong>Type:</strong>
                                <?php foreach ($type as $singleType): ?>
                                    <span class="type-color <?php echo htmlspecialchars($singleType); ?>"><?php echo htmlspecialchars($singleType); ?></span>
                                <?php endforeach; ?>
                            </div>
                            <p><strong>Description:</strong> <?php echo clean_encode_and_escape_text(strtolower($row['description'])) ?></p>
                            <div class="stat-bars">
                                <?php
                                function render_stat_bar($label, $value, $class) {
                                    echo "<div class='stat-label'><p>$label</p></div>";
                                    echo "<div class='stat-bar' title=". htmlspecialchars($value) .">                                    
                                    <div class='stat-bar-inner $class' style='width: " . htmlspecialchars($value/2) . "%;'></div>
                                  </div>";
                                }
                                render_stat_bar('HP', $row['hp'], 'hp-bar');
                                render_stat_bar('Attack', $row['attack'], 'attack-bar');
                                render_stat_bar('Defense', $row['defense'], 'defense-bar');
                                render_stat_bar('Specific Defense', $row['special_defense'], 'special-defense-bar');
                                render_stat_bar('Specific Attack', $row['special_attack'], 'special-attack-bar');
                                render_stat_bar('Speed', $row['speed'], 'speed-bar');
                                ?>
                            </div>
                            <p><strong>Evolution:</strong> <?php echo htmlspecialchars($row['gen']); ?></p>
                        </div>
                        <div class="pokemon-image">
                            <p class="pokemon-number"><?php echo "# " . htmlspecialchars($row['pokedexNumber']); ?></p>
                            <img class="card-image" src="<?php echo "../../public/img/pokemon/" . lcfirst($row['name']) . ".png"; ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>No results found</p>
            <?php endif; ?>
        </div>
    </main>
    <?php
require_once __DIR__ . '../../partials/footer.php';
?>
</body>
</html>

<?php
// Close the connection
$pdo = null;
?>