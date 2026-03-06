<?php
require "includes/connect.php";

$action = $_GET['action'] ?? null;

$errors = [];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Invalid request');
}

// --------------------------------------------------
// Sanitize input
// --------------------------------------------------
$firstName = trim(filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_SPECIAL_CHARS));
$title  = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS));
$author     = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_SPECIAL_CHARS);
$rating     = trim(filter_input(INPUT_POST, 'rating', FILTER_SANITIZE_SPECIAL_CHARS));
$review_text   = trim(filter_input(INPUT_POST, 'review_text', FILTER_SANITIZE_SPECIAL_CHARS));
$created_at  = trim(filter_input(INPUT_POST, 'created_at', FILTER_SANITIZE_SPECIAL_CHARS));


$books = $_POST['books'] ?? [];