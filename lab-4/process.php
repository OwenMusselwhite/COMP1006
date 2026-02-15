<?php
require "includes/header.php";
require "includes/connect.php";
//  TODO: connect to the database 

$dsn = "mysql:host=$host;dbname=$db"; //connect to databse

//   TODO: Grab form data (no validation or sanitization for this lab)

$firstName = 'first_name'; //grab form data
$lastName  = 'last_name';
$email     = 'email';
/*
  1. Write an INSERT statement with named placeholders
  2. Prepare the statement
  3. Execute the statement with an array of values
*/
$stmt = $pdo->prepare("INSERT INTO subscribers (first_name, last_name, email) VALUES (:first_name, :last_name, :email)");
$stmt->execute([
    ':first_name' => $firstName,
    ':last_name' => $lastName,
    ':email' => $email
]);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <main class="container mt-4">
        <h2>Thank You for Subscribing</h2>

        <!-- TODO: Display a confirmation message -->
        <!-- Example: "Thanks, Name! You have been added to our mailing list." -->

        <p>Thanks, <?= htmlspecialchars($firstName) ?>! You have been added to our mailing list.</p> <!--conformation message-->

        <p class="mt-3">
            <a href="subscribers.php">View Subscribers</a>
        </p>
    </main>
</body>

</html>