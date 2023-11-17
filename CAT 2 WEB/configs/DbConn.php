<?php

// Include the constants file
require_once('constants.php');

try {
    // Create a PDO connection
    $DbConn = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);

    // Set the PDO error mode to exception
    $DbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Optional: Set the character set to utf8
    $DbConn->exec('SET NAMES utf8');

    // Connection successful
    echo 'Connected to the database successfully!';
} catch (PDOException $e) {
    // Connection failed
    echo 'Connection failed: ' . $e->getMessage();
}

?>
