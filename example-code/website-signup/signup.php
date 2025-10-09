<?php
$pdo = new PDO("sqlite:my_database.db");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['signup_name']);
    $email = trim($_POST['signup_email']);
    $password = $_POST['signup_password'];

    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        $error = "Email already registered!";
    } else {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        if ($stmt->execute([$name, $email, $passwordHash])) {
            header("Location: index.php");
            exit;
        } else {
            $error = "Error signing up.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
</head>
<body>
    <h2>Sign Up</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <input type="text" name="signup_name" placeholder="Full Name" required><br>
        <input type="email" name="signup_email" placeholder="Email" required><br>
        <input type="password" name="signup_password" placeholder="Password" required><br>
        <input type="submit" value="Sign Up">
    </form>
    <p>Already have an account? <a href="index.php">Login</a></p>
</body>
</html>
