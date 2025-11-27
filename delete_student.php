<?php
// Start the session and allow only admin users
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.html');
    exit;
}

// Temporary list of students
$students = [
    [
        'id' => 1,
        'name' =>'Student one',
        'student_id' =>'20210001',
        'email' =>'s1@example.com',
    ],
    [
        'id' => 2,
        'name' => 'Student two',
        'student_id' => '20210002',
        'email' => 's2@example.com',
    ],
    [
        'id' => 3,
        'name' => 'Student three',
        'student_id' => '20210003',
        'email' => 's3@example.com',
    ],
];

// Read student id from the query string
$studentId = isset($_GET['id']) ? (int) $_GET['id'] : 0;
// Search for the student in the array
$selectedStudent = null;
foreach ($students as $stu) {
    if ($stu['id'] === $studentId) {
        $selectedStudent = $stu; break; }
}

// Simple message to show the result
if (!$selectedStudent) {
    $message = 'Student not found.';
} else {
    $message = 'Student deleted successfully (temporary –not stored permanently).';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Delete Student</h1>

    <p><?php echo htmlspecialchars($message); ?></p>

    <p>
        <a href="students.php">Back to Students List</a> |
        <a href="admin_portal.php">Back to Admin Portal</a>
    </p>
</body>
</html>
