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
$userEmail = $_SESSION['email'];

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

// Temporary list of comments for resources
$comments = [
    [
        'id' => 1,
        'resource_id' => 1,
        'user_email' => 'admin@example.com',
        'comment' => 'This is a great introduction to HTML. Very helpful for beginners!',
        'created_at' => '2024-01-16 10:30:00',
    ],
    [
        'id' => 2,
        'resource_id' => 1,
        'user_email' => 's1@example.com',
        'comment' => 'Can we get more examples on semantic HTML?',
        'created_at' => '2024-01-17 14:20:00',
    ],
    [
        'id' => 3,
        'resource_id' => 2,
        'user_email' => 's2@example.com',
        'comment' => 'The CSS grid section was particularly useful.',
        'created_at' => '2024-01-21 09:15:00',
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

// Filter comments for this resource
$resourceComments = array_filter($comments, function($c) use ($resourceId) {
    return $c['resource_id'] === $resourceId;
});
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($resource['title']); ?> - Resource Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1><?php echo htmlspecialchars($resource['title']); ?></h1>
        <p>
            <a href="resources.php">Back to Resources</a> |
            <?php if ($isAdmin): ?>
                <a href="admin_portal.php">Admin Portal</a> |
            <?php endif; ?>
            <a href="logout.php">Logout</a>
        </p>
    </header>

    <main>
        <section class="resource-details">
            <h2>Resource Details</h2>
            <p><strong>Created:</strong> <?php echo htmlspecialchars($resource['created_at']); ?></p>
            <p><strong>Description:</strong></p>
            <p><?php echo nl2br(htmlspecialchars($resource['description'])); ?></p>

            <?php if ($isAdmin): ?>
                <p>
                    <a href="edit_resource.php?id=<?php echo (int)$resource['id']; ?>" class="btn-edit">Edit Resource</a>
                    <a href="delete_resource.php?id=<?php echo (int)$resource['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this resource?');">Delete Resource</a>
                </p>
            <?php endif; ?>
        </section>

        <section class="comments-section">
            <h2>Discussion</h2>

            <!-- Display existing comments -->
            <?php if (empty($resourceComments)): ?>
                <p>No comments yet. Be the first to comment!</p>
            <?php else: ?>
                <div class="comments-list">
                    <?php foreach ($resourceComments as $comment): ?>
                        <div class="comment">
                            <div class="comment-header">
                                <strong><?php echo htmlspecialchars($comment['user_email']); ?></strong>
                                <span class="comment-date"><?php echo htmlspecialchars($comment['created_at']); ?></span>
                            </div>
                            <div class="comment-body">
                                <?php echo nl2br(htmlspecialchars($comment['comment'])); ?>
                            </div>
                            <?php if ($isAdmin || $comment['user_email'] === $userEmail): ?>
                                <div class="comment-actions">
                                    <a href="delete_comment.php?id=<?php echo (int)$comment['id']; ?>&resource_id=<?php echo (int)$resourceId; ?>" onclick="return confirm('Are you sure you want to delete this comment?');">Delete</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Add new comment form -->
            <div class="add-comment">
                <h3>Add a Comment</h3>
                <form method="POST" action="add_comment.php" class="comment-form">
                    <input type="hidden" name="resource_id" value="<?php echo (int)$resource['id']; ?>">

                    <label for="comment">Your Comment:</label>
                    <textarea id="comment" name="comment" rows="4" required></textarea>

                    <button type="submit">Post Comment</button>
                </form>
            </div>
        </section>
    </main>
</body>
</html>
