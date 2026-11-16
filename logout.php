<?php
session_start();

// Remove all session data
$_SESSION = [];

session_destroy();

// Return to admin login
header("Location: login.php");
exit;
?>