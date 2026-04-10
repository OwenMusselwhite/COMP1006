<?php
// Make sure the user is logged in before they can access this page
require "includes/auth.php";

// Connect to the database
require "includes/connect.php";

// Show the admin-style header/navigation
require "includes/header_admin.php";

// Array for validation errors
$errors = [];

// Success message
$success = "";

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get and sanitize form values
    $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS));
    $last_name = trim(filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_SPECIAL_CHARS));
    $position = filter_input(INPUT_POST, 'position', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_SPECIAL_CHARS
    );

    // This will store the image path for the database
    $imagePath = null;

    // Validate player name
    if ($name === '') {
        $errors[] = "Player name is required.";
    }

    // Validate last name
    if ($last_name === '') {
        $errors[] = "Player last name is required.";
    }

    // Validate position
    if ($position === '') {
        $errors[] = "Player position is required.";
    }

    //require email and validate proper format 
    if ($email === null || $email === '') {
        $errors[] = "Email is Required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email must be a valid email";
    }

    // require phone number and validate proper format 
    if ($phone === null || $phone === '') {
        $errors[] = "Phone number is required.";
    } elseif (!filter_var($phone, FILTER_VALIDATE_REGEXP, [
        'options' => ['regexp' => '/^[0-9\-\+\(\)\s]{7,25}$/']
    ])) {
        $errors[] = "Phone number format is invalid.";
    }
    }


    // If there are no errors, insert the product into the database
    if (empty($errors)) {
        $sql = "INSERT INTO roster (first_name, last_name, position, email, phone)
                VALUES (:first_name, :last_name, :position, :email, :phone)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':first_name', $name);
        $stmt->bindParam(':last_name', $description);
        $stmt->bindParam(':position', $price);
        $stmt->bindParam(':email', $imagePath);
        $stmt->bindParam(':phone', $imagePath);
        $stmt->execute();

        $success = "Player added successfully!";
    }

?>



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