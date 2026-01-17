<?php

  //Database connection file using PDO.

// Database configuration
$host = 'localhost'; // Database host
$dbname = 'lab_one'; // Database name 
$username = 'OwenMusselwhite'; // Database username 
$password = ''; // Database password 

try {
    // Create a new PDO instance for database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Set PDO error mode to exception for better error handling
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Optional: Set default fetch mode to associative array
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


    // echo "Connected successfully to the database.";
} catch (PDOException $e) {
    //displaying the error message
    echo "Connection failed: " . $e->getMessage();
}
