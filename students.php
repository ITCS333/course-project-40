<?php
// Start the session and allow only admin users
session_start();


if (!isset($_SESSION['email']) || $_SESSION['role'] !=='admin') {
    header('Location: login.html');
    exit;
}


// Temporary list of students (before using a database)
$students = [
    [
        'id' => 1,
        'name' => 'Student One',
        'student_id'=> '20230001',
        'email'=> 's1@example.com',
    ],
    [
        'id' => 2,
        'name'  => 'Student Two',
        'student_id'=> '20230002',
        'email' => 's2@example.com',
    ],
    [
        'id'=> 3,
        'name' => 'Student Three',
        'student_id'=> '20230003',
        'email' => 's3@example.com',
    ],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Students</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Student Management</h1>
        <p><a href="admin_portal.php">Back to Admin Portal</a> | <a href="logout.php">Logout</a></p>
    </header>

    <main>
        <section>
            <h2>Students List</h2>

            <!-- A link to add a new student -->
            <p><a href="add_student.php">Add New Student</a></p>

            <table border="1" cellpadding="8" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Student ID</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?php echo (int)$student['id']; ?></td>
                        <td><?php echo htmlspecialchars($student['name']);?></td>
                        <td><?php echo htmlspecialchars($student['student_id']);?></td>
                        <td><?php echo htmlspecialchars($student['email']);?></td>
                        <td>
                            <!-- Placeholders: -->
                            <a href="edit_student.php?id=<?php echo (int)$student['id']; ?>">Edit</a> |
                            <a href="delete_student.php?id=<?php echo (int)$student['id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>

</body>
</html>
