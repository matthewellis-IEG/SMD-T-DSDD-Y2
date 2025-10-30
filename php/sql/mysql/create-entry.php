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
    
    // Example: insert user data into a table called 'users'
    $sql = "INSERT INTO users (name, email, age) VALUES (:name, :email, :age)";
    $stmt = $pdo->prepare($sql);
    
    // Bind parameters and execute
    $stmt->execute([
        ':name'  => 'Alice Johnson',
        ':email' => 'alice@example.com',
        ':age'   => 30
    ]);

    echo "Data inserted successfully!";
    
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>
