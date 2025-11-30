<?php
// Start the session and allow only admin users
session_start();

if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.html');
    exit;
}

// Message to show feedback after form submission
$message = '';

// Handling form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read and clean the form values
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');

    // Simple validation
    if ($title === '' || $description === '') {
        $message = 'Please fill in all fields.';
    } else {
        $message = 'Resource added successfully (temporary – not stored permanently).';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Resource</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Add New Resource</h1>
    </header>

    <main>
        <?php if ($message): ?>
            <p class="message"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <form method="POST" class="resource-form">
            <label for="title">Resource Title:</label>
            <input type="text" id="title" name="title" required maxlength="255">

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="5" required></textarea>

            <button type="submit">Add Resource</button>
        </form>

        <p>
            <a href="resources.php">Back to Resources List</a> |
            <a href="admin_portal.php">Back to Admin Portal</a>
        </p>
    </main>
</body>
</html>
