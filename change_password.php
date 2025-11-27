<?php
// Start the session to check the logged-in admin
session_start();
// Allow only the admin to access this page
if (!isset($_SESSION['email']) || $_SESSION['role']!=='admin'){
    header('Location: login.html'); exit;
}
// Current admin password:
$currentPassword = 'admin1587';
//to hold the feedback message:
$message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Reading the form values
    $old     = $_POST['old_password'] ?? '';
    $new     = $_POST['new_password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';
    // Validation
    if ($old !== $currentPassword) {
        $message = "Old password is incorrect.";
    } elseif ($new !==$confirm) {
        $message = "New passwords do not match.";
    } elseif (strlen($new)<4) {
        $message = "New password must be at least 4 characters.";
    } else { // In a real project, here we would update the password in the database.
               // For now, we just show a success message.
              $message = "Password changed successfully (temporary – not stored permanently).";
      }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Change Password</h1>
    <?php if ($message): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <form method="POST" class="change_password_form">
        <label for="old_password">Old Password:</label>
        <input type="password" id="old_password" name="old_password" required>

        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required>

        <label for="confirm_password">Confirm New Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>

        <button type="submit">Update Password</button>
    </form>

    <p><a href="admin_portal.php">Back to Admin Portal</a></p>
</body>
</html>
