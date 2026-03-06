<?php
require "includes/connect.php";

// determine action from POST (primary) or GET for delete links
$action = $_POST['action'] ?? $_GET['action'] ?? null;

$errors = [];

// allow delete via GET but others require POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST' && $action !== 'delete') {
    die('Invalid request');
}

// --------------------------------------------------
// Handle add/edit/delete actions
// --------------------------------------------------
if ($action === 'add' || $action === 'edit') {
    // sanitize common fields
    $id = isset($_POST['id']) ? (int)$_POST['id'] : null;
    $title  = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS));
    $author = trim(filter_input(INPUT_POST, 'author', FILTER_SANITIZE_SPECIAL_CHARS));
    $rating = trim(filter_input(INPUT_POST, 'rating', FILTER_SANITIZE_NUMBER_INT));
    $review_text = trim(filter_input(INPUT_POST, 'review_text', FILTER_SANITIZE_SPECIAL_CHARS));
    $created_at = trim(filter_input(INPUT_POST, 'created_at', FILTER_SANITIZE_SPECIAL_CHARS));

    // validation
    if ($title === null || $title === '') {
        $errors[] = "Title is required.";
    }
    if ($author === null || $author === '') {
        $errors[] = "Author is required.";
    }
    if ($rating > 5 || $rating < 1 || $rating === '' || !is_numeric($rating)) {
        $errors[] = "Rating is required and must be a number between 1 and 5.";
    }
    if ($review_text === null || $review_text === '') {
        $errors[] = "Review text is required.";
    }
    if ($created_at === null || $created_at === '') {
        $errors[] = "Created at is required.";
    }elseif (!filter_var($created_at, FILTER_VALIDATE_REGEXP, [
        'options' => ['regexp' => '/^\d{2}\/\d{2}\/\d{4}$/']
    ])) {
        $errors[] = "Created at format is invalid.";
    }

    if (empty($errors)) { //if no errors, insert or update the database
        if ($action === 'add') {
            $stmt = $pdo->prepare("INSERT INTO reviews (title, author, rating, review_text, created_at) 
                                   VALUES (:title, :author, :rating, :review_text, :created_at)");
            $stmt->execute([
                ':title' => $title,
                ':author' => $author,
                ':rating' => $rating,
                ':review_text' => $review_text,
                ':created_at' => $created_at
            ]);
            header("Location: index.php?success=added");
            exit;
        } else { //edit
            if (!$id) { // should never happen if form is correct, but just in case
                die('Missing review id');
            }
            $stmt = $pdo->prepare("UPDATE reviews SET title = :title, author = :author, rating = :rating, 
                                   review_text = :review_text, created_at = :created_at WHERE id = :id");
            $stmt->execute([
                ':title' => $title,
                ':author' => $author,
                ':rating' => $rating,
                ':review_text' => $review_text,
                ':created_at' => $created_at,
                ':id' => $id
            ]);
            header("Location: admin.php?success=updated");
            exit;
        }
    } else { //if there are errors, show them and stop the script before inserting to the DB
        echo "<div class='alert alert-danger'>";
        echo "<h2>Please fix the following:</h2>";
        echo "<ul>";
        foreach ($errors as $error) { 
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
        echo "</div>";

        require "includes/footer.php";
        exit;
    }
}