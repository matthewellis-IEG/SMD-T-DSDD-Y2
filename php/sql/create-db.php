<?php
// Path to your SQLite database file
$dbFile = 'example.db'; 
//Ideally should be OUTSIDE your html folder, so like this
//$dbFile = '../example.db'

try {
    // Create (or open) the SQLite database
    $db = new PDO("sqlite:$dbFile");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Database created/opened successfully.<br>";

    // Create a simple table called 'users'
    $db->exec("
        CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            email TEXT NOT NULL,
            password TEXT NOT NULL
        )
    ");

    echo "Table 'users' created successfully.";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
