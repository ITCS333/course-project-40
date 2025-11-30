<?php
// Start the session to read logged-in user
session_start();

// If user is not logged in or he is not admin, then redirect to login
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.html');
    exit;
}

// Store email in a variable for display
$adminEmail = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Admin Portal</h1>
        <p>Welcome, <?php echo htmlspecialchars($adminEmail); ?>!</p>
    </header>

    <main>
        <section>
            <h2>Account Management</h2>
            <ul>
                <li><a href="change_password.php">Change My Password</a></li>
            </ul>
        </section>
        <section>
            <h2>Resource Management</h2>
            <ul>
                <li><a href="resources.php">Manage Course Resources (CRUD)</li>
            </ul>
         </section>
        <section>
            <h2>Student Management</h2>
            <ul>
                <li><a href="students.php">Manage Students (CRUD)</a></li>
            </ul>
        </section>
        <section>
            <h2>Session</h2>
            <ul>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </section>
    </main>
</body>
</html>
