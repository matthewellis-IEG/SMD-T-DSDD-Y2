<?php
// Start the session
session_start();

// Set a cookie
setcookie('my_cookie', 'cookie_value', time() + 3600, '/'); // Expires in 1 hour

// Set session values
$_SESSION['username'] = 'john_doe';
$_SESSION['role'] = 'admin';

// Read session values
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'User';

// Clear a session value
unset($_SESSION['role']);

// Clear all session values
// $_SESSION = array(); // Option 1: clear session array
// session_unset();     // Option 2: remove all session variables

// Clear all cookies
if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time() - 3600, '/');
        setcookie($name, '', time() - 3600, '/', $_SERVER['HTTP_HOST'], true, true);
    }
}

// Example output
echo "Username: $username<br>";
echo "Role: " . (isset($_SESSION['role']) ? $_SESSION['role'] : 'Cleared') . "<br>";
?>