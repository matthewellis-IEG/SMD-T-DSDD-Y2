<?php
// Connect to SQLite database
$pdo = new PDO("sqlite:my_database.db");

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['login_email']);
    $password = $_POST['login_password'];

    // Fetch user by email
    $stmt = $pdo->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        echo "Login successful! Welcome, " . htmlspecialchars($user['name']);
        // Here you could start a session for the user
    } else {
        echo "Invalid email or password!";
    }
}
?>
