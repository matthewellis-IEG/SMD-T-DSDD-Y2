<?php
// ---------------------------
// Path to your SQLite database file
// ---------------------------
$dbFile = 'example.db';

try {
    // ---------------------------
    // Connect to the SQLite database using PDO
    // If the file doesn't exist, SQLite will create it automatically
    // ---------------------------
    $db = new PDO("sqlite:$dbFile");

    // Set PDO to throw exceptions on error
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ---------------------------
    // Check if the form has been submitted
    // The 'create' button in the form triggers this
    // ---------------------------
    if (isset($_POST['create'])) {

        // ---------------------------
        // Step 1: Assign each $_POST value to its own variable
        // This makes it clear which values are coming from the user
        // ---------------------------
        $name = $_POST['name'];           // User's name
        $email = $_POST['email'];         // User's email
        $password = $_POST['password'];   // User's password (plain text)

        // ---------------------------
        // Step 2: Hash the password
        // Storing raw passwords is unsafe!
        // password_hash() creates a secure hash
        // ---------------------------
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // ---------------------------
        // Step 3: Prepare the SQL statement
        // Using named placeholders (:name, :email, :password)
        // prevents SQL injection attacks
        // ---------------------------
        $stmt = $db->prepare("
            INSERT INTO users (name, email, password) 
            VALUES (:name, :email, :password)
        ");

        // ---------------------------
        // Step 4: Bind the PHP variables to the SQL placeholders
        // This ensures that the data is correctly passed to the query
        // ---------------------------
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);

        // ---------------------------
        // Step 5: Execute the query
        // This inserts the new user into the database
        // ---------------------------
        $stmt->execute();

        // Step 6: Notify that the user was created successfully
        echo "✅ User created successfully!";
    }

} catch (PDOException $e) {
    // ---------------------------
    // Handle any errors that occur during database connection or query execution
    // ---------------------------
    echo "Error: " . $e->getMessage();
}
?>

<!--
---------------------------
HTML Form for creating a new user
---------------------------
-->
<h2>Create User</h2>
<form method="POST">
    <!-- Name input -->
    <input name="name" placeholder="Name" required><br>

    <!-- Email input -->
    <input name="email" placeholder="Email" type="email" required><br>

    <!-- Password input -->
    <input name="password" placeholder="Password" type="password" required><br>

    <!-- Submit button -->
    <button name="create">Create</button>
</form>
