<?php
require "includes/auth.php";
require "includes/connect.php";

// Make sure we received an ID
if (!isset($_GET['id'])) {
  die("No ID provided.");
}

$id = $_GET['id'];

// Delete query 
$sql = "DELETE FROM users WHERE username = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();

// Redirect back to admin list
header("Location: index.php");
exit;