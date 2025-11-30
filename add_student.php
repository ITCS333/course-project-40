<?php
// Start the session and allow only admin users
session_start();

if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.html');
    exit;}

// Message to show feedback after form submission
$message = '';

// Handling form submission
if ($_SERVER['REQUEST_METHOD']=== 'POST') {
    // Read and clean the form values
    $name =trim($_POST['name'] ?? '');
    $student_id =trim($_POST['student_id'] ?? '');
    $email =trim($_POST['email'] ?? '');

    // Simple validation
    if ($name=== '' || $student_id ==='' || $email ==='') {
        $message = 'Please fill in all fields.';
    } else {
        $message = 'Student added successfully (temporary – not stored permanently).';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Add New Student</h1>

    <?php if ($message): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <form method="POST" class="add_student_form">
        <label for="name">Student Name:</label>
        <input type="text" id="name" name="name" required>
        <label for="student_id">Student ID:</label>
        <input type="text" id="student_id" name="student_id" required>
        <label for="email">Student Email:</label>
        <input type="email" id="email" name="email" required>

        <button type="submit">Add Student</button>
    </form>

    <p>
        <a href="students.php">Back to Students List</a> |
        <a href="admin_portal.php">Back to Admin Portal</a>
    </p>
</body>
</html>
