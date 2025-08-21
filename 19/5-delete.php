<?php

// Assume the $pdo variable is already defined and connected

$user_id = 1; // The ID of the user you want to delete

$sql = "DELETE FROM users WHERE id = ?";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);

    $rows_affected = $stmt->rowCount();
    if ($rows_affected > 0) {
        echo "User ID $user_id deleted successfully!";
    } else {
        echo "No user found with ID $user_id.";
    }
} catch (\PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
