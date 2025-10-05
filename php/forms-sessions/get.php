<?php
// Example URL: get.php?name=John&age=25

// Get values from $_GET
$name = $_GET['name'] ?? '';
$age = $_GET['age'] ?? '';

// Output the values
echo "Name: " . htmlspecialchars($name) . "<br>";
echo "Age: " . htmlspecialchars($age) . "<br>";

// Securing $_GET values:
// 1. Use htmlspecialchars() to prevent XSS when displaying.
// 2. Validate and sanitize input as needed (e.g., filter_var for numbers).

// Example with more than two values:
// URL: get.php?name=John&age=25&city=London&country=UK

$city = $_GET['city'] ?? '';
$country = $_GET['country'] ?? '';

echo "City: " . htmlspecialchars($city) . "<br>";
echo "Country: " . htmlspecialchars($country) . "<br>";
?>