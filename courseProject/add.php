
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Player</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <h1>Add New Player</h1>

    <form action="process.php" method="POST" enctype="multipart/form-data">

        
        <input type="hidden" name="action" value="add">

        <label for="name" class="form-label">First Name</label>
        <input type="text" id="name" name="first_name" required>

        <label for="last_name" class="form-label">Last Name</label>
        <input type="text" id="last_name" name="last_name" required>

        <label for="position" class="form-label">Position</label>
        <input type="text" id="position" name="position" required>

        <label for="email" class="form-label">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="phone" class="form-label">Phone</label>
        <input type="text" id="phone" name="phone" required>

        <label for="image" class="form-label">Player Image</label>
        <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png,.webp">

        <button type="submit">Add Player</button>
    </form>

</body>
</html>

<?php require "footer.php"; ?>