<?php 
//Start session
session_start();
// Delete all stored data within the session
session_unset();
session_destroy();

//Redirect user to login page
header("Location: login.html");
exit;
