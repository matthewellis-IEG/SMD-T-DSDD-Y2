<?php
// Database connection
$host = 'localhost';
$db   = 'your_database';
$user = 'your_username';
$pass = 'your_password';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    // Example: update a user's information
    $sql = "UPDATE users 
            SET name = :name, email = :email, age = :age 
            WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    
    // Bind and execute
    $stmt->execute([
        ':name'  => 'Bob Anderson',
        ':email' => 'bob.anderson@example.com',
        ':age'   => 35,
        ':id'    => 2
    ]);
    
    // Check how many rows were affected
    if ($stmt->rowCount() > 0) {
        echo "Record updated successfully!";
    } else {
        echo "No changes were made (record may not exist or values are the same).";
    }

} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>
