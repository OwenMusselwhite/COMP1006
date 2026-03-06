<?php

require "includes/connect.php";

/* -------------------------------------------
   Make sure we received an ID in the URL
   Example: update.php?id=5
-------------------------------------------- */
if (!isset($_GET['id'])) {
  die("No order ID provided.");
}

$customerId = $_GET['id'];

/* -------------------------------------------
   If form is submitted, UPDATE the row
-------------------------------------------- */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Basic sanitization (trim removes extra spaces)
  $title = trim($_POST['title'] ?? '');
  $author  = trim($_POST['author'] ?? '');
  $rating     = trim($_POST['rating'] ?? '');
  $review_text   = trim($_POST['review_text'] ?? '');
  $created_at     = trim($_POST['created_at'] ?? '');
  

  // Simple validation (beginner-friendly)
  if ($title === '' || $author === '' || $rating === '' || $review_text === '' || $created_at === '') {
    $error = "All fields are required.";
  } else {

    $sql = "UPDATE reviews
            SET title = :title,
                author = :author,
                rating = :rating,
                review_text = :review_text,
                created_at = :created_at,
                
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    // Bind parameters (safe + beginner friendly)
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':author', $author);
    $stmt->bindParam(':rating', $rating);
    $stmt->bindParam(':review_text', $review_text);
    $stmt->bindParam(':created_at', $created_at);
    $stmt->bindParam(':id', $customerId, PDO::PARAM_INT);
  }