<?php
//require "includes/header.php";
require "includes/connect.php";

//connect to the database 
$dsn = "mysql:host=$host;dbname=$db"; //connect to databse

$action = $_GET['action'] ?? null;

$errors = [];

//==================//
//=====ADD FORM=====//
//==================//
if ($action === 'add') {
    $firstName = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_SPECIAL_CHARS);
    $lastName = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_SPECIAL_CHARS);
    $position = filter_input(INPUT_POST, 'position', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST,'phone',FILTER_SANITIZE_SPECIAL_CHARS);

    //require text fields 
    if ($firstName === null || $firstName === '') {
        $errors[] = "First Name is Required.";
    }

    if ($lastName === null || $lastName === '') {
        $errors[] = "Last Name is Required.";
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

$stmt = $pdo->prepare("INSERT INTO roster (first_name, last_name, position, email, phone) VALUES (:first_name, :last_name, :position, :email, :phone)");
$stmt->execute([
    ':first_name' => $firstName,
    ':last_name' => $lastName,
    ':position' => $position,
    ':email' => $email,
    ':phone' => $phone
]);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roster Change</title>
</head>

<body>

    <main class="container mt-4">
        <h2>Changes Saved</h2>

        <p>Changes saved for <?= htmlspecialchars($firstName) ?> <?= htmlspecialchars($lastName) ?> (Position: <?= htmlspecialchars($position) ?>, Email: <?= htmlspecialchars($email) ?>, Phone: <?= htmlspecialchars($phone) ?>).</p> <!--conformation message-->

        <p class="mt-3">
            <a href="index.php">Back to Home</a>
        </p>
    </main>
</body>

</html>