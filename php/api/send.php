<?php
// Example: Sending data to a public API using PHP (cURL)

// API endpoint (example: JSONPlaceholder for testing)
$url = 'https://jsonplaceholder.typicode.com/posts';

// Data to send (as an associative array)
$data = [
    'title' => 'foo',
    'body' => 'bar',
    'userId' => 1
];

// Initialize cURL session
$ch = curl_init($url);

// Set cURL options
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json'
]);

// Execute the request and get the response
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
} else {
    // Output the API response
    echo $response;
}

// Close cURL session
curl_close($ch);
?>