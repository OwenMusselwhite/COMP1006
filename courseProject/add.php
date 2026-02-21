
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Player</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <h1>Add New Player</h1>

    <form action="process.php" method="POST">

        
        <input type="hidden" name="action" value="add">

        <label for="name">First Name</label>
        <input type="text" id="name" name="name" required>

        <label for="last_name">Last Name</label>
        <input type="text" id="last_name" name="last_name" required>

        <label for="position">Position</label>
        <input type="text" id="position" name="position" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="phone">Phone</label>
        <input type="text" id="phone" name="phone" required>

        <button type="submit">Add Player</button>
    </form>

</body>
</html>
