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
    // Step 1: Check if a 'delete' parameter is provided via GET
    // ---------------------------
    if (isset($_GET['delete'])) {

        // ---------------------------
        // Step 2: Assign the GET value to a variable
        // Cast to integer to avoid SQL injection issues
        // ---------------------------
        $id = (int)$_GET['delete'];

        // ---------------------------
        // Step 3: Prepare a DELETE statement using a placeholder
        // ---------------------------
        $stmt = $db->prepare("DELETE FROM users WHERE id = :id");

        // ---------------------------
        // Step 4: Bind the variable to the placeholder
        // ---------------------------
        $stmt->bindParam(':id', $id);

        // ---------------------------
        // Step 5: Execute the DELETE query
        // ---------------------------
        $stmt->execute();

        // ---------------------------
        // Step 6: Confirmation message
        // ---------------------------
        echo "✅ User with ID $id deleted successfully!";
    }

    // ---------------------------
    // Step 7: Fetch all remaining users to display
    // ---------------------------
    $users = $db->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!--
---------------------------
HTML to Display Users and Delete Links
---------------------------
-->
<h2>Users</h2>
<?php if (!empty($users)): ?>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password Hash</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['id']) ?></td>
                <td><?= htmlspecialchars($user['name']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= htmlspecialchars($user['password']) ?></td>
                <td>
                    <!-- Delete link: clicking it will trigger the GET parameter 'delete' -->
                    <a href="?delete=<?= $user['id'] ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>No users found in the database.</p>
<?php endif; ?>
