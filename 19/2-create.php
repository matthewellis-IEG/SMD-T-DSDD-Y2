<?php

// Assume the $pdo variable is already defined and connected

$name = 'John Doe';
$email = 'john.doe@example.com';
$age = 30;

$sql = "INSERT INTO users (name, email, age) VALUES (?, ?, ?)";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $email, $age]);

    echo "New user created successfully!";
} catch (\PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
