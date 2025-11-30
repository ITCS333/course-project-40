<?php
// Start the session to check user authentication
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header('Location: login.html');
    exit;
}

// Get the comment ID and resource ID from the URL
$commentId = (int)($_GET['id'] ?? 0);
$resourceId = (int)($_GET['resource_id'] ?? 0);

// In a real application, we would:
// 1. Check if the user owns this comment or is an admin
// 2. Delete the comment from the database

// For now, we'll just redirect back to the resource detail page
header("Location: resource_detail.php?id=$resourceId");
exit;
?>
