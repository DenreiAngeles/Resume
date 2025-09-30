<?php
// Database configuration (You can change these settings as needed)
define('DB_HOST', 'localhost');
define('DB_PORT', '5432');
define('DB_NAME', 'resumelogin_db');
define('DB_USER', 'postgres'); // Replace with your actual DB username
define('DB_PASS', 'your-password-here'); // Replace with your actual password

session_start();

function getDBConnection() {
    try {
        $dsn = "pgsql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME;
        $pdo = new PDO($dsn, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
}

function isLoggedIn() {
    return isset($_SESSION['user_id']) && isset($_SESSION['username']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit();
    }
}
?>