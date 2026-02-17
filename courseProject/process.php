<?php
//require "includes/header.php";
//require "includes/connect.php";

//connect to the database 
$dsn = "mysql:host=$host;dbname=$db"; //connect to databse

//   TODO: Grab form data (no validation or sanitization for this lab)

$firstName = $_POST['first_name']; //grab form data
$lastName  = $_POST['last_name'];
$position  = $_POST['position'];
$email     = $_POST['email'];
$phone     = $_POST['phone'];


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