<?php
// Rename this file into "site-config.php"

/**
 * Global Site Configuration
 * --------------------------
 * This file defines constants and global settings
 * used throughout the web application.
 */

// ==== SITE INFO ====
define('SITE_NAME', '');
define('SITE_URL', '');
define('SITE_PATH', '');  // absolute server path

// ==== DATABASE INFO ====
define('DB_HOST', '');
define('DB_NAME', '');
define('DB_USER', '');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// ==== PATH CONSTANTS ====

// ==== ENVIRONMENT SETTINGS ====
define('DEBUG_MODE', false);  // set to false in production
date_default_timezone_set('Asia/Jakarta');

// ==== PDO CONNECTION (OPTIONAL GLOBAL) ====
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => DEBUG_MODE ? PDO::ERRMODE_EXCEPTION : PDO::ERRMODE_SILENT,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    if (DEBUG_MODE) {
        die("Database connection failed: " . $e->getMessage());
    } else {
        error_log("DB connection failed: " . $e->getMessage());
        die("Internal Server Error");
    }
}
