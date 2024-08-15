<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'mypassword');
define('DB_NAME', 'cipher');
define('DB_PORT', '3306');
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// App root
define('APPROOT', dirname(dirname(__FILE__)));

// URL root
define('URLROOT', 'http://localhost:8080/Cipher');
define('PUBLIC_PATH', URLROOT . '/app/public');
// Site name
define('SITENAME', 'Student Q&A System');

// App version
define('APPVERSION', '1.0.0');

?>