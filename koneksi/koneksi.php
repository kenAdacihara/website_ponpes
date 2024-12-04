<?php  
    // Enable all errors during development
    error_reporting(E_ALL);

    // Check if session is already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Database Configuration
    $db_name   = "db_ponpes";
    $host      = "localhost";
    $username  = "root";
    $password  = ""; // Leave empty if no password

    // Make connection to database
    $conn = new mysqli($host, $username, $password, $db_name);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>
