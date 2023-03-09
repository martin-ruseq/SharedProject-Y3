<?php
session_start(); // Start session

// Check if the user is already logged in
if (!isset($_SESSION['username'])) {
  // Redirect to login page if not logged in
  header("Location: login.php");
  exit();
}

// Destroy the user's session
session_destroy();

// Redirect to login page after logging out
header("Location: login.php");
exit();
?>
