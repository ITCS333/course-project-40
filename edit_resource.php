<?php
// Start the session and allow only admin users
session_start();

if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.html');
    exit;
}

// Temporary list of resources (same as in resources.php)
$resources = [
    [
        'id' => 1,
        'title' => 'Introduction to HTML',
        'description' => 'Learn the basics of HTML including tags, elements, and document structure.',
        'created_at' => '2024-01-15',
    ],
    [
        'id' => 2,
        'title' => 'CSS Fundamentals',
        'description' => 'Master CSS selectors, properties, and layout techniques for styling web pages.',
        'created_at' => '2024-01-20',
    ],
    [
        'id' => 3,
        'title' => 'JavaScript Essentials',
        'description' => 'Understand JavaScript basics, DOM manipulation, and event handling.',
        'created_at' => '2024-01-25',
    ],
];

// Get the resource ID from the URL
$resourceId = (int)($_GET['id'] ?? 0);

// Find the resource in the array
$resource = null;
foreach ($resources as $r) {
    if ($r['id'] === $resourceId) {
        $resource = $r;
        break;
    }
}

// If resource not found, redirect back
if (!$resource) {
    header('Location: resources.php');
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
        $message = 'Resource updated successfully (temporary – not stored permanently).';
        // In a real database implementation, we would update the resource here
        $resource['title'] = $title;
        $resource['description'] = $description;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Resource</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Edit Resource</h1>
    </header>

    <main>
        <?php if ($message): ?>
            <p class="message"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <form method="POST" class="resource-form">
            <label for="title">Resource Title:</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($resource['title']); ?>" required maxlength="255">

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="5" required><?php echo htmlspecialchars($resource['description']); ?></textarea>

            <button type="submit">Update Resource</button>
        </form>

        <p>
            <a href="resources.php">Back to Resources List</a> |
            <a href="admin_portal.php">Back to Admin Portal</a>
        </p>
    </main>
</body>
</html>
