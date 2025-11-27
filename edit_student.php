<?php
// Start the session and allow only admin users
session_start();

if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.html');  exit;
}

// Temporary list of students
$students = [
    [
        'id' => 1,
        'name' =>'Student one',
        'student_id' =>'20210001',
        'email' => 's1@example.com',
    ],
    [
        'id' => 2,
        'name' => 'Student two',
        'student_id' => '20210002',
        'email' => 's2@example.com',
    ],
    [
        'id'=> 3,
        'name' => 'Student three',
        'student_id' =>'20210003',
        'email'=> 's3@example.com',
    ],
];

//read student id from the query string
$studentId= isset($_GET['id']) ? (int)$_GET['id'] : 0;
// search for the student in the array
$selectedStudent =null;
foreach ($students as $stu) {
    if ($stu['id'] === $studentId) {
        $selectedStudent = $stu;
        break;}
}

//if student not found, show a message and stop
if (!$selectedStudent) {
    echo 'Student not found.';  exit;
}
// Message to show feedback after form submission
$message = '';

//Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read and clean form values
    $name =trim($_POST['name'] ?? '');
    $student_id = trim($_POST['student_id'] ?? '');
    $email= trim($_POST['email'] ?? '');

    // Validating
    if ($name === '' || $student_id === '' || $email === '') {
        $message = 'Please fill in all fields.';
    } else {
        $message = 'Student updated successfully (temporary – not stored permanently).';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit Student</h1>
    <?php if ($message): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <form method="POST" class="edit_student_form">
        <label for="name">Student Name:</label>
        <input
            type="text"
            id="name"
            name="name"
            value="<?php echo htmlspecialchars($selectedStudent['name']); ?>"
            required
        >

        <label for="student_id">Student ID:</label>
        <input
            type="text"
            id="student_id"
            name="student_id"
            value="<?php echo htmlspecialchars($selectedStudent['student_id']); ?>"
            required
        >

        <label for="email">Student Email:</label>
        <input
            type="email"
            id="email"
            name="email"
            value="<?php echo htmlspecialchars($selectedStudent['email']); ?>"
            required
        >

        <button type="submit">Update Student</button>
    </form>
    

    <p>
        <a href="students.php">Back to Students List</a> |
        <a href="admin_portal.php">Back to Admin Portal</a>
    </p>
</body>
</html>
