<?php
session_start();
$pdo = new PDO("sqlite:my_database.db");

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newEmail = trim($_POST['new_email']);
    $stmt = $pdo->prepare("UPDATE users SET email = ? WHERE id = ?");
    $stmt->execute([$newEmail, $_SESSION['user_id']]);
    $_SESSION['user_name'] = $_SESSION['user_name']; // Name unchanged
    $message = "Email updated!";
}
?>
<!DOCTYPE html>
<html>
<head><title>Update Email</title></head>
<body>
    <h2>Update Email</h2>
    <?php if (isset($message)) echo "<p style='color:green;'>$message</p>"; ?>
    <form method="POST">
        <input type="email" name="new_email" placeholder="New Email" required><br>
        <input type="submit" value="Update">
    </form>
    <p><a href="index.php">Back to Home</a></p>
</body>
</html>
