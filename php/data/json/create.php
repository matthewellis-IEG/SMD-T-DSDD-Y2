<?php
// Data to be saved as JSON
$data = [
    "name" => "John Doe",
    "email" => "john@example.com",
    "age" => 30
];

// Encode data to JSON format
$jsonData = json_encode($data, JSON_PRETTY_PRINT);

// Specify the file path
$filePath = __DIR__ . '/user.json';

// Write JSON data to the file
if (file_put_contents($filePath, $jsonData)) {
    echo "JSON file created successfully.";
} else {
    echo "Failed to create JSON file.";
}
?>