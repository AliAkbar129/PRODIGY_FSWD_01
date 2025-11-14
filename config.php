<?php
// Secure session cookie settings BEFORE starting session
session_set_cookie_params([
    'lifetime' => 0,        // cookie expires when browser closes
    'path' => '/',
    'domain' => '',         // leave empty for localhost
    'secure' => false,      // set true if using HTTPS
    'httponly' => true,
    'samesite' => 'Lax'
]);

// Now start session
session_start();



// Database config
$db_host = 'localhost';
$db_user = 'root';
$db_pass = ''; // change only if your MySQL has a password
$db_name = 'auth_system';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Escape helper for XSS protection
function e($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
?>
