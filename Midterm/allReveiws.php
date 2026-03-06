<?php
require "includes/connect.php";

// fetch all reviews for public display
$stmt = $pdo->prepare("SELECT * FROM reviews ORDER BY created_at DESC");
$stmt->execute();
$reviews = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Reviews</title>
</head>
<body>
<main class="mt-4">
  <h2>Reviews</h2>

  <?php if (count($reviews) === 0): ?>
    <p>No reviews yet.</p>
  <?php else: ?>
    <?php foreach ($reviews as $review): ?>
      <article>
        <h3><?php echo htmlspecialchars($review['title']); ?></h3>
        <p><strong>Author:</strong> <?php echo htmlspecialchars($review['author']); ?></p>
        <p><strong>Rating:</strong> <?php echo htmlspecialchars($review['rating']); ?></p>
        <p><?php echo nl2br(htmlspecialchars($review['review_text'])); ?></p>
        <p><em>Posted on <?php echo htmlspecialchars($review['created_at']); ?></em></p>
        <hr>
      </article>
    <?php endforeach; ?>
  <?php endif; ?>

  <p class="mt-3">
    <a href="index.php">Back to main page</a>
  </p>
</main>
</body>
</html>
