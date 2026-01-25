<?php

$host = "localhost";
$db = "test";
$user = "root";
$password = "";

$dsn = "mysql:host=$host;dbname=$db";

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected to the database successfully.";
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
