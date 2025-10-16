<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Pokémon Search</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <div class="container">
    <h1>Pokémon Search</h1>
    <form action="pokemon.php" method="get" class="form-card">
      <label for="name">Enter Pokémon name:</label><br><br>
      <input type="text" id="name" name="name" placeholder="e.g. pikachu" required>
      <input type="submit" value="Search">
    </form>
  </div>

</body>
</html>
