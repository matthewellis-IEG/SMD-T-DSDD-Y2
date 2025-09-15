<?php

// 1. Define the database file name.
//    PDO will create this file if it doesn't exist.
$databaseFile = 'my_database.sqlite';
//Test

try {
    // 2. Connect to the SQLite database using PDO.
    $pdo = new PDO("sqlite:$databaseFile");
    
    // Set error mode to throw exceptions for better error handling.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "✅ Successfully connected to the database.<br>";

    // 3. Create a table if it doesn't already exist.
    $createTableSQL = "
        CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name VARCHAR(50) NOT NULL,
            email VARCHAR(100) UNIQUE NOT NULL,
            age INTEGER
        );
    ";
    $pdo->exec($createTableSQL);
    echo "✔ Table 'users' created or already exists.<br>";
    
    // 4. Insert data using a prepared statement to prevent SQL injection.
    $insertSQL = "INSERT INTO users (name, email, age) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($insertSQL);

    // Sample data to insert
    $usersToInsert = [
        ['Alice', 'alice@example.com', 30],
        ['Bob', 'bob@example.com', 25],
        ['Charlie', 'charlie@example.com', 35]
    ];
    
    // Loop through the data and execute the insert statement for each user.
    foreach ($usersToInsert as $user) {
        $stmt->execute($user);
        echo "➕ Inserted new user: {$user[0]}<br>";
    }
    
    // 5. Select and retrieve all data from the 'users' table.
    $selectSQL = "SELECT id, name, email, age FROM users";
    $stmt = $pdo->query($selectSQL);
    
    echo "<br><h2>📋 Current Users in Database:</h2>";
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Age</th></tr></thead>";
    echo "<tbody>";

    // Fetch and display each row.
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>{$row['name']}</td>";
        echo "<td>{$row['email']}</td>";
        echo "<td>{$row['age']}</td>";
        echo "</tr>";
    }

    echo "</tbody></table>";

} catch (PDOException $e) {
    // 6. Handle any errors that may occur.
    echo "<br>❌ An error occurred: " . $e->getMessage();
}

?>