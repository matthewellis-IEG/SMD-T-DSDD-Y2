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
    // Step 1: Prepare a SELECT query to fetch all users
    // ---------------------------
    $stmt = $db->prepare("SELECT * FROM users");

    // ---------------------------
    // Step 2: Execute the query
    // ---------------------------
    $stmt->execute();

    // ---------------------------
    // Step 3: Fetch all rows as an associative array
    // Each row is an array with keys 'id', 'name', 'email', 'password'
    // ---------------------------
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // ---------------------------
    // Handle any errors that occur during database connection or query execution
    // ---------------------------
    echo "Error: " . $e->getMessage();
}
?>

<!--
---------------------------
HTML to display all users
---------------------------
-->
<h2>All Users</h2>

<?php if (!empty($users)): ?>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password Hash</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <!-- Display each column using htmlspecialchars to prevent XSS -->
                <td><?= htmlspecialchars($user['id']) ?></td>
                <td><?= htmlspecialchars($user['name']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= htmlspecialchars($user['password']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>No users found in the database.</p>
<?php endif; ?>
