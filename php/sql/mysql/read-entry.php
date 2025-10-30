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
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // results as associative arrays
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    // Example: select users older than a certain age
    $sql = "SELECT id, name, email, age FROM users WHERE age > :age";
    $stmt = $pdo->prepare($sql);
    
    // Bind parameter and execute
    $stmt->execute([':age' => 25]);
    
    // Fetch all results
    $users = $stmt->fetchAll();
    
    if ($users) {
        foreach ($users as $user) {
            echo "ID: {$user['id']} | Name: {$user['name']} | Email: {$user['email']} | Age: {$user['age']}<br>";
        }
    } else {
        echo "No users found.";
    }

} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>
