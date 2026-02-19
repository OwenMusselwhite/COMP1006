<?php
require "includes/connect.php"; //connect to the database

//fetch all the players from the database
$stmt = $pdo->prepare("SELECT * FROM roster ORDER BY last_name DESC"); //select all players from the database and order by last name
$players = $stmt->fetchAll(PDO::FETCH_ASSOC); //fetch all the players

$success = $_GET['success'] ?? null; //get the success message from the URL
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/main.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Roster</title>
</head>

<body>

    <main class="container mt-4"> 
        <h1 class="Main-Header">Team Roster</h1>

        <?php if ($success === "added"): ?>
        <div class="success">Player added successfully.</div>

        <?php elseif ($success === "updated"): ?>
        <div class="success">Player updated successfully.</div>

        <?php elseif ($success === "deleted"): ?>
        <div class="success">Player deleted successfully.</div>
    <?php endif; ?>


<div class="top-actions">
    <a class="btn" href="add.php">Add New Player</a>
</div>
        



        <p class="mt-4">
            <a href="roster.php">View Roster</a>
        </p>
    </main>
</body>

</html>