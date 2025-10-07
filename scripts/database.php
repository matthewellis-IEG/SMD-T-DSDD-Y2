<?php
// Path to your SQLite database file
$dbFile = 'mydatabase.db';

if (!file_exists($dbFile)) {
    die("Database file not found: $dbFile");
}

try {
    // Connect to SQLite
    $db = new PDO("sqlite:$dbFile");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if a table is requested
    $table = isset($_GET['table']) ? $_GET['table'] : null;

    if ($table) {
        // Validate table exists
        $tables = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'")->fetchAll(PDO::FETCH_COLUMN);
        if (!in_array($table, $tables)) {
            die("Table not found: " . htmlspecialchars($table));
        }

        echo "<h2>Table: " . htmlspecialchars($table) . "</h2>";

        // Show row count
        $rowCount = $db->query("SELECT COUNT(*) FROM $table")->fetchColumn();
        echo "<p>Rows: $rowCount</p>";

        // Show column info
        $columns = $db->query("PRAGMA table_info($table)")->fetchAll(PDO::FETCH_ASSOC);
        echo "<h4>Columns:</h4><ul>";
        foreach ($columns as $col) {
            $pk = $col['pk'] ? " (PRIMARY KEY)" : "";
            $nn = $col['notnull'] ? " NOT NULL" : "";
            $dflt = $col['dflt_value'] !== null ? " DEFAULT {$col['dflt_value']}" : "";
            echo "<li>{$col['name']} - {$col['type']}{$pk}{$nn}{$dflt}</li>";
        }
        echo "</ul>";

        // Show rows
        $rows = $db->query("SELECT * FROM $table")->fetchAll(PDO::FETCH_ASSOC);
        if ($rows) {
            echo "<table border='1' cellpadding='5' cellspacing='0'><tr>";
            foreach (array_keys($rows[0]) as $colName) {
                echo "<th>" . htmlspecialchars($colName) . "</th>";
            }
            echo "</tr>";

            foreach ($rows as $row) {
                echo "<tr>";
                foreach ($row as $cell) {
                    echo "<td>" . htmlspecialchars($cell) . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No rows found in this table.</p>";
        }

        echo '<p><a href="' . htmlspecialchars($_SERVER['PHP_SELF']) . '">Back to table list</a></p>';

    } else {
        // List all tables
        $tables = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'")->fetchAll(PDO::FETCH_COLUMN);

        if (!$tables) {
            echo "<p>No tables found in the database.</p>";
            exit;
        }

        echo "<h2>Tables in database:</h2><ul>";
        foreach ($tables as $tbl) {
            $rowCount = $db->query("SELECT COUNT(*) FROM $tbl")->fetchColumn();
            echo '<li><a href="?table=' . urlencode($tbl) . '">' . htmlspecialchars($tbl) . '</a> (Rows: ' . $rowCount . ')</li>';
        }
        echo "</ul>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
