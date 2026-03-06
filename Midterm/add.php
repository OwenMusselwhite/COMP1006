<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Make A Review</title>
    <!-- <link rel="stylesheet" href="css/style.css"> -->
</head>
<body>

    <h1>New Review</h1>

    <form action="process.php" method="POST">

        
        <input type="hidden" name="action" value="add">

        <label for="title">Book Title</label>
        <input type="text" id="title" name="title" required>

        <label for="author">Author</label>
        <input type="text" id="author" name="author" required>
      
        <label for="rating">Rating</label>
        <input type="number" id="rating" name="rating" min="1" max="5" required>

        <label for="review_text">Review</label>
        <textarea id="review_text" name="review_text" required></textarea>

        <label for="created_at">Created At</label>
        <input type="datetime-local" id="created_at" name="created_at" required>

        <button type="submit">Add Review</button>
    </form>

</body>
</html>