<?php

require "includes/connect.php";

//fetch all the images from the database
$stmt = $pdo->prepare("SELECT * FROM gallery ORDER BY title ASC"); //select all images from the database and order by title
$images = $stmt->fetchAll(PDO::FETCH_ASSOC); //fetch all the images

$success = $_GET['success'] ?? null; //get the success message from the URL
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/main.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
</head>

<body>

    <main class="container mt-4"> 
        <h1 class="Main-Header">Gallery</h1>

        <?php if ($success === "added"): ?>
        <div class="success">Image added successfully.</div>

        <?php elseif ($success === "updated"): ?>
        <div class="success">Image updated successfully.</div>

        <?php elseif ($success === "deleted"): ?>
        <div class="success">Image deleted successfully.</div>
    <?php endif; ?>

    <div class="add_action">
    <a class="btn" href="add.php">Add New Image</a>
    </div>

    <table class="roster-table">
    <tr>
        <th>Title</th>
        <th>Image</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($images as $row): ?> <!--Loop through the images and output each row-->
        <tr>
            <td><?= htmlspecialchars($row['title']) ?></td>
            <td><img src="<?= htmlspecialchars($row['image_path']) ?>" alt="<?= htmlspecialchars($row['title']) ?>" width="100"></td>
        </tr>
            <td><?= htmlspecialchars($row['phone']) ?></td>
            <td class="actions">
                <a class="edit-btn" href="process.php?action=editForm&id=<?= $row['id'] ?>">Edit</a>
                <a class="delete-btn" 
                   href="process.php?action=delete&id=<?= $row['id'] ?>"
                   onclick="return confirm('Are you sure you want to delete this image?')">
                   Delete
                </a>
            </td>
        </tr>
    <?php endforeach; ?>


    <div class="top-actions">
    <a class="btn" href="add.php">Add New Image</a>
    </div>
               
    </main>
</body>

</html>