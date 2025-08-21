<?php

// Assume the $pdo variable is already defined and connected

$user_id = 1; // The ID of the user you want to update
$new_email = 'new.email@example.com';

$sql = "UPDATE users SET email = ? WHERE id = ?";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$new_email, $user_id]);

    $rows_affected = $stmt->rowCount();
    if ($rows_affected > 0) {
        echo "User ID $user_id updated successfully!";
    } else {
        echo "No changes made to user ID $user_id.";
    }
} catch (\PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
