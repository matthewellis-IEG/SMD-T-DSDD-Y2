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
    
    // Example: delete a user by ID
    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    
    // Bind the ID parameter and execute
    $stmt->execute([':id' => 5]); // deletes the user with id = 5

    // Check if any row was deleted
    if ($stmt->rowCount() > 0) {
        echo "Record deleted successfully!";
    } else {
        echo "No record found with that ID.";
    }

} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>
