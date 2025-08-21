<?php

// Assume the $pdo variable is already defined and connected

$user_id = 1; // The ID of the user you want to retrieve

$sql = "SELECT id, name, email, age FROM users WHERE id = ?";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();

    if ($user) {
        echo "User Found: <br>";
        echo "ID: " . $user['id'] . "<br>";
        echo "Name: " . $user['name'] . "<br>";
        echo "Email: " . $user['email'] . "<br>";
        echo "Age: " . $user['age'];
    } else {
        echo "No user found with that ID.";
    }
} catch (\PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
