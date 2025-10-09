<?php
session_start();
$pdo = new PDO("sqlite:my_database.db");

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    session_destroy();
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Delete Account</title></head>
<body>
    <h2>Delete Account</h2>
    <p>Are you sure you want to delete your account? This cannot be undone.</p>
    <form method="POST">
        <input type="submit" value="Yes, Delete My Account">
    </form>
    <p><a href="index.php">Cancel</a></p>
</body>
</html>
