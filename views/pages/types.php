<?php
// Connecting to the database
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "pokedex";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Checking the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to get all unique types
$sql = "SELECT DISTINCT type FROM pokemon";
$result = $conn->query($sql);

// Array to hold unique types
$types = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Split the types and add to the array
        $typeArray = explode(', ', $row['type']);
        foreach ($typeArray as $type) {
            if (!in_array($type, $types)) {
                $types[] = $type;
            }
        }
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unique Pokemon Types</title>
    <link href="../../public/css/style.css" type="text/css" rel="stylesheet">
</head>
<body>
    <h1>Unique Pokemon Types</h1>
    <ol>
        <?php foreach ($types as $type): ?>
            <li><?php echo htmlspecialchars($type); ?></li><br>
        <?php endforeach; ?>
    </ol>
</body>
</html>
