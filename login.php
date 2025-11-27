<?php
// Start session to store user log in data.
session_start();

// Temporary list of users:
$users=[
  'admin@example.com' => [
  'password' => 'admin1587', 
  'role' => 'admin',
  ],
  ];


//Check if form is submitted by POST
if($_SERVER["REQUEST_METHOD"]==="POST") {
  $email= $_POST['email'] ?? '';
  $password= $_POST['password'] ?? '';
  // To clean extra spaces:
  $email =trim($email);
  $password= trim($password);
  // Validating email and pass
  if(isset($users[$email]) && $users[$email] ['password'] === $password) {
    // if successful login, then store the data of the user in the session
    $_SESSION["email"] =$email;
    $_SESSION["role"] =$users[$email]['role'];

       //Redirect based on role of user
       if ($_SESSION['role'] ==='admin') {
         header('Location: admin_portal.html');
         exit;
       }
       else{ header('Location: student_resources.html'); exit; }
  }
  else{ // If Invalid login, then redirect back to login page with error 
       header('Location: login.html?error=1');
       exit; }
}
else { 
  //If a user opened login.php without POST, then redirect to login page
  header('location: login.html');
  exit; }
    
    
