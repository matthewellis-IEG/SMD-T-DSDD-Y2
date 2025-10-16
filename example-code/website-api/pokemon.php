<?php
// ---------------------------
// Step 1: Check if Pokémon name was submitted via GET
// ---------------------------
if (!isset($_GET['name'])) {
    // If not, redirect the user back to index.php
    header('Location: index.php');
    exit; // Stop script execution
}

// ---------------------------
// Step 2: Prepare Pokémon name
// ---------------------------
// strtolower converts input to lowercase because PokéAPI expects lowercase names
// trim removes extra spaces at the beginning or end
$pokemonName = strtolower(trim($_GET['name']));

// ---------------------------
// Step 3: Build API URL
// ---------------------------
// urlencode ensures any special characters in the Pokémon name are properly encoded in the URL
$apiUrl = "https://pokeapi.co/api/v2/pokemon/" . urlencode($pokemonName);

// ---------------------------
// Step 4: Fetch data from PokéAPI
// ---------------------------
// file_get_contents sends a GET request to the API
// The '@' suppresses warnings if the request fails
$response = @file_get_contents($apiUrl);

// ---------------------------
// Step 5: Handle errors
// ---------------------------
if ($response === FALSE) {
    // If API request failed (e.g., Pokémon not found), show an error message
    echo "<p class='error'>Pokémon not found. Please try again.</p>";
    echo "<p class='error'><a href='index.php'>Back</a></p>";
    exit; // Stop script execution
}

// ---------------------------
// Step 6: Decode JSON response
// ---------------------------
// json_decode converts JSON string into PHP associative array
// true parameter ensures we get an array instead of an object
$data = json_decode($response, true);

/* 
Example structure of $data:
$data = [
    "name" => "pikachu",
    "height" => 4,
    "weight" => 60,
    "sprites" => [
        "front_default" => "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/25.png"
    ],
    "types" => [
        [
            "slot" => 1,
            "type" => [
                "name" => "electric",
                "url" => "https://pokeapi.co/api/v2/type/13/"
            ]
        ]
    ],
    "abilities" => [
        [
            "ability" => [
                "name" => "static",
                "url" => "https://pokeapi.co/api/v2/ability/9/"
            ],
            "is_hidden" => false,
            "slot" => 1
        ]
    ]
];
*/

// ---------------------------
// Step 7: Extract Pokémon information from $data
// ---------------------------

// Capitalise the first letter of the name
$name = ucfirst($data['name']); 

// Get Pokémon image URL if available, or empty string if not
$image = $data['sprites']['front_default'] ?? '';

// Height (in decimetres)
$height = $data['height'];

// Weight (in hectograms)
$weight = $data['weight'];

// ---------------------------
// Step 8: Read nested arrays for types and abilities
// ---------------------------

// $data['types'] is an array of types (Pokémon can have multiple types)
// Each element is an array with 'type' => ['name' => 'type_name']
// array_map loops through each type and returns the capitalised name
$types = array_map(fn($t) => ucfirst($t['type']['name']), $data['types']);

// $data['abilities'] is an array of abilities
// Each element contains 'ability' => ['name' => 'ability_name']
// array_map loops through each ability and capitalises it
$abilities = array_map(fn($a) => ucfirst($a['ability']['name']), $data['abilities']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo htmlspecialchars($name); ?> - Pokémon Info</title>
  <!-- Link to external stylesheet -->
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <div class="container">
    <!-- Card to display Pokémon information -->
    <div class="card">
      <!-- Display Pokémon name -->
      <h1><?php echo htmlspecialchars($name); ?></h1>

      <!-- Display Pokémon image if available -->
      <?php if ($image): ?>
        <img src="<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($name); ?>">
      <?php endif; ?>

      <!-- Display basic details -->
      <p><strong>Height:</strong> <?php echo $height; ?> dm</p>
      <p><strong>Weight:</strong> <?php echo $weight; ?> hg</p>

      <!-- Display Pokémon types -->
      <p><strong>Types:</strong> <?php echo implode(', ', $types); ?></p>

      <!-- Display Pokémon abilities -->
      <p><strong>Abilities:</strong> <?php echo implode(', ', $abilities); ?></p>

      <!-- Link back to search page -->
      <p><a href="index.php" class="back-link">Search another</a></p>
    </div>
  </div>

</body>
</html>
