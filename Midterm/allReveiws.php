<?php
require "includes/connect.php"; // connect to db 

//create query 
$sql = "SELECT * FROM reviews ORDER BY created_at DESC"; 

//prepare
$stmt = $pdo->prepare($sql);  

//execute 
$stmt->execute(); 

//retrieve all rows returned by a SQL query at once
$reviews = $stmt->fetchAll(); 
?>

<main class="mt-4">
  <h2>Reviews</h2>

  <?php if (count($reviews) === 0): ?>
    <p>No reviews yet.</p>
  <?php else: ?>
    <ul>
      <?php foreach ($reviews as $review): ?>

        <?php
          // Calculate total items (only doing 5 for demonstration)
          $total = (count($review['book1']) + count($review['book2']) + count($review['book3']) + count($review['book4']) + count($review['book5']));
        
        ?>

          <strong>Total Items:</strong> <?php echo $total; ?>
        </li>
        <hr>

      <?php endforeach; ?>
    </ul>
  <?php endif; ?>

  <p class="mt-3">
    <a href="index.php">Back to main page</a>
  </p>
</main>

