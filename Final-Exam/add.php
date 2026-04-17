<?php

// Make sure the user is logged in before they can access this page
require "includes/auth.php";

// Connect to the database
require "includes/connect.php";

// Array for validation errors
$errors = [];

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get and sanitize form values
    $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS));
}

    // This will store the image path for the database
    $imagePath = null;

    // Validate title
    if ($title === '') {
        $errors[] = "Title is required.";
    }


    // If there are no errors, insert the image into the database
    if (empty($errors)) {
        $sql = "INSERT INTO gallery (title, image_path)
                VALUES (:title, :image_path)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':image_path', $imagePath);

        $stmt->execute();

        $success = "Picture added successfully!";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Picture</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <h1>Add New Picture</h1>

    <form action="process.php" method="POST" enctype="multipart/form-data">

        
        <input type="hidden" name="action" value="add">

        <label for="title" class="form-label">Title</label>
        <input type="text" id="title" name="title" required>

        <label for="image" class="form-label">Image</label>
        <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png,.webp">

        <button type="submit">Add Picture</button>
    </form>

</body>
</html>

