<?php
//require "includes/header.php";
require "includes/connect.php";

//connect to the database 
//$dsn = "mysql:host=$host;dbname=$db"; //connect to databse

$action = $_GET['action'] ?? $_POST['action'] ?? null;

$errors = [];



    
//==================//
//=====EDIT FORM====//
//==================//
if ($action === "editForm") { 

    $id = $_GET['id'] ?? null; 

    if ($id === null) {
        die("Invalid ID");
    }

    $stmt = $pdo->prepare("SELECT * FROM roster WHERE id = ?"); 
    $stmt->execute([$id]); 
    $member = $stmt->fetch(PDO::FETCH_ASSOC); 
?> 
    <h2>Edit Team Member</h2> 
    <form method="POST" action="process.php?action=update&id=<?= $id ?>"> 
        <input type="text" name="first_name" value="<?= $member['first_name'] ?>" required><br> 
        <input type="text" name="last_name" value="<?= $member['last_name'] ?>" required><br> 
        <input type="text" name="position" value="<?= $member['position'] ?>"><br> 
        <input type="text" name="phone" value="<?= $member['phone'] ?>"><br> 
        <input type="email" name="email" value="<?= $member['email'] ?>"><br> 
        <button type="submit">Update Player</button> 
        </form> 
    <?php 
        exit; }

//==================//
//===UPDATE FORM====//
//==================//
if ($action === "update") {

    $id = $_GET['id'] ?? null; 

    if ($id === null) {
        die("Invalid ID");
    }

    // Sanitize input 
    $firstName = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_SPECIAL_CHARS); 
    $lastName = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_SPECIAL_CHARS); 
    $position = filter_input(INPUT_POST, 'position', FILTER_SANITIZE_SPECIAL_CHARS); 
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL); 
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_SPECIAL_CHARS);

    //update database
    $stmt = $pdo->prepare(" UPDATE roster 
                            SET first_name = ?, last_name = ?, position = ?, email = ?, phone = ? 
                            WHERE id = ?");

    $stmt->execute([
        $firstName,
        $lastName,
        $position,
        $email,
        $phone, 
        $id
    ]);
    header("Location: index.php?success=updated");
    exit;  
}

//========//
//=====DELETE====//
//========//
if ($action === "delete") {
    $id = $_GET['id'] ?? null; 

    if ($id === null) {
        die("Invalid ID");
    }

    $stmt = $pdo->prepare(" DELETE FROM roster 
                            WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: index.php?success=deleted");
    exit;
}

?> <!--end of PHP -->
