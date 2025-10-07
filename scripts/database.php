<?php
// Path to your SQLite database file
$dbFile = 'mydatabase.db';

if (!file_exists($dbFile)) {
    die("Database file not found: $dbFile");
}

try {
    // Connect to SQLite database
    $db = new PDO("sqlite:$dbFile");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get all table names
    $tables = $db->query("SELECT name FROM sqlite_master WHERE type='table'")->fetchAll(PDO::FETCH_COLUMN);

    if (!$tables) {
        echo "No tables found in the database.";
        exit;
    }

    foreach ($tables as $table) {
        echo "<h2>Table: $table</h2>";

        // Get all rows from the table
        $rows = $db->query("SELECT * FROM $table")->fetchAll(PDO::FETCH_ASSOC);

        if (!$rows) {
            echo "<p>No rows found.</p>";
            continue;
        }

        // Display table headers
        echo "<table border='1' cellpadding='5' cellspacing='0'><tr>";
        foreach (array_keys($rows[0]) as $column) {
            echo "<th>" . htmlspecialchars($column) . "</th>";
        }
        echo "</tr>";

        // Display table rows
        foreach ($rows as $row) {
            echo "<tr>";
            foreach ($row as $cell) {
                echo "<td>" . htmlspecialchars($cell) . "</td>";
            }
            echo "</tr>";
        }

        echo "</table><br>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
