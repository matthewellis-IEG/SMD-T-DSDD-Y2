<?php

session_start();
$pdo = new PDO("sqlite:my_database.db");

// If user is already logged in, show home page
if (isset($_SESSION['user_id'])) {
    echo "Welcome, " . htmlspecialchars($_SESSION['user_name']) . "!<br>";
    echo "<a href='update.php'>Update Email</a> | ";
    echo "<a href='delete.php'>Delete Account</a> | ";
    echo "<a href='logout.php'>Logout</a>";
    exit;
}

// Handle login form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['login_email']);
    $password = $_POST['login_password'];

    $stmt = $pdo->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid email or password!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <input type="email" name="login_email" placeholder="Email" required><br>
        <input type="password" name="login_password" placeholder="Password" required><br>
        <input type="submit" value="Login">
    </form>
    <p>Don't have an account? <a href="signup.php">Sign up</a></p>
</body>
</html>
