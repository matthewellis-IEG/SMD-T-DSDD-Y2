<?php
// ---------------------------
// Path to your SQLite database file
// ---------------------------
$dbFile = 'example.db';

try {
    // ---------------------------
    // Connect to the SQLite database using PDO
    // ---------------------------
    $db = new PDO("sqlite:$dbFile");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ---------------------------
    // Step 1: Check if the form has been submitted to update a user
    // ---------------------------
    if (isset($_POST['update'])) {

        // ---------------------------
        // Step 2: Assign each $_POST value to its own variable
        // ---------------------------
        $id = $_POST['id'];                  // ID of the user to update
        $name = $_POST['name'];              // New name
        $email = $_POST['email'];            // New email
        $password = $_POST['password'];      // New password (optional)

        // ---------------------------
        // Step 3: If password is provided, hash it; otherwise, keep old password
        // ---------------------------
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        } else {
            // Fetch the current password from the database to keep it unchanged
            $stmt = $db->prepare("SELECT password FROM users WHERE id = ?");
            $stmt->execute([$id]);
            $hashedPassword = $stmt->fetchColumn();
        }

        // ---------------------------
        // Step 4: Prepare the UPDATE statement using named placeholders
        // ---------------------------
        $stmt = $db->prepare("
            UPDATE users 
            SET name = :name, email = :email, password = :password 
            WHERE id = :id
        ");

        // ---------------------------
        // Step 5: Bind the variables to the statement
        // ---------------------------
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':id', $id);

        // ---------------------------
        // Step 6: Execute the query
        // ---------------------------
        $stmt->execute();

        echo "✅ User updated successfully!";
    }

    // ---------------------------
    // Step 7: If an 'edit' ID is provided in $_GET, fetch user data for the form
    // ---------------------------
    if (isset($_GET['edit'])) {
        $editId = $_GET['edit'];
        $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$editId]);
        $editUser = $stmt->fetch(PDO::FETCH_ASSOC);
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!--
---------------------------
HTML Form to Edit a User
---------------------------
-->
<?php if (!empty($editUser)): ?>
    <h2>Edit User</h2>
    <form method="POST">
        <!-- Hidden field to store user ID -->
        <input type="hidden" name="id" value="<?= htmlspecialchars($editUser['id']) ?>">

        <!-- Name -->
        <label>Name: <input name="name" value="<?= htmlspecialchars($editUser['name']) ?>" required></label><br>

        <!-- Email -->
        <label>Email: <input name="email" value="<?= htmlspecialchars($editUser['email']) ?>" type="email" required></label><br>

        <!-- Password (leave blank to keep current password) -->
        <label>Password: <input name="password" type="password" placeholder="Leave blank to keep current password"></label><br>

        <!-- Submit button -->
        <button name="update">Update</button>
    </form>
<?php else: ?>
    <p>No user selected for editing.</p>
<?php endif; ?>
