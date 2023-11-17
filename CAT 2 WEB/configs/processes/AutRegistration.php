<?php

// Include the database connection file
require_once('../configs/DbConn.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Add more fields as needed

    try {
        // Prepare and execute the SQL query to insert user details into the database
        $stmt = $DbConn->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        // Bind more parameters as needed

        // Execute the query
        $stmt->execute();

        echo 'User registration successful!';
    } catch (PDOException $e) {
        // Handle database error
        echo 'User registration failed: ' . $e->getMessage();
    }
}

?>
