<?php
// Path to your JSON file
$jsonFile = 'data.json';

// Check if the file exists
if (file_exists($jsonFile)) {
    // Get the contents of the file
    $jsonData = file_get_contents($jsonFile);

    // Decode the JSON data into a PHP array
    $data = json_decode($jsonData, true);

    // Check if decoding was successful
    if ($data !== null) {
        // Loop through the array and display the data
        foreach ($data as $person) {
            echo "Name: " . $person['name'] . "<br>";
            echo "Age: " . $person['age'] . "<br>";
            echo "Email: " . $person['email'] . "<br><br>";
        }
    } else {
        echo "Error decoding JSON.";
    }
} else {
    echo "JSON file not found.";
}
?>

// Assumed JSON file structure (data.json):

[
  {
    "name": "Alice",
    "age": 25,
    "email": "alice@example.com"
  },
  {
    "name": "Bob",
    "age": 30,
    "email": "bob@example.com"
  }
]

