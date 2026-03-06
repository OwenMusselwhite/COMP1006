<?php
require "includes/connect.php";

$action = $_GET['action'] ?? null;

$errors = [];
$books = $_POST['books'] ?? [];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Invalid request');
}


// --------------------------------------------------
// Sanitize input
// --------------------------------------------------
if ($action === 'add') {
$firstName = trim(filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_SPECIAL_CHARS));
$title  = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS));
$author     = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_SPECIAL_CHARS);
$rating     = trim(filter_input(INPUT_POST, 'rating', FILTER_SANITIZE_SPECIAL_CHARS));
$review_text   = trim(filter_input(INPUT_POST, 'review_text', FILTER_SANITIZE_SPECIAL_CHARS));
$created_at  = trim(filter_input(INPUT_POST, 'created_at', FILTER_SANITIZE_SPECIAL_CHARS));

//==================//
//=====ADD FORM=====//
//==================//

 //require text fields 
    if ($firstName === null || $firstName === '') {
        $errors[] = "First Name is Required.";
    }

    if ($title === null || $title === '') {
        $errors[] = "Title is Required.";
    }

    if ($author === null || $author === '') {
        $errors[] = "Author is Required";
    }
    if ($rating === null || $rating === '') {
        $errors[] = "Rating is Required";
    }

    if ($review_text === null || $review_text === '') {
        $errors[] = "Review Text is Required";
    }

    if ($created_at === null || $created_at === '') {
        $errors[] = "Created At is Required";
    }
    
    if (empty($errors)) {//if no errors insert into database
        $stmt = $pdo->prepare("INSERT INTO reviews (first_name, title, author, rating, review_text, created_at) 
                               VALUES (:first_name, :title, :author, :rating, :review_text, :created_at)");
        $stmt->execute([
            ':first_name' => $firstName,
            ':title' => $title,
            ':author' => $author,
            ':rating' => $rating,
            ':review_text' => $review_text,
            ':created_at' => $created_at
        ]);
        header("Location: index.php?success=added");
        exit;
    } else { //if there are errors, show them and stop the script before inserting to the DB
        
    
        echo "<div class='alert alert-danger'>";
        echo "<h2>Please fix the following:</h2>";
        echo "<ul>";
        foreach ($errors as $error) {
            // htmlspecialchars() prevents any unexpected HTML from being rendered
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
        echo "</div>";
    
        require "includes/footer.php";
        exit;
    }
} else {
    die('Invalid action');
}