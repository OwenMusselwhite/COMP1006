<?php
//require "includes/header.php";
require "includes/connect.php";

//connect to the database 
//$dsn = "mysql:host=$host;dbname=$db"; //connect to databse

$action = $_GET['action'] ?? $_POST['action'] ?? null;

$errors = [];
    
//==================//
//===UPDATE FORM====//
//==================//
if ($action === "update") {

    $id = $_GET['id'] ?? null; 

    if ($id === null) {
        die("Invalid ID");
    }

    // Sanitize input 
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
    $imagePath = filter_input(INPUT_POST, 'image_path', FILTER_SANITIZE_SPECIAL_CHARS);

    //update database
    $stmt = $pdo->prepare(" UPDATE gallery 
                             SET title = ?, image_path = ? 
                             WHERE id = ?"); 


    $stmt->execute([
        $title,
        $imagePath,
        $id
    ]);
    header("Location: index.php?success=updated");
    exit;  
}

//===============//
//=====DELETE====//
//===============//
if ($action === "delete") {
    $id = $_GET['id'] ?? null; 

    if ($id === null) {
        die("Invalid ID");
    }

    $stmt = $pdo->prepare(" DELETE FROM gallery 
                            WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: index.php?success=deleted");
    exit;
}

?> <!--end of PHP -->
