<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Required Fields Form</title>
</head>
<body>
  <h2>Required Fields Form</h2>

  <?php
  // Initialize variables
  $name = $email = $age = "";
  $error = "";

  // Check if form was submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $age = trim($_POST["age"]);

    // Check for empty fields
    if (empty($name) || empty($email) || empty($age)) {
      $error = "⚠️ Please fill in all fields.";
    } 
    // Validate email format
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error = "❌ Please enter a valid email address.";
    } 
    else {
      echo "<p style='color: green;'>✅ Form submitted successfully!</p>";
      echo "<p><strong>Name:</strong> $name</p>";
      echo "<p><strong>Email:</strong> $email</p>";
      echo "<p><strong>Age:</strong> $age</p>";
      exit; // Stop further execution after successful submission
    }
  }
  ?>

  <?php
  // Show error message if any
  if (!empty($error)) {
    echo "<p style='color: red;'>$error</p>";
  }
  ?>

  <form method="POST" action="">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>"><br><br>

    <label for="email">Email:</label><br>
    <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>"><br><br>

    <label for="age">Age:</label><br>
    <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($age); ?>"><br><br>

    <button type="submit">Submit</button>
  </form>
</body>
</html>
