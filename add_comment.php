<?php
// Start the session to check user authentication
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header('Location: login.html');
    exit;
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resourceId = (int)($_POST['resource_id'] ?? 0);
    $comment = trim($_POST['comment'] ?? '');

    // Simple validation
    if ($resourceId > 0 && $comment !== '') {
       
    }

    // Redirect back to the resource detail page
    header("Location: resource_detail.php?id=$resourceId");
    exit;
} else {
    // If accessed directly, redirect to resources page
    header('Location: resources.php');
    exit;
}
?>
