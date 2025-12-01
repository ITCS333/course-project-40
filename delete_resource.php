<?php
// Start the session and allow only admin users
session_start();

if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.html');
    exit;
}

// Get the resource ID from the URL
$resourceId = (int)($_GET['id'] ?? 0);


// Redirect back to resources page
header('Location: resources.php');
exit;
?>
