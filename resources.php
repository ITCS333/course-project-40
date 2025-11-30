<?php
// Start the session to check user authentication
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header('Location: login.html');
    exit;
}

// Get user role
$isAdmin = ($_SESSION['role'] === 'admin');

// Temporary list of resources (before using a database)
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Resources</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Course Resources</h1>
        <p>
            <?php if ($isAdmin): ?>
                <a href="admin_portal.php">Back to Admin Portal</a> |
            <?php endif; ?>
            <a href="logout.php">Logout</a>
        </p>
    </header>

    <main>
        <section>
            <h2><?php echo $isAdmin ? 'Manage Resources' : 'Available Resources'; ?></h2>

            <?php if ($isAdmin): ?>
                <!-- Admin can add new resources -->
                <p><a href="add_resource.php" class="btn-add">Add New Resource</a></p>
            <?php endif; ?>

            <?php if (empty($resources)): ?>
                <p>No resources available yet.</p>
            <?php else: ?>
                <table border="1" cellpadding="8" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($resources as $resource): ?>
                        <tr>
                            <td><?php echo (int)$resource['id']; ?></td>
                            <td><?php echo htmlspecialchars($resource['title']); ?></td>
                            <td><?php echo htmlspecialchars($resource['description']); ?></td>
                            <td><?php echo htmlspecialchars($resource['created_at']); ?></td>
                            <td>
                                <a href="resource_detail.php?id=<?php echo (int)$resource['id']; ?>">View Details</a>
                                <?php if ($isAdmin): ?>
                                    | <a href="edit_resource.php?id=<?php echo (int)$resource['id']; ?>">Edit</a>
                                    | <a href="delete_resource.php?id=<?php echo (int)$resource['id']; ?>" onclick="return confirm('Are you sure you want to delete this resource?');">Delete</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
