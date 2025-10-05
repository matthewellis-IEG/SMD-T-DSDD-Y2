<?php
// Example POST values sent from a form:
// $_POST['username'] - The username entered by the user
// $_POST['password'] - The password entered by the user

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Access POST values
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Example of securing POST data:
    // 1. Trim input to remove extra spaces
    $username = trim($username);
    $password = trim($password);

    // 2. Escape output to prevent XSS
    $safe_username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');

    // 3. Use password hashing for passwords (if storing)
    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    echo "<p>Welcome, {$safe_username}!</p>";
} else {
    // Show a simple form
    ?>
    <form method="post" action="">
        <label>Username: <input type="text" name="username"></label><br>
        <label>Password: <input type="password" name="password"></label><br>
        <button type="submit">Login</button>
    </form>
    <?php
}
?>