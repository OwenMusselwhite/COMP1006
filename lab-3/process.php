<?php
require "includes/header.php";

$firstname = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_SPECIAL_CHARS);
$lastname = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_SPECIAL_CHARS);
$items = $_POST['items'] ?? [];

$errors = [];

if ($firstname === null || $firstname === '') {
    $errors[] = "First name is required.";
}
if ($lastname === null || $lastname === '') {
    $errors[] = "Last name is required.";
}
if ($email === null || $email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "A valid email address is required.";
}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Address is required.";
}
if($address === null || $address === '') {
    $errors[] = "Address is required.";
}
if ($message === null || $message === '') {
    $errors[] = "Message is required.";
}

$itemsordered = [];

foreach ($items as $item => $quantity) {
    $quantity = filter_var($quantity, FILTER_VALIDATE_INT, [
        'options' => [
            'min_range' => 0,
            'max_range' => 24
        ]
    ]);
    if ($quantity === false) {
        $errors[] = "Invalid quantity for $item.";
    } elseif ($quantity > 0) {
        $itemsordered[$item] = $quantity;
    }
}