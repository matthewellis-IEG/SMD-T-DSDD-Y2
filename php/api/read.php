<?php
// Example: Read data from PokeAPI (https://pokeapi.co/)

$apiUrl = 'https://pokeapi.co/api/v2/pokemon/pikachu';

// Initialize cURL session
$ch = curl_init($apiUrl);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute cURL request
$response = curl_exec($ch);

// Check for errors
if ($response === false) {
    echo 'Error: ' . curl_error($ch);
    curl_close($ch);
    exit;
}

// Close cURL session
curl_close($ch);

// Decode JSON response
$data = json_decode($response, true);

// Output some data
if ($data) {
    echo 'Name: ' . $data['name'] . PHP_EOL;
    echo 'Height: ' . $data['height'] . PHP_EOL;
    echo 'Weight: ' . $data['weight'] . PHP_EOL;
} else {
    echo 'Failed to decode API response.';
}
?>